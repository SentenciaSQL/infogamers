<?php get_header();

// Page header
ghostpool_page_header( get_the_ID() );
		
// Load page variables		
ghostpool_loop_variables();
ghostpool_category_variables();
		
?>

<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

	<div id="gp-content">

		<?php 

		// Get author ID
		$author = get_user_by( 'id', get_query_var( 'author' ) );
		$GLOBALS['ghostpool_author_id'] = $author->ID;

		$gp_args = array(
			'post_status' => 'publish',
			'author' => $GLOBALS['ghostpool_author_id'],
			'post_type' => array( 'post', 'page', 'gp_user_review' ),
			'posts_per_page' => $GLOBALS['ghostpool_per_page'],
			/*'meta_query' => array(
				'relation' => 'OR',		
				array(
					'key' => '_wp_page_template',
					'value' => array( 'hub-template.php', 'hub-review-template.php', 'review-template.php' ),
					'compare' => 'IN',
				),
				array(
					'key' => '_wp_page_template',
					'compare' => 'NOT EXISTS',
				),						
			), */
			'paged' => $GLOBALS['ghostpool_paged'],
			'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),		
		);

		$gp_query = new wp_query( $gp_args ); ?>
		
		<div class="gp-blog-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?>"<?php if ( function_exists( 'ghostpool_data_properties' ) ) { echo ghostpool_data_properties( 'author' ); } ?>>

			<?php if ( $gp_query->have_posts() ) : ?>

				<?php get_template_part( 'lib/sections/filter' ); ?>
									
				<div class="gp-inner-loop <?php echo sanitize_html_class( ghostpool_option( 'ajax', '', 'ajax-loop' ) ); ?>">
				
					<?php if ( $GLOBALS['ghostpool_format'] == 'blog-masonry' ) { ?><div class="gp-gutter-size"></div><?php } ?>

					<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>

						<?php if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-review-template.php' OR $post->post_type == 'gp_user_review' ) { 
							get_template_part( 'review', 'loop' ); 
						} else {
							get_template_part( 'post', 'loop' ); 
						} ?>

					<?php endwhile; ?>
			
				</div>

				<?php echo ghostpool_pagination( $gp_query->max_num_pages ); ?>

			<?php else : ?>

				<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>

			<?php endif; wp_reset_postdata(); ?>
			
		</div>
					
	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>