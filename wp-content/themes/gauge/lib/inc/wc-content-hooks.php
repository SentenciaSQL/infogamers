<?php

/**
 * Remove default WooCommerce content wrappers
 *
 * @since Gauge 6.9
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Opening WooCommerce content wrappers 
 *
 * @since Gauge 6.9
 */
if ( ! function_exists( 'ghostpool_wc_wrapper_start' ) ) {
	function ghostpool_wc_wrapper_start() {
  
		ghostpool_page_header( get_the_ID() );
		
		$gp_container_class = $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ? ' class="gp-container"' : '';

		echo '<div id="gp-content-wrapper"' . $gp_container_class . '>';
		
			echo '<div id="gp-content">';
						
	}
}
add_action( 'woocommerce_before_main_content', 'ghostpool_wc_wrapper_start', 10 );

/**
 * Closing WooCommerce content wrappers 
 *
 * @since Gauge 6.9
 */
if ( ! function_exists( 'ghostpool_wc_wrapper_end' ) ) {
	function ghostpool_wc_wrapper_end() {
			
			echo '</div>';

			get_sidebar();

		echo '</div>';

	}
}
add_action( 'woocommerce_after_main_content', 'ghostpool_wc_wrapper_end', 10 );

?>