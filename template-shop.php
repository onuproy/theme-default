<?php
/* Template Name: Online shop */

// Must check & redirect before any output
if ( ! is_user_logged_in() ) {
    wp_redirect( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );
    exit;
}

get_header();


?>


<section class="product_section_area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Search Form -->
					<div class="search_from_area">
					    <div class="shop_title_content">
					        <h1>Date de commande. <span id="current-date"></span></h1>
        <p>Les commandes doivent être passées au moins 48 heures à l’avance afin de garantir la fraîcheur de la production de pâte et d’assurer une logistique fluide.</p>
					    </div>

					    <!-- WooCommerce Product Search Form -->
					    <form id="searchForm" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					        <div class="row">
					            <div class="product_search">
					                <input type="search" placeholder="Search product" value="<?php echo get_search_query(); ?>" name="s" id="search" />
					                <input type="hidden" name="post_type" value="product" /> <!-- Ensures it only searches for products -->
					            </div>
					        </div>
					    </form>

					    <!-- Search Results will be displayed here -->
					    <div id="search-results"></div>
					</div>

					<!-- End Search Form -->

			</div>
		</div>
		<?php 
			'Special only? ' . get_post_meta( get_the_ID(), '_special_customer_only', true );

		 ?>
		<!-- Tab Title -->
		<div class="row">
			<div class="col-12">
				<div class="tab_product_area">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="baker-tab" data-bs-toggle="pill" data-bs-target="#baker" type="button" role="tab" aria-controls="baker" aria-selected="true">
							<div class="icon_image__box">
								<img src="<?php echo myfile(); ?>assets/images/icon/baker.png" alt="">
							</div>
							<span>Boulangerie</span>
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="pastry-tab" data-bs-toggle="pill" data-bs-target="#pastry" type="button" role="tab" aria-controls="pastry" aria-selected="false">
							<div class="icon_image__box">
								<img src="<?php echo myfile(); ?>assets/images/icon/pastry.png" alt="">
							</div>
							<span>Pâtisserie</span>
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="chocolatier-tab" data-bs-toggle="pill" data-bs-target="#chocolatier" type="button" role="tab" aria-controls="chocolatier" aria-selected="false">
							<div class="icon_image__box">
								<img src="<?php echo myfile(); ?>assets/images/icon/chocolatier.png" alt="">
							</div>
							<span>Chocolatier</span>
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="viennoiserie-tab" data-bs-toggle="pill" data-bs-target="#viennoiserie" type="button" role="tab" aria-controls="viennoiserie" aria-selected="false">
							<div class="icon_image__box">
								<img src="<?php echo myfile(); ?>assets/images/icon/viennoiserie.png" alt="">
							</div>
							<span>Viennoiserie</span>
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="seasonal-tab" data-bs-toggle="pill" data-bs-target="#seasonal" type="button" role="tab" aria-controls="seasonal" aria-selected="false">
							<div class="icon_image__box">
								<img src="<?php echo myfile(); ?>assets/images/icon/seasonal.png" alt="">
							</div>
							<span>SaisonnièRE</span>
							</button>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Tab Title -->
		<!-- Product Row -->
		<div class="row">
			<div class="col-12">
				<div class="product_all_area">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="baker" role="tabpanel" aria-labelledby="baker-tab" tabindex="0">
							<div class="row">
								<div class="shop_product____f_area">
									<?php echo do_shortcode('[products limit="100" columns="3" category="baker"]'); ?>

								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="pastry" role="tabpanel" aria-labelledby="pastry-tab" tabindex="0">
							<div class="row">
								<div class="shop_product____f_area">
									<?php echo do_shortcode('[products limit="100"  columns="3" category="pastry" ]'); ?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="chocolatier" role="tabpanel" aria-labelledby="chocolatier-tab" tabindex="0">
							<div class="row">
								<div class="shop_product____f_area">
									<?php echo do_shortcode('[products limit="100"  columns="3" category="chocolatier" ]'); ?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="viennoiserie" role="tabpanel" aria-labelledby="viennoiserie-tab" tabindex="0">
							<div class="row">
								<div class="shop_product____f_area">
									<?php echo do_shortcode('[products limit="100"  columns="3" category="viennoiserie" ]'); ?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="seasonal" role="tabpanel" aria-labelledby="seasonal-tab" tabindex="0">
							<div class="row">
								<div class="shop_product____f_area">
									<?php echo do_shortcode('[products limit="100"  columns="3" category="seasonal" ]'); ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
		</div>
	</section>
	
	<?php get_footer(); ?>