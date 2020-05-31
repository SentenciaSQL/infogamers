<?php if ( $GLOBALS['ghostpool_hub_header'] == true OR is_page_template( 'review-template.php' ) ) {

	// Get post or hub association ID
	$post_id = ghostpool_get_hub_id( get_the_ID() );

	$post_id = apply_filters( 'wpml_object_id', $post_id );

	// Get parent hub page ID if on review page
	if ( is_page_template( 'review-template.php' ) && $post->post_parent > 0 ) { 
		$post_id = $post->post_parent;
	}
	
	$gp_args = array(
		'depth'     => -1,
		'child_of'  => $post_id,
		'sort_column' => 'menu_order',
		'post_status' => array( 'publish' ),
	);

	$gp_hub_tabs = get_pages( $gp_args ); 

	if ( $gp_hub_tabs ) { ?>

		<div id="gp-hub-tabs">
		
			<div class="gp-container">
			
				<a id="gp-hub-tabs-mobile-nav-button"><?php esc_html_e( 'More Info', 'gauge' ); ?></a>
	
				<ul>
			
					<?php

					// Get hub tab title
					if ( redux_post_meta( 'gp', $post_id, 'hub_tab_title' ) ) {
						$gp_tab_title = redux_post_meta( 'gp', $post_id, 'hub_tab_title' );
					} elseif ( redux_post_meta( 'gp', $post_id, 'hub_review_tab_title' ) ) {	
						$gp_tab_title = redux_post_meta( 'gp', $post_id, 'hub_review_tab_title' );
					} else {
						$gp_tab_title = the_title_attribute( array( 'post' => $post_id, 'echo' => 0 ) );
					}
				
					// Tab title length
					$gp_max_length = 30;
				
					// Trim hub tab title
					if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) ) { 
						if ( mb_strlen( $gp_tab_title ) > $gp_max_length ) {
							$gp_trimmed_tab_title = mb_substr( $gp_tab_title, 0, $gp_max_length ) . '...';
						} else {
							$gp_trimmed_tab_title = $gp_tab_title;
						}
					} else {
						if ( strlen( $gp_tab_title ) > $gp_max_length ) {
							$gp_trimmed_tab_title = substr( $gp_tab_title, 0, $gp_max_length ) . '...';
						} else {
							$gp_trimmed_tab_title = $gp_tab_title;
						}
					}
				
					?>

					<?php if ( ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-template.php' && redux_post_meta( 'gp', $post_id, 'hub_tab' ) == 'enabled' ) OR ( get_post_meta( $post_id, '_wp_page_template', true ) == 'hub-review-template.php' && redux_post_meta( 'gp', $post_id, 'hub_review_tab' ) == 'enabled' ) ) { ?>
						<li<?php if ( get_the_ID() == $post_id ) { ?> class="current_page_item"<?php } ?>><a href="<?php echo get_permalink( $post_id ); ?>" title="<?php echo esc_attr( $gp_tab_title ); ?>"><?php echo esc_attr( $gp_trimmed_tab_title ); ?></a></li>
					<?php } ?>

					<?php 
					
					$tab_id = 1; 
					
					foreach ( $gp_hub_tabs as $gp_hub_tab ) {

						// Tab title settings
						if ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'review-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'review_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'review_tab_title' );
							$gp_tab_link = '';
							$gp_tab_target = '';
						} elseif ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'news-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'news_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'news_tab_title' );
							$gp_tab_link = '';
							$gp_tab_target = '';
						} elseif ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'images-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'images_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'images_tab_title' );
							$gp_tab_link = '';
							$gp_tab_target = '';
						} elseif ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'videos-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'videos_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'videos_tab_title' );
							$gp_tab_link = '';
							$gp_tab_target = '';
						} elseif ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'write-a-review-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'write_a_review_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'write_a_review_tab_title' );
							$gp_tab_link = '';
							$gp_tab_target = '';
						} elseif ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'user-reviews-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'user_reviews_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'user_reviews_tab_title' );
							$gp_tab_link = '';
							$gp_tab_target = '';
						} elseif ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'blog-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'blog_template_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'blog_template_tab_title' );
							$gp_tab_link = '';
							$gp_tab_target = '';
						} elseif ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'portfolio-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'portfolio_template_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'portfolio_template_tab_title' );
							$gp_tab_link = '';
							$gp_tab_target = '';
						} elseif ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'link-template.php' ) {
							$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'link_template_tab' );
							$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'link_template_tab_title' );
							$gp_tab_link = redux_post_meta( 'gp', $gp_hub_tab->ID, 'link_template_link' );
							$gp_tab_target = redux_post_meta( 'gp', $gp_hub_tab->ID, 'link_template_link_target' );
						} else {
							
							if ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == apply_filters( 'ghostpool_custom_hub_tabs', '', 'page_template', $gp_hub_tab, $tab_id ) ) {
								$gp_tab = apply_filters( 'ghostpool_custom_hub_tabs', 'enabled', 'tab', $gp_hub_tab, $tab_id );
								$gp_tab_title = apply_filters( 'ghostpool_custom_hub_tabs', '', 'tab_title', $gp_hub_tab, $tab_id );
								$gp_tab_link = apply_filters( 'ghostpool_custom_hub_tabs', '', 'tab_link', $gp_hub_tab, $tab_id );
								$gp_tab_target = apply_filters( 'ghostpool_custom_hub_tabs', '', 'tab_target', $gp_hub_tab, $tab_id );
							} else {
								$gp_tab = redux_post_meta( 'gp', $gp_hub_tab->ID, 'page_tab' );
								$gp_tab_title = redux_post_meta( 'gp', $gp_hub_tab->ID, 'page_tab_title' );
								$gp_tab_link = '';
								$gp_tab_target = '';
							}

							$tab_id++;
							
						}
						
						// Redundant please use ghostpool_custom_hub_tabs filter instead
						if ( function_exists( 'ghostpool_custom_hub_tabs' ) ) {
							ghostpool_custom_hub_tabs( $gp_hub_tab );
						}
					
						// Get other tab titles
						if ( empty( $gp_tab_title ) ) {
							$gp_tab_title = $gp_hub_tab->post_title;
						}

						// Trim other tab titles
						if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) ) { 
							if ( mb_strlen( $gp_tab_title ) > $gp_max_length ) {
								$gp_trimmed_tab_title = mb_substr( $gp_tab_title, 0, $gp_max_length ) . '...';
							} else {
								$gp_trimmed_tab_title = $gp_tab_title;
							}
						} else {
							if ( strlen( $gp_tab_title ) > $gp_max_length ) {
								$gp_trimmed_tab_title = substr( $gp_tab_title, 0, $gp_max_length ) . '...';
							} else {
								$gp_trimmed_tab_title = $gp_tab_title;
							}
						}					

						?>

						<?php if ( $gp_tab == 'enabled' ) { ?>
							<li<?php if ( get_the_ID() == $gp_hub_tab->ID ) { ?> class="current_page_item"<?php } ?>><a href="<?php if ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'link-template.php' && ! empty( $gp_tab_link ) ) { echo esc_url( $gp_tab_link ); } else { echo get_page_link( $gp_hub_tab->ID ); } ?>" title="<?php echo esc_attr( $gp_tab_title ); ?>"<?php if ( get_post_meta( $gp_hub_tab->ID, '_wp_page_template', true ) == 'link-template.php' ) { ?> target="<?php echo esc_attr( $gp_tab_target ); ?>"<?php } ?>><?php echo esc_attr( $gp_trimmed_tab_title ); ?></a></li>
						<?php } ?>

					<?php } ?>

				</ul>
			
			</div>
		
		</div>
	
	<?php

	} 
	
} ?>