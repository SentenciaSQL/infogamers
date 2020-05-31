<?php
/*
Version: 1.6.2
Author: Huseyin Berberoglu
Author URI: http://nxsn.com
*/

define( 'GHOSTPOOL_META_KEY', '_gp_followers' );
define( 'GHOSTPOOL_USER_OPTION_KEY', 'ghostpool_user_options' );
define( 'GHOSTPOOL_COOKIE_KEY', 'gp-follow-items' );

// Manage default privacy of users followed items lists by adding this constant to wp-config.php
if ( ! defined( 'GHOSTPOOL_DEFAULT_PRIVACY_SETTING' ) ) {
    define( 'GHOSTPOOL_DEFAULT_PRIVACY_SETTING', false );
}

$ajax_mode = 1;

function ghostpool_follow_items() {
    if ( isset( $_REQUEST['wpfpaction'] ) ) {
        global $ajax_mode;
        $ajax_mode = isset( $_REQUEST['ajax'] ) ? $_REQUEST['ajax'] : false;
        if ( $_REQUEST['wpfpaction'] == 'add' ) {
            ghostpool_follow();
        } elseif ( $_REQUEST['wpfpaction'] == 'remove' ) {
            ghostpool_unfollow();
        } elseif ( $_REQUEST['wpfpaction'] == 'clear' ) {
            if ( ghostpool_clear_followed() ) {
            	ghostpool_die_or_go( '<strong class="gp-no-items-found">' . esc_html__( 'All items removed', 'gauge' ) . '</strong>' );
            } else {
            	ghostpool_die_or_go( 'Error' );
            }	
        }
    }
}
add_action( 'wp_loaded', 'ghostpool_follow_items' );

function ghostpool_follow( $post_id = '' ) {
    if ( empty( $post_id ) ) $post_id = $_REQUEST['postid'];
    if ( ghostpool_option( 'hub_following_items' ) == 'members' && ! is_user_logged_in() ) {
        ghostpool_die_or_go( esc_html__( 'Only registered users can follow items.', 'gauge' ) );
        return false;
    }

    if ( ghostpool_do_add_to_list( $post_id  ) ) {
        do_action( 'ghostpool_after_add', $post_id );
        ghostpool_update_post_meta( $post_id, 1 );   	    
		$str = ghostpool_follow_button( 1, 'remove', 0, array( 'post_id' => $post_id ) );
		ghostpool_die_or_go( $str );
    }
}

function ghostpool_do_add_to_list( $post_id ) {
    if ( ghostpool_check_followed( $post_id ) )
        return false;
    if ( is_user_logged_in() ) {
        return ghostpool_add_to_usermeta( $post_id );
    } else {
        return ghostpool_set_cookie( $post_id, 'added' );
    }
}

function ghostpool_unfollow( $post_id = '' ) {
    if ( empty( $post_id ) ) $post_id = $_REQUEST['postid'];
    if ( ghostpool_do_unfollow( $post_id ) ) {
        do_action( 'ghostpool_after_remove', $post_id );
        ghostpool_update_post_meta( $post_id, -1 );
		if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 1 ) {
			$str = '';
		} else {
			$str = ghostpool_follow_button( $post_id, 1, 'add', 0, array( 'post_id' => $post_id ) );
		}
		ghostpool_die_or_go( $str );
     
    }
    else return false;
}

function ghostpool_die_or_go( $str ) {
    global $ajax_mode;
    if ( $ajax_mode) {
        die( $str );
    } else {
        wp_redirect( $_SERVER['HTTP_REFERER'] );
    }
}

function ghostpool_add_to_usermeta( $post_id ) {
	if ( ! is_array( ghostpool_get_user_meta() ) ) {
		$followed = array();
	} else {
		$followed = ghostpool_get_user_meta();
	}
	$followed[] = $post_id;
	ghostpool_update_user_meta( $followed );
	return true;
}

function ghostpool_check_followed( $cid ) {
    if ( is_user_logged_in() ) {
        $following_page_ids = ghostpool_get_user_meta();
        if ( $following_page_ids )
            foreach ( $following_page_ids as $fpost_id )
                if ( $fpost_id == $cid ) return true;
	} else {
	    if ( ghostpool_get_cookie() ) :
	        foreach ( ghostpool_get_cookie() as $fpost_id => $val )
	            if ( $fpost_id == $cid ) return true;
	    endif;
	}
    return false;
}

function ghostpool_follow_button( $post_id, $return = 0, $action = '', $show_span = 1, $args = array() ) {

    extract( $args );
   
    $str = '<span class="gp-follow-button">';

		if ( $action == 'remove' ) :
			$str .= ghostpool_follow_button_html( $post_id, esc_html__( 'Unfollow', 'gauge' ), 'remove' );
		elseif ( $action == 'add' ) :
			$str .= ghostpool_follow_button_html( $post_id, esc_html__( 'Follow', 'gauge' ), 'add' );
		elseif ( ghostpool_check_followed( $post_id ) ) :
			$str .= ghostpool_follow_button_html( $post_id, esc_html__( 'Unfollow', 'gauge' ), 'remove' );
		else:
			$str .= ghostpool_follow_button_html( $post_id, esc_html__( 'Follow', 'gauge' ), 'add' );
		endif;
    
    $str .= '</span>';

    if ( $return ) {
    	return $str;
    } else {
    	echo html_entity_decode( $str );
    }
}

function ghostpool_follow_button_html( $post_id, $opt, $action ) {
    $link = "<a class='gp-follow-link gp-follow-item' href='?wpfpaction=".$action."&amp;postid=". $post_id . "' title='". $opt ."' rel='nofollow'>" . ghostpool_loader() . $opt . "</a>";
    $link = apply_filters( 'ghostpool_follow_button_html', $link );
    return $link;
}

function ghostpool_get_users_following( $user = '' ) {
    $following_page_ids = array();

    if ( !empty( $user ) ) :
        return ghostpool_get_user_meta( $user );
    endif;

    // Collect favorites from cookie and if user is logged in from database
    if ( is_user_logged_in() ) :
        $following_page_ids = ghostpool_get_user_meta();
	else:
	    if ( ghostpool_get_cookie() ) :
	        foreach ( ghostpool_get_cookie() as $post_id => $post_title ) {
	            array_push( $following_page_ids, $post_id );
	        }
	    endif;
	endif;
    return $following_page_ids;
}

function ghostpool_list_follow_items( $args = array() ) {
	$user = isset( $_REQUEST['user'] ) ? $_REQUEST['user'] : '';
	extract( $args );
	if ( ! empty( $user ) ) {
		if ( ghostpool_is_user_favlist_public( $user ) ) {
			if ( is_array( ghostpool_get_users_following( $user ) ) ) { 
				$following_page_ids = array_reverse( ghostpool_get_users_following( $user ) );
			} else {
				$following_page_ids = ghostpool_get_users_following( $user );
			}
			return $following_page_ids;
		}
	} else {
		if ( is_array( ghostpool_get_users_following( $user ) ) ) { 
			$following_page_ids = array_reverse( ghostpool_get_users_following() );
		} else {
			$following_page_ids = ghostpool_get_users_following();
		}
		return $following_page_ids;
	}

}

function ghostpool_loader() {
	return '<span class="fa-spin gp-follow-loader"></span>';
}

function ghostpool_clear_followed() {
    if ( ghostpool_get_cookie() ) :
        foreach ( ghostpool_get_cookie() as $post_id => $val ) {
            ghostpool_set_cookie( $post_id, '' );
            ghostpool_update_post_meta( $post_id, -1 );
        }
    endif;
    if ( is_user_logged_in() ) {
        $following_page_ids = ghostpool_get_user_meta();
        if ( $following_page_ids ) :
            foreach ( $following_page_ids as $post_id ) {
                ghostpool_update_post_meta( $post_id, -1 );
            }
        endif;
        if ( ! delete_user_meta( ghostpool_get_user_id(), GHOSTPOOL_META_KEY ) ) {
            return false;
        }
    }
    return true;
}

function ghostpool_do_unfollow( $post_id ) {
    if ( ! ghostpool_check_followed( $post_id ) )
        return true;

    $a = true;
    if ( is_user_logged_in() ) {
        $user_following = ghostpool_get_user_meta();
        $user_following = array_diff( $user_following, array( $post_id ) );
        $user_following = array_values( $user_following );
        $a = ghostpool_update_user_meta( $user_following );
    }
    if ( $a ) $a = ghostpool_set_cookie( $_REQUEST['postid'], '' );
    return $a;
}

function ghostpool_update_user_meta( $arr ) {
    return update_user_meta( ghostpool_get_user_id(), GHOSTPOOL_META_KEY, $arr );
}

function ghostpool_update_post_meta( $post_id, $val ) {
	$oldval = ghostpool_get_post_meta( $post_id );
	if ( $val == -1 && $oldval == 0 ) {
    	$val = 0;
	} else {
		$val = $oldval + $val;
	}
    return add_post_meta( $post_id, GHOSTPOOL_META_KEY, $val, true ) or update_post_meta( $post_id, GHOSTPOOL_META_KEY, $val );
}

function ghostpool_delete_post_meta( $post_id ) {
    return delete_post_meta( $post_id, GHOSTPOOL_META_KEY );
}

function ghostpool_get_cookie() {
    if ( !isset( $_COOKIE[GHOSTPOOL_COOKIE_KEY] ) ) return;
    return $_COOKIE[GHOSTPOOL_COOKIE_KEY];
}

function ghostpool_get_user_id() {
    $current_user = wp_get_current_user();
    return $current_user->ID;
}

function ghostpool_get_user_meta( $user = '' ) {
    if ( ! empty( $user ) ) :
        $userdata = get_user_by( 'login', $user );
        $user_id = $userdata->ID;
        return get_user_meta( $user_id, GHOSTPOOL_META_KEY, true );
    else:
        return get_user_meta( ghostpool_get_user_id(), GHOSTPOOL_META_KEY, true );
    endif;
}

function ghostpool_get_post_meta( $post_id ) {
	$val = get_post_meta( $post_id, GHOSTPOOL_META_KEY, true );
	if ( $val == '' OR $val < 0) {
		$val = 0;
	}
	return $val;
}

function ghostpool_set_cookie( $post_id, $str ) {
    $expire = time()+60*60*24*30;
    return setcookie( "gp-follow-items[$post_id]", $str, $expire, "/" );
}

function ghostpool_is_user_favlist_public( $user ) {
    $user_opts = ghostpool_get_user_options( $user );
    if ( empty( $user_opts ) ) return GHOSTPOOL_DEFAULT_PRIVACY_SETTING;
    if ( $user_opts['is_ghostpool_list_public'] )
        return true;
    else
        return false;
}

function ghostpool_get_user_options( $user ) {
    $userdata = get_user_by( 'login', $user );
    $user_id = $userdata->ID;
    return get_user_meta( $user_id, GHOSTPOOL_USER_OPTION_KEY, true );
}

function ghostpool_is_user_can_edit() {
    if ( isset( $_REQUEST['user'] ) && $_REQUEST['user'] )
        return false;
    return true;
}

function ghostpool_remove_follow_button( $post_id ) {
    if ( ghostpool_is_user_can_edit() && ( is_page_template( 'following-template.php' ) OR ( isset( $_GET['type'] ) && $_GET['type'] == 'following-template' ) ) ) {
        $link = "<a id='rem_$post_id' class='gp-follow-link gp-unfollow-item button' href='?wpfpaction=remove&amp;page=1&amp;postid=" . $post_id . "' title='". esc_html__( 'Remove', 'gauge' ) . "' rel='nofollow'>" . esc_html__( 'Remove', 'gauge' ) . "</a>";
        $link = apply_filters( 'ghostpool_remove_follow_button', $link );
        echo html_entity_decode( $link );
    }
}

function ghostpool_clear_list_link() {
    if ( ghostpool_is_user_can_edit() ) {
        echo "<a class='gp-follow-link gp-unfollow-all-items button' href='?wpfpaction=clear' rel='nofollow'>" . ghostpool_loader() . esc_html__( 'Unfollow All Items', 'gauge' ) . "</a>";
    }
}

function ghostpool_cookie_warning() {
    if ( ! is_user_logged_in() && ! isset( $_GET['user'] ) ) {
        echo '<div class="gp-cookie-notice">' . esc_html__( 'If you clear your cookies these items will be deleted. Please login so you can save items to your account.', 'gauge' ) . '</div>';
   }
}

?>