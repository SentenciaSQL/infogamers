<?php

/*--------------------------------------------------------------
Load custom BuddyPress stylesheet
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_bp_enqueue_styles' ) ) {	
	function ghostpool_bp_enqueue_styles() {
		wp_enqueue_style( 'gp-bp', get_template_directory_uri() . '/lib/css/bp.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'ghostpool_bp_enqueue_styles' );

/**
 * Disable activation redirect
 *
 */
remove_action( 'bp_admin_init', 'bp_do_activation_redirect', 1 );

/*--------------------------------------------------------------
Add Visual Composer support to replies
--------------------------------------------------------------*/

//add_filter( 'bbp_get_reply_content', 'do_shortcode' );


/*--------------------------------------------------------------
Show bbPress content in Activity stream when site is not public
--------------------------------------------------------------*/

add_filter( 'bbp_is_site_public', '__return_true' );


/*--------------------------------------------------------------
Default avatar dimensions
--------------------------------------------------------------*/

if ( ! defined( 'BP_AVATAR_THUMB_WIDTH' ) ) {
	define( 'BP_AVATAR_THUMB_WIDTH', 58 );
}
if ( ! defined( 'BP_AVATAR_THUMB_HEIGHT' ) ) {
	define( 'BP_AVATAR_THUMB_HEIGHT', 58 );
}
if ( ! defined( 'BP_AVATAR_FULL_WIDTH' ) ) {
	define( 'BP_AVATAR_FULL_WIDTH', 210 );
}
if ( ! defined( 'BP_AVATAR_FULL_HEIGHT' ) ) {
	define( 'BP_AVATAR_FULL_HEIGHT', 210 );
}



/*--------------------------------------------------------------
Default cover image dimensions
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_xprofile_cover_image' ) ) {	
	function ghostpool_xprofile_cover_image( $gp_settings = array() ) {
		$gp_settings['width'] = 1170;
		$gp_settings['height'] = 225;
		return $gp_settings;
	}
}
add_filter( 'bp_before_xprofile_cover_image_settings_parse_args', 'ghostpool_xprofile_cover_image', 10, 1 );
add_filter( 'bp_before_groups_cover_image_settings_parse_args', 'ghostpool_xprofile_cover_image', 10, 1 );


/*--------------------------------------------------------------
Change default group avatars
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_change_bp_group_avatar' ) ) {	
	function ghostpool_change_bp_group_avatar( $gp_avatar ) {
		global $groups_template;
		if ( strpos( $gp_avatar, 'group-avatars' ) ) {
			return $gp_avatar;
		} else {
			return '<img src="'. get_template_directory_uri() . '/lib/images/default-group-avatar.png" class="avatar" alt="' . esc_attr( $groups_template->group->name ) . '" />';
		}	
	}
}
add_filter( 'bp_get_group_avatar', 'ghostpool_change_bp_group_avatar', 1, 1 );


/*--------------------------------------------------------------
Remove WordPress SEO title filter from BuddyPress pages
--------------------------------------------------------------*/

if ( function_exists( 'wpseo_auto_load' ) ) { 
	if ( ! function_exists( 'ghostpool_remove_bp_wpseo_title' ) ) {
		function ghostpool_remove_bp_wpseo_title() {
			if ( ! bp_is_blog_page() ) { 
				$gp_front_end = WPSEO_Frontend::get_instance();
				remove_filter( 'pre_get_document_title', array( $gp_front_end, 'title' ), 15 );
			}	
		}
	}
	add_action( 'init', 'ghostpool_remove_bp_wpseo_title' );
}

?>