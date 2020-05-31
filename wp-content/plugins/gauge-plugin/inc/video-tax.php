<?php

if ( ! class_exists( 'GhostPool_Videos' ) ) {

	class GhostPool_Videos {

		public function __construct() {
			add_action( 'init', array( &$this, 'ghostpool_post_type_video' ), 1 );
		}
			
		public function ghostpool_post_type_video() {
			
			if ( ! function_exists( 'ghostpool_option' ) ) {
				$gp_video_cat_slug = 'videos';
			} else {
				$gp_video_cat_slug = ghostpool_option( 'video_cat_slug' );
			}
			
			/*--------------------------------------------------------------
			Videos Categories Taxonomy
			--------------------------------------------------------------*/
			
			register_taxonomy( 'gp_videos', 'post', array( 
				'labels' => array( 
					'name' => esc_html__( 'Video Categories', 'gauge-plugin' ),
					'singular_name' => esc_html__( 'Video Category', 'gauge-plugin' ),
					'all_items' => esc_html__( 'All Video Categories', 'gauge-plugin' ),
					'add_new' => _x( 'Add New', 'video', 'gauge-plugin' ),
					'add_new_item' => esc_html__( 'Add New Video Category', 'gauge-plugin' ),
					'edit_item' => esc_html__( 'Edit Video Category', 'gauge-plugin' ),
					'new_item' => esc_html__( 'New Video Category', 'gauge-plugin' ),
					'view_item' => esc_html__( 'View Video Category', 'gauge-plugin' ),
					'search_items' => esc_html__( 'Search Video Categories', 'gauge-plugin' ),
					'menu_name' => esc_html__( 'Video Categories', 'gauge-plugin' )
				 ),				
				'show_in_rest' => true,
				'show_in_nav_menus' => true,
				'hierarchical' => true,
				'show_admin_column' => true,
				'rewrite' => array( 'slug' => sanitize_title( $gp_video_cat_slug ) )
			 ) );

			register_taxonomy_for_object_type( 'gp_videos', 'post' );

		}
		
	}

}

?>