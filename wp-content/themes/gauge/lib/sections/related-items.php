<?php

// Options
$gp_related_cats = '';
$gp_related_tags = wp_get_post_tags( get_the_ID() );
if ( is_singular( 'post' ) ) {
	$gp_post_type = 'post';
	$gp_per_page = ghostpool_option( 'post_related_items_per_page' );
	$GLOBALS['ghostpool_image_width'] = ghostpool_option( 'post_related_items_image', 'width' );
	$GLOBALS['ghostpool_image_height'] = ghostpool_option( 'post_related_items_image', 'height' );
	$gp_related_cats = wp_get_post_terms( get_the_ID(), 'category' );
} elseif ( is_singular( 'gp_portfolio_item' ) ) {
	$gp_post_type = 'gp_portfolio_item';
	$gp_per_page = ghostpool_option( 'portfolio_item_related_items_per_page' );
	$GLOBALS['ghostpool_image_width'] = ghostpool_option( 'portfolio_item_related_items_image', 'width' );
	$GLOBALS['ghostpool_image_height'] = ghostpool_option( 'portfolio_item_related_items_image', 'height' );
	$gp_related_cats = wp_get_post_terms( get_the_ID(), 'gp_portfolios' );
} elseif ( is_page_template( 'hub-review-template.php' ) OR is_page_template( 'review-template.php' ) ) {
	$gp_post_type = 'page';
	$gp_per_page = ghostpool_option( 'review_related_items_per_page' );
	$GLOBALS['ghostpool_image_width'] = ghostpool_option( 'review_related_items_image', 'width' );
	$GLOBALS['ghostpool_image_height'] = ghostpool_option( 'review_related_items_image', 'height' );
	$gp_related_cats = wp_get_post_terms( get_the_ID(), 'gp_hubs' );
}

if ( $gp_related_tags ) {
	$gp_related_items = $gp_related_tags;
} elseif ( $gp_related_cats ) {
	$gp_related_items = $gp_related_cats;
} else {
	$gp_related_items = '';
}

$gp_temp_query = $wp_query;

if ( $gp_related_items ) {

	$gp_related_ids = array();

	foreach ( $gp_related_items as $gp_related_item ) $gp_related_ids[] = $gp_related_item->term_id;

	if ( $gp_related_tags ) {	
		$gp_related_type = 'tag__in';
		$gp_related_query = $gp_related_ids;
	} elseif ( is_singular( 'gp_portfolio_item' ) && $gp_related_cats ) {
		$gp_related_type = 'tax_query';
		$gp_related_query = array( 'relation' => 'OR', array( 'taxonomy' => 'gp_portfolios', 'field' => 'term_id', 'terms' => $gp_related_ids ) );
	} elseif ( is_page_template( 'hub-review-template.php' ) OR is_page_template( 'review-template.php' ) ) {
		$gp_related_type = 'tax_query';
		$gp_related_query = array( 'relation' => 'OR', array( 'taxonomy' => 'gp_hubs', 'field' => 'term_id', 'terms' => $gp_related_ids ) );		
	} elseif ( $gp_related_cats ) {
		$gp_related_type = 'category__in';
		$gp_related_query = $gp_related_ids;
	} else {
		$gp_related_type = '';
		$gp_related_query = '';
	}
			
	$gp_args = array(
		'post_type'           => $gp_post_type,
		'orderby'             => 'rand',
		'order'               => 'asc',
		'paged'               => 1,
		'posts_per_page'      => $gp_per_page,
		'offset'              => 0,
		$gp_related_type 	  => $gp_related_query,
		'post__not_in'        => array( get_the_ID() ),
		'ignore_sticky_posts' => true,
	);

	$gp_query = new wp_query( $gp_args ); if ( $gp_query->have_posts() ) :

	?>
	
		<div class="gp-related-wrapper gp-blog-columns-<?php echo absint( $gp_per_page ); ?>">

			<div class="gp-post-section-header">		
				<h3><?php esc_html_e( 'Related Items', 'gauge' ); ?></h3>
				<span class="gp-post-section-header-line"></span>
			</div>
			
			<div class="gp-inner-loop">
			
				<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>

					<section <?php post_class( 'gp-post-item' ); ?>>
	
						<?php if ( has_post_thumbnail() ) { ?>

							<div class="gp-post-thumbnail gp-loop-featured">
						
								<div class="gp-image-above">
						
									<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ), true, false, true ); ?>
							
									<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
										$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ) * 2, preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ) * 2, true, true, true );
									} else {
										$gp_retina = '';
									} ?>
				
									<a href="<?php if ( get_post_format() == 'link' ) { echo esc_url( get_post_meta( get_the_ID(), 'link', true ) ); } else { the_permalink(); } ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"<?php if ( get_post_format() == 'link' ) { ?> target="<?php echo get_post_meta( get_the_ID(), 'link_target', true ); ?>"<?php } ?>>
							
										<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { echo ghostpool_prefix_hub_title( get_the_ID() ); } ?>" class="gp-post-image" />
										
									</a>
									
								</div>	
							
							</div>
					
						<?php } elseif ( get_post_format() != '0' ) { ?>

							<div class="gp-loop-featured">
								<?php get_template_part( 'lib/sections/loop', get_post_format() ); ?>
							</div>
							
						<?php } ?>
						
						<?php if ( get_post_format() != 'quote' OR has_post_thumbnail() ) { ?>
						
							<div class="gp-loop-content">

								<div class="gp-loop-title"><a href="<?php if ( get_post_format() == 'link' ) { echo esc_url( get_post_meta( get_the_ID(), 'link', true ) ); } else { the_permalink(); } ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></a></div>
									
								<div class="gp-loop-meta">	
									<time class="gp-post-meta gp-meta-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
								</div>
						
							</div>
						
						<?php } ?>
																		
					</section>
		
				<?php endwhile; ?>
			
			</div>
				
		</div>

	<?php endif; wp_reset_postdata(); ?>

<?php } ?>