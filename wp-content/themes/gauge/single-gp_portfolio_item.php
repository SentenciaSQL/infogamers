<?php get_header();

// Load page variables
ghostpool_loop_variables();
	
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

	// Portfolio Column Classes			
	if ( $GLOBALS['ghostpool_type'] == 'left-image' OR $GLOBALS['ghostpool_type'] == 'left-slider' ) {
		$gp_portfolio_class_1 = 'gp-portfolio-left-col';
		$gp_portfolio_class_2 = 'gp-portfolio-right-col';
	} else {
		$gp_portfolio_class_1 = 'gp-portfolio-full-col';
		$gp_portfolio_class_2 = '';			
	} 
	
 	?>		
 
	<?php ghostpool_page_header( get_the_ID() ); ?>

	<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>
						
		<div id="gp-content">

			<article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

				<?php echo ghostpool_meta_data( get_the_ID() ); ?>
				
				<div class="gp-entry-content gp-portfolio-row">
		
					<?php if ( $GLOBALS['ghostpool_type'] != 'none' ) { ?>

						<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ), $GLOBALS['ghostpool_hard_crop'], false, true ); ?>
						<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
							$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ),  preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ) * 2, preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ) * 2, $GLOBALS['ghostpool_hard_crop'], true, true );
						} else {
							$gp_retina = '';
						} ?>

						<?php if ( $GLOBALS['ghostpool_type'] == 'left-slider' OR $GLOBALS['ghostpool_type'] == 'fullwidth-slider' ) {

							// Gallery Image IDs
							$gp_image_ids = array_filter( explode( ',', ghostpool_option( 'portfolio_item_gallery_slider' ) ) );

							?>

							<div class="<?php echo sanitize_html_class( $gp_portfolio_class_1 ); ?>">

								<div class="gp-portfolio-slider gp-slider <?php echo sanitize_html_class( $GLOBALS['ghostpool_type'] ); ?>" style="width: <?php echo absint( $gp_image[1] ); ?>px;"> 
									 <ul class="slides">
										<?php foreach ( $gp_image_ids as $gp_image_id ) { ?>
											<li>
												<?php $gp_image = aq_resize( wp_get_attachment_url( $gp_image_id ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ), $GLOBALS['ghostpool_hard_crop'], false, true ); ?>
												<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
													$gp_retina = aq_resize(wp_get_attachment_url( $gp_image_id ),  preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ) * 2, preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ) * 2, $GLOBALS['ghostpool_hard_crop'], true, true );
												} else {
													$gp_retina = '';
												} ?>
												<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute(); } ?>" class="gp-post-image" />	
											</li>
										<?php } ?>
									</ul>
								 </div>
	 
							 </div>

						<?php } else { ?>

							<div class="<?php echo sanitize_html_class( $gp_portfolio_class_1 ); ?>">
						
								<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute(); } ?>" class="gp-post-image" />

							</div>
						
						<?php } ?>
			
					<?php } ?>

					<?php if ( $post->post_content ) { ?>
						<div class="<?php echo sanitize_html_class( $gp_portfolio_class_2 ); ?>">
							<?php the_content(); ?>
							<?php wp_link_pages( 'before=<div class="gp-pagination gp-pagination-numbers gp-standard-pagination gp-entry-pagination"><ul class="page-numbers">&pagelink=<span class="page-numbers">%</span>&after=</ul></div>' ); ?>
						</div>
					<?php } ?>
					
				</div>
								
				<?php if ( ghostpool_option( 'portfolio_item_related_items' ) == 'enabled' ) { ?>
					<?php get_template_part( 'lib/sections/related', 'items' ); ?>
				<?php } ?>
				
				<?php comments_template(); ?>

			</article>		

		</div>

		<?php get_sidebar(); ?>

	</div>

	<?php endwhile; endif; ?>	
			
<?php get_footer(); ?>