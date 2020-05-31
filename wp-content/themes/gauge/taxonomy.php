<?php get_header();

// Page header
ghostpool_page_header( get_the_ID() );

// Load page variables		
ghostpool_loop_variables();

?>

<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

	<div id="gp-content">

		<div class="gp-blog-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?>"<?php if ( function_exists( 'ghostpool_data_properties' ) ) { echo ghostpool_data_properties( 'taxonomy' ); } ?>>

			<?php if ( have_posts() ) : ?>
			
				<?php get_template_part( 'lib/sections/filter' ); ?>
					
				<div class="gp-inner-loop <?php echo sanitize_html_class( ghostpool_option( 'ajax', '', 'ajax-loop' ) ); ?>">
				
					<?php if ( $GLOBALS['ghostpool_format'] == 'blog-masonry' ) { ?><div class="gp-gutter-size"></div><?php } ?>
						
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'review', 'loop' ); ?>

					<?php endwhile; ?>
	
				</div>

				<?php echo ghostpool_pagination( $wp_query->max_num_pages ); ?>

			<?php else : ?>
			
				<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>

			<?php endif; ?>

		</div>
						
	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>