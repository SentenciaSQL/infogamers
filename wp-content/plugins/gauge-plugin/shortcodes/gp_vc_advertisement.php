<?php

if ( ! function_exists( 'ghostpool_advertisement' ) ) {

	function ghostpool_advertisement( $atts, $content = null ) {
	
		extract( shortcode_atts( array(
			'widget_title' => '',
			'classes' => '',
		), $atts ) );
		
		// Unique Name	
		STATIC $gp_i = 0;
		$gp_i++;
		$gp_name = 'gp_advertisement_' . $gp_i;
		
		ob_start(); ?>
	
			<div id="<?php echo sanitize_html_class( $gp_name ); ?>" class="gp-advertisement-wrapper gp-vc-element <?php echo esc_attr( $classes ); ?>">
			
				<?php if ( $widget_title ) { ?>
					<div class="gp-element-title">
						<?php if ( $widget_title ) { ?><h3><?php echo esc_attr( $widget_title ); ?></h3><?php } ?>
						<div class="gp-element-title-line"></div>
					</div>
				<?php } ?>
			
				<?php echo wp_kses_post( $content ); ?>
				
			</div>
					
		<?php 

		$gp_output_string = ob_get_contents();
		ob_end_clean();
		return $gp_output_string;

	}
}
add_shortcode( 'advertisement', 'ghostpool_advertisement' );

?>