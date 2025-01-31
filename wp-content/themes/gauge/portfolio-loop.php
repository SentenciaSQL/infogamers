<?php

// Portfolio Categories
$gp_terms = get_the_terms( get_the_ID(), 'gp_portfolios' );
if ( isset( $GLOBALS['ghostpool_cats'] ) ) {
	$gp_cat_array = explode( ',', $GLOBALS['ghostpool_cats'] );
}
$gp_portfolio_cats = null;
if ( ! empty( $gp_terms ) ) {
	foreach ( $gp_terms as $gp_term ) {
		if ( ! empty( $gp_cat_array[0] ) ) {
		foreach( $gp_cat_array as $gp_cat ) {
				if ( $gp_term->term_id == $gp_cat ) {		
					$gp_portfolio_cats .= sanitize_title( $gp_term->slug ) . ' ';
				}
			}
		} else {
			$gp_portfolio_cats .= sanitize_title( $gp_term->slug ) . ' ';
		}	
	}
} ?>

<section <?php post_class( 'gp-portfolio-item ' . $gp_portfolio_cats . ghostpool_option( 'portfolio_item_image_size' ) ); ?> data-portfolio-cat="<?php echo esc_attr( $gp_portfolio_cats ); ?>" itemscope itemtype="http://schema.org/Blog">
		
	<?php if ( is_main_query() && in_the_loop() && is_archive() ) { echo ghostpool_meta_data( get_the_ID() ); } ?>
		
	<?php if ( has_post_thumbnail() ) { ?>

		<div class="gp-post-thumbnail gp-loop-featured">
		
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				
				<?php if ( $GLOBALS['ghostpool_format'] != 'portfolio-masonry' ) {
				
					$gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), apply_filters( 'gp_portfolio_standard_image_width', '700' ), apply_filters( 'gp_portfolio_standard_image_height', '500' ), true, false, true );
				
				} elseif ( ghostpool_option( 'portfolio_item_image_size' ) == 'wide' ) {
				
					$gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), apply_filters( 'gp_portfolio_wide_image_width', '1000' ), apply_filters( 'gp_portfolio_wide_image_height', '500' ), true, false, true );
					
				} elseif ( ghostpool_option( 'portfolio_item_image_size' ) == 'tall' ) {
				
					$gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), apply_filters( 'gp_portfolio_tall_image_width', '500' ), apply_filters( 'gp_portfolio_tall_image_height', '1000' ), true, false, true );
				
				} elseif ( ghostpool_option( 'portfolio_item_image_size' ) == 'large' ) {
					
					$gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), apply_filters( 'gp_portfolio_large_image_width', '1000' ), apply_filters( 'gp_portfolio_large_image_height', '1000' ), true, false, true );								
				
				} else {
				
					$gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), apply_filters( 'gp_portfolio_square_image_width', '500' ), apply_filters( 'gp_portfolio_square_image_height', '500' ), true, false, true );			
				
				} ?>
				
				<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), ( $gp_image[1] * 2 ), ( $gp_image[2] * 2 ), true, true, true );
				} else {
					$gp_retina = '';
				} ?>
				
				<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), ( $gp_image[1] * 2 ), ( $gp_image[2] * 2 ), true, true, true );
				} else {
					$gp_retina = '';
				} ?>
				
				<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute(); } ?>" class="gp-post-image" />
							
			</a>
			
		</div>

	<?php } ?>

	<?php if ( $GLOBALS['ghostpool_format'] != 'portfolio-masonry' ) { ?>

		<h2 class="gp-loop-title" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	
	<?php } ?>
			
</section>