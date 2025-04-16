
<?php get_header();
/* Template Name: Checkout */
?>


<div class="checkout_area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="checkout_content_k">
					<?php echo do_shortcode('[woocommerce_checkout]'); ?>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>