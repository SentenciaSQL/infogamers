<?php

// Resize ARVE thumbnail when there is no feature image specified
if ( function_exists( 'activate_advanced_responsive_video_embedder' ) && get_post_format() == 'video' && ! has_post_thumbnail() && $GLOBALS['ghostpool_featured_image'] == 'enabled' && $GLOBALS['ghostpool_image_alignment'] != 'image-above' ) {
	echo '<style>.post-format-video-content.gp-image-align-left .arve-wrapper,.post-format-video-content.gp-image-wrap-right .arve-wrapper,.post-format-video-content.gp-image-align-left .arve-wrapper,.post-format-video-content.gp-image-align-right .arve-wrapper {width: ' . $GLOBALS['ghostpool_image_width'] . 'px;}</style>';
}

// Margin class
if ( $GLOBALS['ghostpool_title_position'] == 'title-over-thumbnail' && $GLOBALS['ghostpool_excerpt_length'] == '0' && $GLOBALS['ghostpool_meta_author'] != '1' && $GLOBALS['ghostpool_meta_date'] != '1' && $GLOBALS['ghostpool_meta_comment_count'] != '1' && $GLOBALS['ghostpool_meta_views'] != '1' && $GLOBALS['ghostpool_meta_followers'] != '1' && $GLOBALS['ghostpool_meta_tags'] != '1' && $GLOBALS['ghostpool_meta_hub_cats'] != '1' && $GLOBALS['ghostpool_meta_hub_fields'] != '1' && $GLOBALS['ghostpool_meta_hub_award'] != '1' ) {
	$gp_margin_class = ' gp-no-margin';
} else {
	$gp_margin_class = '';
}

?>

<section <?php post_class( 'gp-post-item' . $gp_margin_class ); ?> itemscope itemtype="http://schema.org/Blog">

	<?php if ( is_main_query() && in_the_loop() && is_archive() ) { echo ghostpool_meta_data( get_the_ID() ); } ?>
	
	<?php if ( has_post_thumbnail() && $GLOBALS['ghostpool_featured_image'] == 'enabled' ) { ?>

		<div class="gp-post-thumbnail gp-loop-featured">
		
			<div class="gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_image_alignment'] ); ?>">
			
				<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ), $GLOBALS['ghostpool_hard_crop'], false, true ); ?>
				<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ) * 2, preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ) * 2, $GLOBALS['ghostpool_hard_crop'], true, true );
				} else {
					$gp_retina = '';
				} ?>			

				<?php $gp_mobile_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 80, 80, $GLOBALS['ghostpool_hard_crop'], false, true ); ?>
				<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_mobile_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 80 * 2, 80 * 2, $GLOBALS['ghostpool_hard_crop'], true, true );
				} else {
					$gp_retina = '';
				} ?>
			
				<a href="<?php if ( get_post_format() == 'link' ) { echo get_post_meta( get_the_ID(), 'link', true ); } else { the_permalink(); } ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"<?php if ( get_post_format() == 'link' ) { ?> target="<?php echo redux_post_meta( 'gp', get_the_ID(), 'link_target' ); ?>"<?php } ?>>
			
					<?php if ( $GLOBALS['ghostpool_title_position'] == 'title-over-thumbnail' ) { ?>
						<div class="gp-bottom-bg-gradient-overlay"></div>
						<h2 class="gp-loop-title" itemprop="headline"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></h2>
					<?php } ?>
							
					<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { echo ghostpool_prefix_hub_title( get_the_ID() ); } ?>" class="gp-post-image gp-large-image" />
					
					<img src="<?php echo esc_url( $gp_mobile_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_mobile_retina ); ?>" width="<?php echo absint( $gp_mobile_image[1] ); ?>" height="<?php echo absint( $gp_mobile_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { echo ghostpool_prefix_hub_title( get_the_ID() ); } ?>" class="gp-post-image gp-mobile-image" />
			
				</a>
				
			</div>	
								
		</div>

	<?php } elseif ( get_post_format() != '0' && $GLOBALS['ghostpool_featured_image'] == 'enabled' ) { ?>
	
		<div class="gp-loop-featured">
			<?php get_template_part( 'lib/sections/loop', get_post_format() ); ?>
		</div>
		
	<?php } ?>
	
	<?php if ( get_post_format() != 'quote' OR has_post_thumbnail() && $GLOBALS['ghostpool_featured_image'] == 'enabled' ) { ?>
	
		<div class="gp-loop-content gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_image_alignment'] ); ?>">

			<?php if ( ( $GLOBALS['ghostpool_title_position'] == 'title-next-to-thumbnail' && ( get_post_format() != 'quote' OR $GLOBALS['ghostpool_featured_image'] == 'enabled' ) ) OR ( $GLOBALS['ghostpool_title_position'] == 'title-over-thumbnail' && ! has_post_thumbnail() && get_post_format() != 'quote' ) ) { ?>
				<h2 class="gp-loop-title"><a href="<?php if ( get_post_format() == 'link' ) { echo esc_url( get_post_meta( get_the_ID(), 'link', true ) ); } else { the_permalink(); } ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"<?php if ( get_post_format() == 'link' ) { ?> target="<?php echo redux_post_meta( 'gp', get_the_ID(), 'link_target' ); ?>"<?php } ?>><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></a></h2>
			<?php } ?>
	
			<?php if ( $GLOBALS['ghostpool_content_display'] == 'full_content' ) { ?>

				<div class="gp-loop-text">
					<?php global $more; $more = 0; the_content( esc_html__( '[Read More]', 'gauge' ) ); ?>
				</div>

			<?php } else { ?>

				<?php if ( $GLOBALS['ghostpool_excerpt_length'] != '0' ) { ?>
					<div class="gp-loop-text">
						<p><?php echo ghostpool_excerpt( $GLOBALS['ghostpool_excerpt_length'] ); ?></p>
					</div>
				<?php } ?>

			<?php } ?>	

			<?php get_template_part( 'lib/sections/loop', 'meta' ); ?>

			<?php if ( isset( $GLOBALS['ghostpool_meta_tags'] ) && $GLOBALS['ghostpool_meta_tags'] == '1' ) { the_tags( '<div class="gp-loop-tags">', ' ', '</div>' ); } ?>
	
		</div>
	
	<?php } ?>
			
	<?php if ( $GLOBALS['ghostpool_format'] == 'blog-large' ) { ?>
		<div class="gp-loop-divider"></div>
	<?php } ?>	
				
</section>