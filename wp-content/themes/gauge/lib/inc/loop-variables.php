<?php

if ( ! function_exists( 'ghostpool_loop_variables' ) ) {
	function ghostpool_loop_variables() {

		global $gp;
		$gp_global = get_option( 'gp' );

		
		/*--------------------------------------------------------------
		Portfolio Categories
		--------------------------------------------------------------*/

		if ( is_post_type_archive( 'gp_portfolio_item' ) OR is_tax( 'gp_portfolios' ) )  {

			// Get category option
			$gp_term_data = null;
			if ( isset( get_queried_object()->term_id ) ) {
				$gp_term_id = get_queried_object()->term_id;
				$gp_term_data = get_option( "taxonomy_$gp_term_id" );
			}	
		
			$GLOBALS['ghostpool_format'] = ! isset( $gp_term_data['format'] ) || $gp_term_data['format'] == 'default' ? $gp_global['portfolio_cat_format'] : $gp_term_data['format'];
		
			$GLOBALS['ghostpool_orderby'] = $gp_global['portfolio_cat_orderby'];
		
			$GLOBALS['ghostpool_date_posted'] = $gp_global['portfolio_cat_date_posted'];
		
			$GLOBALS['ghostpool_date_modified'] = $gp_global['portfolio_cat_date_modified'];			
		
			$GLOBALS['ghostpool_filter'] = $gp_global['portfolio_cat_filter'];
		
			$GLOBALS['ghostpool_per_page'] = $gp_global['portfolio_cat_per_page'];
		
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';
		
				
		/*--------------------------------------------------------------
		Portfolio Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'portfolio-template.php' ) )  {

			$GLOBALS['ghostpool_cats'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_cats' ) ? implode( ',', redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_cats' ) ) : '';			
			
			$GLOBALS['ghostpool_format'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_format' ) ? redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_format' ) : '';

		
			$GLOBALS['ghostpool_orderby'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_orderby' ) ? redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_orderby' ) : '';
			
			$GLOBALS['ghostpool_filter'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_filter' ) ? redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_filter' ) : '';
			
			$GLOBALS['ghostpool_date_posted'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_date_posted' ) ? redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_date_posted' ) : '';
			
			$GLOBALS['ghostpool_date_modified'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_date_modified' ) ? redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_date_modified' ) : '';
			
			$GLOBALS['ghostpool_per_page'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_per_page' ) ? redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_per_page' ) : '';
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';


		/*--------------------------------------------------------------
		Portfolio Items
		--------------------------------------------------------------*/

		} elseif ( is_singular( 'gp_portfolio_item' ) ) {
	
			$gp_image = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_image' );
			
			$GLOBALS['ghostpool_image_width'] = ! empty( $gp_image['width'] ) ? $gp_image['width'] : $gp_global['portfolio_item_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = ! empty( $gp_image['height'] ) ? $gp_image['height'] : $gp_global['portfolio_item_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_hard_crop' ) == 'default' ? $gp_global['portfolio_item_hard_crop'] : redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_hard_crop' );			
			
			$GLOBALS['ghostpool_type'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_type' ) == 'default' ? $gp_global['portfolio_item_type'] : redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_type' );
			
			$GLOBALS['ghostpool_image_size'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_image_size' ) == 'default' ? $gp_global['portfolio_item_image_size'] : redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_image_size' );
			
			$GLOBALS['ghostpool_link_target'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_link_target' ) == 'default' ? $gp_global['portfolio_item_link_target'] : redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_link_target' );
			
			$GLOBALS['ghostpool_link_text'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_link_text' ) == '' ? $gp_global['portfolio_item_link_text'] : redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_link_text' );


		/*--------------------------------------------------------------
		Video Categories
		--------------------------------------------------------------*/

		} elseif ( is_tax( 'gp_videos' ) ) {

			// Get category option
			$gp_term_data = null;
			if ( isset( get_queried_object()->term_id ) ) {
				$gp_term_id = get_queried_object()->term_id;
				$gp_term_data = get_option( "taxonomy_$gp_term_id" );
			}
		
			$GLOBALS['ghostpool_format'] = ! isset( $gp_term_data['format'] ) || $gp_term_data['format'] == 'default' ? $gp_global['video_cat_format'] : $gp_term_data['format'];
			
			$GLOBALS['ghostpool_orderby'] = $gp_global['video_cat_orderby'];
			
			$GLOBALS['ghostpool_date_posted'] = $gp_global['video_cat_date_posted'];
			
			$GLOBALS['ghostpool_date_modified'] = $gp_global['video_cat_date_modified'];
			
			$GLOBALS['ghostpool_filter'] = $gp_global['video_cat_filter'];
			
			$GLOBALS['ghostpool_filter_date'] = $gp_global['video_cat_filter_options']['date'];
			
			$GLOBALS['ghostpool_filter_title'] = $gp_global['video_cat_filter_options']['title'];
			
			$GLOBALS['ghostpool_filter_comment_count'] = $gp_global['video_cat_filter_options']['comment_count'];
			
			$GLOBALS['ghostpool_filter_views'] = $gp_global['video_cat_filter_options']['views'];
			
			$GLOBALS['ghostpool_filter_date_posted'] = $gp_global['video_cat_filter_options']['date_posted'];
			
			$GLOBALS['ghostpool_filter_date_modified'] = $gp_global['video_cat_filter_options']['date_modified'];
			
			$GLOBALS['ghostpool_per_page'] = $gp_global['video_cat_per_page'];
			
			$GLOBALS['ghostpool_featured_image'] = $gp_global['video_cat_featured_image'];
			
			$GLOBALS['ghostpool_image_width'] = $gp_global['video_cat_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = $gp_global['video_cat_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = $gp_global['video_cat_hard_crop'];
			
			$GLOBALS['ghostpool_image_alignment'] = $gp_global['video_cat_image_alignment'];
			
			$GLOBALS['ghostpool_title_position'] = $gp_global['video_cat_title_position'];
			
			$GLOBALS['ghostpool_content_display'] = $gp_global['video_cat_content_display'];
			
			$GLOBALS['ghostpool_excerpt_length'] = $gp_global['video_cat_excerpt_length'];
			
			$GLOBALS['ghostpool_meta_author'] = $gp_global['video_cat_meta']['author'];
			
			$GLOBALS['ghostpool_meta_date'] = $gp_global['video_cat_meta']['date'];
			
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['video_cat_meta']['comment_count'];
					
			$GLOBALS['ghostpool_meta_views'] = $gp_global['video_cat_meta']['views'];
			
			$GLOBALS['ghostpool_meta_cats'] = $gp_global['video_cat_meta']['cats'];
			
			$GLOBALS['ghostpool_meta_tags'] = $gp_global['video_cat_meta']['tags'];
			
			$GLOBALS['ghostpool_read_more_link'] = $gp_global['video_cat_read_more_link'];
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';
	
		
		/*--------------------------------------------------------------
		Hub Categories
		--------------------------------------------------------------*/

		} elseif ( is_tax() ) {

			// Get category option
			$gp_term_data = null;
			if ( isset( get_queried_object()->term_id ) ) {
				$gp_term_id = get_queried_object()->term_id;
				$gp_term_data = get_option( "taxonomy_$gp_term_id" );
			}
		
			$GLOBALS['ghostpool_format'] = ! isset( $gp_term_data['format'] ) || $gp_term_data['format'] == 'default' ? $gp_global['hub_cat_format'] : $gp_term_data['format'];
			
			$GLOBALS['ghostpool_orderby'] = $gp_global['hub_cat_orderby'];
			
			$GLOBALS['ghostpool_date_posted'] = $gp_global['hub_cat_date_posted'];
			
			$GLOBALS['ghostpool_date_modified'] = $gp_global['hub_cat_date_modified'];
			
			$GLOBALS['ghostpool_filter'] = $gp_global['hub_cat_filter'];
			
			$GLOBALS['ghostpool_filter_date'] = $gp_global['hub_cat_filter_options']['date'];
			
			$GLOBALS['ghostpool_filter_title'] = $gp_global['hub_cat_filter_options']['title'];
			
			$GLOBALS['ghostpool_filter_comment_count'] = $gp_global['hub_cat_filter_options']['comment_count'];
			
			$GLOBALS['ghostpool_filter_views'] = $gp_global['hub_cat_filter_options']['views'];
			
			$GLOBALS['ghostpool_filter_followers'] = $gp_global['hub_cat_filter_options']['followers'];
			
			$GLOBALS['ghostpool_filter_site_rating'] = $gp_global['hub_cat_filter_options']['site_rating'];
			
			$GLOBALS['ghostpool_filter_user_rating'] = $gp_global['hub_cat_filter_options']['user_rating'];
			
			$GLOBALS['ghostpool_filter_hub_awards'] = $gp_global['hub_cat_filter_options']['hub_awards'];
			
			$GLOBALS['ghostpool_filter_date_posted'] = $gp_global['hub_cat_filter_options']['date_posted'];
			
			$GLOBALS['ghostpool_filter_date_modified'] = $gp_global['hub_cat_filter_options']['date_modified'];
			
			$GLOBALS['ghostpool_per_page'] = $gp_global['hub_cat_per_page'];
			
			$GLOBALS['ghostpool_featured_image'] = $gp_global['hub_cat_featured_image'];
			
			$GLOBALS['ghostpool_image_width'] = $gp_global['hub_cat_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = $gp_global['hub_cat_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = $gp_global['hub_cat_hard_crop'];
			
			$GLOBALS['ghostpool_image_alignment'] = $gp_global['hub_cat_image_alignment'];
			
			$GLOBALS['ghostpool_title_position'] = $gp_global['hub_cat_title_position'];
			
			$GLOBALS['ghostpool_content_display'] = $gp_global['hub_cat_content_display'];
			
			$GLOBALS['ghostpool_excerpt_length'] = $gp_global['hub_cat_excerpt_length'];
			
			$GLOBALS['ghostpool_meta_author'] = $gp_global['hub_cat_meta']['author'];
			
			$GLOBALS['ghostpool_meta_date'] = $gp_global['hub_cat_meta']['date'];
			
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['hub_cat_meta']['comment_count'];	
			
			$GLOBALS['ghostpool_meta_views'] = $gp_global['hub_cat_meta']['views'];
			
			$GLOBALS['ghostpool_meta_followers'] = $gp_global['hub_cat_meta']['followers'];		
			$GLOBALS['ghostpool_meta_tags'] = $gp_global['hub_cat_meta']['tags'];	
			
			$GLOBALS['ghostpool_meta_hub_cats'] = $gp_global['hub_cat_meta']['hub_cats'];
			
			$GLOBALS['ghostpool_meta_hub_fields'] = $gp_global['hub_cat_meta']['hub_fields'];
			
			$GLOBALS['ghostpool_meta_hub_award'] = $gp_global['hub_cat_meta']['hub_award'];	
			
			$GLOBALS['ghostpool_hub_cats_selected'] = isset( $gp_global['hub_cat_cats'] ) ? 
			$gp_global['hub_cat_cats'] : '';
			
			$GLOBALS['ghostpool_hub_fields'] = isset( $gp_global['hub_cat_fields'] ) ? $gp_global['hub_cat_fields'] 
			: '';			
			$GLOBALS['ghostpool_display_site_rating'] = $gp_global['hub_cat_display_rating']['site_rating'];
			
			$GLOBALS['ghostpool_display_user_rating'] = $gp_global['hub_cat_display_rating']['user_rating'];	
			
			$GLOBALS['ghostpool_read_more_link'] = $gp_global['hub_cat_read_more_link'];
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';

		/*--------------------------------------------------------------
		Search/Author Results
		--------------------------------------------------------------*/

		} elseif ( is_search() or is_author() ) {
		
			$GLOBALS['ghostpool_format'] = $gp_global['search_format'];
		
			$GLOBALS['ghostpool_orderby'] = $gp_global['search_orderby'];
		
			$GLOBALS['ghostpool_date_posted'] = $gp_global['search_date_posted'];
		
			$GLOBALS['ghostpool_date_modified'] = $gp_global['search_date_modified'];
		
			$GLOBALS['ghostpool_filter'] = $gp_global['search_filter'];
		
			$GLOBALS['ghostpool_filter_date'] = $gp_global['search_filter_options']['date'];
		
			$GLOBALS['ghostpool_filter_title'] = $gp_global['search_filter_options']['title'];
		
			$GLOBALS['ghostpool_filter_comment_count'] = $gp_global['search_filter_options']['comment_count'];
		
			$GLOBALS['ghostpool_filter_views'] = $gp_global['search_filter_options']['views'];
		
			$GLOBALS['ghostpool_filter_followers'] = $gp_global['search_filter_options']['followers'];
		
			$GLOBALS['ghostpool_filter_site_rating'] = $gp_global['search_filter_options']['site_rating'];
		
			$GLOBALS['ghostpool_filter_user_rating'] = $gp_global['search_filter_options']['user_rating'];
		
			$GLOBALS['ghostpool_filter_hub_awards'] = $gp_global['search_filter_options']['hub_awards'];
		
			$GLOBALS['ghostpool_filter_date_posted'] = $gp_global['search_filter_options']['date_posted'];
		
			$GLOBALS['ghostpool_filter_date_modified'] = $gp_global['search_filter_options']['date_modified'];
		
			$GLOBALS['ghostpool_per_page'] = $gp_global['search_per_page'];
		
			$GLOBALS['ghostpool_featured_image'] = $gp_global['search_featured_image'];
		
			$GLOBALS['ghostpool_image_width'] = $gp_global['search_image']['width'];
		
			$GLOBALS['ghostpool_image_height'] = $gp_global['search_image']['height'];
		
			$GLOBALS['ghostpool_hard_crop'] = $gp_global['search_hard_crop'];
		
			$GLOBALS['ghostpool_image_alignment'] = $gp_global['search_image_alignment'];
		
			$GLOBALS['ghostpool_title_position'] = $gp_global['search_title_position'];
		
			$GLOBALS['ghostpool_content_display'] = $gp_global['search_content_display'];
		
			$GLOBALS['ghostpool_excerpt_length'] = $gp_global['search_excerpt_length'];
		
			$GLOBALS['ghostpool_meta_author'] = $gp_global['search_meta']['author'];
		
			$GLOBALS['ghostpool_meta_date'] = $gp_global['search_meta']['date'];
		
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['search_meta']['comment_count'];
		
			$GLOBALS['ghostpool_meta_views'] = $gp_global['search_meta']['views'];
		
			$GLOBALS['ghostpool_meta_followers'] = $gp_global['search_meta']['followers'];	
		
			$GLOBALS['ghostpool_meta_cats'] = $gp_global['search_meta']['cats'];
		
			$GLOBALS['ghostpool_meta_tags'] = $gp_global['search_meta']['tags'];
		
			$GLOBALS['ghostpool_meta_hub_cats'] = $gp_global['search_meta']['hub_cats'];
		
			$GLOBALS['ghostpool_meta_hub_fields'] = $gp_global['search_meta']['hub_fields'];
		
			$GLOBALS['ghostpool_meta_hub_award'] = $gp_global['search_meta']['hub_award'];
		
			$GLOBALS['ghostpool_hub_cats_selected'] = isset( $gp_global['search_cats'] ) ? $gp_global['search_cats'] : '';
		
			$GLOBALS['ghostpool_hub_fields'] = isset( $gp_global['search_fields'] ) ? $gp_global['search_fields'] : '';
		
			$GLOBALS['ghostpool_display_site_rating'] = $gp_global['search_display_rating']['site_rating'];
		
			$GLOBALS['ghostpool_display_user_rating'] = $gp_global['search_display_rating']['user_rating'];		
		
			$GLOBALS['ghostpool_read_more_link'] = $gp_global['search_read_more_link'];	
		
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';
		
			
		/*--------------------------------------------------------------
		Post Categories, Archives & Tags
		--------------------------------------------------------------*/

		} elseif ( is_home() OR is_archive() ) {

			// Get category option
			$gp_term_data = null;
			if ( isset( get_queried_object()->term_id ) ) {
				$gp_term_id = get_queried_object()->term_id;
				$gp_term_data = get_option( "taxonomy_$gp_term_id" );
			}

			$GLOBALS['ghostpool_format'] = ! isset( $gp_term_data['format'] ) || $gp_term_data['format'] == 'default' ? $gp_global['cat_format'] : $gp_term_data['format'];
			
			$GLOBALS['ghostpool_filter'] = $gp_global['cat_filter'];
			
			$GLOBALS['ghostpool_orderby'] = $gp_global['cat_orderby'];
			
			$GLOBALS['ghostpool_date_posted'] = $gp_global['cat_date_posted'];
			
			$GLOBALS['ghostpool_date_modified'] = $gp_global['cat_date_modified'];
			
			$GLOBALS['ghostpool_filter_date'] = $gp_global['cat_filter_options']['date'];
			
			$GLOBALS['ghostpool_filter_title'] = $gp_global['cat_filter_options']['title'];
			
			$GLOBALS['ghostpool_filter_comment_count'] = $gp_global['cat_filter_options']['comment_count'];
			
			$GLOBALS['ghostpool_filter_views'] = $gp_global['cat_filter_options']['views'];
			
			$GLOBALS['ghostpool_filter_date_posted'] = $gp_global['cat_filter_options']['date_posted'];
			
			$GLOBALS['ghostpool_filter_date_modified'] = $gp_global['cat_filter_options']['date_modified'];
			
			$GLOBALS['ghostpool_per_page'] = $gp_global['cat_per_page'];
			
			$GLOBALS['ghostpool_featured_image'] = $gp_global['cat_featured_image'];
			
			$GLOBALS['ghostpool_image_width'] = $gp_global['cat_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = $gp_global['cat_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = $gp_global['cat_hard_crop'];
			
			$GLOBALS['ghostpool_image_alignment'] = $gp_global['cat_image_alignment'];
			
			$GLOBALS['ghostpool_title_position'] = $gp_global['cat_title_position'];
			
			$GLOBALS['ghostpool_content_display'] = $gp_global['cat_content_display'];
			
			$GLOBALS['ghostpool_excerpt_length'] = $gp_global['cat_excerpt_length'];
			
			$GLOBALS['ghostpool_meta_author'] = $gp_global['cat_meta']['author'];
			
			$GLOBALS['ghostpool_meta_date'] = $gp_global['cat_meta']['date'];
			
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['cat_meta']['comment_count'];
			
			$GLOBALS['ghostpool_meta_views'] = $gp_global['cat_meta']['views'];
			$GLOBALS['ghostpool_meta_cats'] = $gp_global['cat_meta']['cats'];
			
			$GLOBALS['ghostpool_meta_tags'] = $gp_global['cat_meta']['tags'];
			
			$GLOBALS['ghostpool_read_more_link'] = $gp_global['cat_read_more_link'];
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';	
		
					
		/*--------------------------------------------------------------
		Blog Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'blog-template.php' ) )  {

			$GLOBALS['ghostpool_cats'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_cats' ) ? implode( ',', redux_post_meta( 'gp', get_the_ID(), 'blog_template_cats' ) ) : '';	
			
			$GLOBALS['ghostpool_post_types'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_post_types' ) ? implode( ',', redux_post_meta( 'gp', get_the_ID(), 'blog_template_post_types' ) ) : '';
			
			$GLOBALS['ghostpool_format'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_format' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_format' ) : '';
			
			$GLOBALS['ghostpool_orderby'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_orderby' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_orderby' ) : '';				
			
			$GLOBALS['ghostpool_date_posted'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_date_posted' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_date_posted' ) : '';	
			
			$GLOBALS['ghostpool_date_modified'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_date_modified' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_date_modified' ) : '';
			
			$GLOBALS['ghostpool_filter'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_filter' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_filter' ) : '';
			$filter_options = redux_post_meta( 'gp', get_the_ID(), 'blog_template_filter_options' );		
			
			$GLOBALS['ghostpool_filter_cats'] = isset( $filter_options['cats'] ) ? $filter_options['cats'] : '';	
			
			$GLOBALS['ghostpool_filter_date'] = isset( $filter_options['date'] ) ? $filter_options['date'] : '';	
			
			$GLOBALS['ghostpool_filter_title'] = isset( $filter_options['title'] ) ? $filter_options['title'] : '';	
			
			$GLOBALS['ghostpool_filter_comment_count'] = isset( $filter_options['comment_count'] ) ? 
			$filter_options['comment_count'] : '';	
			
			$GLOBALS['ghostpool_filter_views'] = isset( $filter_options['views'] ) ? $filter_options['views'] : '';		
			
			$GLOBALS['ghostpool_filter_followers'] = isset( $filter_options['followers'] ) ? 
			$filter_options['followers'] : '';	
			
			$GLOBALS['ghostpool_filter_site_rating'] = isset( $filter_options['site_rating'] ) ? 
			$filter_options['site_rating'] : '';	
			
			$GLOBALS['ghostpool_filter_user_rating'] = isset( $filter_options['user_rating'] ) ? 
			$filter_options['user_rating'] : '';	
			
			$GLOBALS['ghostpool_filter_hub_awards'] = isset( $filter_options['hub_awards'] ) ? 
			$filter_options['hub_awards'] : '';
			
			$GLOBALS['ghostpool_filter_date_posted'] = isset( $filter_options['date_posted'] ) ? 
			$filter_options['date_posted'] : '';
			
			$GLOBALS['ghostpool_filter_date_modified'] = isset( $filter_options['date_modified'] ) ? $filter_options['date_modified'] : '';
			
			$GLOBALS['ghostpool_filter_cats_id'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_filter_cats_id' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_filter_cats_id' ) : '';				
			
			$GLOBALS['ghostpool_per_page'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_per_page' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_per_page' ) : '';
			
			$GLOBALS['ghostpool_featured_image'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_featured_image' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_featured_image' ) : '';
			$gp_image = redux_post_meta( 'gp', get_the_ID(), 'blog_template_image' );
			
			$GLOBALS['ghostpool_image_width'] = isset( $gp_image['width'] ) ? $gp_image['width'] : '';	
			
			$GLOBALS['ghostpool_image_height'] = isset( $gp_image['height'] ) ? $gp_image['height'] : '';	
			
			$GLOBALS['ghostpool_hard_crop'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_hard_crop' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_hard_crop' ) : '';	
			
			$GLOBALS['ghostpool_image_alignment'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_image_alignment' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_image_alignment' ) : '';	
			
			$GLOBALS['ghostpool_title_position'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_title_position' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_title_position' ) : '';	
			
			$GLOBALS['ghostpool_content_display'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_content_display' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_content_display' ) : '';	
			
			$GLOBALS['ghostpool_excerpt_length'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_excerpt_length' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_excerpt_length' ) : 0;	
			$meta = redux_post_meta( 'gp', get_the_ID(), 'blog_template_meta' );
			
			$GLOBALS['ghostpool_meta_author'] = isset( $meta['author'] ) ? $meta['author'] : '';	
			
			$GLOBALS['ghostpool_meta_date'] = isset( $meta['date'] ) ? $meta['date'] : '';
			
			$GLOBALS['ghostpool_meta_comment_count'] = isset( $meta['comment_count'] ) ? $meta['comment_count'] : '';	
			
			$GLOBALS['ghostpool_meta_views'] = isset( $meta['views'] ) ? $meta['views'] : '';
			
			$GLOBALS['ghostpool_meta_followers'] = isset( $meta['followers'] ) ? $meta['followers'] : '';	
			
			$GLOBALS['ghostpool_meta_cats'] = isset( $meta['cats'] ) ? $meta['cats'] : '';
			
			$GLOBALS['ghostpool_meta_tags'] = isset( $meta['tags'] ) ? $meta['tags'] : '';	
			
			$GLOBALS['ghostpool_meta_hub_cats'] = isset( $meta['hub_cats'] ) ? $meta['hub_cats'] : '';	
			
			$GLOBALS['ghostpool_meta_hub_fields'] = isset( $meta['hub_fields'] ) ? $meta['hub_fields'] : '';	
			
			$GLOBALS['ghostpool_meta_hub_award'] = isset( $meta['hub_award'] ) ? $meta['hub_award'] : '';
			$display_rating = redux_post_meta( 'gp', get_the_ID(), 'blog_template_display_rating' );
			
			$GLOBALS['ghostpool_hub_cats_selected'] = isset( $gp_global['hub_cat_cats'] ) ? $gp_global['hub_cat_cats'] : '';
			
			$GLOBALS['ghostpool_hub_fields'] = isset( $gp_global['hub_cat_fields'] ) ? $gp_global['hub_cat_fields'] : '';
			
			$GLOBALS['ghostpool_display_site_rating'] = isset( $display_rating['site_rating'] ) ? $display_rating['site_rating'] : '';
			
			$GLOBALS['ghostpool_display_user_rating'] = isset( $display_rating['user_rating'] ) ? $display_rating['user_rating'] : '';
			
			$GLOBALS['ghostpool_read_more_link'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_read_more_link' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_read_more_link' ) : '';					
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';	

		
		/*--------------------------------------------------------------
		Following Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'following-template.php' ) ) {

			$GLOBALS['ghostpool_format'] = 'blog-standard';
			
			$GLOBALS['ghostpool_featured_image'] = 'enabled';
			
			$GLOBALS['ghostpool_image_width'] = 75;
			
			$GLOBALS['ghostpool_image_height'] = 75;
			
			$GLOBALS['ghostpool_hard_crop'] = true;
			
			$GLOBALS['ghostpool_image_alignment'] = 'image-align-left';
			
			$GLOBALS['ghostpool_title_position'] = 'title-next-to-thumbnail';
			
			$GLOBALS['ghostpool_content_display'] = 'excerpt';
			
			$GLOBALS['ghostpool_excerpt_length'] = '0';
			
			$GLOBALS['ghostpool_meta_author'] = '0';
			
			$GLOBALS['ghostpool_meta_date'] = '0';
			
			$GLOBALS['ghostpool_meta_comment_count'] = '0';
			
			$GLOBALS['ghostpool_meta_views'] = '0';
			
			$GLOBALS['ghostpool_meta_followers'] = '1';
			
			$GLOBALS['ghostpool_meta_tags'] = '0';	
			
			$GLOBALS['ghostpool_meta_hub_cats'] = '';
			
			$GLOBALS['ghostpool_meta_hub_fields'] = '';
			
			$GLOBALS['ghostpool_meta_hub_award'] = '0';	
			
			$GLOBALS['ghostpool_display_site_rating'] = '0';
			
			$GLOBALS['ghostpool_display_user_rating'] = '0';	
			
			$GLOBALS['ghostpool_read_more_link'] = '0';
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';


		/*--------------------------------------------------------------
		FlexSlider Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'flexslider-template.php' ) )  {

			$GLOBALS['ghostpool_cats'] = redux_post_meta( 'gp', get_the_ID(), 'flexslider_cats' ) ? implode( ',', redux_post_meta( 'gp', get_the_ID(), 'flexslider_cats' ) ) : '';
			
			$GLOBALS['ghostpool_timeout'] = redux_post_meta( 'gp', get_the_ID(), 'flexslider_timeout' ) ? redux_post_meta( 'gp', get_the_ID(), 'flexslider_timeout' ) : '';
			
			$GLOBALS['ghostpool_side_gradient_overlay'] = redux_post_meta( 'gp', get_the_ID(), 'flexslider_side_gradient_overlay' ) ? redux_post_meta( 'gp', get_the_ID(), 'flexslider_side_gradient_overlay' ) : '';
			
			$GLOBALS['ghostpool_bottom_gradient_overlay'] = redux_post_meta( 'gp', get_the_ID(), 'flexslider_bottom_gradient_overlay' ) ? redux_post_meta( 'gp', get_the_ID(), 'flexslider_bottom_gradient_overlay' ) : '';
			
			$gp_image = redux_post_meta( 'gp', get_the_ID(), 'flexslider_dimensions' );
			
			$GLOBALS['ghostpool_slider_width'] = ! empty( $gp_image['width'] ) ? $gp_image['width'] : ghostpool_option( 'flexslider_dimensions', 'width' );
			
			$GLOBALS['ghostpool_slider_height'] = ! empty( $gp_image['height'] ) ? $gp_image['height'] : ghostpool_option( 'flexslider_dimensions', 'height' );
			
			$GLOBALS['ghostpool_per_page'] = redux_post_meta( 'gp', get_the_ID(), 'flexslider_per_page' ) ? redux_post_meta( 'gp', get_the_ID(), 'flexslider_per_page' ) : '';


		/*--------------------------------------------------------------
		Featured Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'featured-template.php' ) )  {

			$GLOBALS['ghostpool_cats'] = redux_post_meta( 'gp', get_the_ID(), 'featured_cats' ) ? implode( ',', redux_post_meta( 'gp', get_the_ID(), 'featured_cats' ) ) : '';
			
			$GLOBALS['ghostpool_side_gradient_overlay'] = redux_post_meta( 'gp', get_the_ID(), 'featured_side_gradient_overlay' ) ? redux_post_meta( 'gp', get_the_ID(), 'featured_side_gradient_overlay' ) : '';
			
			$GLOBALS['ghostpool_bottom_gradient_overlay'] = redux_post_meta( 'gp', get_the_ID(), 'featured_bottom_gradient_overlay' ) ? redux_post_meta( 'gp', get_the_ID(), 'featured_bottom_gradient_overlay' ) : '';
			
			$gp_image = redux_post_meta( 'gp', get_the_ID(), 'featured_dimensions' );
			
			$GLOBALS['ghostpool_slider_width'] = ! empty( $gp_image['width'] ) ? $gp_image['width'] : $gp_global['featured_dimensions']['width'];
			
			$GLOBALS['ghostpool_slider_height'] = ! empty( $gp_image['height'] ) ? $gp_image['height'] : $gp_global['featured_dimensions']['height'];
			
			$GLOBALS['ghostpool_per_page'] = redux_post_meta( 'gp', get_the_ID(), 'featured_per_page' ) ? redux_post_meta( 'gp', get_the_ID(), 'featured_per_page' ) : '';


		/*--------------------------------------------------------------
		Review Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'review-template.php' ) ) {
		
			$GLOBALS['ghostpool_display_site_rating'] = $gp_global['review_header_display_rating']['site_rating'];

			$GLOBALS['ghostpool_display_user_rating'] = $gp_global['review_header_display_rating']['user_rating'];
			
					
		/*--------------------------------------------------------------
		News Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'news-template.php' ) )  {

			$GLOBALS['ghostpool_cats'] = redux_post_meta( 'gp', get_the_ID(), 'news_cats' ) ? implode( ',', redux_post_meta( 'gp', get_the_ID(), 'news_cats' ) ) : '';			
			
			$GLOBALS['ghostpool_format'] = $gp_global['news_format'];
			
			$GLOBALS['ghostpool_orderby'] = isset( $gp_global['news_orderby'] ) ? $gp_global['news_orderby'] : 'date';
			
			$GLOBALS['ghostpool_date_posted'] = $gp_global['news_date_posted'];
			
			$GLOBALS['ghostpool_date_modified'] = $gp_global['news_date_modified'];
			
			$GLOBALS['ghostpool_filter'] = $gp_global['news_filter'];
			
			$GLOBALS['ghostpool_filter_cats'] = $gp_global['news_filter_options']['cats'];
			
			$GLOBALS['ghostpool_filter_date'] = $gp_global['news_filter_options']['date'];
			
			$GLOBALS['ghostpool_filter_title'] = $gp_global['news_filter_options']['title'];
			
			$GLOBALS['ghostpool_filter_comment_count'] = $gp_global['news_filter_options']['comment_count'];	
			
			$GLOBALS['ghostpool_filter_views'] = $gp_global['news_filter_options']['views'];
			
			$GLOBALS['ghostpool_filter_date_posted'] = $gp_global['news_filter_options']['date_posted'];	
			
			$GLOBALS['ghostpool_filter_date_modified'] = $gp_global['news_filter_options']['date_modified'];
			
			$GLOBALS['ghostpool_filter_cats_id'] = ghostpool_option( 'news_filter_cats_id' ) ? ghostpool_option( 'news_filter_cats_id' ) : '';
			
			$GLOBALS['ghostpool_per_page'] = $gp_global['news_per_page'];
			
			$GLOBALS['ghostpool_featured_image'] = $gp_global['news_featured_image'];
			
			$GLOBALS['ghostpool_image_width'] = $gp_global['news_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = $gp_global['news_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = $gp_global['news_hard_crop'];
			
			$GLOBALS['ghostpool_image_alignment'] = $gp_global['news_image_alignment'];
			
			$GLOBALS['ghostpool_title_position'] = $gp_global['news_title_position'];
			
			$GLOBALS['ghostpool_content_display'] = $gp_global['news_content_display'];
			
			$GLOBALS['ghostpool_excerpt_length'] = $gp_global['news_excerpt_length'];
			
			$GLOBALS['ghostpool_meta_author'] = $gp_global['news_meta']['author'];
			
			$GLOBALS['ghostpool_meta_date'] = $gp_global['news_meta']['date'];
			
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['news_meta']['comment_count'];
			
			$GLOBALS['ghostpool_meta_views'] = $gp_global['news_meta']['views'];
			
			$GLOBALS['ghostpool_meta_cats'] = $gp_global['news_meta']['cats'];
			
			$GLOBALS['ghostpool_meta_tags'] = $gp_global['news_meta']['tags'];
			
			$GLOBALS['ghostpool_read_more_link'] = $gp_global['news_read_more_link'];				
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';


		/*--------------------------------------------------------------
		Videos Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'videos-template.php' ) )  {

			$GLOBALS['ghostpool_cats'] = redux_post_meta( 'gp', get_the_ID(), 'videos_cats' ) ? implode( ',', redux_post_meta( 'gp', get_the_ID(), 'videos_cats' ) ) : '';
			
			$GLOBALS['ghostpool_format'] = $gp_global['videos_format'];
			
			$GLOBALS['ghostpool_orderby'] = isset( $gp_global['videos_orderby'] ) ? $gp_global['videos_orderby'] : 'date';
			
			$GLOBALS['ghostpool_date_posted'] = $gp_global['videos_date_posted'];	
			
			$GLOBALS['ghostpool_date_modified'] = $gp_global['videos_date_modified'];		
			
			$GLOBALS['ghostpool_filter'] = $gp_global['videos_filter'];
			
			$GLOBALS['ghostpool_filter_cats'] = $gp_global['videos_filter_options']['cats'];
			
			$GLOBALS['ghostpool_filter_date'] = $gp_global['videos_filter_options']['date'];
			
			$GLOBALS['ghostpool_filter_title'] = $gp_global['videos_filter_options']['title'];
			
			$GLOBALS['ghostpool_filter_comment_count'] = $gp_global['videos_filter_options']['comment_count'];
			
			$GLOBALS['ghostpool_filter_views'] = $gp_global['videos_filter_options']['views'];
			
			$GLOBALS['ghostpool_filter_date_posted'] = $gp_global['videos_filter_options']['date_posted'];	
			
			$GLOBALS['ghostpool_filter_date_modified'] = $gp_global['videos_filter_options']['date_modified'];
			
			$GLOBALS['ghostpool_filter_cats_id'] = ghostpool_option( 'videos_filter_cats_id' ) ? ghostpool_option( 'videos_filter_cats_id' ) : '';
			
			$GLOBALS['ghostpool_per_page'] = $gp_global['videos_per_page'];	
			
			$GLOBALS['ghostpool_featured_image'] = $gp_global['videos_featured_image'];
			
			$GLOBALS['ghostpool_image_width'] = $gp_global['videos_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = $gp_global['videos_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = $gp_global['videos_hard_crop'];
			
			$GLOBALS['ghostpool_image_alignment'] = $gp_global['videos_image_alignment'];
			
			$GLOBALS['ghostpool_title_position'] = $gp_global['videos_title_position'];
			
			$GLOBALS['ghostpool_content_display'] = $gp_global['videos_content_display'];
			
			$GLOBALS['ghostpool_excerpt_length'] = $gp_global['videos_excerpt_length'];
			
			$GLOBALS['ghostpool_meta_author'] = $gp_global['videos_meta']['author'];
			
			$GLOBALS['ghostpool_meta_date'] = $gp_global['videos_meta']['date'];
			
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['videos_meta']['comment_count'];
			
			$GLOBALS['ghostpool_meta_views'] = $gp_global['videos_meta']['views'];
			
			$GLOBALS['ghostpool_meta_cats'] = $gp_global['videos_meta']['cats'];
			
			$GLOBALS['ghostpool_meta_tags'] = $gp_global['videos_meta']['tags'];
			
			$GLOBALS['ghostpool_read_more_link'] = $gp_global['videos_read_more_link'];
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';


		/*--------------------------------------------------------------
		User Reviews Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'user-reviews-template.php' ) )  {

			$GLOBALS['ghostpool_format'] = 'blog-standard';
			
			$GLOBALS['ghostpool_per_page'] = $gp_global['user_reviews_per_page'];
			
			$GLOBALS['ghostpool_featured_image'] = $gp_global['user_reviews_featured_image'];
			
			$GLOBALS['ghostpool_image_width'] = $gp_global['user_reviews_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = $gp_global['user_reviews_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = $gp_global['user_reviews_hard_crop'];
			
			$GLOBALS['ghostpool_image_alignment'] = $gp_global['user_reviews_image_alignment'];
			
			$GLOBALS['ghostpool_title_position'] = 'title-next-to-thumbnail';
			
			$GLOBALS['ghostpool_content_display'] = $gp_global['user_reviews_content_display'];
			
			$GLOBALS['ghostpool_excerpt_length'] = $gp_global['user_reviews_excerpt_length'];
			
			$GLOBALS['ghostpool_meta_author'] = $gp_global['user_reviews_meta']['author'];
			
			$GLOBALS['ghostpool_meta_date'] = $gp_global['user_reviews_meta']['date'];
			
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['user_reviews_meta']['comment_count'];
			
			$GLOBALS['ghostpool_meta_views'] = $gp_global['user_reviews_meta']['views'];
			
			$GLOBALS['ghostpool_read_more_link'] = $gp_global['user_reviews_read_more_link'];
			
			$GLOBALS['ghostpool_page_numbers'] = 'enabled';


		/*--------------------------------------------------------------
		My Reviews Page Template
		--------------------------------------------------------------*/

		} elseif ( is_page_template( 'my-reviews-template.php' ) )  {

			$GLOBALS['ghostpool_format'] = 'blog-standard';
			
			$GLOBALS['ghostpool_per_page'] = -1;
			
			$GLOBALS['ghostpool_featured_image'] = 'disabled';
			
			$GLOBALS['ghostpool_title_position'] = 'title-next-to-thumbnail';
			
			$GLOBALS['ghostpool_content_display'] = 'excerpt';
			
			$GLOBALS['ghostpool_excerpt_length'] = '0';
			
			$GLOBALS['ghostpool_meta_author'] = '0';
			
			$GLOBALS['ghostpool_meta_date'] = '0';
			
			$GLOBALS['ghostpool_meta_comment_count'] = '0';	
			
			$GLOBALS['ghostpool_meta_tags'] = '0';
			
			$GLOBALS['ghostpool_meta_hub_award'] = '0';	
			
			$GLOBALS['ghostpool_display_site_rating'] = '0';
			
			$GLOBALS['ghostpool_display_user_rating'] = '0';	
			
			$GLOBALS['ghostpool_read_more_link'] = '0';
			
			
		/*--------------------------------------------------------------
		Posts
		--------------------------------------------------------------*/

		} elseif ( is_singular( 'post' ) ) {

			$GLOBALS['ghostpool_featured_image'] = redux_post_meta( 'gp', get_the_ID(), 'post_featured_image' ) == 'default' ? $gp_global['post_featured_image'] : redux_post_meta( 'gp', get_the_ID(), 'post_featured_image' );
			
			$gp_image = redux_post_meta( 'gp', get_the_ID(), 'post_image' );
			
			$GLOBALS['ghostpool_image_width'] = ! empty( $gp_image['width'] ) ? $gp_image['width'] : 
			$gp_global['post_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = ! empty( $gp_image['height'] ) ? $gp_image['height'] : $gp_global['post_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = redux_post_meta( 'gp', get_the_ID(), 'post_hard_crop' ) == 'default' ? $gp_global['post_hard_crop'] : redux_post_meta( 'gp', get_the_ID(), 'post_hard_crop' );
			
			$GLOBALS['ghostpool_image_alignment'] = redux_post_meta( 'gp', get_the_ID(), 'post_image_alignment' ) == 'default' ? $gp_global['post_image_alignment'] : redux_post_meta( 'gp', get_the_ID(), 'post_image_alignment' );
			
			$GLOBALS['ghostpool_meta_author'] = $gp_global['post_meta']['author'];
			
			$GLOBALS['ghostpool_meta_date'] = $gp_global['post_meta']['date'];
			
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['post_meta']['comment_count'];
			
			$GLOBALS['ghostpool_meta_views'] = $gp_global['post_meta']['views'];
			
			$GLOBALS['ghostpool_meta_cats'] = $gp_global['post_meta']['cats'];
			
			$GLOBALS['ghostpool_meta_tags'] = $gp_global['post_meta']['tags'];
	

		/*--------------------------------------------------------------
		User Reviews
		--------------------------------------------------------------*/

		} elseif ( is_singular( 'gp_user_review' ) ) {
			
			$GLOBALS['ghostpool_featured_image'] = redux_post_meta( 'gp', get_the_ID(), 'post_featured_image' ) == 'default' ? $gp_global['post_featured_image'] : redux_post_meta( 'gp', get_the_ID(), 'post_featured_image' );
			
			$gp_image = redux_post_meta( 'gp', get_the_ID(), 'post_image' );
			
			$GLOBALS['ghostpool_image_width'] = ! empty( $gp_image['width'] ) ? $gp_image['width'] : $gp_global['post_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = ! empty( $gp_image['height'] ) ? $gp_image['height'] : $gp_global['post_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = redux_post_meta( 'gp', get_the_ID(), 'post_hard_crop' ) == 'default' ? $gp_global['post_hard_crop'] : redux_post_meta( 'gp', get_the_ID(), 'post_hard_crop' );
			
			$GLOBALS['ghostpool_image_alignment'] = redux_post_meta( 'gp', get_the_ID(), 'post_image_alignment' ) == 'default' ? $gp_global['post_image_alignment'] : redux_post_meta( 'gp', get_the_ID(), 'post_image_alignment' );
			
			$GLOBALS['ghostpool_meta_author'] = $gp_global['post_meta']['author'];
			
			$GLOBALS['ghostpool_meta_date'] = $gp_global['post_meta']['date'];
			
			$GLOBALS['ghostpool_meta_comment_count'] = $gp_global['post_meta']['comment_count'];
			
			$GLOBALS['ghostpool_meta_views'] = $gp_global['post_meta']['views'];
			
			$GLOBALS['ghostpool_meta_cats'] = $gp_global['post_meta']['cats'];
			
			$GLOBALS['ghostpool_meta_tags'] = $gp_global['post_meta']['tags'];

	
		/*--------------------------------------------------------------
		Pages
		--------------------------------------------------------------*/

		} elseif ( is_page() ) {

			$GLOBALS['ghostpool_featured_image'] = redux_post_meta( 'gp', get_the_ID(), 'page_featured_image' ) == 'default' ? $gp_global['page_featured_image'] : redux_post_meta( 'gp', get_the_ID(), 'page_featured_image' );
			
			$gp_image = redux_post_meta( 'gp', get_the_ID(), 'page_image' );
			
			$GLOBALS['ghostpool_image_width'] = ! empty( $gp_image['width'] ) ? $gp_image['width'] : $gp_global['page_image']['width'];
			
			$GLOBALS['ghostpool_image_height'] = ! empty( $gp_image['height'] ) ? $gp_image['height'] : $gp_global['page_image']['height'];
			
			$GLOBALS['ghostpool_hard_crop'] = redux_post_meta( 'gp', get_the_ID(), 'page_hard_crop' ) == 'default' ? $gp_global['page_hard_crop'] : redux_post_meta( 'gp', get_the_ID(), 'page_hard_crop' );
			
			$GLOBALS['ghostpool_image_alignment'] = redux_post_meta( 'gp', get_the_ID(), 'page_image_alignment' ) == 'default' ? $gp_global['page_image_alignment'] : redux_post_meta( 'gp', get_the_ID(), 'page_image_alignment' );

		}
		
		
		/*--------------------------------------------------------------
		Fallbacks for v2.9 and below
		--------------------------------------------------------------*/

		if ( isset( $GLOBALS['ghostpool_format'] ) && empty( $GLOBALS['ghostpool_format'] ) ) {
			$GLOBALS['ghostpool_format'] = 'blog-columns';
		}	


		/*--------------------------------------------------------------
		Convert hard_crop option to true or false
		--------------------------------------------------------------*/

		if ( isset( $GLOBALS['ghostpool_hard_crop'] ) && $GLOBALS['ghostpool_hard_crop'] == 'enabled' ) {
			$GLOBALS['ghostpool_hard_crop'] = true;
		} elseif ( isset( $GLOBALS['ghostpool_hard_crop'] ) && $GLOBALS['ghostpool_hard_crop'] == 'disabled' ) {	
			$GLOBALS['ghostpool_hard_crop'] = false;
		}	
		
		
		/*--------------------------------------------------------------
		Add loop variables via your child theme using this function
		--------------------------------------------------------------*/

		if ( function_exists( 'ghostpool_custom_loop_variables' ) ) {
			ghostpool_custom_loop_variables();
		}
										
	}	
}

?>