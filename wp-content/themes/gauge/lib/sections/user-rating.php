<?php

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

?>

<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true && isset( $GLOBALS['ghostpool_review_loop'] ) ) { ?>

	<div class="gp-user-rating-wrapper gp-small-rating">
		<div class="gp-average-rating-data">
			<div class="gp-average-rating">
				<?php echo floatval( $GLOBALS['ghostpool_user_rating'] ); ?>
			</div>
			<div class="gp-user-average-text">
				<?php esc_html_e( 'User Avg', 'gauge' ); ?>
			</div>						
		</div>
	</div>
						
<?php } else { ?>

	<div class="gp-user-rating-wrapper gp-large-rating gp-rating-<?php echo sanitize_html_class( ghostpool_option( 'review_user_rating_style' ) ); ?>">
		<div class="gp-rating-inner">
			<div class="gp-score-clip <?php echo sanitize_html_class( $GLOBALS['ghostpool_user_clip_class_1'] ); ?>">
				<div class="gp-score-spinner" style="-webkit-transform: rotate(<?php echo esc_attr( $GLOBALS['ghostpool_user_deg'] ); ?>deg); transform: rotate(<?php echo esc_attr( $GLOBALS['ghostpool_user_deg'] ); ?>deg);"></div>
			</div>
			<div class="gp-score-clip <?php echo sanitize_html_class( $GLOBALS['ghostpool_user_clip_class_2'] ); ?>">
				<div class="gp-score-filler"></div>
			</div>		
			<div class="gp-score-inner">
				<div class="gp-score-table">
					<div class="gp-score-cell">
						<?php echo floatval( $GLOBALS['ghostpool_user_rating'] ); ?>
					</div>
				</div>
			</div>						
		</div>
		<h4 class="gp-rating-text"><?php esc_html_e( 'User Avg', 'gauge' ); ?></h4>
	</div>

<?php } ?>

<?php if ( isset( $GLOBALS['ghostpool_user_rich_snippets'] ) && $GLOBALS['ghostpool_user_rich_snippets'] == true ) { ?>
	<script type="application/ld+json">
	{
	"@context": "http://schema.org/",
	"@type": "Product",
		"mainEntityOfPage": {
			  "@type": "WebPage",
			  "@id": "<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"
		},	
		"name": "<?php the_title_attribute( array( 'post' => $post_id ) ); ?>",
		"image": "<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>",
		"description": "<?php echo strip_tags( esc_attr( get_post_meta( $post_id, 'hub_synopsis', true ) ) ); ?>",
		"aggregateRating": {
			"@type": "AggregateRating",
			"ratingValue": "<?php echo floatval( $GLOBALS['ghostpool_user_rating'] ); ?>",
			"ratingCount": "<?php echo floatval( get_post_meta( $post_id, '_gp_user_votes', true ) ); ?>",
			"bestRating": "<?php echo floatval( ghostpool_option( 'review_rating_number' ) ); ?>",
			"worstRating": "1"
		}
	}
	</script>
<?php } ?>