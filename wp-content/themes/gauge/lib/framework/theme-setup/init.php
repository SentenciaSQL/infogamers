<?php

class GhostPool_Setup {

	/**
	 * @var GhostPool_Setup The reference to *GhostPool_Setup* instance of this class
	 */
	protected static $_instance = null;

	public $slug = 'gauge-setup';

	public function __construct() {
		$this->set_hooks();
		$this->load_dependencies();
	}

	/**
	 * Returns the GhostPool_Setup instance of this class.
	 *
	 * @return GhostPool_Setup - Main instance
	 */
	public static function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function load_dependencies() {
		require_once( get_template_directory() . '/lib/framework/theme-setup/theme-addons.php' );
		require_once( get_template_directory() . '/lib/framework/importer/init.php' );
	}

	public function set_hooks() {

		add_action( 'admin_menu', array( $this, 'register_setup_page' ) );
		add_action( 'admin_init', array( $this, 'redirect_to_setup' ), 0 );

		if ( isset( $_GET['page'] ) && $_GET['page'] == $this->slug OR ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'ghostpool_do_plugin_action' ) ) {
			add_action( 'admin_init', array( $this, 'config_addons' ), 12 );
		}
		
		add_action( 'admin_enqueue_scripts', array( $this, 'setup_scripts' ) );
		
	}

	/**
	 * Register CSS & JS Files
	 */
	function setup_scripts() {
		$wp_scripts = wp_scripts();
		wp_enqueue_style( 'jquery-ui-theme-smoothness', sprintf( '//ajax.googleapis.com/ajax/libs/jqueryui/%s/themes/smoothness/jquery-ui.css', $wp_scripts->registered['jquery-ui-core']->ver ) );
		wp_enqueue_style( 'theme-setup', get_template_directory_uri() . '/lib/framework/css/theme-setup.css', array() );
		wp_enqueue_script( 'jquery-ui-tooltip' );
		wp_enqueue_script( 'theme-setup', get_template_directory_uri() . '/lib/framework/scripts/theme-setup.js', array( 'jquery' ) );
	}

	public function register_setup_page() {
		add_theme_page(
			esc_html__( 'Gauge Setup', 'gauge' ),
			esc_html__( 'Gauge Setup', 'gauge' ),
			'manage_options',
			$this->slug,
			array( $this, 'setup_page' )
		);
	}

	function setup_page() {
		require( get_template_directory() . '/lib/framework/theme-setup/welcome.php' );
	}

	public function redirect_to_setup() {
		// Theme activation redirect
		global $pagenow;
		if ( isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
			wp_redirect( admin_url( 'themes.php?page=gauge-setup' ) );
			exit;
		}
	}
	
	public function config_addons() {

		GhostPool_Addons_Manager()->plugins = array( 'woocommerce' => GhostPool_Addons_Manager()->plugins['woocommerce'] ) + GhostPool_Addons_Manager()->plugins;
		GhostPool_Addons_Manager()->plugins = array( 'bbpress' => GhostPool_Addons_Manager()->plugins['bbpress'] ) + GhostPool_Addons_Manager()->plugins;
		GhostPool_Addons_Manager()->plugins = array( 'buddypress' => GhostPool_Addons_Manager()->plugins['buddypress'] ) + GhostPool_Addons_Manager()->plugins;
		GhostPool_Addons_Manager()->plugins = array( 'visual-sidebars-editor' => GhostPool_Addons_Manager()->plugins['visual-sidebars-editor'] ) + GhostPool_Addons_Manager()->plugins;
		GhostPool_Addons_Manager()->plugins = array( 'js_composer' => GhostPool_Addons_Manager()->plugins['js_composer'] ) + GhostPool_Addons_Manager()->plugins;
		GhostPool_Addons_Manager()->plugins = array( 'gauge-plugin' => GhostPool_Addons_Manager()->plugins['gauge-plugin'] ) + GhostPool_Addons_Manager()->plugins;

		$prepend = array(
			'gauge-child' => array(
				'addon_type'  => 'child_theme',
				'name'        => 'Gauge Child Theme',
				'slug'        => 'gauge-child',
				'source'      => get_template_directory() . '/lib/plugins/gauge-child.zip',
				'source_type' => 'bundled',
				'version'     => '1.0',
				'required'    => true,
				'description' => esc_html__( 'Always activate the child theme to safely update the parent theme.', 'gauge' ),
			)
		);

		GhostPool_Addons_Manager()->plugins = $prepend + GhostPool_Addons_Manager()->plugins;
	}

}

GhostPool_Setup::getInstance();