<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "gp";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'gauge' ),
        'page_title'           => esc_html__( 'Theme Options', 'gauge' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyDipV4M7FL2ylBHtJ5OvW1CSBWTyKKrP6E',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => apply_filters( 'ghostpool_async_typography', false ),
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

	// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
	$args['admin_bar_links'][] = array(
		'id'    => 'gp-help',
		'href'   => 'http://ghostpool.com/help/gauge/help.html',
		'title' => esc_html__( 'Documentation', 'gauge' ),
	);

	$args['admin_bar_links'][] = array(
		'id'    => 'gp-changelog',
		'href'   => 'http://ghostpool.com/help/gauge/changelog.html',
		'title' => esc_html__( 'Changelog', 'gauge' ),
	);

	$args['admin_bar_links'][] = array(
		'id'    => 'gp-support',
		'href'   => 'http://ghostpool.ticksy.com',
		'title' => esc_html__( 'Support', 'gauge' ),
	);

	// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
	$args['share_icons'][] = array(
		'url'   => 'http://twitter.com/ghostpool',
		'title' => esc_html__( 'Follow us on Twitter', 'gauge' ),
		'icon'  => 'el el-icon-twitter'
	);

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

	 $tabs = array(
		array(
			'id'        => 'documentation-tab',
			'title'     => esc_html__( 'Documentation', 'gauge' ),
			'content'   => '<p>' . esc_html__( 'The documentation explains how to install, set up and use the main features of the theme. The docuementation comes with the full theme download or you can view the latest version online.', 'gauge' ) . '</p>' . '<p><a href="' . esc_url( 'http://ghostpool.com/help/gauge/help.html' ) . '" target="_blank">' . esc_html__( 'View Documentation', 'gauge' ) . '</a></p>',
		),
		array(
			'id'        => 'changelog-tab',
			'title'     => esc_html__( 'Changelog', 'gauge' ),
			'content'   => '<p>' . esc_html__( 'The changelog is a record of changes made to theme including bug fixes, new features and tweaks. The changelog comes with the full theme download or you can view the latest version online.', 'gauge' ) . '</p>' . '<p><a href="' . esc_url( 'http://ghostpool.com/help/gauge/changelog.html' ) . '" target="_blank">' . esc_html__( 'View Changelog', 'gauge' ) . '</a></p>',
		),
		array(
			'id'        => 'support-tab',
			'title'     => esc_html__( 'Support', 'gauge' ),
			'content'   => '<p>' . esc_html__( 'If you have any questions about how to use the theme or want to report a bug then we can help you out on our ticket support site. However support does not include any services that modify or extend the theme beyond the original features, style and functionality advertised on the item page. For a more detailed explanation of what support does and does not cover check out Envato\'s support definition and guidelines for buyers', 'gauge' ) . ' <a href="' . esc_url( 'http://themeforest.net/page/item_support_policy' ) . '" target="_blank">' . esc_html__( 'here', 'gauge' ) . '</a>.</p>' . '<p><a href="' . esc_url( 'http://ghostpool.ticksy.com', 'gauge' ) . '" target="_blank">' . esc_html__( 'Submit Support Ticket', 'gauge' ) . '</a></p>',
		),
		array(
			'id'        => 'developer-tab',
			'title'     => esc_html__( 'Premium Services (Customisations)', 'gauge' ),
			'content'   => '<p>' . esc_html__( 'Anything that modifies or extends the theme beyond the original features, style and functionality as advertised on the item page is classed as a customisation. Customisations are not covered by support but you can hire our developers OurWebMedia who will be able to give you a quote for this work.', 'gauge' ) . '</p>' . '<p><a href="' . esc_url( 'http://www.ourwebmedia.com/ghostpool.php?aff=002' ) . '" target="_blank">' . esc_html__( 'Get A Quote', 'gauge' ) . '</a></p>',
		)
	);
	Redux::setHelpTab( $opt_name, $tabs );
        
    // Set the help sidebar
    $content = sprintf( wp_kses( __( '<p>If you need any help using the theme then take a look at the tabs to the left.</p>', 'gauge' ), array( 'p' => array() ) ) );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

	Redux::setSection( $opt_name, array(
		'id' => 'general',
		'title' => esc_html__( 'General', 'gauge' ),
		'desc' => esc_html__( 'General theme options.', 'gauge' ),
		'icon' => 'el-icon-cogs',
		'fields' => array(
	
			array(  
				'id' => 'theme_layout',
				'title' => esc_html__( 'Theme Layout', 'gauge' ),
				'type' => 'image_select',
				'compiler'  => true,
				'desc' => esc_html__( 'The layout of the whole theme.', 'gauge' ),
				'options'   => array(
					'gp-wide-layout' => array('title' => 'Wide',       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
					'gp-boxed-layout' => array('title' => 'Boxed','img' => get_template_directory_uri() . '/lib/framework/images/boxed.png'),
				),
				'default' => 'gp-wide-layout',                        
			),
					
			array(  
				'id' => 'retina',
				'title' => esc_html__( 'Retina Images', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Crop images at double the size on retina displays (newer iPhones/iPads, Macbook Pro etc.).', 'gauge' ),
				'options' => array(
					'gp-retina' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-retina' => esc_html__( 'Disabled', 'gauge' )
				),
				'default' => 'gp-retina',
			),

			
			array(  
				'id' => 'smooth_scrolling',
				'title' => esc_html__( 'Smooth Scrolling', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Scroll down the page smoothly without incremental stops.', 'gauge' ),
				'options' => array(
					'gp-smooth-scrolling' => esc_html__( 'Enabled', 'gauge' ),
					'gp-normal-scrolling' => esc_html__( 'Disabled', 'gauge' )
				),
				'default' => 'gp-normal-scrolling',
			 ),
			
			array(  
				'id' => 'back_to_top',
				'title' => esc_html__( 'Back To Top Button', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'Add a button to the bottom right corner of the page that takes you back to the top of the page.', 'gauge' ),
				'options' => array(
					'gp-back-to-top-all' => esc_html__( 'Show on all devices', 'gauge' ),
					'gp-back-to-top-desktop' => esc_html__( 'Only show on desktop devices', 'gauge' ),
					'gp-no-back-to-top' => esc_html__( 'Disabled', 'gauge' )
				),
				'default' => 'gp-back-to-top-desktop',
			 ),
			 
			array(  
				'id' => 'ajax',
				'title' => esc_html__( 'Ajax', 'gauge' ),
				'desc' => esc_html__( 'Load and filter content dynamically using ajax.', 'gauge' ),
				'type' => 'button_set',
				'options'   => array(
					'ajax-loop' => 'Enabled', 
					'standard-loop' => 'Disabled', 
				), 
				'default'   => 'ajax-loop'						
			),

			array(
				'id'        => 'lightbox',
				'type'      => 'radio',
				'title'     => esc_html__( 'Lightbox', 'gauge' ),
				'subtitle' => esc_html__( 'Make sure the images open the media file and not the attachment page.', 'gauge' ),
				'desc' => esc_html__( 'Choose how images open in the lightbox (pop-up window).', 'gauge' ), 
				'options'   => array(
					'group_images' => esc_html__( 'All images on page show as gallery within lightbox window', 'gauge' ),
					'separate_images' => esc_html__( 'Images are not grouped', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'group_images',
			),
			
			array(  
				'id' => 'popup_box',
				'title' => esc_html__( 'Login/Register Popup Windows', 'gauge' ),
				'desc' => esc_html__( 'Choose whether to use the login/register popup windows or standard WordPress login.', 'gauge' ),
				'subtitle' => wp_kses( __( 'To create login, register, logout and profile links <a href="http://ghostpool.com/help/gauge/help.html#5223" target="_blank">click here</a>.', 'gauge' ), array( 'a' => array( 'href' => array() ) ) ),
				'type' => 'button_set',
				'options'   => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				), 
				'default'   => 'enabled'						
			),

			array(  
				'id' => 'registration_gdpr',
				'title' => esc_html__( 'Registration Privacy Policy Checkbox (GDPR)', 'gauge' ),
				'desc' => esc_html__( 'Add a privacy policy checkbox to the theme\'s registration form (this does not add a checkbox to the BuddyPress or other plugin registration pages).', 'gauge' ),
				'type' => 'button_set',
				'options'   => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				), 
				'default'   => 'disabled',
			),
			
			array(  
				'id' => 'registration_gdpr_text',
				'title' => esc_html__( 'Registration Privacy Policy Text', 'gauge' ),
				'desc' => esc_html__( 'Add your own privacy policy text next to the checkbox.', 'gauge' ),
				'subtitle' => esc_html__( 'To add a link within your text use HTML tags e.g. "This is my text and this is a <a href="http://domain.com/privacy-policy">link</a>."', 'gauge' ),
				'type' => 'textarea',
				'required' => array( 'registration_gdpr', '=', 'enabled' ),
			),
										
			array(  
				'id' => 'rss_button',
				'title' => esc_html__( 'RSS Feed Button', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a RSS feed button with the default RSS feed link or enter a custom feed link below.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			 ),

			array( 
				'id' => 'rss',
				'title' => esc_html__( 'RSS URL', 'gauge' ),
				'required' => array('rss_button', '=', 'enabled'),
				'type' => 'text',
				'validate' => 'url',
				'default' => '',
			 ),

			array( 
				'id' => 'twitter',
				'title' => esc_html__( 'Twitter URL', 'gauge' ),
				'type' => 'text',
				'validate' => 'url',
				'default' => '',
			 ),

			array( 
				'id' => 'facebook',
				'title' => esc_html__( 'Facebook URL', 'gauge' ),				
				'type' => 'text',
				'validate' => 'url',
				'default' => '',
			 ),

			array( 
				'id' => 'youtube',
				'title' => esc_html__( 'YouTube URL', 'gauge' ),
				'type' => 'text',
				'validate' => 'url',
				'default' => '',
			 ),

			array( 
				'id' => 'googleplus',
				'title' => esc_html__( 'Google+ URL', 'gauge' ),
				'type' => 'text',
				'validate' => 'url',
				'default' => '',
			 ),

			array( 
				'id' => 'linkedin',
				'title' => esc_html__( 'LinkedIn URL', 'gauge' ),
				'type' => 'text',
				'validate' => 'url',
				'default' => '',
			 ),
	
			array( 
				'id' => 'flickr',
				'title' => esc_html__( 'Flickr URL', 'gauge' ),
				'type' => 'text',
				'validate' => 'url',
				'default' => '',
			 ),

			array( 
				'id' => 'pinterest',
				'title' => esc_html__( 'Pinterest URL', 'gauge' ),
				'type' => 'text',
				'validate' => 'url',
				'default' => '',
			 ),
						
			array( 
				'id' => 'additional_social_icons',
				'title' => esc_html__( 'Additional Social Icons', 'gauge' ),
				'subtitle' => wp_kses( __( 'Add additional social icons by adding <strong>&lt;a href=&quot;http://social-link.com&quot; rel=&quot;nofollow&quot; target=&quot;_blank&quot;&gt;&lt;i class=&quot;fa fa-tumblr-square&quot;&gt;&lt;/i&gt;&lt;/a&gt;</strong>. Replace <strong>fa-tumblr-square</strong> with any of the icon names from <a href="https://fontawesome.com/v4.7.0/cheatsheet/" target="_blank">Font Awesome More</a>.', 'gauge' ), array( 'a' => array( 'href' => array(), 'target' => array() ), 'strong' => array() ) ),
				'type' => 'textarea',
				'default' => '',
			),
			
			array( 
				'id' => 'js_code',
				'type' => 'ace_editor',
				'title' => esc_html__( 'JavaScript Code', 'gauge' ),
				'subtitle' => esc_html__( 'Paste your JavaScript code here.', 'gauge' ),
				'desc' => esc_html__( 'Scripts that need to be embedded into the theme (e.g. Google Analytics).', 'gauge' ),
				'mode' => 'javascript',
				'theme' => 'chrome',
				'default' => '',				
			 ),
		
		),
	
	) );
	
				
	Redux::setSection( $opt_name, array(
		'id' => 'header',
		'title' => esc_html__( 'Header', 'gauge' ),
		'desc' => esc_html__( 'Options for the header.', 'gauge' ),
		'icon' => 'el-icon-website',
		'fields' => array(								 

			array( 
				'id' => 'header_layout',
				'title' => esc_html__( 'Layout', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The layout for the header.', 'gauge' ),
				'options' => array( 
					'gp-header-standard' => esc_html__( 'Standard Header', 'gauge' ),
					'gp-header-centered' => esc_html__( 'Centered Header', 'gauge' ),
				),
				'default' => 'gp-header-standard',
			),

			array(  
				'id' => 'header_overlay',
				'title' => esc_html__( 'Header Overlay', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The main header is placed over the top of the page content.', 'gauge' ),	
				'options' => array(
					'gp-header-overlay' => esc_html__( 'Enabled', 'gauge' ),
					'gp-header-no-overlay' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-header-overlay',
			),
								 
			array(  
				'id' => 'fixed_header',
				'title' => esc_html__( 'Fixed Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The header stays at the top of the screen as you scroll down the page.', 'gauge' ),
				'options' => array(
					'gp-fixed-header' => esc_html__( 'Enabled', 'gauge' ),
					'gp-relative-header' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-fixed-header',
			),

			array(  
				'id' => 'header_resize',
				'title' => esc_html__( 'Header Resize Upon Scrolling', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'fixed_header', '=', 'gp-fixed-header' ),
				'desc' => esc_html__( 'The header reduces in size as you scroll down the page.', 'gauge' ),
				'options' => array(
					'gp-header-resize' => esc_html__( 'Enabled', 'gauge' ),
					'gp-header-noresize' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-header-resize',
			),

			array( 
				'id' => 'header_size_reduction',                     
				'type' => 'slider',
				'title' => esc_html__( 'Header Size Reduction', 'gauge' ),
				'desc' => esc_html__( 'The amount to reduce the header by on smaller devices or when scrolling.', 'gauge' ),
				'default'       => 1.5,
				'min'           => 1,
				'step'          => .1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'text',
			),
	
			array( 
				'id' => 'logo',
				'title' => esc_html__( 'Logo', 'gauge' ),						
				'type' => 'media',
				'desc' => esc_html__( 'The image that is displayed in the header.', 'gauge' ),
				'default'  => array(
					'url' => get_template_directory_uri() . '/lib/images/logo.png',
				),
			 ),

			array(
				'id' => 'logo_dimensions',
				'type' => 'dimensions',
				'units' => 'px',
				'title' => esc_html__( 'Logo Dimensions', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the logo.', 'gauge' ),
				'subtitle' => esc_html__( 'Set to half the original logo dimensions for retina displays.', 'gauge' ),
				'default'           => array(
					'width'     => '140px',
					'height'    => '45px',
				)
			),
									
			array(
				'id' => 'logo_spacing',
				'type' => 'spacing',
				'output' => array( '#gp-logo' ),
				'mode' => 'margin',
				'units' => 'px',
				'title' => esc_html__( 'Logo Spacing', 'gauge' ),
				'desc' => esc_html__( 'The spacing around the logo.', 'gauge' ),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0',
				)
			),

			array(
				'id' => 'search',  
				'title' => esc_html__( 'Search Box', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a search box to the header.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' )
				),
				'default' => 'enabled',
			 ),
			
			array(  
				'id' => 'top_header',
				'title' => esc_html__( 'Top Header', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'Display a small header above the main header.', 'gauge' ),	
				'options' => array(
					'gp-top-header' => esc_html__( 'Show on all devices', 'gauge' ),
					'gp-top-header-desktop' => esc_html__( 'Only hide on mobile devices', 'gauge' ),
					'gp-top-header-mobile' => esc_html__( 'Only show on mobile devices', 'gauge' ),
					'gp-main-header' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-top-header',
			),

			array( 
				'id' => 'hide_move_primary_menu_links',
				'title' => esc_html__( 'Hide/Move Primary Navigation Menu Links', 'gauge' ),
				'desc' => esc_html__( 'If you have too many menu links in the primary navigation area, automatically hide and move them to a dropdown menu.', 'gauge' ),	
				'type' => 'button_set',
				'options' => array( 
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array(  
				'id' => 'cart_button',
				'title' => esc_html__( 'Cart Button', 'gauge' ),
				'desc' => esc_html__( 'Add a cart button to the header.', 'gauge' ),
				'type' => 'radio',
				'options' => array(
					'gp-cart-all' => esc_html__( 'Show on all devices', 'gauge' ),
					'gp-cart-desktop' => esc_html__( 'Only hide on mobile devices', 'gauge' ),
					'gp-cart-mobile' => esc_html__( 'Only show on mobile devices', 'gauge' ),
					'gp-cart-disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-cart-all',
			),
			
			array( 
				'id' => 'header_ad',
				'title' => esc_html__( 'Advertisement', 'gauge' ),
				'desc' => esc_html__( 'Add your advertisement code to display just below the header.', 'gauge' ),
				'type' => 'textarea',
				'default' => '',
			),
			
			array(
				'id'        => 'header_ad_exclude',
				'type' => 'button_set',
				'title'     => esc_html__( 'Exclude On Non-Content Pages', 'gauge' ),
				'desc' => esc_html__( 'Hide your header ad content on non-content pages e.g. 404 and attachment pages.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
													
		),
			
	) );


	Redux::setSection( $opt_name, array(
		'id' => 'footer',
		'title' => esc_html__( 'Footer', 'gauge' ),
		'desc' => esc_html__( 'Options for the footer.', 'gauge' ),
		'icon' => 'el-icon-photo',
		'fields' => array(	

			array( 	
				'id' => 'footer_widget_layout',
				'title' => esc_html__( 'Footer Widget Layout', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The layout for the footer widgets.', 'gauge' ),
				'options' => array(
					'gp-footer-larger-first-col' => esc_html__( 'Larger First Widget Column', 'gauge' ),
					'gp-footer-equal-cols' => esc_html__( 'Equal Widget Columns', 'gauge' ),
				),
				'default' => 'gp-footer-larger-first-col',
			),
				
			array( 
				'id' => 'copyright_text',
				'title' => esc_html__( 'Copyright Text', 'gauge' ),
				'desc' => esc_html__( 'Add copyright text to the footer.', 'gauge' ),
				'type' => 'textarea',
				'default' => '',
			),		

			array( 
				'id' => 'footer_ad',
				'title' => esc_html__( 'Advertisement', 'gauge' ),
				'desc' => esc_html__( 'Add your advertisement code to display just above the footer.', 'gauge' ),
				'type' => 'textarea',
				'default' => '',
			),	
			
			array(
				'id'        => 'footer_ad_exclude',
				'type' => 'button_set',
				'title'     => esc_html__( 'Exclude On Non-Content Pages', 'gauge' ),
				'desc' => esc_html__( 'Hide your footer ad content on non-content pages e.g. 404 and attachment pages.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
				
		),
		
	) );	


	Redux::setSection( $opt_name, array(
		'id' => 'posts',
		'title' => esc_html__( 'Posts', 'gauge' ),
		'desc' => esc_html__( 'Global options for all posts (some options can overridden on individual posts).', 'gauge' ),
		'icon' => 'el-icon-pencil',
		'fields' => array(
			
			array( 
				'id' => 'post_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'post_sidebar',
				'type'    => 'select',
				'required' => array( 'post_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),

			array(  
				'id' => 'post_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display a featured image on the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'post_image',
				'type' => 'dimensions',
				'required'  => array( 'post_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured image.', 'gauge' ),
				'default'           => array(
					'width'     => '810px',
					'height'    => '400px',
				),
			),

			array(
				'id' => 'post_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'post_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'post_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'post_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the image aligns with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-above',
			),	
				
			array(
				'id'        => 'post_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Add post meta data to the page.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ), 
					'date' => esc_html__( 'Post Date', 'gauge' ), 
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ), 
					'views' => esc_html__( 'Views', 'gauge' ),
					'cats' => esc_html__( 'Categories', 'gauge' ), 
					'tags' => esc_html__( 'Post Tags', 'gauge' ), 
				),
				'default'   => array(
					'author' => '1',
					'date' => '1',
					'comment_count' => '1',
					'views' => '1',
					'cats' => '1',
					'tags' => '1',
				)
			),

			array( 
				'id' => 'post_share_icons',
				'title' => esc_html__( 'Share Icons', 'gauge' ),
				'subtitle' => wp_kses( __( 'Get your own share code <a href="https://www.addthis.com/get/sharing?bm=tb15" target="_blank">here</a>.', 'gauge' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'desc' => esc_html__( 'Add icons so visitors can share this post on FaceBook, Twitter etc.', 'gauge' ),
				'type' => 'textarea',
				'default' => ''
			),
					                   
			array(  
				'id' => 'post_author_info',
				'title' => esc_html__( 'Author Info Panel', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add an author info panel to the page.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(  
				'id' => 'post_related_items',
				'title' => esc_html__( 'Related Items', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a related items section to the page.', 'gauge' ), 
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
				
			array( 
				'id' => 'post_related_items_per_page',
				'title' => esc_html__( 'Number Of Related Items', 'gauge' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of related items to display.', 'gauge' ),
				'min' => 1,
				'max' => 10,
				'required'  => array( 'post_related_items', '=', 'enabled' ),
				'default' => 4,
			),

			array(
				'id' => 'post_related_items_image',
				'type' => 'dimensions',
				'required'  => array( 'post_related_items', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Related Items Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the related images.', 'gauge' ),
				'default'           => array(
					'width'     => '178px',
					'height'    => '140px',
				),
			),	

		),			
			
	) );	


	Redux::setSection( $opt_name, array(
		'id' => 'post-categories',
		'title' => esc_html__( 'Post Categories', 'gauge' ),
		'desc' => esc_html__( 'Global options for all post categories (some options can be overridden on individual post categories or by using the Blog page template).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-folder-open',
		'fields' => array(	

			array( 
				'id' => 'cat_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
							
			array( 
				'id' => 'cat_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'cat_sidebar',
				'type'    => 'select',
				'required' => array( 'cat_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
			
			array( 
				'id' => 'cat_format',
				'title' => esc_html__( 'Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'blog-standard' => esc_html__( 'Standard', 'gauge' ),
					'blog-large' 	=> esc_html__( 'Large', 'gauge' ),
					'blog-columns-1' => esc_html__( '1 Column', 'gauge' ),
					'blog-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'blog-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'blog-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'blog-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'blog-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'blog-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),
				'default' => 'blog-standard',
			),

			array(  
				'id' => 'cat_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by.', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),

			array(  
				'id' => 'cat_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'cat_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),
				
			array(  
				'id' => 'cat_filter',
				'title' => esc_html__( 'Filter', 'gauge' ),
				'desc' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
											
			array(
				'id'        => 'cat_filter_options',
				'type'      => 'checkbox',
				'required'  => array( 'cat_filter', '=', 'enabled' ),
				'title'     => esc_html__( 'Filter Options', 'gauge' ),
				'desc' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge' ), 
				'options'   => array(
					'date' => esc_html__( 'Date', 'gauge' ),
					'title' => esc_html__( 'Title', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'date_posted' => esc_html__( 'Date Posted', 'gauge' ),
					'date_modified' => esc_html__( 'Date Modified', 'gauge' ),
				),
				'default'   => array(
					'date' => '1',
					'title' => '1',
					'comment_count' => '1',
					'views' => '1',
					'date_posted' => '1',
					'date_modified' => '0',
				),
			),
			
			array(
				'id'       => 'cat_per_page',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Items Per Page', 'gauge' ),
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),
																
			array(  
				'id' => 'cat_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured image on the page.', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the featured images.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'cat_image',
				'type' => 'dimensions',
				'required'  => array( 'cat_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'default'           => array(
					'width'     => '810px',
					'height'    => '300px',
				),
			),

			array(
				'id' => 'cat_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'cat_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'cat_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'cat_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the images align with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-above',
			),

			array( 
				'id' => 'cat_title_position',
				'title' => esc_html__( 'Title Position', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The position of the title.', 'gauge' ),
				'options' => array(
					'title-next-to-thumbnail' => esc_html__( 'Next To Thumbnail', 'gauge' ),
					'title-over-thumbnail' => esc_html__( 'Over Thumbnail', 'gauge' ),
				),
				'default' => 'title-next-to-thumbnail',
			),
	
			array( 
				'id' => 'cat_content_display',
				'title' => esc_html__( 'Content Display', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The amount of content displayed.', 'gauge' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpt', 'gauge' ),
					'full_content' => esc_html__( 'Full Content', 'gauge' ),
				),
				'default' => 'excerpt',
			),
		
			array( 
				'id' => 'cat_excerpt_length',
				'title' => esc_html__( 'Excerpt Length', 'gauge' ),
				'required'  => array( 'cat_content_display', '=', 'excerpt' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of characters in excerpts.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => '400',
			),

			array(
				'id'        => 'cat_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Select the meta data you want to display.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ),
					'date' => esc_html__( 'Post Date', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'tags' => esc_html__( 'Post Tags', 'gauge' ),
				),
				'default'   => array(
					'author' => '1',
					'date' => '1', 
					'comment_count' => '1',
					'views' => '1',
					'cats' => '0',
					'tags' => '0',
				)
			),
			
			array(  
				'id' => 'cat_read_more_link',
				'title' => esc_html__( 'Read More Link', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a read more link below the content.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

		),						   

			
	) );	

			
	Redux::setSection( $opt_name, array(
		'id' => 'video-categories',
		'title' => esc_html__( 'Video Categories', 'gauge' ),
		'desc' => esc_html__( 'Global options for all video categories (some options can be overridden on individual video categories or by using the Videos page template).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-video',
		'fields' => array(	

			array(
				'id'        => 'video_cat_slug',
				'type'      => 'text',
				'title'     => esc_html__( 'Slug', 'gauge' ),
				'subtitle'  => esc_html__( 'After changing the slug, go to', 'gauge' ) . ' <a href="'.admin_url( 'options-permalink.php' ).'">' . esc_html__( 'Settings -> Permalinks' ,'gauge' ) . '</a> ' . esc_html__( 'and click Save Changes.', 'gauge' ),
				'desc' => esc_html__( 'Custom slug used in the URL for video categories e.g. ', 'gauge' ) . 'http://domain.com/<strong>videos</strong>/category-name.',
				'validate'  => 'unique_slug',
				'default'   => 'videos'
			),

			array(
				'id'        => 'video_cat_prefix_slug',
				'type'      => 'text',
				'title'     => esc_html__( 'Prefix Category Slugs', 'gauge' ),
				'subtitle'  => esc_html__( 'Leave blank to remove the prefix from category slugs.', 'gauge' ),
				'desc' => esc_html__( 'Prefix video category slugs to avoid conflicts with post, hub and portfolio categories e.g. ', 'gauge' ) . 'http://domain.com/videos/<strong>video</strong>-category-name.',
				'validate'  => 'unique_slug',
				'default'   => ''
			),

			array( 
				'id' => 'video_cat_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
								
			array( 
				'id' => 'video_cat_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'video_cat_sidebar',
				'type'    => 'select',
				'required' => array( 'video_cat_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),

			array( 
				'id' => 'video_cat_format',
				'title' => esc_html__( 'Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'blog-standard' => esc_html__( 'Standard', 'gauge' ),
					'blog-large' 	=> esc_html__( 'Large', 'gauge' ),
					'blog-columns-1' => esc_html__( '1 Column', 'gauge' ),
					'blog-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'blog-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'blog-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'blog-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'blog-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'blog-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),
				'default' => 'blog-columns-3',
			),

			array(  
				'id' => 'video_cat_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by.', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),	

			array(  
				'id' => 'video_cat_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'video_cat_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),
						
			array(  
				'id' => 'video_cat_filter',
				'title' => esc_html__( 'Filter', 'gauge' ),
				'desc' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id'        => 'video_cat_filter_options',
				'type'      => 'checkbox',
				'required'  => array( 'video_cat_filter', '=', 'enabled' ),
				'title'     => esc_html__( 'Filter Options', 'gauge' ),
				'desc' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge' ), 
				'options'   => array(
					'date' => esc_html__( 'Date', 'gauge' ),
					'title' => esc_html__( 'Title', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'date_posted' => esc_html__( 'Date Posted', 'gauge' ),
					'date_modified' => esc_html__( 'Date Modified', 'gauge' ),
				),
				'default'   => array(
					'date' => '1',
					'title' => '1',
					'comment_count' => '1',
					'views' => '1',
					'date_posted' => '1',
					'date_modified' => '0',
				)
			),
																	
			array(
				'id'       => 'video_cat_per_page',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Items Per Page', 'gauge' ),
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),
		
			array(  
				'id' => 'video_cat_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured images.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'video_cat_image',
				'type' => 'dimensions',
				'required'  => array( 'video_cat_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'default'           => array(
					'width'     => '374px',
					'height'    => '244px',
				),
			),

			array(
				'id' => 'video_cat_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'video_cat_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'video_cat_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'cat_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the images align with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-above',
			),
			
			array( 
				'id' => 'video_cat_title_position',
				'title' => esc_html__( 'Title Position', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The position of the title.', 'gauge' ),
				'options' => array(
					'title-next-to-thumbnail' => esc_html__( 'Next To Thumbnail', 'gauge' ),
					'title-over-thumbnail' => esc_html__( 'Over Thumbnail', 'gauge' ),
				),
				'default' => 'title-next-to-thumbnail',
			),
				
			array( 
				'id' => 'video_cat_content_display',
				'title' => esc_html__( 'Content Display', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The amount of content displayed.', 'gauge' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpt', 'gauge' ),
					'full_content' => esc_html__( 'Full Content', 'gauge' ),
				),
				'default' => 'excerpt',
			),
		
			array( 
				'id' => 'video_cat_excerpt_length',
				'title' => esc_html__( 'Excerpt Length', 'gauge' ),
				'required'  => array( 'video_cat_content_display', '=', 'excerpt' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of characters in excerpts.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => 150,
			),

			array(
				'id'        => 'video_cat_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Select the meta data you want to display.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ),
					'date' => esc_html__( 'Post Date', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'tags' => esc_html__( 'Post Tags', 'gauge' ),
				),
				'default'   => array(
					'author' => '0',
					'date' => '1', 
					'comment_count' => '0',
					'views' => '0',
					'cats' => '0',
					'tags' => '0',
				)
			),
			
			array(  
				'id' => 'video_cat_read_more_link',
				'title' => esc_html__( 'Read More Link', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a read more link below the content.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'disabled',
			),
						
		),                
			
	) );
            
            
	Redux::setSection( $opt_name, array(
		'id' => 'search-author-results',
		'title' => esc_html__( 'Search/Author Results', 'gauge' ),
		'desc' => esc_html__( 'Global options for search and author results.', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-search',
		'fields' => array(	

			array( 
				'id' => 'search_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),

			array(
				'id' => 'search_title_bg', 
				'title' => esc_html__( 'Page Header Background', 'gauge' ),
				'type'      => 'media',			
				'required' => array( 'search_title', '=', 'gp-large-title' ),
				'desc' => esc_html__( 'The background of the page header.', 'gauge' ),
				'default' => '',
			),
												
			array( 
				'id' => 'search_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'search_sidebar',
				'type'    => 'select',
				'required' => array( 'search_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
			
			array( 
				'id' => 'search_format',
				'title' => esc_html__( 'Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'blog-standard' => esc_html__( 'Standard', 'gauge' ),
					'blog-columns-1' => esc_html__( '1 Column', 'gauge' ),
					'blog-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'blog-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'blog-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'blog-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'blog-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'blog-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),
				'default' => 'blog-standard',
			),

			array(  
				'id' => 'search_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by (author pages only).', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'followers' => esc_html__( 'Most Followers', 'gauge' ),
					'site_rating' => esc_html__( 'Top Site Rated', 'gauge' ),
					'user_rating' => esc_html__( 'Top User Rated', 'gauge' ),
					'hub_awards' => esc_html__( 'Hub Awards', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),

			array(  
				'id' => 'search_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'search_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'search_filter',
				'title' => esc_html__( 'Filter', 'gauge' ),
				'desc' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
											
			array(
				'id'        => 'search_filter_options',
				'type'      => 'checkbox',
				'required'  => array( 'search_filter', '=', 'enabled' ),
				'title'     => esc_html__( 'Filter Options', 'gauge' ),
				'desc' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge' ), 
				'options'   => array(
					'date' => esc_html__( 'Date', 'gauge' ),
					'title' => esc_html__( 'Title', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'followers' => esc_html__( 'Followers', 'gauge' ),
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
					'user_rating' => esc_html__( 'User Rating', 'gauge' ),
					'hub_awards' => esc_html__( 'Hub Awards', 'gauge' ),
					'date_posted' => esc_html__( 'Date Posted', 'gauge' ),
					'date_modified' => esc_html__( 'Date Modified', 'gauge' ),
				),
				'default'   => array(
					'date' => '1',
					'title' => '1',
					'site_rating' => '1',
					'user_rating' => '1',
					'comment_count' => '1',
					'views' => '1',
					'followers' => '1',
					'hub_awards' => '1',
					'date_posted' => '1',
					'date_modified' => '0',
				)
			),
			
			array(
				'id'       => 'search_per_page',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Items Per Page', 'gauge' ),
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),
																
			array(  
				'id' => 'search_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured image on the page.', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the featured images.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'search_image',
				'type' => 'dimensions',
				'required'  => array( 'search_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'default'           => array(
					'width'     => '120px', 
					'height'    => '120px',
				),
			),

			array(
				'id' => 'search_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'search_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'search_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'search_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the images align with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-align-left',
			),

			array( 
				'id' => 'search_title_position',
				'title' => esc_html__( 'Title Position', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The position of the title.', 'gauge' ),
				'options' => array(
					'title-next-to-thumbnail' => esc_html__( 'Next To Thumbnail', 'gauge' ),
					'title-over-thumbnail' => esc_html__( 'Over Thumbnail', 'gauge' ),
				),
				'default' => 'title-next-to-thumbnail',
			),
	
			array( 
				'id' => 'search_content_display',
				'title' => esc_html__( 'Content Display', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The amount of content displayed.', 'gauge' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpt', 'gauge' ),
					'full_content' => esc_html__( 'Full Content', 'gauge' ),
				),
				'default' => 'excerpt',
			),
		
			array( 
				'id' => 'search_excerpt_length',
				'title' => esc_html__( 'Excerpt Length', 'gauge' ),
				'required'  => array( 'search_content_display', '=', 'excerpt' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of characters in excerpts.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => '400',
			),

			array(
				'id'        => 'search_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Select the meta data you want to display.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ),
					'date' => esc_html__( 'Post Date', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'followers' => esc_html__( 'Followers', 'gauge' ),
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'tags' => esc_html__( 'Post Tags', 'gauge' ),                       
					'hub_cats' => esc_html__( 'Hub Categories', 'gauge' ),
					'hub_fields' => esc_html__( 'Hub Fields', 'gauge' ),
					'hub_award' => esc_html__( 'Hub Award', 'gauge' ),
				),
				'default'   => array(
					'author' => '1',
					'date' => '1', 
					'comment_count' => '1',
					'views' => '1',
					'followers' => '0',
					'cats' => '0',
					'tags' => '0',    
					'hub_cats' => '1',
					'hub_fields' => '1',
					'hub_award' => '1',
				)
			),

			array(
				'id'       => 'search_cats',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Hub Categories', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => 'gp_hubs', 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the hub categories you want to display.', 'gauge' ),
				'default' => '',
			),
	
			array(
				'id'       => 'search_fields',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Hub Fields', 'gauge' ),
				'data' => 'taxonomies',
				'args' => array( 'object_type' => array( 'page' ) ),
				'desc' => esc_html__( 'Select the hub fields you want to display.', 'gauge' ),
			),											

			array(
				'id'        => 'search_display_rating',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Ratings', 'gauge' ),
				'desc' => esc_html__( 'Select the ratings you want to display.', 'gauge' ), 
				'options'   => array(
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
					'user_rating' => esc_html__( 'User Rating', 'gauge' ),
				),
				'default'   => array(
					'site_rating' => '1',
					'user_rating' => '1',
				)
			),
							   
			array(  
				'id' => 'search_read_more_link',
				'title' => esc_html__( 'Read More Link', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a read more link below the content.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

		),						   
			
	) );

										
	Redux::setSection( $opt_name, array(
		'id' => 'pages',
		'title' => esc_html__( 'Pages', 'gauge' ),
		'desc' => esc_html__( 'Global options for all pages (some options can be overridden on individual pages).', 'gauge' ),
		'icon' => 'el-icon-file',
		'fields' => array(

			array( 
				'id' => 'page_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
							
			array( 
				'id' => 'page_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'page_sidebar',
				'type'    => 'select',
				'required' => array( 'page_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),

			array(  
				'id' => 'page_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured image on the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'page_image',
				'type' => 'dimensions',
				'required'  => array( 'page_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured image.', 'gauge' ),
				'default'           => array(
					'width'     => '810px',
					'height'    => '400px',
				),
			),

			array(
				'id' => 'page_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'page_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'page_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'page_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the image aligns with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-above',
			),

			array(  
				'id' => 'page_author_info',
				'title' => esc_html__( 'Author Info Panel', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add an author info panel to the page.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'disabled',
			),

		),
					
	) );	
	

	Redux::setSection( $opt_name, array(
		'id' => 'hubs',
		'title' => esc_html__( 'Hubs', 'gauge' ),
		'desc' => esc_html__( 'Global options for all hubs (some options can be overridden on individual hubs).', 'gauge' ),
		'icon' => 'el-icon-globe',
		'fields' => array(

			array( 
				'id' => 'hub_fields',
				'title' => esc_html__( 'Hub Fields', 'gauge' ),
				'type' => 'multi_text',
				 'subtitle'  => esc_html__( 'After adding/editing the hub fields, go to', 'gauge' ) . ' <a href="' . admin_url( 'options-permalink.php' ) . '">' . esc_html__( 'Settings -> Permalinks', 'gauge' ) . '</a> ' . esc_html__( 'and click Save Changes.', 'gauge' ) . '<br/><br/>' . esc_html__( 'Do NOT use any of the reserved terms listed', 'gauge' ) . ' <a href="https://codex.wordpress.org/Reserved_Terms" target="_blank">' . esc_html__( 'here', 'gauge' ) . '</a>.',
				'desc' => esc_html__( 'Add hub fields that can be displayed on your hub pages.', 'gauge' ),
				'validate' => 'unique_slug',
				'add_text' => esc_html__( 'Add Hub Field', 'gauge' ),
				'default' => array(
					0 => esc_html__( 'Release Date', 'gauge' ),
					1 => esc_html__( 'Genre', 'gauge' ),
					2 => esc_html__( 'Rating', 'gauge' ),
					3 => esc_html__( 'Developed By', 'gauge' ),
					4 => esc_html__( 'Publisher', 'gauge' ),
				),
			),

			array(
				'id' => 'hub_field_links',
				'title' => esc_html__( 'Hub Field Links', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose whether to disable the links to the archive pages for hub fields', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array(  
				'id' => 'hub_header_posts',
				'title' => esc_html__( 'Hub Header Posts', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose to display the hub header on posts asssociated with the hub.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array( 
				'id' => 'hub_prefix_child_pages',
				'title' => esc_html__( 'Prefix Child Page Titles', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Prefix child page titles with the hub parent page title.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array( 
				'id' => 'hub_following_items',
				'title' => esc_html__( 'Following Items', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'Choose who can follow items on your site.', 'gauge' ),
				'options' => array(
					'both' => esc_html__( 'Members and visitors can follow items', 'gauge' ),
					'members' => esc_html__( 'Only members can follow items', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'both',
			),

			array( 
				'id' => 'hub_affiliate_button_text',
				'title' => esc_html__( 'Affiliate Button Text', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The text used for your affiliate button in your hub header.', 'gauge' ),
				'default' => esc_html__( 'Buy Now', 'gauge' ),
			),
													
			array(
				'id' => 'review_can_users_rate',
				'title' => esc_html__( 'Can Visitors Rate', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose whether to allow visitors to rate items.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
							   
			array(
				'id'      => 'review_site_rating_style',
				'type'    => 'select',
				'title'   => esc_html__( 'Site Rating Style', 'gauge' ),
				'desc' => esc_html__( 'The site rating style.', 'gauge' ),
				'options' => array(
					'plain' => esc_html__( 'Plain', 'gauge' ),
					'gauge' => esc_html__( 'Gauge', 'gauge' ),
				),
				'default' => 'gauge',
			),
			
			array(
				'id'      => 'review_user_rating_style',
				'type'    => 'select',
				'title'   => esc_html__( 'User Rating Style', 'gauge' ),
				'desc' => esc_html__( 'The user rating style.', 'gauge' ),
				'options' => array(
					'plain' => esc_html__( 'Plain', 'gauge' ),
					'gauge' => esc_html__( 'Gauge', 'gauge' ),
				),
				'default' => 'plain',
			),
																	
			array(  
				'id' => 'review_rating_number',
				'title' => esc_html__( 'Rating Number', 'gauge' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The maximum number users can vote up to.', 'gauge' ),						
				'min' => 1,
				'max' => 10,
				'default' => 10,
			),	
									
			array( 
				'id' => 'review_rating_criteria',
				'title' => esc_html__( 'Rating Criteria', 'gauge' ),
				'desc' => esc_html__( 'Add multiple rating criteria to your site rating.', 'gauge' ),
				'type' => 'multi_text',
				'add_text' => esc_html__( 'Add Rating Criteria', 'gauge' ),
				'default' => '',
			),
						   
			array(
				'id' => 'review_site_rating_text_1',
				'title' => esc_html__( 'Rating 1 Text', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The text used to describe a site rating of 1.', 'gauge' ),
				'default' => esc_html__( 'Horrendous', 'gauge' ),
			),

			array(
				'id' => 'review_site_rating_text_2',
				'title' => esc_html__( 'Rating 2 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 2.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Awful', 'gauge' ),
			),

			array(
				'id' => 'review_site_rating_text_3',
				'title' => esc_html__( 'Rating 3 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 3.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Bad', 'gauge' ),
			),
			
			array(
				'id' => 'review_site_rating_text_4',
				'title' => esc_html__( 'Rating 4 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 4.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Poor', 'gauge' ),
			),
			
			array(
				'id' => 'review_site_rating_text_5',
				'title' => esc_html__( 'Rating 5 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 5.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Average', 'gauge' ),
			),
			
			array(
				'id' => 'review_site_rating_text_6',
				'title' => esc_html__( 'Rating 6 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 6.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Fair', 'gauge' ),
			),
			array(
				'id' => 'review_site_rating_text_7',
				'title' => esc_html__( 'Rating 7 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 7.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Good', 'gauge' ),
			),
			array(
				'id' => 'review_site_rating_text_8',
				'title' => esc_html__( 'Rating 8 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 8.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Great', 'gauge' ),
			),
			array(
				'id' => 'review_site_rating_text_9',
				'title' => esc_html__( 'Rating 9 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 9.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Amazing', 'gauge' ),
			),
			array(
				'id' => 'review_site_rating_text_10',
				'title' => esc_html__( 'Rating 10 Text', 'gauge' ),
				'desc' => esc_html__( 'The text used to describe a site rating of 10.', 'gauge' ),
				'type' => 'text',
				'default' => esc_html__( 'Perfect', 'gauge' ),
			),								
																																																										
		),     
			
	) );	
 

	Redux::setSection( $opt_name, array(
		'id' => 'hub-template',
		'title' => esc_html__( 'Hub Template', 'gauge' ),
		'desc' => esc_html__( 'Global options for all hubs (some options can be overridden on individual hubs).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-globe',
		'fields' => array(	
		
			array( 
				'id' => 'hub_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),

			array( 
				'id' => 'hub_title_header_format',
				'title' => esc_html__( 'Page Header Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format of the page header on the page.', 'gauge' ),
				'options' => array(
					'hub-header' => esc_html__( 'Hub Header', 'gauge' ),
					'review-header' => esc_html__( 'Review Header', 'gauge' ),
				),
				'default' => 'hub-header',
			),
																
			array( 
				'id' => 'hub_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'hub_sidebar',
				'type'    => 'select',
				'required' => array( 'hub_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-hub-sidebar',
			),
						
			array(  
				'id' => 'hub_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured image on the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'hub_image',
				'type' => 'dimensions',
				'required'  => array( 'hub_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured image.', 'gauge' ),
				'default'           => array(
					'width'     => '120px', 
					'height'    => '120px',
				),
			),

			array(
				'id' => 'hub_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'hub_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id'       => 'hub_header_cats',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Hub Header Categories', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => 'gp_hubs', 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the hub categories you want to display in the hub header.', 'gauge' ),
				'default' => '',
			),

			array(
				'id'       => 'hub_header_fields',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Hub Header Fields', 'gauge' ),
				'data' => 'taxonomies',
				'args' => array( 'object_type' => array( 'page' ) ),
				'desc' => esc_html__( 'Select the hub fields you want to display in the hub header.', 'gauge' ),
				'default' => '',
			),
			
			/*array(
				'id'        => 'hub_meta',
				'required' => array( 'hub_title_header_format', '=', array( 'review-header' ) ),
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Add post meta data to the review format header.', 'gauge' ), 
				'options'   => array(
					'avatar' => esc_html__( 'Avatar', 'gauge' ),
					'author_date' => esc_html__( 'Author and Date', 'gauge' ),
				),
				'default'   => array(
					'avatar' => '1',
					'author_date' => '1',
				)
			),*/
			
			array(
				'id'        => 'hub_header_display_rating',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Hub Header Ratings', 'gauge' ),
				'desc' => esc_html__( 'Choose to display the site and user ratings in the hub header.', 'gauge' ), 
				'options'   => array(
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
					'user_rating' => esc_html__( 'User Rating', 'gauge' ),
				),
				'default'   => array(
					'site_rating' => '1',
					'user_rating' => '1',
				)
			),
								
			array(  
				'id' => 'hub_details',
				'title' => esc_html__( 'Hub Details', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose to display the hub details block.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array(
				'id' => 'hub_user_rating',
				'title' => esc_html__( 'User Rating Box', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose to display the user rating box where users can vote.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
																																																	
		),     

			
	) );
	
	
	Redux::setSection( $opt_name, array(
		'id' => 'hub-review-review-template',
		'title' => esc_html__( 'Hub Review/Review Template', 'gauge' ),
		'desc' => esc_html__( 'Global options for all hub review and review page templates (some options can be overridden on individual hub reviews and reviews).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-star',
		'fields' => array(

			array( 
				'id' => 'review_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
			
			array( 
				'id' => 'review_title_header_format',
				'title' => esc_html__( 'Page Header Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format of the page header on the page.', 'gauge' ),
				'options' => array(
					'hub-header' => esc_html__( 'Hub Header', 'gauge' ),
					'review-header' => esc_html__( 'Review Header', 'gauge' ),
				),
				'default' => 'review-header',
			),
			
			array( 
				'id' => 'review_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'review_sidebar',
				'type'    => 'select',
				'required' => array( 'review_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-hub-sidebar',
			),
			
			array( 
				'id' => 'review_sidebar_position',
				'required' => array( 'review_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title' => esc_html__( 'Sidebar Position', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The position of the sidebar.', 'gauge' ),
				'options' => array(
					'top' => esc_html__( 'Top of page', 'gauge' ),
					'bottom' => esc_html__( 'Bottom of page', 'gauge' ),
				),
				'default' => 'bottom',
			),
						
			array(  
				'id' => 'review_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured image on the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'review_image',
				'type' => 'dimensions',
				'required'  => array( 'review_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured image.', 'gauge' ),
				'default'           => array(
					'width'     => '120px',
					'height'    => '120px',
				),
			),

			array(
				'id' => 'review_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'review_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array(
				'id'       => 'review_header_cats',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Review Header Categories', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => 'gp_hubs', 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the hub categories you want to display in the review header.', 'gauge' ),
				'default' => '',
			),

			array(
				'id'       => 'review_header_fields',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Review Header Fields', 'gauge' ),
				'data' => 'taxonomies',
				'args' => array( 'object_type' => array( 'page' ) ),
				'desc' => esc_html__( 'Select the hub fields you want to display in the review header.', 'gauge' ),
				'default' => '',
			),	
							
			array(
				'id'        => 'review_header_display_rating',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Hub Header Ratings', 'gauge' ),
				'desc' => esc_html__( 'Choose to display the site and user ratings in the hub header.', 'gauge' ), 
				'options'   => array(
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
					'user_rating' => esc_html__( 'User Rating', 'gauge' ),
				),
				'default'   => array(
					'site_rating' => '1',
					'user_rating' => '1',
				)
			),
			
			array(
				'id'        => 'review_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Add post meta data to the page.', 'gauge' ), 
				'options'   => array(
					'avatar' => esc_html__( 'Avatar (only shown on Review Header)', 'gauge' ),
					'author_date' => esc_html__( 'Author and Date (only shown on Review Header)', 'gauge' ),
					'tags' => esc_html__( 'Post Tags', 'gauge' ),
				),
				'default'   => array(
					'avatar' => '1',
					'author_date' => '1',
					'tags' => '1',
				)
			),
			
			array( 
				'id' => 'review_share_icons',
				'title' => esc_html__( 'Share Icons', 'gauge' ),
				'subtitle' => wp_kses( __( 'Get your own share code <a href="https://www.addthis.com/get/sharing?bm=tb15" target="_blank">here</a>.', 'gauge' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'desc' => esc_html__( 'Add icons so visitors can share this review on FaceBook, Twitter etc.', 'gauge' ),
				'type' => 'textarea',
				'default' => ''
			),
								
			array(  
				'id' => 'review_details',
				'title' => esc_html__( 'Hub Details', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose to display the hub details block.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'disabled',
			),
																		
			array(
				'id' => 'review_user_rating',
				'title' => esc_html__( 'User Rating Box', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Choose to display the user rating box where users can vote.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(  
				'id' => 'review_author_info',
				'title' => esc_html__( 'Author Info Panel', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add an author info panel to the page.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(  
				'id' => 'review_related_items',
				'title' => esc_html__( 'Related Items', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a related items section to the page.', 'gauge' ), 
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
				
			array( 
				'id' => 'review_related_items_per_page',
				'title' => esc_html__( 'Number Of Related Items', 'gauge' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of related items to display.', 'gauge' ),
				'min' => 1,
				'max' => 10,
				'required'  => array( 'review_related_items', '=', 'enabled' ),
				'default' => 4,
			),

			array(
				'id' => 'review_related_items_image',
				'type' => 'dimensions',
				'required'  => array( 'review_related_items', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Related Items Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the related images.', 'gauge' ),
				'default'           => array(
					'width'     => '178px',
					'height'    => '140px',
				),
			),
			
			array(
				'id'      => 'review_first_letter_styling',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Style First Letter', 'gauge' ),
				'desc' => esc_html__( 'Style the first letter in reviews.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
																		
		),
			
	) );	


	Redux::setSection( $opt_name, array(
		'id' => 'news-template',
		'title' => esc_html__( 'News Template', 'gauge' ),
		'desc' => esc_html__( 'Global options for all news page templates (some options can be overridden on individual pages).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-pencil',
		'fields' => array(
																		
			array( 
				'id' => 'news_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'news_sidebar',
				'type'    => 'select',
				'required' => array( 'news_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-hub-sidebar',
			),

			array( 
				'id' => 'news_format',
				'title' => esc_html__( 'Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'blog-standard' => esc_html__( 'Standard', 'gauge' ),
					'blog-columns-1' => esc_html__( '1 Column', 'gauge' ),
					'blog-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'blog-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'blog-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'blog-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'blog-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'blog-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),
				'default' => 'blog-standard',
			),

			array(  
				'id' => 'news_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by.', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),
			
			array(  
				'id' => 'news_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'news_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),
								
			array(  
				'id' => 'news_filter',
				'title' => esc_html__( 'Filter', 'gauge' ),
				'desc' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
			array(
				'id'        => 'news_filter_options',
				'type'      => 'checkbox',
				'required'  => array( 'news_filter', '=', 'enabled' ),
				'title'     => esc_html__( 'Filter Options', 'gauge' ),
				'desc' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge' ), 
				'options'   => array(
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'date' => esc_html__( 'Date', 'gauge' ),
					'title' => esc_html__( 'Title', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'date_posted' => esc_html__( 'Date Posted', 'gauge' ),
					'date_modified' => esc_html__( 'Date Modified', 'gauge' ),
				),
				'default'   => array(
					'cats' => '1',
					'date' => '1',
					'title' => '1',
					'comment_count' => '1',
					'views' => '1',
					'date_posted' => '1',
					'date_modified' => '0',
				)
			),
																				
			array(
				'id'       => 'news_per_page',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Items Per Page', 'gauge' ),
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),
		
			array(  
				'id' => 'news_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured image on the page.', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Display the featured images.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'news_image',
				'type' => 'dimensions',
				'required'  => array( 'news_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'default'           => array(
					'width'     => '150px', 
					'height'    => '150px',
				),
			),

			array(
				'id' => 'news_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'news_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'news_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'news_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the images align with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-align-left',
			),
			
			array( 
				'id' => 'news_title_position',
				'title' => esc_html__( 'Title Position', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The position of the title.', 'gauge' ),
				'options' => array(
					'title-next-to-thumbnail' => esc_html__( 'Next To Thumbnail', 'gauge' ),
					'title-over-thumbnail' => esc_html__( 'Over Thumbnail', 'gauge' ),
				),
				'default' => 'title-next-to-thumbnail',
			),
				
			array( 
				'id' => 'news_content_display',
				'title' => esc_html__( 'Content Display', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The amount of content displayed.', 'gauge' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpt', 'gauge' ),
					'full_content' => esc_html__( 'Full Content', 'gauge' ),
				),
				'default' => 'excerpt',
			),
		
			array( 
				'id' => 'news_excerpt_length',
				'title' => esc_html__( 'Excerpt Length', 'gauge' ),
				'required'  => array( 'news_content_display', '=', 'excerpt' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of characters in excerpts.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => '340',
			),

			array(
				'id'        => 'news_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Select the meta data you want to display.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ),
					'date' => esc_html__( 'Post Date', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'tags' => esc_html__( 'Post Tags', 'gauge' ),
				),
				'default'   => array(
					'author' => '1',
					'date' => '1', 
					'comment_count' => '1',
					'views' => '1',
					'cats' => '0',
					'tags' => '0',
				)
			),
			
			array(  
				'id' => 'news_read_more_link',
				'title' => esc_html__( 'Read More Link', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a read more link below the content.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

		),						   
					
	) );	

			
	Redux::setSection( $opt_name, array(
		'id' => 'images-template',
		'title'     => esc_html__( 'Images Template', 'gauge' ),
		'desc' => esc_html__( 'Global options for all images page templates (some options can be overridden on individual pages).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-picture',
		'fields'    => array(
					
			array( 
				'id' => 'images_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'images_sidebar',
				'type'    => 'select',
				'required' => array( 'images_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-hub-sidebar',
			),
			
			array(
				'id' => 'images_image',
				'type' => 'dimensions',
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'default'           => array(
					'width'     => '225px',
					'height'    => '225px',
				),
			),

			array(
				'id' => 'images_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
			
		),		
			
	) );	

							
	Redux::setSection( $opt_name, array(
		'id' => 'videos-template',
		'title'     => esc_html__( 'Videos Template', 'gauge' ),
		'desc' => esc_html__( 'Global options for all videos page templates (some options can be overridden on individual pages).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-facetime-video',
		'fields'    => array(
														
			array( 
				'id' => 'videos_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'videos_sidebar',
				'type'    => 'select',
				'required' => array( 'videos_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-hub-sidebar',
			),
			
			array( 
				'id' => 'videos_format',
				'title' => esc_html__( 'Format', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'blog-standard' => esc_html__( 'Standard', 'gauge' ),
					'blog-columns-1' => esc_html__( '1 Column', 'gauge' ),
					'blog-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'blog-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'blog-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'blog-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'blog-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'blog-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),
				'default' => 'blog-columns-3',
			),

			array(  
				'id' => 'videos_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by.', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),

			array(  
				'id' => 'videos_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'videos_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),
			
			array(  
				'id' => 'videos_filter',
				'title' => esc_html__( 'Filter', 'gauge' ),
				'desc' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id'        => 'videos_filter_options',
				'type'      => 'checkbox',
				'required'  => array( 'video_cat_filter', '=', 'enabled' ),
				'title'     => esc_html__( 'Filter Options', 'gauge' ),
				'desc' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge' ), 
				'options'   => array(
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'date' => esc_html__( 'Date', 'gauge' ),
					'title' => esc_html__( 'Title', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'date_posted' => esc_html__( 'Date Posted', 'gauge' ),
					'date_modified' => esc_html__( 'Date Modified', 'gauge' ),
				),
				'default'   => array(
					'cats' => '1',
					'date' => '1',
					'title' => '1',
					'comment_count' => '1',
					'views' => '1',
					'date_posted' => '1',
					'date_modified' => '0',
				)
			),
										
			array( 
				'id' => 'videos_per_page',
				'title' => esc_html__( 'Items Per Page', 'gauge' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),	

			array(  
				'id' => 'videos_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured images.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
													
			array(
				'id' => 'videos_image',
				'type' => 'dimensions',
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'default'           => array(
					'width'     => '374px', 
					'height'    => '244px',
				),
			),

			array(
				'id' => 'videos_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'videos_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'videos_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the images align with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-above',
			),
			
			array( 
				'id' => 'videos_title_position',
				'title' => esc_html__( 'Title Position', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The position of the title.', 'gauge' ),
				'options' => array(
					'title-next-to-thumbnail' => esc_html__( 'Next To Thumbnail', 'gauge' ),
					'title-over-thumbnail' => esc_html__( 'Over Thumbnail', 'gauge' ),
				),
				'default' => 'title-next-to-thumbnail',
			),
			
			array( 
				'id' => 'videos_content_display',
				'title' => esc_html__( 'Content Display', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The amount of content displayed.', 'gauge' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpt', 'gauge' ),
					'full_content' => esc_html__( 'Full Content', 'gauge' ),
				),
				'default' => 'excerpt',
			),
						
			array( 
				'id' => 'videos_excerpt_length',
				'title' => esc_html__( 'Excerpt Length', 'gauge' ),
				'required'  => array( 'videos_content_display', '=', 'excerpt' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of characters in excerpts.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => '200',
			),

			array(
				'id'        => 'videos_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Add post meta data to each video in the loop.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ),
					'date' => esc_html__( 'Post Date', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'cats' => esc_html__( 'Categories', 'gauge' ),
					'tags' => esc_html__( 'Post Tags', 'gauge' ),
				),
				'default'   => array(
					'author' => '0',
					'date' => '1',
					'comment_count' => '0',
					'views' => '0',
					'cats' => '0',
					'tags' => '0',
				)
			),
			
			array(  
				'id' => 'videos_read_more_link',
				'title' => esc_html__( 'Read More Link', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a read more link below the content.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'disabled',
			),
																		
		),      										
					
	) );	

							
	Redux::setSection( $opt_name, array(
		'id' => 'write-edit-a-review-template',
		'title'     => esc_html__( 'Write/Edit A Review Templates', 'gauge' ),
		'desc' => esc_html__( 'Global options for all write/edit a review page templates (some options can be overridden on individual pages).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-star-empty',
		'fields'    => array(
														
			array( 
				'id' => 'write_a_review_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'write_a_review_sidebar',
				'type'    => 'select',
				'required' => array( 'write_a_review_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-hub-sidebar',
			),

			array( 
				'id' => 'write_a_review_rules',
				'title' => esc_html__( 'Rules', 'gauge' ),
				'type' => 'textarea',
				'desc' => esc_html__( 'Add some rules to your write a review pages.', 'gauge' ),
				'default' => '<p><strong>Rules for writing a review</strong></p>
<ul>
<li>Distinctively formulate professional process improvements vis-a-vis sticky expertise. Objectively revolutionize distributed channels without B2B collaboration and idea-sharing.</li>
<li>Phosfluorescently mesh high-quality schemas with viral total linkage. Energistically initiate user friendly benefits via functionalized solutions. Dynamically empower global leadership through standards compliant partnerships.</li>
<li>Monotonectally actualize sustainable core competencies before parallel alignments. Intrinsicly extend fully tested partnerships for 24/365 initiatives.</li>
<li>Appropriately maximize market positioning internal or "organic" sources via user friendly interfaces. Phosfluorescently provide access to emerging expertise through market positioning deliverables. Assertively aggregate quality e-commerce with go forward growth strategies.</li>
</ul>'
			),

			array( 
				'id' => 'write_a_review_visitors',
				'title' => esc_html__( 'Allow Visitors To Post Reviews', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Allow visitors to post reviews without logging into the site.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array( 
				'id' => 'write_a_review_submitting',
				'title' => esc_html__( 'Submitting Reviews', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'Choose how users can submit their reviews.', 'gauge' ),
				'options' => array(
					'pending' => esc_html__( 'Reviews need to be approved before showing up on the site', 'gauge' ),
					'approved' => esc_html__( 'Reviews are approved automatically', 'gauge' ),
				),
				'default' => 'pending',
			),
			
			array( 
				'id' => 'write_a_review_editing',
				'title' => esc_html__( 'Editing/Deleting Reviews', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'Choose how users can edit and delete their reviews.', 'gauge' ),
				'options' => array(
					'approved' => esc_html__( 'Once a user edits a review it is approved automatically', 'gauge' ),
					'pending' => esc_html__( 'Once a user edits a review it needs to be approved again', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'approved',
			),

			array( 
				'id' => 'write_a_review_email_notification',
				'title' => esc_html__( 'Email Notifications', 'gauge' ),
				'subtitle' => esc_html__( 'You will only be emailed if reviews need to be approved before they are submitted or edited.', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'Choose how you receive email notifications when a user submits or edits a review.', 'gauge' ),
				'options' => array(
					'email_always' => esc_html__( 'Email me whenever a user submits or edits a review', 'gauge' ),
					'email_submission' => esc_html__( 'Email me only when a user submits a review', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'email_always',
			),

			array(  
				'id' => 'write_a_review_gdpr',
				'title' => esc_html__( 'Privacy Policy Checkbox (GDPR)', 'gauge' ),
				'desc' => esc_html__( 'Add a privacy policy checkbox to the write as review form.', 'gauge' ),
				'type' => 'button_set',
				'options'   => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				), 
				'default'   => 'disabled',
			),
			
			array(  
				'id' => 'write_a_review_gdpr_text',
				'title' => esc_html__( 'Privacy Policy Text', 'gauge' ),
				'desc' => esc_html__( 'Add your own privacy policy text next to the checkbox.', 'gauge' ),
				'subtitle' => esc_html__( 'To add a link within your text use HTML tags e.g. "This is my text and this is a <a href="http://domain.com/privacy-policy">link</a>."', 'gauge' ),
				'type' => 'textarea',
				'required' => array( 'write_a_review_gdpr', '=', 'enabled' ),
			),
																																									
		),										
					
	) );	


	Redux::setSection( $opt_name, array(
		'id' => 'user-reviews-template',
		'title'     => esc_html__( 'User Reviews Template', 'gauge' ),
		'desc' => esc_html__( 'Global options for all user reviews page templates (some options can be overridden on individual pages).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-star-empty',
		'fields'    => array(
														
			array( 
				'id' => 'user_reviews_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'user_reviews_sidebar',
				'type'    => 'select',
				'required' => array( 'user_reviews_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-hub-sidebar',
			),
																				
			array(
				'id'       => 'user_reviews_per_page',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Items Per Page', 'gauge' ),
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),

			array(  
				'id' => 'user_reviews_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured images.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'user_reviews_image',
				'type' => 'dimensions',
				'required'  => array( 'user_reviews_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'default'           => array(
					'width'     => '150px',
					'height'    => '150px',
				),
			),

			array(
				'id' => 'user_reviews_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'user_reviews_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'user_reviews_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'cat_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the images align with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-align-left',
			),
							
			array( 
				'id' => 'user_reviews_content_display',
				'title' => esc_html__( 'Content Display', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The amount of content displayed.', 'gauge' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpt', 'gauge' ),
					'full_content' => esc_html__( 'Full Content', 'gauge' ),
				),
				'default' => 'excerpt',
			),
		
			array( 
				'id' => 'user_reviews_excerpt_length',
				'title' => esc_html__( 'Excerpt Length', 'gauge' ),
				'required'  => array( 'user_reviews_content_display', '=', 'excerpt' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of characters in excerpts.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => '400',
			),

			array(
				'id'        => 'user_reviews_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Select the meta data you want to display.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ),
					'date' => esc_html__( 'Post Date', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
				),
				'default'   => array(
					'author' => '1',
					'date' => '1', 
					'comment_count' => '1',
					'views' => '1',
				)
			),
			
			array(
				'id'        => 'user_reviews_display_rating',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Ratings', 'gauge' ),
				'desc' => esc_html__( 'Select the ratings you want to display.', 'gauge' ), 
				'options'   => array(
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
				),
				'default'   => array(
					'site_rating' => '1',
				)
			),
								
			array(  
				'id' => 'user_reviews_read_more_link',
				'title' => esc_html__( 'Read More Link', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a read more link below the content.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
																										
		),										
					
	) );	

									
	Redux::setSection( $opt_name, array(
		'id' => 'hub-categories',
		'title' => esc_html__( 'Hub Categories', 'gauge' ),
		'desc' => esc_html__( 'Global options for all hub categories (some options can be overridden on individual hub categories).', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-globe-alt',
		'fields' => array(	

			array(
				'id'        => 'hub_cat_slug',
				'type'      => 'text',
				'title'     => esc_html__( 'Slug', 'gauge' ),
				'subtitle'  => esc_html__( 'After changing the slug, go to', 'gauge' ) . ' <a href="'.admin_url( 'options-permalink.php' ).'">' . esc_html__( 'Settings -> Permalinks' ,'gauge' ) . '</a> ' . esc_html__( 'and click Save Changes.', 'gauge' ),
				'desc' => esc_html__( 'Custom slug used in the URL for hub categories e.g. ', 'gauge' ) . 'http://domain.com/<strong>hubs</strong>/category-name.',
				'validate'  => 'unique_slug',
				'default'   => 'hubs'
			),

			array(
				'id'        => 'hub_cat_prefix_slug',
				'type'      => 'text',
				'title'     => esc_html__( 'Prefix Category Slugs', 'gauge' ),
				'subtitle'  => esc_html__( 'Leave blank to remove the prefix from category slugs.', 'gauge' ),
				'desc' => esc_html__( 'Prefix hub category slugs to avoid conflicts with post, video and portfolio categories e.g. ', 'gauge' ) . 'http://domain.com/hubs/<strong>hub</strong>-category-name.',
				'validate'  => 'unique_slug',
				'default'   => ''
			),

			array( 
				'id' => 'hub_cat_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
								
			array( 
				'id' => 'hub_cat_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-right-sidebar',
			),

			array(
				'id'      => 'hub_cat_sidebar',
				'type'    => 'select',
				'required' => array( 'hub_cat_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-hub-cat-sidebar',
			),                    
			
			array( 
				'id' => 'hub_cat_format',
				'title' => esc_html__( 'Format', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'blog-standard' => esc_html__( 'Standard', 'gauge' ),
					'blog-large' 	=> esc_html__( 'Large', 'gauge' ),
					'blog-columns-1' => esc_html__( '1 Column', 'gauge' ),
					'blog-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'blog-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'blog-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'blog-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'blog-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'blog-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),
				'default' => 'blog-standard',
			),

			array(  
				'id' => 'hub_cat_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by.', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'followers' => esc_html__( 'Most Followers', 'gauge' ),
					'site_rating' => esc_html__( 'Top Site Rated', 'gauge' ),
					'user_rating' => esc_html__( 'Top User Rated', 'gauge' ),
					'hub_awards' => esc_html__( 'Hub Awards', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),

			array(  
				'id' => 'hub_cat_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'hub_cat_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),
		 
			array(  
				'id' => 'hub_cat_filter',
				'title' => esc_html__( 'Filter', 'gauge' ),
				'desc' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id'        => 'hub_cat_filter_options',
				'type'      => 'checkbox',
				'required'  => array( 'hub_cat_filter', '=', 'enabled' ),
				'title'     => esc_html__( 'Filter Options', 'gauge' ),
				'desc' => esc_html__( 'Choose what options to display in the dropdown filter menu.', 'gauge' ), 
				'options'   => array(
					'date' => esc_html__( 'Date', 'gauge' ),
					'title' => esc_html__( 'Title', 'gauge' ),
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ),
					'views' => esc_html__( 'Views', 'gauge' ),
					'followers' => esc_html__( 'Followers', 'gauge' ),
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
					'user_rating' => esc_html__( 'User Rating', 'gauge' ),
					'hub_awards' => esc_html__( 'Hub Awards', 'gauge' ),
					'date_posted' => esc_html__( 'Date Posted', 'gauge' ),
					'date_modified' => esc_html__( 'Date Modified', 'gauge' ),
				),
				'default'   => array(
					'date' => '1',
					'title' => '1',
					'comment_count' => '1',
					'views' => '1',
					'followers' => '1',
					'site_rating' => '1',
					'user_rating' => '1',
					'hub_awards' => '1',
					'date_posted' => '1',
					'date_modified' => '0',
				)
			),
						
			array(
				'id'       => 'hub_cat_per_page',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Items Per Page', 'gauge' ),
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),
		
			array(  
				'id' => 'hub_cat_featured_image',
				'title' => esc_html__( 'Featured Image', 'gauge' ),
				'desc' => esc_html__( 'Display the featured images.', 'gauge' ),
				'type' => 'button_set',
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'hub_cat_image',
				'type' => 'dimensions',
				'required'  => array( 'hub_cat_featured_image', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured images.', 'gauge' ),
				'default'           => array(
					'width'     => '150px',
					'height'    => '150px',
				),
			),

			array(
				'id' => 'hub_cat_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'hub_cat_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'hub_cat_image_alignment',
				'title' => esc_html__( 'Image Alignment', 'gauge' ),
				'type' => 'select',
				'required'  => array( 'cat_featured_image', '=', 'enabled' ),
				'desc' => esc_html__( 'Choose how the images align with the content.', 'gauge' ),
				'options' => array(
					'image-wrap-left' => esc_html__( 'Left Wrap', 'gauge' ),
					'image-wrap-right' => esc_html__( 'Right Wrap', 'gauge' ),
					'image-above' => esc_html__( 'Above Content', 'gauge' ),
					'image-align-left' => esc_html__( 'Left Align', 'gauge' ),
					'image-align-right' => esc_html__( 'Right Align', 'gauge' ),
				),
				'default' => 'image-align-left',
			),

			array( 
				'id' => 'hub_cat_title_position',
				'title' => esc_html__( 'Title Position', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The position of the title.', 'gauge' ),
				'options' => array(
					'title-next-to-thumbnail' => esc_html__( 'Next To Thumbnail', 'gauge' ),
					'title-over-thumbnail' => esc_html__( 'Over Thumbnail', 'gauge' ),
				),
				'default' => 'title-next-to-thumbnail',
			),
						
			array( 
				'id' => 'hub_cat_content_display',
				'title' => esc_html__( 'Content Display', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The amount of content displayed.', 'gauge' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpt', 'gauge' ),
					'full_content' => esc_html__( 'Full Content', 'gauge' ),
				),
				'default' => 'excerpt',
			),
		
			array( 
				'id' => 'hub_cat_excerpt_length',
				'title' => esc_html__( 'Excerpt Length', 'gauge' ),
				'required'  => array( 'hub_cat_content_display', '=', 'excerpt' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of characters in excerpts.', 'gauge' ),
				'min' => 0,
				'max' => 999999,
				'default' => 150,
			),

			array(
				'id'        => 'hub_cat_meta',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Post Meta', 'gauge' ),
				'desc' => esc_html__( 'Select the meta data you want to display.', 'gauge' ), 
				'options'   => array(
					'author' => esc_html__( 'Author Name', 'gauge' ), 
					'date' => esc_html__( 'Post Date', 'gauge' ), 
					'comment_count' => esc_html__( 'Comment Count', 'gauge' ), 
					'views' => esc_html__( 'Views', 'gauge' ),
					'followers' => esc_html__( 'Followers', 'gauge' ),
					'tags' => esc_html__( 'Post Tags', 'gauge' ), 
					'hub_cats' => esc_html__( 'Hub Categories', 'gauge' ), 
					'hub_fields' => esc_html__( 'Hub Fields', 'gauge' ), 
					'hub_award' => esc_html__( 'Hub Award', 'gauge' ), 
				),
				'default'   => array(
					'author' => '0',
					'date' => '0', 
					'comment_count' => '0',
					'views' => '0',
					'followers' => '0',
					'tags' => '0',
					'hub_cats' => '1',
					'hub_fields' => '1',
					'hub_award' => '1',
				),
			),
							
			array(
				'id'       => 'hub_cat_cats',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Hub Categories', 'gauge' ),
				'data' => 'terms',
				'args' => array( 'taxonomies' => 'gp_hubs', 'hide_empty' => false ),
				'desc' => esc_html__( 'Select the hub categories you want to display.', 'gauge' ),
				'default' => '',
			),
	
			array(
				'id'       => 'hub_cat_fields',
				'type'     => 'select',
				'multi' => true,
				'title'    => esc_html__( 'Hub Fields', 'gauge' ),
				'data' => 'taxonomies',
				'args' => array( 'object_type' => array( 'page' ) ),
				'desc' => esc_html__( 'Select the hub fields you want to display.', 'gauge' ),
			),											

			array(
				'id'        => 'hub_cat_display_rating',
				'type'      => 'checkbox',
				'title'     => esc_html__( 'Ratings', 'gauge' ),
				'desc' => esc_html__( 'Select the ratings you want to display.', 'gauge' ), 
				'options'   => array(
					'site_rating' => esc_html__( 'Site Rating', 'gauge' ),
					'user_rating' => esc_html__( 'User Rating', 'gauge' ),
				),
				'default'   => array(
					'site_rating' => '1',
					'user_rating' => '1',
				)
			),
								
			array(  
				'id' => 'hub_cat_read_more_link',
				'title' => esc_html__( 'Read More Link', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a read more link below the content.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
									
		),                
			
	) );


	Redux::setSection( $opt_name, array(
		'id' => 'portfolios',
		'title' => esc_html__( 'Portfolios', 'gauge' ),
		'desc' => esc_html__( 'Global options for all portfolio items (some options can be overridden on individual portfolio items).', 'gauge' ),
		'icon' => 'el-icon-photo-alt',
		'fields' => array(							

			array(
				'id'        => 'portfolio_item_slug',
				'type'      => 'text',
				'title'     => esc_html__( 'Slug', 'gauge' ),
				'subtitle'  => esc_html__( 'After changing the slug, go to', 'gauge' ) . ' <a href="'.admin_url( 'options-permalink.php' ).'">' . esc_html__( 'Settings -> Permalinks' ,'gauge' ) . '</a> ' . esc_html__( 'and click Save Changes.', 'gauge' ),
				'desc' => esc_html__( 'Custom slug used in the URL for portfolio categories e.g. ', 'gauge' ) . 'http://domain.com/<strong>portfolios</strong>/item-name.',
				'validate'  => 'unique_slug',
				'default'   => 'portfolio-item'
			),

			array( 
				'id' => 'portfolio_item_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
								
			array( 
				'id' => 'portfolio_item_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'portfolio_item_sidebar',
				'type'    => 'select',
				'required' => array( 'portfolio_item_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),

			array(
				'id'        => 'portfolio_item_type',
				'type'      => 'radio',
				'title'     => esc_html__( 'Image/Slider Type', 'gauge' ),
				'desc' => esc_html__( 'The type of image or slider on the page.', 'gauge' ),
				'options'   => array(
					'left-image' => 'Left Featured Image',
					'fullwidth-image' => 'Fullwidth Featured Image',
					'left-slider' => 'Left Slider',
					'fullwidth-slider' => 'Fullwidth Slider',
					'none' => 'None',
				), 
				'default'   => 'left-image',
			),   

			array(
				'id' => 'portfolio_item_image',
				'type' => 'dimensions',
				'required'  => array( 'portfolio_item_type', '!=', 'none' ),
				'units' => 'px',
				'title' => esc_html__( 'Image/Slider Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the featured image or slider.', 'gauge' ),
				'default'           => array(
					'width'     => '1170px',
					'height'    => '0',
				),
			),
			
			array(
				'id' => 'portfolio_item_hard_crop',
				'title' => esc_html__( 'Hard Crop', 'gauge' ),
				'type' => 'button_set',
				'required'  => array( 'portfolio_item_type', '!=', 'none' ),
				'desc' => esc_html__( 'Images are cropped even if it is smaller than the dimensions you want to crop it to.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),

			array(
				'id' => 'portfolio_item_image_size',
				'title' => esc_html__( 'Image Size', 'gauge' ),
				'subtitle' => esc_html__( 'Only for use with the Masonry portfolio type.', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Size of the image when displayed on a masonry portfolio page.', 'gauge' ),
				'options' => array(
					'regular' => esc_html__( 'Regular', 'gauge' ),
					'wide' => esc_html__( 'Wide', 'gauge' ),
					'tall' => esc_html__( 'Tall', 'gauge' ),
					'large' => esc_html__( 'Large', 'gauge' ),
				),
				'default' => 'regular',
			),
						
			array( 	
				'id' => 'portfolio_item_link_text',
				'title' => esc_html__( 'Button Text', 'gauge' ),
				'type' => 'text',
				'desc' => esc_html__( 'The text for the button.', 'gauge' ),
				'default' => esc_html__( 'Website', 'gauge' ),
			), 

			array( 
				'id' => 'portfolio_item_link_target',
				'title' => esc_html__( 'Button Link Target', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'The target for the button link.', 'gauge' ),
				'options' => array(
					'_blank' => esc_html__( 'New Window', 'gauge' ),
					'_self' => esc_html__( 'Same Window', 'gauge' ),
				),
				'default' => '_blank',
			),

			array(  
				'id' => 'portfolio_item_related_items',
				'title' => esc_html__( 'Related Items', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add a related items section to the page.', 'gauge' ), 
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),
				
			array( 
				'id' => 'portfolio_item_related_items_per_page',
				'title' => esc_html__( 'Number Of Related Items', 'gauge' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of related items to display.', 'gauge' ),
				'required'  => array( 'portfolio_item_related_items', '=', 'enabled' ),
				'min' => 1,
				'max' => 999999,
				'default' => 4,
			),

			array(
				'id' => 'portfolio_item_related_items_image',
				'type' => 'dimensions',
				'required'  => array( 'portfolio_item_related_items', '=', 'enabled' ),
				'units' => 'px',
				'title' => esc_html__( 'Related Items Image Dimensions', 'gauge' ),
				'subtitle' => esc_html__( 'Set height to 0 to have a proportionate height.', 'gauge' ),
				'desc' => esc_html__( 'The width and height of the related images.', 'gauge' ),
				'default'           => array(
					'width'     => '257px',
					'height'    => '150px',
				),
			),    
				
		),    				
    				
	) );	
	
    		            
	Redux::setSection( $opt_name, array(
		'id' => 'portfolio-categories',
		'title' => esc_html__( 'Portfolio Categories', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-th',
		'desc' => esc_html__( 'Global options for all portfolio categories (some options can be overridden on individual portfolio categories or by using the Portfolio page template).', 'gauge' ),
		'fields' => array(
		
			array(
				'id'        => 'portfolio_cat_slug',
				'type'      => 'text',
				'title'     => esc_html__( 'Slug', 'gauge' ),
				'subtitle'  => esc_html__( 'After changing the slug, go to', 'gauge' ) . ' <a href="'.admin_url( 'options-permalink.php' ).'">' . esc_html__( 'Settings -> Permalinks' ,'gauge' ) . '</a> ' . esc_html__( 'and click Save Changes.', 'gauge' ),
				'desc' => esc_html__( 'Custom slug used in the URL for portfolio categories e.g. ', 'gauge' ) . 'http://domain.com/<strong>portfolios</strong>/category-name.',
				'validate'  => 'unique_slug',
				'default'   => 'portfolios',
			),

			array(
				'id'        => 'portfolio_cat_prefix_slug',
				'type'      => 'text',
				'title'     => esc_html__( 'Prefix Category Slugs', 'gauge' ),
				'subtitle'  => esc_html__( 'Leave blank to remove the prefix from category slugs.', 'gauge' ),
				'desc' => esc_html__( 'Prefix portfolio category slugs to avoid conflicts with post, video and hub categories e.g. ', 'gauge' ) . 'http://domain.com/portfolios/<strong>portfolio</strong>-category-name.',
				'validate'  => 'unique_slug',
				'default'   => ''
			),
			
			array( 
				'id' => 'portfolio_cat_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
												
			array( 
				'id' => 'portfolio_cat_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'portfolio_cat_sidebar',
				'type'    => 'select',
				'required' => array( 'portfolio_cat_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),

			array( 
				'id' => 'portfolio_cat_format',
				'title' => esc_html__( 'Portfolio Format', 'gauge' ),					
				'type' => 'select',
				'desc' => esc_html__( 'The format to display the items in.', 'gauge' ),
				'options' => array(
					'portfolio-columns-2' => esc_html__( '2 Columns', 'gauge' ),
					'portfolio-columns-3' => esc_html__( '3 Columns', 'gauge' ),
					'portfolio-columns-4' => esc_html__( '4 Columns', 'gauge' ),
					'portfolio-columns-5' => esc_html__( '5 Columns', 'gauge' ),
					'portfolio-columns-6' => esc_html__( '6 Columns', 'gauge' ),
					'portfolio-masonry' => esc_html__( 'Masonry', 'gauge' ),
				),	
				'default' => 'portfolio-columns-2',
			),

			array(  
				'id' => 'portfolio_cat_orderby',
				'title' => esc_html__( 'Order By', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The criteria which the items are ordered by.', 'gauge' ),
				'options' => array(
					'newest' => esc_html__( 'Newest', 'gauge' ),
					'oldest' => esc_html__( 'Oldest', 'gauge' ),
					'title_az' => esc_html__( 'Title (A-Z)', 'gauge' ),
					'title_za' => esc_html__( 'Title (Z-A)', 'gauge' ),
					'comment_count' => esc_html__( 'Most Comments', 'gauge' ),
					'views' => esc_html__( 'Most Views', 'gauge' ),
					'menu_order' => esc_html__( 'Menu Order', 'gauge' ),
					'rand' => esc_html__( 'Random', 'gauge' ),
				),
				'default' => 'newest',
			),
			
			array(  
				'id' => 'portfolio_cat_date_posted',
				'title' => esc_html__( 'Date Posted', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were posted.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),

			array(  
				'id' => 'portfolio_cat_date_modified',
				'title' => esc_html__( 'Date Modified', 'gauge' ),
				'type' => 'radio',
				'desc' => esc_html__( 'The date the items were modified.', 'gauge' ),
				'options' => array(
					'all' => esc_html__( 'Any date', 'gauge' ),
					'year' => esc_html__( 'In the last year', 'gauge' ),
					'month' => esc_html__( 'In the last month', 'gauge' ),
					'week' => esc_html__( 'In the last week', 'gauge' ),
					'day' => esc_html__( 'In the last day', 'gauge' ),
				),
				'default' => 'all',
			),
										
			array(  
				'id' => 'portfolio_cat_filter',
				'title' => esc_html__( 'Filter', 'gauge' ),
				'desc' => esc_html__( 'Add a dropdown filter menu to the page.', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add category filter links to the page.', 'gauge' ),
				'options' => array(
					'enabled' => esc_html__( 'Enabled', 'gauge' ),
					'disabled' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'enabled',
			),					

			array( 
				'id' => 'portfolio_cat_per_page',
				'title' => esc_html__( 'Items Per Page', 'gauge' ),
				'type' => 'spinner',
				'desc' => esc_html__( 'The number of items on each page.', 'gauge' ),
				'min' => 1,
				'max' => 999999,
				'default' => 12,
			),
			
		),			
					
	) );	

					 	
	Redux::setSection( $opt_name, array(
		'id' => 'woocommerce',
		'title' => esc_html__( 'WooCommerce', 'gauge' ),
		'desc' => esc_html__( 'Global options for WooCommerce pages (can be overridden on individual shop page).', 'gauge' ),
		'icon' => 'el-icon-shopping-cart',
		'fields' => array(
		
			array( 
				'id' => 'shop_title',
				'title' => esc_html__( 'Shop Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-large-title',
			),
										
			array( 
				'id' => 'shop_layout',
				'title' => esc_html__( 'Shop Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'shop_sidebar',
				'type'    => 'select',
				'required' => array( 'shop_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-woocommerce-sidebar',
			),
			
			array( 
				'id' => 'product_layout',
				'title' => esc_html__( 'Product Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'product_sidebar',
				'type'    => 'select',
				'required' => array( 'product_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-woocommerce-sidebar',
			),

		),
					
	) );	
			
			
	Redux::setSection( $opt_name, array(
		'id' => 'buddypress-options',
		'title' => esc_html__( 'BuddyPress', 'gauge' ),
		'desc' => esc_html__( 'Global options for BuddyPress pages.', 'gauge' ),
		'icon' => 'el-icon-user',
		'fields' => array(
		
			array( 
				'id' => 'bp_title',
				'title' => esc_html__( 'BuddyPress Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-no-large-title',
			),

			array(
				'id' => 'bp_title_bg', 
				'title' => esc_html__( 'BuddyPress Page Header Background', 'gauge' ),
				'type'      => 'media',			
				'required' => array( 'bp_title', '=', 'gp-large-title' ),
				'desc' => esc_html__( 'The background of the page header.', 'gauge' ),
				'default' => '',
			),
			
			array( 
				'id' => 'bp_layout',
				'title' => esc_html__( 'BuddyPress Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'bp_sidebar',
				'type'    => 'select',
				'required' => array( 'bp_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'BuddyPress Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
			
		),			
					
	) );
		
	Redux::setSection( $opt_name, array(
		'id' => 'bp_activity_options',
		'title' => esc_html__( 'Activity Page', 'gauge' ),
		'desc' => esc_html__( 'Global options for the BuddyPress activity page.', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-user',
		'fields' => array(
		
			array( 
				'id' => 'bp_activity_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'bp_activity_title_bg', 
				'title' => esc_html__( 'Page Header Background', 'gauge' ),
				'type'      => 'media',
				'desc' => esc_html__( 'The background of the page header.', 'gauge' ),
				'default' => '',
			),
			
			array( 
				'id' => 'bp_activity_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array( 'title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'bp_activity_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
		
		),			
	) );				

	Redux::setSection( $opt_name, array(
		'id' => 'bp_members_options',
		'title' => esc_html__( 'Members Page', 'gauge' ),
		'desc' => esc_html__( 'Global options for the BuddyPress members page.', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-user',
		'fields' => array(
		
			array( 
				'id' => 'bp_members_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'bp_members_title_bg', 
				'title' => esc_html__( 'Page Header Background', 'gauge' ),
				'type'      => 'media',
				'desc' => esc_html__( 'The background of the page header.', 'gauge' ),
				'default' => '',
			),
			
			array( 
				'id' => 'bp_members_layout',
				'title' => esc_html__( 'Directory Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array( 'title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),
			
			array( 
				'id' => 'bp_profile_layout',
				'title' => esc_html__( 'Profile Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array( 'title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'bp_members_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
		
		),			
	) );	

	Redux::setSection( $opt_name, array(
		'id' => 'bp_groups_options',
		'title' => esc_html__( 'Groups Page', 'gauge' ),
		'desc' => esc_html__( 'Global options for the BuddyPress groups page.', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-user',
		'fields' => array(
		
			array( 
				'id' => 'bp_groups_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'bp_groups_title_bg', 
				'title' => esc_html__( 'Page Header Background', 'gauge' ),
				'type'      => 'media',
				'desc' => esc_html__( 'The background of the page header.', 'gauge' ),
				'default' => '',
			),
			
			array( 
				'id' => 'bp_groups_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array( 'title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'bp_groups_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
		
		),			
	) );

	Redux::setSection( $opt_name, array(
		'id' => 'bp_register_options',
		'title' => esc_html__( 'Registration Page', 'gauge' ),
		'desc' => esc_html__( 'Global options for the BuddyPress registration page.', 'gauge' ),
		'subsection' => true,
		'icon' => 'el-icon-user',
		'fields' => array(
		
			array( 
				'id' => 'bp_register_title',
				'title' => esc_html__( 'Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'gauge' ),
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'default',
			),

			array(
				'id' => 'bp_register_title_bg', 
				'title' => esc_html__( 'Page Header Background', 'gauge' ),
				'type'      => 'media',
				'desc' => esc_html__( 'The background of the page header.', 'gauge' ),
				'default' => '',
			),
			
			array( 
				'id' => 'bp_register_layout',
				'title' => esc_html__( 'Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'default' => array( 'title' => esc_html__( 'Default', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/default.png' ),
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'default',
			),

			array(
				'id'      => 'bp_register_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars_default',
				'default' => 'default',
			),
		
		),			
	) );
	
				
	Redux::setSection( $opt_name, array(
		'id' => 'bbpress_options',
		'title' => esc_html__( 'bbPress', 'gauge' ),
		'desc' => esc_html__( 'Global options for all bbPress pages (some options can be overridden on individual forums and topics).', 'gauge' ),
		'icon' => 'el-icon-comment-alt',
		'fields' => array(
			
			array( 
				'id' => 'bbpress_title',
				'title' => esc_html__( 'bbPress Page Header', 'gauge' ),
				'type' => 'button_set',
				'desc' => esc_html__( 'Add the page header on the page.', 'gauge' ),
				'options' => array(
					'gp-large-title' => esc_html__( 'Enabled', 'gauge' ),
					'gp-no-large-title' => esc_html__( 'Disabled', 'gauge' ),
				),
				'default' => 'gp-no-large-title',
			),

			array(
				'id' => 'bbpress_title_bg', 
				'title' => esc_html__( 'bbPress Page Header Background', 'gauge' ),
				'type'      => 'media',			
				'required' => array( 'bbpress_title', '=', 'gp-large-title' ),
				'desc' => esc_html__( 'The background of the page header.', 'gauge' ),
				'default' => '',
			),
			
			array(						
				'id' => 'bbpress_layout',
				'title' => esc_html__( 'bbPress Page Layout', 'gauge' ),					
				'type' => 'image_select',
				'desc' => esc_html__( 'The layout of the page.', 'gauge' ),
				'options' => array(
					'gp-left-sidebar' => array('title' => esc_html__( 'Left Sidebar', 'gauge' ),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
					'gp-right-sidebar' => array('title' => esc_html__( 'Right Sidebar', 'gauge' ),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'gp-no-sidebar' => array('title' => esc_html__( 'No Sidebar', 'gauge' ), 'img' => get_template_directory_uri() . '/lib/framework/images/no-sidebar.png'),
					'gp-fullwidth' => array('title' => esc_html__( 'Fullwidth', 'gauge' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				),	
				'default' => 'gp-no-sidebar',
			),

			array(
				'id'      => 'bbpress_sidebar',
				'type'    => 'select',
				'required' => array( 'bbpress_layout', '=', array( 'gp-left-sidebar', 'gp-right-sidebar' ) ),
				'title'   => esc_html__( 'bbPress Sidebar', 'gauge' ),
				'desc' => esc_html__( 'The sidebar to display.', 'gauge' ),
				'data'    => 'custom_sidebars',
				'default' => 'gp-standard-sidebar',
			),
		
		),
	) );
	
			
	Redux::setSection( $opt_name, array(
		'id' => 'styling',
		'title'     => esc_html__( 'Styling', 'gauge' ),
		'desc' => esc_html__( 'Style your theme.', 'gauge' ),
		'icon' => 'el-icon-brush',
		'fields'    => array(
			
			array( 
				'title' => esc_html__( 'Custom Stylesheet', 'gauge' ),
				'subtitle' => wp_kses( __( 'Use relative URL to your custom stylesheet e.g. <strong>lib/css/custom-style.css</strong>', 'gauge' ), array( 'strong' => array() ) ),
				'desc' => esc_html__( 'Load a custom stylesheet to add your own CSS code.', 'gauge' ),
				'id' => 'custom_stylesheet',
				'type' => 'text',
				'default' => '',
			),
			
			array(
				'id'        => 'custom_css',
				'type'      => 'ace_editor',
				'title'     => esc_html__( 'CSS Code', 'gauge' ),
				'subtitle'  => esc_html__( 'Add your CSS code here - this CSS will not be lost if you update the theme.', 'gauge' ),
				'mode'      => 'css',
				'theme'     => 'monokai',
				'options'   => array( 'minLines' => 50 ),
				'default' => '',
			),
				
		),		
	) );	

            			
		Redux::setSection( $opt_name, array(
			'id' => 'styling-general',
			'title'     => esc_html__( 'General', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-cogs',
			'fields'    => array(
	
				array(
					'id'        => 'page_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Page Background', 'gauge' ),
					'desc'  => esc_html__( 'The page background.', 'gauge' ),
					'output'    => array( 'body' ),
					'required' => array( 'theme_layout', '=', 'gp-boxed-layout'),
					'preview' => false,
					'default'   => array(
						'background-color' => '#eee',
					),
				),

				array(
					'id'        => 'page_content_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Page Content Background', 'gauge' ),
					'desc'  => esc_html__( 'The page content background.', 'gauge' ),
					'output'    => array( '#gp-page-wrapper', '.gp-post-section-header h3', '#reply-title' ),
					'preview' => false,
					'default'   => array(
						'background-color' => '#fff',
					),
				),

				array(
					'id'        => 'general_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'General Typography', 'gauge' ),
					'desc'  => esc_html__( 'The general typography.', 'gauge' ),
					'output'    => array( 'body' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '14px',
						'line-height' => '24px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#000',
					),
				),
																															
				array(
					'id'        => 'general_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'General Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The general link colors.', 'gauge' ),
					'output'    => array( 'a' ),
					'default'   => array(
						'regular'  => '#f84103',
						'hover'    => '#5FA2A5',
						'active'   => false,
					),
				),

				 array(
					'id'        => 'general_highlight_color',
					'type'      => 'color',
					'title'     => esc_html__( 'General Highlight Color', 'gauge' ),
					'desc'  => esc_html__( 'The general highlight color.', 'gauge' ),
					'output'    => array( '.gp-filter-menu', '.gp-user-review-error', '.required', '.gp-theme .woocommerce-info a:hover', '.gp-theme .woocommerce div.product span.price', '.gp-theme .woocommerce div.product p.price', '.gp-theme .woocommerce #content div.product span.price', '.gp-theme .woocommerce #content div.product p.price', '.gp-theme.woocommerce-page div.product span.price', '.gp-theme.woocommerce-page div.product p.price', '.gp-theme.woocommerce-page #content div.product span.price', '.gp-theme.woocommerce-page #content div.product p.price', '.gp-theme .woocommerce ul.products li.product .price', '.gp-theme.woocommerce-page ul.products li.product .price', '.gp-theme .woocommerce .star-rating span:before', '.gp-theme.woocommerce-page .star-rating span:before', '.gp-theme.woocommerce-page p.stars a:hover:before', '.gp-theme.woocommerce-page p.stars a:focus:before', '.gp-theme.woocommerce-page p.stars a.active:before', '.gp-theme .woocommerce .added:before', '.gp-theme.woocommerce-page .added:before', '.gp-theme .woocommerce .order_details li strong', '.gp-theme.woocommerce-page .order_details li strong', '.gp-theme #buddypress div.activity-meta a:hover', '.gp-theme #buddypress div.item-list-tabs ul li.selected a span', '.gp-theme #buddypress div.item-list-tabs ul li.current a span' ),
					'transparent' => false,
					'default'   => '#f84103',
				),

				array(
					'id'        => 'h1_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'H1 Typography', 'gauge' ),
					'desc'  => esc_html__( 'The H1 typography.', 'gauge' ),
					'output'    => array( 'h1' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '48px',
						'line-height' => '60px',
						'font-family' => 'Arvo',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
					),
				),

				array(
					'id'        => 'h2_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'H2 Typography', 'gauge' ),
					'desc'  => esc_html__( 'The H2 typography.', 'gauge' ),
					'output'    => array( 'h2' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '36px',
						'line-height' => '48px',
						'font-family' => 'Arvo',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
					),
				),

				array(
					'id'        => 'h3_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'H3 Typography', 'gauge' ),
					'desc'  => esc_html__( 'The H3 typography.', 'gauge' ),
					'output'    => array( 'h3', '.blog-small-size section .loop-title', '#tab-description h2', '.woocommerce #comments h2', '.woocommerce #reviews h3', '.woocommerce .related h2', '.woocommerce-checkout .woocommerce h2', '.woocommerce-checkout .woocommerce h3' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '24px',
						'line-height' => '36px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
					),
				),

				array(
					'id'        => 'h4_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'H4 Typography', 'gauge' ),
					'desc'  => esc_html__( 'The H4 typography.', 'gauge' ),
					'output'    => array( 'h4' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '18px',
						'line-height' => '30px',
						'font-family' => 'Arvo',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
					),
				),

				array(
					'id'        => 'h5_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'H5 Typography', 'gauge' ),
					'desc'  => esc_html__( 'The H5 typography.', 'gauge' ),
					'output'    => array( 'h5' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '16px',
						'line-height' => '24px',
						'font-family' => 'Arvo',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
					),
				),

				array(
					'id'        => 'h6_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'H6 Typography', 'gauge' ),
					'desc'  => esc_html__( 'The H6 typography.', 'gauge' ),
					'output'    => array( 'h6' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '14px',
						'line-height' => '22px',
						'font-family' => 'Arvo',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
					),
				),
													
				array(
					'id'        => 'general_divider',
					'type'      => 'border',
					'title'     => esc_html__( 'General Divider Color', 'gauge' ),
					'desc'  => esc_html__( 'The general divider color.', 'gauge' ),
					'output'    => array( '.gp-entry-header .gp-entry-meta', '#gp-review-content-wrapper .gp-subtitle', '.gp-post-section-header-line', '.gp-element-title-line', '#comments ol.commentlist li .comment_container', '.gp-portfolio-filters', '.gp-tablet-portrait #gp-sidebar', '.gp-mobile #gp-sidebar', '#gp-review-summary', '.gp-login-content', '.gp-loop-divider:before, section.sticky' ),   
					'left' => false,
					'right' => false,    
					'default'   => array(
						'border-color' => '#eee',
						'border-width' => '1px',
						'border-style' => 'solid',
					),
				),
                                                                                      
				array(
					'id'        => 'slide_caption_title_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Slide Caption Title Color', 'gauge' ),
					'desc'  => esc_html__( 'The slide caption title color.', 'gauge' ),
					'output'    => array( '.gp-slide-caption-title', '.gp-featured-caption-title' ),
					'transparent' => false,
					'default'  => '#fff',
				),
									
				array(
					'id'        => 'slide_caption_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Slide Caption Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The slide caption text color.', 'gauge' ),
					'output'    => array( '.gp-slide-caption-text', '.gp-featured-caption-text' ),
					'transparent' => false,
					'default'   => '#fff',
				),
		  
			),
					
		) );	

			                   			
		Redux::setSection( $opt_name, array(
			'id' => 'styling-top-header',
			'title'     => esc_html__( 'Top Header', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-website',
			'fields'    => array(
							
				array(
					'id'        => 'top_header_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Background', 'gauge' ),
					'desc'  => esc_html__( 'The top header background.', 'gauge' ),
					'output'    => array( '#gp-top-header' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#000',
					),
				),
				
				array(
					'id'        => 'top_header_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Border', 'gauge' ),
					'desc'  => esc_html__( 'The top header border.', 'gauge' ),
					'output'    => array( '#gp-top-header' ),
					'left'     => false,
					'right' => false,
					'top' => false,      
					'default'   => array(
						'border-color' => '#292929',
						'border-bottom' => '1px',
						'border-style' => 'solid',
					),
				),
									
				array(
					'id'        => 'top_header_left_nav_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Left Navigation Typography', 'gauge' ),
					'desc'  => esc_html__( 'The top header left navigation typography.', 'gauge' ),
					'output'    => array( '#gp-left-top-nav .menu > li', '#gp-left-top-nav .menu > li > a' ),
					'google'    => true,
					'text-align' => false,
					'line-height' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '12px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#fff',
					),
				),

				array(
					'id'        => 'top_header_left_nav_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Left Navigation Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The top header left navigation link colors.', 'gauge' ),
					'output'    => array( '#gp-left-top-nav .menu > li > a:not(.gp-notification-counter)' ),
					'default'   => array(
						'regular'         => '#fff',
						'hover'     => '#f84103',
						'active' => false,
					),
				),

				array(
					'id'        => 'top_header_social_icons_size',
					'type'      => 'typography',
					'title'     => esc_html__( 'Social Icons Size', 'gauge' ),
					'desc'  => esc_html__( 'The social icon size.', 'gauge' ),
					'output'    => array( '#gp-top-header .gp-social-icons a' ),
					'color'         => false,
					'font-family'   => false,
					'font-weight'   => false,
					'font-style' => false,
					'subsets'       => false,
					'text-align'    => false,
					'line-height'   => false, 
					'preview' => false,
					'default'   => array(
						'font-size'     => '14px',
					),
				), 
				
				array(
					'id'        => 'top_header_social_icons_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Social Icons Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The social icon link colors.', 'gauge' ),
					'output'    => array( '#gp-top-header .gp-social-icons a' ),
					'default'   => array(
						'regular'   => '#555555',
						'hover'     => '#eeeeee',
						'active' => false,
					),
				), 
				
				array(
					'id'        => 'top_header_cart_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Cart Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The cart link colors.', 'gauge' ),
					'output'    => array( '#gp-top-header #gp-cart-button' ),
					'default'   => array(
						'regular'   => '#fff',
						'hover'     => '#f84103',
						'active' => false,
					),
				),  
				
				array(
					'id'        => 'top_header_right_nav_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Right Navigation Typography', 'gauge' ),
					'desc'  => esc_html__( 'The top header right navigation typography.', 'gauge' ),
					'output'    => array( '#gp-right-top-nav .menu > li', ' #gp-right-top-nav .menu > li a' ),
					'color'         => false,
					'text-align'    => false, 
					'line-height' => false,
					'preview' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'     => '12px',
						'font-family'   => 'Open Sans',
						'font-weight'   => '400',
						'subsets'       => 'latin',
					),
				), 
				
				array(
					'id'        => 'top_header_right_nav_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Right Navigation Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The top header right navigation typography.', 'gauge' ),
					'output'    => array( '#gp-right-top-nav .menu > li > a:not(.gp-notification-counter)' ),
					'default'   => array(
						'regular'         => '#f84103',
						'hover'     => '#fff',
						'active' => false,
					),
				), 
									
			),
					
		) );	

			
		Redux::setSection( $opt_name, array(
			'id' => 'styling-main-header',
			'title'     => esc_html__( 'Main Header', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-website',
			'fields'    => array(                                          
							
				array(
					'id'        => 'main_header_large_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Large Background', 'gauge' ),
					'desc'  => esc_html__( 'The large main header background.', 'gauge' ),
					'output'    => array( '#gp-main-header' ),
					'default'   => array(
						'background-color' => 'transparent',
					),
				),

				array(
					'id'        => 'main_header_small_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Small Background', 'gauge' ),
					'desc'  => esc_html__( 'The small main header background.', 'gauge' ),
					'output'    => array( '.gp-desktop #gp-main-header.gp-header-small', '.gp-desktop.gp-header-noresize #gp-main-header.header-large', '.gp-no-large-title #gp-main-header' ),
					'default'   => array(
						'background-color' => '#1c1c1c',
					),
				),
									
				array(
					'id'        => 'main_header_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Border', 'gauge' ),
					'desc'  => esc_html__( 'The main header border.', 'gauge' ),
					'output'    => array( '#gp-main-header' ),
					'left'     => false,
					'right' => false,
					'top' => false,
					'default'   => array(
						'border-color' => '',
						'border-bottom' => '',
						'border-style' => '',
					),
				),

				array(
					'id' => 'main_header_height',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Height', 'gauge' ),
					'desc' => esc_html__( 'The main header height.', 'gauge' ),
					'width' => false,
					'mode' => array( 
						'width' => false,
						'height' => 'height',
					),
					'default'           => array(
						'height'    => '125px',
					)
				),
												
				array(
					'id'        => 'main_header_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Navigation Typography', 'gauge' ),
					'desc'  => esc_html__( 'The main header navigation typography.', 'gauge' ),
					'output'    => array( '#gp-main-nav .menu > li' ),
					'google'    => true,
					'text-align' => false,
					'line-height' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'     => '14px',
						'font-family'   => 'Open Sans',
						'font-weight'   => '400',
						'subsets'       => 'latin',
						'color' => '#fff',
					),
				),

				array(
					'id'        => 'main_header_nav_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Navigation Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The main header navigation link colors.', 'gauge' ),
					'output'    => array( '#gp-main-nav .menu > li > a' ),
					'default'   => array(
						'regular'         => '#fff',
						'hover'     => '#f84103',
						'active' => false,
					),
				),

				array(
					'id'        => 'main_header_dropdown_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Dropdown Menu Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu background color.', 'gauge' ),
					'output'    => array( '.gp-nav .sub-menu', '.gp-nav .menu li .gp-menu-tabs li:hover, .gp-nav .menu li .gp-menu-tabs li.gp-selected' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f1f1f1',
					),
				),

				array(
					'id'        => 'main_header_dropdown_pointer',
					'type'      => 'color',                        
					'title'     => esc_html__( 'Dropdown Menu Pointer', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu pointer color.', 'gauge' ),
					'output'    => array( '.gp-nav .menu > li.menu-item-has-children > a:hover:after', '.gp-nav .menu > li.menu-item-has-children:hover > a:after', '.gp-nav .menu > li.tab-content-menu > a:hover:after', '.gp-nav .menu > li.tab-content-menu:hover > a:after', '.gp-nav .menu > li.content-menu > a:hover:after', '.gp-nav .menu > li.content-menu:hover > a:after', '#gp-dropdowncart .menu > li:hover a:after' ),
					'default'  => '#f1f1f1',
				),
				
				array(
					'id'        => 'main_header_dropdown_bg_hover',
					'type'      => 'background',
					'title'     => esc_html__( 'Dropdown Menu Background Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu background hover color.', 'gauge' ),
					'output'    => array( '.gp-nav .sub-menu li a:hover' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f1f1f1',
					),
				),
				
				array(
					'id'        => 'main_header_dropdown_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Dropdown Menu Border', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu border.', 'gauge' ),
					'output'    => array( '.gp-nav .sub-menu li', '#gp-dropdowncart .total', '#gp-dropdowncart .buttons' ),
					'left' => false,
					'right' => false,
					'bottom' => false,
					'default'   => array(
						'border-top' => '1px',
						'border-color' => '#dddddd',
						'border-style' => 'solid',
					),
				),

				array(
					'id'        => 'main_header_dropdown_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Dropdown Menu Typography', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu typography.', 'gauge' ),
					'output'    => array( '.gp-nav .sub-menu li', '.gp-nav .sub-menu a' ),
					'google'    => true,
					'text-align' => false,
					'line-height' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'     => '14px',
						'font-family'   => 'Open Sans',
						'font-weight'   => '400',
						'subsets'       => 'latin',
						'color' => '#000',
					),
				),

				array(
					'id'        => 'main_header_dropdown_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Dropdown Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu link colors.', 'gauge' ),
					'output'    => array( '.gp-nav .sub-menu li a' ),
					'default'   => array(
						'regular'         => '#000',
						'hover'     => '#f84103',
						'active' => false,
					),
				),

				array(
					'id'        => 'main_header_megamenu_header',
					'type'      => 'color',                        
					'title'     => esc_html__( 'Mega Menu Header Color', 'gauge' ),
					'desc'  => esc_html__( 'The mega menu header color.', 'gauge' ),
					'output'    => array( '.gp-nav .megamenu > .sub-menu > li > a' ),
					'transparent' => false,
					'default'  => '#f84103',
				),

				array(
					'id'        => 'main_header_megamenu_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Mega Menu Border', 'gauge' ),
					'desc'  => esc_html__( 'The mega menu border.', 'gauge' ),
					'output'    => array( '.gp-nav .megamenu > .sub-menu > li' ),
					'top' => false,
					'right' => false,
					'bottom' => false,
					'default'   => array(
						'border-left' => '1px',
						'border-color' => '#dddddd',
						'border-style' => 'solid',
					),
				),
																															 
				array(
					'id'        => 'main_header_dropdown_icon',
					'type'      => 'color',
					'title'     => esc_html__( 'Dropdown Icon Color', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown icon color.', 'gauge' ),
					'output'    => array( '.gp-nav .gp-dropdown-icon' ),
					'transparent' => false,
					'default'   => '#f84103',
				),
				
				array(
					'id'        => 'menu_tabs',
					'type'      => 'background',
					'title'     => esc_html__( 'Menu Tabs Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The menu tabs background color.', 'gauge' ),
					'output'    => array( '.gp-menu-tabs' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#333',
					),
				),

				array(
					'id'        => 'menu_tabs_link',
					'type'      => 'color',
					'title'     => esc_html__( 'Menu Tabs Link Color', 'gauge' ),
					'desc'  => esc_html__( 'The menu tabs link color.', 'gauge' ),
					'output'    => array( '.gp-nav .menu li .gp-menu-tabs li' ),
					'default'    => '#fff',
				),

				 array(
					'id'        => 'menu_tabs_link_hover',
					'type'      => 'color',
					'title'     => esc_html__( 'Menu Tabs Link Hover/Selected Color', 'gauge' ),
					'desc'  => esc_html__( 'The menu tabs link hover/selected color.', 'gauge' ),
					'output'    => array( '.gp-nav .menu li .gp-menu-tabs li:hover,.gp-nav .menu li .gp-menu-tabs li.gp-selected' ),
					'default'    => '#333',
				),
									
									 
				 array(
					'id'        => 'main_header_search_input_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Search Input Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The search input background color.', 'gauge' ),
					'output'    => array( '#gp-main-header .gp-search-bar' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#eee',
					),
				),
				
				array(
					'id'        => 'main_header_search_input_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Search Input Border', 'gauge' ),
					'desc'  => esc_html__( 'The search input border.', 'gauge' ),
					'output'    => array( '#gp-main-header .gp-search-bar' ),      
					'default'   => array(
						'border-color' => '#fff',
						'border-width' => '1px',
						'border-style' => 'solid',
					),
				),
									
				array(
					'id'        => 'main_header_search_input_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Search Input Typography', 'gauge' ),
					'desc'  => esc_html__( 'The search input typography.', 'gauge' ),
					'output'    => array( '#gp-main-header .gp-search-bar' ),
					'text-align' => false,
					'line-height' => false,
					'subsets' => false,
					'font-weight' => false,
					'font-style' => false,
					'font-family' => false,
					'default'   => array(
						'font-size'   => '12px',
						'color'       => '#000',
					),
				),

				array(
					'id'        => 'main_header_search_button_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Search Button Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The search button background color.', 'gauge' ),
					'output'    => array( '#gp-main-header .gp-search-submit' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => 'transparent',
					),
				),

				 array(
					'id'        => 'main_header_search_button_bg_hover',
					'type'      => 'background',
					'title'     => esc_html__( 'Search Button Background Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The search button background hover color.', 'gauge' ),
					'output'    => array( '#gp-main-header .gp-search-submit:hover' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => 'transparent',
					),
				),
								   
				array(
					'id'        => 'main_header_search_button_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Search Button Border', 'gauge' ),
					'desc'  => esc_html__( 'The search button border.', 'gauge' ),
					'output'    => array( '#gp-main-header .gp-search-submit' ),    
					'default'   => array(
						'border-color' => '',
						'border-width' => '',
						'border-style' => 'solid',
					),
				),
									
				array(
					'id'        => 'main_header_search_button_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Search Button Typography', 'gauge' ),
					'desc'  => esc_html__( 'The button typography.', 'gauge' ),
					'output'    => array( '#gp-main-header .gp-search-submit' ),
					'text-align' => false,
					'line-height' => false,
					'subsets' => false,
					'font-weight' => false,
					'font-style' => false,
					'font-family' => false,
					'default'   => array(
						'font-size'   => '12px',
						'color'       => '#f84103',
					),
				),

				array(
					'id'        => 'main_header_search_button_typography_hover',
					'type'      => 'color',
					'title'     => esc_html__( 'Search Button Typography Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The button typography hover color.', 'gauge' ),
					'output'    => array( '#gp-main-header .gp-search-submit:hover' ),
					'default' => '#f84103',
				),
								   
			)
				
		) );	


		Redux::setSection( $opt_name, array(
			'id' => 'styling-mobile-navigation',
			'title'     => esc_html__( 'Mobile Navigation', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-lines',
			'fields'    => array(                                          
																										 
				array(
					'id'        => 'mobile_nav_button',
					'type'      => 'color',
					'title'     => esc_html__( 'Button', 'gauge' ),
					'desc'  => esc_html__( 'The mobile navigation button color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav-button' ),
					'transparent' => false,
					'default'   => '#f84103',
				),
												
				array(
					'id'        => 'mobile_nav_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Container Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The mobile navigation background color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav' ),
				   'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#000',
					),
				),

				array(
					'id'        => 'mobile_close_button_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Close Button Background', 'gauge' ),
					'desc'  => esc_html__( 'The close button background.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav-close-button' ),
				   'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f84103',
					),
				),
			
				array(
					'id'        => 'mobile_nav_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu text color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav li' ),
					'default' => '#fff',
				),

				array(
					'id'        => 'mobile_nav_top_level_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Top Level Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu link colors.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .menu > li > a' ),
					'default'   => array(
						'regular'         => '#f84103',
						'hover'     => '#fff',
						'active' => false,
					),
				),

				array(
					'id'        => 'mobile_nav_submenu_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Submenu Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu link.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .sub-menu li a' ),
					'default'   => array(
						'regular'         => '#fff',
						'hover'     => '#f84103',
						'active' => false,
					),
				),
				
				array(
					'id'        => 'mobile_nav_megamenu_header',
					'type'      => 'color',                        
					'title'     => esc_html__( 'Mega Menu Header Color', 'gauge' ),
					'desc'  => esc_html__( 'The mega menu header color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .megamenu > .sub-menu > li > a' ),
					'transparent' => false,
					'default'  => '#f84103',
				),

				array(
					'id'        => 'mobile_nav_bg_hover',
					'type'      => 'background',
					'title'     => esc_html__( 'Link Background Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu background hover color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav li a:hover' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#000',
					),
				),
				
				array(
					'id'        => 'mobile_nav_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Link Border', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown menu border.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav li' ),
					'left' => false,
					'right' => false,
					'bottom' => false,
					'default'   => array(
						'border-top' => '1px',
						'border-color' => '#333333',
						'border-style' => 'solid',
					),
				),

				array(
					'id'        => 'mobile_nav_dropdown_button_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Dropdown Button Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown button background color.', 'gauge' ),
					'output'    => array( '.gp-mobile-dropdown-icon' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#1d1d1d',
					),
				),

				array(
					'id'        => 'mobile_nav_dropdown_button_bg_selected',
					'type'      => 'background',
					'title'     => esc_html__( 'Dropdown Button Selected Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The dropdown button selected background color.', 'gauge' ),
					'output'    => array( 'li.gp-active > .gp-mobile-dropdown-icon' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#333',
					),
				),
														 
				 array(
					'id'        => 'mobile_nav_search_input_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Search Input Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The search input background color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .gp-search-bar' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#eee',
					),
				),
				
				array(
					'id'        => 'mobile_nav_search_input_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Search Input Border', 'gauge' ),
					'desc'  => esc_html__( 'The search input border.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .gp-search-bar' ),      
					'default'   => array(
						'border-color' => '#fff',
						'border-width' => '1px',
						'border-style' => 'solid',
					),
				),
									
				array(
					'id'        => 'mobile_nav_search_input_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Search Input Typography', 'gauge' ),
					'desc'  => esc_html__( 'The search input typography.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .gp-search-bar' ),
				 'text-align' => false,
					'line-height' => false,
					'subsets' => false,
					'font-weight' => false,
					'font-style' => false,
					'font-family' => false,
					'default'   => array(
						'font-size'   => '13px',
						'color'       => '#000',
					),
				),

				array(
					'id'        => 'mobile_nav_search_button_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Search Button Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The search button background color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .gp-search-submit' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => 'transparent',
					),
				),

				 array(
					'id'        => 'mobile_nav_search_button_bg_hover',
					'type'      => 'background',
					'title'     => esc_html__( 'Search Button Background Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The search button background hover color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .gp-search-submit:hover' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => 'transparent',
					),
				),
								   
				array(
					'id'        => 'mobile_nav_search_button_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Search Button Border', 'gauge' ),
					'desc'  => esc_html__( 'The search button border.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .gp-search-submit' ),    
					'default'   => array(
						'border-color' => '',
						'border-width' => '',
						'border-style' => 'solid',
					),
				),
									
				array(
					'id'        => 'mobile_nav_search_button_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Search Button Typography', 'gauge' ),
					'desc'  => esc_html__( 'The button typography.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .gp-search-submit' ),
					'google'    => true,
					'text-align' => false,
					'line-height' => false,
					'subsets' => false,
					'font-weight' => false,
					'font-style' => false,
					'font-family' => false,
					'default'   => array(
						'font-size'   => '13px',
						'color'       => '#f84103',
					),
				),

				array(
					'id'        => 'mobile_nav_search_button_typography_hover',
					'type'      => 'color',
					'title'     => esc_html__( 'Search Button Typography Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The button typography hover color.', 'gauge' ),
					'output'    => array( '#gp-mobile-nav .gp-search-submit:hover' ),
					'default' => '#f84103',
				),
							 
			)
				
		) );	
 
 
		Redux::setSection( $opt_name, array(
			'id' => 'styling-page-header',
			'title'     => esc_html__( 'Page Header', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-website',
			'fields'    => array(   
						   
				array(
					'id'        => 'title_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Page Header Background', 'gauge' ),
					'desc'  => esc_html__( 'The page header background properties.', 'gauge' ),
					'output'    => array( '.gp-page-header' ),
					'preview' => false,
					'default'   => array(
						'background-color' => '#1c1c1c',
						'background-repeat' => 'no-repeat',
						'background-size' => 'cover',
						'background-attachment' => 'scroll',
						'background-position' => 'center center'
					),
				),

												
				array(  
					'id' => 'title_bg_top_gradient_overlay',
					'title' => esc_html__( 'Page Header Top Gradient Overlay', 'gauge' ),
					'type' => 'button_set',
					'desc' => esc_html__( 'Add a semi transparent background gradient overlay to the top of the header.', 'gauge' ),
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gauge' ),
						'disabled' => esc_html__( 'Disabled', 'gauge' ),
					),
					'default' => 'enabled',
				),

				array(  
					'id' => 'title_bg_overlay',
					'title' => esc_html__( 'Page Header Background Overlay', 'gauge' ),
					'type' => 'button_set',
					'desc' => esc_html__( 'Add a semi transparent background overlay to the whole header.', 'gauge' ),
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gauge' ),
						'disabled' => esc_html__( 'Disabled', 'gauge' ),
					),
					'default' => 'enabled',
				),

				array(
					'id'        => 'title_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Page Header Typography', 'gauge' ),
					'desc'  => esc_html__( 'The page header page header typography.', 'gauge' ),
					'output'    => array( '.gp-page-header .gp-entry-title', '.gp-page-header .gp-entry-title a' ),
					'google'    => true,
					'text-align' => false,
					'font-family' => false,
					'font-weight' => false,
					'font-style' => false,
					'subsets'     => false,
					'default'   => array(
						'font-size'   => '46px',
						'line-height' => '52px',
						'color' => '#fff',
					),
				),
		
				array(
					'id'        => 'subtitle_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Page Header Subtitle Typography', 'gauge' ),
					'desc'  => esc_html__( 'The page header subtitle typography.', 'gauge' ),
					'output'    => array( '.gp-page-header .gp-subtitle' ),
					'google'    => true,
					'text-align' => false,
					'font-family' => false,
					'font-weight' => false,
					'font-style' => false,
					'subsets'     => false,
					'default'   => array(
						'font-size'   => '15px',
						'line-height' => '21px',
						'color' => '#fff',
					),
				),

				array(
					'id'        => 'subtitle_divider',
					'type'      => 'border',
					'title'     => esc_html__( 'Subtitle Divider Color', 'gauge' ),
					'desc'  => esc_html__( 'The subtitle divider color.', 'gauge' ),
					'output'    => array( '.gp-page-header .gp-entry-title.gp-has-subtitle:after' ),
					'left'     => false,
					'right' => false,
					'bottom' => false,   
					'default'   => array(
						'border-color' => '#fff',
						'border-top' => '1px',
						'border-style' => 'solid',
					),
				),
												
				array( 
					'id' => 'title_padding',
					'title' => esc_html__( 'Page Header Padding', 'gauge' ),
					'type' => 'spacing',
					'mode' => 'padding',
					'units' => 'px',
					'left' => false,
					'right' => false,
					'desc' => esc_html__( 'The padding of the page header.', 'gauge' ),
					'default'       => array(
						'padding-top'    => '155px',
						'padding-bottom' => '50px',
					),						
				 ),
		
				array( 
					'id' => 'title_parallax',
					'title' => esc_html__( 'Page Header Parallax Effect', 'gauge' ),
					'type' => 'button_set',
					'desc' => esc_html__( 'The page header background image moves as you scroll up and down the page.', 'gauge' ),
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gauge' ),
						'disabled' => esc_html__( 'Disabled', 'gauge' ),
					),
					'default' => 'disabled',
				),
		
			 )
					
		) );			     
			

		Redux::setSection( $opt_name, array(
			'id' => 'styling-posts-pages',
			'title'     => esc_html__( 'Posts/Pages', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-pencil',
			'fields'    => array(

				array(
					'id'        => 'post_title_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Standard Title Typography', 'gauge' ),
					'desc'  => esc_html__( 'The standard title typography.', 'gauge' ),
					'output'    => array( '.gp-entry-title', '.woocommerce .page-title', '.woocommerce div.product .entry-title.product_title' ),
					'google'    => true,
					'text-align' => false,
					'font-family' => false,
					'font-weight' => false,
					'font-style' => false,
					'subsets'     => false,
					'default'   => array(
						'font-size'   => '36px',
						'line-height' => '48px',
						'color' => '#000',
					),
				),

				array(
					'id'        => 'post_subtitle_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Subtitle Typography', 'gauge' ),
					'desc'  => esc_html__( 'The standard subtitle typography.', 'gauge' ),
					'output'    => array( '.gp-subtitle' ),
					'text-align' => false,
					'font-family' => false,
					'font-weight' => false,
					'font-style' => false,
					'subsets'     => false,
					'default'   => array(
						'font-size'   => '20px',
						'line-height' => '32px',
						'color' => '#888',
					),
				),

				array(
					'id'        => 'post_secondary_title_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Secondary Title Color', 'gauge' ),
					'desc'  => esc_html__( 'The secondary title color (related posts and comments) .', 'gauge' ),
					'output'    => array( '.gp-post-section-header h3', '.woocommerce ul.products li.product h3', '.woocommerce ul.products li.product .woocommerce-loop-product__title' ),
					'transparent' => false,
					'default'   => '#000',
				),
																			
				array(
					'id'        => 'post_meta_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Post Meta Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The post meta text color.', 'gauge' ),
					'output'    => array( '.gp-entry-meta', '.gp-entry-meta a', '.wp-caption-text', '#gp-breadcrumbs', '#gp-breadcrumbs a', '.gp-theme.woocommerce-page .product_meta', '.gp-theme.woocommerce-page .product_meta a' ),
					'transparent' => false,
					'default'   => '#B3B3B1',
				),
				
				array(
					'id'        => 'post_tags_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Post Tags Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The post tags text color.', 'gauge' ),
					'output'    => array( '.gp-entry-tags', '.gp-entry-tags a' ),
					'transparent' => false,
					'default'   => '#B3B3B1',
				),                          

				array(
					'id'        => 'author_info_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Author Info Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The author info background color.', 'gauge' ),
					'output'    => array( '.gp-author-info' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f8f8f8',
					),
				),

				array(
					'id'        => 'author_info_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Author Info Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The author info text color.', 'gauge' ),
					'output'    => array( '.gp-author-info' ),
					'transparent' => false,
					'default'   => '#000',
				),
									
				array(
					'id'        => 'author_info_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Author Info Border', 'gauge' ),
					'desc'  => esc_html__( 'The author info border.', 'gauge' ),
					'output'    => array( '.gp-author-info' ), 
					'all' => false,
					'left'     => false,
					'right' => false,
					'top' => false,        
					'default'   => array(
						'border-color' => '#eee',
						'border-bottom' => '1px',
						'border-style' => 'solid',
					),
				),
														 
				array(
					'id'        => 'blockquote_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Blockquote Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The blockquote background color.', 'gauge' ),
					'output'    => array( 'blockquote' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f84103',
					),
				),
				
				array(
					'id'        => 'blockquote_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Blockquote Typography', 'gauge' ),
					'desc'  => esc_html__( 'The blockquote typography.', 'gauge' ),
					'output'    => array( 'blockquote', 'blockquote a', 'blockquote a:hover' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '16px',
						'line-height' => '26px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#fff',
					),
				),
															 
																				
			)
				
		) );	
                

		Redux::setSection( $opt_name, array(
			'id' => 'styling-categories',
			'title'     => esc_html__( 'Categories', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-folder-open',
			'fields'    => array(

				array(
					'id'        => 'cat_standard_post_title_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Standard Post Title Typography', 'gauge' ),
					'desc'  => esc_html__( 'The standard post title typography.', 'gauge' ),
					'output'    => array( '.gp-loop-title' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'default'   => array(
						'font-size'   => '18px',
						'line-height' => '26px',
						'font-family' => 'Arvo',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
					),
				),
				
				array(
					'id'        => 'cat_large_post_title_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Large Post Title Typography', 'gauge' ),
					'desc'  => esc_html__( 'The large post title typography.', 'gauge' ),
					'output'    => array( '.gp-blog-large .gp-loop-title' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'font-family' => false,
					'font-weight' => false,
					'font-style' => false,
					'subsets'     => false,
					'default'   => array(
						'font-size'   => '30px',
						'line-height' => '42px',
					),
				),
			
				array(
					'id'        => 'cat_standard_post_title_link_color',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Post Title Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The post title link colors.', 'gauge' ),
					'output'    => array( '.gp-loop-title a', '.gp-edit-review-form button', '.gp-delete-review-form button' ),
					'default'   => array(
						'regular'       => '#f84103',
						'hover'       => '#000',
						'active'       => false,
					),
				),
				
				array(
					'id'        => 'cat_standard_post_meta_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Post Meta Color', 'gauge' ),
					'desc'  => esc_html__( 'The post meta color.', 'gauge' ),
					'output'    => array( '.gp-loop-meta', '.gp-loop-meta a' ),
					'transparent' => false,
					'default'  => '#B3B3B1',
				),				

				array(
					'id'        => 'cat_cats_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Categories Box Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The categories box background color.', 'gauge' ),
					'output'    => array( '.gp-entry-cats a', '.gp-loop-cats a' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#000',
					),
				),
								
				array(
					'id'        => 'cat_cats_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Categories Box Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The categories box text color.', 'gauge' ),
					'output'    => array( '.gp-entry-cats a', '.gp-entry-cats a:hover', '.gp-loop-cats a', '.gp-loop-cats a:hover' ),
					'transparent' => false,
					'default' => '#fff',
				),
			
				array(
					'id'        => 'cat_standard_post_tags_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Post Tags Color', 'gauge' ),
					'desc'  => esc_html__( 'The post tags color.', 'gauge' ),
					'output'    => array( '.gp-loop-tags', '.gp-loop-tags a' ),
					'transparent' => false,
					'default' => '#B3B3B1',
				),

				array(
					'id'        => 'cat_masonry_post_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Masonry Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The masonry background color.', 'gauge' ),
					'output'    => array( '.gp-blog-masonry section' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#1c1c1c',
					),
				),

				array(
					'id'        => 'cat_masonry_post_title_link_color',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Masonry Post Title Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The masonry post title link colors.', 'gauge' ),
					'output'    => array( '.gp-blog-masonry .gp-loop-title a' ),
					'default'   => array(
						'regular'       => '#f84103',
						'hover'       => '#fff',
						'active'       => false,
					),
				),
				
				array(
					'id'        => 'cat_masonry_post_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Masonry Post Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The masonry post text color.', 'gauge' ),
					'output'    => array( '.gp-blog-masonry .gp-loop-content' ),
					'transparent' => false,
					'default' => '#fff',
				),
				
				array(
					'id'        => 'cat_masonry_post_meta_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Masonry Post Meta Color', 'gauge' ),
					'desc'  => esc_html__( 'The post meta color.', 'gauge' ),
					'output'    => array( '.blog-masonry .entry-meta', '.blog-masonry .entry-meta a' ),
					'transparent' => false,
					'default' => '#B3B3B1',
				),
				
				array(
					'id'        => 'cat_masonry_post_tags_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Masonry Post Tags Color', 'gauge' ),
					'desc'  => esc_html__( 'The post tags color.', 'gauge' ),
					'output'    => array( '.gp-blog-masonry .gp-loop-tags', '.gp-blog-masonry .gp-loop-tags a' ),
					'transparent' => false,
					'default'   => '#B3B3B1',
				),
				
				array(
					'id'        => 'cat_masonry_post_format_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Masonry Post Format Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The masonry post format background color.', 'gauge' ),
					'output'    => array( '.gp-blog-masonry section:before', '.gp-blog-masonry .gp-post-thumbnail:before' ),               
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#1c1c1c',
					),
				),

				array(
					'id'        => 'cat_masonry_post_format_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Masonry Post Format Color', 'gauge' ),
					'desc'  => esc_html__( 'The masonry post format color.', 'gauge' ),
					'output'    => array( '.gp-blog-masonry section:before', '.gp-blog-masonry .gp-post-thumbnail:before' ),
					'transparent' => false,
					'default' => '#fff',
				),
				
				array(
					'id'        => 'cat_title_over_thumbnail_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Title Over Thumbnail Typography', 'gauge' ),
					'desc'  => esc_html__( 'The title over thumbnail typography.', 'gauge' ),
					'output'    => array( '.gp-post-thumbnail .gp-loop-title' ),
					'google'    => true,
					'text-align' => false,
					'color' => false,
					'font-family' => false,
					'font-weight' => false,
					'font-style' => false,
					'subsets'     => false,
					'default'   => array(
						'font-size'   => '16px',
						'line-height' => '26px',
					),
				),
									
				array(
					'id'        => 'cat_title_over_thumbnail_link_color',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Title Over Thumbnail Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The title over thumbnail link colors.', 'gauge' ),
					'output'    => array( '.gp-post-thumbnail .gp-loop-title', '.gp-ranking-wrapper .gp-loop-title a' ),
					'default'   => array(
						'regular'       => '#fff',
						'hover'       => '#fff',
						'active'       => false,
					),
				),

				array(
					'id'        => 'hub_award_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Hub Award Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The hub award background color.', 'gauge' ),
					'output'    => array( '.gp-hub-award' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f84103',
					),
				),
														
				array(
					'id'        => 'pagination_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Pagination Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The pagination background color.', 'gauge' ),
					'output'    => array( 'ul.page-numbers .page-numbers' ),                        'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#333333',
					),
				),

				array(
					'id'        => 'pagination_bg_hover',
					'type'      => 'background',
					'title'     => esc_html__( 'Pagination Hover/Selected Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The pagination hover/selected background color.', 'gauge' ),
					'output'    => array( 'ul.page-numbers .page-numbers:hover', 'ul.page-numbers .page-numbers.current', 'ul.page-numbers > span.page-numbers' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#F84103',
					),
				),

				array(
					'id'        => 'pagination_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Pagination Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The pagination text color.', 'gauge' ),
					'output'    => array( 'ul.page-numbers .page-numbers' ),
					'transparent' => false,
					'default' => '#fff',
				),
																	
			),	
				
		) );	
        
            				
		Redux::setSection( $opt_name, array(
			'id' => 'styling-hub-template',
			'title'     => esc_html__( 'Hub Template', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-globe',
			'fields'    => array(
		
				array(
					'id'        => 'hub_header_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Hub Header Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The hub header text color.', 'gauge' ),
					'output'    => array( '.gp-hub-header', '.gp-hub-header a', '.gp-hub-header .gp-entry-meta', '.gp-hub-header .gp-entry-meta a' ),      
					'transparent' => false,
					'default'   => '#fff',
				),

				array( 
					'id' => 'hub_affiliate_button_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Affiliate Button Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The affiliate button background color.', 'gauge' ),
					'output'    => array( '#gp-affiliate-button' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#00D6EC',
					),
				),

				array( 
					'id' => 'hub_affiliate_button_bg_hover',
					'type'      => 'background',
					'title'     => esc_html__( 'Affiliate Button Background Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The affiliate button background hover color.', 'gauge' ),
					'output'    => array( '#gp-affiliate-button:hover' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#F84103',
					),
				),
		
				array(
					'id'        => 'hub_affiliate_button_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Affiliate Button Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The affiliate button text color.', 'gauge' ),
					'output'    => array( '#gp-affiliate-button' ),      
					'transparent' => false,
					'default'   => '#fff',
				),
													
				array(
					'id'        => 'hub_tabs_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Hub Tabs Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The hub tabs background color.', 'gauge' ),
					'output'    => array( '#gp-hub-tabs' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#1c1c1c',
					),
				),
			
				array(
					'id'        => 'hub_tabs_top_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Hub Tabs Top Border', 'gauge' ),
					'desc'  => esc_html__( 'The hub tabs top border.', 'gauge' ),
					'output'    => array( '#gp-hub-tabs' ), 
					'all' => false,
					'left'     => false,
					'right' => false,
					'bottom' => false,        
					'default'   => array(
						'border-color' => '#f84103',
						'border-top' => '2px',
						'border-style' => 'solid',
					),
				),

				array(
					'id'        => 'hub_tabs_link_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Hub Tabs Link Border', 'gauge' ),
					'desc'  => esc_html__( 'The hub tabs link border.', 'gauge' ),
					'output'    => array( '#gp-hub-tabs li' ),  
					'top' => false,    
					'default'   => array(
						'border-color' => '#323232',
						'border-width' => '1px',
						'border-style' => 'solid',
					),
				),
								
				array(
					'id'        => 'hub_tabs_link_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Hub Tabs Link Typography', 'gauge' ),
					'desc'  => esc_html__( 'The hub tab typography.', 'gauge' ),
					'output'    => array( '#gp-hub-tabs li a', '#gp-hub-tabs-mobile-nav-button' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '13px',
						'line-height' => '21px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '600',
						'subsets'     => 'latin',
						'color'       => '#fff',
					),
				),	

				array(
					'id'        => 'hub_tabs_link_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Hub Tabs Link Background Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The hub tabs background hover color.', 'gauge' ),
					'output'    => array( '#gp-hub-tabs li a:hover', '#gp-hub-tabs li.current_page_item a' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f84103',
					),
				),

				array(
					'id'        => 'hub_details_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Hub Details Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The hub details background color.', 'gauge' ),
					'output'    => array( '#gp-hub-details' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#1c1c1c',
					),
				),
				
				array(
					'id'        => 'hub_details_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Hub Details Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The hub details text color.', 'gauge' ),
					'output'    => array( '#gp-hub-details', '#gp-hub-details a', '#gp-hub-details .gp-entry-title' ),      
					'transparent' => false,
					'default'   => '#fff',
				),
			
				array(
					'id'        => 'hub_title_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Child Title Typography', 'gauge' ),
					'desc'  => esc_html__( 'The child title typography.', 'gauge' ),
					'output'    => array( '.gp-hub-child-page #gp-content .gp-entry-title' ),
					'google'    => true,
					'text-align' => false,
					'font-family' => false,
					'font-weight' => false,
					'font-style' => false,
					'subsets'     => false,
					'default'   => array(
						'font-size'   => '26px',
						'line-height' => '38px',
						'color' => '#000',
					),
				),
													
			)
			
		) );	
                       
				
		Redux::setSection( $opt_name, array(
			'id' => 'styling-hub-review-review-template',
			'title'     => esc_html__( 'Hub Review/Review Template', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-star',
			'fields'    => array(
			
				array(
					'id'        => 'review_first_letter',
					'type'      => 'typography',
					'title'     => esc_html__( 'First Letter Typography', 'gauge' ),
					'desc'  => esc_html__( 'The first letter of the review typography.', 'gauge' ),
					'required' => array( 'review_first_letter_styling', '=', 'enabled' ),
					'output'    => array( '#gp-review-content-wrapper.gp-review-first-letter .gp-entry-text > p:first-child::first-letter', '#gp-review-content-wrapper.gp-review-first-letter .gp-entry-text > *:not(p):first-child + p::first-letter', '#gp-review-content-wrapper.gp-review-first-letter .gp-entry-text .vc_row:first-child .vc_column_container:first-child .wpb_wrapper:first-child .wpb_text_column:first-child .wpb_wrapper:first-child > p:first-child::first-letter' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '100px',
						'line-height' => '100px',
						'font-family' => 'Arvo',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#F84102',
					),
				),                    	

				array(
					'id'        => 'review_summary_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Review Summary Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The review summary background color.', 'gauge' ),
					'output'    => array( '#gp-review-summary' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#1c1c1c',
					),
				),
									
				array(
					'id'        => 'review_summary_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Review Summary Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The review summary text color.', 'gauge' ),
					'output'    => array( '#gp-review-summary' ),    
					'transparent' => false,  
					'default'   => '#fff',
				),

				array(
					'id'        => 'review_good_points_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Good Points Color', 'gauge' ),
					'desc'  => esc_html__( 'The good points color.', 'gauge' ),
					'output'    => array( '#gp-points-wrapper .gp-good-points li i' ),
					'transparent' => false,      
					'default'   => '#f84103',
				),

				array(
					'id'        => 'review_bad_points_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Bad Points Color', 'gauge' ),
					'desc'  => esc_html__( 'The bad points color.', 'gauge' ),
					'output'    => array( '#gp-points-wrapper .gp-bad-points li i' ), 
					'transparent' => false,     
					'default'   => '#5fa2a5',
				),

				array(
					'id'        => 'low_rating_gradient',
					'type'      => 'color_gradient',
					'title'     => esc_html__( 'Rating Gradient', 'gauge' ),
					'desc'  => esc_html__( 'The rating gradient from a low score to a high score.', 'gauge' ),
					'validate' => 'color',
					'default'   => array(
						'from' => '#E67300',
						'to'   => '#e63900',
					),
				),

				array(
					'id'        => 'user_rating_text_light_color',
					'type'      => 'color',
					'title'     => esc_html__( 'User Rating Light Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The user rating light text color (hub header, ranking element, review page etc.).', 'gauge' ),
					'output' => array( '#gp-review-summary .gp-rating-text', '#gp-featured-wrapper .gp-rating-text', '.gp-hub-header .gp-rating-text', '#gp-homepage-slider .gp-rating-text', '.gp-featured-wrapper .gp-rating-text', '.gp-ranking-wrapper .gp-rating-text' ),
					'transparent' => false,
					'default'   => '#fff',
				),

				array(
					'id'        => 'user_rating_text_dark_color',
					'type'      => 'color',
					'title'     => esc_html__( 'User Rating Dark Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The user rating dark text color (hub categories).', 'gauge' ),
					'output' => array( 'section .gp-rating-text' ),
					'transparent' => false,
					'default'   => '#000',
				),

				array(
					'id'        => 'user_rating_box_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'User Rating Box Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The user rating box text color.', 'gauge' ),
					'output' => array( '.gp-your-rating', '.gp-user-reviews-link:hover' ),
					'transparent' => false,
					'default'   => '#f84103',
				),
														
				array(
					'id'        => 'user_rating_text_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'User Rating Text Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The user rating Text background color.', 'gauge' ),
					'output' => array( 'section .gp-average-rating' ),     
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f84103',
					),	
				),

			array(
				'id' => 'rating_criteria_image', 
				'title' => esc_html__( 'Rating Criteria Image', 'gauge' ),
				'type'      => 'background',
				'desc' => esc_html__( 'The image used for the rating criteria bars.', 'gauge' ),				
				'output'    => array( '.gp-rating-gauge .gp-site-rating-selection', '.gp-rating-plain .gp-site-rating-selection' ),
				'preview' => false,
				'preview_media' => true,
				'background-size' => false,
				'background-repeat' => false,
				'background-attachment' => false,
				'background-position' => false,
				'transparent' => false,
				'default'   => array(
					'background-image' => get_template_directory_uri() . '/lib/images/site-rating-slider-rated.png',
					'background-color' => '',
				),	
			),

			array(
				'id'        => 'rating_criteria_text_color',
				'type'      => 'color',
				'title'     => esc_html__( 'Rating Criteria Text Color', 'gauge' ),
				'desc'  => esc_html__( 'The rating criteria text color.', 'gauge' ),
				'output' => array( '.gp-rating-gauge .gp-site-rating-criteria-text, .gp-rating-plain .gp-site-rating-criteria-text' ),
				'transparent' => false,
				'default'   => '#fff',
			),
																																																																																					
			),          	       
				
		) );	


		Redux::setSection( $opt_name, array(
			'id' => 'styling-widgets-elements',
			'title'     => esc_html__( 'Widgets/Elements', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-cog',
			'fields' => array(

				array(
					'id'        => 'sidebar_widget_title_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Widget Title Typography', 'gauge' ),
					'desc'  => esc_html__( 'The sidebar widget title typograpghy.', 'gauge' ),
					'output'    => array( '#gp-sidebar .widgettitle' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '14px',
						'line-height' => '22px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '600',
						'subsets'     => 'latin',
						'color'       => '#000',
					),
				),  


				array(
					'id'        => 'hub_element_title_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Element Title Color', 'gauge' ),
					'desc'  => esc_html__( 'The element title color.', 'gauge' ),
					'output'    => array( '.gp-element-title h3' ),
					'transparent' => false,
					'default' => '#f84103',
				),
		
				array(
					'id'        => 'hub_see_all_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'See All Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The see all link colors.', 'gauge' ),
					'output'    => array( '.gp-see-all-link a' ),
					'default'   => array(
						'regular' => '#000',
						'hover' => '#f84103',
						'active' => false,
					),
				),
				
			),          	       
					
		) );	

	                                                                      
		Redux::setSection( $opt_name, array(
			'id' => 'styling-fields-buttons',
			'title'     => esc_html__( 'Fields & Buttons', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-check',
			'fields'    => array(
							
				array(
					'id'        => 'input_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Input Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The input background color.', 'gauge' ),
					'output'    => array( 'input', 'textarea', 'select', '.gp-theme #buddypress .dir-search input[type=search]', '.gp-theme #buddypress .dir-search input[type=text]', '.gp-theme #buddypress .groups-members-search input[type=search]', '.gp-theme #buddypress .standard-form input[type=color]', '.gp-theme #buddypress .standard-form input[type=date]', '.gp-theme #buddypress .standard-form input[type=datetime-local]', '.gp-theme #buddypress .standard-form input[type=datetime]', '.gp-theme #buddypress .standard-form input[type=email]', '.gp-theme #buddypress .standard-form input[type=month]', '.gp-theme #buddypress .standard-form input[type=number]', '.gp-theme #buddypress .standard-form input[type=password]', '.gp-theme #buddypress .standard-form input[type=range]', '.gp-theme #buddypress .standard-form input[type=search]', '.gp-theme #buddypress .standard-form input[type=tel]', '.gp-theme #buddypress .standard-form input[type=text]', '.gp-theme #buddypress .standard-form input[type=time]', '.gp-theme #buddypress .standard-form input[type=url]', '.gp-theme #buddypress .standard-form input[type=week]', '.gp-theme #buddypress .standard-form textarea', '.gp-theme #buddypress div.activity-comments form .ac-textarea', '.gp-theme #buddypress form#whats-new-form textarea' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#fff',
					),
				),
				
				array(
					'id'        => 'input_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Input Border', 'gauge' ),
					'desc'  => esc_html__( 'The input border.', 'gauge' ),
					'output'    => array( 'input', 'textarea', 'select', '.gp-theme #buddypress .dir-search input[type=search]', '.gp-theme #buddypress .dir-search input[type=text]', '.gp-theme #buddypress .groups-members-search input[type=search]', '.gp-theme #buddypress .standard-form input[type=color]', '.gp-theme #buddypress .standard-form input[type=date]', '.gp-theme #buddypress .standard-form input[type=datetime-local]', '.gp-theme #buddypress .standard-form input[type=datetime]', '.gp-theme #buddypress .standard-form input[type=email]', '.gp-theme #buddypress .standard-form input[type=month]', '.gp-theme #buddypress .standard-form input[type=number]', '.gp-theme #buddypress .standard-form input[type=password]', '.gp-theme #buddypress .standard-form input[type=range]', '.gp-theme #buddypress .standard-form input[type=search]', '.gp-theme #buddypress .standard-form input[type=tel]', '.gp-theme #buddypress .standard-form input[type=text]', '.gp-theme #buddypress .standard-form input[type=time]', '.gp-theme #buddypress .standard-form input[type=url]', '.gp-theme #buddypress .standard-form input[type=week]', '.gp-theme #buddypress .standard-form textarea', '.gp-theme #buddypress div.activity-comments form .ac-textarea', '.bb-global-search-ac.ui-autocomplete', '.gp-theme #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content' ),      
					'default'   => array(
						'border-color' => '#ddd',
						'border-width' => '1px',
						'border-style' => 'solid',
					),
				),
									
				array(
					'id'        => 'input_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Input Typography', 'gauge' ),
					'desc'  => esc_html__( 'The input typography.', 'gauge' ),
					'output'    => array( 'input', 'textarea', 'select', '.gp-theme #buddypress .dir-search input[type=search]', '.gp-theme #buddypress .dir-search input[type=text]', '.gp-theme #buddypress .groups-members-search input[type=search]', '.gp-theme #buddypress .groups-members-search input[type=text]', '.gp-theme #buddypress .standard-form input[type=color]', '.gp-theme #buddypress .standard-form input[type=date]', '.gp-theme #buddypress .standard-form input[type=datetime-local]', '.gp-theme #buddypress .standard-form input[type=datetime]', '.gp-theme #buddypress .standard-form input[type=email]', '.gp-theme #buddypress .standard-form input[type=month]', '.gp-theme #buddypress .standard-form input[type=number]', '.gp-theme #buddypress .standard-form input[type=password]', '.gp-theme #buddypress .standard-form input[type=range]', '.gp-theme #buddypress .standard-form input[type=search]', '.gp-theme #buddypress .standard-form input[type=tel]', '.gp-theme #buddypress .standard-form input[type=text]', '.gp-theme #buddypress .standard-form input[type=time]', '.gp-theme #buddypress .standard-form input[type=url]', '.gp-theme #buddypress .standard-form input[type=week]', '.gp-theme #buddypress .standard-form textarea', '.gp-theme #buddypress div.activity-comments form .ac-textarea' ),
					'google'    => true,
					'text-align' => false,
					'line-height' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '13px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#000',
					),
				),

				array(
					'id'        => 'button_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Button Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The button background color.', 'gauge' ),
					'output'    => array( 'input[type="button"]', 'input[type="submit"]', 'input[type="reset"]', 'button', '.button', '.gp-notification-counter', '.gp-theme #buddypress .comment-reply-link', '.gp-notification-counter', '.gp-theme #buddypress a.button', '.gp-theme #buddypress button', '.gp-theme #buddypress div.generic-button a', '.gp-theme #buddypress input[type=button]', '.gp-theme #buddypress input[type=reset]', '.gp-theme #buddypress input[type=submit]', '.gp-theme #buddypress ul.button-nav li a', 'a.bp-title-button', '.gp-theme #buddypress .activity-list #reply-title small a span', '.gp-theme #buddypress .activity-list a.bp-primary-action span', '.woocommerce #respond input#submit.alt', '.woocommerce a.button.alt', '.woocommerce button.button.alt', '.woocommerce input.button.alt', '#gp-dropdowncart .woocommerce a.button' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#F84103',
					),
				),

				 array(
					'id'        => 'button_bg_hover',
					'type'      => 'background',
					'title'     => esc_html__( 'Button Background Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The button background hover color.', 'gauge' ),
					'output'    => array( 'input[type="button"]:hover', 'input[type="submit"]:hover', 'input[type="reset"]:hover', 'button:hover', '.button:hover', '.gp-theme #buddypress .comment-reply-link:hover', '.gp-theme #buddypress a.button:hover', '.gp-theme #buddypress button:hover', '.gp-theme #buddypress div.generic-button a:hover', '.gp-theme #buddypress input[type=button]:hover', '.gp-theme #buddypress input[type=reset]:hover', '.gp-theme #buddypress input[type=submit]:hover', '.gp-theme #buddypress ul.button-nav li a:hover', 'a.bp-title-button:hover', '.gp-theme #buddypress .activity-list #reply-title small a:hover span', '.gp-theme #buddypress .activity-list a.bp-primary-action:hover span', '.woocommerce #respond input#submit.alt:hover', '.woocommerce a.button.alt:hover', '.woocommerce button.button.alt:hover', '.woocommerce input.button.alt:hover', '#gp-dropdowncart .woocommerce a.button:hover' ),                        
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#5fa2a5',
					),
				),
								   
				array(
					'id'        => 'button_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Button Border', 'gauge' ),
					'desc'  => esc_html__( 'The button border.', 'gauge' ),
					'output'    => array( 'input[type="button"]', 'input[type="submit"]', 'input[type="reset"]', 'button', '.button', '.gp-theme #buddypress .comment-reply-link', '.gp-notification-counter', '.gp-theme #buddypress a.button', '.gp-theme #buddypress button', '.gp-theme #buddypress div.generic-button a', '.gp-theme #buddypress input[type=button]', '.gp-theme #buddypress input[type=reset]', '.gp-theme #buddypress input[type=submit]', '.gp-theme #buddypress ul.button-nav li a', 'a.bp-title-button', '.gp-theme #buddypress .activity-list #reply-title small a span', '.gp-theme #buddypress .activity-list a.bp-primary-action span', '.woocommerce #respond input#submit.alt', '.woocommerce a.button.alt', '.woocommerce button.button.alt', '.woocommerce input.button.alt', '#gp-dropdowncart .woocommerce a.button' ),    
					'default'   => array(
						'border-color' => '',
						'border-width' => '0',
						'border-style' => 'solid',
					),
				),
									
				array(
					'id'        => 'button_typography',
					'type'      => 'color',
					'title'     => esc_html__( 'Button Text', 'gauge' ),
					'desc'  => esc_html__( 'The button text.', 'gauge' ),
					'output'    => array( 'input[type="button"]', 'input[type="submit"]', 'input[type="reset"]', 'button', '.button', '.gp-theme #buddypress .comment-reply-link', '.gp-theme #buddypress a.button', '.gp-theme #buddypress button', '.gp-theme #buddypress div.generic-button a', '.gp-theme #buddypress input[type=button]', '.gp-theme #buddypress input[type=reset]', '.gp-theme #buddypress input[type=submit]', '.gp-theme #buddypress ul.button-nav li a', 'a.bp-title-button', '.gp-theme #buddypress .activity-list #reply-title small a span', '.gp-theme #buddypress .activity-list a.bp-primary-action span', '#gp-dropdowncart .woocommerce a.button' ),
					'transparent' => false,
					'default' => '#fff',
				),

				array(
					'id'        => 'button_typography_hover',
					'type'      => 'color',
					'title'     => esc_html__( 'Button Text Hover', 'gauge' ),
					'desc'  => esc_html__( 'The button text hover.', 'gauge' ),
					'output'    => array( 'input[type="button"]:hover', 'input[type="submit"]:hover', 'input[type="reset"]:hover', 'button:hover', '.button:hover', '.gp-theme #buddypress .comment-reply-link:hover', '.gp-theme #buddypress a.button:hover', '.gp-theme #buddypress button:hover', '.gp-theme #buddypress div.generic-button a:hover', '.gp-theme #buddypress input[type=button]:hover', '.gp-theme #buddypress input[type=reset]:hover', '.gp-theme #buddypress input[type=submit]:hover', '.gp-theme #buddypress ul.button-nav li a:hover', 'a.bp-title-button:hover', '.gp-theme #buddypress .activity-list #reply-title small a span', '.gp-theme #buddypress .activity-list a.bp-primary-action span', '#gp-dropdowncart .woocommerce a.button:hover' ),
					'transparent' => false,
					'default'  => '#fff',
				),

			)
				
		) );	


		Redux::setSection( $opt_name, array(
			'id' => 'styling-footer',
			'title'     => esc_html__( 'Footer', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-photo',
			'fields'    => array(
												
				array(
					'id'        => 'footer_widget_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Footer Widget Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The footer widget background color.', 'gauge' ),
					'output'    => array( '#gp-footer-widgets' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#1c1c1c',
					),
				),

				array(
					'id'        => 'footer_widget_3d_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Footer Widget 3D Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The footer widget 3D background color.', 'gauge' ),
					'output'    => array( '#gp-footer-3d' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#333',
					),
				),
				
				array(
					'id'        => 'footer_widget_title_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Footer Widget Title Typography', 'gauge' ),
					'desc'  => esc_html__( 'The footer widget title typography.', 'gauge' ),
					'output'    => array( '.gp-footer-widget .widgettitle' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '18px',
						'line-height' => '22px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#fff',
					),
				),
									
				array(
					'id'        => 'footer_widget_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Footer Widget Typography', 'gauge' ),
					'desc'  => esc_html__( 'The footer widget typography.', 'gauge' ),
					'output'    => array( '.gp-footer-widget' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '15px',
						'line-height' => '23px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#fff',
					),
				),

				array(
					'id'        => 'footer_widget_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Footer Widget Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The footer widget link colors.', 'gauge' ),
					'output'    => array( '.gp-footer-widget a' ),
					'default'   => array(
						'regular' => '#ddd',
						'hover'   => '#f84103',
						'active'  => false,
					),
				),
				
				array(
					'id'        => 'footer_first_col_widget_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'First Column Footer Widget Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The first column footer background color.', 'gauge' ),
					'output'    => array( '.gp-footer-larger-first-col .gp-footer-1' ),
					'required' => array( 'footer_widget_layout', '=', 'gp-footer-larger-first-col' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f84103',
					),
				),

				array(
					'id'        => 'footer_first_col_widget_3d bg',
					'type'      => 'background',
					'title'     => esc_html__( 'First Column Footer Widget 3D Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The first column footer 3D background color.', 'gauge' ),
					'output'    => array( '.gp-first-widget-bend' ),
					'required' => array( 'footer_widget_layout', '=', 'gp-footer-larger-first-col' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#F5612E',
					),
				),
				
				array(
					'id'        => 'footer_first_col_widget_title',
					'type'      => 'typography',
					'title'     => esc_html__( 'First Column Footer Widget Title Typography', 'gauge' ),
					'desc'  => esc_html__( 'The first column footer widget title typography.', 'gauge' ),
					'output'    => array( '.gp-footer-larger-first-col .gp-footer-1 .widgettitle' ),
					'required' => array('footer_widget_layout', '=', 'gp-footer-larger-first-col'),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '18px',
						'line-height' => '22px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#fff',
					),
				),
									
				array(
					'id'        => 'footer_first_col_widget_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'First Column Footer Widget Typography', 'gauge' ),
					'desc'  => esc_html__( 'The first column footer widget typography.', 'gauge' ),
					'output'    => array( '.gp-footer-larger-first-col .gp-footer-1' ),
					'required' => array( 'footer_widget_layout', '=', 'gp-footer-larger-first-col' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '15px',
						'line-height' => '23px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#fff',
					),
				),

				array(
					'id'        => 'footer_first_col_widget_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'First Column Footer Widget Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The first column footer widget link colors.', 'gauge' ),
					'output'    => array( '.gp-footer-larger-first-col .gp-footer-1 a' ),
					'required' => array( 'footer_widget_layout', '=', 'gp-footer-larger-first-col' ),
					'default'   => array(
						'regular' => '#fff',
						'hover'   => '#000',
						'active'  => false,
					),
				),
				
				array(
					'id'        => 'copyright_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Copyright Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The copyright background color.', 'gauge' ),
					'output'    => array( '#gp-copyright' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#000',
					),
				),
				array(
					'id'        => 'copyright_typography',
					'type'      => 'typography',
					'title'     => esc_html__( 'Copyright Typography', 'gauge' ),
					'desc'  => esc_html__( 'The copyright typography.', 'gauge' ),
					'output'    => array( '#gp-copyright' ),
					'google'    => true,
					'text-align' => false,
					'font-backup' => true,
					'default'   => array(
						'font-size'   => '11px',
						'line-height' => '16px',
						'font-family' => 'Open Sans',
						'font-backup' => 'Arial, Helvetica, sans-serif',
						'font-weight' => '400',
						'subsets'     => 'latin',
						'color'       => '#888',
					),
				),

				array(
					'id'        => 'copyright_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Copyright Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The copyright link colors.', 'gauge' ),
					'output'    => array( '#gp-copyright a' ),
					'default'   => array(
						'regular' => '#888',
						'hover'   => '#ddd',
						'active'  => false,
					),
				),
																																		
				array(
					'id'        => 'back_to_top_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Back To Top Background Color', 'gauge' ),
					'desc'  => esc_html__( 'The back to top button background color.', 'gauge' ),
					'output'    => array( '#gp-to-top' ),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#000',
					),
				),
									
				array(
					'id'        => 'back_to_top_icon_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Back To Top Icon Color', 'gauge' ),
					'desc'  => esc_html__( 'The back to top icon color.', 'gauge' ),
					'output'    => array( '#gp-to-top' ),
					'transparent' => false,
					'default'   => '#fff',
				),
																																		 
			)
				
		) );	
			  

		Redux::setSection( $opt_name, array(
			'id' => 'styling-buddypress',
			'title'     => esc_html__( 'BuddyPress', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-comment-alt',
			'fields'    => array(

				array(
					'id'        => 'bp_list_title_color',
					'type'      => 'color',
					'title'     => esc_html__( 'List Title Color', 'gauge' ),
					'desc'  => esc_html__( 'The list title color.', 'gauge' ),
					'output'    => array(
						'#buddypress .activity-list .activity-content .activity-header', 
						'#buddypress .activity-list .activity-content .comment-header', 
						'#buddypress .activity-list .activity-header a',
						'#buddypress .activity-list div.activity-comments div.acomment-meta',
						'#buddypress .activity-list .acomment-meta a',
						'.widget.buddypress .item-title a',
						'.widget.buddypress div.item-options.gp-small-item-options:before',
						'.widget.buddypress div.item-options a',
						'#buddypress ul.item-list li div.item-title a',
						'#buddypress ul.item-list li h4 > a',
						'#buddypress ul.item-list li h5 > a',
						'#buddypress div#item-header div#item-meta',
					),
					'default'   => '#000',
				),

				array(
					'id'        => 'bp_list_meta_color',
					'type'      => 'color',
					'title'     => esc_html__( 'List Meta Color', 'gauge' ),
					'desc'  => esc_html__( 'The list meta color.', 'gauge' ),
					'output'    => array( 
						'#buddypress .activity-list a.activity-time-since', 
						'.widget_display_replies ul li a + div', 
						'.widget_display_topics ul li a + div', 
						'#buddypress .activity-list .activity-content .activity-inner',
						'#buddypress .activity-list .acomment-meta a.activity-time-since',
						'#buddypress .activity-list div.activity-comments div.acomment-content',
						'.widget.buddypress div.item-meta',
						'#buddypress span.activity',
						'#buddypress ul.item-list li div.meta',
					),
					'default'   => '#aaa',
				),

				array(
					'id'        => 'bp_list_meta_button_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'List Meta Button Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The list meta button link colors.', 'gauge' ),
					'output'    => array( 
						'.gp-theme #buddypress .activity-list div.activity-meta a.button',
						'.gp-theme #buddypress .activity .acomment-options a',
						'.gp-theme #buddypress .activity-list li.load-more a',
						'.gp-theme #buddypress .activity-list li.load-newest a',
						'.widget.buddypress div.item-options a.selected',
					),
					'default'   => array(
						'regular'  => '#e93100',
						'hover'    => '#000',
						'active'   => false,
					),
				),
			
				array(
					'id'        => 'bp_list_divider',
					'type'      => 'border',
					'title'     => esc_html__( 'List Divider Color', 'gauge' ),
					'desc'  => esc_html__( 'The list divider color.', 'gauge' ),
					'output'    => array(
						'.gp-theme #buddypress ul.item-list li',
						'.gp-theme #buddypress div.activity-comments ul li:first-child',
						'.widget.buddypress #friends-list li',
						'.widget.buddypress #groups-list li',
						'.widget.buddypress #members-list li',
					),   
					'left' => false,
					'right' => false,    
					'default'   => array(
						'border-color' => '#e0e0e0',
						'border-width' => '1px',
						'border-style' => 'solid',
					),
				),

			
				array(
					'id'        => 'bp_primary_options_tab',
					'type'      => 'color',
					'title'     => esc_html__( 'Primary Options Tab Background', 'gauge' ),
					'desc'  => esc_html__( 'The primary options tab background.', 'gauge' ),
					'output'    => array(
						'background-color' => '.gp-theme #buddypress div.item-list-tabs',
						'color' => '.gp-theme #buddypress div.item-list-tabs ul li a span,.gp-theme #buddypress div.item-list-tabs ul li a:hover span,.gp-theme #buddypress div.item-list-tabs ul li.current a span,.gp-theme #buddypress div.item-list-tabs ul li.selected a span'
					),   	
					'default'   => '#000',
				),

				array(
					'id'        => 'bp_primary_option_tab_link',
					'type'      => 'color',
					'title'     => esc_html__( 'Primary Options Tab Link Color', 'gauge' ),
					'desc'  => esc_html__( 'The primary options tab link color.', 'gauge' ),
					'output'    => array( 
						'background-color' => '.gp-theme #buddypress div.item-list-tabs ul li a span',
						'color' => '.gp-theme #buddypress div.item-list-tabs ul li a, .gp-theme #buddypress #gp-bp-tabs-button, .gp-theme #buddypress div.item-list-tabs ul li span',
					),
					'transparent' => false,
					'default' => '#b1b1b1',
				),

				array(
					'id'        => 'bp_primary_option_tab_link_hover',
					'type'      => 'color',
					'title'     => esc_html__( 'Primary Options Tab Link Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The primary options tab link hover colors.', 'gauge' ),
					'output'    => array( 
						'color' => '.gp-theme #buddypress div.item-list-tabs ul li.current a, .gp-theme #buddypress div.item-list-tabs ul li.selected a,.gp-theme #buddypress div.item-list-tabs ul li a:hover', 
						'background' => '.gp-theme #buddypress div.item-list-tabs ul li a:hover span,.gp-theme #buddypress div.item-list-tabs ul li.current a span,.gp-theme #buddypress div.item-list-tabs ul li.selected a span',
					),
					'transparent' => false,
					'default'   => '#fff',
				),

				array(
					'id'        => 'bp_secondary_options_tab',
					'type'      => 'color',
					'title'     => esc_html__( 'Secondary Options Tab Background', 'gauge' ),
					'desc'  => esc_html__( 'The secondary options tab background.', 'gauge' ),
					'output'    => array(
						'background-color' => '.gp-theme #buddypress div.item-list-tabs#subnav ul,  .widget.buddypress div.item-options.gp-small-item-options > a',
						'color' => '.gp-theme #buddypress div.item-list-tabs#subnav ul li a span,.gp-theme #buddypress div.item-list-tabs#subnav ul li a:hover span,.gp-theme #buddypress div.item-list-tabs#subnav ul li.current a span,.gp-theme #buddypress div.item-list-tabs#subnav ul li.selected a span'
					),   	
					'default'   => '#f8f8f8',
				),

				array(
					'id'        => 'bp_secondary_options_tab_link',
					'type'      => 'color',
					'title'     => esc_html__( 'Secondary Options Tab Link Color', 'gauge' ),
					'desc'  => esc_html__( 'The secondary options tab link color.', 'gauge' ),
					'output'    => array(
						'background-color' => '.gp-theme #buddypress div.item-list-tabs#subnav ul li a span',
						'color' => '.gp-theme #buddypress div.item-list-tabs#subnav ul li a',
					),   	
					'transparent' => false,
					'default'   => '#000',
				),

				array(
					'id'        => 'bp_secondary_options_tab_link_hover',
					'type'      => 'color',
					'title'     => esc_html__( 'Secondary Options Tab Link Hover Color', 'gauge' ),
					'desc'  => esc_html__( 'The secondary options tab link hover color.', 'gauge' ),
					'output'    => array(
						'color' => '.gp-theme #buddypress div.item-list-tabs#subnav ul li.current a, .gp-theme #buddypress div.item-list-tabs#subnav ul li.selected a, .gp-theme #buddypress div.item-list-tabs#subnav ul li a:hover',
						'background' => '.gp-theme #buddypress div.item-list-tabs#subnav ul li a:hover span,.gp-theme #buddypress div.item-list-tabs#subnav ul li.current a span,.gp-theme #buddypress div.item-list-tabs#subnav ul li.selected a span',
					),   	
					'transparent' => false,
					'default'   => '#e93100',
				),
																																	 
			)
		) ); 
		               

		Redux::setSection( $opt_name, array(
			'id' => 'styling-bbpress',
			'title'     => esc_html__( 'bbPress', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-comment-alt',
			'fields'    => array(

				array(
					'id'        => 'bbpress_forum_cat_header_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Forum Category Header Background', 'gauge' ),
					'desc'  => esc_html__( 'The forum category header background.', 'gauge' ),
					'output'    => array( 
						'#bbpress-forums .gp-forum-home.bbp-forums .bbp-has-subforums .bbp-forum-info > .bbp-forum-title',
						'#bbpress-forums .bbp-topics .bbp-header',
						'#bbpress-forums .bbp-replies .bbp-header',
						'#bbpress-forums .bbp-search-results .bbp-header',
					),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#353535',
					),
				),

				array(
					'id'        => 'bbpress_forum_cat_header_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Forum Category Header Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The forum category header text color.', 'gauge' ),
					'output'    => array( 
						'#bbpress-forums .gp-forum-home.bbp-forums .bbp-has-subforums .bbp-forum-info > .bbp-forum-title',
						'#bbpress-forums .bbp-topics .bbp-header',
						'#bbpress-forums .bbp-replies .bbp-header',
						'#bbpress-forums .bbp-search-results .bbp-header',
					),
					'default'   => '#fff',
				),

				array(
					'id'        => 'bbpress_forum_cat_header_link',
					'type'      => 'link_color',
					'title'     => esc_html__( 'Forum Category Header Link Colors', 'gauge' ),
					'desc'  => esc_html__( 'The forum category header link colors.', 'gauge' ),
					'output'    => array( '#bbpress-forums .bbp-header div.bbp-reply-content a' ),
					'default'   => array(
						'regular'  => '#ddd',
						'hover'    => '#fff',
						'active'   => false,
					),
				),
									
				array(
					'id'        => 'bbpress_forum_row_bg_1',
					'type'      => 'background',
					'title'     => esc_html__( 'Forum Row Background 1', 'gauge' ),
					'desc'  => esc_html__( 'The forum row background.', 'gauge' ),
					'output'    => array( 
						'#bbpress-forums .bbp-forums-list li.odd-forum-row',
						'#bbpress-forums div.odd',
						'#bbpress-forums ul.odd',
					),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#f8f8f8',
					),
				),

				array(
					'id'        => 'bbpress_forum_row_bg_2',
					'type'      => 'background',
					'title'     => esc_html__( 'Forum Row Background 2', 'gauge' ),
					'desc'  => esc_html__( 'The forum row background.', 'gauge' ),
					'output'    => array( 
						'#bbpress-forums .bbp-forums-list li.even-forum-row',
						'#bbpress-forums div.even',
						'#bbpress-forums ul.even',
					),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#fff',
					),
				),
													
				array(
					'id'        => 'bbpress_forum_border',
					'type'      => 'border',
					'title'     => esc_html__( 'Forum Border Color', 'gauge' ),
					'desc'  => esc_html__( 'The forum border color.', 'gauge' ),
					'output'    => array( 
						'#bbpress-forums .gp-forum-home.bbp-forums .bbp-forum-info > .bbp-forum-title',
						'#bbpress-forums div.bbp-forum-header',
						'#bbpress-forums div.bbp-topic-header',
						'#bbpress-forums div.bbp-reply-header',
						'#bbpress-forums .bbp-forums-list',
						'#bbpress-forums li.bbp-body',
					),    
					'default'   => array(
						'border-color' => '#ddd',
						'border-width' => '1px',
						'border-style' => 'solid',
					),
				),
										
				array(
					'id'        => 'bbpress_forum_title_link',
					'type'      => 'color',
					'title'     => esc_html__( 'Forum Title Link Color', 'gauge' ),
					'desc'  => esc_html__( 'The forum title link color.', 'gauge' ),
					'output'    => array( 
						'#bbpress-forums .bbp-forums-list .bbp-forum .bbp-forum-link',
						'body.forum #bbpress-forums .bbp-forums .bbp-forum-info > .bbp-forum-title',
						'#bbpress-forums .bbp-topics .bbp-topic-permalink',
						'#bbpress-forums .gp-forum-home.bbp-forums .bbp-forum-info > .bbp-forum-title',
					),
					'default'   => '#000',
				),

				array(
					'id'        => 'bbpress_forum_role_bg',
					'type'      => 'background',
					'title'     => esc_html__( 'Forum Role Background', 'gauge' ),
					'desc'  => esc_html__( 'The forum role background.', 'gauge' ),
					'output'    => array( 
						'#bbpress-forums div.bbp-forum-author .bbp-author-role', 
						'#bbpress-forums div.bbp-topic-author .bbp-author-role', 
						'#bbpress-forums div.bbp-reply-author .bbp-author-role',
					),
					'background-repeat' => false,
					'background-attachment' => false,
					'background-position' => false,
					'background-image' => false,
					'background-size' => false,
					'preview' => false,
					'default'   => array(
						'background-color' => '#e93100',
					),
				),
										
				array(
					'id'        => 'bbpress_forum_role_text_color',
					'type'      => 'color',
					'title'     => esc_html__( 'Forum Role Text Color', 'gauge' ),
					'desc'  => esc_html__( 'The forum role text color.', 'gauge' ),
					'output'    => array( 
						'#bbpress-forums div.bbp-forum-author .bbp-author-role', 
						'#bbpress-forums div.bbp-topic-author .bbp-author-role', 
						'#bbpress-forums div.bbp-reply-author .bbp-author-role',
					),
					'default'   => '#fff',
				),
																																																																					 
			)
		) );       
	
	
		Redux::setSection( $opt_name, array(
			'id' => 'styling-theme-widths',
			'title'     => esc_html__( 'Theme Widths', 'gauge' ),
			'subsection' => true,
			'icon' => 'el-icon-resize-horizontal',
			'fields'    => array(
											
			array(
			   'id' => 'section-start-desktop',
			   'type' => 'section',
			   'title' => esc_html__( 'Larger Desktop (above 1200px)', 'gauge' ),
			   'indent' => true,
		   ),
   
				array(
					'id' => 'desktop_wide_container',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Container Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '1170px',
					)
				),                     			                                

				array(
					'id' => 'desktop_wide_content',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Content Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '810px',
					)
				),
				
				array(
					'id' => 'desktop_wide_sidebar',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Sidebar Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '330px',
					)
				),
				
				array(
					'id' => 'desktop_boxed_page',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Page Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '1170px',
					)
				),                     			                                

				array(
					'id' => 'desktop_boxed_container',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Container Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '1090px',
					)
				),   
				
				array(
					'id' => 'desktop_boxed_content',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Content Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '730px',
					)
				),
				
				array(
					'id' => 'desktop_boxed_sidebar',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Sidebar Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '330px',
					)
				),
				
			array(
				'id'     => 'section-end-desktop',
				'type'   => 'section',
				'indent' => false,
			),
			
			array(
			   'id' => 'section-start-sm-desktop',
			   'type' => 'section',
			   'title' => esc_html__( 'Smaller Desktop (1200px - 1083px)', 'gauge' ),
			   'indent' => true,
		   ),
   
				array(
					'id' => 'sm_desktop_wide_container',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Container Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '1040px',
					)
				),                     			                                

				array(
					'id' => 'sm_desktop_wide_content',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Content Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '680px',
					)
				),
				
				array(
					'id' => 'sm_desktop_wide_sidebar',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Sidebar Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '330px', 
					)
				),
							
				array(
					'id' => 'sm_desktop_boxed_page',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Page Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '1040px',
					)
				),                     			                                

				array(
					'id' => 'sm_desktop_boxed_container',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Container Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '960px',
					)
				),   
				
				array(
					'id' => 'sm_desktop_boxed_content',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Content Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '600px',
					)
				),
				
				array(
					'id' => 'sm_desktop_boxed_sidebar',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Sidebar Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '330px',
					)
				),
			
			array(
				'id'     => 'section-end-sm-desktop',
				'type'   => 'section',
				'indent' => false,
			),
								
			array(
			   'id' => 'section-start-tablet-wide',
			   'type' => 'section',
			   'title' => esc_html__( 'Tablet (Landscape)', 'gauge' ),
			   'indent' => true,
		   ),
   
				array(
					'id' => 'tablet_wide_container',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Container Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '980px', 
					)
				),                     			                                

				array(
					'id' => 'tablet_wide_content',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Content Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '630px',
					)
				),
				
				array(
					'id' => 'tablet_wide_sidebar',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Sidebar Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-wide-layout'),
					'height' => false,
					'default' => array(
						'width'     => '330px',
					)
				),
						
				array(
					'id' => 'tablet_boxed_page',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Page Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '980px',
					)
				),                     			                                

				array(
					'id' => 'tablet_boxed_container',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Container Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '900px',
					)
				),   
				
				array(
					'id' => 'tablet_boxed_content',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Content Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '550px',
					)
				),
				
				array(
					'id' => 'tablet_boxed_sidebar',
					'type' => 'dimensions',
					'units' => 'px',
					'title' => esc_html__( 'Sidebar Width', 'gauge' ),
					'required' => array('theme_layout', '=', 'gp-boxed-layout'),
					'height' => false,
					'default' => array(
						'width'     => '330px',
					)
				),

			array(
				'id'     => 'section-end-tablet-wide',
				'type'   => 'section',
				'indent' => false,
			),
																																																 
		)
            		
	) );
 
    /*
     * <--- END SECTIONS
     */