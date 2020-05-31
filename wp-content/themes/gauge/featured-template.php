<?php
/*
Template Name: Featured
*/
get_header(); global $post;

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

// Load page variables		
ghostpool_loop_variables();
ghostpool_category_variables();
	
// Use "Games" hub category for demo imported homepage
if ( isset( $GLOBALS['ghostpool_cats'] ) && ! term_exists( $GLOBALS['ghostpool_cats'] ) && $GLOBALS['ghostpool_cats'] == 48 ) {
	$GLOBALS['ghostpool_tax'] = array( array( 'taxonomy' => 'gp_hubs', 'terms' => array( 'hub-games' ), 'field' => 'slug' ) );
}
		
$gp_args = array(
	'post_status'    => 'publish',
	'tax_query'      => $GLOBALS['ghostpool_tax'],
	'posts_per_page' => 3,
	'no_found_rows' => true,
	'ignore_sticky_posts' => 1,
);

$gp_query = new wp_query( $gp_args ); $gp_counter = 1; if ( $gp_query->have_posts() ) : ?>

	<div id="gp-featured-wrapper">
	
		<div class="gp-container" style="height: <?php echo absint( $GLOBALS['ghostpool_slider_height'] ); ?>px;">

		<?php if ( ghostpool_option( 'title_bg_top_gradient_overlay' ) == 'enabled' ) { ?>
			<div class="gp-top-bg-gradient-overlay"></div>
		<?php } ?>

		<?php if ( $GLOBALS['ghostpool_side_gradient_overlay'] == 'enabled' ) { ?>
			<div class="gp-side-bg-gradient-overlay"></div>
		<?php } ?>	

		<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>

			<?php

			// Get post or hub association ID
			$post_id = ghostpool_get_hub_id( get_the_ID() );
		
			if ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' ) {
				$GLOBALS['ghostpool_display_site_rating'] = 1;
				$GLOBALS['ghostpool_display_user_rating'] = 1;
				ghostpool_ratings( $post_id );
			}

			// Featured image
			if ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' ) {
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'hub_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'hub_title_bg' ) : '';
			} elseif ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) {
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'hub_review_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'hub_review_title_bg' ) : '';		
			} elseif ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'portfolio-template.php' )  {
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'portfolio_template_title_bg' ) : '';
			} elseif ( is_singular( 'gp_portfolio_item' ) ) {
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'portfolio_item_title_bg' ) : '';
			} elseif ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'blog-template.php' )  {
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'blog_template_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'blog_template_title_bg' ) : '';
			} elseif ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'following-template.php' ) {				
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'following_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'following_title_bg' ) : '';	
			} elseif ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' ) {
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'review_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'review_title_bg' ) : '';	
			} elseif ( $post->post_type == 'post' ) {
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'post_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'post_title_bg' ) : '';
			} else {
				$GLOBALS['ghostpool_page_header_bg'] = redux_post_meta( 'gp', get_the_ID(), 'page_title_bg' ) ? redux_post_meta( 'gp', get_the_ID(), 'page_title_bg' ) : '';
			}
									
			if ( ! empty( $GLOBALS['ghostpool_page_header_bg']['url'] ) ) {
		
				$gp_image = aq_resize( $GLOBALS['ghostpool_page_header_bg']['url'], $GLOBALS['ghostpool_slider_width'], $GLOBALS['ghostpool_slider_height'], true, false, true );
				if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_retina = aq_resize( $GLOBALS['ghostpool_page_header_bg']['url'], $GLOBALS['ghostpool_slider_width'] * 2, $GLOBALS['ghostpool_slider_height'] * 2, true, true, true );
				} else {
					$gp_retina = '';
				}
			
			} elseif ( has_post_thumbnail() ) {

				$gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), $GLOBALS['ghostpool_slider_width'], $GLOBALS['ghostpool_slider_height'], true, false, true );
				if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), $GLOBALS['ghostpool_slider_width'] * 2, $GLOBALS['ghostpool_slider_height'] * 2, true, true, true );
				} else {
					$gp_retina = '';
				}
		
			}
										
			?>				

			<?php if ( isset( $gp_counter ) && $gp_counter % 3 == 1 ) { ?>
				<div class="gp-large-post">
			<?php } elseif ( ( isset( $gp_counter ) && $gp_counter % 3 == 2 ) && $gp_query->current_post != 0 ) { ?>
				<div class="gp-small-posts">
			<?php } ?>

				<?php if ( ghostpool_option( 'slide_link' ) OR $post->post_type != 'gp_slide' ) { ?><a href="<?php if ( $post->post_type == 'gp_slide' ) { echo esc_url( ghostpool_option( 'slide_link' ) ); } else { the_permalink(); } ?>"<?php if ( $post->post_type == 'gp_slide' ) { ?> target="<?php echo esc_url( ghostpool_option( 'slide_link_target' ) ); ?>"<?php } ?>><?php } ?>

					<div class="gp-featured-post"<?php if ( has_post_thumbnail() OR ! empty( $GLOBALS['ghostpool_page_header_bg']['url'] ) ) { ?> style="background-image: url(<?php echo esc_url( $gp_image[0] ); ?>);" data-rel="<?php echo esc_url( $gp_retina ); ?>"<?php } ?>>

						<?php if ( ghostpool_option( 'slide_caption_title' ) OR ghostpool_option( 'slide_caption_text' ) OR $post->post_type != 'gp_slide' ) { ?>

							<div class="gp-featured-caption">

								<?php if ( ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' ) && ( $GLOBALS['ghostpool_site_rating_enabled'] == true OR $GLOBALS['ghostpool_user_rating_enabled'] == true ) && ( ghostpool_option( 'featured_ratings' ) == 'enabled' ) ) { ?>
									<div class="gp-rating-wrapper gp-header-rating">
										<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true ) { get_template_part( 'lib/sections/site', 'rating' ); } ?>			
										<?php if ( $GLOBALS['ghostpool_user_rating_enabled'] == true ) { get_template_part( 'lib/sections/user', 'rating' ); } ?>
									</div>
								<?php } ?>
										
								<?php if ( ghostpool_option( 'slide_caption_title' ) OR $post->post_type != 'gp_slide' ) { ?>
									<h2 class="gp-featured-caption-title"><?php if ( $post->post_type == 'gp_slide' ) { echo esc_attr( ghostpool_option( 'slide_caption_title' ) ); } else { echo ghostpool_prefix_hub_title( get_the_ID() ); } ?></h2>
								<?php } ?>

								<?php if ( ( ghostpool_option( 'slide_caption_text' ) OR $post->post_type != 'gp_slide' ) && isset( $gp_counter ) && $gp_counter % 3 == 1 ) { ?>
									<div class="gp-featured-caption-text"><?php if ( $post->post_type == 'gp_slide' ) { echo esc_attr( ghostpool_option( 'slide_caption_text' ) ); } else { echo ghostpool_excerpt( 100 ); } ?></div>
								<?php } ?>
			
							</div>

						<?php } ?>
				
						<?php if ( $GLOBALS['ghostpool_bottom_gradient_overlay'] == 'enabled' ) { ?>
							<div class="gp-bottom-bg-gradient-overlay"></div>
						<?php } ?>
										
					</div>	
				
				<?php if ( ghostpool_option( 'slide_link' ) OR $post->post_type != 'gp_slide' ) { ?></a><?php } ?>

			<?php if ( ( isset( $gp_counter ) && $gp_counter % 3 == 1 ) ) { ?>
				</div>
			<?php } elseif ( ( isset( $gp_counter ) && $gp_counter % 3 == 0 ) OR ( ( ( $gp_query->current_post + 1 ) == $gp_query->post_count ) && $gp_query->current_post != 0 ) ) { ?>
				</div>
			<?php } ?>
			
			
		<?php $gp_counter++; endwhile; ?>
		
		</div>
		
	</div>

<?php else : ?>

	<div id="gp-homepage-slider" class="gp-no-slider"></div>

<?php endif; wp_reset_postdata(); ?>

<?php if ( ghostpool_option( 'header_ad' ) ) { ?>
	<?php if ( ghostpool_option( 'header_ad_exclude' ) == 'enabled' && ( is_404() OR is_attachment() ) ) {} else { ?>
		<div id="gp-header-area">
			<div class="gp-container">
				<?php echo do_shortcode( ghostpool_option( 'header_ad' ) ); ?>
			</div>
		</div>
	<?php } ?>	
<?php } ?>
		
<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

	<div id="gp-content">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				
	
			<?php the_content(); ?>	
		
		<?php endwhile; endif; ?>		

	</div>
	
	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>