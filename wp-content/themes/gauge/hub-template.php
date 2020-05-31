<?php
/*
Template Name: Hub
*/

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		
		
	<?php ghostpool_page_header( $post_id ); ?>
		
	<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

		<div id="gp-content">

			<article <?php post_class(); ?>>
			
				<div class="gp-entry-content">
					
					<?php get_template_part( 'lib/sections/hub-details' ); ?>
				
					<?php if ( ( $GLOBALS['ghostpool_layout'] == 'gp-no-sidebar' OR $GLOBALS['ghostpool_layout'] == 'gp-fullwidth' ) && $GLOBALS['ghostpool_user_rating_box'] == 'enabled' ) { ?>
						<?php get_template_part( 'lib/sections/user-rating-box' ); ?>
					<?php } ?>

					<?php the_content(); ?>
			
				</div>

			</article>	

		</div>

		<?php get_sidebar(); ?>

	</div>
		
<?php endwhile; endif; ?>	
			
<?php get_footer(); ?>