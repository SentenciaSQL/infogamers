<?php

// Get post or hub association ID
$post_id = ghostpool_get_hub_id( get_the_ID() );

?>

<div class="gp-site-rating-wrapper gp-large-rating gp-rating-<?php echo sanitize_html_class( ghostpool_option( 'review_site_rating_style' ) ); ?>">	
	<div class="gp-rating-inner">
		<div class="gp-score-clip <?php echo sanitize_html_class( $GLOBALS['ghostpool_site_clip_class_1'] ); ?>">
			<div class="gp-score-spinner" style="-webkit-transform: rotate(<?php echo esc_attr( $GLOBALS['ghostpool_site_deg'] ); ?>deg); transform: rotate(<?php echo esc_attr( $GLOBALS['ghostpool_site_deg'] ); ?>deg);"></div>
		</div>
		<div class="gp-score-clip <?php echo sanitize_html_class( $GLOBALS['ghostpool_site_clip_class_2'] ); ?>">
			<div class="gp-score-filler"></div>
		</div>		
		<div class="gp-score-inner">
			<div class="gp-score-table">
				<div class="gp-score-cell">
					<?php echo floatval( $GLOBALS['ghostpool_total_score'] ); ?>
				</div>
			</div>
		</div>						
	</div>
	<?php if ( isset( $GLOBALS['ghostpool_site_rating_text'] ) ) { ?><h4 class="gp-rating-text"><?php echo esc_attr( $GLOBALS['ghostpool_site_rating_text'] ); ?></h4><?php } ?>
		
</div>

<?php if ( isset( $GLOBALS['ghostpool_site_rich_snippets'] ) && $GLOBALS['ghostpool_site_rich_snippets'] == true ) { ?> 
	<script type="application/ld+json">
	{
	"@context": "http://schema.org/",
		"@type": "Review",
		"mainEntityOfPage": {
			  "@type": "WebPage",
			  "@id": "<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"
		},
		"itemReviewed": {
			"@type": "Thing",
			"name": "<?php the_title_attribute( array( 'post' => $post_id ) ); ?>"
		},
		"author": {
			"@type": "Person",
			"name": "<?php echo the_author_meta( 'display_name', $post->post_author ); ?>"
		},
		"reviewRating": {
			"@type": "Rating",
			"ratingValue": "<?php echo floatval( $GLOBALS['ghostpool_total_score'] ); ?>",
			"worstRating" : "1",
			"bestRating": "<?php echo floatval( ghostpool_option( 'review_rating_number' ) ); ?>"
		}
	}
	</script>
<?php } ?>