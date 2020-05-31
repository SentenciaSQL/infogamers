<?php
/*
Template Name: Images
*/
get_header(); 

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

?>
		
<?php ghostpool_page_header( $post_id ); ?>	
	
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
	
	<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

		<div id="gp-content">

			<?php if ( isset( $GLOBALS['ghostpool_hub_header'] ) && $GLOBALS['ghostpool_hub_header'] == true ) { ?>
				<header class="gp-entry-header">
					<h1 class="gp-entry-title" itemprop="headline"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></h1>
				</header>
			<?php } ?>		
	
			<?php the_content(); ?>
					
			<?php 
		
			// Get image IDs
			$gp_image_ids = array_filter( explode( ',', ghostpool_option( 'images_gallery' ) ) );	

			if ( $gp_image_ids ) { ?>

				<div class="gp-images-lazyload-wrapper">
		
					<?php foreach ( array_reverse( $gp_image_ids ) as $gp_image_id ) { 
				
						// Get attachment data
						$gp_attachment = get_post( $gp_image_id ); ?>
				
						<div class="gp-image-loop">
					
							<?php $gp_image = aq_resize( wp_get_attachment_url( $gp_image_id ), preg_replace( '/[^0-9]/', '', ghostpool_option( 'images_image', 'width' ) ), preg_replace( '/[^0-9]/', '', ghostpool_option( 'images_image', 'height' ) ), ghostpool_option( 'images_hard_crop' ), false, true ); ?>
							<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
								$gp_retina = aq_resize(wp_get_attachment_url( $gp_image_id ), preg_replace( '/[^0-9]/', '', ghostpool_option( 'images_image', 'width' ) ) * 2, preg_replace( '/[^0-9]/', '', ghostpool_option( 'images_image', 'height' ) ) * 2, ghostpool_option( 'images_hard_crop' ), true, true );
							} else {
								$gp_retina = '';
							} ?>
				
							<a href="<?php echo wp_get_attachment_url( $gp_image_id ); ?>" data-rel="prettyPhoto[group]" class="prettyPhoto" title="<?php echo esc_attr( $gp_attachment->post_excerpt ); ?>">
								<img data-original="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute( array( 'post' => $post_id ) ); } ?>" class="gp-post-image" itemprop="image" />
							</a>
				
						</div>
																			
					<?php } ?>

				 </div>

			<?php } else { ?>
		
				<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>
		
			<?php } ?>
		
		</div>

		<?php get_sidebar(); ?>

	</div>
		
<?php endwhile; endif; ?>		
			
<?php get_footer(); ?>