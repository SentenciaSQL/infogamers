<?php

/*--------------------------------------------------------------
Load custom WooCommerce stylesheet
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_wc_enqueue_styles' ) ) {	
	function ghostpool_wc_enqueue_styles() {
		wp_enqueue_style( 'gp-woocommerce', get_template_directory_uri() . '/lib/css/woocommerce.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'ghostpool_wc_enqueue_styles' );

/**
 * Disable activation redirect
 *
 */
if ( ! function_exists( 'ghostpool_wc_disable_redirect' ) ) {
	function ghostpool_wc_disable_redirect() {
		return true;
	}
}
add_filter( 'woocommerce_prevent_automatic_wizard_redirect', 'ghostpool_wc_disable_redirect' );

/*--------------------------------------------------------------
Set WooCommerce defaults
--------------------------------------------------------------*/

if ( is_admin() && get_option( 'ghostpool_wc_defaults' ) !== '1' ) {
	function ghostpool_woocommerce_defaults() {		
		update_option( 'shop_catalog_image_size', array( 'width' => 454, 'height' => 550, 'crop' => 1 ) );
		update_option( 'shop_thumbnail_image_size', array( 'width' => 110, 'height' => 110, 'crop' => 1 ) ); 
		update_option( 'shop_single_image_size', array( 'width' => 500, 'height' => 700, 'crop' => 1 ) );
	}	
	add_action( 'init', 'ghostpool_woocommerce_defaults', 1 );	
	update_option( 'ghostpool_wc_defaults', '1' );										
}
	
	
/*--------------------------------------------------------------
Pagination
--------------------------------------------------------------*/

remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
if ( ! function_exists( 'woocommerce_pagination' ) ) {
	function woocommerce_pagination() {
		global $wp_query;
		echo ghostpool_pagination( $wp_query->max_num_pages );
	}
}	
add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );


/*--------------------------------------------------------------
Columns per shop page
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_loop_columns' ) ) {
	function ghostpool_loop_columns() {
		if ( $GLOBALS['ghostpool_layout'] == 'gp-fullwidth' OR $GLOBALS['ghostpool_layout'] == 'gp-no-sidebar' ) {
			return 4;
		} else {
			return 3;
		}
	}
}
add_filter( 'loop_shop_columns', 'ghostpool_loop_columns' );


/*--------------------------------------------------------------
Products per page
--------------------------------------------------------------*/

function ghostpool_loop_shop_per_page( $cols ) {
    $cols = 12;
    return $cols;
}
add_filter( 'loop_shop_per_page', 'ghostpool_loop_shop_per_page', 20 );


/*--------------------------------------------------------------
Product thumbnail columns
--------------------------------------------------------------*/
	
if ( ! function_exists( 'ghostpool_product_thumbnails_columns' ) ) {	
	function ghostpool_product_thumbnails_columns() {
		return 4;
	}
}
add_filter( 'woocommerce_product_thumbnails_columns', 'ghostpool_product_thumbnails_columns' );

			
/*--------------------------------------------------------------
Related products per page
--------------------------------------------------------------*/

if ( ! function_exists( 'woocommerce_output_related_products' ) ) {
	function woocommerce_output_related_products() {
		$gp_args = array(
			'posts_per_page' => 4,
			'columns'        => 4
		);
		woocommerce_related_products( $gp_args ); // Display 4 products in rows of 4
	}
}

/*--------------------------------------------------------------
Product Category Images
--------------------------------------------------------------*/

/*remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
 
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() {
		echo woocommerce_get_product_thumbnail();
	} 
}
 
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
	
	function woocommerce_get_product_thumbnail( $gp_size = 'shop_catalog', $gp_placeholder_width = 0, $gp_placeholder_height = 0 ) {
	
		global $post, $product;
 
		if ( ! $gp_placeholder_width ) {
			$gp_placeholder_width = get_option( 'woocommerce_single_image_width' );
			//$gp_placeholder_width = $gp_placeholder_width['width'];
		}
		if ( ! $gp_placeholder_height ) {
			$gp_placeholder_height = get_option( 'woocommerce_thumbnail_cropping' ) == '1:1' ? get_option( 'woocommerce_single_image_width' ) : '';
			//$gp_placeholder_height = $gp_placeholder_height['height'];
		}
		//$gp_placeholder_crop = get_option( 'shop_catalog_image_size' );
		$gp_placeholder_crop = get_option( 'woocommerce_thumbnail_cropping' ) == 'uncropped' ? false : true;
		
		$gp_output = '';
		
		$gp_output .= '<span class="gp-product-image-container">';
			
			if ( has_post_thumbnail() ) {

				$gp_attachment_ids = $product->get_gallery_image_ids();				
				
				if ( $gp_attachment_ids ) {
					
					foreach ( $gp_attachment_ids as $gp_attachment_id ) {
						if ( $gp_attachment_id != get_post_thumbnail_id() ) {
							$gp_image = aq_resize( wp_get_attachment_url( $gp_attachment_id ), $gp_placeholder_width, $gp_placeholder_height, $gp_placeholder_crop, false, true );					
							if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
								$gp_retina = aq_resize( wp_get_attachment_url( $gp_attachment_id ), $gp_placeholder_width * 2, $gp_placeholder_height * 2, $gp_placeholder_crop, true, true );
							} else {
								$gp_retina = '';
							}	
						}
					}
			
					$gp_output .= '<img src="' . $gp_image[0] . '" data-rel="' . $gp_retina . '" width="' . $gp_image[1] . '" height="' . $gp_image[2] . '" alt="' . get_the_title( $gp_attachment_id ) . '" class="gp-post-image gp-image-overlay" />';

				}

				$gp_image = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ), $gp_placeholder_width, $gp_placeholder_height, $gp_placeholder_crop, false, true );		
				if ( ghostpool_option( 'retina', '', 'gp-retina' ) == 'gp-retina' ) {
					$gp_retina = aq_resize( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ), $gp_placeholder_width * 2, $gp_placeholder_height * 2, $gp_placeholder_crop, true, true );
				} else {
					$gp_retina = '';
				}
		
				$gp_output .= '<img src="' . $gp_image[0] . '" data-rel="' . $gp_retina . '" width="' . $gp_image[1] . '" height="' . $gp_image[2] . '" alt="' . get_the_title( get_post_thumbnail_id() ) . '" class="attachment-shop_catalog gp-post-image" />';			
			
			} else {
		
				$gp_output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="' . esc_html__( 'Placeholder' , 'gauge' ) . '" width="' . $gp_placeholder_width . '" height="' . $gp_placeholder_height . '" />';

			}
		
		$gp_output .= '</span>';
		
		return $gp_output;
		
	}
	
}*/
function woocommerce_get_product_thumbnail( $size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0 ) {
	
	global $product;
	
	$output = '';
	
	$image_size = wc_get_image_size( $size );

	// Hover product image
	$attachment_ids = $product->get_gallery_image_ids();

	// If product gallery is found		
	if ( $attachment_ids ) {	
	
		// Reverse array to load second gallery image
		$attachment_ids = array_reverse( $attachment_ids );	
	
		$output .= '<div class="gp-product-image-container">';

			foreach ( $attachment_ids as $attachment_id ) {
		
				$output .= $attachment_id != get_post_thumbnail_id() ? wp_get_attachment_image( $attachment_id, array( $image_size['width'], $image_size['height'], $image_size['crop'] ), false, array( 'class' => 'gp-post-image gp-image-overlay' ) ) : '';
				break;
		
			}
	
	}
	
	$output .= $product ? $product->get_image( array( $image_size['width'], $image_size['height'], $image_size['crop'] ), false, array( 'class' => 'attachment-shop_catalog gp-post-image' ) ) : '';
	
	if ( $attachment_ids ) {
		$output .= '</div>';	
	}
		
	return $output;
	
}
 
 
/*--------------------------------------------------------------
Dropdown Cart
--------------------------------------------------------------*/

// Normal Drop Down Cart
if ( ! function_exists( 'ghostpool_dropdown_cart' ) ) {														
	function ghostpool_dropdown_cart() {
		if ( ! is_cart() ) { ?>	
			<div id="gp-dropdowncart" class="gp-nav">
				<ul class="menu">
					<li class="standard-menu gp-dropdowncart-menu">
						<a href="<?php echo wc_get_cart_url(); ?>" id="gp-cart-button" title="<?php esc_html_e( 'View your shopping cart', 'gauge' ); ?>">
							<span id="gp-cart-counter"><?php echo sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'gauge' ), WC()->cart->get_cart_contents_count() ); ?></span>
						</a>
						<ul class="sub-menu">
							<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>		
						</ul>
					</li>
				</ul>		
			</div>
	<?php }
	}
}

// Ajaxify Cart Button
if ( ! function_exists( 'ghostpool_woocommerce_add_to_cart_fragment' ) ) {
	function ghostpool_woocommerce_add_to_cart_fragment( $gp_fragments ) {
		ob_start(); ?>
			<span id="gp-cart-counter"><?php echo sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'gauge' ), WC()->cart->get_cart_contents_count() ); ?></span>
		<?php $gp_fragments['#gp-cart-button #gp-cart-counter'] = ob_get_clean();
		return $gp_fragments;

	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ghostpool_woocommerce_add_to_cart_fragment' );

/**
 * Load content hooks
 *
 * @since Gauge 6.9
 */
require_once( get_template_directory() . '/lib/inc/wc-content-hooks.php' );

?>