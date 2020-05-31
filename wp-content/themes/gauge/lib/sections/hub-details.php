<?php if ( $GLOBALS['ghostpool_hub_details'] == 'enabled' ) { 

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

?>

	<div id="gp-hub-details">

		<div class="gp-hub-block gp-hub-block-one">
			<div class="gp-entry-title"><?php echo get_the_title( $post_id ); ?></div>
		</div>

		<div class="gp-hub-block gp-hub-block-two"<?php echo wp_kses_post( $GLOBALS['ghostpool_title_bg_css'] ); ?>>
	
			<div class="gp-bg-overlay-dark"></div>
	
			<div class="gp-foreground-overlay">

				<?php if ( has_post_thumbnail( $post_id ) ) { ?>

					<div class="gp-post-thumbnail gp-entry-featured">
					
						<div class="gp-image-wrap-left">

							<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_hub_image_width'] ),  preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_hub_image_height'] ), $GLOBALS['ghostpool_hub_hard_crop'], false, true ); ?>
							<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
								$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ),  preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_hub_image_width'] ) * 2,  preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_hub_image_height'] ) * 2, $GLOBALS['ghostpool_hub_hard_crop'], true, true );
							} else {
								$gp_retina = '';
							} ?>

							<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute(); } ?>" class="gp-post-image" />
						
						</div>
						
					</div>

				<?php } ?>	

				<div class="gp-hub-synopsis" itemprop="text">
					<?php echo wpautop( do_shortcode( $GLOBALS['ghostpool_hub_synopsis'] ), false ); ?>
				</div>
	
			</div>
		
		</div>	
	
		<div class="gp-hub-block gp-hub-block-three">
	
			<?php if ( ghostpool_option( 'hub_fields' ) ) {
			
				// Support for foreign characters	
				$char_table = array();
				if ( function_exists( 'ghostpool_hub_field_characters' ) ) {
					$char_table = ghostpool_hub_field_characters();
				}	
			
				foreach( ghostpool_option( 'hub_fields' ) as $gp_hub_field ) {
					
					$gp_hub_field_slug = strtr( $gp_hub_field, $char_table );
					if ( function_exists( 'iconv' ) ) {
						$gp_hub_field_slug = iconv( 'UTF-8', 'UTF-8//TRANSLIT//IGNORE', $gp_hub_field_slug );
					}
					
					$gp_hub_field_slug = sanitize_title( $gp_hub_field_slug );
					$gp_hub_field_slug = substr( $gp_hub_field_slug, 0, 32 );
					$gp_term_list = get_the_term_list( $post_id, $gp_hub_field_slug, '<span><strong>' . $gp_hub_field . ':</strong>', ', ', '</span>' );
					if ( ! $gp_term_list OR is_wp_error( $gp_term_list ) ) {
						continue;
					}	
					if ( ghostpool_option( 'hub_field_links' ) == 'disabled' ) {
						$gp_term_list = preg_replace( '/<\/?a[^>]*>/', '', $gp_term_list );
					}
					echo wp_kses_post( $gp_term_list );
					
				}
					
			} ?>
					
		</div>	

	</div>
	
<?php } ?>