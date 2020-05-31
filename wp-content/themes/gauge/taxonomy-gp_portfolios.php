<?php get_header(); 

// Page header
ghostpool_page_header( get_the_ID() );

// Load page variables		
ghostpool_loop_variables();

?>

<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

	<div id="gp-content">
	
		<div id="gp-portfolio" class="gp-portfolio-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?>">

			<?php if ( $GLOBALS['ghostpool_filter'] == 'enabled' ) { ?>
				<div id="gp-portfolio-filters" class="gp-portfolio-filters">
					<ul>
					   <li><a href="#" data-filter="*" class="gp-active"><?php echo esc_html__( 'All', 'gauge' ); ?></a></li>
						<?php 
						$gp_terms = get_terms( 'gp_portfolios' );
						if ( !empty( $gp_terms ) ) {
							foreach ( $gp_terms as $gp_term ) {
								echo '<li><a href="#" data-filter=".' . sanitize_title( $gp_term->slug ) . '">' . esc_attr( $gp_term->name ) . '</a></li>';
							}
						}
						?>
					</ul>
				</div>
			<?php } ?>
	
			<?php if ( have_posts() ) : ?>

				<div class="gp-inner-loop">
				
					<div class="gp-gutter-size"></div>
				
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'portfolio', 'loop' ); ?>

					<?php endwhile; ?>
				
				</div>

				<?php echo ghostpool_pagination( $wp_query->max_num_pages ); ?>

			<?php else : ?>

				<span class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></span>

			<?php endif; ?>
			
		</div>

	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>