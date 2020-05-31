<?php

/*--------------------------------------------------------------
Create theme converter menu
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_theme_converter_menu' ) ) {
	function ghostpool_theme_converter_menu() {
		add_theme_page( esc_html__( 'Theme Converter', 'gauge' ), esc_html__( 'Theme Converter', 'gauge' ), 'administrator', 'theme-converter', 'ghostpool_theme_converter_page' );
	}
}
add_action( 'admin_menu', 'ghostpool_theme_converter_menu' );


/*--------------------------------------------------------------
Theme converter page
--------------------------------------------------------------*/		
					
if ( ! function_exists( 'ghostpool_theme_converter_page' ) ) {
	
	function ghostpool_theme_converter_page() {

		global $wpdb;
					
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] ) && $_POST['action'] == 'ghostpool_reviewit_convert' ) {

			$gp_convert_post_templates = $wpdb->query( $wpdb->prepare( 
				"
					INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value)
					SELECT $wpdb->posts.ID, %s, %s
					FROM $wpdb->posts
					WHERE $wpdb->posts.post_status = 'publish'
					AND $wpdb->posts.post_type = %s
					LIMIT %d
				",
				'_wp_page_template',
				'hub-template.php',
				'review',
				absint( $_POST['reviewit_limit'] )
			) );

			$gp_convert_reviews = $wpdb->query( $wpdb->prepare( 
				"
					UPDATE $wpdb->posts
					SET post_type = %s
					WHERE post_type = %s
					LIMIT %d
				", 
				'page',
				'review',
				absint( $_POST['reviewit_limit'] )
			) );
		
			$gp_convert_categories = $wpdb->query( $wpdb->prepare( 
				"
					UPDATE $wpdb->term_taxonomy
					SET taxonomy =  %s
					WHERE taxonomy = %s
				", 
				'gp_hubs',
				'review_categories'
			) );

		} elseif ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] ) && $_POST['action'] == 'ghostpool_score_convert' ) {

			$gp_templates = $wpdb->get_results(
				"
					SELECT *		
					FROM $wpdb->posts p
					INNER JOIN $wpdb->postmeta pm
					ON p.ID = pm.post_id
					WHERE p.post_type = 'post'
					AND pm.meta_key = 'ghostpool_post_type'
					AND pm.meta_value = 'Review'
					LIMIT " . absint( $_POST['score_limit'] ) . "
				"
			);
			if ( count( $gp_templates ) > 0 ) {
				foreach ( $gp_templates as $gp_template ) {
					$gp_convert_post_templates = $wpdb->query( $wpdb->prepare( 
						"
							INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value)
							SELECT $wpdb->posts.ID, %s, %s
							FROM $wpdb->posts
							WHERE ID = %d
						",
						'_wp_page_template',
						'hub-template.php',
						$gp_template->ID
					) );
				}
			}
			
			$gp_reviews = $wpdb->get_results(
				"
					SELECT *		
					FROM $wpdb->posts p
					INNER JOIN $wpdb->postmeta pm
					ON p.ID = pm.post_id
					WHERE p.post_type = 'post'
					AND pm.meta_key = 'ghostpool_post_type'
					AND pm.meta_value = 'Review'
					LIMIT " . absint( $_POST['score_limit'] ) . "
				"
			);
			if ( count( $gp_reviews ) > 0 ) {
				foreach ( $gp_reviews as $gp_review ) {
					$gp_convert_reviews = $wpdb->query( $wpdb->prepare( 
						"
							UPDATE $wpdb->posts
							SET post_type = %s
							WHERE post_type = %s
							AND ID = %d
						",
						'page',
						'post',
						$gp_review->ID
					) );
				}
			}
					
			if ( isset( $_POST['score_cat_ids'] ) ) {		
				$gp_cats = explode( ',', $_POST['score_cat_ids'] );
			} else {
				$gp_cats = '';
			}
			if ( $gp_cats != '' ) {
				foreach ( $gp_cats as $gp_cat ) {
					$gp_convert_categories = $wpdb->query( $wpdb->prepare( 
						"
							UPDATE $wpdb->term_taxonomy
							SET taxonomy =  %s
							WHERE term_id = %d
						", 
						'gp_hubs',
						$gp_cat
					) );
				}		
			}
						
		}
					
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] ) && ( $_POST['action'] == 'ghostpool_reviewit_convert' OR $_POST['action'] == 'ghostpool_score_convert' ) ) {
						
			if ( $gp_convert_post_templates != '' OR $gp_convert_reviews != '' OR $gp_convert_categories != '' ) {	
				$gp_convert_message = '<div class="updated"><p>' . esc_html__( "Your reviews were successfully converted.", "gauge" ) . '</p></div>';
			} else {
				$gp_convert_message = '<div class="error"><p>' . esc_html__( "Your reviews could not be converted, this is probably because you have already converted them or you do not have any reviews on this site.", "gauge" ) . '</p></div>';
			}		
	
			// Create child pages
			if ( $gp_convert_post_templates != '' OR $gp_convert_reviews != '' OR $gp_convert_categories != '' ) {	

				global $post;
		
				$gp_args = array(
					'post_type' => 'page',
					'posts_per_page' => -1,
					'meta_query' => array(
						array(
							'key' => '_wp_page_template',
							'value' => 'hub-template.php'
						)
					)
				);
		
				$gp_the_pages = new WP_Query( $gp_args );

				if ( $gp_the_pages->have_posts() ) : while ( $gp_the_pages->have_posts() ) : $gp_the_pages->the_post();

					// Hub Page	
					if ( ! empty( $post->post_content ) ) {
						$gp_review_page_content = $post->post_content;
					} else {
						$gp_review_page_content = '';
					}
										
					$gp_new_page_content = '
				[vc_row css=".vc_custom_1407855744612{margin-bottom: 0px !important;}"][vc_column width="7/12" css=".vc_custom_1407855616904{margin-bottom: 0px !important;}"][news widget_title="Latest News" per_page="10" featured_image="enabled" image_width="140" image_height="140" hard_crop="enabled" image_alignment="image-align-left" content_display="excerpt" excerpt_length="100" read_more_link="enabled" pages="enabled" format="blog-standard" size="blog-standard-size" orderby="date" order="desc" filter="enabled" filter_date="1" filter_title="1" filter_comments="1" see_all="enabled" see_all_text="See All News" title_position="title-next-to-thumbnail" column_type="multiple-columns"][/vc_column][vc_column width="5/12"][vc_row_inner][vc_column_inner width="1/1"][images image_location="upload-images" number="8" see_all_text="See All Images" widget_title="Latest Images" image_width="357" image_height="300" hard_crop="enabled" get_images_from="child-page" see_all="enabled"][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1407855701457{margin-bottom: 0px !important;}"][vc_column_inner width="1/1"][videos per_page="5" featured_image="enabled" image_width="75" image_height="75" hard_crop="enabled" image_alignment="image-align-left" content_display="excerpt" excerpt_length="0" meta_date="1" read_more_link="enabled" see_all_text="See All Videos" pages="disabled" widget_title="Latest Videos" size="blog-small-size"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]';
					$gp_new_page = array(
						'ID'             => get_the_ID(),
						'post_title'     => get_the_title( get_the_ID() ),
						'post_type'      => 'page',
						'post_content'   => $gp_new_page_content,
						'post_excerpt'   => $gp_review_page_content,
						'post_status'    => 'publish',
						'comment_status' => 'closed'
					);
					$gp_hub_page_id = wp_insert_post( $gp_new_page );
					update_post_meta( $gp_hub_page_id, '_wp_page_template', 'hub-template.php' );	
					update_post_meta( $gp_hub_page_id, '_gp_hub_page', 'enabled' );		

					$ghostpool_prefix = $wpdb->prefix;
					$gp_table_name_1 = $ghostpool_prefix . 'gdsr_data_article';
					$gp_table_name_2 = $ghostpool_prefix . 'gdsr_multis_data';
					$gp_table_1_check = $wpdb->get_results( 'SELECT 1 FROM $gp_table_name_1', ARRAY_A );
					$gp_table_2_check = $wpdb->get_results( 'SELECT 1 FROM $gp_table_name_2', ARRAY_A );

					if ( isset( $_POST['reviewit_site_multi_id'] ) ) {
						$gp_site_multi_id = absint( $_POST['reviewit_site_multi_id'] );
					} else {
						$gp_site_multi_id = '';
					}
					if ( isset ( $_POST['reviewit_user_multi_id'] ) ) {
						$gp_user_multi_id = absint( $_POST['reviewit_user_multi_id'] );
					} else {
						$gp_user_multi_id = '';
					}
									
					// Add site rating
					$gp_site_rating_row = '';
					$gp_multi_site_rating_row = '';
					if ( $wpdb->get_results( "DESCRIBE $gp_table_name_1", ARRAY_A ) ) {
						$gp_site_rating_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_1 WHERE review > 0 AND post_id = $gp_hub_page_id" );
					}
					if ( $wpdb->get_results( "DESCRIBE $gp_table_name_2", ARRAY_A ) && $gp_site_multi_id != '' ) {
						if ( $gp_site_multi_id != '' ) {
							$gp_multi_site_rating_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_2 WHERE average_review > 0 AND post_id = $gp_hub_page_id AND multi_id = $gp_site_multi_id" );
						}
					}
					$gp_site_rating = '';
					if ( $gp_site_rating_row != '' ) {
						$gp_site_rating = $gp_site_rating_row->review;
						add_post_meta( $gp_hub_page_id, '_gp_old_site_rating', $gp_site_rating );
					} elseif ( $gp_multi_site_rating_row != '' ) {
						$gp_site_rating = $gp_multi_site_rating_row->average_review;
						add_post_meta( $gp_hub_page_id, '_gp_old_site_rating', $gp_site_rating );
					}					
		
					// Add user votes
					$gp_user_votes_row = '';
					$gp_visitor_votes_row = '';
					$gp_user_multi_votes_row = '';
					$gp_visitor_multi_votes_row = '';
					if ( $wpdb->get_results( "DESCRIBE $gp_table_name_1", ARRAY_A ) ) {
						$gp_user_votes_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_1 WHERE user_voters > 0 AND post_id = $gp_hub_page_id" );
						$gp_visitor_votes_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_1 WHERE visitor_voters > 0 AND post_id = $gp_hub_page_id" );
					}
					if ( $wpdb->get_results( "DESCRIBE $gp_table_name_2", ARRAY_A ) && $gp_user_multi_id != '' ) {
						$gp_user_multi_votes_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_2 WHERE total_votes_users > 0 AND post_id = $gp_hub_page_id AND multi_id = $gp_user_multi_id" );
						$gp_visitor_multi_votes_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_2 WHERE total_votes_visitors > 0 AND post_id = $gp_hub_page_id AND multi_id = $gp_user_multi_id" );
					}	
					$gp_user_votes = '';
					if ( $gp_user_votes_row != '' OR $gp_visitor_votes_row != '' ) {
						$gp_user_votes = ( $gp_user_votes_row->user_voters + $gp_visitor_votes_row->visitor_voters );
						add_post_meta( $gp_hub_page_id, '_gp_user_votes', $gp_user_votes );
					} elseif ( $gp_user_multi_votes_row != '' OR $gp_visitor_multi_votes_row != '' ) {
						$gp_user_votes = ( $gp_user_multi_votes_row->total_votes_users + $gp_visitor_multi_votes_row->total_votes_visitors );
						add_post_meta( $gp_hub_page_id, '_gp_user_votes', $gp_user_votes );
					}
				
					// Add user rating
					$gp_user_rating_row = '';
					$gp_visitor_rating_row = '';
					$gp_user_multi_rating_row = '';
					$gp_visitor_multi_rating_row = '';
					if ( $wpdb->get_results( "DESCRIBE $gp_table_name_1", ARRAY_A ) ) {
						$gp_user_rating_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_1 WHERE user_votes > 0 AND post_id = $gp_hub_page_id" );
						$gp_visitor_rating_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_1 WHERE visitor_votes > 0 AND post_id = $gp_hub_page_id" );
					}	
					if ( $wpdb->get_results( "DESCRIBE $gp_table_name_2", ARRAY_A ) && $gp_user_multi_id != '' ) {
						$gp_user_multi_rating_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_2 WHERE average_rating_users > 0 AND post_id = $gp_hub_page_id AND multi_id = $gp_user_multi_id" );
						$gp_visitor_multi_rating_row = $wpdb->get_row( "SELECT * FROM $gp_table_name_2 WHERE average_rating_visitors > 0 AND post_id = $gp_hub_page_id AND multi_id = $gp_user_multi_id" );
					}
					if ( $gp_user_rating_row != '' OR $gp_visitor_rating_row != '' ) {
						$gp_user_rating = ( $gp_user_rating_row->user_votes + $gp_visitor_rating_row->visitor_votes ) / $gp_user_votes;
						add_post_meta( $gp_hub_page_id, '_gp_user_rating', $gp_user_rating );
					} elseif ( $gp_user_multi_rating_row != '' OR $gp_visitor_multi_rating_row != '' ) {
						$gp_user_rating = ( $gp_user_multi_rating_row->average_rating_users + $gp_visitor_multi_rating_row->average_rating_visitors );
						add_post_meta( $gp_hub_page_id, '_gp_user_rating', $gp_user_rating );
					}
							
					$gp_args = array(
						'post_parent' => get_the_ID(),
						'post_type'   => 'page'
					);
					$gp_child_pages = get_children( $gp_args );

					if ( empty( $gp_child_pages ) ) {

						// Review Page
						$gp_new_page = array(
							'post_type'      => 'page',
							'post_title'     => 'Review',
							'post_content'   => $gp_review_page_content,
							'post_status'    => 'publish',
							'post_parent'    => $gp_hub_page_id
						);		
						$gp_review_page_id = wp_insert_post( $gp_new_page );
						update_post_meta( $gp_review_page_id, '_wp_page_template', 'review-template.php' );		
						update_post_meta( $gp_review_page_id, '_gp_hub_page', 'enabled' );
						if ( $gp_site_rating ) {
							add_post_meta( $gp_review_page_id, '_gp_old_site_rating', $gp_site_rating );
						}
						
						$gp_comment_count = $wpdb->query( $wpdb->prepare( 
							"	
								SELECT comment_count FROM $wpdb->posts WHERE ID = %s
							",
							$gp_hub_page_id
						) );
				
						$wpdb->query( $wpdb->prepare( 
							"
								UPDATE $wpdb->comments
								SET comment_post_ID = %s
								WHERE comment_post_ID = %s
							", 
							$gp_review_page_id,
							$gp_hub_page_id
						) );
				
						$wpdb->query( $wpdb->prepare( 
							"		
								UPDATE $wpdb->posts
								SET comment_count = comment_count + %d
								WHERE ID = %s
							",
							$gp_comment_count,
							$gp_review_page_id
						) );

						$wpdb->query( $wpdb->prepare( 
							"		
								UPDATE $wpdb->posts
								SET comment_count = comment_count - %d
								WHERE ID = %s
								AND comment_count > 0
							",
							$gp_comment_count,
							$gp_hub_page_id
						) );
								
						// News Page
						$gp_new_page = array(
							'post_type'      => 'page',
							'post_title'     => 'News',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'post_parent'    => $gp_hub_page_id
						);
						$gp_new_page_id = wp_insert_post( $gp_new_page );
						update_post_meta( $gp_new_page_id, '_wp_page_template', 'news-template.php' );			
						update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );	

						// Images Page
						$gp_new_page = array(
							'post_type'      => 'page',
							'post_title'     => 'Images',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'post_parent'    => $gp_hub_page_id
						);
						$gp_new_page_id = wp_insert_post( $gp_new_page );
						update_post_meta( $gp_new_page_id, '_wp_page_template', 'images-template.php' );		
						update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );		

						// Videos Page
						$gp_new_page = array(
							'post_type'      => 'page',
							'post_title'     => 'Videos',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'post_parent'    => $gp_hub_page_id
						);
						$gp_new_page_id = wp_insert_post( $gp_new_page );
						update_post_meta( $gp_new_page_id, '_wp_page_template', 'videos-template.php' );		
						update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );		

						// Write A Review Page
						$gp_new_page = array(
							'post_type'      => 'page',
							'post_title'     => 'Write A Review',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'post_parent'    => $gp_hub_page_id
						);
						$gp_new_page_id = wp_insert_post( $gp_new_page );
						update_post_meta( $gp_new_page_id, '_wp_page_template', 'write-a-review-template.php' );		

						// User Reviews Page
						$gp_new_page = array(
							'post_type'      => 'page',
							'post_title'     => 'User Reviews',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'post_parent'    => $gp_hub_page_id
						);
						$gp_new_page_id = wp_insert_post( $gp_new_page );
						update_post_meta( $gp_new_page_id, '_wp_page_template', 'user-reviews-template.php' );			
						update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );
				
					}
	
				endwhile; endif; wp_reset_postdata(); 
		
			}
		
		} ?>

		<div class="wrap">

			<h2><?php esc_html_e( 'Theme Converter', 'gauge' ); ?></h2>
		
			<?php if ( isset( $gp_convert_message ) ) { echo html_entity_decode( $gp_convert_message ); } ?>
		
			<div class="update-nag"><p><strong><?php esc_html_e( 'WARNING: Please backup all your data before converting your reviews as this process cannot be reversed. Use this converter at your own risk.', 'gauge' ); ?></strong></p></div>

			<p><?php esc_html_e( 'If you are using either the ReviewIt or Score theme you can use the theme converter to transform your current reviews into the review format used with this theme.', 'gauge' ); ?></p>
				
			<h3 class="title"><?php esc_html_e( 'Convert From ReviewIt', 'gauge'); ?></h3>
	
			<p><strong><?php esc_html_e( 'What\'s converted?', 'gauge' ); ?></strong></p>
	
			<ul class="ul-square">
				<li><?php esc_html_e( 'Reviews are converted to standard pages and assigned the "Hub" page template (they become a hub page)', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Child pages (review, news, images, videos, write a review and user reviews) are assigned to each hub page (previously your review page)', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Review categories converted to hub categories', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Site ratings, user ratings and user votes are transferred', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Review tags transferred to new hub pages', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Review page comments transferred to new review page', 'gauge' ); ?></li>
			</ul>
		
			<p><strong><?php esc_html_e( 'What\'s NOT converted?', 'gauge' ); ?></strong></p>
			<ul class="ul-square">
				<li><?php esc_html_e( 'Multi site and user rating criteria are not transferred, but the average multi site ratings are', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Review tabs will not be transferred to the new hub page - this is because this theme has an improved tab system', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Articles are not transferred to the new News tab', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Images are not transferred to the new Images tab', 'gauge' ); ?></li>
			</ul>

			<p><strong><?php esc_html_e( 'After you have converted', 'gauge' ); ?></strong></p>
			<ul class="ul-square">
				<li><?php esc_html_e( 'Go to', 'gauge' ); ?> <em><?php esc_html_e( 'Theme Options -> Hubs', 'gauge' ); ?></em> <?php esc_html_e( 'and change the names in Hub Fields to the review tags you created with the ReviewIt theme (e.g. Release Dates, Genres, Starring etc.)', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'You will need to associate posts with each hub page', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'You will need to attach/upload images to new Images page for each hub page', 'gauge' ); ?></li>
			</ul>

			<form method="post" action="" enctype="multipart/form-data" role="form">
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label><?php esc_html_e( 'Number of reviews to convert at a time', 'gauge' ); ?></label></th>
							<td>
								<input type="number" step="1" min="1" name="reviewit_limit" id="reviewit-limit" class="small-text" value="<?php if ( isset( $_POST['reviewit_limit'] ) ) { echo absint( $_POST['reviewit_limit'] ); } else { echo '50'; } ?>" />
								<p class="description"><?php esc_html_e( 'Enter a lower number if you get an error when converting.', 'gauge' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label><?php esc_html_e( 'Site Multi Set ID', 'gauge' ); ?></label></th>
							<td>
								<input type="text" name="reviewit_site_multi_id" id="reviewit-site-multi-id" class="small-text" value="<?php if ( isset( $_POST['reviewit_site_multi_id'] ) ) { echo absint( $_POST['reviewit_site_multi_id'] ); } ?>" />
								<p class="description"><?php esc_html_e( 'The GD Star multi set ID used for your site ratings.', 'gauge' ); ?></p>
							</td>							
						</tr>
						<tr>
							<th scope="row"><label><?php esc_html_e( 'User Multi Set ID', 'gauge' ); ?></label></th>
							<td>
								<input type="text" name="reviewit_user_multi_id" id="reviewit-user-multi-id" class="small-text" value="<?php if ( isset( $_POST['reviewit_user_multi_id'] ) ) { echo absint( $_POST['reviewit_user_multi_id'] ); } ?>" />
								<p class="description"><?php esc_html_e( 'The GD Star multi set ID used for your user ratings.', 'gauge' ); ?></p>
							</td>							
						</tr>						
					</tbody>
				</table>
				<p><input type="submit" value="<?php esc_attr_e( 'Convert From ReviewIt', 'gauge' ); ?>" tabindex="40" id="reviewit-convert-submit" name="submit" class="button" /></p>
				<input type="hidden" name="action" value="ghostpool_reviewit_convert" />
			</form>
		
		
			<hr>


			<h3 class="title"><?php esc_html_e( 'Convert From Score', 'gauge'); ?></h3>
	
			<p><strong><?php esc_html_e( 'What\'s converted?', 'gauge' ); ?></strong></p>
	
			<ul class="ul-square">
				<li><?php esc_html_e( 'Reviews are converted to standard pages and assigned the "Hub" page template (they become a hub page)', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Child pages (review, news, images, videos, write a review and user reviews) are assigned to each hub page (previously your review page)', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Review categories converted to hub categories', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Site ratings, user ratings and user votes are transferred', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Review page comments transferred to new review page', 'gauge' ); ?></li>
			</ul>
		
			<p><strong><?php esc_html_e( 'What\'s NOT converted?', 'gauge' ); ?></strong></p>
			<ul class="ul-square">
				<li><?php esc_html_e( 'Review tabs will not be transferred to the new hub page - this is because this theme has an improved tab system', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Articles are not transferred to the new News tab', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Images are not transferred to the new Images tab', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'Videos are not transferred to the new Videos tab', 'gauge' ); ?></li>
			</ul>

			<p><strong><?php esc_html_e( 'After you have converted', 'gauge' ); ?></strong></p>
			<ul class="ul-square">
				<li><?php esc_html_e( 'You will need to associate posts with each hub page', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'You will need to attach/upload images to new Images page for each hub page', 'gauge' ); ?></li>
				<li><?php esc_html_e( 'You will need to associate video posts with each hub page', 'gauge' ); ?></li>
			</ul>

			<form method="post" action="" enctype="multipart/form-data" role="form">
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label><?php esc_html_e( 'Number of reviews to convert at a time', 'gauge' ); ?></label></th>
							<td>
								<input type="number" step="1" min="1" name="score_limit" id="score-limit" class="small-text" value="<?php if ( isset( $_POST['score_limit'] ) ) { echo absint( $_POST['score_limit'] ); } else { echo '50'; } ?>" />
								<p class="description"><?php esc_html_e( 'Enter a lower number if you get an error when converting.', 'gauge' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label><?php esc_html_e( 'Review Category IDs', 'gauge' ); ?></label></th>
							<td>
								<input type="text" name="score_cat_ids" id="score-site-cat-ids" value="<?php if ( isset( $_POST['score_cat_ids'] ) ) { echo esc_attr( $_POST['score_cat_ids'] ); } ?>" />
								<p class="description"><?php esc_html_e( 'The post category IDs that you have assigned your reviews to, separating each with a comma (e.g. 23,45,82). Note: You need to specify child category IDs also as they are not imported with their parent categories.', 'gauge' ); ?></p>
							</td>							
						</tr>			
					</tbody>
				</table>
				<p><input type="submit" value="<?php esc_attr_e( 'Convert From Score', 'gauge' ); ?>" tabindex="40" id="score-convert-submit" name="submit" class="button" /></p>
				<input type="hidden" name="action" value="ghostpool_score_convert" />
			</form>

		</div>
	
		<?php
	
	}
}

?>