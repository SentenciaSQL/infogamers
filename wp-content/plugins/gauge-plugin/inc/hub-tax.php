<?php

if ( ! class_exists( 'GhostPool_Hubs' ) ) {

	class GhostPool_Hubs {

		public function __construct() {
			add_action( 'init', array( &$this, 'ghostpool_post_type_hub' ), 1 );
		}
			
		public function ghostpool_post_type_hub() {
		
			if ( ! function_exists( 'ghostpool_option' ) ) {
				$gp_hub_cat_slug = 'hubs';
			} else {
				$gp_hub_cat_slug = ghostpool_option( 'hub_cat_slug' );
			}
			
			/*--------------------------------------------------------------
			Hub Categories Taxonomy
			--------------------------------------------------------------*/
			
			register_taxonomy( 'gp_hubs', 'page', array( 
				'labels' => array( 
					'name' => esc_html__( 'Hub Categories', 'gauge-plugin' ),
					'singular_name' => esc_html__( 'Hub Category', 'gauge-plugin' ),
					'all_items' => esc_html__( 'All Hub Categories', 'gauge-plugin' ),
					'add_new' => _x( 'Add New', 'hub', 'gauge-plugin' ),
					'add_new_item' => esc_html__( 'Add New Hub Category', 'gauge-plugin' ),
					'edit_item' => esc_html__( 'Edit Hub Category', 'gauge-plugin' ),
					'new_item' => esc_html__( 'New Hub Category', 'gauge-plugin' ),
					'view_item' => esc_html__( 'View Hub Category', 'gauge-plugin' ),
					'search_items' => esc_html__( 'Search Hub Categories', 'gauge-plugin' ),
					'menu_name' => esc_html__( 'Hub Categories', 'gauge-plugin' )
				 ),
				'show_in_rest' => true,
				'show_in_nav_menus' => true,
				'hierarchical' => true,
				'show_admin_column' => true,
				'rewrite' => array( 'slug' => sanitize_title( $gp_hub_cat_slug ) )
			 ) );

			register_taxonomy_for_object_type( 'gp_hubs', 'page' );
			register_taxonomy_for_object_type( 'gp_hubs', 'gp_user_review' );


			/*--------------------------------------------------------------
			Hub Field Taxonomies
			--------------------------------------------------------------*/
			
			if ( function_exists( 'ghostpool_option' ) && ghostpool_option( 'hub_fields' ) ) {
			
				$char_table = array();

				// Support for foreign characters
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
					
					register_taxonomy( $gp_hub_field_slug, 'page', array(
						'labels' => array(
							'name' => $gp_hub_field,
							'singular_name' => $gp_hub_field,
							'all_items' => esc_html__( 'All ', 'gauge-plugin' ) . $gp_hub_field,
							'add_new' => _x( 'Add New', 'hub', 'gauge-plugin' ),
							'add_new' => _x( 'Add New', 'hub', 'gauge-plugin' ),
							'add_new_item' => esc_html__( 'Add New ', 'gauge-plugin' ) . $gp_hub_field,
							'edit_item' => esc_html__( 'Edit ', 'gauge-plugin' ) . $gp_hub_field,
							'new_item' => esc_html__( 'New ', 'gauge-plugin' ) . $gp_hub_field,
							'view_item' => esc_html__( 'View ', 'gauge-plugin' ) . $gp_hub_field,
							'search_items' => esc_html__( 'Search ', 'gauge-plugin' ) . $gp_hub_field,
							'menu_name' => $gp_hub_field,
						),
						'show_in_rest' => true,
					) );
					
					register_taxonomy_for_object_type( $gp_hub_field_slug, 'page' );

				}
				
			}

		}

	}

}

?>