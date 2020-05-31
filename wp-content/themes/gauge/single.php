<?php get_header();

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

// Page header
ghostpool_page_header( $post_id );

// Load page variables		
ghostpool_loop_variables();

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div id="gp-content-wrapper"<?php if ( $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) { ?> class="gp-container"<?php } ?>>

		<div id="gp-content">

			<article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
					
				<?php echo ghostpool_meta_data( get_the_ID() ); ?>
				
				<header class="gp-entry-header">

					<h1 class="gp-entry-title" itemprop="headline"><?php the_title(); ?></h1>

					<?php if ( ghostpool_option( 'post_subtitle' ) ) { ?>
						<h2 class="gp-subtitle"><?php echo esc_attr( ghostpool_option( 'post_subtitle' ) ); ?></h2>
					<?php } ?>

					<?php get_template_part( 'lib/sections/entry', 'meta' ); ?>

					<?php if ( ghostpool_option( 'post_share_icons' ) ) { ?>
						<div class="share-icons"><?php echo do_shortcode( ghostpool_option( 'post_share_icons' ) ); ?></div>
					<?php } ?>

				</header>
		
				<?php if ( has_post_thumbnail() && $GLOBALS['ghostpool_featured_image'] == 'enabled' && get_post_format() == '0' ) { ?>

					<div class="gp-post-thumbnail gp-entry-featured">
					
						<div class="gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_image_alignment'] ); ?>">

							<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ), $GLOBALS['ghostpool_hard_crop'], false, true ); ?>
							<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
								$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ) * 2, preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ) * 2, $GLOBALS['ghostpool_hard_crop'], true, true );
							} else {
								$gp_retina = '';
							} ?>

							<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute(); } ?>" class="gp-post-image" />

						</div>

					</div>
					
				<?php } elseif ( get_post_format() != '0' ) { ?>

					<div class="gp-entry-featured">
						<?php get_template_part( 'lib/sections/entry', get_post_format() ); ?>
					</div>

				<?php } ?>
				
				<div class="gp-entry-content gp-<?php if ( isset( $GLOBALS['ghostpool_image_alignment'] ) ) { echo sanitize_html_class( $GLOBALS['ghostpool_image_alignment'] ); } ?>">
								
					<?php if ( get_post_format() != 'quote' && get_post_format() != 'link' ) { ?>

						<div class="gp-entry-text" itemprop="text"><?php the_content(); ?></div>
					
					<?php } ?>	
				
					<?php wp_link_pages( 'before=<div class="gp-pagination gp-pagination-numbers gp-standard-pagination gp-entry-pagination"><ul class="page-numbers">&pagelink=<span class="page-numbers">%</span>&after=</ul></div>' ); ?>
	
				</div>
				
				<?php if ( ghostpool_option( 'post_meta', 'tags' ) == '1' ) { ?>
					<?php the_tags( '<div class="gp-entry-tags">', ' ', '</div>' ); ?>
				<?php } ?>

				<?php if ( ghostpool_option( 'post_author_info' ) == 'enabled' ) { ?>
					<?php get_template_part( 'lib/sections/author', 'info' ); ?>
				<?php } ?>

				<?php if ( ghostpool_option( 'post_related_items' ) == 'enabled' ) { ?>
					<?php get_template_part( 'lib/sections/related', 'items' ); ?>
				<?php } ?>

				<?php comments_template(); ?>

			</article>

		</div>

		<?php get_sidebar(); ?>

	</div>

<?php endwhile; endif; ?>	
	
<?php get_footer(); ?>