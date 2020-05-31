<?php

if ( ! function_exists( 'ghostpool_init_variables' ) ) {
	function ghostpool_init_variables() {

		global $post;
		$global = get_option( 'gp' );
		

		/*--------------------------------------------------------------
		BuddyPress
		--------------------------------------------------------------*/

		if ( function_exists( 'bp_is_active' ) && ! bp_is_blog_page() ) {

			if ( bp_is_user() ) {

				$GLOBALS['ghostpool_page_header'] = ghostpool_option( 'bp_members_title' ) != 'default' ? ghostpool_option( 'bp_members_title' ) : ghostpool_option( 'bp_title' );
			
				$GLOBALS['ghostpool_layout'] = ghostpool_option( 'bp_profile_layout' ) != 'default' ? ghostpool_option( 'bp_profile_layout' ) : ghostpool_option( 'bp_layout' );
			
				$GLOBALS['ghostpool_sidebar'] = ghostpool_option( 'bp_members_sidebar' ) != 'default' ? ghostpool_option( 'bp_members_sidebar' ) : ghostpool_option( 'bp_sidebar' );
				
			} elseif ( bp_is_activity_component() ) {
				
				$GLOBALS['ghostpool_page_header'] = ghostpool_option( 'bp_activity_title' ) != 'default' ? ghostpool_option( 'bp_activity_title' ) : ghostpool_option( 'bp_title' );
					
				$GLOBALS['ghostpool_page_header_bg'] = ghostpool_option( 'bp_activity_title_bg', 'url' ) != '' ? ghostpool_option( 'bp_activity_title_bg' ) : ghostpool_option( 'bp_title_bg' );

				$GLOBALS['ghostpool_layout'] = ghostpool_option( 'bp_activity_layout' ) != 'default' ? ghostpool_option( 'bp_activity_layout' ) : ghostpool_option( 'bp_layout' );
			
				$GLOBALS['ghostpool_sidebar'] = ghostpool_option( 'bp_activity_sidebar' ) != 'default' ? ghostpool_option( 'bp_activity_sidebar' ) : ghostpool_option( 'bp_sidebar' );
					
			} elseif ( bp_is_members_component() ) {

				$GLOBALS['ghostpool_page_header'] = ghostpool_option( 'bp_members_title' ) != 'default' ? ghostpool_option( 'bp_members_title' ) : ghostpool_option( 'bp_title' );
					
				$GLOBALS['ghostpool_page_header_bg'] = ghostpool_option( 'bp_members_title_bg', 'url' ) != '' ? ghostpool_option( 'bp_members_title_bg' ) : ghostpool_option( 'bp_title_bg' );
					
				$GLOBALS['ghostpool_layout'] = ghostpool_option( 'bp_members_layout' ) != 'default' ? ghostpool_option( 'bp_members_layout' ) : ghostpool_option( 'bp_layout' );

				$GLOBALS['ghostpool_sidebar'] = ghostpool_option( 'bp_members_sidebar' ) != 'default' ? ghostpool_option( 'bp_members_sidebar' ) : ghostpool_option( 'bp_sidebar' );

			} elseif ( bp_is_groups_component() ) {

				$GLOBALS['ghostpool_page_header'] = ghostpool_option( 'bp_groups_title' ) != 'default' ? ghostpool_option( 'bp_groups_title' ) : ghostpool_option( 'bp_title' );
				
				$GLOBALS['ghostpool_page_header_bg'] = ghostpool_option( 'bp_groups_title_bg', 'url' ) != '' ? ghostpool_option( 'bp_groups_title_bg' ) : ghostpool_option( 'bp_title_bg' );	
			
				$GLOBALS['ghostpool_layout'] = ghostpool_option( 'bp_groups_layout' ) != 'default' ? ghostpool_option( 'bp_groups_layout' ) : ghostpool_option( 'bp_layout' );
			
				$GLOBALS['ghostpool_sidebar'] = ghostpool_option( 'bp_groups_sidebar' ) != 'default' ? ghostpool_option( 'bp_groups_sidebar' ) : ghostpool_option( 'bp_sidebar' );

			} elseif ( bp_is_register_page() ) {

				$GLOBALS['ghostpool_page_header'] = ghostpool_option( 'bp_register_title' ) != 'default' ? ghostpool_option( 'bp_register_title' ) : ghostpool_option( 'bp_title' );
				
				$GLOBALS['ghostpool_page_header_bg'] = ghostpool_option( 'bp_register_title_bg', 'url' ) != '' ? ghostpool_option( 'bp_register_title_bg' ) : ghostpool_option( 'bp_title_bg' );
					
				$GLOBALS['ghostpool_layout'] = ghostpool_option( 'bp_register_layout' ) != 'default' ? ghostpool_option( 'bp_register_layout' ) : ghostpool_option( 'bp_layout' );
			
				$GLOBALS['ghostpool_sidebar'] = ghostpool_option( 'bp_register_sidebar' ) != 'default' ? ghostpool_option( 'bp_register_sidebar' ) : ghostpool_option( 'bp_sidebar' );
								
			} else {
			
				$GLOBALS['ghostpool_page_header'] = ghostpool_option( 'bp_title' );
				
				$GLOBALS['ghostpool_page_header_bg'] = ghostpool_option( 'bp_title_bg' );
			
				$GLOBALS['ghostpool_layout'] = ghostpool_option( 'bp_layout' );
			
				$GLOBALS['ghostpool_sidebar'] = ghostpool_option( 'bp_sidebar' );
				
			}	
			
			$GLOBALS['ghostpool_page_header_text'] = 'enabled';	

			$GLOBALS['ghostpool_custom_title'] = ghostpool_option( 'page_custom_title' );
	
			$GLOBALS['ghostpool_subtitle'] = ghostpool_option( 'page_subtitle' );


		/*--------------------------------------------------------------
		bbPress
		--------------------------------------------------------------*/

		} elseif ( function_exists( 'is_bbpress' ) && is_bbpress() ) {

			if ( bbp_is_single_topic() OR bbp_is_single_reply() ) {
				$page_id = bbp_get_topic_id();
			} else {
				$page_id = get_the_ID();
			}

			if ( bbp_is_single_forum() OR bbp_is_single_topic() OR bbp_is_single_reply() ) {

				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', $page_id, 'bbpress_title' ) == 'default' ? $global['bbpress_title'] : redux_post_meta( 'gp', $page_id, 'bbpress_title' );
				
				$GLOBALS['ghostpool_page_header_text'] = 'enabled';	

				$page_header_bg = redux_post_meta( 'gp', $page_id, 'bbpress_title_bg' );
				$GLOBALS['ghostpool_page_header_bg'] = ! empty( $page_header_bg['url'] ) ? $page_header_bg : $global['bbpress_title_bg'];
							
				$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', $page_id, 'bbpress_layout' ) == 'default' ? 
				$global['bbpress_layout'] : redux_post_meta( 'gp', $page_id, 'bbpress_layout' );
				
				$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', $page_id, 'bbpress_sidebar' ) == 'default' ? 
				$global['bbpress_sidebar'] : redux_post_meta( 'gp', $page_id, 'bbpress_sidebar' );
							
			} else {

				$GLOBALS['ghostpool_page_header'] = $global['bbpress_title'];
				
				$GLOBALS['ghostpool_page_header_text'] = 'enabled';	
				
				$GLOBALS['ghostpool_page_header_bg'] = $global['bbpress_title_bg'];
				
				$GLOBALS['ghostpool_layout'] = $global['bbpress_layout'];
				
				$GLOBALS['ghostpool_sidebar'] = $global['bbpress_sidebar'];
										
			}			
		/*--------------------------------------------------------------
		WooCommerce Shop Page
		--------------------------------------------------------------*/

		} elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() && ( is_shop() OR is_product_category() OR is_product_tag() OR is_tax() ) ) {

			$post_id = (int) get_option( 'woocommerce_shop_page_id' ); // Get WooCommerce shop page ID	

			$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', $post_id, 'page_title' ) == 'default' ? $global['shop_title'] : redux_post_meta( 'gp', $post_id, 'page_title' );
			
			$GLOBALS['ghostpool_page_header_text'] = get_post_meta( $post_id, 'page_title_text', true );
			
			$GLOBALS['ghostpool_custom_title'] = get_post_meta( $post_id, 'page_custom_title', true );
			
			$GLOBALS['ghostpool_subtitle'] = get_post_meta( $post_id, 'page_subtitle', true );
			
			$GLOBALS['ghostpool_page_header_bg'] = get_post_meta( $post_id, 'page_title_bg', true );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = get_post_meta( $post_id, 'page_title_teaser_video_bg', true );
			
			$GLOBALS['ghostpool_full_video_bg'] = get_post_meta( $post_id, 'page_title_full_video_bg', true );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', $post_id, 'page_layout' ) == 'default' ? $global['shop_layout'] : redux_post_meta( 'gp', $post_id, 'page_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', $post_id, 'page_sidebar' ) == 'default' ? $global[ 'shop_sidebar' ] : redux_post_meta( 'gp', $post_id, 'page_sidebar' );
	
		
		/*--------------------------------------------------------------
		WooCommerce Products
		--------------------------------------------------------------*/

		} elseif ( function_exists( 'is_woocommerce' ) && is_singular( 'product' ) ) {

			$GLOBALS['ghostpool_page_header'] = 'gp-no-large-title';
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'product_layout' ) == 'default' ? $global['product_layout'] : redux_post_meta( 'gp', get_the_ID(), 'product_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'product_sidebar' ) == 'default' ? $global['product_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'product_sidebar' );


		/*--------------------------------------------------------------
		Portfolio Categories
		--------------------------------------------------------------*/

		} elseif ( is_post_type_archive( 'gp_portfolio_item' ) OR is_tax( 'gp_portfolios' ) )  {

			// Get category option
			$term_data = null;
			if ( isset( get_queried_object()->term_id ) ) {
				$term_id = get_queried_object()->term_id;
				$term_data = get_option( "taxonomy_$term_id" );
			}	
			
			$GLOBALS['ghostpool_page_header'] = ! isset( $term_data['page_header'] ) || $term_data['page_header'] == 'default' ? $global['portfolio_cat_title'] : $term_data['page_header'];
						
			$GLOBALS['ghostpool_page_header_text'] = 'enabled';	
			
			$GLOBALS['ghostpool_page_header_bg'] = $term_data['bg_image'];
			
			$GLOBALS['ghostpool_layout'] = ! isset( $term_data['layout'] ) || $term_data['layout'] == 'default' ? $global['portfolio_cat_layout'] : $term_data['layout'];
			
			$GLOBALS['ghostpool_sidebar'] = ! isset( $term_data['sidebar'] ) || $term_data['sidebar'] == 'default' ? $global['portfolio_cat_sidebar'] : $term_data['sidebar']; 


		/*--------------------------------------------------------------
		Portfolio Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'portfolio-template.php' ) )  {

			if ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' && redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' && redux_post_meta( 'gp', $post->post_parent, 'review_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];	
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'review_title' );				
			} else {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_title' );
			}
		
			$GLOBALS['ghostpool_page_header_text'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_title_text' );	
			
			$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_title_bg' );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_title_teaser_video_bg' );
			
			$GLOBALS['ghostpool_full_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_title_full_video_bg' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_sidebar' );
					
		
		/*--------------------------------------------------------------
		Portfolio Items
		--------------------------------------------------------------*/

		} elseif ( is_singular( 'gp_portfolio_item' ) ) {

			$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_title' ) == 'default' ? $global['portfolio_item_title'] : redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_title' );

			$GLOBALS['ghostpool_page_header_text'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_title_text' );	
			
			$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_title_bg' );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_title_teaser_video_bg' );
			
			$GLOBALS['ghostpool_full_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_title_full_video_bg' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_sidebar' );			


		/*--------------------------------------------------------------
		Video Categories
		--------------------------------------------------------------*/

		} elseif ( is_tax( 'gp_videos' ) ) {

			// Get category option
			$term_data = null;
			if ( isset( get_queried_object()->term_id ) ) {
				$term_id = get_queried_object()->term_id;
				$term_data = get_option( "taxonomy_$term_id" );
			}
			
			$GLOBALS['ghostpool_page_header'] = ! isset( $term_data['page_header'] ) || $term_data['page_header'] == 'default' ? $global['video_cat_title'] : $term_data['page_header'];
			
			$GLOBALS['ghostpool_page_header_text'] = 'enabled';		
			
			$GLOBALS['ghostpool_page_header_bg'] = $term_data['bg_image'];
			
			$GLOBALS['ghostpool_layout'] = ! isset( $term_data['layout'] ) || $term_data['layout'] == 'default' ? $global['video_cat_layout'] : $term_data['layout'];
			
			$GLOBALS['ghostpool_sidebar'] = ! isset( $term_data['sidebar'] ) || $term_data['sidebar'] == 'default' ? $global['video_cat_sidebar'] : $term_data['sidebar'];
		
				
		/*--------------------------------------------------------------
		Hub Categories
		--------------------------------------------------------------*/

		} elseif ( is_tax() ) {

			// Get category option
			$term_data = null;
			if ( isset( get_queried_object()->term_id ) ) {
				$term_id = get_queried_object()->term_id;
				$term_data = get_option( "taxonomy_$term_id" );
			}
			
			$GLOBALS['ghostpool_page_header'] = ! isset( $term_data['page_header'] ) || $term_data['page_header'] == 'default' ? $global['hub_cat_title'] : $term_data['page_header'];
			
			$GLOBALS['ghostpool_page_header_text'] = 'enabled';		
			
			$GLOBALS['ghostpool_page_header_bg'] = $term_data['bg_image'];
			
			$GLOBALS['ghostpool_layout'] = ! isset( $term_data['layout'] ) || $term_data['layout'] == 'default' ? $global['hub_cat_layout'] : $term_data['layout'];
			
			$GLOBALS['ghostpool_sidebar'] = ! isset( $term_data['sidebar'] ) || $term_data['sidebar'] == 'default' ? $global['hub_cat_sidebar'] : $term_data['sidebar'];


		/*--------------------------------------------------------------
		Search/Author Results
		--------------------------------------------------------------*/

		} elseif ( is_search() or is_author() ) {
			
			$GLOBALS['ghostpool_page_header'] = $global['search_title'];
			
			$GLOBALS['ghostpool_page_header_text'] = 'enabled';		
			
			$GLOBALS['ghostpool_page_header_bg'] = $global['search_title_bg'];
			
			$GLOBALS['ghostpool_layout'] = $global['search_layout'];
			
			$GLOBALS['ghostpool_sidebar'] = $global['search_sidebar']; 
			
				
		/*--------------------------------------------------------------
		Post Categories, Archives & Tags
		--------------------------------------------------------------*/

		} elseif ( is_home() OR is_archive() ) {

			// Get category option
			$term_data = null;
			if ( isset( get_queried_object()->term_id ) ) {
				$term_id = get_queried_object()->term_id;
				$term_data = get_option( "taxonomy_$term_id" );
			}
			
			$GLOBALS['ghostpool_page_header'] = ! isset( $term_data['page_header'] ) || $term_data['page_header'] == 'default' ? $global['cat_title'] : $term_data['page_header'];
			
			$GLOBALS['ghostpool_page_header_text'] = 'enabled';		
			
			$GLOBALS['ghostpool_page_header_bg'] = $term_data['bg_image'];
			
			$GLOBALS['ghostpool_layout'] = ! isset( $term_data['layout'] ) || $term_data['layout'] == 'default' ? $global['cat_layout'] : $term_data['layout'];
			
			$GLOBALS['ghostpool_sidebar'] = ! isset( $term_data['sidebar'] ) || $term_data['sidebar'] == 'default' ? 
			$global['cat_sidebar'] : $term_data['sidebar']; 
			
			
		/*--------------------------------------------------------------
		Blog Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'blog-template.php' ) )  {

			if ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' && redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' && redux_post_meta( 'gp', $post->post_parent, 'review_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];	
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'review_title' );
			} else {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_title' );
			}

			$GLOBALS['ghostpool_page_header_text'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_title_text' );
			
			$GLOBALS['ghostpool_custom_title'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_custom_title' );
			
			$GLOBALS['ghostpool_subtitle'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_subtitle' );
			
			$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_title_bg' );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_title_teaser_video_bg' );				
			
			$GLOBALS['ghostpool_full_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_title_full_video_bg' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_sidebar' );
	

		/*--------------------------------------------------------------
		Following Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'following-template.php' ) ) {

			if ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' && redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' && redux_post_meta( 'gp', $post->post_parent, 'review_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];	
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'review_title' );	
			} else {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'following_title' );
			}

			$GLOBALS['ghostpool_page_header_text'] = redux_post_meta( 'gp', get_the_ID(), 'following_title_text' );
			
			$GLOBALS['ghostpool_custom_title'] = redux_post_meta( 'gp', get_the_ID(), 'following_custom_title' );
			
			$GLOBALS['ghostpool_subtitle'] = redux_post_meta( 'gp', get_the_ID(), 'following_subtitle' );
			
			$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'following_title_bg' );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'following_title_teaser_video_bg' );
			
			$GLOBALS['ghostpool_full_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'following_title_full_video_bg' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'following_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'following_sidebar' );
			
								
		/*--------------------------------------------------------------
		FlexSlider Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'flexslider-template.php' ) )  {

			$GLOBALS['ghostpool_page_header'] = 'gp-large-title';
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'flexslider_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'flexslider_sidebar' );


		/*--------------------------------------------------------------
		Featured Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'featured-template.php' ) )  {

			$GLOBALS['ghostpool_page_header'] = 'gp-large-title';
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'featured_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'featured_sidebar' );
			
								
		/*--------------------------------------------------------------
		Hub Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'hub-template.php' ) )  {

			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'hub_layout' ) == 'default' ? $global['hub_layout'] : redux_post_meta( 'gp', get_the_ID(), 'hub_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'hub_sidebar' ) == 'default' ? $global['hub_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'hub_sidebar' );
			
			$GLOBALS['ghostpool_hub_details'] = $global['hub_details'];
			
			$GLOBALS['ghostpool_hub_synopsis'] = get_post_meta( get_the_ID(), 'hub_synopsis', true );	
 
 
		/*--------------------------------------------------------------
		Hub Review Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'hub-review-template.php' ) )  {

			$GLOBALS['ghostpool_custom_title'] = redux_post_meta( 'gp', get_the_ID(), 'hub_review_custom_title' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'hub_review_layout' ) == 'default' ? $global['review_layout'] : redux_post_meta( 'gp', get_the_ID(), 'hub_review_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'hub_review_sidebar' ) == 'default' ? $global['review_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'hub_review_sidebar' );
			
			$GLOBALS['ghostpool_sidebar_position'] = redux_post_meta( 'gp', get_the_ID(), 'hub_review_sidebar_position' ) == 'default' ? $global['review_sidebar_position'] : redux_post_meta( 'gp', get_the_ID(), 'hub_review_sidebar_position' );

			$global['review_rating_criteria'] = isset( $global['review_rating_criteria'][1] ) ? $global['review_rating_criteria'] : '';
			$multi_criteria = redux_post_meta( 'gp', get_the_ID(), 'hub_review_rating_criteria' );
			$GLOBALS['ghostpool_rating_criteria'] = isset( $multi_criteria[1] ) ? $multi_criteria : $global['review_rating_criteria'];
			
			$GLOBALS['ghostpool_hub_details'] = $global['review_details'];
			
			$GLOBALS['ghostpool_hub_synopsis'] = redux_post_meta( 'gp', get_the_ID(), 'hub_review_synopsis' );

			$GLOBALS['ghostpool_good_points'] = redux_post_meta( 'gp', get_the_ID(), 'hub_review_good_points' );
			
			$GLOBALS['ghostpool_bad_points'] = redux_post_meta( 'gp', get_the_ID(), 'hub_review_bad_points' );
									
			
		/*--------------------------------------------------------------
		Review Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'review-template.php' ) ) {

			$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'review_title' ) == 'default' ? $global['review_title'] : redux_post_meta( 'gp', get_the_ID(), 'review_title' );
			
			$GLOBALS['ghostpool_title_header_format'] = redux_post_meta( 'gp', get_the_ID(), 'review_title_header_format' ) == 'default' ? $global['review_title_header_format'] : redux_post_meta( 'gp', get_the_ID(), 'review_title_header_format' );
			
			$GLOBALS['ghostpool_page_header_text'] = redux_post_meta( 'gp', get_the_ID(), 'review_title_text' );
			
			$GLOBALS['ghostpool_custom_title'] = redux_post_meta( 'gp', get_the_ID(), 'review_custom_title' );
			
			$GLOBALS['ghostpool_subtitle'] = redux_post_meta( 'gp', get_the_ID(), 'review_subtitle' );
			
			$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'review_title_bg' );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'review_title_teaser_video_bg' );
			
			$GLOBALS['ghostpool_full_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'review_title_full_video_bg' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'review_layout' ) == 'default' ? $global['review_layout'] : redux_post_meta( 'gp', get_the_ID(), 'review_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'review_sidebar' ) == 'default' ? $global['review_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'review_sidebar' );
			
			$GLOBALS['ghostpool_sidebar_position'] = redux_post_meta( 'gp', get_the_ID(), 'review_sidebar_position' ) == 'default' ? $global['review_sidebar_position'] : redux_post_meta( 'gp', get_the_ID(), 'review_sidebar_position' );

			$GLOBALS['ghostpool_hub_featured_image'] = $global['review_featured_image'];

			$GLOBALS['ghostpool_hub_image_height'] = $global['review_image']['width'];

			$GLOBALS['ghostpool_hub_image_width'] = $global['review_image']['height'];

			$GLOBALS['ghostpool_hub_hard_crop'] = $global['review_hard_crop'];
			
			$GLOBALS['ghostpool_header_cats'] = isset( $global['review_header_cats'] ) ? $global['review_header_cats'] : '';

			$GLOBALS['ghostpool_header_fields'] = isset( $global['review_header_fields'] ) ? $global['review_header_fields'] : '';

			$GLOBALS['ghostpool_header_avatar'] = $global['review_meta']['avatar'];
			
			$GLOBALS['ghostpool_header_author_date'] = $global['review_meta']['author_date'];
			
			$GLOBALS['ghostpool_display_site_rating'] = $global['review_header_display_rating']['site_rating'];

			$GLOBALS['ghostpool_display_user_rating'] = $global['review_header_display_rating']['user_rating'];
	
			$GLOBALS['ghostpool_affiliate_button_link'] = get_post_meta( get_the_ID(), 'review_affiliate_button_link', true ) ? get_post_meta( get_the_ID(), 'review_affiliate_button_link', true ) : get_post_meta( $post->post_parent, 'hub_affiliate_button_link', true ); // Use parent hub affiliate link if review link left empty

			$affiliate_text = get_post_meta( $post->post_parent, 'hub_affiliate_button_text', true ) ? get_post_meta( $post->post_parent, 'hub_affiliate_button_text', true ) : $global['hub_affiliate_button_text'];		
			$GLOBALS['ghostpool_affiliate_button_text'] = get_post_meta( get_the_ID(), 'review_affiliate_button_text', true ) ? get_post_meta( get_the_ID(), 'review_affiliate_button_text', true ) : $affiliate_text; // Use parent hub affiliate text if review text left empty
							
			$GLOBALS['ghostpool_hub_details'] = $global['review_details'];

			$GLOBALS['ghostpool_hub_synopsis'] = get_post_meta( $post->post_parent, 'hub_synopsis', true );
			
			$GLOBALS['ghostpool_good_points'] = redux_post_meta( 'gp', get_the_ID(), 'review_good_points' );
			
			$GLOBALS['ghostpool_bad_points'] = redux_post_meta( 'gp', get_the_ID(), 'review_bad_points' );
						
			$GLOBALS['ghostpool_user_rating_box'] = redux_post_meta( 'gp', get_the_ID(), 'review_user_rating' ) == 'default' ? $global['review_user_rating'] : redux_post_meta( 'gp', get_the_ID(), 'review_user_rating' );
			
			$global['review_rating_criteria'] = isset( $global['review_rating_criteria'][1] ) ? $global['review_rating_criteria'] : '';
			$multi_criteria = redux_post_meta( 'gp', get_the_ID(), 'review_rating_criteria' );
			$GLOBALS['ghostpool_rating_criteria'] = isset( $multi_criteria[1] ) ? $multi_criteria : $global['review_rating_criteria'];


		/*--------------------------------------------------------------
		News Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'news-template.php' ) )  {

			$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ? $global['hub_title'] : redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'news_layout' ) == 'default' ? $global['news_layout'] : redux_post_meta( 'gp', get_the_ID(), 'news_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'news_sidebar' ) == 'default' ? $global['news_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'news_sidebar' );
	
	
		/*--------------------------------------------------------------
		Images Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'images-template.php' ) )  {

			$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ? $global['hub_title'] : redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'images_layout' ) == 'default' ? $global['images_layout'] : redux_post_meta( 'gp', get_the_ID(), 'images_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'images_sidebar' ) == 'default' ? $global['images_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'images_sidebar' );

	
		/*--------------------------------------------------------------
		Videos Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'videos-template.php' ) )  {

			$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ? $global['hub_title'] : redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'videos_layout' ) == 'default' ? $global['videos_layout'] : redux_post_meta( 'gp', get_the_ID(), 'videos_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'videos_sidebar' ) == 'default' ? $global['videos_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'videos_sidebar' );


		/*--------------------------------------------------------------
		Write A Review Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'write-a-review-template.php' ) )  {

			$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ? $global['hub_title'] : redux_post_meta( 'gp', get_the_ID(), 'hub_title' );		
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'write_a_review_layout' ) == 'default' ? $global['write_a_review_layout'] : redux_post_meta( 'gp', get_the_ID(), 'write_a_review_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'write_a_review_sidebar' ) == 'default' ? $global['write_a_review_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'write_a_review_sidebar' );


		/*--------------------------------------------------------------
		Edit A Review Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'edit-a-review-template.php' ) )  {

			$GLOBALS['ghostpool_page_header'] = $global['hub_title'];
			
			$GLOBALS['ghostpool_page_header_text'] = 'enabled';
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'write_a_review_layout' ) == 'default' ? 
			$global['write_a_review_layout'] : redux_post_meta( 'gp', get_the_ID(), 'write_a_review_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'write_a_review_sidebar' ) == 'default' ? $global['write_a_review_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'write_a_review_sidebar' );


		/*--------------------------------------------------------------
		User Reviews Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'user-reviews-template.php' ) )  {

			if ( redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];
			} else {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			}
	
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'user_reviews_layout' ) == 'default' ? $global['user_reviews_layout'] : redux_post_meta( 'gp', get_the_ID(), 'user_reviews_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'user_reviews_sidebar' ) == 'default' ? $global['user_reviews_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'user_reviews_sidebar' );


		/*--------------------------------------------------------------
		My Reviews Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'my-reviews-template.php' ) )  {

			if ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' && redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' && redux_post_meta( 'gp', $post->post_parent, 'review_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];	
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'review_title' );
			} else {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_title' );
			}

			$GLOBALS['ghostpool_page_header_text'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_title_text' );
			
			$GLOBALS['ghostpool_custom_title'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_custom_title' );
			
			$GLOBALS['ghostpool_subtitle'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_subtitle' );
			
			$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_title_bg' );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_title_teaser_video_bg' );
			
			$GLOBALS['ghostpool_full_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_title_full_video_bg' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'my_reviews_sidebar' );
						

		/*--------------------------------------------------------------
		Blank page
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'blank-page-template.php' ) ) {

			$GLOBALS['ghostpool_page_header'] = apply_filters( 'gp_blank_page_header', 'gp-no-large-title' );
			
			$GLOBALS['ghostpool_layout'] = apply_filters( 'gp_blank_layout', 'gp-no-sidebar' );
	
			$GLOBALS['ghostpool_sidebar'] = apply_filters( 'gp_blank_sidebar', 'gp-standard-sidebar' );
			

		/*--------------------------------------------------------------
		Attachment page
		--------------------------------------------------------------*/

		} elseif ( is_attachment() ) {

			$GLOBALS['ghostpool_page_header'] = apply_filters( 'gp_attachment_page_header', 'gp-no-large-title' );
			
			$GLOBALS['ghostpool_layout'] = apply_filters( 'gp_attachment_layout', 'gp-no-sidebar' );
	
			$GLOBALS['ghostpool_sidebar'] = apply_filters( 'gp_attachment_sidebar', 'gp-standard-sidebar' );
	
			
		/*--------------------------------------------------------------
		Error 404 page
		--------------------------------------------------------------*/

		} elseif ( is_404() ) {

			$GLOBALS['ghostpool_page_header'] = apply_filters( 'gp_error_page_header', 'gp-no-large-title' );
			
			$GLOBALS['ghostpool_layout'] = apply_filters( 'gp_error_layout', 'gp-no-sidebar' );
	
			$GLOBALS['ghostpool_sidebar'] = apply_filters( 'gp_error_left_sidebar', 'gp-standard-sidebar' );
	

		/*--------------------------------------------------------------
		Posts
		--------------------------------------------------------------*/

		} elseif ( is_singular( 'post' ) ) {

			if ( get_post_meta( get_the_ID(), 'primary_hub', true ) ) {
				$post_id = get_post_meta( get_the_ID(), 'primary_hub', true );
			} elseif ( get_post_meta( get_the_ID(), 'post_association', true ) ) {
				$post_id = get_post_meta( get_the_ID(), 'post_association', true );
				$post_id = $post_id[0];		
			} else {
				$post_id = '';
			}
	
			if ( get_post_meta( get_the_ID(), 'post_association', true ) && $global['hub_header_posts'] == 'enabled' && get_post_meta( $post_id, 'hub_title', true ) ) {
				$GLOBALS['ghostpool_page_header'] = get_post_meta( $post_id, 'hub_title', true );
			} elseif ( get_post_meta( get_the_ID(), 'post_association', true ) && $global['hub_header_posts'] == 'enabled' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];
			} else {
				$GLOBALS['ghostpool_page_header'] = 'gp-no-large-title';
			}
			
			$GLOBALS['ghostpool_page_header_text'] = redux_post_meta( 'gp', get_the_ID(), 'post_title_text' );
			
			$GLOBALS['ghostpool_custom_title'] = redux_post_meta( 'gp', get_the_ID(), 'post_custom_title' );
			
			$GLOBALS['ghostpool_subtitle'] = redux_post_meta( 'gp', get_the_ID(), 'post_subtitle' );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'post_title_teaser_video_bg' );
			
			$GLOBALS['ghostpool_full_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'post_title_full_video_bg' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'post_layout' ) == 'default' ? $global['post_layout'] : redux_post_meta( 'gp', get_the_ID(), 'post_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'post_sidebar' ) == 'default' ? $global['post_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'post_sidebar' );


		/*--------------------------------------------------------------
		User Reviews
		--------------------------------------------------------------*/

		} elseif ( is_singular( 'gp_user_review' ) ) {

			$post_id = get_post_meta( get_the_ID(), '_hub_page_id', true );

			$GLOBALS['ghostpool_page_header'] = get_post_meta( $post_id, 'hub_title', true );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'post_layout' ) == 'default' ? $global['post_layout'] : redux_post_meta( 'gp', get_the_ID(), 'post_layout' );
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'post_sidebar' ) == 'default' ? $global['post_sidebar'] : redux_post_meta( 'gp', get_the_ID(), 'post_sidebar' );
	
	
		/*--------------------------------------------------------------
		Slides
		--------------------------------------------------------------*/

		} elseif ( is_singular( 'gp_slide' ) ) {

			$GLOBALS['ghostpool_page_header'] = apply_filters( 'gp_slides_page_header', 'gp-no-large-title' );
			
			$GLOBALS['ghostpool_layout'] = apply_filters( 'gp_slides_layout', 'gp-no-sidebar' );
	
			$GLOBALS['ghostpool_sidebar'] = apply_filters( 'gp_slides_sidebar', 'gp-standard-sidebar' );
	
	
		/*--------------------------------------------------------------
		Pages
		--------------------------------------------------------------*/

		} else {

			if ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' && redux_post_meta( 'gp', $post->post_parent, 'hub_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' && redux_post_meta( 'gp', $post->post_parent, 'review_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['hub_title'];	
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'hub_title' );
			} elseif ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'review_title' );
			} elseif ( redux_post_meta( 'gp', get_the_ID(), 'page_title' ) == 'default' ) {
				$GLOBALS['ghostpool_page_header'] = $global['page_title'];
			} else {
				$GLOBALS['ghostpool_page_header'] = redux_post_meta( 'gp', get_the_ID(), 'page_title' );
			}

			$GLOBALS['ghostpool_page_header_text'] = redux_post_meta( 'gp', get_the_ID(), 'page_title_text' );
			
			$GLOBALS['ghostpool_custom_title'] = redux_post_meta( 'gp', get_the_ID(), 'page_custom_title' );
			
			$GLOBALS['ghostpool_subtitle'] = redux_post_meta( 'gp', get_the_ID(), 'page_subtitle' );
			
			$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'page_title_bg' );
			
			$GLOBALS['ghostpool_teaser_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'page_title_teaser_video_bg' );
			
			$GLOBALS['ghostpool_full_video_bg'] = redux_post_meta( 'gp', get_the_ID(), 'page_title_full_video_bg' );
			
			$GLOBALS['ghostpool_layout'] = redux_post_meta( 'gp', get_the_ID(), 'page_layout' ) && redux_post_meta( 'gp', get_the_ID(), 'page_layout' ) != 'default' ? redux_post_meta( 'gp', get_the_ID(), 'page_layout' ) : $global['page_layout'];
			
			$GLOBALS['ghostpool_sidebar'] = redux_post_meta( 'gp', get_the_ID(), 'page_sidebar' ) && redux_post_meta( 'gp', get_the_ID(), 'page_sidebar' ) != 'default' ? redux_post_meta( 'gp', get_the_ID(), 'page_sidebar' ) : $global['page_sidebar'];
			
		}
		

		/*--------------------------------------------------------------
		Add init variables via your child theme using this function
		--------------------------------------------------------------*/

		if ( function_exists( 'ghostpool_custom_init_variables' ) ) {
			ghostpool_custom_init_variables();
		}
		
	}
}

?>