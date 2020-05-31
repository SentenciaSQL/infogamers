<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product; ?>

<?php if ( version_compare( WOOCOMMERCE_VERSION, '2.1', '<' ) ) { ?>

	<?php if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
			return;

	$count   = $product->get_rating_count();
	$average = $product->get_average_rating();

	if ( $count > 0 ) : ?>

			<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
					<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'gauge' ), $average ); ?>">
							<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
								<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php esc_html_e( 'out of 5', 'gauge' ); ?>
							</span>
					</div>
					(<?php printf( _n( '%s customer review', '%s customer reviews', $count, 'gauge' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?>)
			</div>

	<?php endif; ?>

<?php } ?>

<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo $product->get_price_html(); ?></p>

	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>

<?php if ($product->is_on_sale()) : ?>

	<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale Price', 'gauge' ) . '<span class="sale-triangle"></span></span>', $post, $product); ?>

<?php endif; ?>