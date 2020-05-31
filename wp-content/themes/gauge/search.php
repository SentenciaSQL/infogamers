<?php get_header();

// Page header
ghostpool_page_header( get_the_ID() );

// Load page variables		
ghostpool_loop_variables();

?>

<div id="gp-content-wrapper" class="gp-container">

	<div id="gp-content">

		<div id="gp-new-search">
			
			<?php if ( isset( $_GET['s'] ) && ( $_GET['s'] != '' ) ) { ?>
				
				<div class="gp-post-section-header">
					<h3><?php esc_html_e( 'New Search', 'gauge' ); ?></h3>
					<div class="gp-post-section-header-line"></div>
				</div>
				
				<p><?php esc_html_e( 'If you didn\'t find what you were looking for try searching again.', 'gauge' ); ?></p>
				
			<?php } else { ?>
			
				<div class="gp-post-section-header">
					<h3><?php esc_html_e( 'Empty Search', 'gauge' ); ?></h3>
					<div class="gp-post-section-header-line"></div>
				</div>
				
				<p><?php esc_html_e( 'You left the search box empty, please enter a valid term.', 'gauge' ); ?></p>
			
			<?php } ?>	
			
			<?php get_search_form(); ?>
			
		</div>

		<?php if ( isset( $_GET['s'] ) && ( $_GET['s'] != '' ) ) { ?>
		
			<div class="gp-blog-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?>"<?php if ( function_exists( 'ghostpool_data_properties' ) ) { echo ghostpool_data_properties( 'taxonomy' ); } ?>>
			
				<?php if ( have_posts() ) : ?>
				
					<?php get_template_part( 'lib/sections/filter' ); ?>
							
					<div class="gp-inner-loop <?php echo sanitize_html_class( ghostpool_option( 'ajax', '', 'ajax-loop' ) ); ?>">

						<?php if ( $GLOBALS['ghostpool_format'] == 'blog-masonry' ) { ?><div class="gp-gutter-size"></div><?php } ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-review-template.php' OR $post->post_type == 'gp_user_review' ) { 
								get_template_part( 'review', 'loop' ); 
							} else {
								get_template_part( 'post', 'loop' ); 
							} ?>

						<?php endwhile; ?>
			
					</div>

					<?php echo ghostpool_pagination( $wp_query->max_num_pages ); ?>

				<?php else : ?>

					<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>

				<?php endif; ?>
			
			</div>
		
		<?php } ?>			
		
	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>