<?php 

if ( ! function_exists( 'ghostpool_images' ) ) {

	function ghostpool_images( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'widget_title' => '',
			'upload_images' => '',
			'number' => '8',
			'image_width' => '176',
			'image_height' => '116',
			'hard_crop' => 'enabled',
			'see_all' => 'disabled',
			'see_all_link' => '',
			'see_all_text' => esc_html__( 'See All Images', 'gauge-plugin' ),
			'classes' => '',
		), $atts ) );
		
		global $post;
		
		// Unique Name	
		STATIC $gp_i = 0;
		$gp_i++;
		$gp_name = 'gp_images_wrapper_' . $gp_i;
		
		// Get post or hub association ID
		$post_id = ghostpool_get_hub_id( get_the_ID() );		
		
		 // Get images page images if none uploaded
		$gp_image_ids = '';
		if ( empty ( $upload_images ) && ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) ) {
			$gp_pages = get_pages( 'child_of=' . $post_id );
			foreach( $gp_pages as $gp_page ) {
				if ( get_post_meta( $gp_page->ID, '_wp_page_template', true ) == 'images-template.php' ) {
					$gp_image_ids = array_filter( explode( ',', redux_post_meta( 'gp', $gp_page->ID, 'images_gallery' ) ) );
					break;
				} else {
					$gp_image_ids = '';
				}
			}
		} elseif ( ! empty ( $upload_images ) ) {
			$gp_image_ids = array_filter( explode( ',', $upload_images ) );
		}

		// Get images page permalink if none specified
		if ( empty ( $see_all_link ) && ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) ) {
			$gp_pages = get_pages( 'child_of=' . $post_id );
			foreach( $gp_pages as $gp_page ) {
				if ( get_post_meta( $gp_page->ID, '_wp_page_template', true ) == 'images-template.php' ) {		
					$see_all_link = get_permalink( $gp_page->ID );
				}					
			}
		}
		
		ob_start();
					
		?>

		<div id="<?php echo sanitize_html_class( $gp_name ); ?>" class="gp-images-wrapper gp-vc-element <?php echo esc_attr( $classes ); ?>">

			<?php if ( $widget_title OR $see_all == 'enabled' ) { ?>
				<div class="gp-element-title">
					<?php if ( $widget_title ) { ?><h3><?php echo esc_attr( $widget_title ); ?></h3><?php } ?>
					<?php if ( $see_all == 'enabled' ) { ?>
						<div class="gp-see-all-link"><a href="<?php echo esc_url( $see_all_link ); ?>"><?php echo esc_attr( $see_all_text ); ?></a></div>
					<?php } ?>
					<div class="gp-element-title-line"></div>
				</div>
			<?php } ?>
		
			<div class="gp-inner-loop">
			
				<?php if ( $gp_image_ids ) { ?> 
					
					<?php $gp_count = 0; foreach ( array_reverse( $gp_image_ids ) as $gp_image_id ) { 
						
						if ( $gp_count++ < $number ) {
						
							// Get attachment data
							$gp_attachment = get_post( $gp_image_id ); ?>
						
							<div class="gp-image-loop">
							
								<?php $gp_image = aq_resize( wp_get_attachment_url( $gp_image_id ), $image_width, $image_height, $hard_crop, false, true ); ?>
								<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
									$gp_retina = aq_resize(wp_get_attachment_url( $gp_image_id ),  $image_width * 2, $image_height * 2, $hard_crop, true, true );
								} else {
									$gp_retina = '';
								} ?>
						
								<a href="<?php echo wp_get_attachment_url( $gp_image_id ); ?>" data-rel="prettyPhoto[group]" class="prettyPhoto" title="<?php echo esc_attr( $gp_attachment->post_excerpt ); ?>">
									<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute( array( 'post' => get_the_ID() ) ); } ?>" class="gp-post-image" />
								</a>
						
							</div>
																					
						<?php } ?>
					
					<?php } ?>
						
				<?php } else { ?>
								
					<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge-plugin' ); ?></strong>
				
				<?php } ?>
				
			</div>	
						
		</div>
			 				
		<?php

		$output_string = ob_get_contents();
		ob_end_clean(); 
		return $output_string;

	}

}

add_shortcode( 'images', 'ghostpool_images' );
	
?>