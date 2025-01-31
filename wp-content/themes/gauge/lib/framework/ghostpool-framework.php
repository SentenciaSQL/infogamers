<?php 

// Theme version number
define( 'GAUGE_THEME_VERSION', '6.41.1' );

// Load database updates
require_once( get_template_directory() . '/lib/framework/database-updates.php' );
		
// Load metaboxes
require_once( get_template_directory() . '/lib/framework/metaboxes-config.php' );

// Remove Redux ads
require_once( get_template_directory() . '/lib/framework/extensions/ad_remove/extension_ad_remove.php' );

// Load Redux theme options framework
require_once( get_template_directory() . '/lib/framework/redux/framework.php' );

// Load theme options
require_once( get_template_directory() . '/lib/framework/theme-config.php' );

// Load options function
if ( ! function_exists( 'ghostpool_option' ) ) {
	function ghostpool_option( $opt_1, $opt_2 = false, $opt_3 = false, $opt_4 = false ) {
		global $gp;
		if ( $opt_4 != false ) {
			return $opt_4;
		} else {		
			if ( $opt_2 ) {
				if ( isset( $gp[$opt_1][$opt_2] ) ) {
					return $gp[$opt_1][$opt_2];
				}
			} else {
				if ( isset( $gp[$opt_1] ) ) {
					return $gp[$opt_1];
				}
			}
		}	
	}
}

/**
 * Load Redux stylesheet
 *
 */
if ( ! function_exists( 'ghostpool_redux_enqueue' ) ) {
	function ghostpool_redux_enqueue() {

		wp_enqueue_style( 'custom-redux-theme-options', get_template_directory_uri() . '/lib/framework/css/redux-theme-options.css', array( 'redux-admin-css' ), time(), 'all' );
	
		wp_enqueue_style( 'custom-redux-metaboxes', get_template_directory_uri() . '/lib/framework/css/redux-metaboxes.css', array( 'redux-admin-css', 'redux-extension-metaboxes-css' ), time(), 'all' );

		// Deregister script so select2 is not loaded on WooCommerce product pages
		wp_deregister_script( 'redux-select2-sortable-js' );
		if ( get_post_type() != 'product' ) {
			wp_register_script( 'redux-select2-sortable-js', get_template_directory_uri() . '/lib/framework/redux/assets/js/vendor/redux.select2.sortable.min.js', array( 'jquery' ), '', true );
		}
		
	}
}
add_action( 'redux/page/gp/enqueue', 'ghostpool_redux_enqueue' );

/**
 * Add custom primary hub field
 *
 */
if ( ! function_exists( 'ghostpool_redux_data_primary_hub' ) ) {
	function ghostpool_redux_data_primary_hub() {
	
		$data = array();

		$associated_hub_ids = get_post_meta( get_the_ID(), 'post_association', true );		
	
		if ( ! empty( $associated_hub_ids ) ) { 

			$args = array(
				'post_type' => 'page',
				'post_status' => array( 'publish', 'future' ), 
				'include' => $associated_hub_ids,
				'posts_per_page' => -1, 
				'orderby' => 'date', 
				'order' => 'desc',
				'no_found_rows'  => true,
				'cache_results' => false,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			);
		
			$posts = get_posts( $args );
			if ( ! empty ( $posts ) ) {
				foreach ( $posts as $post ) {
					$data[ $post->ID ] = $post->post_title;
				}
			}
		
		}
				
		return $data;
		
	}
}	
add_filter( 'redux/options/gp/data/primary_hub', 'ghostpool_redux_data_primary_hub' );

/**
 * Add custom sidebar field
 *
 */
if ( ! function_exists( 'ghostpool_redux_data_sidebars' ) ) {
	function ghostpool_redux_data_sidebars() {		         
		global $wp_registered_sidebars;		
		$data = array();
		foreach ( $wp_registered_sidebars as $key => $value ) {
			$data[ $key ] = $value['name'];
		}
		return $data;
	}
}	
add_filter( 'redux/options/gp/data/custom_sidebars', 'ghostpool_redux_data_sidebars' );

/**
 * Add custom sidebar field with default option
 *
 */
if ( ! function_exists( 'ghostpool_redux_data_sidebars_default' ) ) {
	function ghostpool_redux_data_sidebars_default() {		         
		global $wp_registered_sidebars;
		$data = array();
		$data['default'] = esc_html__( 'Default', 'gauge' );		
		foreach ( $wp_registered_sidebars as $key => $value ) {
			$data[ $key ] = $value['name'];
		}
		return $data;
	}
}	
add_filter( 'redux/options/gp/data/custom_sidebars_default', 'ghostpool_redux_data_sidebars_default' );

/**
 * Change import option description text
 *.4
 */	 
function ghostpool_import_file_description() {
	return esc_html__( 'Copy and paste the code from the back up file and click Save Changes to restore your sites options from a backup.', 'gauge' );
}
add_filter( 'redux-import-file-description', 'ghostpool_import_file_description' );

/**
 * Change import option description text
 *.4
 */	 
function ghostpool_import_url_description() {
	return esc_html__( 'Input the export URL below and click Save Changes to to restore your sites options from a backup.', 'gauge' );
}
add_filter( 'redux-import-link-description', 'ghostpool_import_url_description' );
		
?>