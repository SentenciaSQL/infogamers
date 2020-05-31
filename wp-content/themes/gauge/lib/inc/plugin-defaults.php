<?php

/////////////////////////////////////// Post Views Counter plugin defaults ///////////////////////////////////////	

if ( class_exists( 'Post_Views_Counter_Settings' ) && get_option( 'ghostpool_pvc_defaults' ) !== '1' ) {
	function ghostpool_pvc_defaults() {	
		update_option( 'post_views_counter_settings_general', array( 'post_types_count' => array( 'page', 'post' ) ) );
		update_option( 'post_views_counter_settings_display', array( 'position' => 'manual' ) );
	}	
	add_action( 'init', 'ghostpool_pvc_defaults', 1 );	
	update_option( 'ghostpool_pvc_defaults', '1' );		
}


/////////////////////////////////////// Visual Sidebars Editor defaults ///////////////////////////////////////	

if ( ! function_exists( 'ghostpool_default_vc_widget_container' ) ) {
	function ghostpool_default_vc_widget_container( $gp_container, $gp_current_sidebar ) {
		$gp_container = 'none';
		return $gp_container;
	}
}
add_filter( 'vcse_default_container', 'ghostpool_default_vc_widget_container', 10, 2 );

if ( ! function_exists( 'ghostpool_default_vc_widget_behavior' ) ) {
	function ghostpool_default_vc_widget_behavior( $gp_behavior, $gp_current_sidebar ) {
		$gp_behavior = 'before';
		return $gp_behavior;
	}
}
add_filter( 'vcse_default_behavior', 'ghostpool_default_vc_widget_behavior', 10, 2 );

?>