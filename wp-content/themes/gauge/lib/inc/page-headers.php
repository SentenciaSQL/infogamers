<?php

if ( ! function_exists( 'ghostpool_page_header' ) ) {

	function ghostpool_page_header( $gp_post_id = '' ) {
		
		global $post;		
		
		// Get post or hub association ID
		//$post_id = ghostpool_get_hub_id( get_the_ID() );

		// Get ratings data	
		ghostpool_ratings( $gp_post_id );

		// Rich snippets
		$GLOBALS['ghostpool_site_rich_snippets'] = true;	
		if ( $GLOBALS['ghostpool_site_rating_enabled'] != true ) {
			$GLOBALS['ghostpool_user_rich_snippets'] = true;
		} else {
			$GLOBALS['ghostpool_user_rich_snippets'] = false;
		}
		if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) != 'hub-template.php' && get_post_meta( get_the_ID(), '_wp_page_template', true ) != 'review-template.php' && get_post_meta( get_the_ID(), '_wp_page_template', true ) != 'hub-review-template.php' ) {
			$GLOBALS['ghostpool_site_rich_snippets'] = false;
			$GLOBALS['ghostpool_user_rich_snippets'] = false;
		}
				
		// Detect WooCommerce
		if ( function_exists( 'is_woocommerce' ) && ( is_shop() OR is_product_category() OR is_product_tag() ) ) {
			$gp_woocommerce = true;
			$gp_post_id = get_option( 'woocommerce_shop_page_id' ); // Get WooCommerce shop page ID
		} else {
			$gp_woocommerce = '';
		}
		
		// Detect BuddyPress
		if ( function_exists( 'bp_is_active' ) && ! bp_is_blog_page() ) {
			$gp_buddypress = true;
		} else {
			$gp_buddypress = '';
		}
		
		// Detect bbPress
		if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
			$gp_bbpress = true;
		} else {
			$gp_bbpress = '';
		}
		
		// Get review page ID
		if ( is_page_template( 'review-template.php' ) ) {
			$gp_post_id = get_the_ID();
		}
			
		// Background image
		if ( $GLOBALS['ghostpool_hub_header'] == true ) {
			if ( get_post_meta( $gp_post_id, '_wp_page_template', true ) == 'hub-template.php' ) {
				$GLOBALS['ghostpool_page_header_bg'] = get_post_meta( $gp_post_id, 'hub_title_bg', true );
			} else {
				$GLOBALS['ghostpool_page_header_bg'] = get_post_meta( $gp_post_id, 'hub_review_title_bg', true );
			}	
		}		
		if ( ( is_singular() OR $gp_woocommerce == true OR $gp_bbpress == true OR is_search() OR is_author() ) && ! empty( $GLOBALS['ghostpool_page_header_bg']['url'] ) ) {
			//echo 'Ind: Post, page, search, author and shop background from title header option';
			//echo ' Global: BuddyPress background from title header option';
			$GLOBALS['ghostpool_title_bg_css'] = ' style="background-image: url(' . $GLOBALS['ghostpool_page_header_bg']['url'] . ');"';
		} elseif ( ( is_singular() OR $gp_woocommerce == true OR $gp_bbpress == true ) && has_post_thumbnail( $gp_post_id ) ) {
			//echo 'Ind: Post, page, search, author and shop background from featured image';
			//echo ' Global: BuddyPress background from featured image';
			$GLOBALS['ghostpool_title_bg_css'] = ' style="background-image: url(' . wp_get_attachment_url( get_post_thumbnail_id( $gp_post_id ) ) . ');"';
		} elseif ( is_archive() && ! is_search() && ! is_author() && ! empty( $GLOBALS['ghostpool_page_header_bg'][0] ) ) {	
			//echo 'Ind: Category background image';
			$GLOBALS['ghostpool_title_bg_css'] = ' style="background-image: url(' . $GLOBALS['ghostpool_page_header_bg'] . ');"';
		} elseif ( ( ( $gp_woocommerce == true OR $gp_bbpress == true ) && is_archive() ) && ! empty( $GLOBALS['ghostpool_page_header_bg']['url'] ) ) {
			//echo 'Global: WooCommerce product categories or bbPress forums/topics global image';
			$GLOBALS['ghostpool_title_bg_css'] = ' style="background-image: url(' . ghostpool_option( 'title_bg', 'background-image' ) . ');"';
		} elseif ( ghostpool_option( 'title_bg', 'background-image' ) ) {
			//echo 'Global background image';
			$GLOBALS['ghostpool_title_bg_css'] = ' style="background-image: url(' . ghostpool_option( 'title_bg', 'background-image' ) . ');"';
		} else {
			//echo 'Empty';		
			$GLOBALS['ghostpool_title_bg_css'] = '';		
		}

		// Parallax effect
		if ( ghostpool_option( 'title_parallax' ) == 'enabled' ) {
			$GLOBALS['ghostpool_parse_parallax_scrolling'] = ' data-stellar-background-ratio="0.6"';
			$GLOBALS['ghostpool_parallax_class'] = 'gp-parallax';
		} else {
			$GLOBALS['ghostpool_parse_parallax_scrolling'] = '';
			$GLOBALS['ghostpool_parallax_class'] = '';
		}
		
		// Video header classes
		if ( $GLOBALS['ghostpool_hub_header'] == true ) {
			if ( get_post_meta( $gp_post_id, '_wp_page_template', true ) == 'hub-template.php' ) {
				$GLOBALS['ghostpool_teaser_video_bg'] = get_post_meta( $gp_post_id, 'hub_title_teaser_video_bg', true );
				$GLOBALS['ghostpool_full_video_bg'] = get_post_meta( $gp_post_id, 'hub_title_full_video_bg', true );
			} else {
				$GLOBALS['ghostpool_teaser_video_bg'] = get_post_meta( $gp_post_id, 'hub_review_title_teaser_video_bg', true );
				$GLOBALS['ghostpool_full_video_bg'] = get_post_meta( $gp_post_id, 'hub_review_title_full_video_bg', true );			
			}	
		}
		if ( ! empty( $GLOBALS['ghostpool_teaser_video_bg'] ) OR ! empty( $GLOBALS['ghostpool_full_video_bg'] ) ) {
			$GLOBALS['ghostpool_video_header_class'] = 'gp-has-video';
		} else {
			$GLOBALS['ghostpool_video_header_class'] = '';
		}
		if ( ! empty( $GLOBALS['ghostpool_teaser_video_bg'] ) ) {
			$GLOBALS['ghostpool_teaser_video_header_class'] = 'gp-has-teaser-video';
		} else {
			$GLOBALS['ghostpool_teaser_video_header_class'] = '';
		}
		
		// Hub and review header classes
		if ( isset( $GLOBALS['ghostpool_title_header_format'] ) && $GLOBALS['ghostpool_title_header_format'] == 'hub-header' ) {
			$gp_title_header_class = 'gp-hub-header';
		} elseif ( isset( $GLOBALS['ghostpool_title_header_format'] ) && $GLOBALS['ghostpool_title_header_format'] == 'review-header' ) {
			$gp_title_header_class = 'gp-hub-header gp-review-header';
		} else {
			$gp_title_header_class = 'gp-standard-header';
		}
											
		if ( $GLOBALS['ghostpool_page_header'] == 'gp-large-title' ) { ?>
	
			<header class="gp-page-header <?php echo esc_attr( $gp_title_header_class ); ?> <?php echo sanitize_html_class( $GLOBALS['ghostpool_parallax_class'] ); ?> <?php echo sanitize_html_class( $GLOBALS['ghostpool_video_header_class'] ); ?> <?php echo sanitize_html_class( $GLOBALS['ghostpool_teaser_video_header_class'] ); ?>"<?php echo wp_kses_post( $GLOBALS['ghostpool_parse_parallax_scrolling'] ); ?><?php echo wp_kses_post( $GLOBALS['ghostpool_title_bg_css'] ); ?>>
											
				<?php if ( ghostpool_option( 'title_bg_top_gradient_overlay' ) == 'enabled' && ( $GLOBALS['ghostpool_title_bg_css'] != '' OR ! empty( $GLOBALS['ghostpool_teaser_video_bg'] ) ) ) { ?>
					<div class="gp-top-bg-gradient-overlay"></div>
				<?php } ?>
		
				<?php if ( ghostpool_option( 'title_bg_overlay' ) == 'enabled' && ( $GLOBALS['ghostpool_title_bg_css'] != '' OR ! empty( $GLOBALS['ghostpool_teaser_video_bg'] ) ) ) { ?>
					<div class="gp-bg-overlay-light"></div>
				<?php } ?>

				<?php if ( ! empty( $GLOBALS['ghostpool_teaser_video_bg'] ) OR ! empty( $GLOBALS['ghostpool_full_video_bg'] ) ) {

					// YouTube or Vimeo ID
					$GLOBALS['ghostpool_full_video_bg'] = str_replace( 'www.', '', $GLOBALS['ghostpool_full_video_bg'] );
					if ( preg_match( '/http:\/\/vimeo/', $GLOBALS['ghostpool_full_video_bg'] ) ) {
						$gp_id = str_replace('http://vimeo.com/', '', $GLOBALS['ghostpool_full_video_bg'] );
						$gp_provider = 'vimeo';
					} elseif ( preg_match( '/https:\/\/vimeo/', $GLOBALS['ghostpool_full_video_bg'] ) ) {
						$gp_id = str_replace('https://vimeo.com/', '', $GLOBALS['ghostpool_full_video_bg'] );
						$gp_provider = 'vimeo';
					} elseif ( preg_match( '/http:\/\/youtube.com/', $GLOBALS['ghostpool_full_video_bg'] ) ) {
						$gp_id = str_replace('http://youtube.com/watch?v=', '', $GLOBALS['ghostpool_full_video_bg'] );
						$gp_provider = 'youtube';
					} elseif ( preg_match( '/https:\/\/youtube.com/', $GLOBALS['ghostpool_full_video_bg'] ) ) {
						$gp_id = str_replace('https://youtube.com/watch?v=', '', $GLOBALS['ghostpool_full_video_bg'] );
						$gp_provider = 'youtube';
					} elseif ( preg_match( '/http:\/\/youtu.be/', $GLOBALS['ghostpool_full_video_bg'] ) ) {
						$gp_id = str_replace( 'http://youtu.be/', '', $GLOBALS['ghostpool_full_video_bg'] );	
						$gp_provider = 'youtube';		
					} elseif ( preg_match( '/https:\/\/youtu.be/', $GLOBALS['ghostpool_full_video_bg'] ) ) {
						$gp_id = str_replace( 'https://youtu.be/', '', $GLOBALS['ghostpool_full_video_bg'] );	
						$gp_provider = 'youtube';													
					} else {
						$gp_id = $GLOBALS['ghostpool_full_video_bg'];
						$gp_provider = 'html5';
					}
										
					?>
	
					<div class="gp-video-header">
						<span class="gp-video-media" data-video-src="<?php echo esc_attr( $gp_id ); ?>" data-teaser-source="<?php echo esc_url( $GLOBALS['ghostpool_teaser_video_bg'] ); ?>" data-provider="<?php echo esc_attr( $gp_provider ); ?>"></span>
						<div class="gp-close-video-button"></div>
					</div>
				
				<?php } ?>
							
				<div class="gp-container">
										
					<?php if ( ! empty( $GLOBALS['ghostpool_full_video_bg'] ) ) { ?>
						<div class="gp-play-video-button-wrapper">
							<a href="<?php echo esc_url( $GLOBALS['ghostpool_full_video_bg'] ); ?>" class="gp-play-video-button"></a>
						</div>	
					<?php } ?>
									
					<?php if ( isset( $GLOBALS['ghostpool_page_header_text'] ) && $GLOBALS['ghostpool_page_header_text'] != 'disabled' ) { ?>
					
						<?php if ( ( $GLOBALS['ghostpool_hub_header'] == true OR is_page_template( 'review-template.php' ) ) && $GLOBALS['ghostpool_title_header_format'] == 'hub-header' ) {
		
							get_template_part( 'lib/sections/hub', 'header' );

						} elseif ( ( $GLOBALS['ghostpool_hub_header'] == true OR is_page_template( 'review-template.php' ) ) && $GLOBALS['ghostpool_title_header_format'] == 'review-header' ) {
		
							get_template_part( 'lib/sections/review', 'header' );
				
						} elseif ( is_singular( 'gp_portfolio_item' ) ) { ?>
					
							<h1 class="gp-entry-title" itemprop="headline"><?php echo get_the_title( $gp_post_id ); ?></h1>

							<?php if ( get_post_meta( get_the_ID(), 'portfolio_item_link', true ) ) { ?>
								<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'portfolio_item_link', true ) ); ?>" class="button gp-portfolio-link" target="<?php echo esc_attr( $GLOBALS['ghostpool_link_target'] ); ?>"><?php echo esc_attr( $GLOBALS['ghostpool_link_text'] ); ?></a>
							<?php } ?>
							
						<?php } elseif ( is_singular() OR $gp_woocommerce == true OR $gp_buddypress == true OR $gp_bbpress == true ) { ?>

							<h1 class="gp-entry-title<?php if ( ! empty( $GLOBALS['ghostpool_subtitle'] ) ) { ?> gp-has-subtitle<?php } ?>" itemprop="headline"><?php if ( ! empty( $GLOBALS['ghostpool_custom_title'] ) ) { echo esc_attr( $GLOBALS['ghostpool_custom_title'] ); } else { echo get_the_title( $gp_post_id ); } ?></h1>

							<?php if ( ! empty( $GLOBALS['ghostpool_subtitle'] ) ) { ?>
								<h3 class="gp-subtitle"><?php echo esc_attr( $GLOBALS['ghostpool_subtitle'] ); ?></h3>
							<?php } ?>
																																	
						<?php } elseif ( is_search() ) { global $wp_query, $s; ?>
					
							<h1 class="gp-entry-title" itemprop="headline">
								<?php if ( isset( $_GET['s'] ) && ( $_GET['s'] != '' ) ) { ?>
									<?php echo absint( $wp_query->found_posts ); ?> <?php esc_html_e( 'search results for', 'gauge' ); ?> "<?php echo esc_html( $s ); ?>"
								<?php } else { ?>
									<?php esc_html_e( 'Search', 'gauge' ); ?>
								<?php } ?>	
							</h1>
					
						<?php } elseif ( is_category() OR is_tag() OR is_tax() ) { ?>
					
							<h1 class="gp-entry-title<?php if ( category_description() != '' ) { ?> gp-has-subtitle<?php } ?>" itemprop="headline"><?php single_cat_title(); ?></h1>
							
							<?php if ( category_description() != '' ) { ?>
								<h2 class="gp-subtitle"><?php echo str_replace( array( '<p>', '</p>' ), '', category_description() ); ?></h2>
							<?php } ?>
					
						<?php } elseif ( is_author() ) { ?>

							<?php echo get_avatar( get_the_author_meta( 'ID', get_query_var( 'author' ) ), 80 ); ?>
							<div class="gp-author-meta">
								<h1 class="gp-entry-title" itemprop="headline"><?php echo get_the_author_meta( 'display_name', get_query_var( 'author' ) ); ?></h1>
								<h3 class="gp-subtitle"><?php echo get_the_author_meta( 'description', get_query_var( 'author' ) ); ?></h3>
							</div>
					
						<?php } elseif ( is_archive() ) { ?>
					
							<h1 class="gp-entry-title" itemprop="headline">
								<?php if ( ! function_exists( '_wp_render_title_tag' ) && ! function_exists( 'ghostpool_render_title' ) ) { 
									echo apply_filters( 'ghostpool_archives_title', esc_html__( 'Archives', 'gauge' ) );
								} else {
									echo apply_filters( 'ghostpool_archives_title', get_the_archive_title() );	
								} ?>
							</h1>

						<?php } elseif ( is_front_page() ) { ?>
					
							<h1 class="gp-entry-title" itemprop="headline"><?php echo apply_filters( 'ghostpool_blog_title', esc_html__( 'Blog', 'gauge' ) ); ?></h1>

						<?php } else { ?>
						
							<h1 class="gp-entry-title" itemprop="headline"><?php wp_title( '' ); ?>
							
						<?php } ?>
						
					<?php } ?>	
							
				</div>
											
			</header>
			
			<?php if ( $GLOBALS['ghostpool_page_header'] == 'gp-large-title' ) { get_template_part( 'lib/sections/hub', 'tabs' ); } ?>
		
		<?php } ?>
		
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb( '<div id="breadcrumbs"><div class="gp-container">', '</div></div>' ); } ?>
		
		<?php if ( ghostpool_option( 'header_ad' ) ) { ?>
			<?php if ( ghostpool_option( 'header_ad_exclude' ) == 'enabled' && ( is_404() OR is_attachment() ) ) {} else { ?>
				<div id="gp-header-area">
					<div class="gp-container">
						<?php echo do_shortcode( ghostpool_option( 'header_ad' ) ); ?>
					</div>
				</div>
			<?php } ?>	
		<?php }

		// Reset rich snippets
		$GLOBALS['ghostpool_site_rich_snippets'] = false;
		$GLOBALS['ghostpool_user_rich_snippets'] = false;	
								
	}

}

?>