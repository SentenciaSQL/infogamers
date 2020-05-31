<?php global $ratings;

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

// Get average user rating
if ( get_post_meta( $post_id, '_gp_user_rating', true ) ) { 
	$gp_user_rating = number_format( get_post_meta( $post_id, '_gp_user_rating', true ), 1 ) + 0;
} else {
	$gp_user_rating = 0;
}

// Get total votes
$gp_user_votes = get_post_meta( $post_id, '_gp_user_votes', true );
if ( ! $gp_user_votes ) {
	$gp_user_votes = 0;
}
if ( ! $gp_user_votes ) {
	$gp_user_votes_text = esc_html__( ' votes', 'gauge');
} elseif ( $gp_user_votes == 1 ) {
	$gp_user_votes_text = esc_html__( ' vote', 'gauge');
} else {
	$gp_user_votes_text = esc_html__( ' votes', 'gauge');	
}

// Get write a review page template URL
if ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) {
	$gp_pages = get_pages( 'child_of=' . $post_id );	
	foreach ( $gp_pages as $gp_page ) {	
		if ( get_post_meta( $gp_page->ID, '_wp_page_template', true ) == 'write-a-review-template.php' ) {
			$gp_write_a_review_link = get_permalink( $gp_page->ID );
			break;
		} else {
			$gp_write_a_review_link = '';
		}
	}
}

// Get user reviews page template URL
if ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR  get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) {
	$gp_pages = get_pages( 'child_of=' . $post_id );	
	foreach ( $gp_pages as $gp_page ) {	
		if ( get_post_meta( $gp_page->ID, '_wp_page_template', true ) == 'user-reviews-template.php' ) {
			$gp_user_reviews_link = get_permalink( $gp_page->ID );
			break;
		} else {
			$gp_user_reviews_link = '';
		}
	}
}
			
// Count number of user reviews
$gp_args = array(
	'post_status' => 'publish',
	'post_type'       => 'gp_user_review',
	'meta_query' => array(
		array(
		   'key' => '_hub_page_id',
		   'value' => $post_id,
		   'compare' => '=',
		),
	),
	'posts_per_page' => -1,
);
$gp_query = new wp_query( $gp_args ); 
					
?>

<div id="gp-user-rating-wrapper"<?php echo wp_kses_post( $GLOBALS['ghostpool_title_bg_css'] ); ?>>

	<div class="gp-bg-overlay-dark"></div>

	<div class="gp-foreground-overlay">
	
		<div class="gp-average-rating-wrapper">
		
			<div class="gp-average-rating-text">
				<span><?php esc_html_e( 'Average User Rating', 'gauge' ); ?></span>
				<?php if ( ! empty( $gp_write_a_review_link ) ) { ?><a href="<?php echo esc_url( $gp_write_a_review_link ); ?>" class="button gp-write-a-review-button"><?php esc_html_e( 'Write A Review', 'gauge' ); ?></a><?php } ?>
				<?php if ( ! empty( $gp_user_reviews_link ) ) { ?><a href="<?php echo esc_url( $gp_user_reviews_link ); ?>" class="gp-user-reviews-link"><?php echo absint( $gp_query->post_count ); ?> <?php esc_html_e( 'User Reviews', 'gauge' ); ?></a><?php } ?>
			</div>
			
			<div class="gp-average-rating-data">
				<div class="gp-average-rating">
					<?php echo floatval( $gp_user_rating ); ?>
				</div>	
				<div class="gp-total-votes gp-current-rating">
					<span class="gp-count"><?php echo absint( $gp_user_votes ); ?></span> <?php echo esc_attr( $gp_user_votes_text ); ?>
				</div>
			</div>

		</div>			

		<?php if ( ( ghostpool_option( 'review_can_users_rate' ) == 'enabled' && ! is_user_logged_in() ) OR is_user_logged_in() ) { ?>
		
			<div class="gp-rating-criteria-wrapper">		
				<div class="gp-rate-text"><?php esc_html_e( 'Rate', 'gauge' ); ?></div>	
				<div class="gp-rating-slider-wrapper" style="width: <?php echo absint( 24 * ghostpool_option( 'review_rating_number' ) ); ?>px;">
					<div class="gp-rating-unrated">
						<div class="gp-rating-selection"></div>
					</div>
				</div>
			</div>
			
			<div class="gp-submit-rating button"><?php esc_html_e( 'Submit', 'gauge' ); ?></div>
		
		<?php } else { ?>

			<div class="gp-sign-in-to-rate"><?php esc_html_e( 'Please', 'gauge' ); ?> <a href="<?php if ( ghostpool_option( 'popup_box' ) == 'enabled' ) { echo '#login'; } else { wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ); } ?>" id="gp-login-link" title="<?php esc_html_e( 'Sign In', 'gauge' ); ?>"><?php esc_html_e( 'sign in', 'gauge' ); ?></a> <?php esc_html_e( 'to rate.', 'gauge' ); ?></div>

		<?php } ?>
			
		<div class="gp-your-rating-wrapper">
			<div class="gp-your-rating-text">
				<?php esc_html_e( 'Your Rating', 'gauge' ); ?>
			</div>	

			<div class="gp-your-rating gp-current-rating">	
				<span class="gp-score">0</span>
			</div>
						
		</div>

	</div>
	
</div>