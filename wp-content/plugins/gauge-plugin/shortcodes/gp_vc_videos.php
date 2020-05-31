<?php 

if ( ! function_exists( 'ghostpool_videos' ) ) {

	function ghostpool_videos( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'widget_title' => '',
			'cats' => '', 
			'post_association' => 'enabled',
			'format' => 'blog-standard',
			'size' => 'blog-small-size',
			'orderby' => 'newest',
			'date_posted' => 'all',
			'date_modified' => 'all',				
			'filter' => 'disabled',
			'filter_cats' => '',
			'filter_date' => '',
			'filter_title' => '',					
			'filter_comment_count' => '',
			'filter_views' => '',
			'filter_date_posted' => '',
			'filter_date_modified' => '',
			'filter_cats_id' => '',
			'per_page' => '5',
			'offset' => '',
			'featured_image' => 'enabled',
			'image_width' => '75',
			'image_height' => '75',
			'hard_crop' => 'enabled',
			'image_alignment' => 'image-align-left',
			'title_position' => 'title-next-to-thumbnail',
			'content_display' => 'excerpt',
			'excerpt_length' => '0',
			'meta_author' => '',
			'meta_date' => '',
			'meta_views' => '',
			'meta_comment_count' => '',
			'meta_cats' => '',
			'meta_tags' => '',
			'read_more_link' => 'enabled',
			'page_numbers' => 'disabled',
			'see_all' => 'disabled',
			'see_all_link' => '',
			'see_all_text' => esc_html__( 'See All Videos', 'gauge-plugin' ),
			'classes' => '',
		), $atts ) );
		
		global $post;

		// Detect shortcode
		$GLOBALS['ghostpool_shortcode'] = 'videos';
				
		// Load page variables
		ghostpool_shortcode_options( $atts );
		ghostpool_category_variables();
	
		// Unique Name	
		STATIC $gp_i = 0;
		$gp_i++;
		$name = 'gp_videos_wrapper_' . $gp_i;
	
		// Get post or hub association ID
		$post_id = ghostpool_get_hub_id( get_the_ID() );
				
		// Get videos page permalink if none specified
		if ( $see_all == 'enabled' && empty ( $see_all_link ) && ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) ) {
			$gp_pages = get_pages( 'child_of=' . $post_id );
			foreach ( $gp_pages as $gp_page ) {
				if ( get_post_meta( $gp_page->ID, '_wp_page_template', true ) == 'videos-template.php' ) {
					$see_all_link = get_permalink( $gp_page->ID );
				}
			}	
		}			

		// Get video posts associated with hub
		if ( $post_association == 'enabled' && ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' OR get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' ) ) {
			$GLOBALS['ghostpool_meta_query'] = array( 'relation' => 'OR', array( 'key' => 'post_association', 'value' => sprintf( ' "%s" ', $post_id ), 'compare' => 'LIKE' ), array( 'key' => '_hub_page_id', 'value' => $post_id, 'compare' => '=' ) );
		} 
		
		$gp_args = array(
			'post_status'       => 'publish',
			'post_type'    		=> 'post',
			'tax_query'    		=> array(
				'relation' 		=> 'AND',
				$GLOBALS['ghostpool_video_cats'],
				array(
					'taxonomy'  => 'post_format',
					'field'     => 'slug',
					'terms'     => array( 'post-format-video' ),
				)			
			),
			'orderby'           => $GLOBALS['ghostpool_orderby_value'],
			'order'             => $GLOBALS['ghostpool_order'],
			'meta_query' 		=> $GLOBALS['ghostpool_meta_query'],
			'meta_key'          => $GLOBALS['ghostpool_meta_key'],
			'posts_per_page'    => $GLOBALS['ghostpool_per_page'],
			'offset' 			=> $GLOBALS['ghostpool_offset'],	
			'paged'      		=> $page_numbers == 'enabled' ? $GLOBALS['ghostpool_paged'] : 1,
			'date_query' 	 => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
			'ignore_sticky_posts' => 1,
		);
		
		ob_start(); $gp_query = new wp_query( $gp_args ); ?>
		
		<div id="<?php echo sanitize_html_class( $name ); ?>" class="gp-blog-wrapper gp-vc-element gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?> gp-<?php echo sanitize_html_class( $size ); ?> <?php echo esc_attr( $classes ); ?>"<?php if ( function_exists( 'ghostpool_data_properties' ) ) { echo ghostpool_data_properties( 'videos' ); } ?>>
		
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

						<?php get_template_part( 'post', 'loop' ); ?>
				
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

add_shortcode( 'videos', 'ghostpool_videos' );
	
?>