<?php

$GLOBALS['ghostpool_display_site_rating'] = '1';		
$GLOBALS['ghostpool_display_user_rating'] = '0';	
	
// Get ratings data				
ghostpool_ratings( get_the_ID() );

if ( ghostpool_option( 'hub_review_good_points' ) OR ghostpool_option( 'hub_review_bad_points' ) OR $GLOBALS['ghostpool_site_rating_enabled'] == true ) { ?>

	<div id="gp-review-summary" class="<?php if ( count( $GLOBALS['ghostpool_site_rating'] ) > 1 ) { ?>gp-rating-criteria<?php } ?>"<?php echo wp_kses_post( $GLOBALS['ghostpool_title_bg_css'] ); ?>>

		<?php if ( ghostpool_option( 'title_bg_top_gradient_overlay' ) == 'enabled' && ! empty( $GLOBALS['ghostpool_page_header_bg'] ) ) { ?>
			<div class="gp-top-bg-gradient-overlay"></div>
		<?php } ?>
	
		<?php if ( ghostpool_option( 'title_bg_overlay' ) == 'enabled' && ! empty( $GLOBALS['ghostpool_page_header_bg'] ) ) { ?>
			<div class="gp-bg-overlay-light"></div>
		<?php } ?>
	
		<div class="gp-container">
		
			<div id="gp-points-wrapper">

				<?php if ( ! empty( $GLOBALS['ghostpool_good_points'][0] ) ) { ?>
					<div class="gp-good-points">
						<h4 class="gp-good-title"><?php esc_html_e( 'Good', 'gauge' ); ?></h4>
						<ul>
							<?php foreach( $GLOBALS['ghostpool_good_points'] as $gp_good_point ) { ?>							
								<li><i class="fa fa-plus-square"></i><?php echo esc_attr( $gp_good_point ); ?></li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>

				<?php if ( ! empty( $GLOBALS['ghostpool_bad_points'][0] ) ) { ?>
					<div class="gp-bad-points">
						<h4 class="gp-bad-title"><?php esc_html_e( 'Bad', 'gauge' ); ?></h4>
						<ul>
							<?php foreach( $GLOBALS['ghostpool_bad_points'] as $gp_bad_point ) { ?>							
								<li><i class="fa fa-minus-square"></i><?php echo esc_attr( $gp_bad_point ); ?></li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
				
			</div>

			<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true ) { ?>  

				<div class="gp-rating-wrapper gp-header-rating">
									
					<?php 	
					
					$GLOBALS['ghostpool_site_rich_snippets'] = true;	
					get_template_part( 'lib/sections/site', 'rating' );
					$GLOBALS['ghostpool_site_rich_snippets'] = false;	
					
					?>

					<?php if ( count( $GLOBALS['ghostpool_site_rating'] ) > 1 && count( $GLOBALS['ghostpool_rating_criteria'] ) > 1 ) { ?>
						<div class="gp-site-rating-criteria-wrapper gp-rating-<?php echo sanitize_html_class( ghostpool_option( 'review_site_rating_style' ) ); ?>">
							<?php $gp_site_ratings = $GLOBALS['ghostpool_site_rating'];
							foreach( $GLOBALS['ghostpool_rating_criteria'] as $rating => $criteria ) { ?>
								<?php if ( isset( $gp_site_ratings[$rating] ) ) { ?>
									<div class="gp-site-rating-criteria">
										<?php $rating_percentage = floatval( ( ( $gp_site_ratings[$rating] / ghostpool_option( 'review_rating_number' ) ) * 100 ) ); ?>
										<div class="gp-site-rating-slider-wrapper">
											<div class="gp-site-rating-unselected">
												<span class="gp-site-rating-criteria-text"><?php echo esc_attr( $criteria ); ?> - <?php echo floatval( $gp_site_ratings[$rating] ); ?></span>
												<div class="gp-site-rating-selection" style="width: <?php echo floatval( $rating_percentage ); ?>%;"></div>
											</div>
										</div>
									</div>	
								<?php } ?>				
							<?php } ?>
						</div>				
					<?php } ?>

				</div>
			
			<?php } ?>
						
		</div>
													
	</div>

<?php } ?>