<?php

if ( ! function_exists( 'ghostpool_category_variables' ) ) {
	function ghostpool_category_variables() {
			
			
		// Fix for incorrect category ID being applied before resaving page
		if ( isset( $GLOBALS['ghostpool_cats'] ) && ( ( ( ! isset( $GLOBALS['ghostpool_shortcode'] ) && ! isset( $_GET['type'] ) ) OR ( isset( $_GET['type'] ) && ( $_GET['type'] != 'news' && $_GET['type'] != 'video' && $_GET['type'] != 'blog' ) ) ) && ( ! isset( $GLOBALS['ghostpool_menu'] ) OR $GLOBALS['ghostpool_menu'] == null ) ) ) {
			if ( ! term_exists( (int) $GLOBALS['ghostpool_cats'] ) ) { $GLOBALS['ghostpool_cats'] = ''; }	
		}
		

		/*--------------------------------------------------------------
		Pagination
		--------------------------------------------------------------*/

		if ( get_query_var( 'paged' ) ) {
			$GLOBALS['ghostpool_paged'] = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$GLOBALS['ghostpool_paged'] = get_query_var( 'page' );
		} else {
			$GLOBALS['ghostpool_paged'] = 1;
		}
		

		/*--------------------------------------------------------------
		Categories
		--------------------------------------------------------------*/
	
		$GLOBALS['ghostpool_tax'] = array();		
		if ( ! empty( $GLOBALS['ghostpool_cats'] ) && preg_match( '/^[1-9, ][0-9, ]*$/', $GLOBALS['ghostpool_cats'] ) ) {
						
			// Get all registered taxonomies
			$gp_taxonomies = apply_filters( 'gp_hierarchical_taxonomies', get_taxonomies( array( 'public' => true, 'hierarchical' => true ) ) );
			foreach( $gp_taxonomies as $gp_taxonomy ) {
				$GLOBALS['ghostpool_tax'][] = array( 'taxonomy' => $gp_taxonomy, 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'id' );
			}
			$GLOBALS['ghostpool_tax'] = array( 'relation' => 'OR' ) + $GLOBALS['ghostpool_tax'];
			
			// Theme taxonomies referred to on specific pages
			$GLOBALS['ghostpool_hub_cats'] = array( 'taxonomy' => 'gp_hubs', 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'id' );
			$GLOBALS['ghostpool_video_cats'] = array( 'taxonomy' => 'gp_videos', 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'id' );
			$GLOBALS['ghostpool_post_cats'] = array( 'taxonomy' => 'category', 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'id' );
			$GLOBALS['ghostpool_portfolio_cats'] = array( 'taxonomy' => 'gp_portfolios', 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'id' );
					
		} elseif ( ! empty( $GLOBALS['ghostpool_cats'] ) ) {

			// Get all registered taxonomies
			$gp_taxonomies = apply_filters( 'gp_hierarchical_taxonomies', get_taxonomies( array( 'public' => true, 'hierarchical' => true ) ) );
			foreach( $gp_taxonomies as $gp_taxonomy ) {
				$GLOBALS['ghostpool_tax'][] = array( 'taxonomy' => $gp_taxonomy, 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'slug' );
			}
			$GLOBALS['ghostpool_tax'] = array( 'relation' => 'OR' ) + $GLOBALS['ghostpool_tax'];	
			
			// Theme taxonomies referred to on specific pages
			$GLOBALS['ghostpool_hub_cats'] = array( 'taxonomy' => 'gp_hubs', 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'slug' );
			$GLOBALS['ghostpool_video_cats'] = array( 'taxonomy' => 'gp_videos', 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'slug' );
			$GLOBALS['ghostpool_post_cats'] = array( 'taxonomy' => 'category', 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'slug' );
			$GLOBALS['ghostpool_portfolio_cats'] = array( 'taxonomy' => 'gp_portfolios', 'terms' => explode( ',', $GLOBALS['ghostpool_cats'] ), 'field' => 'slug' );
			
		} else {
		
			$GLOBALS['ghostpool_tax'] = null;
			$GLOBALS['ghostpool_hub_cats'] = null;
			$GLOBALS['ghostpool_video_cats'] = null;
			$GLOBALS['ghostpool_post_cats'] = null;
			$GLOBALS['ghostpool_portfolio_cats'] = null;
			
		}
				
					
		/*--------------------------------------------------------------
		Ordering
		--------------------------------------------------------------*/

		if ( isset( $GLOBALS['ghostpool_orderby'] ) ) {
		
			$GLOBALS['ghostpool_meta_query'] = '';
				
			if ( $GLOBALS['ghostpool_orderby'] == 'newest' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'date';
				$GLOBALS['ghostpool_order'] = 'desc';
				$GLOBALS['ghostpool_meta_key'] = '';
			} elseif ( $GLOBALS['ghostpool_orderby'] == 'oldest' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'date';
				$GLOBALS['ghostpool_order'] = 'asc';
				$GLOBALS['ghostpool_meta_key'] = '';				
			} elseif ( $GLOBALS['ghostpool_orderby']  == 'title_az' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'title';
				$GLOBALS['ghostpool_order'] = 'asc';
				$GLOBALS['ghostpool_meta_key'] = '';	
			} elseif ( $GLOBALS['ghostpool_orderby']  == 'title_za' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'title';
				$GLOBALS['ghostpool_order'] = 'desc';
				$GLOBALS['ghostpool_meta_key'] = '';									
			} elseif ( $GLOBALS['ghostpool_orderby'] == 'comment_count' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'comment_count';
				$GLOBALS['ghostpool_order'] = 'desc';
				$GLOBALS['ghostpool_meta_key'] = '';	
			} elseif ( $GLOBALS['ghostpool_orderby'] == 'views' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'post_views';
				$GLOBALS['ghostpool_order'] = 'desc';
				$GLOBALS['ghostpool_meta_key'] = '';		
			} elseif ( $GLOBALS['ghostpool_orderby'] == 'followers' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'meta_value_num';
				$GLOBALS['ghostpool_order'] = 'desc';
				$GLOBALS['ghostpool_meta_key'] = '_gp_followers';			
			} elseif ( $GLOBALS['ghostpool_orderby'] == 'site_rating' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'meta_value_num';
				$GLOBALS['ghostpool_order'] = 'desc';
				$GLOBALS['ghostpool_meta_key'] = '_gp_site_rating';	
			} elseif ( $GLOBALS['ghostpool_orderby']  == 'user_rating' ) {
				$GLOBALS['ghostpool_meta_query'] = array( 
					'gp_user_rating' => array( 'key' => '_gp_user_rating', 'type' => 'DECIMAL', 'compare' => 'EXISTS' ), 
					'gp_user_votes' => array( 'key' => '_gp_user_votes', 'type' => 'NUMERIC', 'compare' => 'EXISTS' )
				);
				$GLOBALS['ghostpool_orderby_value'] = array( 'meta_value_num' => 'desc', '_gp_user_rating' => 'desc', 'gp_user_votes' => 'desc' );
				$GLOBALS['ghostpool_order'] = 'desc';		
				$GLOBALS['ghostpool_meta_key'] = '_gp_user_rating';
			} elseif ( $GLOBALS['ghostpool_orderby'] == 'hub_awards' ) {
				$GLOBALS['ghostpool_meta_query'] = array(
					'relation' => 'OR',
					array(
						'key' => 'hub_award',
						'value' => '1',
						'compare' => '='
					),
					array(
						'key' => 'hub_review_award',
						'value' => '1',
						'compare' => '='
					)
				);
				$GLOBALS['ghostpool_orderby_value'] = 'meta_value';
				$GLOBALS['ghostpool_order'] = 'asc';
				$GLOBALS['ghostpool_meta_key'] = '';	
			} elseif ( $GLOBALS['ghostpool_orderby'] == 'menu_order' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'menu_order';
				$GLOBALS['ghostpool_order'] = 'asc';
				$GLOBALS['ghostpool_meta_key'] = '';	
			} elseif ( $GLOBALS['ghostpool_orderby'] == 'rand' ) {
				$GLOBALS['ghostpool_orderby_value'] = 'rand';
				$GLOBALS['ghostpool_order'] = 'asc';
				$GLOBALS['ghostpool_meta_key'] = '';	
			} else {
				$GLOBALS['ghostpool_orderby_value'] = '';
				$GLOBALS['ghostpool_order'] = '';
				$GLOBALS['ghostpool_meta_key'] = '';	
			}
		}	


		/*--------------------------------------------------------------
		Dates
		--------------------------------------------------------------*/

		// Date posted
		if ( isset( $GLOBALS['ghostpool_date_posted'] ) ) {			
			if ( $GLOBALS['ghostpool_date_posted'] == 'day' ) {
				$GLOBALS['ghostpool_date_posted_value'] = array(
					'column' => 'post_date_gmt',
					'after' => '1 day ago',
				);	
			} elseif ( $GLOBALS['ghostpool_date_posted'] == 'week' ) {	
				$GLOBALS['ghostpool_date_posted_value'] = array(	
					'column' => 'post_date_gmt',
					'after' => '1 week ago',
				);
			} elseif ( $GLOBALS['ghostpool_date_posted'] == 'month' ) {	
				$GLOBALS['ghostpool_date_posted_value'] = array(	
					'column' => 'post_date_gmt',
					'after' => '1 month ago',
				);
			} elseif ( $GLOBALS['ghostpool_date_posted'] == 'year' ) {	
				$GLOBALS['ghostpool_date_posted_value'] = array(	
					'column' => 'post_date_gmt',
					'after' => '1 year ago',
				);
			} elseif ( $GLOBALS['ghostpool_date_posted'] == 'all' ) {	
				$GLOBALS['ghostpool_date_posted_value'] = '';
			} else {
				$GLOBALS['ghostpool_date_posted_value'] = '';
			}
		}	

		// Date modified
		if ( isset( $GLOBALS['ghostpool_date_modified'] ) ) {			
			if ( $GLOBALS['ghostpool_date_modified'] == 'day' ) {
				$GLOBALS['ghostpool_date_modified_value'] = array(
					'column' => 'post_modified_gmt',
					'after' => '1 day ago',
				);	
			} elseif ( $GLOBALS['ghostpool_date_modified'] == 'week' ) {	
				$GLOBALS['ghostpool_date_modified_value'] = array(	
					'column' => 'post_modified_gmt',
					'after' => '1 week ago',
				);
			} elseif ( $GLOBALS['ghostpool_date_modified'] == 'month' ) {	
				$GLOBALS['ghostpool_date_modified_value'] = array(	
					'column' => 'post_modified_gmt',
					'after' => '1 month ago',
				);
			} elseif ( $GLOBALS['ghostpool_date_modified'] == 'year' ) {	
				$GLOBALS['ghostpool_date_modified_value'] = array(	
					'column' => 'post_modified_gmt',
					'after' => '1 year ago',
				);
			} elseif ( $GLOBALS['ghostpool_date_modified'] == 'all' ) {	
				$GLOBALS['ghostpool_date_modified_value'] = '';
			} else {
				$GLOBALS['ghostpool_date_modified_value'] = '';
			}
		}
		
		
		/*--------------------------------------------------------------
		Add category variables via your child theme using this function
		--------------------------------------------------------------*/

		if ( function_exists( 'ghostpool_custom_category_variables' ) ) {
			ghostpool_custom_category_variables();
		}
			
	}		
}

?>