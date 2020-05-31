<?php
/*
Template Name: Hub Review
*/
get_header(); 

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

?>

<?php ghostpool_page_header( $post_id ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		

	<div id="gp-review-content-wrapper" class="gp-container<?php if ( ghostpool_option( 'review_first_letter_styling' ) == 'enabled' ) { ?> gp-review-first-letter<?php } ?><?php if ( $GLOBALS['ghostpool_sidebar_position'] == 'top' ) { ?> gp-top-sidebar<?php } ?>">

		<div id="gp-review-content">
	
			<article <?php post_class(); ?>>
	
				<?php if ( ghostpool_option( 'hub_review_subtitle' ) ) { ?>
					<h2 class="gp-subtitle"><?php echo esc_attr( ghostpool_option( 'hub_review_subtitle' ) ); ?></h2>
				<?php } ?>

				<?php if ( ghostpool_option( 'review_share_icons' ) ) { ?>
					<div class="gp-share-icons"><?php echo do_shortcode( ghostpool_option( 'review_share_icons' ) ); ?></div>
				<?php } ?>
				
				<div class="gp-entry-content">

					<?php get_template_part( 'lib/sections/hub-details' ); ?>
					
					<div class="gp-entry-text">
						<?php the_content(); ?>
					</div>

					<?php wp_link_pages( 'before=<div class="gp-pagination gp-pagination-numbers gp-standard-pagination gp-entry-pagination"><ul class="page-numbers">&pagelink=<span class="page-numbers">%</span>&after=</ul></div>' ); ?>
		
				</div>

				<?php if ( ghostpool_option( 'review_meta', 'tags' ) == '1' ) { ?>
					<?php the_tags( '<div class="gp-entry-tags">', ' ', '</div>' ); ?>
				<?php } ?>

			</article>

		</div>
		
		<?php if ( $GLOBALS['ghostpool_sidebar_position'] == 'top' ) {
			get_sidebar();
		} ?>
	
	</div>
		
	<?php get_template_part( 'lib/sections/review', 'results' ); ?>	
			
	<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?><?php if ( $GLOBALS['ghostpool_sidebar_position'] == 'top' ) { ?> gp-top-sidebar<?php } ?>">

		<div id="gp-content">
			
			<?php if ( ghostpool_option( 'review_author_info' ) == 'enabled' ) { ?>
				<?php get_template_part( 'lib/sections/author', 'info' ); ?>
			<?php } ?>

			<?php if ( ghostpool_option( 'review_related_items' ) == 'enabled' ) { ?>
				<?php get_template_part( 'lib/sections/related', 'items' ); ?>
			<?php } ?>

			<?php if ( $GLOBALS['ghostpool_user_rating_box'] == 'enabled' && ( $GLOBALS['ghostpool_layout'] == 'gp-no-sidebar' OR $GLOBALS['ghostpool_layout'] == 'gp-fullwidth' ) ) { ?>
				<?php get_template_part( 'lib/sections/user-rating-box' ); ?>
			<?php } ?>
						
			<?php comments_template(); ?>
	
		</div>
		
		<?php if ( $GLOBALS['ghostpool_sidebar_position'] == 'bottom' ) {
			get_sidebar();
		} ?>
	
	</div>
									
<?php endwhile; endif; ?>			

<?php get_footer(); ?>