<?php

/*--------------------------------------------------------------
Updating to version 6.29.1
--------------------------------------------------------------*/

if ( get_option( 'gauge_db_version' ) < '1' ) {

	if ( ! function_exists( 'ghostpool_gauge_v6291_update_database' ) ) {
	
		function ghostpool_gauge_v6291_update_database() {
			
			global $wpdb;
			
			// Change sidebar option names
			 if ( get_option( 'cs_sidebars' ) ) { 
				add_option( 'ghostpool_sidebars', get_option( 'cs_sidebars' ) );
				delete_option( 'cs_sidebars' );
			}
			if ( get_option( 'cs_modifiable' ) ) { 
				add_option( 'ghostpool_modifiable', get_option( 'cs_modifiable' ) );
				delete_option( 'cs_modifiable' );
			}	
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = %s WHERE meta_key = %s", '_ghostpool_replacements', '_cs_replacements' ) );
																							
		}
		
	}
	add_action( 'init', 'ghostpool_gauge_v6291_update_database' );
	update_option( 'gauge_db_version', '1' );

}


/*--------------------------------------------------------------
Updating to version 6.17
--------------------------------------------------------------*/

/*if ( get_option( 'ghostpool_v617_updated' ) !== '1' ) {

	if ( ! function_exists( 'ghostpool_v617_update_database' ) ) {
	
		function ghostpool_v617_update_database() {

			global $wpdb;
			
			// Change all custom fields called "hub_review_award" to "hub_award"
			$wpdb->query( $wpdb->prepare( 
				"
					UPDATE $wpdb->postmeta SET meta_key = %s WHERE meta_key = %s
				",
				'hub_award',
				'hub_review_award'
			) );
										
		}
		
	}
	add_action( 'init', 'ghostpool_v617_update_database' );
	update_option( 'ghostpool_v617_updated', '1' );
}*/


/*--------------------------------------------------------------
Updating to version 6.0
--------------------------------------------------------------*/

if ( get_option( 'ghostpool_v6_updated' ) !== '1' ) {

	if ( ! function_exists( 'ghostpool_v6_update_database' ) ) {
	
		function ghostpool_v6_update_database() {

			global $wpdb;
			
			// Round up all _gp_user_rating field to 1 decimal place
			$wpdb->query( $wpdb->prepare( 
				"
					UPDATE $wpdb->postmeta SET meta_value = CEILING( meta_value * 10 ) / 10  WHERE meta_key = %s
				",
				'_gp_user_rating'
			) );
										
		}
		
	}
	add_action( 'init', 'ghostpool_v6_update_database' );
	update_option( 'ghostpool_v6_updated', '1' );
}


/*--------------------------------------------------------------
Updating to version 5
--------------------------------------------------------------*/

if ( get_option( 'ghostpool_v5_updated' ) !== '1' ) {

	if ( ! function_exists( 'ghostpool_v5_update_database' ) ) {
	
		function ghostpool_v5_update_database() {

			global $wpdb;
			
			// Hub page Visual Composer spacing 
			$wpdb->query( $wpdb->prepare( 
				"
					UPDATE $wpdb->posts SET post_content = REPLACE ( post_content, %s, %s ) WHERE post_type = 'page'
				",
				'[/vc_column][vc_column width="5/12"]',
				'[vc_empty_space height="40px"][/vc_column][vc_column width="5/12"]'
			) );	
			$wpdb->query( $wpdb->prepare( 
				"
					UPDATE $wpdb->posts SET post_content = REPLACE ( post_content, %s, %s ) WHERE post_type = 'page'
				",
				'[/vc_column_inner][/vc_row_inner][vc_row_inner',
				'[/vc_column_inner][/vc_row_inner][vc_empty_space height="40px"][vc_row_inner'
			) );
					
		}
		
	}	
	add_action( 'init', 'ghostpool_v5_update_database' );
	update_option( 'ghostpool_v5_updated', '1' );
}

?>