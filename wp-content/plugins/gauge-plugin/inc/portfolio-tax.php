<?php

if ( ! class_exists( 'GhostPool_Portfolios' ) ) {

	class GhostPool_Portfolios {

		public function __construct() {
			add_action( 'init', array( &$this, 'ghostpool_post_type_portfolio' ), 1 );		
			add_action( 'manage_posts_custom_column',  array( &$this, 'ghostpool_portfolio_custom_columns' ) );	
		}

		public function ghostpool_post_type_portfolio() {
			
			if ( ! function_exists( 'ghostpool_option' ) ) {
				$gp_portfolio_cat_slug = 'portfolios';
			} else {
				$gp_portfolio_cat_slug = ghostpool_option( 'portfolio_cat_slug' );
			}

			if ( ! function_exists( 'ghostpool_option' ) ) {
				$gp_portfolio_item_slug = 'portfolio';
			} else {
				$gp_portfolio_item_slug = ghostpool_option( 'portfolio_item_slug' );
			}
			
			/*--------------------------------------------------------------
			Portfolio Item Post Type
			--------------------------------------------------------------*/	
	
			register_post_type( 'gp_portfolio_item', array( 
				'labels' => array( 
					'name' => esc_html__( 'Portfolio Items', 'gauge-plugin' ),
					'singular_name' => esc_html__( 'Portfolio Item', 'gauge-plugin' ),
					'menu_name' => esc_html__( 'Portfolio Items', 'gauge-plugin' ),
					'all_items' => esc_html__( 'All Portfolio Items', 'gauge-plugin' ),
					'add_new' => _x( 'Add New', 'portfolio', 'gauge-plugin' ),
					'add_new_item' => esc_html__( 'Add New Portfolio Item', 'gauge-plugin' ),
					'edit_item' => esc_html__( 'Edit Portfolio Item', 'gauge-plugin' ),
					'new_item' => esc_html__( 'New Portfolio Item', 'gauge-plugin' ),
					'view_item' => esc_html__( 'View Portfolio Item', 'gauge-plugin' ),
					'search_items' => esc_html__( 'Search Portfolio Items', 'gauge-plugin' ),
					'not_found' => esc_html__( 'No portfolio items found', 'gauge-plugin' ),
					'not_found_in_trash' => esc_html__( 'No portfolio items found in Trash', 'gauge-plugin' ),
				 ),
				'show_in_rest' => true,
				'public' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'_builtin' => false,
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array( 'slug' => sanitize_title( $gp_portfolio_item_slug ) ),
				'menu_position' => 20,
				'with_front' => true,
				'taxonomies' => array( 'post_tag' ),
				'has_archive' => sanitize_title( $gp_portfolio_cat_slug ),
				'supports' => array( 'title', 'thumbnail', 'editor', 'author', 'comments', 'custom-fields' )
			 ) );
	
	
			/*--------------------------------------------------------------
			Portfolio Categories Taxonomy
			--------------------------------------------------------------*/
			
			register_taxonomy( 'gp_portfolios', 'gp_portfolio_item', array( 
				'labels' => array( 
					'name' => esc_html__( 'Portfolio Categories', 'gauge-plugin' ),
					'singular_name' => esc_html__( 'Portfolio Category', 'gauge-plugin' ),
					'all_items' => esc_html__( 'All Portfolio Categories', 'gauge-plugin' ),
					'add_new' => _x( 'Add New', 'portfolio', 'gauge-plugin' ),
					'add_new_item' => esc_html__( 'Add New Portfolio Category', 'gauge-plugin' ),
					'edit_item' => esc_html__( 'Edit Portfolio Category', 'gauge-plugin' ),
					'new_item' => esc_html__( 'New Portfolio Category', 'gauge-plugin' ),
					'view_item' => esc_html__( 'View Portfolio Category', 'gauge-plugin' ),
					'search_items' => esc_html__( 'Search Portfolio Categories', 'gauge-plugin' ),
					'menu_name' => esc_html__( 'Portfolio Categories', 'gauge-plugin' )
				 ),
				'show_in_rest' => true,
				'show_in_nav_menus' => true,
				'hierarchical' => true,
				'rewrite' => array( 'slug' => sanitize_title( $gp_portfolio_cat_slug ) )
			 ) );


			register_taxonomy_for_object_type( 'gp_portfolios', 'gp_portfolio_item' );


			/*--------------------------------------------------------------
			Portfolio Item Admin Columns
			--------------------------------------------------------------*/

			function ghostpool_portfolio_item_edit_columns( $gp_columns ) {
				$gp_columns = array( 
				'cb'                   => '<input type="checkbox" />',
				'title'                => esc_html__( 'Title', 'gauge-plugin' ),	
				'portfolio_categories' => esc_html__( 'Categories', 'gauge-plugin' ),
				'portfolio_image'      => esc_html__( 'Image', 'gauge-plugin' ),				
				'date'                 => esc_html__( 'Date', 'gauge-plugin' )
				 );
				return $gp_columns;
			}	
			add_filter( 'manage_edit-gp_portfolio_item_columns', 'ghostpool_portfolio_item_edit_columns' );
		
		}

		public function ghostpool_portfolio_custom_columns( $gp_column ) {
			switch ( $gp_column ) {
				case 'portfolio_categories':
					echo get_the_term_list( get_the_ID(), 'gp_portfolios', '', ', ', '' );
				break;
				case 'portfolio_image':
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( array( 50, 50 ) );
					}
				break;					
			}
		}

	}

}

?>