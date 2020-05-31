<?php

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

// Detect review loop
$GLOBALS['ghostpool_review_loop'] = true;

// Loop options for search results page
if ( $post->post_type == 'gp_user_review' ) {
	if ( is_page_template( 'my-reviews-template.php' ) ) { 
		$GLOBALS['ghostpool_display_site_rating'] = 0;
	} else {
		$GLOBALS['ghostpool_display_site_rating'] = ghostpool_option( 'user_reviews_display_rating', 'site_rating' );
	}
	$GLOBALS['ghostpool_display_user_rating'] = 0;
}

// Get ratings data
ghostpool_ratings( get_the_ID() );

// Margin class
if ( $GLOBALS['ghostpool_title_position'] == 'title-over-thumbnail' && $GLOBALS['ghostpool_excerpt_length'] == '0' && $GLOBALS['ghostpool_meta_author'] != '1' && $GLOBALS['ghostpool_meta_date'] != '1' && $GLOBALS['ghostpool_meta_comment_count'] != '1' && $GLOBALS['ghostpool_meta_views'] != '1' && $GLOBALS['ghostpool_meta_followers'] != '1' && $GLOBALS['ghostpool_meta_tags'] != '1' && $GLOBALS['ghostpool_meta_hub_cats'] != '1' && $GLOBALS['ghostpool_meta_hub_fields'] != '1' && $GLOBALS['ghostpool_meta_hub_award'] != '1' ) {
	$gp_margin_class = ' gp-no-margin';
} else {
	$gp_margin_class = '';
}

?>

<section <?php post_class( 'gp-post-item' . $gp_margin_class ); ?> itemscope itemtype="http://schema.org/Blog">
		
	<?php if ( is_main_query() && in_the_loop() && is_archive() ) { echo ghostpool_meta_data( get_the_ID() ); } ?>
		
	<?php if ( has_post_thumbnail() && isset( $GLOBALS['ghostpool_featured_image'] ) && $GLOBALS['ghostpool_featured_image'] == 'enabled' ) { ?>

		<div class="gp-post-thumbnail gp-loop-featured">
		
			<div class="gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_image_alignment'] ); ?>">

				<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ), $GLOBALS['ghostpool_hard_crop'], false, true ); ?>
				<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_width'] ) * 2, preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_image_height'] ) * 2, $GLOBALS['ghostpool_hard_crop'], true, true );
				} else {
					$gp_retina = '';
				} ?>				

				<?php $gp_mobile_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 80, 80, $GLOBALS['ghostpool_hard_crop'], false, true ); ?>
				<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_mobile_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 80 * 2, 80 * 2, $GLOBALS['ghostpool_hard_crop'], true, true );
				} else {
					$gp_retina = '';
				} ?>
							
				<a href="<?php the_permalink(); ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>">

					<?php if ( $GLOBALS['ghostpool_title_position'] == 'title-over-thumbnail' OR ( ( $GLOBALS['ghostpool_site_rating_enabled'] == true OR $GLOBALS['ghostpool_user_rating_enabled'] == true ) && ( $GLOBALS['ghostpool_format'] != 'blog-standard' ) ) ) { ?>
						<div class="gp-bottom-bg-gradient-overlay"></div>
					<?php } ?>
						
					<?php if ( ( $GLOBALS['ghostpool_site_rating_enabled'] == true OR $GLOBALS['ghostpool_user_rating_enabled'] == true ) && ( $GLOBALS['ghostpool_format'] != 'blog-standard' ) ) { ?>
						<div class="gp-rating-wrapper">
							<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true ) { get_template_part( 'lib/sections/site', 'rating' ); } ?>
							<?php if ( $GLOBALS['ghostpool_user_rating_enabled'] == true ) { get_template_part( 'lib/sections/user', 'rating' ); } ?>
						</div>
					<?php } ?>
	
					<?php if ( $GLOBALS['ghostpool_title_position'] == 'title-over-thumbnail' ) { ?>
						<h2 class="gp-loop-title"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></h2>
					<?php } ?>
		
					<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { echo ghostpool_prefix_hub_title( get_the_ID() ); } ?>" class="gp-post-image gp-large-image" />
					
					<img src="<?php echo esc_url( $gp_mobile_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_mobile_retina ); ?>" width="<?php echo absint( $gp_mobile_image[1] ); ?>" height="<?php echo absint( $gp_mobile_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { echo ghostpool_prefix_hub_title( get_the_ID() ); } ?>" class="gp-post-image gp-mobile-image" />
						
				</a>
			
			</div>
														
		</div>
	
	<?php } ?>
	
	<?php if ( function_exists( 'ghostpool_remove_follow_button' ) ) { echo ghostpool_remove_follow_button( get_the_ID() ); } ?>
		
	<?php if ( ( $GLOBALS['ghostpool_site_rating_enabled'] == true OR $GLOBALS['ghostpool_user_rating_enabled'] == true ) && $GLOBALS['ghostpool_format'] == 'blog-standard' ) { ?>
		<div class="gp-rating-wrapper">
			<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true ) { get_template_part( 'lib/sections/site', 'rating' ); } ?>
			<?php if ( $GLOBALS['ghostpool_user_rating_enabled'] == true ) { get_template_part( 'lib/sections/user', 'rating' ); } ?>				
		</div>
	<?php } ?>
						
	<div class="gp-loop-content <?php if ( isset( $GLOBALS['ghostpool_image_alignment'] ) ) { echo 'gp-' . sanitize_html_class( $GLOBALS['ghostpool_image_alignment'] ); } ?>">
		
		<?php if ( ( $GLOBALS['ghostpool_title_position'] == 'title-next-to-thumbnail' && ( get_post_format() != 'quote' OR $GLOBALS['ghostpool_featured_image'] == 'enabled' ) ) OR ( $GLOBALS['ghostpool_title_position'] == 'title-over-thumbnail' && ! has_post_thumbnail() && get_post_format() != 'quote' ) ) { ?>
			<h2 class="gp-loop-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></a> 
			</h2>
		<?php } ?>
	
		<?php if ( ( get_post_meta( get_the_ID(), 'hub_award', true ) == '1' OR get_post_meta( get_the_ID(), 'hub_review_award', true ) == '1' ) && ( isset( $GLOBALS['ghostpool_meta_hub_award'] ) && $GLOBALS['ghostpool_meta_hub_award'] == '1' ) ) { ?>
			<div class="gp-hub-awards">
				<span class="gp-hub-award"><i class="fa <?php if ( get_post_meta( get_the_ID(), 'hub_award_icon', true ) ) { echo get_post_meta( get_the_ID(), 'hub_award_icon', true ); } elseif ( get_post_meta( get_the_ID(), 'hub_review_award_icon', true ) ) { echo get_post_meta( get_the_ID(), 'hub_review_award_icon', true ); } else { ?>fa-trophy<?php } ?>"></i><?php if ( get_post_meta( get_the_ID(), 'hub_award_title', true ) ) { echo get_post_meta( get_the_ID(), 'hub_award_title', true ); } else { echo get_post_meta( get_the_ID(), 'hub_review_award_title', true ); } ?></span>
			</div>	
		<?php } ?>
							
		<?php if ( ( isset( $GLOBALS['ghostpool_meta_hub_cats'] ) && $GLOBALS['ghostpool_meta_hub_cats'] == '1' ) && ( ! empty( $GLOBALS['ghostpool_hub_cats_selected'][0] ) ) ) { ?>

			<div class="gp-loop-cats">

				<?php foreach( $GLOBALS['ghostpool_hub_cats_selected'] as $gp_hub_cat ) {
					if ( has_term( $gp_hub_cat, 'gp_hubs', $post_id ) OR has_term( $gp_hub_cat, 'gp_hubs', get_the_ID() ) ) {
						$gp_term = get_term( $gp_hub_cat, 'gp_hubs' );
						$gp_t_ID = $gp_term->term_id;
						$gp_term_data = get_option( "taxonomy_$gp_t_ID" );											
						$gp_term_link = get_term_link( $gp_term, 'gp_hubs' );
						if ( ! $gp_term_link OR is_wp_error( $gp_term_link ) ) {
							continue;
						}
						?>
						<a href="<?php echo esc_url( $gp_term_link ); ?>"<?php if ( $gp_term_data['color'] ) { ?> style="background-color: <?php echo esc_attr( $gp_term_data['color'] ); ?>"<?php } ?>><?php echo esc_attr( $gp_term->name ); ?></a>
					<?php } ?>	

				<?php } ?>

			</div>

		<?php } ?>

		<?php if ( $GLOBALS['ghostpool_content_display'] == 'full_content' ) { ?>

			<div class="gp-loop-text">
				<?php global $more; $more = 0; the_content( esc_html__( '[Read More]', 'gauge' ) ); ?>
			</div>

		<?php } else { ?>

			<?php if ( $GLOBALS['ghostpool_excerpt_length'] != '0' ) { ?>
				<div class="gp-loop-text">
					<p><?php echo ghostpool_excerpt( $GLOBALS['ghostpool_excerpt_length'] ); ?></p>
				</div>
			<?php } ?>

		<?php } ?>

		<?php if ( ( isset( $GLOBALS['ghostpool_meta_hub_fields'] ) && $GLOBALS['ghostpool_meta_hub_fields'] == '1' ) && ghostpool_option( 'hub_cat_fields' ) ) { ?>

			<div class="gp-loop-meta">
				<?php foreach( ghostpool_option( 'hub_cat_fields' ) as $gp_hub_field ) {
					$gp_taxonomy = get_taxonomy( $gp_hub_field );
					if ( ! $gp_taxonomy ) {
						continue;
					}
					$gp_name = $gp_taxonomy->labels->singular_name;
					$gp_term_list = get_the_term_list( $post_id, $gp_hub_field, '<span class="gp-post-meta">' . $gp_name . ': ', ', ', '</span>' );		
					if ( ghostpool_option( 'hub_field_links' ) == 'disabled' ) {
						$gp_term_list = preg_replace( '/<\/?a[^>]*>/', '', $gp_term_list );
					}						
					if ( ! $gp_term_list OR is_wp_error( $gp_term_list ) ) {
						continue;
					}	
					echo wp_kses_post( $gp_term_list );	
				} ?>
			</div>

		<?php } ?>

		<?php get_template_part( 'lib/sections/loop', 'meta' ); ?>
		
		<?php if ( isset( $GLOBALS['ghostpool_meta_tags'] ) && $GLOBALS['ghostpool_meta_tags'] == '1' ) { the_tags( '<div class="gp-loop-tags">', ' ', '</div>' ); } ?>
			
	</div>
	
	<?php if ( isset( $GLOBALS['ghostpool_format'] ) && $GLOBALS['ghostpool_format'] == 'blog-large' ) { ?>
		<div class="gp-loop-divider"></div>
	<?php } ?>	
							
</section>

<?php $GLOBALS['ghostpool_review_loop'] = null; ?>