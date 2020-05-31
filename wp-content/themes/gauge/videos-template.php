<?php
/*
Template Name: Videos
*/
get_header(); 

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

?>

<?php ghostpool_page_header( $post_id ); ?>

<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

	<div id="gp-content">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

			<?php if ( isset( $GLOBALS['ghostpool_hub_header'] ) && $GLOBALS['ghostpool_hub_header'] == true ) { ?>
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

		// Get video posts associated with hub
		if ( redux_post_meta( 'gp', get_the_ID(), 'videos_post_association' ) == 'enabled' ) {
			$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $post_id ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $post_id, 'compare' => '=' ) );
		}
				
		$gp_args = array(
			'post_status' => 'publish',
			'post_type'       => 'post',
			'tax_query' => array(
				'relation' => 'AND',
				$GLOBALS['ghostpool_video_cats'],
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-video' ),
				),			
			),
			'orderby'        => $GLOBALS['ghostpool_orderby_value'],
			'order'          => $GLOBALS['ghostpool_order'],	
			'meta_query' 	 => $GLOBALS['ghostpool_meta_query'],
			'meta_key' 		 => $GLOBALS['ghostpool_meta_key'],	
			'posts_per_page' => $GLOBALS['ghostpool_per_page'],
			'paged'          => $GLOBALS['ghostpool_paged'],
			'date_query' => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),	
			'ignore_sticky_posts' => 1,
		);

		$gp_query = new wp_query( $gp_args ); ?>

		<div class="gp-blog-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?>"<?php if ( function_exists( 'ghostpool_data_properties' ) ) { echo ghostpool_data_properties( 'videos-template' ); } ?>>

			<?php if ( $gp_query->have_posts() ) : ?>
			
				<?php get_template_part( 'lib/sections/filter' ); ?>
									
				<div class="gp-inner-loop <?php echo sanitize_html_class( ghostpool_option( 'ajax', '', 'ajax-loop' ) ); ?>">
				
					<?php if ( $GLOBALS['ghostpool_format'] == 'blog-masonry' ) { ?><div class="gp-gutter-size"></div><?php } ?>
							
					<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>

						<?php get_template_part( 'post', 'loop' ); ?>
			
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