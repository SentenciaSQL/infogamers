<?php 

if ( ! function_exists( 'ghostpool_data_properties' ) ) {
	function ghostpool_data_properties( $gp_type ) {

		if ( ghostpool_option( 'ajax', '', 'ajax-loop' ) == 'ajax-loop' ) {
			
			// Get post or hub association ID
			$post_id = ghostpool_get_hub_id( get_the_ID() );
		
			// Check to see if options exists
			$GLOBALS['ghostpool_ajax_post_id'] = get_the_ID();
			if ( is_singular() ) { $GLOBALS['ghostpool_ajax_hub_id'] = $post_id; } else { $GLOBALS['ghostpool_ajax_hub_id'] = ''; }
			$GLOBALS['ghostpool_ajax_cats'] = ! empty( $GLOBALS['ghostpool_cats'] ) ? $GLOBALS['ghostpool_cats'] : '';	
			$GLOBALS['ghostpool_ajax_hub_field_slugs'] = ! empty( $GLOBALS['ghostpool_hub_field_slugs'] ) ? $GLOBALS['ghostpool_hub_field_slugs'] : '';	
			$GLOBALS['ghostpool_ajax_post_association'] = ! empty( $GLOBALS['ghostpool_post_association'] ) ? $GLOBALS['ghostpool_post_association'] : '';		
			$GLOBALS['ghostpool_ajax_post_types'] = ! empty( $GLOBALS['ghostpool_post_types'] ) ? $GLOBALS['ghostpool_post_types'] : '';		
			$GLOBALS['ghostpool_ajax_format'] = ! empty( $GLOBALS['ghostpool_format'] ) ? $GLOBALS['ghostpool_format'] : '';	
			$GLOBALS['ghostpool_ajax_size'] = ! empty( $GLOBALS['ghostpool_size'] ) ? $GLOBALS['ghostpool_size'] : '';		
			$GLOBALS['ghostpool_ajax_orderby'] = ! empty( $GLOBALS['ghostpool_orderby'] ) ? $GLOBALS['ghostpool_orderby'] : '';
			$GLOBALS['ghostpool_ajax_date_posted'] = ! empty( $GLOBALS['ghostpool_date_posted'] ) ? $GLOBALS['ghostpool_date_posted'] : '';
			$GLOBALS['ghostpool_ajax_date_modified'] = ! empty( $GLOBALS['ghostpool_date_modified'] ) ? $GLOBALS['ghostpool_date_modified'] : '';
			$GLOBALS['ghostpool_ajax_per_page'] = ! empty( $GLOBALS['ghostpool_per_page'] ) ? $GLOBALS['ghostpool_per_page'] : '';
			$GLOBALS['ghostpool_ajax_menu_per_page'] = ! empty( $GLOBALS['ghostpool_menu_per_page'] ) ? $GLOBALS['ghostpool_menu_per_page'] : '';
			$GLOBALS['ghostpool_ajax_offset'] = ! empty( $GLOBALS['ghostpool_offset'] ) ? $GLOBALS['ghostpool_offset'] : '';
			$GLOBALS['ghostpool_ajax_featured_image'] = ! empty( $GLOBALS['ghostpool_featured_image'] ) ? $GLOBALS['ghostpool_featured_image'] : '';
			$GLOBALS['ghostpool_ajax_image_width'] = ! empty( $GLOBALS['ghostpool_image_width'] ) ? $GLOBALS['ghostpool_image_width'] : '';
			$GLOBALS['ghostpool_ajax_image_height'] = ! empty( $GLOBALS['ghostpool_image_height'] ) ? $GLOBALS['ghostpool_image_height'] : '';
			$GLOBALS['ghostpool_ajax_hard_crop'] = ! empty( $GLOBALS['ghostpool_hard_crop'] ) ? $GLOBALS['ghostpool_hard_crop'] : '';
			$GLOBALS['ghostpool_ajax_image_alignment'] = ! empty( $GLOBALS['ghostpool_image_alignment'] ) ? $GLOBALS['ghostpool_image_alignment'] : '';
			$GLOBALS['ghostpool_ajax_title_position'] = ! empty( $GLOBALS['ghostpool_title_position'] ) ? $GLOBALS['ghostpool_title_position'] : '';
			$GLOBALS['ghostpool_ajax_content_display'] = ! empty( $GLOBALS['ghostpool_content_display'] ) ? $GLOBALS['ghostpool_content_display'] : '';
			$GLOBALS['ghostpool_ajax_excerpt_length'] = ! empty( $GLOBALS['ghostpool_excerpt_length'] ) ? $GLOBALS['ghostpool_excerpt_length'] : 0;
			$GLOBALS['ghostpool_ajax_meta_author'] = ! empty( $GLOBALS['ghostpool_meta_author'] ) ? $GLOBALS['ghostpool_meta_author'] : '';
			$GLOBALS['ghostpool_ajax_meta_date'] = ! empty( $GLOBALS['ghostpool_meta_date'] ) ? $GLOBALS['ghostpool_meta_date'] : '';
			$GLOBALS['ghostpool_ajax_meta_comment_count'] = ! empty( $GLOBALS['ghostpool_meta_comment_count'] ) ? $GLOBALS['ghostpool_meta_comment_count'] : '';
			$GLOBALS['ghostpool_ajax_meta_views'] = ! empty( $GLOBALS['ghostpool_meta_views'] ) ? $GLOBALS['ghostpool_meta_views'] : '';
			$GLOBALS['ghostpool_ajax_meta_followers'] = ! empty( $GLOBALS['ghostpool_meta_followers'] ) ? $GLOBALS['ghostpool_meta_followers'] : '';
			$GLOBALS['ghostpool_ajax_meta_cats'] = ! empty( $GLOBALS['ghostpool_meta_cats'] ) ? $GLOBALS['ghostpool_meta_cats'] : '';
			$GLOBALS['ghostpool_ajax_meta_tags'] = ! empty( $GLOBALS['ghostpool_meta_tags'] ) ? $GLOBALS['ghostpool_meta_tags'] : '';
			$GLOBALS['ghostpool_ajax_meta_hub_cats'] = ! empty( $GLOBALS['ghostpool_meta_hub_cats'] ) ? $GLOBALS['ghostpool_meta_hub_cats'] : '';
			$GLOBALS['ghostpool_ajax_meta_hub_fields'] = ! empty( $GLOBALS['ghostpool_meta_hub_fields'] ) ? $GLOBALS['ghostpool_meta_hub_fields'] : '';
			$GLOBALS['ghostpool_ajax_meta_hub_award'] = ! empty( $GLOBALS['ghostpool_meta_hub_award'] ) ? $GLOBALS['ghostpool_meta_hub_award'] : '';
			$GLOBALS['ghostpool_ajax_hub_cats_selected'] = ! empty( $GLOBALS['ghostpool_hub_cats_selected'] ) ? implode( ',', $GLOBALS['ghostpool_hub_cats_selected'] ) : '';
			$GLOBALS['ghostpool_ajax_display_site_rating'] = ! empty( $GLOBALS['ghostpool_display_site_rating'] ) ? $GLOBALS['ghostpool_display_site_rating'] : '';
			$GLOBALS['ghostpool_ajax_display_user_rating'] = ! empty( $GLOBALS['ghostpool_display_user_rating'] ) ? $GLOBALS['ghostpool_display_user_rating'] : '';
			$GLOBALS['ghostpool_ajax_read_more_link'] = ! empty( $GLOBALS['ghostpool_read_more_link'] ) ? $GLOBALS['ghostpool_read_more_link'] : '';
			$GLOBALS['ghostpool_ajax_page_arrows'] = ! empty( $GLOBALS['ghostpool_page_arrows'] ) ? $GLOBALS['ghostpool_page_arrows'] : '';
			$GLOBALS['ghostpool_ajax_page_numbers'] = ! empty( $GLOBALS['ghostpool_page_numbers'] ) ? $GLOBALS['ghostpool_page_numbers'] : '';
			$GLOBALS['ghostpool_ajax_author_id'] = ! empty( $GLOBALS['ghostpool_author_id'] ) ? $GLOBALS['ghostpool_author_id'] : '';	
	 
			// Add to blog wrappers to pull query data 
			return ' data-type="' . $gp_type . '" data-postid="' . $GLOBALS['ghostpool_ajax_post_id'] . '" data-hubid="' . $GLOBALS['ghostpool_ajax_hub_id'] . '" data-cats="' . $GLOBALS['ghostpool_ajax_cats'] . '" data-hubfieldslugs="' . $GLOBALS['ghostpool_ajax_hub_field_slugs'] . '" data-postassociation="' . $GLOBALS['ghostpool_ajax_post_association'] . '" data-posttypes="' . $GLOBALS['ghostpool_ajax_post_types'] . '" data-format="' . $GLOBALS['ghostpool_ajax_format'] . '" data-size="' . $GLOBALS['ghostpool_ajax_size'] . '" data-orderby="' . $GLOBALS['ghostpool_ajax_orderby'] . '" data-dateposted="' . $GLOBALS['ghostpool_ajax_date_posted'] . '" data-datemodified="' . $GLOBALS['ghostpool_ajax_date_modified'] . '" data-perpage="' . $GLOBALS['ghostpool_ajax_per_page'] . '" data-menuperpage="' . $GLOBALS['ghostpool_ajax_menu_per_page'] . '" data-offset="' . $GLOBALS['ghostpool_ajax_offset'] . '"  data-featuredimage="' . $GLOBALS['ghostpool_ajax_featured_image'] . '" data-imagewidth="' . $GLOBALS['ghostpool_ajax_image_width'] . '" data-imageheight="' . $GLOBALS['ghostpool_ajax_image_height'] . '" data-hardcrop="' . $GLOBALS['ghostpool_ajax_hard_crop'] . '" data-imagealignment="' . $GLOBALS['ghostpool_ajax_image_alignment'] . '" data-titleposition="' . $GLOBALS['ghostpool_ajax_title_position'] . '" data-contentdisplay="' . $GLOBALS['ghostpool_ajax_content_display'] . '" data-excerptlength="' . $GLOBALS['ghostpool_ajax_excerpt_length'] . '" data-metaauthor="' . $GLOBALS['ghostpool_ajax_meta_author'] . '" data-metadate="' . $GLOBALS['ghostpool_ajax_meta_date'] . '" data-metacommentcount="' . $GLOBALS['ghostpool_ajax_meta_comment_count'] . '" data-metaviews="' . $GLOBALS['ghostpool_ajax_meta_views'] . '" data-metafollowers="' . $GLOBALS['ghostpool_ajax_meta_followers'] . '" data-metacats="' . $GLOBALS['ghostpool_ajax_meta_cats'] . '" data-metatags="' . $GLOBALS['ghostpool_ajax_meta_tags'] . '" data-metahubcats="' . $GLOBALS['ghostpool_ajax_meta_hub_cats'] . '" data-metahubfields="' . $GLOBALS['ghostpool_ajax_meta_hub_fields'] . '" data-metahubaward="' . $GLOBALS['ghostpool_ajax_meta_hub_award'] . '" data-hubcatsselected="' . $GLOBALS['ghostpool_ajax_hub_cats_selected'] . '" data-displaysiterating="' . $GLOBALS['ghostpool_ajax_display_site_rating'] . '" data-displayuserrating="' . $GLOBALS['ghostpool_ajax_display_user_rating'] . '" data-readmorelink="' . $GLOBALS['ghostpool_ajax_read_more_link'] . '"  data-pagenumbers="' . $GLOBALS['ghostpool_ajax_page_numbers'] . '" data-authorid="' . $GLOBALS['ghostpool_ajax_author_id'] . '"';

		}
	}
}

if ( ! function_exists( 'ghostpool_register_ajax' ) ) {
	function ghostpool_register_ajax() {
		
		if ( ghostpool_option( 'ajax', '', 'ajax-loop' ) == 'ajax-loop' ) {			
	
			global $query_string;
			
			// Determine http or https for admin-ajax.php URL
			if ( is_ssl() ) { $gp_scheme = 'https'; } else { $gp_scheme = 'http'; }
		
			// Load scripts
			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );			
			wp_enqueue_script( 'jquery-flexslider' );
			wp_enqueue_script( 'ghostpool-ajax-loop', get_template_directory_uri() . '/lib/scripts/ajax-loop.js', array( 'jquery' ), '', true );
			wp_localize_script( 'ghostpool-ajax-loop', 'ghostpoolAjax', array(
				'ajaxurl' => admin_url( 'admin-ajax.php', $gp_scheme ),
				'ajaxnonce' => wp_create_nonce( 'gp-ajax-nonce' ),
				'querystring' => $query_string,
			) ); 

		}	
	}
}
add_action( 'wp_enqueue_scripts', 'ghostpool_register_ajax' );

if ( ! function_exists( 'ghostpool_ajax' ) ) {
	function ghostpool_ajax() {

	if ( ghostpool_option( 'ajax', '', 'ajax-loop' ) == 'ajax-loop' ) {			
		
		if ( ! wp_verify_nonce( $_GET['ajaxnonce'], 'gp-ajax-nonce' ) )
			die();
	
			// Pagination
			$ghostpool_pagination = ( isset( $_GET['pagenumber'] ) ) ? $_GET['pagenumber'] : 0;
				
			// Get theme options from ajax values
			$GLOBALS['ghostpool_cats'] = isset( $_GET['cats'] ) ? $_GET['cats'] : '';	
			$GLOBALS['ghostpool_hub_field_slugs'] = isset( $_GET['hubfieldslugs'] ) ? $_GET['hubfieldslugs'] : '';
			$GLOBALS['ghostpool_post_types'] = isset( $_GET['posttypes'] ) ? $_GET['posttypes'] : '';		
			$GLOBALS['ghostpool_format'] = isset( $_GET['format'] ) ? $_GET['format'] : '';	
			$GLOBALS['ghostpool_size'] = isset( $_GET['size'] ) ? $_GET['size'] : '';		
			$GLOBALS['ghostpool_orderby'] = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
			$GLOBALS['ghostpool_date_posted'] = isset( $_GET['dateposted'] ) ? $_GET['dateposted'] : '';
			$GLOBALS['ghostpool_date_modified'] = isset( $_GET['datemodified'] ) ? $_GET['datemodified'] : '';
			$GLOBALS['ghostpool_per_page'] = isset( $_GET['perpage'] ) ? $_GET['perpage'] : '';
			$GLOBALS['ghostpool_menu_per_page'] = isset( $_GET['menuperpage'] ) ? $_GET['menuperpage'] : '';
			$GLOBALS['ghostpool_offset'] = isset( $_GET['offset'] ) ? $_GET['offset'] : '';
			$GLOBALS['ghostpool_featured_image'] = isset( $_GET['featuredimage'] ) ? $_GET['featuredimage'] : '';
			$GLOBALS['ghostpool_image_width'] = isset( $_GET['imagewidth'] ) ? $_GET['imagewidth'] : '';
			$GLOBALS['ghostpool_image_height'] = isset( $_GET['imageheight'] ) ? $_GET['imageheight'] : '';
			$GLOBALS['ghostpool_hard_crop'] = isset( $_GET['hardcrop'] ) ? $_GET['hardcrop'] : '';
			$GLOBALS['ghostpool_image_alignment'] = isset( $_GET['imagealignment'] ) ? $_GET['imagealignment'] : '';
			$GLOBALS['ghostpool_title_position'] = isset( $_GET['titleposition'] ) ? $_GET['titleposition'] : '';
			$GLOBALS['ghostpool_content_display'] = isset( $_GET['contentdisplay'] ) ? $_GET['contentdisplay'] : '';
			$GLOBALS['ghostpool_excerpt_length'] = isset( $_GET['excerptlength'] ) ? $_GET['excerptlength'] : 0;
			$GLOBALS['ghostpool_meta_author'] = isset( $_GET['metaauthor'] ) ? $_GET['metaauthor'] : '';
			$GLOBALS['ghostpool_meta_date'] = isset( $_GET['metadate'] ) ? $_GET['metadate'] : '';
			$GLOBALS['ghostpool_meta_comment_count'] = isset( $_GET['metacommentcount'] ) ? $_GET['metacommentcount'] : '';
			$GLOBALS['ghostpool_meta_views'] = isset( $_GET['metaviews'] ) ? $_GET['metaviews'] : '';
			$GLOBALS['ghostpool_meta_followers'] = isset( $_GET['metafollowers'] ) ? $_GET['metafollowers'] : '';
			$GLOBALS['ghostpool_meta_cats'] = isset( $_GET['metacats'] ) ? $_GET['metacats'] : '';
			$GLOBALS['ghostpool_meta_tags'] = isset( $_GET['metatags'] ) ? $_GET['metatags'] : '';
			$GLOBALS['ghostpool_meta_hub_cats'] = isset( $_GET['metahubcats'] ) ? $_GET['metahubcats'] : '';
			$GLOBALS['ghostpool_meta_hub_fields'] = isset( $_GET['metahubfields'] ) ? $_GET['metahubfields'] : '';
			$GLOBALS['ghostpool_meta_hub_award'] = isset( $_GET['metahubaward'] ) ? $_GET['metahubaward'] : '';
			$GLOBALS['ghostpool_hub_cats_selected'] = isset( $_GET['hubcatsselected'] ) ? explode( ',', $_GET['hubcatsselected'] ) : '';
			$GLOBALS['ghostpool_display_site_rating'] = isset( $_GET['displaysiterating'] ) ? $_GET['displaysiterating'] : '';
			$GLOBALS['ghostpool_display_user_rating'] = isset( $_GET['displayuserrating'] ) ? $_GET['displayuserrating'] : '';
			$GLOBALS['ghostpool_read_more_link'] = isset( $_GET['readmorelink'] ) ? $_GET['readmorelink'] : '';
			$GLOBALS['ghostpool_page_numbers'] = isset( $_GET['pagenumbers'] ) ? $_GET['pagenumbers'] : '';
			$GLOBALS['ghostpool_author_id'] = isset( $_GET['authorid'] ) ? $_GET['authorid'] : '';

			// Post Type
			if ( $_GET['type'] == 'news' OR $_GET['type'] == 'news-template' OR $_GET['type'] == 'videos' OR $_GET['type'] == 'videos-template' ) {
				$gp_post_type = 'post';
			} elseif ( $_GET['type'] == 'user-reviews' ) {
				$gp_post_type = 'gp_user_review';			
			} else {
				$gp_post_type = explode( ',', $GLOBALS['ghostpool_post_types'] );
			}

			// Use filtered category is selected
			if ( isset( $_GET['cats_new'] ) && $_GET['cats_new'] != '0' ) {
				$GLOBALS['ghostpool_cats'] = $_GET['cats_new'];
			}
	
			// Use filtered menu category is selected
			if ( isset( $_GET['menu_cats_new'] ) && $_GET['menu_cats_new'] != '0' ) {
				$GLOBALS['ghostpool_cats'] = $_GET['menu_cats_new'];
			}
					
			// Use filtered orderby if selected
			if ( isset( $_GET['orderby_new'] ) && $_GET['orderby_new'] != '0' ) {
				$GLOBALS['ghostpool_orderby'] = $_GET['orderby_new'];
			}	

			// Use filtered date posted if selected
			if ( isset( $_GET['date_posted_new'] ) && $_GET['date_posted_new'] != '0' ) {
				$GLOBALS['ghostpool_date_posted'] = $_GET['date_posted_new'];
			}	

			// Use filtered date modified if selected
			if ( isset( $_GET['date_modified_new'] ) && $_GET['date_modified_new'] != '0' ) {
				$GLOBALS['ghostpool_date_modified'] = $_GET['date_modified_new'];
			}	
							
			// Load page variables		
			ghostpool_loop_variables();
			ghostpool_category_variables();		

			// Get blog posts associated with hub
			if ( ( $_GET['type'] == 'blog' && $_GET['postassociation'] != 'disabled' && ( get_post_meta( $_GET['hubid'], '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $_GET['hubid'], '_wp_page_template', true ) == 'hub-review-template.php' ) ) OR ( $_GET['type'] == 'blog-template' && get_post_meta( $_GET['postid'], 'blog_template_post_association', true ) == 'enabled' ) ) {
				$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $_GET['hubid'] ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $_GET['hubid'], 'compare' => '=' ) );
			}
		
			// Get news posts associated with hub
			if ( ( $_GET['type'] == 'news' && $_GET['postassociation'] != 'disabled' && ( get_post_meta( $_GET['hubid'], '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $_GET['hubid'], '_wp_page_template', true ) == 'hub-review-template.php' ) ) OR ( $_GET['type'] == 'news-template' && get_post_meta( $_GET['postid'], 'news_post_association', true ) != 'disabled' ) ) {
				$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $_GET['hubid'] ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $_GET['hubid'], 'compare' => '=' ) );
			}
				
			// Get video posts associated with hub
			if ( ( $_GET['type'] == 'videos' && $_GET['postassociation'] != 'disabled' && ( get_post_meta( $_GET['hubid'], '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $_GET['hubid'], '_wp_page_template', true ) == 'hub-review-template.php' ) ) OR ( $_GET['type'] == 'videos-template' && get_post_meta( $_GET['postid'], 'videos_post_association', true ) != 'disabled' ) ) {
				$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $_GET['hubid'] ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $_GET['hubid'], 'compare' => '=' ) );
			}

			// Hub fields
			if ( $_GET['type'] == 'blog' ) {
			
				$gp_hub_field_args = '';
				
				if ( $_GET['hubfieldslugs'] ) {
						
					$gp_hub_field_args = array();

					// Put hub fields into an array
					$gp_hub_fields_array = explode( ',', $GLOBALS['ghostpool_hub_field_slugs'] );

					foreach ( $gp_hub_fields_array as $gp_hub_field ) {

						// Get taxonomy e.g. genre
						$gp_taxonomy = strstr( $gp_hub_field, ':', true );
			
						// Get terms e.g. horror, romance
						$gp_terms = strstr( $gp_hub_field, ':', false );
			
						// Remove : from front of terms
						$gp_terms = ltrim( $gp_terms, ':' );
			
						// Put list of terms into an array
						$gp_terms = explode( ':', $gp_terms );
		
						// Hub field tax query
						$gp_hub_field_args[] = array( 
							'taxonomy' => $gp_taxonomy,
							'field'     => 'slug',
							'terms'     => $gp_terms,
							'operator' => 'AND',
						);	
			
					}
				}
			}
				
			// Tax query
			if ( $_GET['type'] == 'news' OR $_GET['type'] == 'news-template' ) {
				$gp_tax_query  = array( 'relation' => 'AND', $GLOBALS['ghostpool_post_cats'], array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-quote', 'post-format-audio', 'post-format-gallery', 'post-format-image', 'post-format-link', 'post-format-video' ), 'operator' => 'NOT IN' )	 );	
			} elseif ( $_GET['type'] == 'videos' OR $_GET['type'] == 'videos-template' ) {
				$gp_tax_query  = array( 'relation' => 'AND', $GLOBALS['ghostpool_video_cats'], array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-video' ) ) );			
			} elseif ( $_GET['type'] == 'blog-template' OR $_GET['type'] == 'menu' ) {
				$gp_tax_query = $GLOBALS['ghostpool_tax'];
			} elseif ( $_GET['type'] == 'blog' ) {
				$gp_tax_query = array( 
					$GLOBALS['ghostpool_tax'],	
					array(
						'relation' => 'AND',
						$gp_hub_field_args,
					),
				);			
			} else {
				$gp_tax_query  = '';
			}

			// Query														
			if ( $_GET['type'] == 'taxonomy' ) {
				$gp_defaults = array(
					'meta_query' 	 => $GLOBALS['ghostpool_meta_query'],
					'orderby' 		 => $GLOBALS['ghostpool_orderby_value'],
					'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
				);
				$gp_args = $_GET['querystring'] . "&post_status=publish&order=" . $GLOBALS['ghostpool_order'] . "&meta_key=" . $GLOBALS['ghostpool_meta_key'] . "&posts_per_page=" . $GLOBALS['ghostpool_per_page'] . "&paged=$ghostpool_pagination";		
				$gp_args = wp_parse_args( $gp_args, $gp_defaults );
			} elseif ( $_GET['type'] == 'author' ) {		
				$gp_args = array(
					'post_status' => 'publish',
					'post_type' => array( 'post', 'page', 'gp_user_review' ),
					'author' => $GLOBALS['ghostpool_author_id'],
					/*'meta_query' => array(
						'relation' => 'OR',		
						array(
							'key' => '_wp_page_template',
							'value' => array( 'hub-template.php', 'hub-review-template.php', 'review-template.php' ),
							'compare' => 'IN',
						),
						array(
							'key' => '_wp_page_template',
							'compare' => 'NOT EXISTS',
						),						
					),*/ 
					'orderby' => $GLOBALS['ghostpool_orderby_value'],
					'order' => $GLOBALS['ghostpool_order'],	
					'posts_per_page' => $GLOBALS['ghostpool_per_page'],
					'paged' => $ghostpool_pagination,
					'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
				);
			} elseif ( $_GET['type'] == 'user-reviews' ) {	
				$gp_args = array(
					'post_status' => 'publish',
					'post_type'       => 'gp_user_review',
					'meta_query' => array(
						array(
						   'key' => '_hub_page_id',
						   'value' => $_GET['hubid'],
						   'compare' => '=',
						),
					),
					'posts_per_page' => $GLOBALS['ghostpool_per_page'],
					'paged'          => $ghostpool_pagination,
				);
			} elseif ( $_GET['type'] == 'menu' ) {	
				$gp_args = array(
					'post_status' 	  => 'publish',
					'post_type'       => array( 'post', 'page' ),
					'tax_query'       => $gp_tax_query,
					'orderby'         => 'date',
					'order'           => 'desc',
					'posts_per_page'  => $GLOBALS['ghostpool_menu_per_page'],
					'paged'           => $ghostpool_pagination,		
				);				
			} else {
				$gp_args = array(
					'post_status' 	 => 'publish',
					'post_type' 	 => $gp_post_type,
					'tax_query' 	 => $gp_tax_query,
					'orderby' 		 => $GLOBALS['ghostpool_orderby_value'],
					'order' 		 => $GLOBALS['ghostpool_order'],
					'meta_query' 	 => $GLOBALS['ghostpool_meta_query'],
					'meta_key' 		 => $GLOBALS['ghostpool_meta_key'],
					'posts_per_page' => $GLOBALS['ghostpool_per_page'],
					'offset' 		 => $GLOBALS['ghostpool_offset'],
					'paged'          => $ghostpool_pagination,
					'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
				);
			}

			//print_r($gp_args);
		
			$gp_query = new wp_query( $gp_args );
						
			if ( $gp_query->have_posts() ) :
		
				$gp_total_pages = $gp_query->max_num_pages;

				// Pagination (Arrows)
				if ( $gp_total_pages > 1 && $_GET['type'] == 'menu' ) {
					echo '<div class="gp-ajax-pagination gp-pagination-arrows">';
						if ( $ghostpool_pagination > 1 ) {
							echo '<a href="#" data-pagelink="' . ( $ghostpool_pagination - 1 ) . '" class="prev"></a>';
						}
						if ( $ghostpool_pagination < $gp_total_pages ) {
							echo '<a href="#" data-pagelink="' . ( $ghostpool_pagination + 1 ) . '" class="next"></a>';
						}	
					echo '</div>'; 
				}				
						
				if ( $GLOBALS['ghostpool_format'] == 'blog-masonry' ) { echo '<div class="gp-gutter-size"></div>'; }
			
				while ( $gp_query->have_posts() ) : $gp_query->the_post();
			
					// Load Visual Composer shortcodes
					if ( function_exists( 'vc_set_as_theme' ) ) {
						WPBMap::addAllMappedShortcodes();
					}
					
					if ( $_GET['type'] == 'menu' ) {
																				
						// Post link
						if ( get_post_format() == 'link' ) { 
							$link = esc_url( get_post_meta( get_the_ID(), 'link', true ) );
							$target = 'target="' . get_post_meta( get_the_ID(), 'link_target', true ) . '"';
						} else {
							$link = get_permalink();
							$target = '';
						}
					
						echo '<section class="' . implode( ' ' , get_post_class( 'gp-post-item' ) ) . '">';
				
							if ( has_post_thumbnail() ) {
	
								$gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 198, 125, true, false, true );
								if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
									$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 198 * 2, 125 * 2, true, true, true );
								} else {
									$gp_retina = '';
								}
				
								echo '<div class="gp-post-thumbnail"><div class="gp-image-above">
									<a href="' . $link . '" title="' . ghostpool_prefix_hub_title( get_the_ID() ) . '" target="' . get_post_meta( get_the_ID(), 'link_target', true ) . '"' . $target . '>
										<img src="' . $gp_image[0] . '" data-rel="' . $gp_retina . '" width="' . $gp_image[1] . '" height="' . $gp_image[2] . '" alt="' . ghostpool_prefix_hub_title( get_the_ID() ) . '" class="gp-post-image" />
									</a>
								</div></div>';
					
							}	

							echo '<h3 class="gp-loop-title"><a href="' . $link . '" title="' . ghostpool_prefix_hub_title( get_the_ID() ) . '"' . $target . '>' . ghostpool_prefix_hub_title( get_the_ID() ) . '</a></h3>
				
						</section>';
				
					} elseif ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-review-template.php' OR get_post_meta( get_the_ID(), '_user_review_rating', true ) ) { 
						get_template_part( 'review', 'loop' );
					} else {
						get_template_part( 'post', 'loop' );
					} ?>

				<?php endwhile; ?>

				<?php 

				// Pagination (Numbers)
				if ( $gp_total_pages > 1 && $_GET['type'] != 'menu' && $GLOBALS['ghostpool_page_numbers'] == 'enabled' ) {
					  echo '<div class="gp-pagination gp-pagination-numbers gp-ajax-pagination">';
					  echo paginate_links(array(  
						'base'     => '%_%',  
						'format'   => '/page/%#%',
						'current'  => $ghostpool_pagination,  
						'total'    => $gp_total_pages,  
						'type'      => 'list',
						'prev_text' => '',
						'next_text' => '',   
						'end_size'  => 1,
						'mid_size'  => 1,      
					  ));
					  echo '</div>'; 
				}
				?>
		
			<?php else : ?>

				<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>
	
			<?php endif; wp_reset_postdata();

			die();
			
		}	
	}
}
add_action( 'wp_ajax_ghostpool_ajax', 'ghostpool_ajax' );
add_action( 'wp_ajax_nopriv_ghostpool_ajax', 'ghostpool_ajax' );

?>