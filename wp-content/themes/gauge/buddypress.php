<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php ghostpool_page_header( get_the_ID() ); ?>

	<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>
	
		<div id="gp-content">
	
			<div <?php post_class(); ?>>

				<header class="gp-entry-header">
					<h1 class="gp-entry-title" itemprop="headline"><?php if ( ! empty( $GLOBALS['ghostpool_custom_title'] ) ) { echo esc_attr( $GLOBALS['ghostpool_custom_title'] ); } else { the_title(); } ?></h1>
				</header>

				<div class="gp-entry-content">
					<?php the_content(); ?>
				</div>
	
			</div>
			
		</div>
		
		<?php get_sidebar(); ?>
	
	</div>
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>