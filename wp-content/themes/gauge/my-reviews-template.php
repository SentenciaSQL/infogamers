<?php
/*
Template Name: My Reviews
*/

if ( is_user_logged_in() && 'POST' == $_SERVER['REQUEST_METHOD'] ) {
	set_query_var( 'delete_post', $_POST['ghostpool_user_review_id'] );
	wp_delete_post( get_query_var( 'delete_post' ), true );
}
	 
get_header();

// Page header
ghostpool_page_header( get_the_ID() );
		
// Load page variables		
ghostpool_loop_variables();
ghostpool_category_variables();
			
?>

<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

	<div id="gp-content">

		<?php if ( is_user_logged_in() ) {
			
			$gp_current_user = wp_get_current_user();

			$gp_args = array(
				'post_status' => 'publish',
				'author' => $gp_current_user->ID,
				'post_type' => 'gp_user_review',
				'paged' => $GLOBALS['ghostpool_paged'],
				'posts_per_page' => $GLOBALS['ghostpool_per_page'],
			);

			$gp_query = new wp_query( $gp_args ); ?>
		
			<div class="gp-blog-wrapper gp-approved-reviews-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?><?php if ( ghostpool_option( 'write_a_review_submitting') != 'pending' && ghostpool_option( 'write_a_review_editing' ) != 'pending' ) { ?> gp-approved-reviews-fullwidth<?php } ?>"<?php if ( function_exists( 'ghostpool_data_properties' ) ) { echo ghostpool_data_properties( 'approved-user-reviews' ); } ?>>
		
				<div class="gp-post-section-header">		
					<h3><?php esc_html_e( 'Approved Reviews', 'gauge' ); ?></h3>
					<span class="gp-post-section-header-line"></span>
				</div>

				<?php if ( $gp_query->have_posts() ) : ?>
								
					<div class="gp-inner-loop <?php echo sanitize_html_class( ghostpool_option( 'ajax', '', 'ajax-loop' ) ); ?>">
								
						<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>
							   
							<section <?php post_class( 'gp-post-item' ); ?>>
 
								<div class="gp-loop-title">
									<a href="<?php the_permalink(); ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></a> 
								</div>

								<?php ghostpool_my_review_links(); ?> 
							
							</section>	
				
						<?php endwhile; ?>
			
					</div>

					<?php echo ghostpool_pagination( $gp_query->max_num_pages ); ?>

				<?php else : ?>

					<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>

				<?php endif; wp_reset_postdata(); ?>

			</div>
				
			<?php 
			
			if ( ghostpool_option( 'write_a_review_submitting' ) == 'pending' OR ghostpool_option( 'write_a_review_editing' ) == 'pending' ) {
		
				$gp_args = array(
					'post_status' => 'pending',
					'author' => $gp_current_user->ID,
					'post_type' => 'gp_user_review',
					'paged' => $GLOBALS['ghostpool_paged'],
					'posts_per_page' => $GLOBALS['ghostpool_per_page'],
				);

				$gp_query = new wp_query( $gp_args ); ?>
		
				<div class="gp-blog-wrapper gp-pending-reviews-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?>"<?php if ( function_exists( 'ghostpool_data_properties' ) ) { echo ghostpool_data_properties( 'pending-user-reviews' ); } ?>>

					<div class="gp-post-section-header">		
						<h3><?php esc_html_e( 'Pending Reviews', 'gauge' ); ?></h3>
						<span class="gp-post-section-header-line"></span>
					</div>

					<?php if ( $gp_query->have_posts() ) : ?>
								
						<div class="gp-inner-loop <?php echo sanitize_html_class( ghostpool_option( 'ajax', '', 'ajax-loop' ) ); ?>">
								
							<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>
							   
								<section <?php post_class( 'gp-post-item' ); ?>>
 
									<div class="gp-loop-title">
										<a href="<?php the_permalink(); ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></a> 
									</div>

									<?php ghostpool_my_review_links(); ?> 
							
								</section>	
											
							<?php endwhile; ?>
			
						</div>

						<?php echo ghostpool_pagination( $gp_query->max_num_pages ); ?>

					<?php else : ?>

						<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>

					<?php endif; wp_reset_postdata(); ?>

				</div>
		
			<?php } ?>
					
		<?php } else { ?>
		
			<strong class="gp-no-items-found"><?php esc_html_e( 'You must be logged in to view your reviews.', 'gauge' ); ?></strong>
			
		<?php } ?>
								
	</div>

	<?php get_sidebar(); ?>
	
</div>

<?php get_footer(); ?>