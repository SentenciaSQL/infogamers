<?php

// Get image IDs
$gp_image_ids = array_filter( explode( ',', get_post_meta( get_the_ID(), 'gallery_slider', true ) ) );	

if ( $gp_image_ids ) { ?>

	<div class="gp-post-format-gallery-slider gp-slider gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_image_alignment'] ); ?>" style="width: <?php echo absint( $GLOBALS['ghostpool_image_width'] ); ?>px;"> 
		 
		 <ul class="slides">
			<?php foreach ( $gp_image_ids as $gp_image_id ) { ?>
				<li>
					<?php $gp_image = aq_resize( wp_get_attachment_url( $gp_image_id ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ), $GLOBALS['ghostpool_hard_crop'], false, true ); ?>
					<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
						$gp_retina = aq_resize( wp_get_attachment_url( $gp_image_id ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ) * 2, preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ) * 2, $GLOBALS['ghostpool_hard_crop'], true, true );
					} else {
						$gp_retina = '';
					} ?>
					<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute(); } ?>" class="gp-post-image" />			
				</li>
			<?php } ?>
		</ul>
		
	 </div>

<?php } ?>