<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}




?>





		<!-- Login Form -->
		<section class="login_form_area">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- registrationForm_fomr_area -->
						<div class="login_from_area">
							<?php 
								do_action( 'woocommerce_before_customer_login_form' ); 
							 ?>

							 <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>


								<?php endif; ?>

								
									<div class="title_login">
										<h1>Salut</h1>
										<p>Content que tu sois de retour.</p>
									</div>

								<form class="woocommerce-form woocommerce-form-login login" method="post">

									<?php do_action( 'woocommerce_login_form_start' ); ?>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										
										<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Email" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
									</p>
									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" placeholder="Mot de clé" id="password" autocomplete="current-password" />
									</p>

									<?php do_action( 'woocommerce_login_form' ); ?>

									<p class="form-row">
										<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
										<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
									</p>
									<!-- <p class="woocommerce-LostPassword lost_password">
										<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
									</p> -->

									<?php do_action( 'woocommerce_login_form_end' ); ?>

								</form>

								<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

							</div>
						<!-- registrationForm_fomr_area -->
					<?php endif; ?>

					<?php do_action( 'woocommerce_after_customer_login_form' ); ?>



					</div>
				</div>
			</div>
		</section>
		<!-- Login Form -->




