<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

use Kimnatura\Admin\Woo as Woo;
$woo = new Woo;

?>
<div class="woocommerce-billing-fields">
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
		    $sort = array(
				array('billing_first_name','billing_last_name'),
				array('billing_email'),
				array('billing_phone'),
				array('billing_address_1','billing_country'),
			
				array('billing_city','billing_postcode')
			);
			$fields = $checkout->get_checkout_fields( 'billing' );


			foreach($sort as $value){
				echo '<div class="billing-fields">';
                foreach($value as $item){
					$field = $fields[$item];
					$classes = implode('',$field['class']);
					//echo '<div class="billing-fields__item">';
					//echo '<div class="input-field">';
					//echo '<input name="'.$item.'" type="text" class="'.$classes.'" value="'.$checkout->get_value( $item ).'">';
					//echo '<label for="'.$item.'">'.$field['label'].'</label>';
					$woo->woocommerce_form_field( $item, $field, $checkout->get_value( $item ) );
					//echo '</div>';
					//echo '</div>';
				}
				echo '</div>';
			}
/*
			foreach($sort as $value){
				$count = count($value);
				echo '<div class="billing-fields">';
                foreach($value as $item){
					$field = $fields[$item];
					$classes = implode('',$field['class']);
					echo '<div class="billing-fields__item">';
					echo '<div class="input-field">';
					echo '<input name="'.$item.'" type="text" class="'.$classes.'" value="'.$checkout->get_value( $item ).'">';
					echo '<label for="'.$item.'">'.$field['label'].'</label>';
					//$woo->woocommerce_form_field( $item, $field, $checkout->get_value( $item ) );
					echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			}
			*/
			
			
	

			foreach ( $fields as $key => $field ) {
				if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
					$field['country'] = $checkout->get_value( $field['country_field'] );
				}
				//woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
			}
		?>
	</div>
	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled()&&1==2) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <span><?php _e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
