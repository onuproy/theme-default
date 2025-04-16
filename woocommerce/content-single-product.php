<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */

?>

	<div class="product_shop_page">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="product_single_Image">
						<div class="product_image">
							<div class="p_image">
							 	<?php woocommerce_show_product_images(); ?>
							 	<?php woocommerce_show_product_sale_flash(); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single_product_content">
						<?php woocommerce_template_single_title(); ?>
						<strong><?php woocommerce_template_single_price(); ?></strong>
						<div class="woocommerce-product-details__short-description">
							<?php the_excerpt(); ?>
						</div>
						
						<div class="books_now_btn">
							<?php woocommerce_template_single_add_to_cart(); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	



</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
