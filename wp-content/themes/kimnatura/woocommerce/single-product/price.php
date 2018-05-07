<?php
/**
 * Single Product Price
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

global $product;



?>
<div class="single-product__price">
   <?php 

    if (  $product->is_type( 'variable' ) ) {
        if ( $product->is_on_sale() ) {
            echo   '<span class="featured-link__sale-regular-price">'.wc_price($product->get_variation_regular_price( 'min', true )).'</span>';
            echo  wc_price($product->get_variation_price( 'min', true ).$product->get_price_suffix()) ;
        }
        else{
            echo  wc_price($product->get_variation_price( 'min', true ).$product->get_price_suffix()) ;
        }
    }else{
        echo $product->get_price_html();
    }
  // echo $product->get_price_html(); 
   //do_action( 'b4b_woocommerce_price' );

   ?>



</div>
