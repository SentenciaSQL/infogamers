<?php get_header(); ?>

<div id="gp-content-wrapper" class="gp-container">

	<div id="gp-content">

		<header class="gp-entry-header">
			<h1 class="gp-entry-title" itemprop="headline"><?php esc_html_e( 'Page Not Found', 'gauge' ); ?></h1>
		</header>

		<div class="gp-entry-content">
			<h2 class="expandOpen"><?php esc_html_e( 'Oops, it looks like this page does not exist.', 'gauge' ); ?></h2>
		</div>

		<div class="gp-search">
		
			<p><?php esc_html_e( 'If you are lost use the search form below or visit our', 'gauge' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'homepage.', 'gauge' ); ?></a></p>
	
			<?php get_search_form(); ?>
	
		</div>
		
	</div>

</div>

<?php get_footer(); ?>