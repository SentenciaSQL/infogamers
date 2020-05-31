<?php

/*--------------------------------------------------------------
Load User Rating Script
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_register_user_rating_script' ) ) {

	function ghostpool_register_user_rating_script() {
	
		global $post;

		$gp_global = get_option( 'gp' ); 
											
		// Get post or hub association ID
		$post_id = ghostpool_get_hub_id( get_the_ID() );
		
		if ( ( ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' Or get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) OR ( is_singular( 'post' ) && get_post_meta( get_the_ID(), 'post_association', true ) && ghostpool_option( 'hub_header_posts' ) == 'enabled' ) OR is_singular( 'gp_user_review' ) ) && ( ! is_archive() && ! is_search() && ! is_page_template( 'review-template.php' ) ) ) {	
			$gp_hub_header = true;
		} else {
			$gp_hub_header = false;
		}

		if ( $gp_hub_header == true ) {	
			$GLOBALS['ghostpool_user_rating_box'] = redux_post_meta( 'gp', $post_id, 'hub_user_rating' ) == 'default' ? $gp_global['hub_user_rating'] : redux_post_meta( 'gp', $post_id, 'hub_user_rating' );
		} elseif ( is_page_template( 'review-template.php' ) ) {
			$GLOBALS['ghostpool_user_rating_box'] = redux_post_meta( 'gp', get_the_ID(), 'review_user_rating' ) == 'default' ? $gp_global['review_user_rating'] : redux_post_meta( 'gp', get_the_ID(), 'review_user_rating' );
		}

		if ( ( ghostpool_option( 'review_can_users_rate' ) == 'enabled' && ! is_user_logged_in() ) OR is_user_logged_in() ) {
		
			wp_enqueue_script( 'gp-user-ratings', get_template_directory_uri() . '/lib/scripts/user-ratings.js', array( 'jquery' ), '', true );						
	
			wp_localize_script( 'gp-user-ratings', 'ghostpool_rating', array(
				'post_id' => $post_id,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'rating_number' => ghostpool_option( 'review_rating_number' ),
				'rating_width' => ( 24 * ghostpool_option( 'review_rating_number' ) ),
				'rated' => get_user_meta( get_current_user_id(), '_gp_rated_' . $post_id, true ),
				'position' => get_user_meta( get_current_user_id(), '_gp_current_position_' . $post_id, true ),
				'rating' => get_user_meta( get_current_user_id(), '_gp_user_rating_' . $post_id, true )
			) );
			
		}

	}
	
}
add_action( 'wp_enqueue_scripts', 'ghostpool_register_user_rating_script' );


/*--------------------------------------------------------------
User Rating Script
--------------------------------------------------------------*/
			
if ( ! class_exists( 'ghostpool_user_rating' ) ) {

    class ghostpool_user_rating {
    
        public $gp_user_sum;
        public $gp_user_rating;
        public $gp_current_position;
        public $gp_user_votes;

        function __construct() {

			if ( is_page() ) {
				$this->retrieve_values();
			}
			
			add_action( 'wp_ajax_ghostpool_rating', array( &$this, 'sync_rating') );
			add_action( 'wp_ajax_nopriv_ghostpool_rating', array( &$this, 'sync_rating' ) );

        }
		
        private function retrieve_values() {
        
            $gp_current_position = get_post_meta( get_the_ID(), '_gp_current_position', true );
            if ( ! $gp_current_position) {
                $gp_current_position = 0;
            }
            $this->gp_current_position = ( 24 * ghostpool_option( 'review_rating_number' ) );
                                
            $gp_user_rating = get_post_meta( get_the_ID(), '_gp_user_rating', true );
            if ( ! $gp_user_rating ) {
                $gp_user_rating = 0;
            }
            $this->gp_user_rating = $gp_user_rating;

            $gp_user_votes = get_post_meta( get_the_ID(), '_gp_user_votes', true );
            if ( ! $gp_user_votes ) {
                $gp_user_votes = 0;
            }
            $this->gp_user_votes = $gp_user_votes;

            $gp_user_sum = get_post_meta( get_the_ID(), '_gp_user_sum', true );
            if ( ! $gp_user_sum && $gp_user_rating && $gp_user_votes ) {
                $gp_user_sum = ( $gp_user_rating * $gp_user_votes );
            } elseif ( ! $gp_user_sum ) {
            	$gp_user_sum = 0;
            }
            $this->gp_user_sum = $gp_user_sum;

        }

        public function sync_rating() {
        	
            // Get post id, user rating and position from user rating box
            $gp_post_id = floatval( $_POST['post_id'] );
            $gp_added_rating = floatval( $_POST['rating_score'] );
            $gp_added_position = floatval( $_POST['rating_position'] );

            // Current values
            $gp_current_position = get_post_meta( $gp_post_id, '_gp_current_position', true );
            if ( ! $gp_current_position ) {
                $gp_current_position = 0;
            }
           	$gp_user_rating = get_post_meta( $gp_post_id, '_gp_user_rating', true );
            if ( ! $gp_user_rating ) {
                $gp_user_rating = 0;
            }
            $gp_user_votes = (int) get_post_meta( $gp_post_id, '_gp_user_votes', true );
            if ( ! $gp_user_votes ) {
                $gp_user_votes = 0;
            }
            $gp_user_sum = get_post_meta( $gp_post_id, '_gp_user_sum', true );
            if ( ! $gp_user_sum && $gp_user_rating && $gp_user_votes ) {
                $gp_user_sum = ( $gp_user_rating * $gp_user_votes );
            } elseif ( ! $gp_user_sum ) {
            	$gp_user_sum = 0;
            }            

            // New values
            $gp_new_user_sum = $gp_user_sum + $gp_added_rating;
            $gp_new_position = ( $gp_current_position * $gp_user_votes + $gp_added_position ) / ( $gp_user_votes + 1 );
            $gp_new_user_votes = $gp_user_votes + 1;
            $gp_new_user_rating = number_format( ( $gp_new_user_sum ) / ( $gp_new_user_votes ), 1 ) + 0;
            
            // Prevent rating higher than maximum rating being set
            if ( $gp_new_user_rating > ghostpool_option( 'review_rating_number' ) ) {
				$gp_new_user_rating = ghostpool_option( 'review_rating_number' );
			}

            // Update post/user meta with new values
            update_post_meta( $gp_post_id, '_gp_user_sum', $gp_new_user_sum, $gp_user_sum );
            update_post_meta( $gp_post_id, '_gp_current_position', $gp_new_position, $gp_current_position );
            update_post_meta( $gp_post_id, '_gp_user_rating', $gp_new_user_rating, $gp_user_rating );
            update_post_meta( $gp_post_id, '_gp_user_votes', $gp_new_user_votes, $gp_user_votes );
            if ( is_user_logged_in() ) {
				add_user_meta( get_current_user_id(), '_gp_rated_' . $gp_post_id, 'rated' );
				add_user_meta( get_current_user_id(), '_gp_user_rating_' . $gp_post_id, $gp_added_rating );
				add_user_meta( get_current_user_id(), '_gp_current_position_' . $gp_post_id, $gp_added_position );
			}
            exit;
            
        }
    }
}

new ghostpool_user_rating();