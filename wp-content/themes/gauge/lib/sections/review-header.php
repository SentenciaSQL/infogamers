<?php

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

// Get review page ID
if ( is_page_template( 'review-template.php' ) ) {
	$review_id = get_the_ID();
}

?>

<?php if ( $GLOBALS['ghostpool_page_header_text'] != 'disabled' ) { ?>
	<<?php if ( ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' OR is_single() OR is_singular( 'gp_user_review' ) ) && ! is_page_template( 'review-template.php' ) ) { ?>h2<?php } else { ?>h1<?php } ?> class="gp-entry-title"><?php if ( ! empty( $GLOBALS['ghostpool_custom_title'] ) ) { echo esc_attr( $GLOBALS['ghostpool_custom_title'] ); } elseif( is_page_template( 'review-template.php' ) ) { echo ghostpool_prefix_hub_title( get_the_ID() ); } else { echo get_the_title( $post_id ); } ?></<?php if ( ( get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post->post_parent, '_wp_page_template', true ) == 'hub-review-template.php' OR is_single() OR is_singular( 'gp_user_review' ) ) && ! is_page_template( 'review-template.php' ) ) { ?>h2<?php } else { ?>h1<?php } ?>>
<?php } ?>
	
<?php if ( $GLOBALS['ghostpool_header_avatar'] == '1' OR $GLOBALS['ghostpool_header_author_date'] == '1' ) { ?>	
	<div class="gp-author-meta">
		<?php if ( $GLOBALS['ghostpool_header_avatar'] == '1' ) { ?>
			<?php echo get_avatar( get_the_author_meta( 'ID', $post->post_author ), 40 ); ?>
		<?php } ?>	
		<?php if ( $GLOBALS['ghostpool_header_author_date'] == '1' ) { ?>						
			<h3 class="gp-author-date"><?php esc_html_e( 'By', 'gauge' ); ?> <span><?php echo the_author_meta( 'display_name', $post->post_author ); ?></span> <?php esc_html_e( 'on', 'gauge' ); ?> <time><?php the_time( get_option( 'date_format' ) ); ?></time></h3>
		<?php } ?>
	</div>
<?php } ?>

<?php if ( isset( $GLOBALS['ghostpool_hub_award'] ) && $GLOBALS['ghostpool_hub_award'] == '1' ) { ?>
	<div class="gp-hub-awards">
		<span class="gp-hub-award"><i class="fa <?php echo sanitize_html_class( $GLOBALS['ghostpool_hub_award_icon'] ); ?>"></i><?php echo esc_attr( $GLOBALS['ghostpool_hub_award_title'] ); ?></span>
	</div>	
<?php } ?>

<?php if ( isset( $GLOBALS['ghostpool_header_cats'] ) && ! empty( $GLOBALS['ghostpool_header_cats'][0] ) ) { ?>
	
	<div class="gp-entry-cats">

		<?php foreach( $GLOBALS['ghostpool_header_cats'] as $gp_hub_cat ) {
			if ( has_term( $gp_hub_cat, 'gp_hubs', $review_id ) OR has_term( $gp_hub_cat, 'gp_hubs', get_the_ID() ) ) {
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

<?php if ( $GLOBALS['ghostpool_affiliate_button_link'] ) { ?>
	<a href="<?php echo $GLOBALS['ghostpool_affiliate_button_link']; ?>" id="gp-affiliate-button" rel="nofollow" target="<?php echo apply_filters( 'gp_affiliate_link_target', '' ); ?>">
		<?php echo $GLOBALS['ghostpool_affiliate_button_text']; ?>
	</a>	
<?php } ?>