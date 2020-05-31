<?php 

if ( ! function_exists( 'ghostpool_blog' ) ) {

	function ghostpool_blog( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'widget_title' => '',
			'cats' => '', 
			'hub_fields' => '',
			'post_association' => 'enabled',
			'post_types' => 'post',
			'format' => 'blog-standard',
			'size' => 'blog-standard-size',
			'orderby' => 'newest',
			'date_posted' => 'all',
			'date_modified' => 'all',
			'filter' => 'disabled',
			'filter_cats' => '',
			'filter_date' => '',
			'filter_title' => '',					
			'filter_comment_count' => '',
			'filter_views' => '',
			'filter_followers' => '',
			'filter_site_rating' => '',
			'filter_user_rating' => '',
			'filter_hub_awards' => '',
			'filter_date_posted' => '',
			'filter_date_modified' => '',
			'filter_cats_id' => '',
			'per_page' => '12',
			'offset' => '',
			'featured_image' => 'enabled',
			'image_width' => '140',
			'image_height' => '140',
			'hard_crop' => 'enabled',
			'image_alignment' => 'image-align-left',
			'title_position' => 'title-next-to-thumbnail',
			'content_display' => 'excerpt',
			'excerpt_length' => '160',
			'meta_author' => '',
			'meta_date' => '',
			'meta_comment_count' => '',
			'meta_views' => '',
			'meta_followers' => '',
			'meta_cats' => '',
			'meta_tags' => '',			
			'meta_hub_cats' => '',			
			'meta_hub_fields' => '',
			'meta_hub_award' => '',			
			'display_site_rating' => '',	
			'display_user_rating' => '',
			'read_more_link' => 'enabled',
			'page_numbers' => 'disabled',
			'see_all' => 'disabled',
			'see_all_link' => '',
			'see_all_text' => esc_html__( 'See All Items', 'gauge-plugin' ),
			'classes' => '',
		), $atts ) );
							
		global $post;
				
		// Detect shortcode
		$GLOBALS['ghostpool_shortcode'] = 'blog';

		// Load page variables
		ghostpool_shortcode_options( $atts );
		ghostpool_category_variables();
				
		// Unique Name	
		STATIC $gp_i = 0;
		$gp_i++;
		$gp_name = 'gp_blog_wrapper_' . $gp_i;

		// Get post or hub association ID
		$post_id = ghostpool_get_hub_id( get_the_ID() );
				
		// Get blog posts associated with hub
		if ( $post_association == 'enabled' && ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) ) {
			$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $post_id ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $post_id, 'compare' => '=' ) );	
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
			'post_status'    => 'publish',
			'post_type'      => explode( ',', $GLOBALS['ghostpool_post_types'] ),
			'tax_query' 	 => array( 
				'relation' => 'AND',
				$GLOBALS['ghostpool_tax'],
				array(
					'relation' => 'AND',
					$gp_hub_field_args,
				),
			),
			'orderby' 		 => $GLOBALS['ghostpool_orderby_value'],
			'order' 		 => $GLOBALS['ghostpool_order'],	
			'meta_query' 	 => $GLOBALS['ghostpool_meta_query'],
			'meta_key' 		 => $GLOBALS['ghostpool_meta_key'],
			'posts_per_page' => $GLOBALS['ghostpool_per_page'],
			'offset' 		 => $GLOBALS['ghostpool_offset'],	
			'paged'          => $page_numbers == 'enabled' ? $GLOBALS['ghostpool_paged'] : 1,   
			'date_query' 	 => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
			'ignore_sticky_posts' => 1,
		);

		ob_start(); $gp_query = new wp_query( $gp_args ); ?>		

		<div id="<?php echo sanitize_html_class( $gp_name ); ?>" class="gp-blog-wrapper gp-vc-element gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?> gp-<?php echo sanitize_html_class( $size ); ?> <?php echo esc_attr( $classes ); ?>"<?php if ( function_exists( 'ghostpool_data_properties' ) ) { echo ghostpool_data_properties( 'blog' ); } ?>>

			<?php if ( $widget_title OR $see_all == 'enabled' ) { ?>
				<div class="gp-element-title">
					<?php if ( $widget_title ) { ?><h3><?php echo esc_attr( $widget_title ); ?></h3><?php } ?>
					<?php if ( $see_all == 'enabled' ) { ?>
						<div class="gp-see-all-link"><a href="<?php echo esc_url( $see_all_link ); ?>"><?php echo esc_attr( $see_all_text ); ?></a></div>
					<?php } ?>
					<div class="gp-element-title-line"></div>
				</div>
			<?php } ?>
			
			<?php get_template_part( 'lib/sections/filter' ); ?>
			
			<?php if ( $gp_query->have_posts() ) : ?>
				
				<div class="gp-inner-loop <?php echo sanitize_html_class( ghostpool_option( 'ajax', '', 'ajax-loop' ) ); ?>">
			
					<?php if ( $GLOBALS['ghostpool_format'] == 'blog-masonry' ) { ?><div class="gp-gutter-size"></div><?php } ?>
					
					<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>

						<?php if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'review-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'hub-review-template.php' OR $post->post_type == 'gp_user_review' ) { 
							get_template_part( 'review', 'loop' ); 
						} else {
							get_template_part( 'post', 'loop' ); 
						} ?>

					<?php endwhile; ?>
		
				</div>

				<?php if ( $page_numbers == 'enabled' ) { ?>
					<?php echo ghostpool_pagination( $gp_query->max_num_pages ); ?>
				<?php } ?>
		
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

add_shortcode( 'blog', 'ghostpool_blog' );
	
?>