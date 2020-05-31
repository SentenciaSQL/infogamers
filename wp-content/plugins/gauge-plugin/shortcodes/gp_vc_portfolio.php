<?php

if ( ! function_exists( 'ghostpool_portfolio' ) ) {

	function ghostpool_portfolio( $atts, $content = null ) {
	
		extract( shortcode_atts( array(
			'widget_title' => '',	
			'format' => 'portfolio-columns-2',
			'cats' => '',
			'orderby' => 'newest',
			'date_posted' => 'all',
			'date_modified' => 'all',
			'filter' => 'enabled',
			'per_page' => '12',	
			'offset' => '',		
			'page_numbers' => 'enabled',
			'see_all' => 'disabled',
			'see_all_link' => '',
			'see_all_text' => esc_html__( 'See All Items', 'gauge-plugin' ),
			'classes' => '',
		), $atts ) );
		
		// Detect shortcode
		$GLOBALS['ghostpool_shortcode'] = 'portfolio';
				
		// Load page variables
		ghostpool_shortcode_options( $atts );
		ghostpool_category_variables();

		// Unique Name
		STATIC $gp_i = 0;
		$gp_i++;
		$gp_name = 'gp_portfolio_wrapper_' . $gp_i;
				
		$gp_args = array(
			'post_type'      => 'gp_portfolio_item',
			'tax_query' 	 => array( 'relation' => 'OR', $GLOBALS['ghostpool_portfolio_cats'] ),
			'orderby'        => $GLOBALS['ghostpool_orderby'],
			'order'          => $GLOBALS['ghostpool_order'],
			'posts_per_page' => $GLOBALS['ghostpool_per_page'],
			'offset' 		 => $GLOBALS['ghostpool_offset'],
			'paged'          => $page_numbers == 'enabled' ? $GLOBALS['ghostpool_paged'] : 1,
			'date_query' 	 => array( $GLOBALS['ghostpool_date_posted_value'], $GLOBALS['ghostpool_date_modified_value'] ),
			'ignore_sticky_posts' => 1,
		);		
		
		ob_start(); $gp_query = new wp_query( $gp_args ); ?>
	
		<div id="<?php echo sanitize_html_class( $gp_name ); ?>" class="gp-portfolio-wrapper gp-vc-element gp-<?php echo sanitize_html_class( $GLOBALS['ghostpool_format'] ); ?> <?php echo esc_attr( $classes ); ?>">

			<?php if ( $widget_title OR $see_all == 'enabled' ) { ?>
				<div class="gp-element-title">
					<?php if ( $widget_title ) { ?><h3><?php echo esc_attr( $widget_title ); ?></h3><?php } ?>
					<?php if ( $see_all == 'enabled' ) { ?>
						<div class="gp-see-all-link"><a href="<?php echo esc_url( $see_all_link ); ?>"><?php echo esc_attr( $see_all_text ); ?></a></div>
					<?php } ?>
					<div class="gp-element-title-line"></div>
				</div>
			<?php } ?>
				
			<?php if ( $filter == 'enabled' ) { ?>
				<div id="<?php echo sanitize_html_class( $gp_name ); ?>-filters" class="gp-portfolio-filters gp-vc-element">
					<ul>
					   <li><a href="#" data-filter="*" class="gp-active"><?php esc_html_e( 'All', 'gauge-plugin' ); ?></a></li>
						<?php 
						$gp_terms = get_terms( 'gp_portfolios' );
						$gp_cat_array = explode( ',', $cats );
						if ( ! empty( $gp_terms ) ) {
							foreach( $gp_terms as $gp_term ) {
								foreach( $gp_cat_array as $gp_cat ) {
									if ( ! empty( $gp_cat_array[0] ) ) {
										if ( $gp_term->term_id == $gp_cat ) {
											echo '<li><a href="#" data-filter=".' . sanitize_title( $gp_term->slug ) . '">' . esc_attr( $gp_term->name ) . '</a></li>';
										}
									} else {
										echo '<li><a href="#" data-filter=".' . sanitize_title( $gp_term->slug ) . '">' . esc_attr( $gp_term->name ) . '</a></li>';
									}	
								}		
							}	
						}
						?>
					</ul>
				</div>
			<?php } ?>
		
			<?php if ( $gp_query->have_posts() ) : ?>
		
				<div class="gp-inner-loop">
				
					<div class="gp-gutter-size"></div>
		
					<?php while ( $gp_query->have_posts() ) : $gp_query->the_post(); ?>

						<?php get_template_part( 'portfolio', 'loop' ); ?>

					<?php endwhile; ?>
				
				</div>			
				
				<?php if ( $page_numbers == 'enabled' ) { ?>
					<?php echo ghostpool_pagination( $gp_query->max_num_pages ); ?>
				<?php } ?>

			<?php else : ?>

				<strong class="gp-no-items-found"><?php esc_html_e( 'No items found.', 'gauge-plugin' ); ?></strong>

			<?php endif; wp_reset_postdata(); ?>	

		</div>

		<script>		
		jQuery( document ).ready( function( $ ) {

			'use strict';
			
			if ( $( 'body' ).hasClass( 'gp-theme' ) ) {
			
				var container = $( '#<?php echo sanitize_html_class( $gp_name ); ?> .gp-inner-loop' ),
					element = container;

				if ( container.find( 'img' ).length == 0 ) {
					element = $( '<img />' );
				}

				if ( container.find( 'section' ).length == 1 ) {
					var columnwidth = '#<?php echo sanitize_html_class( $gp_name ); ?> section';
				} else {
					var columnwidth = '#<?php echo sanitize_html_class( $gp_name ); ?>  section:nth-child(3n)';
				}	
					
				imagesLoaded( element, function( instance ) {

					container.isotope({
						itemSelector: '#<?php echo sanitize_html_class( $gp_name ); ?> section',
						percentPosition: true,
						filter: '*',
						masonry: {
							columnWidth: columnwidth,
							gutter: '#<?php echo sanitize_html_class( $gp_name ); ?> .gp-gutter-size'
						}
					});

					container.animate( { 'opacity': 1 }, 1300 );
					$( '.gp-pagination' ).animate( { 'opacity': 1 }, 1300 );
		
				});
		
				// Portfolio filters
				$( '#<?php echo sanitize_html_class( $gp_name ); ?>-filters ul li a' ).click( function() {

					var selector = $( this ).attr( 'data-filter' );
					container.isotope( { filter: selector } );

					$( '#<?php echo sanitize_html_class( $gp_name ); ?>-filters ul li a' ).removeClass( 'gp-active' );
					$( this ).addClass( 'gp-active' );

					return false;

				});

				// Remove portfolio filters not found on current page
				if ( $( 'div' ).hasClass( 'gp-portfolio-filters' ) ) {
	
					var isotopeCatArr = [];
					var $portfolioCatCount = 0;
					$( '#<?php echo sanitize_html_class( $gp_name ); ?>-filters ul li' ).each( function( i ) {
						if ( $( this ).find( 'a' ).length > 0 ) {
							isotopeCatArr[$portfolioCatCount] = $( this ).find( 'a' ).attr( 'data-filter' ).substring( 1 );	
							$portfolioCatCount++;
						}
					});
	
					isotopeCatArr.shift();
	
					var itemCats = '';
	
					$( '#<?php echo sanitize_html_class( $gp_name ); ?> .gp-inner-loop > section' ).each( function( i ) {
						itemCats += $( this ).attr( 'data-portfolio-cat' );
					});
					itemCats = itemCats.split( ' ' );
	
					itemCats.pop();
		
					itemCats = $.unique( itemCats );
	
					var notFoundCats = [];
					$.grep( isotopeCatArr, function( el ) {
						if ( $.inArray(el, itemCats ) == -1 ) {
							notFoundCats.push( el  );
						}
					});
	
					if ( notFoundCats.length != 0 ) {
						$( '#<?php echo sanitize_html_class( $gp_name ); ?>-filters ul li' ).each( function() {
							if ( $( this ).find( 'a' ).length > 0 ) {
								if( $.inArray( $( this ).find( 'a' ).attr( 'data-filter' ).substring( 1 ), notFoundCats ) != -1 ) {
									$( this ).hide();
								}
							}
						});
					}
			
				}
			
			}
						
		});			
		</script>

		<?php

		$output_string = ob_get_contents();
		ob_end_clean(); 		
		$GLOBALS['ghostpool_shortcode'] = null;
		return $output_string;
	
	}
	
}
	
add_shortcode( 'portfolio', 'ghostpool_portfolio' ); ?>