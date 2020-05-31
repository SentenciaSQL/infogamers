<?php 

if ( ! function_exists( 'ghostpool_featured' ) ) {

	function ghostpool_featured( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'widget_title' => '',
			'post_id' => '',
			'page_id' => '',
			'featured_image' => 'enabled',
			'image_width' => '264',
			'image_height' => '264',
			'hard_crop' => 'enabled',
			'image_alignment' => 'image-align-left',
			'title_position' => 'title-next-to-thumbnail',
			'content_display' => 'excerpt',
			'excerpt_length' => '250',
			'meta_author' => '',
			'meta_date' => '',
			'meta_comment_count' => '',
			'meta_views' => '',
			'meta_followers' => '',
			'meta_cats' => '',
			'meta_tags' => '',			
			'meta_hub_cats' => '',			
			'meta_hub_fields' => '',			
			'display_site_rating' => '',	
			'display_user_rating' => '',
			'read_more_link' => 'enabled',			
			'classes' => '',
			'css' => '',
			'text_color' => '',
			'background_overlay' => 'enabled',
		), $atts ) );
		
		global $post;

		// Detect shortcode
		$GLOBALS['ghostpool_shortcode'] = 'featured';
		
		// Load page variables
		ghostpool_shortcode_options( $atts );
		$GLOBALS['ghostpool_format'] = 'blog-standard';
				
		// Unique Name	
		STATIC $gp_i = 0;
		$gp_i++;
		$gp_name = 'gp_featured_wrapper_' . $gp_i;
					
		// CSS Editor
		$gp_css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $classes . vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
		
		$gp_args = array(
			'post_status' => 'publish',
			'post_type' => array( 'post', 'page' ),
			'p' => is_numeric( $post_id ) ? absint( $post_id ) : '',
			'page_id' => is_numeric( $page_id ) ? absint( $page_id ) : '',
			'name' => ! is_numeric( $post_id ) ? esc_attr( $post_id ) : '',
			'pagename' => ! is_numeric( $page_id ) ? esc_attr( $page_id ) : '',
			'posts_per_page' => 1,
			'paged' => 1,
			'no_found_rows' => true,
			'ignore_sticky_posts' => 1,
		);
		
		ob_start(); $gp_query = new wp_query( $gp_args ); ?>

		<div id="<?php echo sanitize_html_class( $gp_name ); ?>" class="gp-featured-wrapper gp-vc-element gp-blog-standard <?php echo sanitize_html_class( $gp_css_class ); ?>">
		
			<div class="gp-featured-title-overlay"><?php echo esc_attr( $widget_title ); ?></div>

			<?php if ( $background_overlay == 'enabled' ) { ?><div class="gp-bg-overlay-dark"></div><?php } ?>
			
			<?php if ( $gp_query->have_posts() ) : ?>

				<div class="gp-inner-loop"<?php if ( !empty( $text_color ) ) { ?> style="color: <?php echo esc_attr( $text_color ); ?>"<?php } ?>>
							
					<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>

						<?php if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-review-template.php' OR $post->post_type == 'gp_user_review' ) { 
							get_template_part( 'review', 'loop' );
						} else {
							get_template_part( 'post', 'loop' ); 
						} ?>
			
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
		return $output_string;

	}

}

add_shortcode( 'featured', 'ghostpool_featured' );
	
?>