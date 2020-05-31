<?php if ( ! class_exists( 'GhostPool_Shortcodes' ) ) {

	class GhostPool_Shortcodes {

		public function __construct() {
			add_action( 'init', array( &$this, 'ghostpool_shortcodes' ) );
			add_action( 'vc_before_init', array( &$this, 'ghostpool_vc_functions' ), 10 );
		}
		

		public function ghostpool_vc_functions() {
			if ( function_exists( 'vc_set_as_theme' ) ) {
				vc_set_as_theme(); // Disable design options
				vc_set_shortcodes_templates_dir( dirname( __FILE__ ) ); // Set templates directory
				vc_set_default_editor_post_types( array( 'page', 'gp_portfolio_item', 'epx_vcsb', 'vc-element' ) ); // Check VC post type checkboxes by default
			}
		}

		public function ghostpool_shortcodes() {
	
			if ( function_exists( 'vc_set_as_theme' ) ) {
	

				/*--------------------------------------------------------------
				If plugin is activated without theme
				--------------------------------------------------------------*/
								
				// If using plugin define missing $GLOBALS keys
				if ( ! function_exists( 'aq_resize' ) ) {
					$GLOBALS['ghostpool_tax'] = '';
					$GLOBALS['ghostpool_orderby_value'] = '';
					$GLOBALS['ghostpool_order'] = '';
					$GLOBALS['ghostpool_meta_key'] = '';
					$GLOBALS['ghostpool_meta_query'] = '';
					$GLOBALS['ghostpool_date_posted_value'] = '';
					$GLOBALS['ghostpool_date_modified_value'] = '';
					$GLOBALS['ghostpool_paged'] = '';
					$GLOBALS['ghostpool_post_cats'] = '';
					$GLOBALS['ghostpool_hub_cats'] = '';
					$GLOBALS['ghostpool_video_cats'] = '';
					$GLOBALS['ghostpool_site_rating_enabled'] = '';
					$GLOBALS['ghostpool_user_rating_enabled'] = '';
				}	
								
				// Functions				
				if ( ! function_exists( 'ghostpool_option' ) ) {
					function ghostpool_option() {}
				}	
				if ( ! function_exists( 'aq_resize' ) ) {
					function aq_resize() {}
				}
				if ( ! function_exists( 'ghostpool_category_variables' ) ) {
					function ghostpool_category_variables() {}
				}
				if ( ! function_exists( 'ghostpool_get_hub_id' ) ) {
					function ghostpool_get_hub_id() {}
				}
				if ( ! function_exists( 'ghostpool_ratings' ) ) {
					function ghostpool_ratings() {}
				}
				if ( ! function_exists( 'ghostpool_prefix_hub_title' ) ) {
					function ghostpool_prefix_hub_title() {}
				}
				if ( ! function_exists( 'ghostpool_excerpt' ) ) {
					function ghostpool_excerpt() {}
				}
				if ( ! function_exists( 'ghostpool_pagination' ) ) {
					function ghostpool_pagination() {}
				}
				
					
				/*--------------------------------------------------------------
				Shortcode Options
				--------------------------------------------------------------*/
			
				function ghostpool_shortcode_options( $atts ) {
				
					$GLOBALS['ghostpool_cats'] = isset( $atts['cats'] ) ? $atts['cats'] : '';
					$GLOBALS['ghostpool_hub_field_slugs'] = isset( $atts['hub_fields'] ) ? $atts['hub_fields'] : '';
					$GLOBALS['ghostpool_post_association'] = isset( $atts['post_association'] ) ? $atts['post_association'] : 'enabled';
					$GLOBALS['ghostpool_post_types'] = isset( $atts['post_types'] ) ? $atts['post_types'] : 'post';
					if ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'portfolio' ) {
						$GLOBALS['ghostpool_format'] = isset( $atts['format'] ) ? $atts['format'] : 'portfolio-columns-2';
					} else {
						$GLOBALS['ghostpool_format'] = isset( $atts['format'] ) ? $atts['format'] : 'blog-standard';
					}	
					if ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'videos' ) {
						$GLOBALS['ghostpool_size'] = isset( $atts['size'] ) ? $atts['size'] : 'blog-small-size';
					} else {
						$GLOBALS['ghostpool_size'] = isset( $atts['size'] ) ? $atts['size'] : 'blog-standard-size';
					}	
					if ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'ranking' ) {
						$GLOBALS['ghostpool_orderby'] =  isset( $atts['orderby'] ) ? $atts['orderby'] : 'site_rating';
					} else {
						$GLOBALS['ghostpool_orderby'] =  isset( $atts['orderby'] ) ? $atts['orderby'] : 'newest';
					}
					$GLOBALS['ghostpool_date_posted'] = isset( $atts['date_posted'] ) ? $atts['date_posted'] : 'all';
					$GLOBALS['ghostpool_date_modified'] = isset( $atts['date_modified'] ) ? $atts['date_modified'] : 'all';
					$GLOBALS['ghostpool_filter'] = isset( $atts['filter'] ) ? $atts['filter'] : 'disabled';
					$GLOBALS['ghostpool_filter_cats'] = isset( $atts['filter_cats'] ) ? $atts['filter_cats'] : '';
					$GLOBALS['ghostpool_filter_date'] = isset( $atts['filter_date'] ) ? $atts['filter_date'] : '';
					$GLOBALS['ghostpool_filter_title'] = isset( $atts['filter_title'] ) ? $atts['filter_title'] : '';
					$GLOBALS['ghostpool_filter_comment_count'] = isset( $atts['filter_comment_count'] ) ? $atts['filter_comment_count'] : '';
					$GLOBALS['ghostpool_filter_views'] = isset( $atts['filter_views'] ) ? $atts['filter_views'] : '';
					$GLOBALS['ghostpool_filter_followers'] = isset( $atts['filter_followers'] ) ? $atts['filter_followers'] : '';
					$GLOBALS['ghostpool_filter_site_rating'] = isset( $atts['filter_site_rating'] ) ? $atts['filter_site_rating'] : '';
					$GLOBALS['ghostpool_filter_user_rating'] = isset( $atts['filter_user_rating'] ) ? $atts['filter_user_rating'] : '';
					$GLOBALS['ghostpool_filter_hub_awards'] = isset( $atts['filter_hub_awards'] ) ? $atts['filter_hub_awards'] : '';
					$GLOBALS['ghostpool_filter_date_posted'] = isset( $atts['filter_date_posted'] ) ? $atts['filter_date_posted'] : '';
					$GLOBALS['ghostpool_filter_date_modified'] = isset( $atts['filter_date_modified'] ) ? $atts['filter_date_modified'] : '';
					$GLOBALS['ghostpool_filter_cats_id'] = isset( $atts['filter_cats_id'] ) ? $atts['filter_cats_id'] : '';
					if ( isset( $GLOBALS['ghostpool_shortcode'] ) && ( $GLOBALS['ghostpool_shortcode'] == 'blog' OR $GLOBALS['ghostpool_shortcode'] == 'portfolio' ) ) {
						$GLOBALS['ghostpool_per_page'] = isset( $atts['per_page'] ) ? $atts['per_page'] : '12';
					} else {
						$GLOBALS['ghostpool_per_page'] = isset( $atts['per_page'] ) ? $atts['per_page'] : '5';
					}		
					$GLOBALS['ghostpool_offset'] = isset( $atts['offset'] ) ? $atts['offset'] : '';
					$GLOBALS['ghostpool_featured_image'] = isset( $atts['featured_image'] ) ? $atts['featured_image'] : 'enabled';
					if ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'videos' ) {
						$GLOBALS['ghostpool_image_width'] = isset( $atts['image_width'] ) ? $atts['image_width'] : '75';
					} elseif ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'featured' ) {
						$GLOBALS['ghostpool_image_width'] = isset( $atts['image_width'] ) ? $atts['image_width'] : '264';
					} else {
						$GLOBALS['ghostpool_image_width'] = isset( $atts['image_width'] ) ? $atts['image_width'] : '140';
					}
					if ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'videos' ) {
						$GLOBALS['ghostpool_image_height'] = isset( $atts['image_height'] ) ? $atts['image_height'] : '75';
					} elseif ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'featured' ) {
						$GLOBALS['ghostpool_image_height'] = isset( $atts['image_height'] ) ? $atts['image_height'] : '264';			
					} else {
						$GLOBALS['ghostpool_image_height'] = isset( $atts['image_height'] ) ? $atts['image_height'] : '140';	
					}
					$GLOBALS['ghostpool_hard_crop'] = isset( $atts['hard_crop'] ) ? $atts['hard_crop'] : 'enabled';
					$GLOBALS['ghostpool_image_alignment'] = isset( $atts['image_alignment'] ) ? $atts['image_alignment'] : 'image-align-left';
					$GLOBALS['ghostpool_title_position'] = isset( $atts['title_position'] ) ? $atts['title_position'] : 'title-next-to-thumbnail';
					$GLOBALS['ghostpool_content_display'] = isset( $atts['content_display'] ) ? $atts['content_display'] : 'excerpt';
					if ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'blog' ) {
						$GLOBALS['ghostpool_excerpt_length'] = isset( $atts['excerpt_length'] ) ? $atts['excerpt_length'] : '160';
					} elseif ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'news' ) {
						$GLOBALS['ghostpool_excerpt_length'] = isset( $atts['excerpt_length'] ) ? $atts['excerpt_length'] : '100';
					} elseif ( isset( $GLOBALS['ghostpool_shortcode'] ) && $GLOBALS['ghostpool_shortcode'] == 'featured' ) {
						$GLOBALS['ghostpool_excerpt_length'] = isset( $atts['excerpt_length'] ) ? $atts['excerpt_length'] : '250';
					} else {
						$GLOBALS['ghostpool_excerpt_length'] = isset( $atts['excerpt_length'] ) ? $atts['excerpt_length'] : '0';		
					}
					$GLOBALS['ghostpool_meta_author'] = isset( $atts['meta_author'] ) ? $atts['meta_author'] : '';
					$GLOBALS['ghostpool_meta_date'] = isset( $atts['meta_date'] ) ? $atts['meta_date'] : '';
					$GLOBALS['ghostpool_meta_comment_count'] = isset( $atts['meta_comment_count'] ) ? $atts['meta_comment_count'] : '';
					$GLOBALS['ghostpool_meta_views'] = isset( $atts['meta_views'] ) ? $atts['meta_views'] : '';
					$GLOBALS['ghostpool_meta_followers'] = isset( $atts['meta_followers'] ) ? $atts['meta_followers'] : '';
					$GLOBALS['ghostpool_meta_cats'] = isset( $atts['meta_cats'] ) ? $atts['meta_cats'] : '';
					$GLOBALS['ghostpool_meta_tags'] = isset( $atts['meta_tags'] ) ? $atts['meta_tags'] : '';
					$GLOBALS['ghostpool_meta_hub_cats'] = isset( $atts['meta_hub_cats'] ) ? $atts['meta_hub_cats'] : '';
					$GLOBALS['ghostpool_meta_hub_fields'] = isset( $atts['meta_hub_fields'] ) ? $atts['meta_hub_fields'] : '';
					$GLOBALS['ghostpool_meta_hub_award'] = isset( $atts['meta_hub_award'] ) ? $atts['meta_hub_award'] : '';	
					$GLOBALS['ghostpool_hub_cats_selected'] = function_exists( 'ghostpool_option' ) ? ghostpool_option( 'hub_cat_cats' ) : '';
					$GLOBALS['ghostpool_hub_fields'] = function_exists( 'ghostpool_option' ) ? ghostpool_option( 'hub_cat_fields' ) : '';		
					$GLOBALS['ghostpool_display_site_rating'] = isset( $atts['display_site_rating'] ) ? $atts['display_site_rating'] : '';
					$GLOBALS['ghostpool_display_user_rating'] = isset( $atts['display_user_rating'] ) ? $atts['display_user_rating'] : '';
					$GLOBALS['ghostpool_read_more_link'] = isset( $atts['read_more_link'] ) ? $atts['read_more_link'] : 'enabled';
					$GLOBALS['ghostpool_page_numbers'] = isset( $atts['page_numbers'] ) ? $atts['page_numbers'] : 'disabled';

					// Fallbacks
					if ( ! isset( $atts['meta_comment_count'] ) ) {
						$GLOBALS['ghostpool_meta_comment_count'] = isset( $atts['meta_comments'] ) ? $atts['meta_comments'] : $GLOBALS['ghostpool_meta_comment_count'];
					}	
					if ( ! isset( $atts['page_numbers'] ) ) {
						$GLOBALS['ghostpool_page_numbers'] = isset( $atts['pages'] ) ? $atts['pages'] : $GLOBALS['ghostpool_page_numbers'];
					}
					if ( ( isset( $atts['format'] ) && $atts['format'] == 'blog-columns' ) && ( isset( $atts['column_type'] ) && $atts['column_type'] == 'multiple-columns' ) ) {
						$GLOBALS['ghostpool_format'] = 'blog-columns-3';
					}
					if ( ( isset( $atts['format'] ) && $atts['format'] == 'blog-columns' ) && ( isset( $atts['column_type'] ) && $atts['column_type'] == 'single-column' ) ) {
						$GLOBALS['ghostpool_format'] = 'blog-columns-1';
					}
		
					// Convert hard_crop option to true or false
					if ( isset( $GLOBALS['ghostpool_hard_crop'] ) && $GLOBALS['ghostpool_hard_crop'] == 'enabled' ) {
						$GLOBALS['ghostpool_hard_crop'] = true;
					} elseif ( isset( $GLOBALS['ghostpool_hard_crop'] ) && $GLOBALS['ghostpool_hard_crop'] == 'disabled' ) {	
						$GLOBALS['ghostpool_hard_crop'] = false;
					}	
						
					// Add slug support for filter categories option
					if ( ! is_numeric( $GLOBALS['ghostpool_filter_cats_id'] ) ) {
						$taxonomies = get_taxonomies();
						foreach ( $taxonomies as $taxonomy ) {
							$term = term_exists( $GLOBALS['ghostpool_filter_cats_id'], $taxonomy );
							$tax_name = '';
							if ( $term !== 0 && $term !== null ) {
								$tax_name = $taxonomy;
								break;
							}
						}		
						$filter_cats_slug = get_term_by( 'slug', $GLOBALS['ghostpool_filter_cats_id'], $tax_name );
						if ( $filter_cats_slug ) {
							$GLOBALS['ghostpool_filter_cats_id'] = $filter_cats_slug->term_id;
						}
					}
	
				}
				
			
				/*--------------------------------------------------------------
				Custom Shortcodes
				--------------------------------------------------------------*/
		
				// Only load admin CSS if using theme
				if ( file_exists( get_template_directory_uri() . '/lib/framework/css/admin.css' ) ) {
					$admin_css = get_template_directory_uri() . '/lib/framework/css/admin.css';
				} else {
					$admin_css = '';
				}
				
				// Only load JS files if using theme
				if ( file_exists( get_template_directory_uri() . '/lib/scripts/jquery.flexslider-min.js' ) ) {
					$flexslider_js = get_template_directory_uri() . '/lib/scripts/jquery.flexslider-min.js';
				} else {
					$flexslider_js = '';
				}
				if ( file_exists( get_template_directory_uri() . '/lib/scripts/isotope.pkgd.min.js' ) ) {
					$masonry_js = array( get_template_directory_uri() . '/lib/scripts/isotope.pkgd.min.js', get_template_directory_uri() . '/lib/scripts/imagesLoaded.min.js' );
				} else {
					$masonry_js = '';
				}


				/*--------------------------------------------------------------
				Advertisement Shortcode
				--------------------------------------------------------------*/
						
				require_once( sprintf( "%s/gp_vc_advertisement.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'Advertisement', 'gauge-plugin' ),
					'deprecated' => '5.7',
					'base' => 'advertisement',
					'description' => esc_html__( 'Insert an advertisement anywhere you can insert this element.', 'gauge-plugin' ),
					'class' => 'wpb_vc_advertisement',
					'controls' => 'full',
					'icon' => 'gp-icon-advertisement',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'params' => array(	
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title at the top of the element.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),	
						array( 
						'heading' => esc_html__( 'Advertisement Code', 'gauge-plugin' ),
						'description' => esc_html__( 'The advertisement code.', 'gauge-plugin' ),
						'param_name' => 'content',
						'value' => '',
						'type' => 'textarea_html',
						),	
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'type' => 'textfield',
						),
					 )
				) );
	
		
				/*--------------------------------------------------------------
				Blog Shortcode
				--------------------------------------------------------------*/

				require_once( sprintf( "%s/gp_vc_blog.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'Blog', 'gauge-plugin' ),
					'base' => 'blog',
					'description' => esc_html__( 'Display posts, pages and custom post types in a variety of ways.', 'gauge-plugin' ),
					'class' => 'wpb_vc_blog',
					'controls' => 'full',
					'icon' => 'gp-icon-blog',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),			
					'admin_enqueue_css' => $admin_css,
					'front_enqueue_css' => $admin_css,
					'front_enqueue_js' => $masonry_js,
					'params' => array(		
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title at the top of the element.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),				
						array( 
						'heading' => esc_html__( 'Categories', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slugs or IDs separating each one with a comma e.g. xbox,ps3,pc.', 'gauge-plugin' ),
						'param_name' => 'cats',
						'type' => 'textfield',
						),			
						array( 
						'heading' => esc_html__( 'Hub Fields', 'gauge-plugin' ),
						'description' => wp_kses( __( 'Enter the hub fields you want to filter by. Add your taxonomy slug followed by a colon. Next enter your terms separating each by a colon also. Next add a comma and then enter the next taxonomy and so on e.g. <code>taxonomy-1:term-1:term-2,taxonomy-2:term-1,taxonomy-3:term-1:term-2</code>, this would translate to <code>genre:action:role-playing,publisher:namco,developed-by:namco:bluepoint-games</code>', 'gauge-plugin' ),  array( 'code' => array() ) ),
						'param_name' => 'hub_fields',
						'type' => 'textfield',
						'value' => '',
						),								
						array( 
						'heading' => esc_html__( 'Post Association', 'gauge-plugin' ),
						'description' => esc_html__( 'Only show posts associated with the parent hub page.', 'gauge-plugin' ),
						'param_name' => 'post_association',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Post Types', 'gauge-plugin' ),
						'description' => esc_html__( 'The post types to display.', 'gauge-plugin' ),
						'param_name' => 'post_types',
						'value' => 'post',
						'type' => 'posttypes',
						),
						array( 
						'heading' => esc_html__( 'Format', 'gauge-plugin' ),
						'description' => esc_html__( 'The format to display the items in.', 'gauge-plugin' ),
						'param_name' => 'format',
						'value' => array( esc_html__( 'Standard', 'gauge-plugin' ) => 'blog-standard', esc_html__( 'Large', 'gauge-plugin' ) => 'blog-large', esc_html__( '1 Column', 'gauge-plugin' ) => 'blog-columns-1', esc_html__( '2 Columns', 'gauge-plugin' ) => 'blog-columns-2', esc_html__( '3 Columns', 'gauge-plugin' ) => 'blog-columns-3', esc_html__( '4 Columns', 'gauge-plugin' ) => 'blog-columns-4', esc_html__( '5 Columns', 'gauge-plugin' ) => 'blog-columns-5', esc_html__( '6 Columns', 'gauge-plugin' ) => 'blog-columns-6', esc_html__( 'Masonry', 'gauge-plugin' ) => 'blog-masonry' ),
						'type' => 'dropdown',
						),		
						array( 
						'heading' => esc_html__( 'Size', 'gauge-plugin' ),
						'description' => esc_html__( 'The size to display the items at.', 'gauge-plugin' ),
						'param_name' => 'size',
						'value' => array( esc_html__( 'Standard', 'gauge-plugin' ) => 'blog-standard-size', esc_html__( 'Small', 'gauge-plugin' ) => 'blog-small-size' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Order By', 'gauge-plugin' ),
						'description' => esc_html__( 'The criteria which the items are ordered by.', 'gauge-plugin' ),
						'param_name' => 'orderby',
						'value' => array(
							esc_html__( 'Newest', 'gauge-plugin' ) => 'newest',
							esc_html__( 'Oldest', 'gauge-plugin' ) => 'oldest',
							esc_html__( 'Title (A-Z)', 'gauge-plugin' ) => 'title_az',
							esc_html__( 'Title (Z-A)', 'gauge-plugin' ) => 'title_za',
							esc_html__( 'Most Comments', 'gauge-plugin' ) => 'comment_count',
							esc_html__( 'Most Views', 'gauge-plugin' ) => 'views',
							esc_html__( 'Most Followers', 'gauge-plugin' ) => 'followers',
							esc_html__( 'Top Site Rated', 'gauge-plugin' ) => 'site_rating',
							esc_html__( 'Top User Rated', 'gauge-plugin' ) => 'user_rating',
							esc_html__( 'Hub Awards', 'gauge-plugin' ) => 'hub_awards',
							esc_html__( 'Menu Order', 'gauge-plugin' ) => 'menu_order',
							esc_html__( 'Random', 'gauge-plugin' ) => 'rand',
						),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Date Posted', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were posted.', 'gauge-plugin' ),
						'param_name' => 'date_posted',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Date Modified', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were modified.', 'gauge-plugin' ),
						'param_name' => 'date_modified',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Filter', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge-plugin' ),
						'param_name' => 'filter',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),	
						array(
						'heading' => esc_html__( 'Filter Options', 'gauge-plugin' ),
						'param_name' => 'filter_cats',
						'value' => array( esc_html__( 'Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),	
						array(
						'param_name' => 'filter_date',
						'value' => array( esc_html__( 'Date', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),	
						array(
						'param_name' => 'filter_title',
						'value' => array( esc_html__( 'Title', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),								
						array(
						'param_name' => 'filter_comment_count',
						'value' => array( esc_html__( 'Comment Count', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),
						array(
						'param_name' => 'filter_views',
						'value' => array( esc_html__( 'Views', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),	
						array(
						'param_name' => 'filter_followers',
						'value' => array( esc_html__( 'Followers', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),									
						array(
						'param_name' => 'filter_site_rating',
						'value' => array( esc_html__( 'Site Rating', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),	
						array(
						'param_name' => 'filter_user_rating',
						'value' => array( esc_html__( 'User Rating', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),
						array( 
						'param_name' => 'filter_hub_awards',
						'value' => array( esc_html__( 'Hub Awards', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),
						array( 
						'param_name' => 'filter_date_posted',
						'value' => array( esc_html__( 'Date Posted', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),				
						array( 
						'description' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge-plugin' ),
						'param_name' => 'filter_date_modified',
						'value' => array( esc_html__( 'Date Modified', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),				
						array( 
						'heading' => esc_html__( 'Filter Category', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slug or ID number of the category you want to filter by, leave blank to display all categories - the sub categories of this category will also be displayed.', 'gauge-plugin' ),
						'param_name' => 'filter_cats_id',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),																				 
						array( 
						'heading' => esc_html__( 'Items Per Page', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of items on each page.', 'gauge-plugin' ),
						'param_name' => 'per_page',
						'value' => '12',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Offset', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of posts to offset by e.g. set to 3 to exclude the first 3 posts.', 'gauge-plugin' ),
						'param_name' => 'offset',
						'value' => '',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Featured Image', 'gauge-plugin' ),
						'description' => esc_html__( 'Display the featured images.', 'gauge-plugin' ),
						'param_name' => 'featured_image',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the featured images.', 'gauge-plugin' ),
						'param_name' => 'image_width',
						'value' => '140',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),		 
						array( 
						'heading' => esc_html__( 'Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the featured images.', 'gauge-plugin' ),
						'param_name' => 'image_height',
						'value' => '140',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Hard Crop', 'gauge-plugin' ),
						'description' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge-plugin' ),
						'param_name' => 'hard_crop',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Image Alignment', 'gauge-plugin' ),
						'description' => esc_html__( 'Choose how the image aligns with the content.', 'gauge-plugin' ),
						'param_name' => 'image_alignment',
						'value' => array( esc_html__( 'Left Align', 'gauge-plugin' ) => 'image-align-left', esc_html__( 'Right Align', 'gauge-plugin' ) => 'image-align-right', esc_html__( 'Left Wrap', 'gauge-plugin' ) => 'image-wrap-left', esc_html__( 'Right Wrap', 'gauge-plugin' ) => 'image-wrap-right', esc_html__( 'Above Content', 'gauge-plugin' ) => 'image-above' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),
						array( 
						'heading' => esc_html__( 'Title Position', 'gauge-plugin' ),
						'description' => esc_html__( 'The position of the title.', 'gauge-plugin' ),
						'param_name' => 'title_position',
						'value' => array( esc_html__( 'Next To Thumbnail', 'gauge-plugin' ) => 'title-next-to-thumbnail', esc_html__( 'Over Thumbnail', 'gauge-plugin' ) => 'title-over-thumbnail' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Content Display', 'gauge-plugin' ),
						'description' => esc_html__( 'The amount of content displayed.', 'gauge-plugin' ),
						'param_name' => 'content_display',
						'value' => array( esc_html__( 'Excerpt', 'gauge-plugin' ) => 'excerpt', esc_html__( 'Full Content', 'gauge-plugin' ) => 'full_content' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Excerpt Length', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of characters in excerpts.', 'gauge-plugin' ),
						'param_name' => 'excerpt_length',
						'value' => '160',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'content_display', 'value' => 'excerpt' ),
						),	
						array(
						'heading' => esc_html__( 'Post Meta', 'gauge-plugin' ),
						'param_name' => 'meta_author',
						'value' => array( esc_html__( 'Author Name', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array(
						'param_name' => 'meta_date',
						'value' => array( esc_html__( 'Post Date', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),			
						array(
						'param_name' => 'meta_comment_count',
						'value' => array( esc_html__( 'Comment Count', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),		
						array(
						'param_name' => 'meta_views',
						'value' => array( esc_html__( 'Views', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),		
						array(
						'param_name' => 'meta_followers',
						'value' => array( esc_html__( 'Followers', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array( 
						'param_name' => 'meta_cats',
						'value' => array( esc_html__( 'Post Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array(
						'param_name' => 'meta_tags',
						'value' => array( esc_html__( 'Post Tags', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array(
						'param_name' => 'meta_hub_cats',
						'value' => array( esc_html__( 'Hub Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),					
						array(
						'param_name' => 'meta_hub_fields',
						'value' => array( esc_html__( 'Hub Fields', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array(
						'description' => esc_html__( 'Select the meta data you want to display.', 'gauge-plugin' ),
						'param_name' => 'meta_hub_award',
						'value' => array( esc_html__( 'Hub Award', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array(
						'heading' => esc_html__( 'Ratings', 'gauge-plugin' ),
						'param_name' => 'display_site_rating',
						'value' => array( esc_html__( 'Site Rating', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),					
						array(
						'description' => esc_html__( 'Select the ratings you want to display.', 'gauge-plugin' ),
						'param_name' => 'display_user_rating',
						'value' => array( esc_html__( 'User Rating', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),								
						array( 
						'heading' => esc_html__( 'Read More Link', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a read more link below the content.', 'gauge-plugin' ),
						'param_name' => 'read_more_link',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),		 
						array( 
						'heading' => esc_html__( 'Pagination', 'gauge-plugin' ),
						'description' => esc_html__( 'Add pagination.', 'gauge-plugin' ),
						'param_name' => 'page_numbers',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'See All', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'See All Link', 'gauge-plugin' ),
						'description' => esc_html__( 'URL for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_link',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),				 			 
						array( 
						'heading' => esc_html__( 'See All Text', 'gauge-plugin' ),
						'description' => esc_html__( 'Custom text for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_text',
						'type' => 'textfield',
						'value' => esc_html__( 'See All Items', 'gauge-plugin' ),
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),	 			 				 		   			 			 
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'type' => 'textfield',
						),																																								
					 )
				) );


				/*--------------------------------------------------------------
				Featured Shortcode
				--------------------------------------------------------------*/
		
				require_once( sprintf( "%s/gp_vc_featured.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'Featured', 'gauge-plugin' ),
					'base' => 'featured',
					'description' => esc_html__( 'Catch the attention of your visitors with a featured post or page.', 'gauge-plugin' ),
					'class' => 'wpb_vc_featured',
					'controls' => 'full',
					'icon' => 'gp-icon-featured',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'params' => array(		
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title that appears faded in the background.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),				
						array( 
						'heading' => esc_html__( 'Post Slug/ID', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slug or ID.', 'gauge-plugin' ),
						'param_name' => 'post_id',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Page Slug/ID', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slug or ID.', 'gauge-plugin' ),
						'param_name' => 'page_id',
						'type' => 'textfield',
						),				
						array( 
						'heading' => esc_html__( 'Featured Image', 'gauge-plugin' ),
						'description' => esc_html__( 'Display the featured images.', 'gauge-plugin' ),
						'param_name' => 'featured_image',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the featured images.', 'gauge-plugin' ),
						'param_name' => 'image_width',
						'value' => '264',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),		 
						array( 
						'heading' => esc_html__( 'Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the featured images.', 'gauge-plugin' ),
						'param_name' => 'image_height',
						'value' => '264',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Hard Crop', 'gauge-plugin' ),
						'description' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge-plugin' ),
						'param_name' => 'hard_crop',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Image Alignment', 'gauge-plugin' ),
						'description' => esc_html__( 'Choose how the image aligns with the content.', 'gauge-plugin' ),
						'param_name' => 'image_alignment',
						'value' => array( esc_html__( 'Left Align', 'gauge-plugin' ) => 'image-align-left', esc_html__( 'Left Wrap', 'gauge-plugin' ) => 'image-wrap-left', esc_html__( 'Right Wrap', 'gauge-plugin' ) => 'image-wrap-right', esc_html__( 'Above Content', 'gauge-plugin' ) => 'image-above', esc_html__( 'Right Align', 'gauge-plugin' ) => 'image-align-right' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),
						array( 
						'heading' => esc_html__( 'Title Position', 'gauge-plugin' ),
						'description' => esc_html__( 'The position of the title.', 'gauge-plugin' ),
						'param_name' => 'title_position',
						'value' => array( esc_html__( 'Next To Thumbnail', 'gauge-plugin' ) => 'title-next-to-thumbnail', esc_html__( 'Over Thumbnail', 'gauge-plugin' ) => 'title-over-thumbnail' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Content Display', 'gauge-plugin' ),
						'description' => esc_html__( 'The amount of content displayed.', 'gauge-plugin' ),
						'param_name' => 'content_display',
						'value' => array( esc_html__( 'Excerpt', 'gauge-plugin' ) => 'excerpt', esc_html__( 'Full Content', 'gauge-plugin' ) => 'full_content' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Excerpt Length', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of characters in excerpts.', 'gauge-plugin' ),
						'param_name' => 'excerpt_length',
						'value' => '250',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'content_display', 'value' => 'excerpt' ),
						),	
						array(
						'heading' => esc_html__( 'Post Meta', 'gauge-plugin' ),
						'param_name' => 'meta_author',
						'value' => array( esc_html__( 'Author Name', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array(
						'param_name' => 'meta_date',
						'value' => array( esc_html__( 'Post Date', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),				
						array(
						'param_name' => 'meta_views',
						'value' => array( esc_html__( 'Views', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),				
						array(
						'param_name' => 'meta_followers',
						'value' => array( esc_html__( 'Followers', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array(
						'param_name' => 'meta_comment_count',
						'value' => array( esc_html__( 'Comment Count', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array( 
						'param_name' => 'meta_cats',
						'value' => array( esc_html__( 'Post Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array(
						'param_name' => 'meta_tags',
						'value' => array( esc_html__( 'Post Tags', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array(
						'param_name' => 'meta_hub_cats',
						'value' => array( esc_html__( 'Hub Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),					
						array(
						'param_name' => 'meta_hub_fields',
						'value' => array( esc_html__( 'Hub Fields', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array(
						'description' => esc_html__( 'Select the meta data you want to display.', 'gauge-plugin' ),
						'param_name' => 'meta_hub_award',
						'value' => array( esc_html__( 'Hub Award', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),				
						array(
						'heading' => esc_html__( 'Ratings', 'gauge-plugin' ),
						'param_name' => 'display_site_rating',
						'value' => array( esc_html__( 'Site Rating', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),					
						array(
						'description' => esc_html__( 'Select the ratings you want to display.', 'gauge-plugin' ),
						'param_name' => 'display_user_rating',
						'value' => array( esc_html__( 'User Rating', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),								
						array( 
						'heading' => esc_html__( 'Read More Link', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a read more link below the content.', 'gauge-plugin' ),
						'param_name' => 'read_more_link',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),		 		   			 			 
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'type' => 'textfield',
						),
						array(
						'heading' => esc_html__( 'CSS', 'gauge-plugin' ),
						'type' => 'css_editor',
						'param_name' => 'css',
						'group' => esc_html__( 'Design options', 'gauge-plugin' ),
						),	
						array( 
						'heading' => esc_html__( 'Text Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The color of the text.', 'gauge-plugin' ),
						'param_name' => 'text_color',
						'value' => '',
						'type' => 'colorpicker',
						'group' => esc_html__( 'Design options', 'gauge-plugin' ),
						),
						array( 
						'heading' => esc_html__( 'Background Overlay', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a background overlay to the featured content.', 'gauge-plugin' ),
						'param_name' => 'background_overlay',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						'group' => esc_html__( 'Design options', 'gauge-plugin' ),
						),																																														
					 )
				) );


				/*--------------------------------------------------------------
				Filters Shortcode
				--------------------------------------------------------------*/
		
				require_once( sprintf( "%s/gp_vc_filters.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'Filters', 'gauge-plugin' ),
					'base' => 'filters',
					'description' => esc_html__( 'Add filters to your category pages.', 'gauge-plugin' ),
					'class' => 'wpb_vc_filters',
					'controls' => 'full',
					'icon' => 'gp-icon-filters',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'params' => array( 			
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title at the top of the element.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),
						array( 
						'heading' => esc_html__( 'Parent Hub Category', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slug or ID of the parent category you want your filters based on.', 'gauge-plugin' ),
						'param_name' => 'parent_cat',
						'type' => 'textfield',
						),
						/*array( 
						'heading' => esc_html__( 'Categories', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slugs or IDs separating each one with a comma e.g. xbox,ps3,pc.', 'gauge-plugin' ),
						'param_name' => 'cats',
						'type' => 'textfield',
						),*/
						array( 
						'heading' => esc_html__( 'Date Posted', 'gauge-plugin' ),
						'param_name' => 'date_posted',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'description' => esc_html__( 'Choose whether to add the date posted filter.', 'gauge-plugin' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Date Modified', 'gauge-plugin' ),
						'param_name' => 'date_modified',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'description' => esc_html__( 'Choose whether to add the date modified filter.', 'gauge-plugin' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Hub Fields', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slugs of the hub fields you want to add to the filter options, separating each with a comma e.g. genre,release-date,developed-by.', 'gauge-plugin' ),
						'param_name' => 'fields',
						'type' => 'textfield',
						),	
						array( 
						'heading' => esc_html__( 'Date Posted Text', 'gauge-plugin' ),
						'description' => esc_html__( 'The text used for the date posted dropdown menu.', 'gauge-plugin' ),
						'param_name' => 'date_posted_text',
						'value' =>  esc_html__( 'Release Date', 'gauge-plugin' ),
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Date Modified Text', 'gauge-plugin' ),
						'description' => esc_html__( 'The text used for the date modified dropdown menu.', 'gauge-plugin' ),
						'param_name' => 'date_modified_text',
						'value' => esc_html__( 'Last Updated', 'gauge-plugin' ),
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Parent Category Text', 'gauge-plugin' ),
						'description' => esc_html__( 'The text used for the parent category dropdown menu.', 'gauge-plugin' ),
						'param_name' => 'parent_cat_text',
						'value' =>  esc_html__( 'Categories', 'gauge-plugin' ),
						'type' => 'textfield',
						),		
						array( 
						'heading' => esc_html__( 'Submit Button Text', 'gauge-plugin' ),
						'description' => esc_html__( 'The text used for the submit button.', 'gauge-plugin' ),
						'param_name' => 'submit_button_text',
						'value' =>  esc_html__( 'Filter Items', 'gauge-plugin' ),
						'type' => 'textfield',
						),			
						array( 
						'heading' => esc_html__( 'Background Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The background color.', 'gauge-plugin' ),
						'param_name' => 'bg_color',
						'value' => '',
						'type' => 'colorpicker',
						'group' => esc_html__( 'Design options', 'gauge-plugin' ),
						),
						array( 
						'heading' => esc_html__( 'Border Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The border color.', 'gauge-plugin' ),
						'param_name' => 'border_color',
						'value' => '',
						'type' => 'colorpicker',
						'group' => esc_html__( 'Design options', 'gauge-plugin' ),
						),																																									
					 )
				) );
		
		
				/*--------------------------------------------------------------
				Images Shortcode
				--------------------------------------------------------------*/

				require_once( sprintf( "%s/gp_vc_images.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'Images', 'gauge-plugin' ),
					'base' => 'images',
					'description' => esc_html__( 'Display a list of images.', 'gauge-plugin' ),
					'class' => 'wpb_vc_images',
					'controls' => 'full',
					'icon' => 'gp-icon-images',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'params' => array(
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title at the top of the element.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),
						array( 
						'heading' => esc_html__( 'Upload Images', 'gauge-plugin' ),
						'description' => esc_html__( 'Manually upload images or leave empty to display images from the child page using the Images page template.', 'gauge-plugin' ),
						'param_name' => 'upload_images',
						'type' => 'attach_images',
						'value' => '',
						),				
						array( 
						'heading' => esc_html__( 'Number Of Images', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of images to display.', 'gauge-plugin' ),
						'param_name' => 'number',
						'type' => 'textfield',
						'value' => '8',
						),	
						array( 
						'heading' => esc_html__( 'Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the images.', 'gauge-plugin' ),
						'param_name' => 'image_width',
						'value' => '114',
						'type' => 'textfield',
						),		 
						array( 
						'heading' => esc_html__( 'Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the images.', 'gauge-plugin' ),
						'param_name' => 'image_height',
						'value' => '118',
						'type' => 'textfield',
						),	
						array( 
						'heading' => esc_html__( 'Hard Crop', 'gauge-plugin' ),
						'description' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge-plugin' ),
						'param_name' => 'hard_crop',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),			 			
						array( 
						'heading' => esc_html__( 'See All', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'See All Link', 'gauge-plugin' ),
						'description' => esc_html__( 'URL for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_link',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),				 			 
						array( 
						'heading' => esc_html__( 'See All Text', 'gauge-plugin' ),
						'description' => esc_html__( 'Custom text for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_text',
						'type' => 'textfield',
						'value' => esc_html__( 'See All Images', 'gauge-plugin' ),
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),					 			 						 		   			 			 
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'type' => 'textfield',
						'param_name' => 'classes',
						'value' => '',
						),																																								
					 )
				) );
		

				/*--------------------------------------------------------------
				News Shortcode
				--------------------------------------------------------------*/

				require_once( sprintf( "%s/gp_vc_news.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'News', 'gauge-plugin' ),
					'base' => 'news',
					'description' => esc_html__( 'Display your news posts in a variety of ways.', 'gauge-plugin' ),
					'class' => 'wpb_vc_news',
					'controls' => 'full',
					'icon' => 'gp-icon-news',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'front_enqueue_js' => $masonry_js,
					'params' => array( 		
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title at the top of the element.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),		
						array( 
						'heading' => esc_html__( 'Categories', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slugs or IDs separating each one with a comma e.g. xbox,ps3,pc.', 'gauge-plugin' ),
						'param_name' => 'cats',
						'type' => 'textfield',
						),				
						array( 
						'heading' => esc_html__( 'Post Association', 'gauge-plugin' ),
						'description' => esc_html__( 'Only show posts associated with the parent hub page.', 'gauge-plugin' ),
						'param_name' => 'post_association',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Format', 'gauge-plugin' ),
						'description' => esc_html__( 'The format to display the items in.', 'gauge-plugin' ),
						'param_name' => 'format',
						'value' => array( esc_html__( 'Standard', 'gauge-plugin' ) => 'blog-standard', esc_html__( 'Large', 'gauge-plugin' ) => 'blog-large', esc_html__( '1 Column', 'gauge-plugin' ) => 'blog-columns-1', esc_html__( '2 Columns', 'gauge-plugin' ) => 'blog-columns-2', esc_html__( '3 Columns', 'gauge-plugin' ) => 'blog-columns-3', esc_html__( '4 Columns', 'gauge-plugin' ) => 'blog-columns-4', esc_html__( '5 Columns', 'gauge-plugin' ) => 'blog-columns-5', esc_html__( '6 Columns', 'gauge-plugin' ) => 'blog-columns-6', esc_html__( 'Masonry', 'gauge-plugin' ) => 'blog-masonry' ),
						'type' => 'dropdown',
						),						
						array( 
						'heading' => esc_html__( 'Size', 'gauge-plugin' ),
						'description' => esc_html__( 'The size to display the items at.', 'gauge-plugin' ),
						'param_name' => 'size',
						'value' => array( esc_html__( 'Standard', 'gauge-plugin' ) => 'blog-standard-size', esc_html__( 'Small', 'gauge-plugin' ) => 'blog-small-size' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Order By', 'gauge-plugin' ),
						'description' => esc_html__( 'The criteria which the items are ordered by.', 'gauge-plugin' ),
						'param_name' => 'orderby',
						'value' => array(
							esc_html__( 'Newest', 'gauge-plugin' ) => 'newest',
							esc_html__( 'Oldest', 'gauge-plugin' ) => 'oldest',
							esc_html__( 'Title (A-Z)', 'gauge-plugin' ) => 'title_az',
							esc_html__( 'Title (Z-A)', 'gauge-plugin' ) => 'title_za',
							esc_html__( 'Most Comments', 'gauge-plugin' ) => 'comment_count',
							esc_html__( 'Most Views', 'gauge-plugin' ) => 'views',
							esc_html__( 'Menu Order', 'gauge-plugin' ) => 'menu_order',
							esc_html__( 'Random', 'gauge-plugin' ) => 'rand',
						),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Date Posted', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were posted.', 'gauge-plugin' ),
						'param_name' => 'date_posted',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Date Modified', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were modified.', 'gauge-plugin' ),
						'param_name' => 'date_modified',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Filter', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge-plugin' ),
						'param_name' => 'filter',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),	
						array(
						'heading' => esc_html__( 'Filter Options', 'gauge-plugin' ),
						'param_name' => 'filter_cats',
						'value' => array( esc_html__( 'Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),	
						array(
						'param_name' => 'filter_date',
						'value' => array( esc_html__( 'Date', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),	
						array(
						'param_name' => 'filter_title',
						'value' => array( esc_html__( 'Title', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),								
						array(
						'param_name' => 'filter_comment_count',
						'value' => array( esc_html__( 'Comment Count', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),
						array(
						'param_name' => 'filter_views',
						'value' => array( esc_html__( 'Views', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),
						array( 
						'param_name' => 'filter_date_posted',
						'value' => array( esc_html__( 'Date Posted', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),				
						array( 
						'description' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge-plugin' ),
						'param_name' => 'filter_date_modified',
						'value' => array( esc_html__( 'Date Modified', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),						
						array( 
						'heading' => esc_html__( 'Filter Category', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slug or ID number of the category you want to filter by, leave blank to display all categories - the sub categories of this category will also be displayed.', 'gauge-plugin' ),
						'param_name' => 'filter_cats_id',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),		
						array( 
						'heading' => esc_html__( 'Items Per Page', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of items on each page.', 'gauge-plugin' ),
						'param_name' => 'per_page',
						'value' => '5',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Offset', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of posts to offset by e.g. set to 3 to exclude the first 3 posts.', 'gauge-plugin' ),
						'param_name' => 'offset',
						'value' => '',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Featured Image', 'gauge-plugin' ),
						'description' => esc_html__( 'Display the featured images.', 'gauge-plugin' ),
						'param_name' => 'featured_image',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the featured images.', 'gauge-plugin' ),
						'param_name' => 'image_width',
						'value' => '140',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),		 
						array( 
						'heading' => esc_html__( 'Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the featured images.', 'gauge-plugin' ),
						'param_name' => 'image_height',
						'value' => '140',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Hard Crop', 'gauge-plugin' ),
						'description' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge-plugin' ),
						'param_name' => 'hard_crop',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Image Alignment', 'gauge-plugin' ),
						'description' => esc_html__( 'Choose how the image aligns with the content.', 'gauge-plugin' ),
						'param_name' => 'image_alignment',
						'value' => array( esc_html__( 'Left Align', 'gauge-plugin' ) => 'image-align-left', esc_html__( 'Left Wrap', 'gauge-plugin' ) => 'image-wrap-left', esc_html__( 'Right Wrap', 'gauge-plugin' ) => 'image-wrap-right', esc_html__( 'Above Content', 'gauge-plugin' ) => 'image-above', esc_html__( 'Right Align', 'gauge-plugin' ) => 'image-align-right' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),
						array( 
						'heading' => esc_html__( 'Title Position', 'gauge-plugin' ),
						'description' => esc_html__( 'The position of the title.', 'gauge-plugin' ),
						'param_name' => 'title_position',
						'value' => array( esc_html__( 'Next To Thumbnail', 'gauge-plugin' ) => 'title-next-to-thumbnail', esc_html__( 'Over Thumbnail', 'gauge-plugin' ) => 'title-over-thumbnail' ),
						'type' => 'dropdown',
						),				
						array( 
						'heading' => esc_html__( 'Content Display', 'gauge-plugin' ),
						'description' => esc_html__( 'The amount of content displayed.', 'gauge-plugin' ),
						'param_name' => 'content_display',
						'value' => array( esc_html__( 'Excerpt', 'gauge-plugin' ) => 'excerpt', esc_html__( 'Full Content', 'gauge-plugin' ) => 'full_content' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Excerpt Length', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of characters in excerpts.', 'gauge-plugin' ),
						'param_name' => 'excerpt_length',
						'value' => '100',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'content_display', 'value' => 'excerpt' ),
						),	
						array(
						'heading' => esc_html__( 'Post Meta', 'gauge-plugin' ),
						'param_name' => 'meta_author',
						'value' => array( esc_html__( 'Author Name', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array(
						'param_name' => 'meta_date',
						'value' => array( esc_html__( 'Post Date', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),				
						array(
						'param_name' => 'meta_views',
						'value' => array( esc_html__( 'Views', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),		
						array(
						'param_name' => 'meta_comment_count',
						'value' => array( esc_html__( 'Comment Count', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array( 
						'param_name' => 'meta_cats',
						'value' => array( esc_html__( 'Post Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array(
						'description' => esc_html__( 'Select the meta data you want to display.', 'gauge-plugin' ),
						'param_name' => 'meta_tags',
						'value' => array( esc_html__( 'Post Tags', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array( 
						'heading' => esc_html__( 'Read More Link', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a read more link below the content.', 'gauge-plugin' ),
						'param_name' => 'read_more_link',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),				 
						array( 
						'heading' => esc_html__( 'Pagination', 'gauge-plugin' ),
						'description' => esc_html__( 'Add pagination.', 'gauge-plugin' ),
						'param_name' => 'page_numbers',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),		 			
						array( 
						'heading' => esc_html__( 'See All', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'See All Link', 'gauge-plugin' ),
						'description' => esc_html__( 'URL for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_link',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),					 			 
						array( 
						'heading' => esc_html__( 'See All Text', 'gauge-plugin' ),
						'description' => esc_html__( 'Custom text for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_text',
						'type' => 'textfield',
						'value' => esc_html__( 'See All News', 'gauge-plugin' ),
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),		 				 		   			 			 
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'type' => 'textfield',
						),																																								
					 )
				) );
		
				
				/*--------------------------------------------------------------
				Portfolio Shortcode
				--------------------------------------------------------------*/

				require_once( sprintf( "%s/gp_vc_portfolio.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'Portfolio', 'gauge-plugin' ),
					'base' => 'portfolio',
					'description' => esc_html__( 'Display your portfolio items in a variety of ways.', 'gauge-plugin' ),
					'class' => 'wpb_vc_portfolio',
					'controls' => 'full',
					'icon' => 'gp-icon-portfolio',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'front_enqueue_js' => $masonry_js,
					'params' => array( 					
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title at the top of the element.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),		
						array( 
						'heading' => esc_html__( 'Format', 'gauge-plugin' ),
						'description' => esc_html__( 'The format to display the items in.', 'gauge-plugin' ),
						'param_name' => 'format',
						'value' => array( esc_html__( '2 Columns', 'gauge-plugin' ) => 'portfolio-columns-2', esc_html__( '3 Columns', 'gauge-plugin' ) => 'portfolio-columns-3', esc_html__( '4 Columns', 'gauge-plugin' ) => 'portfolio-columns-4', esc_html__( '5 Columns', 'gauge-plugin' ) => 'portfolio-columns-5', esc_html__( '6 Columns', 'gauge-plugin' ) => 'portfolio-columns-6', esc_html__( 'Masonry', 'gauge-plugin' ) => 'portfolio-masonry' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Categories', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slugs or IDs separating each one with a comma e.g. xbox,ps3,pc.', 'gauge-plugin' ),
						'param_name' => 'cats',
						'value' => '',
						'type' => 'textfield',
						),		 
						array( 
						'heading' => esc_html__( 'Order By', 'gauge-plugin' ),
						'description' => esc_html__( 'The criteria which the items are ordered by.', 'gauge-plugin' ),
						'param_name' => 'orderby',
						'value' => array(
							esc_html__( 'Newest', 'gauge-plugin' ) => 'newest',
							esc_html__( 'Oldest', 'gauge-plugin' ) => 'oldest',
							esc_html__( 'Title (A-Z)', 'gauge-plugin' ) => 'title_az',
							esc_html__( 'Title (Z-A)', 'gauge-plugin' ) => 'title_za',
							esc_html__( 'Most Comments', 'gauge-plugin' ) => 'comment_count',
							esc_html__( 'Most Views', 'gauge-plugin' ) => 'views',
							esc_html__( 'Menu Order', 'gauge-plugin' ) => 'menu_order',
							esc_html__( 'Random', 'gauge-plugin' ) => 'rand',
						),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Date Posted', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were posted.', 'gauge-plugin' ),
						'param_name' => 'date_posted',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Date Modified', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were modified.', 'gauge-plugin' ),
						'param_name' => 'date_modified',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),				
						array( 
						'heading' => esc_html__( 'Filter', 'gauge-plugin' ),
						'description' => esc_html__( 'Add category filter links to the page.', 'gauge-plugin' ),
						'param_name' => 'filter',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),			 
						array( 
						'heading' => esc_html__( 'Items Per Page', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of items on each page.', 'gauge-plugin' ),
						'param_name' => 'per_page',
						'value' => '12',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Offset', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of posts to offset by e.g. set to 3 to exclude the first 3 posts.', 'gauge-plugin' ),
						'param_name' => 'offset',
						'value' => '',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Pagination', 'gauge-plugin' ),
						'description' => esc_html__( 'Add pagination.', 'gauge-plugin' ),
						'param_name' => 'page_numbers',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'See All', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'See All Link', 'gauge-plugin' ),
						'description' => esc_html__( 'URL for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_link',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),					 			 
						array( 
						'heading' => esc_html__( 'See All Text', 'gauge-plugin' ),
						'description' => esc_html__( 'Custom text for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_text',
						'type' => 'textfield',
						'value' => esc_html__( 'See All Items', 'gauge-plugin' ),
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),						 		 				 		   			 			 
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'type' => 'textfield',
						),																																								
					 )
				) );


				/*--------------------------------------------------------------
				Pricing Table Shortcode
				--------------------------------------------------------------*/

				// Pricing Table
				vc_map( array( 
					'name' => esc_html__( 'Pricing Table', 'gauge-plugin' ),
					'base' => 'pricing_table',
					'description' => esc_html__( 'A table to compare the prices of different items.', 'gauge-plugin' ),
					'as_parent' => array( 'only' => 'pricing_column' ),
					'controls' => 'full',
					'icon' => 'gp-icon-pricing-table',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'js_view' => 'VcColumnView',
					'params' => array( 
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'type' => 'textfield',
						),	
					),
				 ) );

				// Pricing Column
				vc_map( array( 
					'name' => esc_html__( 'Pricing Column', 'gauge-plugin' ),
					'base' => 'pricing_column',
					'content_element' => true,
					'as_child' => array( 'only' => 'pricing_table' ),
					'icon' => 'gp-icon-pricing-table',
					'params' => array( 	
						array( 
						'heading' => esc_html__( 'Column Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title for the column.', 'gauge-plugin' ),
						'param_name' => 'title',
						'value' => '',
						'type' => 'textfield'
						),
						array( 
						'heading' => esc_html__( 'Price', 'gauge-plugin' ),
						'description' => esc_html__( 'The price for the column.', 'gauge-plugin' ),
						'param_name' => 'price',
						'value' => '',
						'type' => 'textfield'
						),
						array( 
						'heading' => esc_html__( 'Currency Symbol', 'gauge-plugin' ),
						'description' => esc_html__( 'The currency symbol.', 'gauge-plugin' ),
						'param_name' => 'currency_symbol',
						'value' => '',
						'type' => 'textfield',
						),		
						array( 
						'heading' => esc_html__( 'Interval', 'gauge-plugin' ),
						'description' => esc_html__( 'The interval for the column e.g. per week, per month.', 'gauge-plugin' ),
						'param_name' => 'interval',
						'value' => '',
						'type' => 'textfield',
						),		
						array( 
						'heading' => esc_html__( 'Highlight Column', 'gauge-plugin' ),
						'description' => esc_html__( 'Make this column stand out.', 'gauge-plugin' ),
						'param_name' => 'highlight',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown'
						),	
						array( 
						'heading' => esc_html__( 'Highlight Text', 'gauge-plugin' ),
						'description' => esc_html__( 'Add highlight text above the column title.', 'gauge-plugin' ),
						'param_name' => 'highlight_text',
						'value' => '',
						'dependency' => array( 'element' => 'highlight', 'value' => 'enabled' ),
						'type' => 'textfield',
						),	
						array( 
						'heading' => esc_html__( 'Content', 'gauge-plugin' ),
						'description' => esc_html__( 'Use the Unordered List button to create the points in your pricing column. You can also add shortcodes such as the [button link="#"] shortcode seen in the site demo.', 'gauge-plugin' ),
						'param_name' => 'content',
						'type' => 'textarea_html',
						),
						array( 
						'heading' => esc_html__( 'Highlight Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The highlight color.', 'gauge-plugin' ),
						'param_name' => 'highlight_color',
						'value' => '#f84103',
						'dependency' => array( 'element' => 'highlight', 'value' => 'enabled' ),
						'type' => 'colorpicker',
						),		
						array( 
						'heading' => esc_html__( 'Title Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The title color.', 'gauge-plugin' ),
						'param_name' => 'title_color',
						'value' => '#f84103',
						'dependency' => array( 'element' => 'highlight', 'value' => 'disabled' ),
						'type' => 'colorpicker',
						),	
						array( 
						'heading' => esc_html__( 'Highlight Title Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The highlight title color.', 'gauge-plugin' ),
						'param_name' => 'highlight_title_color',
						'value' => '#fff',
						'dependency' => array( 'element' => 'highlight', 'value' => 'enabled' ),
						'type' => 'colorpicker',
						),	
						array( 
						'heading' => esc_html__( 'Background Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The background color.', 'gauge-plugin' ),
						'param_name' => 'background_color',
						'value' => '#f7f7f7',
						'dependency' => array( 'element' => 'highlight', 'value' => 'disabled' ),
						'type' => 'colorpicker',
						),		 
						array( 
						'heading' => esc_html__( 'Highlight Background Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The highlight background color.', 'gauge-plugin' ),
						'param_name' => 'highlight_background_color',
						'value' => '#fff',
						'dependency' => array( 'element' => 'highlight', 'value' => 'enabled' ),
						'type' => 'colorpicker',
						),		 		 		 
						array( 
						'heading' => esc_html__( 'Text Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The text color.', 'gauge-plugin' ),
						'param_name' => 'text_color',
						'value' => '#747474',
						'type' => 'colorpicker',
						),	
						array( 
						'heading' => esc_html__( 'Border', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a border around the columns.', 'gauge-plugin' ),
						'param_name' => 'border',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),			 
						array( 
						'heading' => esc_html__( 'Border Color', 'gauge-plugin' ),
						'description' => esc_html__( 'The border color.', 'gauge-plugin' ),
						'param_name' => 'border_color',
						'value' => '#e7e7e7',
						'dependency' => array( 'element' => 'border', 'value' => 'enabled' ),
						'type' => 'colorpicker',
						),	 		 																																							
					 )
				 ) );
				 

				/*--------------------------------------------------------------
				Progress Bar Shortcode (add-on)
				--------------------------------------------------------------*/

				vc_add_param( 'vc_progress_bar', array( 
				'heading' => esc_html__( 'Text Color', 'gauge-plugin' ),
				'param_name' => 'textcolor',
				'class' => '',
				'description' => esc_html__( 'Select custom text color for bars.', 'gauge-plugin' ),
				'type' => 'colorpicker',
				 ) );


				/*--------------------------------------------------------------
				Ranking Shortcode
				--------------------------------------------------------------*/

				require_once( sprintf( "%s/gp_vc_ranking.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'Ranking', 'gauge-plugin' ),
					'base' => 'ranking',
					'description' => esc_html__( 'Rank hub pages in a variety of ways.', 'gauge-plugin' ),
					'class' => 'wpb_vc_ranking',
					'controls' => 'full',
					'icon' => 'gp-icon-ranking',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'params' => array(		
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title at the top of the element.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),		
						array(
						'heading' => esc_html__( 'Type', 'gauge-plugin' ),
						'description' => esc_html__( 'Select type of content you want to display.', 'gauge-plugin' ),
						'param_name' => 'type',
						'value' => array(
							esc_html__( 'Hubs', 'gauge-plugin' ) => 'hubs',
							esc_html__( 'Reviews', 'gauge-plugin' ) => 'reviews',
							esc_html__( 'Hubs and Reviews', 'gauge-plugin' ) => 'both',
						),
						'type' => 'dropdown',
						),				
						array( 
						'heading' => esc_html__( 'Categories', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slugs or IDs separating each one with a comma e.g. xbox,ps3,pc.', 'gauge-plugin' ),
						'param_name' => 'cats',
						'type' => 'textfield',
						),				
						array( 
						'heading' => esc_html__( 'Hub Fields', 'gauge-plugin' ),
						'description' => wp_kses( __( 'Enter the hub field slugs you want to filter by. Add your taxonomy slug followed by a colon. Next enter your terms separating each by a colon also. Next add a comma and then enter the next taxonomy and so on e.g. <code>taxonomy-1:term-1:term-2,taxonomy-2:term-1,taxonomy-3:term-1:term-2</code>, this would translate to <code>genre:action:role-playing,publisher:namco,developed-by:namco:bluepoint-games</code>', 'gauge-plugin' ),  array( 'code' => array() ) ),
						'param_name' => 'hub_fields',
						'type' => 'textfield',
						'value' => '',
						),	
						array( 
						'heading' => esc_html__( 'Order By', 'gauge-plugin' ),
						'description' => esc_html__( 'The criteria which the items are ordered by.', 'gauge-plugin' ),
						'param_name' => 'orderby',
						'value' => array(
							esc_html__( 'Top Site Rated', 'gauge-plugin' ) => 'site_rating',
							esc_html__( 'Newest', 'gauge-plugin' ) => 'newest',
							esc_html__( 'Oldest', 'gauge-plugin' ) => 'oldest',
							esc_html__( 'Title (A-Z)', 'gauge-plugin' ) => 'title_az',
							esc_html__( 'Title (Z-A)', 'gauge-plugin' ) => 'title_za',
							esc_html__( 'Most Comments', 'gauge-plugin' ) => 'comment_count',
							esc_html__( 'Most Views', 'gauge-plugin' ) => 'views',
							esc_html__( 'Most Followers', 'gauge-plugin' ) => 'followers',
							esc_html__( 'Top User Rated', 'gauge-plugin' ) => 'user_rating',
							esc_html__( 'Hub Awards', 'gauge-plugin' ) => 'hub_awards',
							esc_html__( 'Menu Order', 'gauge-plugin' ) => 'menu_order',
							esc_html__( 'Random', 'gauge-plugin' ) => 'rand',
						),
						'type' => 'dropdown',
						),					
						array( 
						'heading' => esc_html__( 'Date Posted', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were posted.', 'gauge-plugin' ),
						'param_name' => 'date_posted',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Date Modified', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were modified.', 'gauge-plugin' ),
						'param_name' => 'date_modified',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),					 
						array( 
						'heading' => esc_html__( 'Items', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of items.', 'gauge-plugin' ),
						'param_name' => 'per_page',
						'value' => '5',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Offset', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of posts to offset by e.g. set to 3 to exclude the first 3 posts.', 'gauge-plugin' ),
						'param_name' => 'offset',
						'value' => '',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Featured Image', 'gauge-plugin' ),
						'description' => esc_html__( 'Display the featured images.', 'gauge-plugin' ),
						'param_name' => 'featured_image',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Top Ranked Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the top ranked featured image.', 'gauge-plugin' ),
						'param_name' => 'large_image_width',
						'value' => '120',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),		 
						array( 
						'heading' => esc_html__( 'Top Ranked Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the top ranked featured image.', 'gauge-plugin' ),
						'param_name' => 'large_image_height',
						'value' => '120',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Small Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the small featured images.', 'gauge-plugin' ),
						'param_name' => 'small_image_width',
						'value' => '80',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),		 
						array( 
						'heading' => esc_html__( 'Small Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the small featured images.', 'gauge-plugin' ),
						'param_name' => 'small_image_height',
						'value' => '80',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Background Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the background images.', 'gauge-plugin' ),
						'param_name' => 'bg_image_width',
						'value' => '370',
						'type' => 'textfield',
						),		 
						array( 
						'heading' => esc_html__( 'Background Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the background images.', 'gauge-plugin' ),
						'param_name' => 'bg_image_height',
						'value' => '255',
						'type' => 'textfield',
						),					
						array( 
						'heading' => esc_html__( 'Hard Crop', 'gauge-plugin' ),
						'description' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge-plugin' ),
						'param_name' => 'hard_crop',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),
						array(
						'heading' => esc_html__( 'Post Meta', 'gauge-plugin' ),
						'param_name' => 'meta_hub_cats',
						'value' => array( esc_html__( 'Hub Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),					
						array(
						'description' => esc_html__( 'Select the meta data you want to display.', 'gauge-plugin' ),
						'param_name' => 'meta_hub_fields',
						'value' => array( esc_html__( 'Hub Fields', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array(
						'heading' => esc_html__( 'Ratings', 'gauge-plugin' ),
						'param_name' => 'display_site_rating',
						'value' => array( esc_html__( 'Site Rating', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),					
						array(
						'description' => esc_html__( 'Select the ratings you want to display.', 'gauge-plugin' ),
						'param_name' => 'display_user_rating',
						'value' => array( esc_html__( 'User Rating', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						), 				 		   			 			 
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'type' => 'textfield',
						),																																								
					 )
				) );


				/*--------------------------------------------------------------
				Team Shortcode
				--------------------------------------------------------------*/

				// Team Wrapper
				vc_map( array( 
					'name' => esc_html__( 'Team', 'gauge-plugin' ),
					'base' => 'team',
					'description' => esc_html__( 'Display your team members.', 'gauge-plugin' ),
					'as_parent' => array( 'only' => 'team_member' ), 
					'class' => 'wpb_vc_team',
					'controls' => 'full',
					'icon' => 'gp-icon-team',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'js_view' => 'VcColumnView',
					'params' => array( 	
						array( 
						'heading' => esc_html__( 'Columns', 'gauge-plugin' ),
						'param_name' => 'columns',
						'value' => '3',
						'description' => esc_html__( 'The number of columns.', 'gauge-plugin' ),
						'type' => 'textfield',
						),		
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'type' => 'textfield',
						),																																								
					 ),
				) );

				// Team Member
				vc_map( array( 
					'name' => esc_html__( 'Team Member', 'gauge-plugin' ),
					'base' => 'team_member',
					'icon' => 'gp-icon-team',
					'content_element' => true,
					'as_child' => array( 'only' => 'team' ),
					'params' => array( 	
						array( 
						'heading' => esc_html__( 'Image', 'gauge-plugin' ),
						'description' => esc_html__( 'The team member image.', 'gauge-plugin' ),
						'param_name' => 'image_url',
						'value' => '',
						'type' => 'attach_image'
						),
						array( 
						'heading' => esc_html__( 'Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the team member image.', 'gauge-plugin' ),
						'param_name' => 'image_width',
						'value' => '230',
						'type' => 'textfield',
						),		
						array( 
						'heading' => esc_html__( 'Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the team member image.', 'gauge-plugin' ),
						'param_name' => 'image_height',
						'value' => '230',
						'type' => 'textfield',
						),			
						array( 
						'heading' => esc_html__( 'Name', 'gauge-plugin' ),
						'description' => esc_html__( 'The name of the team member.', 'gauge-plugin' ),
						'param_name' => 'name',
						'admin_label' => true,
						'value' => '',
						'type' => 'textfield'
						),	
						array( 
						'heading' => esc_html__( 'Position', 'gauge-plugin' ),
						'description' => esc_html__( 'The position of the team member e.g. CEO', 'gauge-plugin' ),
						'param_name' => 'position',
						'value' => '',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Link', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a link for the team member image.', 'gauge-plugin' ),
						'param_name' => 'link',
						'value' => '',
						'type' => 'textfield',
						),	
						array( 
						'heading' => esc_html__( 'Link Target', 'gauge-plugin' ),
						'description' => esc_html__( 'The link target for the team member image.', 'gauge-plugin' ),
						'param_name' => 'link_target',
						'value' => array( esc_html__( 'Same Window', 'gauge-plugin' ) => '_self', esc_html__( 'New Window', 'gauge-plugin' ) => '_blank' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'link', 'not_empty' => true ),
						),				
						array( 
						'heading' => esc_html__( 'Description', 'gauge-plugin' ),
						'description' => esc_html__( 'The description of the team member.', 'gauge-plugin' ),
						'param_name' => 'content',
						'value' => '',
						'type' => 'textarea_html',
						),																																								
					 )
				 ) );
				 
				 
				/*--------------------------------------------------------------
				Testimonials Shortcode
				--------------------------------------------------------------*/

				// Testimonial Slider
				vc_map( array( 
					'name' => esc_html__( 'Testimonial Slider', 'gauge-plugin' ),
					'base' => 'testimonial_slider',
					'description' => esc_html__( 'Show your testimonials in a slider.', 'gauge-plugin' ),
					'as_parent' => array( 'only' => 'testimonial' ), 
					'class' => 'wpb_vc_testimonial',
					'controls' => 'full',
					'icon' => 'gp-icon-testimonial-slider',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'js_view' => 'VcColumnView',
					'params' => array( 	
						array( 
						'heading' => esc_html__( 'Effect', 'gauge-plugin' ),
						'param_name' => 'effect',
						'value' => array( esc_html__( 'Fade', 'gauge-plugin' ) => 'fade', esc_html__( 'Slide', 'gauge-plugin' ) => 'slide' ),
						'description' => esc_html__( 'The slider effect.', 'gauge-plugin' ),
						'type' => 'dropdown'
						),
						array( 
						'heading' => esc_html__( 'Slider Speed', 'gauge-plugin' ),
						'param_name' => 'speed',
						'value' => '0',
						'description' => esc_html__( 'The number of seconds between slide transitions, set to 0 to disable the autoplay.', 'gauge-plugin' ),
						'type' => 'textfield',
						),		
						array( 
						'heading' => esc_html__( 'Buttons', 'gauge-plugin' ),
						'param_name' => 'buttons',
						'value' => array( esc_html__( 'Show', 'gauge-plugin' ) => 'true', esc_html__( 'Hide', 'gauge-plugin' ) => 'false' ),
						'description' => esc_html__( 'The slider buttons.', 'gauge-plugin' ),
						'type' => 'dropdown',
						),				
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'param_name' => 'classes',
						'value' => '',
						'type' => 'textfield',
						),																																								
					 ),
				 ) );

				// Testimonial Slide
				vc_map( array( 
					'name' => esc_html__( 'Testimonial', 'gauge-plugin' ),
					'base' => 'testimonial',
					'content_element' => true,
					'as_child' => array( 'only' => 'testimonial_slider' ),
					'icon' => 'gp-icon-testimonial-slider',
					'params' => array( 	
						array( 
						'heading' => esc_html__( 'Image', 'gauge-plugin' ),
						'description' => esc_html__( 'The testimonial slide image.', 'gauge-plugin' ),
						'param_name' => 'image_url',
						'value' => '',
						'type' => 'attach_image'
						),
						array( 
						'heading' => esc_html__( 'Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width the testimonial slide image.', 'gauge-plugin' ),
						'param_name' => 'image_width',
						'value' => '120',
						'description' => '',
						'type' => 'textfield',
						),		
						array( 
						'heading' => esc_html__( 'Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the testimonial slide images.', 'gauge-plugin' ),
						'param_name' => 'image_height',
						'value' => '120',
						'type' => 'textfield',
						),		
						array( 
						'heading' => esc_html__( 'Quote', 'gauge-plugin' ),
						'description' => esc_html__( 'The tesitmonial quote.', 'gauge-plugin' ),
						'param_name' => 'content',
						'value' => '',
						'type' => 'textarea_html',
						),		
						array( 
						'heading' => esc_html__( 'Name', 'gauge-plugin' ),
						'description' => esc_html__( 'The name of the person who gave the testimonial.', 'gauge-plugin' ),
						'param_name' => 'name',
						'value' => '',
						'type' => 'textfield',
						),																																								
					 )
				 ) );
				 
				 
				/*--------------------------------------------------------------
				User Rating Box Shortcode
				--------------------------------------------------------------*/

				require_once( sprintf( "%s/gp_vc_user_rating_box.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'User Rating Box', 'gauge-plugin' ),
					'base' => 'user_rating_box',
					'description' => esc_html__( 'Display the user rating box.', 'gauge-plugin' ),
					'class' => 'wpb_vc_user_rating_box',
					'controls' => 'full',
					"show_settings_on_create" => false,
					'icon' => 'gp-icon-user-rating-box',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'params' => array(),
				) );


				/*--------------------------------------------------------------
				Videos Shortcode
				--------------------------------------------------------------*/
				
				require_once( sprintf( "%s/gp_vc_videos.php", dirname( __FILE__ ) ) );

				vc_map( array( 
					'name' => esc_html__( 'Videos', 'gauge-plugin' ),
					'base' => 'videos',
					'description' => esc_html__( 'Display your video posts in a variety of ways.', 'gauge-plugin' ),
					'class' => 'wpb_vc_videos',
					'controls' => 'full',
					'icon' => 'gp-icon-videos',
					'category' => esc_html__( 'Content', 'gauge-plugin' ),
					'front_enqueue_js' => $masonry_js,
					'params' => array( 		
						array( 
						'heading' => esc_html__( 'Title', 'gauge-plugin' ),
						'description' => esc_html__( 'The title at the top of the element.', 'gauge-plugin' ),
						'param_name' => 'widget_title',
						'type' => 'textfield',
						'admin_label' => true,
						'value' => '',
						),		
						array( 
						'heading' => esc_html__( 'Categories', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slugs or IDs separating each one with a comma e.g. xbox,ps3,pc.', 'gauge-plugin' ),
						'param_name' => 'cats',
						'type' => 'textfield',
						),				
						array( 
						'heading' => esc_html__( 'Post Association', 'gauge-plugin' ),
						'description' => esc_html__( 'Only show posts associated with the parent hub page.', 'gauge-plugin' ),
						'param_name' => 'post_association',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Format', 'gauge-plugin' ),
						'description' => esc_html__( 'The format to display the items in.', 'gauge-plugin' ),
						'param_name' => 'format',
						'value' => array( esc_html__( 'Standard', 'gauge-plugin' ) => 'blog-standard', esc_html__( 'Large', 'gauge-plugin' ) => 'blog-large', esc_html__( '1 Column', 'gauge-plugin' ) => 'blog-columns-1', esc_html__( '2 Columns', 'gauge-plugin' ) => 'blog-columns-2', esc_html__( '3 Columns', 'gauge-plugin' ) => 'blog-columns-3', esc_html__( '4 Columns', 'gauge-plugin' ) => 'blog-columns-4', esc_html__( '5 Columns', 'gauge-plugin' ) => 'blog-columns-5', esc_html__( '6 Columns', 'gauge-plugin' ) => 'blog-columns-6', esc_html__( 'Masonry', 'gauge-plugin' ) => 'blog-masonry' ),
						'type' => 'dropdown',
						),				
						array( 
						'heading' => esc_html__( 'Size', 'gauge-plugin' ),
						'description' => esc_html__( 'The size to display the items at.', 'gauge-plugin' ),
						'param_name' => 'size',
						'value' => array( esc_html__( 'Small', 'gauge-plugin' ) => 'blog-small-size', esc_html__( 'Standard', 'gauge-plugin' ) => 'blog-standard-size' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Order By', 'gauge-plugin' ),
						'description' => esc_html__( 'The criteria which the items are ordered by.', 'gauge-plugin' ),
						'param_name' => 'orderby',
						'value' => array(
							esc_html__( 'Newest', 'gauge-plugin' ) => 'newest',
							esc_html__( 'Oldest', 'gauge-plugin' ) => 'oldest',
							esc_html__( 'Title (A-Z)', 'gauge-plugin' ) => 'title_az',
							esc_html__( 'Title (Z-A)', 'gauge-plugin' ) => 'title_za',
							esc_html__( 'Most Comments', 'gauge-plugin' ) => 'comment_count',
							esc_html__( 'Most Views', 'gauge-plugin' ) => 'views',
							esc_html__( 'Menu Order', 'gauge-plugin' ) => 'menu_order',
							esc_html__( 'Random', 'gauge-plugin' ) => 'rand',
						),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Date Posted', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were posted.', 'gauge-plugin' ),
						'param_name' => 'date_posted',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Date Modified', 'gauge-plugin' ),
						'description' => esc_html__( 'The date the items were modified.', 'gauge-plugin' ),
						'param_name' => 'date_modified',
						'value' => array(
							esc_html__( 'Any date', 'gauge-plugin' ) => 'all',
							esc_html__( 'In the last year', 'gauge-plugin' ) => 'year',
							esc_html__( 'In the last month', 'gauge-plugin' ) => 'month',
							esc_html__( 'In the last week', 'gauge-plugin' ) => 'week',
							esc_html__( 'In the last day', 'gauge-plugin' ) => 'day',
						),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Filter', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge-plugin' ),
						'param_name' => 'filter',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),	
						array(
						'heading' => esc_html__( 'Filter Options', 'gauge-plugin' ),
						'param_name' => 'filter_cats',
						'value' => array( esc_html__( 'Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),	
						array(
						'param_name' => 'filter_date',
						'value' => array( esc_html__( 'Date', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),	
						array(
						'param_name' => 'filter_title',
						'value' => array( esc_html__( 'Title', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),								
						array(
						'param_name' => 'filter_comment_count',
						'value' => array( esc_html__( 'Comment Count', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),
						array(
						'param_name' => 'filter_views',
						'value' => array( esc_html__( 'Views', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),
						array( 
						'param_name' => 'filter_date_posted',
						'value' => array( esc_html__( 'Date Posted', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),				
						array( 
						'description' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge-plugin' ),
						'param_name' => 'filter_date_modified',
						'value' => array( esc_html__( 'Date Modified', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),				
						array( 
						'heading' => esc_html__( 'Filter Category', 'gauge-plugin' ),
						'description' => esc_html__( 'Enter the slug or ID number of the category you want to filter by, leave blank to display all categories - the sub categories of this category will also be displayed.', 'gauge-plugin' ),
						'param_name' => 'filter_cats_id',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'filter', 'value' => 'enabled' ),
						),
						array( 
						'heading' => esc_html__( 'Items Per Page', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of items on each page.', 'gauge-plugin' ),
						'param_name' => 'per_page',
						'value' => '5',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Offset', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of posts to offset by e.g. set to 3 to exclude the first 3 posts.', 'gauge-plugin' ),
						'param_name' => 'offset',
						'value' => '',
						'type' => 'textfield',
						),
						array( 
						'heading' => esc_html__( 'Featured Image', 'gauge-plugin' ),
						'description' => esc_html__( 'Display the featured images.', 'gauge-plugin' ),
						'param_name' => 'featured_image',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),	
						array( 
						'heading' => esc_html__( 'Image Width', 'gauge-plugin' ),
						'description' => esc_html__( 'The width of the featured images.', 'gauge-plugin' ),
						'param_name' => 'image_width',
						'value' => '75',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),		 
						array( 
						'heading' => esc_html__( 'Image Height', 'gauge-plugin' ),
						'description' => esc_html__( 'The height of the featured images.', 'gauge-plugin' ),
						'param_name' => 'image_height',
						'value' => '75',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Hard Crop', 'gauge-plugin' ),
						'description' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge-plugin' ),
						'param_name' => 'hard_crop',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),	
						array( 
						'heading' => esc_html__( 'Image Alignment', 'gauge-plugin' ),
						'description' => esc_html__( 'Choose how the image aligns with the content.', 'gauge-plugin' ),
						'param_name' => 'image_alignment',
						'value' => array( esc_html__( 'Left Align', 'gauge-plugin' ) => 'image-align-left', esc_html__( 'Left Wrap', 'gauge-plugin' ) => 'image-wrap-left', esc_html__( 'Right Wrap', 'gauge-plugin' ) => 'image-wrap-right', esc_html__( 'Above Content', 'gauge-plugin' ) => 'image-above', esc_html__( 'Right Align', 'gauge-plugin' ) => 'image-align-right' ),
						'type' => 'dropdown',
						'dependency' => array( 'element' => 'featured_image', 'value' => 'enabled' ),
						),			
						array( 
						'heading' => esc_html__( 'Title Position', 'gauge-plugin' ),
						'description' => esc_html__( 'The position of the title.', 'gauge-plugin' ),
						'param_name' => 'title_position',
						'value' => array( esc_html__( 'Next To Thumbnail', 'gauge-plugin' ) => 'title-next-to-thumbnail', esc_html__( 'Over Thumbnail', 'gauge-plugin' ) => 'title-over-thumbnail' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Content Display', 'gauge-plugin' ),
						'description' => esc_html__( 'The amount of content displayed.', 'gauge-plugin' ),
						'param_name' => 'content_display',
						'value' => array( esc_html__( 'Excerpt', 'gauge-plugin' ) => 'excerpt', esc_html__( 'Full Content', 'gauge-plugin' ) => 'full_content' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'Excerpt Length', 'gauge-plugin' ),
						'description' => esc_html__( 'The number of characters in excerpts.', 'gauge-plugin' ),
						'param_name' => 'excerpt_length',
						'value' => '0',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'content_display', 'value' => 'excerpt' ),
						),	
						array(
						'heading' => esc_html__( 'Post Meta', 'gauge-plugin' ),
						'param_name' => 'meta_author',
						'value' => array( esc_html__( 'Author Name', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array(
						'param_name' => 'meta_date',
						'value' => array( esc_html__( 'Post Date', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),				
						array(
						'param_name' => 'meta_views',
						'value' => array( esc_html__( 'Views', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),		
						array(
						'param_name' => 'meta_comment_count',
						'value' => array( esc_html__( 'Comment Count', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),
						array( 
						'param_name' => 'meta_cats',
						'value' => array( esc_html__( 'Post Categories', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array(
						'description' => esc_html__( 'Select the meta data you want to display.', 'gauge-plugin' ),
						'param_name' => 'meta_tags',
						'value' => array( esc_html__( 'Post Tags', 'gauge-plugin' ) => '1' ),
						'type' => 'checkbox',
						),	
						array( 
						'heading' => esc_html__( 'Read More Link', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a read more link below the content.', 'gauge-plugin' ),
						'param_name' => 'read_more_link',
						'value' => array( esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled', esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled' ),
						'type' => 'dropdown',
						),								 
						array( 
						'heading' => esc_html__( 'Pagination', 'gauge-plugin' ),
						'description' => esc_html__( 'Add pagination.', 'gauge-plugin' ),
						'param_name' => 'page_numbers',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),
						array( 
						'heading' => esc_html__( 'See All', 'gauge-plugin' ),
						'description' => esc_html__( 'Add a "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all',
						'value' => array( esc_html__( 'Disabled', 'gauge-plugin' ) => 'disabled', esc_html__( 'Enabled', 'gauge-plugin' ) => 'enabled' ),
						'type' => 'dropdown',
						),				
						array( 
						'heading' => esc_html__( 'See All Link', 'gauge-plugin' ),
						'description' => esc_html__( 'URL for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_link',
						'type' => 'textfield',
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),					 			 
						array( 
						'heading' => esc_html__( 'See All Text', 'gauge-plugin' ),
						'description' => esc_html__( 'Custom text for the "See All" link.', 'gauge-plugin' ),
						'param_name' => 'see_all_text',
						'type' => 'textfield',
						'value' => esc_html__( 'See All Videos', 'gauge-plugin' ),
						'dependency' => array( 'element' => 'see_all', 'value' => 'enabled' ),
						),	 			 				 		   			 			 
						array( 
						'heading' => esc_html__( 'Extra Class Names', 'gauge-plugin' ),
						'description' => esc_html__( 'If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gauge-plugin' ),
						'type' => 'textfield',
						'param_name' => 'classes',
						'value' => '',
						),																																								
					 )
				) );

			}

		}
	
	}	

}

?>