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

<form name="checkout" method="post" class="cart-checkout-navigation__form checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<!--ovo je tu prebačeno iz form-billinga -->
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

	<h1 class="section__title"><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h1>

	<?php else : ?>
	        <header id="wc-multistep-details-title" class="section__header cart-checkout-navigation__header">
				<h1 class="section__title"><?php _e( 'Informacije o dostavi', 'woocommerce' ); ?></h1>
				<p class="section__description checkout__desc"><?php _e( 'Popunite polja za dostavu', 'woocommerce' ); ?></p>
			</header>
			
			<header id="wc-multistep-payment-title" style="display:none;" class="section__header cart-checkout-navigation__header">
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
			
			<div class="checkout__btn">
				<a id="proceed-to-payment" href="#proceed-to-payment" class="btn btn--primary-color"><?php _e( 'Nastavi na plaćanje', 'b4b' ); ?></a>
			</div>
		</div>
		<?php endif; ?>
		<div id="payment-details" style="display:none" class="checkout__form">
			<?php do_action( 'b4b_woocommerce_checkout_payment' ); ?>
			<div class="woocommerce-additional-fields">
				<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

				<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

				<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

				<h3><?php _e( 'Additional information', 'woocommerce' ); ?></h3>

				<?php endif; ?>

				<div class="woocommerce-additional-fields__field-wrapper">
					<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
						<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
					<?php endforeach; ?>
			</div>
			</div>

			<?php wc_get_template( 'checkout/terms.php' ); ?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<?php echo apply_filters( 'woocommerce_order_button_html', '<a style="float: right; margint-top:16px;" class="button alt btn btn--primary-color place__order" name="woocommerce_checkout_place_order " id="place_order" value="' . 'Platite' . '" data-value="' . 'Platite' . '">' . 'Platite' . '</a>' ); // @codingStandardsIgnoreLine ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
	
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
<script>
	 $('#proceed-to-payment').on('click',function(e){
		 e.preventDefault();
         if (!$("form[name='checkout']").valid()) {
     }else {
         $('#payment-details,#wc-multistep-payment-title').show();
         $('#customer-details,#wc-multistep-details-title').hide();
		 $('#wc-multistep-payment').addClass('is-active');
		 $('#wc-multistep-payment').removeClass('is-disabled');
         $('#wc-multistep-details').removeClass('is-active');
         $('#wc-multistep-details').addClass('is-activated');
	 }
 });




</script>
	
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>