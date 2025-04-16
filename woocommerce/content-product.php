<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>


		<div class="single_product_item">
			<div class="product_image">
				<div class="p_image">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url();?>" alt=""></a>
				</div>
			</div>
			<div class="product_content">
				<a href="<?php the_permalink(); ?>"><?php woocommerce_template_loop_product_title();?></a>
				<strong><?php woocommerce_template_loop_price();?></strong>
			</div>
			<div class="addd_to_cart">
				<?php woocommerce_template_single_add_to_cart(); ?>
			</div>
			<div class="product_description">
				<?php the_excerpt(); ?>
			</div>
			<div class="product_info_list_area">
			    <div class="product_info_list">
			        <h4>Allergènes *</h4>
			        <?php 
			        // Check if the 'allergens' field has a value and display it
			        if( get_field( 'allergens' ) ) {
			            echo '<h1>' . get_field( 'allergens' ) . '</h1>';
			        } else {
			            echo '<h1>No allergens information available.</h1>';
			        }
			        ?>
			    </div>
			    <div class="product_info_list">
			        <h4>Conservations</h4>
			        <?php 
			        // Check if the 'conservations' field has a value and display it
			        if( get_field( 'conservations' ) ) {
			            echo '<h3>' . get_field( 'conservations' ) . '</h3>';
			        } else {
			            echo '<h3>No conservation information available.</h3>';
			        }
			        ?>
			    </div>
			</div>

		</div>



	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	//do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
