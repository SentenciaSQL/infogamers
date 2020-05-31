<?php

/*--------------------------------------------------------------
Add hub pages button
--------------------------------------------------------------*/

// Remove cats and filter_cats_id options
// esc_html__ to all widget_title options

if ( ! function_exists( 'ghostpool_add_hub_pages' ) ) {
	function ghostpool_add_hub_pages() {
		$gp_screen = get_current_screen();
		if ( $gp_screen->id == 'edit-page' || $gp_screen->id == 'page' ) { 

		?>        
			<script>
				jQuery( '.edit-php .wrap h1' ).after( '<div id="message" class="below-h2 gp-auto-hub-form">' + 
				
				'<h3><?php esc_html_e( "Automatic Hub Creation", "gauge" ); ?></h3>' +
				
				'<h4><?php esc_html_e( "Quickly create a hub page and its child pages", "gauge" ); ?></h4>' +
				
				'<form method="post" action="" enctype="multipart/form-data" role="form">' +
				
				'<div class="gp-hub-form-option"><div class="gp-hub-form-title"><?php esc_html_e( "Hub Page Title:", "gauge" ); ?></div><input type="text" name="ghostpool_hub_page_title" id="gp-hub-page-title" value="<?php if ( isset( $_POST["ghostpool_hub_page_title"] ) ) { echo esc_attr( $_POST["ghostpool_hub_page_title"] ); } ?>" placeholder="" /></div>' + 
				
				'<div class="gp-hub-form-option"><div class="gp-hub-form-title-alt"><?php esc_html_e( "Prefix child pages with hub page title:", "gauge" ); ?></div><input type="checkbox" name="ghostpool_prefix_child_pages" id="gp-prefix-child-pages" value="1" /></div>' +
				
				'<div class="gp-hub-form-option"><div class="gp-hub-form-title-alt"><?php esc_html_e( "Prefix child page URLs (slugs) with hub page title:", "gauge" ); ?></div><input type="checkbox" name="ghostpool_prefix_child_urls" id="gp-prefix-child-urls" value="1" /></div>' +
				
				'<div class="gp-hub-form-option"><div class="gp-hub-form-title"><?php esc_html_e( "Hub Page Template:", "gauge" ); ?></div><select name="ghostpool_page_template" id="gp-page-template"><option value="hub-template.php"<?php if ( isset( $_POST["ghostpool_page_template"] ) && ( $_POST["ghostpool_page_template"] == "hub-template.php" ) ) { ?> selected="selected"<?php } ?>>Hub</option><option value="hub-review-template.php"<?php if ( isset( $_POST["ghostpool_page_template"] ) && ( $_POST["ghostpool_page_template"] == "hub-review-template.php" ) ) { ?> selected="selected"<?php } ?>>Hub Review</option></select><div class="gp-hub-form-desc"><?php esc_html_e( "Choose between one of the hub page templates", "gauge" ); ?></div></div>' +
				
				'<div class="gp-hub-form-option"><div class="gp-hub-form-title-alt"><?php esc_html_e( "Child Pages:", "gauge" ); ?></div><?php esc_html_e( "Review", "gauge" ); ?> <input type="checkbox" name="ghostpool_review_page" id="gp-review-page" value="1" checked="checked" /> <?php esc_html_e( "News", "gauge" ); ?> <input type="checkbox" name="ghostpool_news_page" id="gp-news-page" value="1"  checked="checked" /> <?php esc_html_e( "Images", "gauge" ); ?> <input type="checkbox" name="ghostpool_images_page" id="gp-images-page" value="1" checked="checked" /> <?php esc_html_e( "Videos", "gauge" ); ?> <input type="checkbox" name="gp_videos_page" id="gp-videos-page" value="1" checked="checked" /> <?php esc_html_e( "Write A Review", "gauge" ); ?> <input type="checkbox" name="ghostpool_write_a_review_page" id="gp-write-a-review-page" value="1" checked="checked" /> <?php esc_html_e( "User Reviews", "gauge" ); ?> <input type="checkbox" name="gp_user_reviews_page" id="gp-user-reviews-page" value="1" checked="checked" /> <?php if ( function_exists( "ghostpool_custom_hub_options" ) ) { ghostpool_custom_hub_options(); }; ?></div>' +
				
				'<div class="gp-hub-form-option"><div class="gp-hub-form-title"><?php esc_html_e( "Hub Page Layout:", "gauge" ); ?></div><input type="text" name="ghostpool_custom_page_content" id="gp-custom-page-content" value="<?php if ( isset( $_POST["ghostpool_custom_page_content"] ) ) { echo absint( $_POST["ghostpool_custom_page_content"] ); } ?>" placeholder="<?php esc_html_e( "Page ID", "gauge" ); ?>" /><div class="gp-hub-form-desc"><?php esc_html_e( "Create a custom hub page layout and use it for all hubs by entering the page ID", "gauge" ); ?></div></div>' +
								
				'<div class="gp-hub-form-option"><div class="gp-hub-form-title"><?php esc_html_e( "Post Date:", "gauge" ); ?></div><input type="text" name="ghostpool_date_time" id="gp-date-time" value="<?php if ( isset( $_POST["ghostpool_date_time"] ) ) { echo esc_attr( $_POST["ghostpool_date_time"] ); } ?>" placeholder="<?php esc_html_e( "Y-m-d H:i:s", "gauge" ); ?>" /><div class="gp-hub-form-desc"><?php esc_html_e( "Add a date to schedule when your pages are published e.g. 2015-07-02 20:55:34 (leave blank to publish immediately)", "gauge" ); ?></div></div>' + 
				
				'<div class="gp-hub-form-button"><input type="submit" value="<?php esc_html_e( "Create", "gauge" ); ?>" tabindex="40" id="gp-hub-page-submit" name="ghostpool_submit" class="button add-new-h2" /><input type="hidden" name="ghostpool_action" value="ghostpool_hub_pages" /></div></form></div>' );
				
				/*--------------------------------------------------------------
				Show/hide review child box checkbox on Automatic Hub Creation form
				--------------------------------------------------------------*/

				jQuery( document ).ready( function( $ ) {

					'use strict';

					if ( document.getElementById( 'gp-page-template' ) != null ) {

						// Settings when changing menu
						document.getElementById( 'gp-page-template' ).onchange = function ( value ) {
							var value = document.getElementById( 'gp-page-template' ).value;	
							if ( value.indexOf( 'hub-review-template.php' ) >= 0 ) {
								$( '#gp-review-page' ).prop( { 'checked': false, 'disabled': true } );
							} else {	
								$( '#gp-review-page' ).prop( { 'checked': true, 'disabled': false } );
							}				
						};

					}
				});
								
			</script>
		<?php }
	}
}
add_action( 'admin_print_footer_scripts', 'ghostpool_add_hub_pages' );


/*--------------------------------------------------------------
Create hub pages
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_create_hub_pages' ) ) {
	function ghostpool_create_hub_pages() {

		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['ghostpool_action'] ) && $_POST['ghostpool_action'] == 'ghostpool_hub_pages' ) {

			if ( trim( $_POST['ghostpool_hub_page_title'] ) === '' ) {
				wp_die( esc_html__( 'You need to give your hub page a title before you can create it. Click the BACK button in your browser and add your title.', 'gauge' ) );
				$gp_has_error = true;
			} else {
				$gp_has_error = false;
			}
		
			if ( isset( $_POST['ghostpool_hub_page_title'] ) && $gp_has_error == false ) {

				// Hub Page	
				$gp_new_page_title = $_POST['ghostpool_hub_page_title'];
				$gp_custom_page_content = $_POST['ghostpool_custom_page_content'];
				
				if ( $gp_custom_page_content ) {	
				
					$gp_new_page_content = get_post_field( 'post_content', absint( $gp_custom_page_content ) );
				
				} else {	
				
					if ( $_POST['ghostpool_page_template'] == 'hub-review-template.php' ) {
						
						$gp_new_page_content = '';
					
					} else {
							
						$gp_new_page_content = '[vc_row css=".vc_custom_1407855744612{margin-bottom: 0px !important;}"][vc_column width="7/12" css=".vc_custom_1407855616904{margin-bottom: 0px !important;}"][news widget_title="' . esc_html__( 'Latest News', 'gauge' ) . '" per_page="4" page_numbers="enabled" see_all="enabled"][vc_empty_space height="40px"][/vc_column][vc_column width="5/12"][vc_row_inner][vc_column_inner][images widget_title="' . esc_html__( 'Latest Images', 'gauge' ) . '" image_width="157" image_height="132" see_all="enabled"][/vc_column_inner][/vc_row_inner][vc_empty_space height="40px"][vc_row_inner css=".vc_custom_1407855701457{margin-bottom: 0px !important;}"][vc_column_inner][videos widget_title="' . esc_html__( 'Latest Videos', 'gauge' ) . '" meta_date="1" see_all="enabled"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]';
						
					}
						
				}
				$gp_new_page = array(
					'post_type'      => 'page',
					'post_date'      => esc_attr( $_POST['ghostpool_date_time'] ),
					'post_date_gmt'  => esc_attr( $_POST['ghostpool_date_time'] ),
					'post_title'     => esc_attr( $gp_new_page_title ),
					'post_content'   => $gp_new_page_content,
					'post_status'    => 'publish',
					'comment_status' => 'closed'
				);
				$gp_hub_page_id = wp_insert_post( $gp_new_page );
				update_post_meta( $gp_hub_page_id, '_wp_page_template', esc_attr( $_POST['ghostpool_page_template'] ) );	
				update_post_meta( $gp_hub_page_id, '_gp_hub_page', 'enabled' );			

				// Prefix child pages with hub page title	
				if ( isset( $_POST['ghostpool_prefix_child_pages'] ) && $_POST['ghostpool_prefix_child_pages'] == '1' ) {		
					$gp_hub_title_prefix = $_POST['ghostpool_hub_page_title'] . ' ';
				} else {
					$gp_hub_title_prefix = '';	
				}

				// Prefix child page URL with hub page title	
				if ( isset( $_POST['ghostpool_prefix_child_urls'] ) && $_POST['ghostpool_prefix_child_urls'] == '1' ) {		
					$gp_hub_url_prefix = $_POST['ghostpool_hub_page_title'] . '-';
				} else {
					$gp_hub_url_prefix = '';
				}
				
				// Review Page
				if ( isset( $_POST['ghostpool_review_page'] ) && $_POST['ghostpool_review_page'] == '1' ) {
					$gp_new_page_title = $gp_hub_title_prefix . esc_html__( 'Review', 'gauge' );
					$gp_new_page_content = '';
					$gp_new_page = array(
						'post_type'      => 'page',
						'post_date'      => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_date_gmt'  => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_title'     => esc_attr( $gp_new_page_title ),
						'post_name'      => sanitize_title( $gp_hub_url_prefix . '-' . esc_html__( 'review', 'gauge' ) ),
						'post_content'   => $gp_new_page_content,
						'post_status'    => 'publish',
						'post_parent'    => $gp_hub_page_id
					);
					$gp_new_page_id = wp_insert_post( $gp_new_page );
					update_post_meta( $gp_new_page_id, '_wp_page_template', 'review-template.php' );		
					update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );
				}
				
				// News Page
				if ( isset( $_POST['ghostpool_news_page'] ) && $_POST['ghostpool_news_page'] == '1' ) {	
					$gp_new_page_title = $gp_hub_title_prefix . esc_html__( 'News', 'gauge' );
					$gp_new_page_content = '';
					$gp_new_page = array(
						'post_type'      => 'page',
						'post_date'      => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_date_gmt'  => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_title'     => esc_attr( $gp_new_page_title ),
						'post_name'      => sanitize_title( $gp_hub_url_prefix . '-' . esc_html__( 'news', 'gauge' ) ),
						'post_content'   => $gp_new_page_content,
						'post_status'    => 'publish',
						'comment_status' => 'closed',
						'post_parent'    => $gp_hub_page_id
					);
					$gp_new_page_id = wp_insert_post( $gp_new_page );
					update_post_meta( $gp_new_page_id, '_wp_page_template', 'news-template.php' );			
					update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );	
				}
				
				// Images Page
				if ( isset( $_POST['ghostpool_images_page'] ) && $_POST['ghostpool_images_page'] == '1' ) {
					$gp_new_page_title = $gp_hub_title_prefix . esc_html__( 'Images', 'gauge' );
					$gp_new_page_content = '';
					$gp_new_page = array(
						'post_type'      => 'page',
						'post_date'      => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_date_gmt'  => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_title'     => esc_attr( $gp_new_page_title ),
						'post_name'      => sanitize_title( $gp_hub_url_prefix . '-' . esc_html__( 'images', 'gauge' ) ),
						'post_content'   => $gp_new_page_content,
						'post_status'    => 'publish',
						'comment_status' => 'closed',
						'post_parent'    => $gp_hub_page_id
					);
					$gp_new_page_id = wp_insert_post( $gp_new_page );
					update_post_meta( $gp_new_page_id, '_wp_page_template', 'images-template.php' );		
					update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );		
				}
				// Videos Page
				if ( isset( $_POST['gp_videos_page'] ) && $_POST['gp_videos_page'] == '1' ) {
				$gp_new_page_title = $gp_hub_title_prefix . esc_html__( 'Videos', 'gauge' );
					$gp_new_page_content = '';
					$gp_new_page = array(
						'post_type'      => 'page',
						'post_date'      => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_date_gmt'  => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_title'     => esc_attr( $gp_new_page_title ),
						'post_name'      => sanitize_title( $gp_hub_url_prefix . '-' . esc_html__( 'videos', 'gauge' ) ),
						'post_content'   => $gp_new_page_content,
						'post_status'    => 'publish',
						'comment_status' => 'closed',
						'post_parent'    => $gp_hub_page_id
					);
					$gp_new_page_id = wp_insert_post( $gp_new_page );
					update_post_meta( $gp_new_page_id, '_wp_page_template', 'videos-template.php' );		
					update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );		
				}
					
				// Write A Review Page
				if ( isset( $_POST['ghostpool_write_a_review_page'] ) && $_POST['ghostpool_write_a_review_page'] == '1' ) {
					$gp_new_page_title = $gp_hub_title_prefix . esc_html__( 'Write A Review', 'gauge' );
					$gp_new_page_content = '';
					$gp_new_page = array(
						'post_type'      => 'page',
						'post_date'      => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_date_gmt'  => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_title'     => esc_attr( $gp_new_page_title ),
						'post_name'      => sanitize_title( $gp_hub_url_prefix . '-' . esc_html__( 'write-a-review', 'gauge' ) ),
						'post_content'   => $gp_new_page_content,
						'post_status'    => 'publish',
						'comment_status' => 'closed',
						'post_parent'    => $gp_hub_page_id
					);
					$gp_new_page_id = wp_insert_post( $gp_new_page );
					update_post_meta( $gp_new_page_id, '_wp_page_template', 'write-a-review-template.php' );		
				}
				
				// User Reviews Page
				if ( isset( $_POST['gp_user_reviews_page'] ) && $_POST['gp_user_reviews_page'] == '1' ) {
					$gp_new_page_title = $gp_hub_title_prefix . esc_html__( 'User Reviews', 'gauge' );
					$gp_new_page_content = '';
					$gp_new_page = array(
						'post_type'      => 'page',
						'post_date'      => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_date_gmt'  => esc_attr( $_POST['ghostpool_date_time'] ),
						'post_title'     => esc_attr( $gp_new_page_title ),
						'post_name'      => sanitize_title( $gp_hub_url_prefix . '-' . esc_html__( 'user-reviews', 'gauge' ) ),
						'post_content'   => $gp_new_page_content,
						'post_status'    => 'publish',
						'comment_status' => 'closed',
						'post_parent'    => $gp_hub_page_id
					);
					$gp_new_page_id = wp_insert_post( $gp_new_page );
					update_post_meta( $gp_new_page_id, '_wp_page_template', 'user-reviews-template.php' );			
					update_post_meta( $gp_new_page_id, '_gp_hub_page', 'enabled' );
				}
				
				// Add custom page via your child theme using this function
				if ( function_exists( 'ghostpool_custom_hub_page' ) ) {
					ghostpool_custom_hub_page( $gp_hub_page_id, $gp_hub_title_prefix );
				}
									
				// Redirect to hub page
				wp_redirect( get_permalink( $gp_hub_page_id ) );
				exit;

			}
			
		}

	}
}

return ghostpool_create_hub_pages();	

?>