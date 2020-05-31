<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( ! is_page_template( 'blank-page-template.php' ) ) { ?>

	<div id="gp-site-wrapper">
				
		<?php if ( has_nav_menu( 'header-nav' ) ) { ?>		
			<nav id="gp-mobile-nav">
				<div id="gp-mobile-nav-close-button"></div>
				<?php get_search_form(); ?>
				<?php wp_nav_menu( array( 'theme_location' => 'header-nav', 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '<ul class="menu">%3$s</ul>', 'fallback_cb' => 'null', 'walker' => new Ghostpool_Custom_Menu ) ); ?>
			</nav>
			<div id="gp-mobile-nav-bg"></div>
		<?php } ?>
			
		<div id="gp-page-wrapper">

			<?php if ( ghostpool_option( 'top_header' ) != 'gp-main-header' ) { ?>
	
				<header id="gp-top-header">
	
					<div class="gp-container">

						<nav id="gp-left-top-nav" class="gp-nav">	
							<?php wp_nav_menu( array( 'theme_location' => 'top-nav', 'sort_column' => 'menu_order', 'container' => 'ul', 'fallback_cb' => 'null', 'walker' => new Ghostpool_Custom_Menu ) ); ?>
						</nav>
					
						<div id="gp-right-top-nav" class="gp-nav">
							<?php wp_nav_menu( array( 'theme_location' => 'right-top-nav', 'sort_column' => 'menu_order', 'container' => 'ul', 'fallback_cb' => 'null', 'walker' => new Ghostpool_Custom_Menu ) ); ?>
						</div>
																
						<?php if ( function_exists( 'is_woocommerce' ) && ghostpool_option( 'cart_button' ) != 'gp-cart-disabled' ) { echo ghostpool_dropdown_cart(); } ?>
						
						<?php get_template_part( 'lib/sections/social', 'icons' ); ?>
					
					</div>
		
				</header>
	
			<?php } ?>

			<header id="gp-main-header">

				<div class="gp-container">
	
					<div id="gp-logo">
						<?php if ( ghostpool_option( 'logo', 'url' ) ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
								<img src="<?php echo esc_url( ghostpool_option( 'logo', 'url' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="<?php echo absint( ghostpool_option( 'logo_dimensions', 'width' ) ); ?>" height="<?php echo absint( ghostpool_option( 'logo_dimensions', 'height' ) ); ?>" />
							</a>
						<?php } ?>
					</div>

					<?php if ( has_nav_menu( 'header-nav' ) ) { ?>
						<nav id="gp-main-nav" class="gp-nav<?php if ( ghostpool_option( 'hide_move_primary_menu_links' ) == 'enabled' ) { ?> gp-hide-main-nav<?php } ?>">
							<?php wp_nav_menu( array( 'theme_location' => 'header-nav', 'sort_column' => 'menu_order', 'container' => 'ul', 'fallback_cb' => 'null', 'walker' => new Ghostpool_Custom_Menu ) ); ?>
							<a id="gp-mobile-nav-button"></a>
						</nav>
					<?php } ?>

					<?php if ( ghostpool_option( 'search' ) == 'enabled' ) { ?>
						<?php get_search_form(); ?>
					<?php } ?>

				</div>
	
			</header>

			<div id="gp-fixed-header-padding"></div>

<?php } ?>