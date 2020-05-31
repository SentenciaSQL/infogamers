<?php

if ( ! function_exists( 'ghostpool_hub_variables' ) ) {
	function ghostpool_hub_variables() {

		global $gp;
		$gp_global = get_option( 'gp' ); 		
		
		// Get post or hub association ID
		$post_id = ghostpool_get_hub_id( get_the_ID() );
			
			
		/*--------------------------------------------------------------
		Detect hub and child pages (except review pages)
		--------------------------------------------------------------*/

		if ( is_singular( 'post' ) && get_post_meta( get_the_ID(), 'post_association', true ) && ghostpool_option( 'hub_header_posts' ) == 'disabled' ) {
			$GLOBALS['ghostpool_hub_header'] = false;
		} elseif ( ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) && ( ! is_attachment() && ! is_archive() && ! is_search() && ! is_page_template( 'review-template.php' ) ) )  {
			$GLOBALS['ghostpool_hub_header'] = true;
		} else {
			$GLOBALS['ghostpool_hub_header'] = false;
		}
							
		/*if ( ( ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) OR ( is_singular( 'post' ) && get_post_meta( $post_id, 'post_association', true ) && $gp_global['hub_header_posts'] == 'enabled' ) OR is_singular( 'gp_user_review' ) ) && ( ! is_attachment() && ! is_archive() && ! is_search() && ! is_page_template( 'review-template.php' ) ) ) {
			$GLOBALS['ghostpool_hub_header'] = true;		
		} else {
			$GLOBALS['ghostpool_hub_header'] = false;
		}*/


		/*--------------------------------------------------------------
		Hub Settings
		--------------------------------------------------------------*/
				
		if ( $GLOBALS['ghostpool_hub_header'] == true ) {
		
		
			/*--------------------------------------------------------------
			Hub Page Template
			--------------------------------------------------------------*/

			if ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' ) {
			
				$GLOBALS['ghostpool_hub_award'] = get_post_meta( $post_id, 'hub_award', true );
			 
				$GLOBALS['ghostpool_hub_award_icon'] = redux_post_meta( 'gp', $post_id, 'hub_award_icon' );

				$GLOBALS['ghostpool_hub_award_title'] = get_post_meta( $post_id, 'hub_award_title', true );
		
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', $post_id, 'hub_title' ) == 'default' ? $gp_global['hub_title'] : redux_post_meta( 'gp', $post_id, 'hub_title' );					

				$GLOBALS['ghostpool_title_header_format'] = redux_post_meta( 'gp', $post_id, 'hub_title_header_format' ) == 'default' ? $gp_global['hub_title_header_format'] : redux_post_meta( 'gp', $post_id, 'hub_title_header_format' );
		
				$GLOBALS['ghostpool_page_header_text'] = get_post_meta( $post_id, 'hub_title_text', true );

				$GLOBALS['ghostpool_custom_title'] = get_post_meta( $post_id, 'hub_custom_title', true );

				$GLOBALS['ghostpool_hub_featured_image'] = $gp_global['hub_featured_image'];

				$GLOBALS['ghostpool_hub_image_width'] = $gp_global['hub_image']['width'];

				$GLOBALS['ghostpool_hub_image_height'] = $gp_global['hub_image']['height'];

				$GLOBALS['ghostpool_hub_hard_crop'] = $gp_global['hub_hard_crop'];
			
				$GLOBALS['ghostpool_header_cats'] = isset( $gp_global['hub_header_cats'] ) ? $gp_global['hub_header_cats'] : '';

				$GLOBALS['ghostpool_header_fields'] = isset( $gp_global['hub_header_fields'] ) ? $gp_global['hub_header_fields'] : '';

				$GLOBALS['ghostpool_display_site_rating'] = $gp_global['hub_header_display_rating']['site_rating'];

				$GLOBALS['ghostpool_display_user_rating'] = $gp_global['hub_header_display_rating']['user_rating'];
				
				$GLOBALS['ghostpool_affiliate_button_link'] = get_post_meta( $post_id, 'hub_affiliate_button_link', true );			
				
				$GLOBALS['ghostpool_affiliate_button_text'] = get_post_meta( $post_id, 'hub_affiliate_button_text', true ) ? get_post_meta( $post_id, 'hub_affiliate_button_text', true ) : $gp_global['hub_affiliate_button_text'];
							
				$GLOBALS['ghostpool_user_rating_box'] = redux_post_meta( 'gp', $post_id, 'hub_user_rating' ) == 'default' ? $gp_global['hub_user_rating'] : redux_post_meta( 'gp', $post_id, 'hub_user_rating' );
			
			
			/*--------------------------------------------------------------
			Hub Review Page Template
			--------------------------------------------------------------*/

			} elseif ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) {

				$GLOBALS['ghostpool_hub_award'] = get_post_meta( $post_id, 'hub_review_award', true );
			 
				$GLOBALS['ghostpool_hub_award_icon'] = redux_post_meta( 'gp', $post_id, 'hub_review_award_icon' );

				$GLOBALS['ghostpool_hub_award_title'] = get_post_meta( $post_id, 'hub_review_award_title', true );
		
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', $post_id, 'hub_review_title' ) == 'default' ? $gp_global['review_title'] : redux_post_meta( 'gp', $post_id, 'hub_review_title' );					

				$GLOBALS['ghostpool_title_header_format'] = redux_post_meta( 'gp', $post_id, 'hub_review_title_header_format' ) == 'default' ? $gp_global['review_title_header_format'] : redux_post_meta( 'gp', $post_id, 'hub_review_title_header_format' );
		
				$GLOBALS['ghostpool_page_header_text'] = get_post_meta( $post_id, 'hub_review_title_text', true );

				$GLOBALS['ghostpool_custom_title'] = get_post_meta( $post_id, 'hub_review_custom_title', true );

				$GLOBALS['ghostpool_hub_featured_image'] = $gp_global['review_featured_image'];

				$GLOBALS['ghostpool_hub_image_width'] = $gp_global['review_image']['width'];

				$GLOBALS['ghostpool_hub_image_height'] = $gp_global['review_image']['height'];

				$GLOBALS['ghostpool_hub_hard_crop'] = $gp_global['review_hard_crop'];
						
				$GLOBALS['ghostpool_header_cats'] = isset( $gp_global['review_header_cats'] ) ? $gp_global['review_header_cats'] : '';

				$GLOBALS['ghostpool_header_fields'] = isset( $gp_global['review_header_fields'] ) ? $gp_global['review_header_fields'] : '';

				$GLOBALS['ghostpool_header_avatar'] = $gp_global['review_meta']['avatar'];
				
				$GLOBALS['ghostpool_header_author_date'] = $gp_global['review_meta']['author_date'];

				$GLOBALS['ghostpool_display_site_rating'] = $gp_global['review_header_display_rating']['site_rating'];

				$GLOBALS['ghostpool_display_user_rating'] = $gp_global['review_header_display_rating']['user_rating'];
				
				$GLOBALS['ghostpool_affiliate_button_link'] = get_post_meta( $post_id, 'hub_review_affiliate_button_link', true );			
				
				$GLOBALS['ghostpool_affiliate_button_text'] = get_post_meta( $post_id, 'hub_review_affiliate_button_text', true ) ? get_post_meta( $post_id, 'hub_review_affiliate_button_text', true ) : $gp_global['hub_affiliate_button_text'];
				
				$GLOBALS['ghostpool_user_rating_box'] = redux_post_meta( 'gp', $post_id, 'hub_review_user_rating' ) == 'default' ? $gp_global['review_user_rating'] : redux_post_meta( 'gp', $post_id, 'hub_review_user_rating' );			
			
			}
		
		}
			
	}

}

?>