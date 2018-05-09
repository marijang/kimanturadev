<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<!--ovo je tu prebačeno iz form-billinga -->
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

	<h1 class="section__title"><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h1>

	<?php else : ?>
	        <header id="wc-multistep-details-title" class="section__header">
				<h1 class="section__title"><?php _e( 'Informacije o dostavi', 'woocommerce' ); ?></h1>
				<p class="section__description checkout__desc"><?php _e( 'Popunite polja za dostavu', 'woocommerce' ); ?></p>
			</header>
			
			<header id="wc-multistep-payment-title" style="display:none;" class="section__header">
				<h1 class="section__title"><?php _e( 'Način plaćanja', 'woocommerce' ); ?></h1>
				<p class="section__description checkout__desc"><?php _e( 'Odaberite metodu plaćanja', 'woocommerce' ); ?></p>
			</header>

	<?php endif; ?>

	<!-- Clean multi step B4B -->
	<div class="checkout__grid">
		<?php if ( $checkout->get_checkout_fields() ) : ?>
		<div id="customer-details" class="checkout__form">
		
			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
			<?php do_action( 'woocommerce_checkout_billing' ); ?>
			<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			<div class="checkout__btn">
				<a href="#" id="proceed-to-payment" class="btn btn--primary"><?php _e( 'Nastavi na plaćanje', 'b4b' ); ?></a>
			</div>
		</div>
		<?php endif; ?>
		<div id="payment-details" style="display:none" class="checkout__form">
		    <?php do_action( 'b4b_woocommerce_checkout_payment' ); ?>
		</div>
		<div class="checkout__review">
			<div class="checkout__review-box">
				<h6 id="order_review_heading" class=" checkout__box-title"><?php _e( 'Your order', 'woocommerce' ); ?></h6>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>	
			</div>
		</div>
    </div><!-- End of checkout__Grid -->
</form>

	
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
