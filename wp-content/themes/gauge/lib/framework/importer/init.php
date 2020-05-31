<?php
/**
 * Version 0.0.3
 *
 * This file is just an example you can copy it to your theme and modify it to fit your own needs.
 * Watch the paths though.
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'GhostPool_Importer' ) && class_exists( 'GhostPool_Gauge' ) ) {

	if ( file_exists( WP_PLUGIN_DIR . '/gauge-plugin/importer/radium-importer.php' ) ) {			
		require_once( WP_PLUGIN_DIR . '/gauge-plugin/importer/radium-importer.php' );
	}
	
	class GhostPool_Importer extends Radium_Theme_Importer {

		private static $instance;
		public $theme_options_framework = 'redux';
		public $theme_option_name       = 'gp';
		public $theme_options_file_name = 'theme_options.txt';
		public $widgets_file_name       = 'widgets.json';
		public $content_demo_file_name  = 'content.xml';
		public $widget_import_results;

		public function __construct() {
			$this->demo_files_path = get_template_directory() . '/lib/framework/importer/demo-files/';
			self::$instance = $this;
			parent::__construct();
		}

		public static function getInstance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
	
		public function set_demo_menus() {
			$locations = get_theme_mod( 'nav_menu_locations' );
			$menus = wp_get_nav_menus();
			if ( $menus ) {
				foreach( $menus as $menu ) { // assign menus to theme locations
					if ( $menu->name == 'Gauge Primary Menu' ) {
						$locations['header-nav'] = $menu->term_id;	
					} elseif ( $menu->name == 'Gauge Secondary Menu' ) {
						$locations['top-nav'] = $menu->term_id;
					} elseif ( $menu->name == 'Gauge Settings Menu' ) {
						$locations['right-top-nav'] = $menu->term_id;
					} elseif ( $menu->name == 'Gauge Secondary Menu' ) {
						$locations['footer-nav'] = $menu->term_id;
					}
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );	
		}

		public function ghostpool_custom_sidebars() {	
			if ( get_option( 'ghostpool_custom_sidebars_imported' ) !== '1' ) {
				$sidebars = array();
				$sidebars = get_option( 'cs_sidebars', FALSE );
				if ( $sidebars !== FALSE ) {
					$sidebars = $sidebars;
					$sidebars[] = array(
						'name' => '',
						'id' => '',
						'description' => '',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="element-title"><h3 class="widgettitle">',
						'after_title'   => '</h3></div>',
					);			
					update_option( 'cs_sidebars', $sidebars );
				}
				update_option( 'ghostpool_custom_sidebars_imported', '1' );
			}
			
			if ( ! empty( $sidebars ) ) {
				foreach( $sidebars as $sidebar ) {
					register_sidebar( $sidebar );
				}
			}
			
		}

		public function after_wp_importer() {
		
			if ( get_page_by_path( 'homepages/home' ) ) {				
				update_option( 'page_on_front', get_page_by_path( 'homepages/home' )->ID );
			}	
			update_option( 'show_on_front', 'page' );			

			// Delete "Hello World" post
			$default_post = get_posts( array( 'title' => 'Hello World!' ) );
			if ( $default_post ) {				
				wp_delete_post( $default_post[0]->ID );
			}
		
		}					
		
	}

	GhostPool_Importer::getInstance();

}