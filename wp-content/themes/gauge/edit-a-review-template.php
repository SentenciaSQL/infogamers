<?php
/*
Template Name: Edit A Review
*/

if ( ! is_user_logged_in() OR ghostpool_option( 'write_a_review_editing' ) == 'disabled' OR ( empty( $_POST['ghostpool_user_review_id'] ) && empty( $_GET['user_review'] ) ) ) {

	wp_redirect( home_url( '/' ) );	
	
} else {
  
	$gp_user_review_title_error = '';
	$gp_user_review_rating_error = '';
	$gp_user_review_content_error = '';
	$gp_has_error = '';
	
	 if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['ghostpool_action'] ) && $_POST['ghostpool_action'] == 'ghostpool_edit_post' && isset( $_POST['ghostpool_user_review_id'] ) ) {
		 
		$gp_post_to_edit = array();
		$gp_post_to_edit = get_post( $_POST['ghostpool_user_review_id'] );

		if ( trim( $_POST['ghostpool_user_review_title'] ) === '' ) {
			$gp_user_review_title_error = esc_html__( 'Please give your review a title.', 'gauge' );
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
		
		if ( isset( $_POST['ghostpool_user_review_title'] ) ) {
			$gp_user_review_title = $_POST['ghostpool_user_review_title'];
		}
	
		if ( isset( $_POST['ghostpool_user_review_rating'] ) ) {
			$gp_user_review_rating = $_POST['ghostpool_user_review_rating'];
		} 
			
		if ( isset( $_POST['ghostpool_user_review_content'] ) ) {
			$gp_user_review_content = $_POST['ghostpool_user_review_content'];
		}
		
		if ( isset( $_POST['ghostpool_user_review_title'] ) && isset( $_POST['ghostpool_user_review_rating'] ) && isset( $_POST['ghostpool_user_review_content'] ) && $gp_has_error == false ) {
	
			if ( $gp_post_to_edit->post_status == 'publish' && ghostpool_option( 'write_a_review_editing' ) == 'approved' ) {
				$gp_post_to_edit->post_status = 'publish';
			} else {
				$gp_post_to_edit->post_status = 'pending';
			}
			$gp_post_to_edit->post_title = stripslashes( $gp_user_review_title );
			$gp_post_to_edit->post_content = stripslashes( $gp_user_review_content );
			
			$gp_post_id = wp_update_post( $gp_post_to_edit );
			
			update_post_meta( $gp_post_id, '_user_review_rating', $gp_user_review_rating );

			// Notify admin of review via email
			if ( $gp_post_to_edit->post_status == 'pending' && ghostpool_option( 'write_a_review_email_notification' ) == 'email_always' ) {
				$gp_to = get_option( 'admin_email' );
				$gp_subject = "User Review [edit]: '" . stripslashes( $gp_user_review_title ) . "' - " . get_bloginfo( 'name' );
				$gp_message .= "A user review was edited on " . get_bloginfo( 'name' ) . "\n";
				$gp_message .= "Title: " . stripslashes( $gp_user_review_title ) . "\n";
				$gp_message .= "You can view this post at " . get_permalink( $gp_post_id );
				$gp_headers = '';
				ghostpool_wp_mail( $gp_to, $gp_subject, $gp_message, $gp_headers );				
			}
			
			// Permalink structure for success URL	
			if ( get_option( 'permalink_structure' ) ) {
				wp_redirect( $_SERVER['REQUEST_URI'] . '?user_review=edited&id=' . $_POST['ghostpool_user_review_id'] );
			} else { 
				wp_redirect( $_SERVER['REQUEST_URI'] . '&user_review=edited&id=' . $_POST['ghostpool_user_review_id'] );	
			}

			// Upload featured image
			if ( ! empty( $_FILES ) ) {
				foreach ( $_FILES as $gp_file => $array ) { 
					$gp_newupload = ghostpool_insert_attachment( $gp_file, $gp_post_id );
				}
			}
			
		}
		
	}
	 
	get_header();

	?>

	<?php echo ghostpool_page_header( get_the_ID() ); ?>
				
	<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

		<div id="gp-content">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							
				<?php if ( ! empty( $_GET['user_review'] ) && $_GET['user_review'] == 'edited' ) { ?>
			
					<div class="gp-user-review-success">
						<?php if ( ghostpool_option( 'write_a_review_editing' ) == 'approved' ) { ?>
							<?php echo esc_html__( 'Your review was succesfully edited.', 'gauge' ) . '<span class="gp-view-review-link"><a href="' . get_permalink( $_GET['id'] ) . '">' . esc_html__( 'View this review', 'gauge' ) . '</a></span>'; ?>
						<?php } else { ?>
							<?php esc_html_e( 'Your review was succesfully edited but will need to be approved before it is shown on the site again.', 'gauge' ); ?>
						<?php } ?>	
					</div>	
			
				<?php } else { ?>	
			
					<?php $gp_post_to_edit = get_post( $_POST['ghostpool_user_review_id'] ); ?>

					<form id="gp-edit-post" name="ghostpool_edit_post" method="post" action="" enctype="multipart/form-data">						
						
						<p>
							<label for="gp-user-review-title"><?php esc_html_e( 'Title', 'gauge' ); ?> <span class="required">*</span></label>
							<input type="text" name="ghostpool_user_review_title" id="gp-user-review-title" value="<?php echo esc_attr( $gp_post_to_edit->post_title ); ?>">
							<?php if ( $gp_user_review_title_error != '' ) { ?><span class="gp-user-review-error"><?php echo esc_attr( $gp_user_review_title_error ); ?></span><?php } ?>
						</p>

						<p class="gp-comment-form-rating">
							<label for="gp-user-review-rating"><?php esc_html_e( 'Rating', 'gauge' ); ?> <span class="required">*</span></label>
							<input type="text" name="ghostpool_user_review_rating" id="gp-user-review-rating" value="<?php echo get_post_meta( $gp_post_to_edit->ID, '_user_review_rating', true ); ?>">													                       
							<?php if ( $gp_user_review_rating_error != '' ) { ?><span class="gp-user-review-error"><?php echo esc_attr( $gp_user_review_rating_error ); ?></span><?php } ?>
						</p>
						<p>
							<?php if ( has_post_thumbnail( $gp_post_to_edit->ID ) ) { ?>
								<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( $gp_post_to_edit->ID ) ), 150, 150, true, false, true ); ?>
								<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
									$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 150 * 2, 150 * 2, true, true, true );
								} else {
									$gp_retina = '';
								} ?>
								<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute(); } ?>" class="gp-post-image" /><br/>
							<?php } ?>										
							<label for="gp-user-review-image"><?php esc_html_e( 'Image', 'gauge' ); ?></label>
							<input type="file" name="ghostpool_user_review_image" id="gp-user-review-image" tabindex="30" value="" />	
						</p>
					
						<p>
							<label for="gp-user-review-content"><?php esc_html_e( 'Review', 'gauge' ); ?> <span class="required">*</span></label>
							<?php if ( $gp_post_to_edit->post_content ) {
								$gp_parse_user_review_content = stripslashes( html_entity_decode( $gp_post_to_edit->post_content ) );
							} else {
								$gp_parse_user_review_content = '';
							} ?>
							<?php wp_editor( $gp_parse_user_review_content, 'ghostpool_user_review_content', $gp_settings = array( true, true, 'ghostpool_user_review_content' ) );  ?>
							<?php if ( $gp_user_review_content_error != '' ) { ?><span class="gp-user-review-error"><?php echo esc_attr( $gp_user_review_content_error ); ?></span><?php } ?> 
						</p>
	
						<p><input type="submit" value="<?php esc_attr_e( 'Edit Review', 'gauge' ); ?>" tabindex="40" id="submit" name="submit" /></p>

						<input type="hidden" name="ghostpool_user_review_id" value="<?php echo absint( $gp_post_to_edit->ID ); ?>" />
						<input type="hidden" name="ghostpool_action" value="ghostpool_edit_post" />
	
						<?php // wp_nonce_field( 'new-post' ); ?>
	
					</form>
			
				<?php } ?>
	
			<?php endwhile; endif; ?>		
					
		</div>

		<?php get_sidebar(); ?>
	
	</div>

	<?php get_footer(); ?>
	
<?php } ?>	