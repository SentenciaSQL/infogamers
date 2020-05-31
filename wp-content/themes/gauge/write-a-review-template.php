<?php
/*
Template Name: Write A Review
*/

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

if ( ( ghostpool_option( 'write_a_review_visitors') == 'enabled' && ! is_user_logged_in() ) OR is_user_logged_in() ) {

	$gp_user_review_title_error = '';
	$gp_user_review_name_error = '';
	$gp_user_review_email_error = '';
	$gp_user_review_rating_error = '';
	$gp_user_review_content_error = '';
	$gp_user_captcha_error = '';
	$gp_has_error = '';

	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['ghostpool_action'] ) && $_POST['ghostpool_action'] == 'ghostpool_new_post' ) {

		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'ghostpool_submit_user_review' ) ) {
			exit();
		}
			
		if ( trim( $_POST['ghostpool_user_review_title'] ) === '' ) {
			$gp_user_review_title_error = esc_html__( 'Please give your review a title.', 'gauge' );
			$gp_has_error = true;
		}

		if ( trim( $_POST['ghostpool_user_review_name'] ) === '' && ! is_user_logged_in() ) {
			$gp_user_review_name_error = esc_html__( 'Please add your name.', 'gauge' );
			$gp_has_error = true;
		}

		if ( trim( $_POST['ghostpool_user_review_email'] ) === '' && ! is_user_logged_in() ) {
			$gp_user_review_email_error = esc_html__( 'Please add your email.', 'gauge' );
			$gp_has_error = true;
		} elseif ( ! is_email( $_POST['ghostpool_user_review_email'] ) && ! is_user_logged_in() ) {
			$gp_user_review_email_error = esc_html__( 'Your email address is not valid.', 'gauge' );
			$gp_has_error = true;
		}
			
		if ( trim( $_POST['ghostpool_user_review_rating'] ) === '' ) {
			$gp_user_review_rating_error = esc_html__( 'Please give your review a rating.', 'gauge' );
			$gp_has_error = true;
		} elseif ( ! is_numeric( $_POST['ghostpool_user_review_rating'] ) ) {
			$gp_user_review_rating_error = esc_html__( 'Please make sure your rating is a numerical value.', 'gauge' );
			$gp_has_error = true;
		} elseif ( $_POST['ghostpool_user_review_rating'] < 1 OR $_POST['ghostpool_user_review_rating'] > ghostpool_option( 'review_rating_number' ) ) {
			$gp_user_review_rating_error = sprintf( esc_html__( 'Please give a rating between 1 and %s', 'gauge' ), ghostpool_option( 'review_rating_number' ) );
			$gp_has_error = true;
		}
			
		if ( trim( $_POST['ghostpool_user_review_content'] ) === '' ) {
			$gp_user_review_content_error = esc_html__( 'Please give your review some content.', 'gauge' );
			$gp_has_error = true;
		}

		$captcha = ghostpool_captcha();
		if ( $captcha && $captcha['reason'] != '' ) {
			$has_error = true;
		}
		
		if ( isset( $_POST['ghostpool_user_review_title'] ) ) {
			$gp_user_review_title = $_POST['ghostpool_user_review_title'];
		}

		if ( isset( $_POST['ghostpool_user_review_name'] ) ) {
			$gp_user_review_name = $_POST['ghostpool_user_review_name'];
		}

		if ( isset( $_POST['ghostpool_user_review_email'] ) ) {
			$gp_user_review_email = $_POST['ghostpool_user_review_email'];
		}
			
		if ( isset( $_POST['ghostpool_user_review_rating'] ) ) {
			$gp_user_review_rating = $_POST['ghostpool_user_review_rating'];
		} 
			
		if ( isset( $_POST['ghostpool_user_review_content'] ) ) {
			$gp_user_review_content = $_POST['ghostpool_user_review_content'];
		}
				
		if ( isset( $_POST['ghostpool_user_review_title'] ) && isset( $_POST['ghostpool_user_review_name'] ) && isset( $_POST['ghostpool_user_review_email'] ) && isset( $_POST['ghostpool_user_review_rating'] ) && isset( $_POST['ghostpool_user_review_content'] ) && $gp_has_error == false ) {

			global $wpdb;
		
			// Approve or pending submitted review
			if ( ghostpool_option( 'write_a_review_submitting' ) == 'approved' ) {
				$gp_post_status = 'publish';
			} else {
				$gp_post_status = 'pending';
			}
			
			// Create review
			$gp_new_post = array(
				'post_type'     => 'gp_user_review',
				'post_status'   => $gp_post_status,
				'post_title'    => $gp_user_review_title,
				'post_content'  => $gp_user_review_content,
			);
			$gp_post_id = wp_insert_post( $gp_new_post );
		
			// Upload featured image
			if ( ! empty( $_FILES ) ) {
				foreach ( $_FILES as $gp_file => $gp_array ) {
					$gp_newupload = ghostpool_insert_attachment( $gp_file, $gp_post_id );
				}
			}
						
			// Get post or hub association ID
			$post_id = ghostpool_get_hub_id( get_the_ID() );

			// Add parent hub ID
			update_post_meta( $gp_post_id, '_hub_page_id', $post_id );
			
			// Add name custom field only if user is not logged in
			if ( isset( $_POST['ghostpool_user_review_name'] ) && ! is_user_logged_in() ) {
				update_post_meta( $gp_post_id, '_user_review_name', $gp_user_review_name );	
			}
			
			// Add rating custom field
			update_post_meta( $gp_post_id, '_user_review_rating', $gp_user_review_rating );

			// Add email custom field
			if ( is_user_logged_in() ) {			
				$gp_author_id = get_post_field( 'post_author', $gp_post_id );
				$gp_user_review_email = get_the_author_meta( 'user_email', $gp_author_id );
			}	
			update_post_meta( $gp_post_id, 'user_review_email', $gp_user_review_email );	
				
			// Notify admin of review via email
			if ( $gp_post_status == 'pending' && ghostpool_option( 'write_a_review_email_notification' ) != 'disabled' ) {
				if ( $gp_user_review_name != '' ) {
					$gp_author = $gp_user_review_name;
				} else {
					$gp_author_id = get_post_field( 'post_author', $gp_post_id );
					$gp_author = get_the_author_meta( 'display_name', $gp_author_id );
				}
				$gp_to = get_option( 'admin_email' );
				$gp_subject = "User Review [submitted]: '" . stripslashes( $gp_user_review_title ) . "' - " . get_bloginfo( 'name' );
				$gp_message = "A user review was submitted on " . get_bloginfo( 'name' ) . "\r\n\r\n";
				$gp_message .= "Title: " . stripslashes( $gp_user_review_title ) . "\n";
				$gp_message .= "Author: " . esc_attr( $gp_author ) . " (" . sanitize_email( $gp_user_review_email ) . ")\r\n\r\n";
				$gp_message .= "You can view this post at " . get_permalink( $gp_post_id );
				$gp_headers = '';
				ghostpool_wp_mail( $gp_to, $gp_subject, $gp_message, $gp_headers );				
			}
				
			// Permalink structure for success URL
			if ( get_option( 'permalink_structure' ) ) {
				wp_redirect( $_SERVER['REQUEST_URI'] . '?user_review=submitted&id=' . $gp_post_id );
			} else { 
				wp_redirect( $_SERVER['REQUEST_URI'] . '&user_review=submitted&id=' . $gp_post_id );
			}
			
			exit;
		
		}
		
	}

}

get_header();

?>

<?php ghostpool_page_header( $post_id ); ?>
				
<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

	<div id="gp-content">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		

			<?php if ( isset( $GLOBALS['ghostpool_hub_header'] ) && $GLOBALS['ghostpool_hub_header'] == true ) { ?>
				<header class="gp-entry-header">
					<h1 class="gp-entry-title" itemprop="headline"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></h1>
				</header>
			<?php } ?>
			
			<?php if ( ( ghostpool_option( 'write_a_review_visitors' ) == 'enabled' && ! is_user_logged_in() ) OR is_user_logged_in() ) { ?>

				<form id="gp-user-review-form"<?php if ( ghostpool_option( 'write_a_review_rules' ) ) { ?> class="gp-small-form"<?php } ?> name="ghostpool_user_review_form" method="post" action="" enctype="multipart/form-data" role="form">	

					<?php if ( ! empty( $_GET['user_review'] ) && $_GET['user_review'] == 'submitted' ) { ?>
						<div class="gp-user-review-success">
						<?php if ( ghostpool_option( 'write_a_review_submitting') == 'approved' ) {
							echo esc_html__( 'Your review has been posted.', 'gauge' ) . '<span class="gp-view-review-link"><a href="' . get_permalink( $_GET['id'] ) . '">' . esc_html__( 'View this review', 'gauge' ) . '</a></span>';
						} else {
							esc_html_e( 'Your review was succesfully submitted. Once it is approved by a member of staff it will show up on the site.', 'gauge' );
						} ?>
						</div>	
					<?php } ?>
					
					<p>
						<label for="gp-user-review-title"><?php esc_html_e( 'Title', 'gauge' ); ?> <span class="required">*</span></label>
						<input type="text" name="ghostpool_user_review_title" id="gp-user-review-title" value="<?php if ( isset( $_POST['ghostpool_user_review_title'] ) ) { echo esc_attr( $_POST['ghostpool_user_review_title'] ); } ?>">
						<?php if ( $gp_user_review_title_error != '' ) { ?><span class="gp-user-review-error"><?php echo esc_attr( $gp_user_review_title_error ); ?></span><?php } ?>
					</p>

					<?php if ( ! is_user_logged_in() ) { ?>
						<p>
							<label for="gp-user-review-name"><?php esc_html_e( 'Your Name', 'gauge' ); ?> <span class="required">*</span></label>
							<input type="text" name="ghostpool_user_review_name" id="gp-user-review-name" value="<?php if ( isset( $_POST['ghostpool_user_review_name'] ) ) { echo esc_attr( $_POST['ghostpool_user_review_name'] ); } ?>">
							<?php if ( $gp_user_review_name_error != '' ) { ?><span class="gp-user-review-error"><?php echo esc_attr( $gp_user_review_name_error ); ?></span><?php } ?>
						</p>
					<?php } else { ?>
						<input type="hidden" name="ghostpool_user_review_name" id="gp-user-review-name" value="">
					<?php } ?>

					<?php if ( ! is_user_logged_in() ) { ?>
						<p>
							<label for="gp-user-review-email"><?php esc_html_e( 'Your Email', 'gauge' ); ?> <span class="required">*</span></label>
							<input type="text" name="ghostpool_user_review_email" id="gp-user-review-email" value="<?php if ( isset( $_POST['ghostpool_user_review_email'] ) ) { echo esc_attr( $_POST['ghostpool_user_review_email'] ); } ?>">
							<?php if ( $gp_user_review_email_error != '' ) { ?><span class="gp-user-review-error"><?php echo esc_attr( $gp_user_review_email_error ); ?></span><?php } ?>
						</p>
					<?php } else { ?>
						<input type="hidden" name="ghostpool_user_review_email" id="gp-user-review-email" value="">
					<?php } ?>
												
					<p class="gp-comment-form-rating">
						<label for="gp-user-review-rating"><?php esc_html_e( 'Rating', 'gauge' ); ?> <span class="required">*</span></label>
						<input type="text" name="ghostpool_user_review_rating" id="gp-user-review-rating" value="<?php if ( isset( $_POST['ghostpool_user_review_rating'] ) ) { echo floatval( $_POST['ghostpool_user_review_rating'] ); } ?>">												                       
						<?php if ( $gp_user_review_rating_error != '' ) { ?><span class="gp-user-review-error"><?php echo esc_attr( $gp_user_review_rating_error ); ?></span><?php } ?>
					</p>
														
					<p>
						<label for="gp-user-review-image"><?php esc_html_e( 'Image', 'gauge' ); ?></label>
						<input type="file" name="ghostpool_user_review_image" id="gp-user-review-image">
					</p>
															
					<p>
						<label for="gp-user-review-content"><?php esc_html_e( 'Review', 'gauge' ); ?> <span class="required">*</span></label>
						<?php if ( isset( $_POST['ghostpool_user_review_content'] ) ) {
							$gp_parse_user_review_content = stripslashes( html_entity_decode( $_POST['ghostpool_user_review_content'] ) );
						} else {
							$gp_parse_user_review_content = '';
						} ?>
						<?php wp_editor( $gp_parse_user_review_content, 'ghostpool_user_review_content', $gp_settings = array( true, true, 'ghostpool_user_review_content' ) );  ?>
						<?php if ( $gp_user_review_content_error != '' ) { ?><span class="gp-user-review-error"><?php echo esc_attr( $gp_user_review_content_error ); ?></span><?php } ?> 
					</p>

					<?php if ( function_exists( 'ghostpool_custom_captcha_display' ) ) {
						echo ghostpool_custom_captcha_display();
					} elseif ( function_exists( 'gglcptch_display' ) ) { 
						echo gglcptch_display(); 
					} elseif ( has_filter( 'hctpc_verify' ) ) {
						echo apply_filters( 'hctpc_display', '' );
					} elseif ( has_filter( 'cptch_verify' ) ) {
						echo apply_filters( 'cptch_display', '' ); 
					} ?>

					<p><input type="submit" value="<?php esc_attr_e(' Post Review', 'gauge' ); ?>" tabindex="40" id="submit" name="submit" /></p>

					<?php if ( ghostpool_option( 'write_a_review_gdpr' ) == 'enabled' ) { ?>
						<p class="gp-gdpr"><input name="gdpr" class="gdpr" type="checkbox" value="1" required /> <label><?php echo wp_kses_post( ghostpool_option( 'write_a_review_gdpr_text' ) ); ?></label></p>
					<?php } ?>
					
					<input type="hidden" name="ghostpool_action" value="ghostpool_new_post" />
			
					<?php wp_nonce_field( 'ghostpool_submit_user_review' ); ?>
		
				</form>
		
				<?php if ( ghostpool_option( 'write_a_review_rules' ) ) { ?>
					<div id="gp-user-review-rules">
						<?php echo wp_kses_post( ghostpool_option( 'write_a_review_rules' ) ); ?>
					</div>
				<?php } ?>
			
			<?php } else { ?>
				
				<strong class="gp-no-items-found"><?php esc_html_e( 'You must be logged in to post a review.', 'gauge' ); ?></strong>
			
			<?php } ?>
	
		<?php endwhile; endif; ?>			

	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>