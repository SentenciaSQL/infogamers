<?php 

if ( ! class_exists( 'GhostPool_User_Reviews' ) ) {

	class GhostPool_User_Reviews {

		public function __construct() {
			add_action( 'init', array( &$this, 'ghostpool_post_type_user_review' ), 1 );
			add_action( 'manage_posts_custom_column', array( &$this, 'ghostpool_user_review_custom_columns' ) );
			add_action( 'admin_menu', array( &$this, 'ghostpool_pending_user_reviews' ), 999 );
		}

		public function ghostpool_post_type_user_review() {

			/*--------------------------------------------------------------
			User Review Post Type
			--------------------------------------------------------------*/	
	
			register_post_type( 'gp_user_review', array( 
				'labels' => array( 
					'name' => esc_html__( 'User Reviews', 'gauge-plugin' ),
					'singular_name' => esc_html__( 'User Review', 'gauge-plugin' ),
					'menu_name' => esc_html__( 'User Reviews', 'gauge-plugin' ),
					'all_items' => esc_html__( 'All User Reviews', 'gauge-plugin' ),
					'add_new' => _x( 'Add New', 'portfolio', 'gauge-plugin' ),
					'add_new_item' => esc_html__( 'Add New User Review', 'gauge-plugin' ),
					'edit_item' => esc_html__( 'Edit User Review', 'gauge-plugin' ),
					'new_item' => esc_html__( 'New User Review', 'gauge-plugin' ),
					'view_item' => esc_html__( 'View User Review', 'gauge-plugin' ),
					'search_items' => esc_html__( 'Search User Reviews', 'gauge-plugin' ),
					'not_found' => esc_html__( 'No user reviews found', 'gauge-plugin' ),
					'not_found_in_trash' => esc_html__( 'No user reviews found in Trash', 'gauge-plugin' ),
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
				'rewrite' => array( 'slug' => 'user-review' ),
				'menu_position' => 20,
				'with_front' => true,
				'has_archive' => 'gp_hubs',
				'supports' => array( 'title', 'thumbnail', 'editor', 'author', 'comments', 'custom-fields' )
			 ) );

			/*--------------------------------------------------------------
			User Review Admin Columns
			--------------------------------------------------------------*/

			function ghostpool_user_review_edit_columns( $gp_columns ) {
				$gp_columns = array( 
					'cb'        => '<input type="checkbox" />',
					'title'     => esc_html__( 'Title', 'gauge-plugin' ),
					'hub_page'  => esc_html__( 'Hub Page', 'gauge-plugin' ),	
					'comments'  => '<span class="vers"><span title="Comments" class="comment-grey-bubble"></span></span>',
					'author'	=> esc_html__( 'Author', 'gauge-plugin' ),				
					'date'		=> esc_html__( 'Date', 'gauge-plugin' )
				 );
				return $gp_columns;
			}	
			add_filter( 'manage_edit-gp_user_review_columns', 'ghostpool_user_review_edit_columns' );
				
		}
		
		public function ghostpool_user_review_custom_columns( $gp_column ) {
			global $post;
			switch ( $gp_column ) {
				case 'hub_page':
					echo get_the_title( get_post_meta( $post->ID, '_hub_page_id', true ) );
				break;				
			}
		}			
		
		/*--------------------------------------------------------------
		User Review Pending Counter
		--------------------------------------------------------------*/

		public function ghostpool_pending_user_reviews() {
			
			global $menu;
	
			// Recursive array search
			function ghostpool_recursive_array_search( $gp_needle, $gp_haystack ) {
				foreach( $gp_haystack as $gp_key => $gp_value ) {
					$gp_current_key = $gp_key;
					if ( $gp_needle === $gp_value OR ( is_array( $gp_value ) && ghostpool_recursive_array_search( $gp_needle, $gp_value ) !== false ) ) {
						return $gp_current_key;
					}
				}
				return false;
			}

			$gp_pt = 'gp_user_review';

			// Count posts
			$gp_cpt_count = wp_count_posts( $gp_pt );

			if ( $gp_cpt_count->pending ) {

				// Menu link suffix, Post is different from the rest
				$gp_suffix = ( 'post' == $gp_pt ) ? '' : "?post_type=$gp_pt";

				// Locate the key of 
				$gp_key = ghostpool_recursive_array_search( "edit.php$gp_suffix", $menu );

				// Not found, just in case 
				if ( ! $gp_key )
					return;

				// Modify menu item
				$menu[$gp_key][0] .= sprintf(
					' <span class="awaiting-mod count-%1$s" ><span class="pending-count">%1$s</span></span>',
					$gp_cpt_count->pending 
				);
			}
			
		}
							
	}

}

?>