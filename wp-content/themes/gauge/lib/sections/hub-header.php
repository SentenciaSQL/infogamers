<?php
		
// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );
	
// Get review page ID
if ( is_page_template( 'review-template.php' ) ) {
	$review_id = get_the_ID();
} else {
	$review_id = $post_id;
}

?>

<?php if ( has_post_thumbnail( $review_id ) && $GLOBALS['ghostpool_hub_featured_image'] == 'enabled' ) { ?>

	<div class="gp-hub-header-thumbnail">
	
		<div class="gp-post-thumbnail">

			<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( $review_id ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_hub_image_width'] ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_hub_image_height'] ), true, false, true ); ?>
			<?php if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
				$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( $review_id ) ), preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_hub_image_width'] ) * 2, preg_replace( '/[^0-9]/', '', $GLOBALS['ghostpool_hub_image_height'] ) * 2, $GLOBALS['ghostpool_hub_hard_crop'], true, true );
			} else {
				$gp_retina = '';
			} ?>

			<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { echo ghostpool_prefix_hub_title( get_the_ID() ); } ?>" class="gp-post-image" />

		</div>

		<?php if ( function_exists( 'ghostpool_follow_button' ) ) { ghostpool_follow_button( $post_id ); } ?>
		
	</div>
		
<?php } ?>	

<div id="gp-hub-header-info"<?php if ( ! has_post_thumbnail( $review_id ) OR $GLOBALS['ghostpool_hub_featured_image'] == 'disabled' ) { ?> class="gp-no-thumbnail"<?php } ?>>
	
	<?php if ( $GLOBALS['ghostpool_page_header_text'] != 'disabled' ) { ?>
		<<?php if ( ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' OR is_single() OR is_singular( 'gp_user_review' ) ) && ! is_page_template( 'review-template.php' ) ) { ?>h2<?php } else { ?>h1<?php } ?> class="gp-entry-title"><?php if ( $GLOBALS['ghostpool_custom_title'] ) { echo $GLOBALS['ghostpool_custom_title']; } elseif( is_page_template( 'review-template.php' ) ) { echo ghostpool_prefix_hub_title( get_the_ID() ); } else { echo get_the_title( $post_id ); } ?></<?php if ( ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' OR is_single() OR is_singular( 'gp_user_review' ) ) && ! is_page_template( 'review-template.php' ) ) { ?>h2<?php } else { ?>h1<?php } ?>>	
	<?php } ?>
	
	<?php if ( isset( $GLOBALS['ghostpool_hub_award'] ) && $GLOBALS['ghostpool_hub_award'] == '1' ) { ?>
		<div class="gp-hub-awards">
			<span class="gp-hub-award"><i class="fa <?php echo sanitize_html_class( $GLOBALS['ghostpool_hub_award_icon'] ); ?>"></i><?php echo esc_attr( $GLOBALS['ghostpool_hub_award_title'] ); ?></span>
		</div>	
	<?php } ?>
		
	<?php if ( isset( $GLOBALS['ghostpool_header_cats'] ) && ! empty( $GLOBALS['ghostpool_header_cats'][0] ) ) { ?>
	
		<div class="gp-entry-cats">
	
			<?php foreach( $GLOBALS['ghostpool_header_cats'] as $gp_hub_cat ) {
				if ( has_term( $gp_hub_cat, 'gp_hubs', $review_id ) ) {
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
	
	<?php if ( isset( $GLOBALS['ghostpool_header_fields'] ) && ! empty( $GLOBALS['ghostpool_header_fields'][0] ) ) { ?>
	
		<div class="gp-entry-meta">
			
			<?php foreach( $GLOBALS['ghostpool_header_fields'] as $gp_hub_field ) {
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
	
	<?php if ( function_exists( 'ghostpool_follow_button' ) ) { ghostpool_follow_button( $post_id ); } ?>
		
	<?php if ( $GLOBALS['ghostpool_affiliate_button_link'] ) { ?>
		<a href="<?php echo $GLOBALS['ghostpool_affiliate_button_link']; ?>" id="gp-affiliate-button" rel="nofollow" target="<?php echo apply_filters( 'gp_affiliate_link_target', '' ); ?>">
			<?php echo $GLOBALS['ghostpool_affiliate_button_text']; ?>
		</a>	
	<?php } ?>

	<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true OR $GLOBALS['ghostpool_user_rating_enabled'] == true ) { ?>

		<div class="gp-rating-wrapper gp-header-rating">
			<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true ) { get_template_part( 'lib/sections/site', 'rating' ); } ?>
			<?php if ( $GLOBALS['ghostpool_user_rating_enabled'] == true ) { get_template_part( 'lib/sections/user', 'rating' ); } ?>
		</div>
	
	<?php }  ?>
										
</div>