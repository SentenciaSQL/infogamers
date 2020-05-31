<?php
/*
Plugin Name: Gauge Plugin
Plugin URI: 
Description: A required plugin for the Gauge theme you purchased from ThemeForest. It includes a number of features that you can still use if you switch to another theme.
Version: 3.14
Author: GhostPool
Author URI: http://themeforest.net/user/GhostPool/portfolio?ref=GhostPool
License: You should have purchased a license from ThemeForest.net
Text Domain: gauge-plugin
*/

// Ensure latest version of plugin installed
function ghostpool_gauge_plugin_update() {}
	
if ( ! class_exists( 'GhostPool_Gauge' ) ) {

	class GhostPool_Gauge {

		public function __construct() {

			// Load plugin translations
			add_action( 'plugins_loaded', array( &$this, 'ghostpool_plugin_load_textdomain' ) );		
						
			// Add shortcode support to Text widget
			add_filter( 'widget_text', 'do_shortcode' );

			// Add excerpt support to pages
			if ( ! function_exists( 'ghostpool_add_excerpts_to_pages' ) ) {
				function ghostpool_add_excerpts_to_pages() {
					 add_post_type_support( 'page', 'excerpt' );
				}
			}
			add_action( 'init', 'ghostpool_add_excerpts_to_pages' );

			// Add post tags support to pages
			if ( ! function_exists( 'ghostpool_page_tags_support' ) ) {
				function ghostpool_page_tags_support() {
					register_taxonomy_for_object_type( 'post_tag', 'page' );
				}
			}
			add_action( 'init', 'ghostpool_page_tags_support' );

			// Display pages tag queries
			if ( ! function_exists( 'ghostpool_page_support_query' ) ) {
				function ghostpool_page_support_query( $query ) {
					if ( is_tag() && ! is_admin() && $query->is_main_query() ) { 
						$query->set( 'post_type', 'any' );	
					}	
				}
			}
			add_action( 'pre_get_posts', 'ghostpool_page_support_query' );

			if ( ! function_exists( 'ghostpool_custom_profile_methods' ) ) {
				function ghostpool_custom_profile_methods( $gp_profile_fields ) {
					$gp_profile_fields['twitter'] = esc_html__( 'Twitter URL', 'gauge-plugin' );
					$gp_profile_fields['facebook'] = esc_html__( 'Facebook URL', 'gauge-plugin' );
					$gp_profile_fields['googleplus'] = esc_html__( 'Google+ URL', 'gauge-plugin' );
					$gp_profile_fields['pinterest'] = esc_html__( 'Pinterest URL', 'gauge-plugin' );
					$gp_profile_fields['youtube'] = esc_html__( 'YouTube URL', 'gauge-plugin' );
					$gp_profile_fields['vimeo'] = esc_html__( 'Vimeo URL', 'gauge-plugin' );
					$gp_profile_fields['flickr'] = esc_html__( 'Flickr URL', 'gauge-plugin' );
					$gp_profile_fields['linkedin'] = esc_html__( 'LinkedIn URL', 'gauge-plugin' );
					$gp_profile_fields['instagram'] = esc_html__( 'Instagram URL', 'gauge-plugin' );
					return $gp_profile_fields;
				}
			}
			add_filter( 'user_contactmethods', 'ghostpool_custom_profile_methods' );

			// Load shortcodes
			if ( ! class_exists( 'GhostPool_Shortcodes' ) ) {
				require_once( dirname( __FILE__ ) . '/shortcodes/theme-shortcodes.php' );
				$GhostPool_Shortcodes = new GhostPool_Shortcodes();
			}
			
			// Load slide post type
			if ( ! post_type_exists( 'gp_slide' ) && ! class_exists( 'GhostPool_Slides' ) ) {
				require_once( dirname( __FILE__ ) . '/inc/slide-tax.php' );
				$GhostPool_Slides = new Ghostpool_Slides();
			}

			// Load portfolio post type
			if ( ! post_type_exists( 'gp_portfolio' ) && ! class_exists( 'GhostPool_Portfolios' ) ) {
				require_once( dirname( __FILE__ ) . '/inc/portfolio-tax.php' );
				$GhostPool_Portfolios = new GhostPool_Portfolios();
			}

			// Load user review post type
			if ( ! post_type_exists( 'gp_user_review' ) && ! class_exists( 'GhostPool_User_Reviews' ) ) {
				require_once( dirname( __FILE__ ) . '/inc/user-review-tax.php' );
				$GhostPool_User_Reviews = new GhostPool_User_Reviews();
			}
			
			// Load hubs post type
			if ( ! class_exists( 'GhostPool_Hubs' ) ) {
				require_once( dirname( __FILE__ ) . '/inc/hub-tax.php' );
				$GhostPool_Hubs = new GhostPool_Hubs();
			}

			// Load videos post type
			if ( ! class_exists( 'GhostPool_Videos' ) ) {
				require_once( dirname( __FILE__ ) . '/inc/video-tax.php' );
				$GhostPool_Videos = new GhostPool_Videos();
			}
																		
		} 
		
		public static function ghostpool_activate() {} 		
		
		public static function ghostpool_deactivate() {}
		
		public function ghostpool_plugin_load_textdomain() {
			load_plugin_textdomain( 'gauge-plugin', false, trailingslashit( WP_LANG_DIR ) . 'plugins/' );
			load_plugin_textdomain( 'gauge-plugin', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}
						
	}
	
}

// WP mail function
if ( ! function_exists( 'ghostpool_wp_mail' ) ) {
	function ghostpool_wp_mail( $to = '', $subject = '', $message = '', $headers = '' ) {
		return wp_mail( $to, $subject, $message, $headers );				
	}
}

// User registration emails
$gp_theme_variable = get_option( 'gp' );
if ( ! function_exists( 'wp_new_user_notification' ) && ! function_exists( 'bp_is_active' ) && ( isset ( $gp_theme_variable['popup_box'] ) && $gp_theme_variable['popup_box'] == 'enabled' ) ) {
	function wp_new_user_notification( $gp_user_id, $gp_deprecated = null, $gp_notify = 'both' ) {

		if ( $gp_deprecated !== null ) {
			_deprecated_argument( __FUNCTION__, '4.3.1' );
		}
	
		global $wpdb;
		$gp_user = get_userdata( $gp_user_id );
		
		$gp_user_login = stripslashes( $gp_user->user_login );
		$gp_user_email = stripslashes( $gp_user->user_email );

		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		$gp_blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		
		// Admin email
		$gp_message  = sprintf( esc_html__( 'New user registration on your blog %s:', 'gauge-plugin' ), $gp_blogname ) . "\r\n\r\n";
		$gp_message .= sprintf( esc_html__( 'Username: %s', 'gauge-plugin' ), $gp_user_login ) . "\r\n\r\n";
		$gp_message .= sprintf( esc_html__( 'Email: %s', 'gauge-plugin' ), $gp_user_email ) . "\r\n";
		$gp_message = apply_filters( 'gp_registration_notice_message', $gp_message, $gp_blogname, $gp_user_login, $gp_user_email );
		@wp_mail( get_option( 'admin_email' ), sprintf( apply_filters( 'gp_registration_notice_subject', esc_html__( '[%s] New User Registration', 'gauge-plugin' ), $gp_blogname ), $gp_blogname ), $gp_message );

		if ( 'admin' === $gp_notify || empty( $gp_notify ) ) {
			return;
		}
		
		// User email
		$gp_message  = esc_html__( 'Hi there,', 'gauge-plugin' ) . "\r\n\r\n";
		$gp_message .= sprintf( esc_html__( 'Welcome to %s.', 'gauge-plugin' ), $gp_blogname ) . "\r\n\r\n";
		$gp_message .= sprintf( esc_html__( 'Username: %s', 'gauge-plugin' ), $gp_user_login ) . "\r\n";
		$gp_message .= esc_html__( 'Password: [use the password you entered when signing up]', 'gauge-plugin' ) . "\r\n\r\n";
		$gp_message .= esc_html__( 'Please login at', 'gauge' ) . ' ' . home_url( '/#login' ) . "\r\n\r\n";	
		$gp_message = apply_filters( 'gp_registered_user_message', $gp_message, $gp_blogname, $gp_user_login, $gp_user_email );
		wp_mail( $gp_user_email, sprintf( apply_filters( 'gp_registered_user_subject', esc_html__( '[%s] Your username and password', 'gauge-plugin' ), $gp_blogname ), $gp_blogname ), $gp_message );

	}
}

// Active/deactivate plugin
if ( class_exists( 'GhostPool_Gauge' ) ) {

	register_activation_hook( __FILE__, array( 'GhostPool_Gauge', 'ghostpool_activate' ) );
	register_deactivation_hook( __FILE__, array( 'GhostPool_Gauge', 'ghostpool_deactivate' ) );

	$ghostpool_plugin = new GhostPool_Gauge();

}

?>