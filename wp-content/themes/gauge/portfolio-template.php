<?php
/*
Template Name: Portfolio
*/
get_header(); 

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

?>

<?php ghostpool_page_header( $post_id ); ?>

<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>
	
	<div id="gp-content">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		
	
			<?php if ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' ) { ?>
				<header class="gp-entry-header">
					<h1 class="gp-entry-title" itemprop="headline"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></h1>
				</header>
			<?php } ?>		
		
			<?php the_content(); ?>		

		<?php endwhile; endif; rewind_posts(); ?>			

		<?php

		// Load page variables
		ghostpool_loop_variables();
		ghostpool_category_variables();

		$gp_args = array(
			'post_status' => 'publish',
			'post_type'      => 'gp_portfolio_item',
			'tax_query'      => array( 'relation' => 'OR', $GLOBALS['ghostpool_portfolio_cats'] ),
			'posts_per_page' => $GLOBALS['ghostpool_per_page'],
			'orderby'        => $GLOBALS['ghostpool_orderby_value'],
			'order'          => $GLOBALS['ghostpool_order'],
			'paged'          => $GLOBALS['ghostpool_paged'],
			'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),	
		);

		$gp_query = new wp_query( $gp_args ); ?>
		
		<div id="gp-portfolio" class="gp-portfolio-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?>">		

			<?php if ( $GLOBALS['ghostpool_filter'] == 'enabled' ) { ?>
				<div id="gp-portfolio-filters" class="gp-portfolio-filters">
					<ul>
					   <li><a href="#" data-filter="*" class="gp-active"><?php echo esc_html__( 'All', 'gauge' ); ?></a></li>
						<?php 
						$gp_terms = get_terms( 'gp_portfolios' );
						$gp_cat_array = explode( ',', $GLOBALS['ghostpool_cats'] );
						if ( !empty( $gp_terms ) ) {
							foreach ( $gp_terms as $gp_term ) {
								if ( ! empty( $gp_cat_array[0] ) ) {
									foreach( $gp_cat_array as $gp_cat ) {							
										if ( $gp_term->term_id == $gp_cat ) {
											echo '<li><a href="#" data-filter=".' . sanitize_title( $gp_term->slug ) . '">' . esc_attr( $gp_term->name ). '</a></li>';
										}	
									}
								} else {
									echo '<li><a href="#" data-filter=".' . sanitize_title( $gp_term->slug ) . '">' . esc_attr( $gp_term->name ). '</a></li>';
								}	
							}
						}
						?>
					</ul>
				</div>
			<?php } ?>
	
			<?php if ( $gp_query->have_posts() ) : ?>

				<div class="gp-inner-loop">
				
					<div class="gp-gutter-size"></div>
				
					<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>

						<?php get_template_part( 'portfolio', 'loop' ); ?>

					<?php endwhile; ?>
				
				</div>
							
				<?php echo ghostpool_pagination( $gp_query->max_num_pages ); ?>

			<?php else : ?>

				<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>

			<?php endif; ?>
			
		</div>

	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>