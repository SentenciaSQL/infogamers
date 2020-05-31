<?php 

if ( ! function_exists( 'ghostpool_ranking' ) ) {

	function ghostpool_ranking( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'widget_title' => '',
			'type' => 'hubs',
			'cats' => '',
			'hub_fields' => '',
			'orderby' => 'site_rating',
			'date_posted' => 'all',
			'date_modified' => 'all',
			'per_page' => '5',
			'offset' => '',
			'featured_image' => 'enabled',
			'large_image_width' => '120',
			'large_image_height' => '120',
			'small_image_width' => '80',
			'small_image_height' => '80',
			'bg_image_width' => '370',
			'bg_image_height' => '255',
			'hard_crop' => 'enabled',
			'meta_hub_cats' => '',			
			'meta_hub_fields' => '',			
			'display_site_rating' => '',	
			'display_user_rating' => '',
			'classes' => '',
		), $atts ) );	
		
		global $post;

		// Detect shortcode
		$GLOBALS['ghostpool_shortcode'] = 'ranking';
		
		// Detect review loop
		$GLOBALS['ghostpool_review_loop'] = true;
				
		// Load page variables
		ghostpool_shortcode_options( $atts );
		ghostpool_category_variables();
		
		// Unique Name	
		STATIC $gp_i = 0;
		$gp_i++;
		$gp_name = 'gp_ranking_wrapper_' . $gp_i;

		// Type		
		if ( $type == 'both' ) {
			$gp_type_hubs = 'hub-template.php';
			$gp_type_hub_reviews = 'hub-review-template.php';
			$gp_type_reviews = 'review-template.php';
			$gp_type = array( $gp_type_hubs, $gp_type_hub_reviews, $gp_type_reviews );	
			$gp_relation = 'OR';
		} elseif ( $type == 'hubs' ) {
			$gp_type_hubs = 'hub-template.php';
			$gp_type_hub_reviews = 'hub-review-template.php';
			$gp_type = array( $gp_type_hubs, $gp_type_hub_reviews );
			$gp_relation = 'OR';
		} else {
			$gp_type = 'review-template.php';
			$gp_relation = 'AND';
		}

		// Hub fields
		$gp_hub_field_args = '';
		if ( $hub_fields ) {
		
			$gp_hub_field_args = array();
		
			// Put hub fields into an array
			$gp_hub_fields_array = explode( ',', $hub_fields );

			foreach ( $gp_hub_fields_array as $gp_hub_field ) {

				// Get taxonomy e.g. genre
				$gp_taxonomy = strstr( $gp_hub_field, ':', true );
			
				// Get terms e.g. horror, romance
				$gp_terms = strstr( $gp_hub_field, ':', false );
			
				// Remove : from front of terms
				$gp_terms = ltrim( $gp_terms, ':' );
			
				// Put list of terms into an array
				$gp_terms = explode( ':', $gp_terms );
		
				// Hub field tax query
				$gp_hub_field_args[] = array( 
					'taxonomy' => $gp_taxonomy,
					'field'     => 'slug',
					'terms'     => $gp_terms,
					'operator' => 'AND',
				);	
			
			}
		}
				
		$gp_args = array(
			'post_status'     => 'publish',
			'post_type'       => 'page',
			'tax_query' 	 => array( 
				'relation' => 'AND',
				array(
					'relation' => 'OR',
					$GLOBALS['ghostpool_hub_cats'],
				),
				array(
					'relation' => 'AND',
					$gp_hub_field_args,
				),
			),
			'orderby' 	      => $GLOBALS['ghostpool_orderby_value'],
			'order' 	      => $GLOBALS['ghostpool_order'],
			'meta_key' 		  => $GLOBALS['ghostpool_meta_key'],
			'meta_query' 	  => array(
				array(
					'relation' 	  => $gp_relation,		
					array(
						'key' 	  => '_wp_page_template',
						'value'   => $gp_type,
						'compare' => 'IN'
					),
				),
				$GLOBALS['ghostpool_meta_query'],
			),
			'offset'           => $GLOBALS['ghostpool_offset'],
			'posts_per_page'   => $GLOBALS['ghostpool_per_page'],
			'paged'            => 1,
			'no_found_rows'	   => true,
			'date_query' 	   => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
			'ignore_sticky_posts' => 1,
		);
		
		ob_start(); $gp_query = new wp_query( $gp_args ); $gp_rank = 0; ?>

		<div id="<?php echo sanitize_html_class( $gp_name ); ?>" class="gp-ranking-wrapper gp-vc-element <?php echo esc_attr( $classes ); ?>">
				
			<?php if ( $gp_query->have_posts() ) : ?>

				<div class="gp-inner-loop">
			
					<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); $gp_rank++; ?>

						<?php

						// Get post or hub association ID
						$post_id = ghostpool_get_hub_id( get_the_ID() );
								
						// Get ratings data
						ghostpool_ratings( $post_id );
						
						// Ranking class
						if ( $gp_rank == 1 ) {
							$gp_ranking_class = 'gp-top-ranked-item';
						} else {
							$gp_ranking_class = 'gp-other-ranked-item';
						}
						
						// Featured image enabled class
						if ( ( ! has_post_thumbnail() OR $featured_image == 'disabled' ) && $gp_rank == 1 ) {
							$gp_featured_image_class = 'gp-featured-image-disabled';
						} else {
							$gp_featured_image_class = '';
						}
				
						// Ratings class
						if ( $GLOBALS['ghostpool_site_rating_enabled'] == true OR $GLOBALS['ghostpool_user_rating_enabled'] == true ) {
							$gp_rating_class = ' gp-rated-item';
						} else {
							$gp_rating_class = '';
						}
												
						// Background image dimensions
						$bg_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), $bg_image_width, $bg_image_height, $hard_crop, false, true );
						if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
							$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), $bg_image_width * 2, $bg_image_height * 2, $hard_crop, true, true );
						} else {
							$gp_retina = '';
						}
											
						?>
					
						<section <?php post_class( 'gp-post-item ' . $gp_rating_class . ' ' . $gp_ranking_class . ' ' . $gp_featured_image_class ); ?> style="background-image: url('<?php echo esc_url( $bg_image[0] ); ?>');">

							<?php if ( $widget_title && $gp_rank == 1 ) { ?>
								<div class="gp-element-title">
									<h3><?php echo esc_attr( $widget_title ); ?></h3>
								</div>
							<?php } ?>

							<div class="gp-ranking-number-overlay"><?php echo absint( $gp_rank ); ?></div>

							<div class="gp-bg-overlay-dark"></div>
			
							<div class="gp-foreground-overlay">
						
								<?php if ( has_post_thumbnail() && $featured_image == 'enabled' ) { ?>

									<div class="gp-post-thumbnail gp-loop-featured">
									
										<div class="<?php if ( $gp_rank == 1 ) { ?> gp-image-above<?php } else { ?> gp-image-align-left<?php } ?>">

											<?php if ( $gp_rank == 1 ) { ?>
										
												<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), $large_image_width, $large_image_height, $hard_crop, false, true );
												if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
													$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), $large_image_width * 2, $large_image_height * 2, $hard_crop, true, true );
												} else {
													$gp_retina = '';
												} ?>
									
											<?php } else { ?>
								
												<?php $gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), $small_image_width, $small_image_height, $hard_crop, false, true );
												if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
													$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), $small_image_width * 2, $small_image_height * 2, $hard_crop, true, true );
												} else {
													$gp_retina = '';
												} ?>
									
											<?php } ?>	
						
											<a href="<?php the_permalink(); ?>">
												<img src="<?php echo esc_url( $gp_image[0] ); ?>" data-rel="<?php echo esc_url( $gp_retina ); ?>" width="<?php echo absint( $gp_image[1] ); ?>" height="<?php echo absint( $gp_image[2] ); ?>" alt="<?php if ( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) { echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); } else { the_title_attribute(); } ?>" class="gp-post-image" />
											</a>				
									
										</div>
										
									</div>
							
								<?php } ?>
								
								<div class="gp-loop-content gp-image-align-left">
								
									<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true OR $GLOBALS['ghostpool_user_rating_enabled'] == true ) { ?>
										<div class="gp-rating-wrapper">
											<?php if ( $GLOBALS['ghostpool_site_rating_enabled'] == true ) { get_template_part( 'lib/sections/site', 'rating' ); } ?>
											<?php if ( $GLOBALS['ghostpool_user_rating_enabled'] == true ) { get_template_part( 'lib/sections/user', 'rating' ); } ?>
										</div>
									<?php } ?>
						
									<h3 class="gp-loop-title"><a href="<?php the_permalink(); ?>" title="<?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?>"><?php echo ghostpool_prefix_hub_title( get_the_ID() ); ?></a></h3>

									<?php if ( $meta_hub_cats == '1' ) { ?>

										<div class="gp-loop-cats">

											<?php foreach( ghostpool_option( 'hub_header_cats' ) as $gp_hub_cat ) {
												if ( has_term( $gp_hub_cat, 'gp_hubs', $post_id ) OR has_term( $gp_hub_cat, 'gp_hubs', get_the_ID() ) ) {
													$gp_term = get_term( $gp_hub_cat, 'gp_hubs' );
													$gp_t_ID = $gp_term->term_id;
													$gp_term_data = get_option( "taxonomy_$gp_t_ID" );											
													$gp_term_link = get_term_link( $gp_term, 'gp_hubs' );
													if ( ! $gp_term_link OR is_wp_error( $gp_term_link ) ) {
														continue;
													}
													?>
													<a href="<?php echo esc_url( $gp_term_link ); ?>" style="background-color: <?php echo esc_attr( $gp_term_data['color'] ); ?>"><?php echo esc_attr( $gp_term->name ); ?></a>
												<?php } ?>
											<?php } ?>

										</div>

									<?php } ?>

									<?php if ( $meta_hub_fields == '1' && ghostpool_option( 'hub_header_fields' ) ) { ?>

										<div class="gp-loop-meta">
											<?php foreach( ghostpool_option( 'hub_header_fields' ) as $gp_hub_field ) {
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
												echo html_entity_decode( $gp_term_list );	
											} ?>
										</div>

									<?php } ?>
								
								</div>
														
							</div>
									
						</section>				
	
					<?php endwhile; ?>
			
				</div>

			<?php else : ?>

				<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge-plugin' ); ?></strong>

			<?php endif; wp_reset_postdata(); ?>
			
		</div>

		<?php

		$output_string = ob_get_contents();
		ob_end_clean();
		$GLOBALS['ghostpool_shortcode'] = null;
		$GLOBALS['ghostpool_review_loop'] = null;
		return $output_string;

	}

}

add_shortcode( 'ranking', 'ghostpool_ranking' );
	
?>