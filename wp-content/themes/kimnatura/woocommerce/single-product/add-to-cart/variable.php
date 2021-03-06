<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );
// Get variation name
//var_dump( $available_variations);
foreach ( $available_variations as $key => $value ) :
	$selvar = '';
	foreach($value['attributes'] as $attr){
		$selvar .= ($selvar=='')? $attr:','.$attr;
	}
	$value['selected_variation'] = $selvar.' '.get_the_title();
	$value['selected_product_name'] = get_the_title();
	$available_variations[$key] = $value; 
endforeach; 

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart single-product__variations-form" action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="single-product__stock single-product__out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>

	<div class="single-product__variations variations">
	<?php foreach ( $attributes as $attribute_name => $options ) : ?>
		<div class="single-product__variation-item">
	<label class="single-product__variation-name" for="<?php echo sanitize_title( $attribute_name ); ?>">
		<?php echo wc_attribute_label( $attribute_name ); ?>
	</label>
	<?php
	$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );

	wc_dropdown_variation_attribute_options( array( 'show_option_none' => false,'options' => $options,'class'=>'js-select-toggle browser-default', 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
	echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="single-product__reset-variations reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) : '';
	?>
	</div>

<?php endforeach;?>
</div>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form1' );
