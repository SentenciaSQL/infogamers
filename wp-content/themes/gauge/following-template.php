<?php
/*
Template Name: Following
*/
get_header();

// Page header
ghostpool_page_header( get_the_ID() );

?>

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

		<?php if ( function_exists( 'ghostpool_list_follow_items' ) && ghostpool_list_follow_items() ) {
		
			// Load page variables		
			ghostpool_loop_variables();
			ghostpool_category_variables();
			
			$gp_args = array(
				'post_status' => 'publish',
				'post_type'   => 'page', 
				'post__in'    => ghostpool_list_follow_items(),
				'orderby'     => 'post__in',
				'order'       => 'asc',
				'per_page'    => redux_post_meta( 'gp', get_the_ID(), 'following_hub_items_per_page' ),
				'paged'       => $GLOBALS['ghostpool_paged'],
			);

			$gp_query = new wp_query( $gp_args ); ?>	

			<div class="gp-blog-wrapper gp-following-wrapper gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?>">

				<?php if ( $gp_query->have_posts() ) : ?>
				
					<?php ghostpool_cookie_warning(); ?>
					
					<div class="gp-inner-loop">

						<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); 
						
						// Hub ID
						$gp_follow_page_id = get_the_ID();
						
						// Display modified items
						if ( ghostpool_option( 'following_hub_items_modified' ) == 'enabled' ) {
							$gp_modified = array( 'column' => 'post_modified_gmt', 'after' =>  ghostpool_option( 'following_hub_items_days_ago' ) . ' days ago' );
						} else {
							$gp_modified = '';
						}	

						?>

							<?php get_template_part( 'review', 'loop' ); ?>
							
							<?php
							
							// Hub posts and child pages that have been created in the last X days
							$gp_args = array(
								'post_status' => 'publish',
								'post_type'   => ghostpool_option( 'following_hub_items_post_types' ),
								'posts_per_page' => ghostpool_option( 'following_hub_items_per_page' ),
								'paged' => 1,
								'meta_query'  => array( 
									'relation' => 'OR',
									array( 'key' => 'post_association', 'value' => $gp_follow_page_id, 'compare' => 'LIKE' ),
									array( 'key' => '_hub_page_id', 'value' => $gp_follow_page_id, 'compare' => 'LIKE' ),
									array( 'key' => '_wp_page_template', 'value' => 'review-template.php', 'compare' => '=' ),
								),	
								'date_query' => array(
									'relation' => 'OR',
									array(
										'column' => 'post_date_gmt', 'after' =>  ghostpool_option( 'following_hub_items_days_ago' ) . ' days ago'
									), 
										$gp_modified
									),	
							);

							$gp_i_query = new wp_query( $gp_args ); ?>	
		
							<?php if ( $gp_i_query->have_posts() ) : ?>
							
								<div class="gp-followed-content">
								
									<div class="gp-last-updated-title"><?php echo sprintf( esc_html__( 'Last %s updates from the last %s days', 'gauge' ), ghostpool_option( 'following_hub_items_per_page' ), ghostpool_option( 'following_hub_items_days_ago' ) ); ?></div>
								
									<?php while ( $gp_i_query->have_posts() ) : $gp_i_query->the_post(); 
								
										// Display if a post or child of hub page
										if ( $post->post_type == 'post' OR $post->post_type == 'gp_user_review' OR ( $gp_follow_page_id == $post->post_parent ) ) { ?>
								
											<section <?php post_class( 'gp-post-item' ); ?>>

												<div class="gp-loop-title"><a href="<?php the_permalink(); ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></a></div>
																										
												<div class="gp-loop-meta">	
													<span class="gp-post-meta gp-meta-date"><?php the_time( get_option( 'date_format' ) ); ?><?php if ( ghostpool_option( 'following_hub_items_modified' ) == 'enabled' && ( get_the_modified_date( get_option( 'date_format' ) ) != get_the_time( get_option( 'date_format' ) ) ) ) { ?> (<?php esc_html_e( 'Updated on' , 'gauge' ); ?> <?php the_modified_date( get_option( 'date_format' ) ); ?>)<?php } ?></span>
												</div>
											
											</section>	
									
										<?php } ?>
								
									<?php endwhile; ?>
								
								</div>	
								
							<?php endif; wp_reset_postdata(); ?>

						<?php endwhile; ?>

					</div>
				
					<?php echo ghostpool_clear_list_link(); ?>

					<?php echo ghostpool_pagination( $gp_query->max_num_pages ); ?>

				<?php else : ?>

					<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge' ); ?></strong>

				<?php endif; wp_reset_postdata(); ?>
			
			</div>

		<?php } else { ?>
		
			<?php if ( ghostpool_option( 'hub_following_items' ) == 'both' OR ( is_user_logged_in() && ghostpool_option( 'hub_following_items' ) == 'members' ) ) { ?>
			
				<strong class="gp-no-items-found"><?php esc_html_e( 'You are not currently following any items.', 'gauge' ); ?></strong>
			
			<?php } else { ?>
			
				<strong class="gp-no-items-found"><?php esc_html_e( 'Please login to follow items.', 'gauge' ); ?></strong>
			
			<?php } ?>
			
		<?php } ?>
	
	</div>

	<?php get_sidebar(); ?>
	
</div>

<?php get_footer(); ?>