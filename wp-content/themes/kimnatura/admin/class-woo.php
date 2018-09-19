<?php
/**
 * The Media specific functionality.
 *
 * @since   2.0.0
 * @package Kimnatura\Admin
 */

namespace Kimnatura\Admin;

use Kimnatura\Helpers as General_Helpers;

/**
 * Class Woo
 */
class Woo {

  /**
   * Global theme name
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_version;

  /**
   * General_Helper class
   *
   * @var object General_Helper
   *
   * @since 2.1.1
   */
  public $general_helper;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 2.1.1 Adding General Helpers class.
   * @since 2.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name    = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];

    $this->general_helper = new General_Helpers\General_Helper();
  }

  /**
   * Enable theme support
   * for full list check: https://developer.wordpress.org/reference/functions/add_theme_support/
   *
   * @since 2.0.0
   */
  public function add_theme_support() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
  }

  /**
   * Register the Stylesheets for the admin area.
   *
   * @since 2.0.0
   */
  public function enqueue_styles() {

 

  }
  /**
   * Register the JavaScript for the admin area.
   *
   * @since 2.0.0
   */
  public function enqueue_scripts() {

   

  }

   /**
   * Register the JavaScript for the admin area.
   *
   * @since 2.0.0
   */
  public function enqueue_scripts_filter() {

    $main_script = '/skin/public/scripts/widgets/wc-multistep.js';
    wp_register_script( $this->theme_name . '-multistep-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ), true );
    wp_enqueue_script( $this->theme_name . '-multistep-scripts');

  }
/**
   * Register the JavaScript for the Single Product page .
   *
   * @since 2.0.0
   */
  public function enqueue_scripts_singlepage() {

    $main_script = '/skin/public/scripts/vendors/woocommerce/singlepage.js';
    wp_register_script( $this->theme_name . '-multistep-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ), true );
    wp_enqueue_script( $this->theme_name . '-multistep-scripts' );

  }


    /**
     * Insert the opening anchor tag for products in the loop.
     */
    function woocommerce_template_loop_product_link_open() {
        global $product;

        $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

        echo '<a href="' . esc_url( $link ) . '" class="shop-catalog__link-wrap">';
    }


  public function custom_order_button_text() {
      return __( 'Platite', 'woocommerce' ); 
  }

 /**
   * Billing Fields
   *
   * @since 2.0.0
   */

  public function custom_order_fields($fields) {
        unset($fields['order']['order_comments']);
        unset($fields['billing']['billing_company']); // remove the option to enter in a company
        unset($fields['billing']['billing_state']); // remove the billing state
        //unset($fields['billing']['billing_country']); // remove the billing country
        unset($fields['billing']['billing_address_2']); // remove the second line of the address
        //var_dump($fields);
        $fields["billing"]['billing_first_name']['priority']= 10;
        $fields["billing"]['billing_last_name']['priority'] = 20;
        $fields["billing"]['billing_email']['priority']		= 30;
        $fields["billing"]['billing_address_1']['priority'] = 40;
        $fields["billing"]['billing_phone']['priority']		= 50;
        $fields["billing"]['billing_postcode']['priority']	= 60;
        $fields["billing"]['billing_city']['priority']		= 70;
        $fields["billing"]['billing_country']['priority']	= 190;
       // $fields["billing"]['billing_city']['class']         = array('form-row-first'); 
       // $fields["billing"]['billing_postcode']['class']     = array('form-row-last');
        //$fields["billing"]['billing_country']['class']    	= array('form-row-wide');
        //var_dump($fields);
        return $fields;
  }

   /**
   * Cart Empty message
   *
   * @since 2.0.0
   */
  function woocommerce_cart_is_empty_message() {
    echo '<h3 class="cart-empty">';
    _e( 'Your cart is currently empty.', 'woocommerce' );
    echo '</h3>';
  }
  
  /**
   * Create new image sizes
   *
   * @since 2.0.0
   */
  public function add_custom_image_sizes() {
        add_image_size( 'blogarchive', 576 , 500, true ); 
  }


  public function woocommerce_related_products() {

    global $post,$product;
    if (is_product()){
        // Join all 
        $upsell  = $product->get_upsell_ids();
        $cross   = $product->get_cross_sell_ids();
        $related = wc_get_related_products($product->get_id());
        $category = array();
        $title =  __('Upsale proizvodi','b4b');
        $productIDs = array_unique (array_merge ($upsell , $cross,$related));
        if(count($productIDs)<3){
            //$related = wc_get_related_products($product->get_id());
            // wc_get_product_ids_on_sale
            // wc_get_related_products
            //var_dump($related);wc_get_product_category_list
            $category = wc_get_product_cat_ids($product->get_id());
            $args1 = array(
                'post_type' => 'product',
                'posts_per_page'=>5,
                'meta_key' => 'total_sales',
                'orderby' => 'meta_value_num',
                'post_status' => 'publish',
                /*
                'tax_query'             => array(           
                    array(
                        'taxonomy'      => 'product_cat',
                        'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms'         => $category ,
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    )
                )*/
            );
            $categorylist = get_posts( $args1 );
            $category = array();
            foreach($categorylist as $cat){
                $category[] = $cat->ID;
            }
        }
        $productIDs = array_unique (array_merge ($upsell , $cross,$related,$category));
    }else{
       // echo $post->ID();
       $productIDs ='';
       if (isset($post)){
        $productIDs = get_post_meta($post->ID,'custom_productIds',true);
       }
       
        $title =  __('Vezani proizvodi','kimnatura');
    }
    
    if ($productIDs == ''){
        $productIDs = array(0);
        $args = array(
            'post_type' => 'product',
            'posts_per_page'=>5,
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'post_status' => 'publish'
        );
        $title =  __('Naši najprodavaniji proizvodi','b4b');
    }else{
        if(empty($args)){
            $args = array(
                'post_type' => 'product',
                'post__in' => $productIDs,
                'post_status' => 'publish'
            );
        }
        
        
    }
    
    // Always same title
    $title =  __('Naši najprodavaniji proizvodi','b4b');
    
    $loop = new \WP_Query( $args );
    require( locate_template( 'template-parts/woocommerce/related-products.php' ) );
    wp_reset_query(); 
    wp_reset_postdata();

}

  public function multi_step() {

    $cart_total = WC()->cart->get_displayed_subtotal();
    $step=0;
    $t = '';
    
    $statusCss = array(
        'step-1'=> '',
        'step-2'=> '',
        'step-3'=> '',
        'step-4'=> ''
    );

  

    $this->enqueue_scripts_filter();
   
    //$t.='C Step='.$step;
    //if (is_cart()) {
    if(is_cart()){
        $step =  0;
        $statusCss['step-1'] = 'is-active is-activated'; 
        $statusCss['step-2'] = 'is-disabled'; 
        $statusCss['step-3'] = 'is-disabled'; 
        $statusCss['step-4'] = 'is-disabled'; 
    }
    if (is_checkout() || Is_view_order_page()) {
        $step =  1;
        $statusCss['step-1'] = 'is-activated'; 
        $statusCss['step-2'] = 'is-active'; 
        $statusCss['step-3'] = 'is-disabled'; 
        $statusCss['step-4'] = 'is-disabled'; 
    }
    // ovo se nece nikada dogoditi
    if (is_add_payment_method_page()) {
        $step =  3;
        $statusCss['step-1'] = 'is-activated'; 
        $statusCss['step-2'] = 'is-activated'; 
        $statusCss['step-3'] = 'is-activated is-active'; 
        $statusCss['step-4'] = 'is-disabled';
    }
    if (Is_checkout_pay_page()||is_order_received_page()) {
        $step = 4;
        $statusCss['step-1'] = 'is-disabled'; 
        $statusCss['step-2'] = 'is-disabled'; 
        $statusCss['step-3'] = 'is-disabled'; 
        $statusCss['step-4'] = 'is-active';
    }
 
  
  
    if (is_account_page()) {
      $t .="acount_page";
    }
    if (is_cart()) {
      //$t .="Cart";
    }

  
    /*
    if (Is_view_order_page()) {
      $step =  2;
    }
    if (Is_order_received_page()) {
      $step =  3;
    }
    if (Is_view_order_page()) {
      $step =  4;
    }
     */
 
    $t  .= '<ul class="cart-checkout-navigation browser-default">';
    // First item
    //$t  .= '<li id="wc-multistep-cart" data-step="cart" class="cart-checkout-navigation__item '. ( ($step == 0 && !is_wc_endpoint_url( 'order-received' )) ? 'is-active' : '').' '. ( ($step > 0 && !is_wc_endpoint_url( 'order-received' ) ) ? 'is-activated' : '').'" >';
    $t  .= '<li id="wc-multistep-cart" data-step="cart" class="cart-checkout-navigation__item '.$statusCss['step-1'].'" >';
    if (!Is_checkout_pay_page()||!is_order_received_page()) { 
    $t .= '<a href="'.get_permalink( wc_get_page_id( 'cart' )).'">
             <span class="cart-checkout-navigation__step-number">1</span>
             <span class="cart-checkout-navigation__step-title">'.__('Košarica ','b4b').'<span>
         </a>';
    }
    /*
    if (!is_wc_endpoint_url( 'order-received' )) {
    if ($step>0){
      $t .= '<a href="'.get_permalink( wc_get_page_id( 'cart' )).'">
              <span class="cart-checkout-navigation__step-number">1</span>
              <span class="cart-checkout-navigation__step-title">'.__('Košarica ','b4b').'<span>
            </a>';
    }else{
      $t .= '<a href="'.get_permalink( wc_get_page_id( 'cart' )).'">
        <span class="cart-checkout-navigation__step-number">1</span>
        <span class="cart-checkout-navigation__step-title">'.__('Košarica','b4b').'<span>
      </a>';
    }
} else {
    $t .= '
    <span class="cart-checkout-navigation__step-number">1</span>
    <span class="cart-checkout-navigation__step-title">'.__('Košarica','b4b').'<span>
  ';
}
*/
    $t  .= '</li>';

    // Second item
    // $t  .= '<li id="wc-multistep-details" data-step="customer-details" class="cart-checkout-navigation__item '. ( ($step == 1 && !is_wc_endpoint_url( 'order-received' ) ) ? 'is-active' : '').' '. ( ($step == 0 || is_wc_endpoint_url( 'order-received' ) ) ? 'is-disabled' : '').'" >';
    $t  .= '<li id="wc-multistep-details" data-step="customer-details" class="cart-checkout-navigation__item '.$statusCss['step-2'].'" >';
    if (!Is_checkout_pay_page()||!is_order_received_page()) {  
        $t  .= '<a href="'.get_permalink( wc_get_page_id( 'checkout' )).'">'; 
    }
    $t  .= '<span class="cart-checkout-navigation__step-number">2</span><span class="cart-checkout-navigation__step-title">'.__('Dostava','b4b').'<span>';
    $t  .= ' </a></li>';
    // Third item
    //$t  .= '<li id="wc-multistep-payment" data-step="payment" class="cart-checkout-navigation__item '. ( ($step == 2) ? 'is-active' : '').'" >';
    $t  .= '<li id="wc-multistep-payment" data-step="payment" class="cart-checkout-navigation__item '.$statusCss['step-3'].'" >';
    $t  .= '<span class="cart-checkout-navigation__step-number">3</span>';
    $t  .= '<span class="cart-checkout-navigation__step-title">'.__('Način plaćanja','b4b').'<span>';
    $t  .= '</li>';
    // Fourth Item
    $t  .= '<li id="wc-multistep-finish" data-step="finish" class="cart-checkout-navigation__item is-last '.$statusCss['step-4'].'" >';
    $t  .= '<span class="cart-checkout-navigation__step-number">4</span>';
    $t  .= '<span class="cart-checkout-navigation__step-title">'.__('Potvrda','b4b').'<span>';
    $t  .= '</li>';
  
  
    $t  .=  "</ul>";
    return $t;
  }


  public function category_description_title() {
        global $post;
        if ( is_product_category() ) {
            global $wp_query;
            $cat_id = $wp_query->get_queried_object_id();
            $cat_desc = term_description( $cat_id, 'product_cat' );
            $subtit = '<p class="section__description">'.$cat_desc.'</p>';
            echo $subtit;
        }else{
            echo '<p class="section__description">'.__('Odaberite kategoriju proizvoda'). '</p>';
            the_subtitle( '<p class="section__description">', '</p>' );
        }
        if( function_exists( 'the_subtitle' ) && function_exists( 'is_shop' ) && is_shop() ) {
            the_subtitle( '<h2 class="section__description">', '</h2>' );
        }
    }

      /**
     * Hide shipping rates when free shipping is available.
     * Updated to support WooCommerce 2.6 Shipping Zones.
     *
     * @param array $rates Array of rates found for the package.
     * @return array
     */
   public  function my_hide_shipping_when_free_is_available( $rates ) {
        $free = array();
 
        foreach ( $rates as $rate_id => $rate ) {
            if ( 'free_shipping' === $rate->method_id ) {
                $free[ $rate_id ] = $rate;
                break;
            }
        }
        
        return ! empty( $free ) ? $free : $rates;
    } 



/**
 * Show a message at the cart/checkout displaying
 * how much to go for free shipping.
 */
public function shipping_method_notice() {
	//if ( ! is_cart() && ! is_checkout() ) { // Remove partial if you don't want to show it on cart/checkout
	$packages = WC()->cart->get_shipping_packages();
	$package = reset( $packages );
	$zone = wc_get_shipping_zone( $package );
    $cart_total = WC()->cart->get_displayed_subtotal();
    $message = '';
	if ( WC()->cart->display_prices_including_tax() ) {
		$cart_total = round( $cart_total - ( WC()->cart->get_discount_total() + WC()->cart->get_discount_tax() ), wc_get_price_decimals() );
	} else {
		$cart_total = round( $cart_total - WC()->cart->get_discount_total(), wc_get_price_decimals() );
	}
    // Calculate price if zone is selected
	foreach ( $zone->get_shipping_methods( true ) as $k => $method ) {
		$min_amount = $method->get_option( 'min_amount' );
		if ( $method->id == 'free_shipping' && ! empty( $min_amount ) && $cart_total < $min_amount ) {
			$remaining = $min_amount - $cart_total;
			$message =  sprintf( 'Dodajte proizvoda za još %s kako biste ostvarili besplatnu dostavu!', wc_price( $remaining ) );
		}
	}
    // Show info if price is not calculated just for info
    if($cart_total >0){
	if (!isset($remaining)){
		$delivery_zones = \WC_Shipping_Zones::get_zones();
		foreach ((array) $delivery_zones as $key => $the_zone ) {
		    //echo $the_zone['zone_name'];
			foreach ($the_zone['shipping_methods'] as $method) {
				if ($method->is_enabled()){
					$min_amount = $method->get_option( 'min_amount' );
					// Free shipping method rules
					if ( $method->id == 'free_shipping'){
						// Cart total less then min_amount
						if (! empty( $min_amount ) && $cart_total < $min_amount ) {
							$remaining = $min_amount - $cart_total;
							$message=  sprintf( 'Ako dodate još %s ostvariti ćete besplatnu dostavu!', wc_price( $remaining ) );
						}
					}
				}
				//echo $value->id;
				//echo $value->get_title();
				// var_dump($value);
			}
        }
    }
    }
    if ( (is_cart() || wp_doing_ajax()) && $cart_total >0 ){
        if ($message!=''){
            echo '<div class="cart__banner">'.$message.'</div>';
        }
	}
    

}

/**
 * WooCommerce, Cart Item text
 * 
 * Show Product title
 * 
 */



function b4b_woocommerce_cart_item_name($product_name, $cart_item="", $cart_item_key=""){
	$product_id = $cart_item['product_id'];
	// WC_Product
	$product =  wc_get_product($cart_item['data']->get_id());
	$sales_price = get_post_meta($product_id , '_sale_price', true);
	$regular_price = get_post_meta($product_id , '_regular_price', true);
	$excerpt = $product->get_short_description();
	//$terms = get_the_terms( $product_id, 'product_tag' );
	$termsa = array();
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		foreach ( $terms as $term ) {
			$tersma[] = $term->slug;
		}
    }
    //$res = get_post_meta($product->id);
    //print_r(unserialize($res['_product_attributes'][0]));
    

    $attribute =  $product->get_attribute('pa_pakiranje');
    $class = 'cart__item-desc--three-rows';
    if (isset($attribute)){
        $class = 'cart__item-desc--tworows';
    }
	return 
         '<div class="cart__item-name">'
        . '<a href="'.get_permalink( $cart_item['data']->get_id() ).'" class="cart__item-link">'
        . $product->get_title()
        . '</a>'
		. '</div>'
		. '<p class="cart__item-desc '.$class.'">'
		. $excerpt
		. '</p>'
		. '<div class="cart__item-attribute">'
		. $attribute
		. '</div>';
}

    /**
     * Enable theme support
     * for full list check: https://developer.wordpress.org/reference/functions/add_theme_support/
     *
     * @since 2.0.0
     */
    function woocommerce_category_image() {
        $thumbnail_id='';
        if ( is_product_category()  ){
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            // Get thumbnail
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
        }
        if(!empty($thumbnail_id)){
            echo '<div class="section__image "><div class="section--image-effect">'.wp_get_attachment_image( $thumbnail_id , 'full-width' ) . '</div></div>';
        }else{
            echo '<div class="section__image "><div class="section--image-effect">'.get_the_post_thumbnail(get_option( 'woocommerce_shop_page_id'),'full-width' ). '</div></div>';
        }
    }

     /**
     * Shop Catalog Item Image
     * for full list check: https://developer.wordpress.org/reference/functions/add_theme_support/
     *
     * @since 1.0.0
     */
    function catalog_item_image( $size = 'shop-catalog' ) {
        global $post, $woocommerce;
        echo '<div class="shop-catalog__image">';

        if ( has_post_thumbnail() ) {       
            //$output .="test";  
            //echo "ok";      
            the_post_thumbnail( 'shop-catalog' );
        } else {
           //  $output .= wc_placeholder_img( $size );
             // Or alternatively setting yours width and height shop_catalog dimensions.
             // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
        }              
             
        echo '</div>';
       // echo $output;
    }

     /**
     * Shop Catalog Item Title
     * for full list check: https://developer.wordpress.org/reference/functions/add_theme_support/
     *
     * @since 1.0.0
     */
    public function catalog_item_title(){
        echo the_title('<h4 class="shop-catalog__title">','</h4>');
    }


     /**
     * Shop Catalog - Item Description
     * for full list check: https://developer.wordpress.org/reference/functions/add_theme_support/
     *
     * @since 1.0.0
     */
    public function catalog_item_description(){
        global $product;
        if (  $product->is_type( 'variable' ) ) {
            if ( $product->is_on_sale() ) {
                $price =  '<span class="featured-link__sale-regular-price">'.wc_price($product->get_variation_regular_price( 'min', true )).'</span>';
                $price.=  wc_price($product->get_variation_price( 'min', true ).$product->get_price_suffix()) ;
            }
            else{
                $price=  wc_price($product->get_variation_price( 'min', true ).$product->get_price_suffix()) ;
            }
        }else{
            $price= $product->get_price_html();
        }
        $product_cats = wp_get_post_terms( $product->get_id(), 'product_cat' );
        $categories = "";
        for ( $i = 0; $i < sizeof($product_cats); $i++ ) {
            $categories = $categories . $product_cats[$i]->name;
            if ($i < sizeof($product_cats) - 1) {
                $categories = $categories . ", ";
            }
        }
        ?>
          <p class="featured-link__categories"><?php echo $categories ?>  </p><div class="shop-catalog__price"><?php echo $price ?></div>
        <?php 
        
        $string =''; 
        if ($product->is_type( 'variable' )) 
        {
            $attributes =  $product->get_variation_attributes() ;
            $string ='<div class="shop-catalog__variations">';
            foreach($attributes as $attribute){
                foreach ($attribute as $variation){
                    $string .='<span>'.$variation.'</span>';
                }
            }
            $string .='</div>';	
        }
        echo $string;
    }
 
     /**
     * Shop Catalog - Add to cart link
     * for full list check: https://developer.wordpress.org/reference/functions/add_theme_support/
     *
     * @since 1.0.0
     */
    // Change shopping cart products link

 public function catalog_item_add_to_cart( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		//$html = '<a href="' . esc_url( $product->add_to_cart_url() ) . '" class="btn btn--primary" >';
		$html = '<a href="' . esc_url( get_permalink($product->get_ID())) . '" class="shop-catalog__link-product btn btn--ghost btn--small btn--fluid1" >';
		
		//$html .= woocommerce_quantity_input( array(), $product, false );
		//$html .= '' . esc_html( $product->add_to_cart_text() ) . '';
		$html .= '' . __( 'Idi na proizvod','kimnatura' ) . '';
		//$html .= '' . __( 'View product' ) . '';

		$html .= '</a>';
	}else{
		$html = '<a href="' . esc_url( get_permalink($product->get_ID())) . '" class="shop-catalog__link-product btn btn--ghost btn--small  btn--fluid1" >';
		//$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '' . __( 'Idi na proizvod','kimnatura' ) . '';
		//$html .= '' . esc_html( $product->add_to_cart_text() ) . '';

		$html .= '</a>';
	}
	return $html;
}
     /**
     * Single Variation Wrapper
     * for full list check: https://docs.woocommerce.com/wc-apidocs/source-function-woocommerce_single_variation.html#2342-2347
     *
     * @since 1.0.0
     */
    public function woocommerce_single_variation() {
        echo '<div class="woocommerce-variation single_variation single-product__single-variation"></div>';
    }

    function move_variations_single_price(){
        global $product, $post;
    
        if ( $product->is_type( 'variable' ) ) {
            // removing the variations price for variable products
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

            $this-> enqueue_scripts_singlepage();
    
            // Change location and inserting back the variations price
           // add_action( 'woocommerce_single_product_summary', array($this,'replace_variation_single_price'), 10 );
           add_action( 'woocommerce_single_product_summary', array($this,'get_all_prices'), 10 );
        }
    }


    function get_all_prices(){
        global $product;
        $available_variations = $product->get_available_variations();   
        $attributes =  $product->get_variation_attributes();
        foreach($available_variations as $variation){
            $variation_id = $variation['variation_id'];
            $variable_product = wc_get_product( $variation_id );
            $this->get_variation_single_price($variable_product,$variation_id  );

        }
 
    }

    function get_variation_single_price($variable_product,$variation_id){
        // Main Price
        if ( $variable_product->is_on_sale() ) {
            $price = wc_format_sale_price( 
                          wc_get_price_to_display( $variable_product, 
                                                   array( 'price' => $variable_product->get_regular_price() ) ),
                                                   wc_get_price_to_display( $variable_product ) 
                     ) . $variable_product->get_price_suffix();
            $price = 
                     
                     '<span class="single-product__regular-price">'
                     .wc_price($variable_product->get_regular_price()).$variable_product->get_price_suffix()
                     .'</span>'
                     .'<span class="single-product__sale-price">'
                     .wc_price(wc_get_price_to_display( $variable_product ))
                     .$variable_product->get_price_suffix()
                     .'</span>';
        } else {
            $price = wc_price( wc_get_price_to_display( $variable_product ) ) . $variable_product->get_price_suffix();
        }
        echo '<div class="single-product__price price single-product__js-variations" id="product-single-variation-id-'.$variation_id.'" data-variation="'.$variation_id.'">'.$price.'</div>';
    }

    function replace_variation_single_price(){
        global $product;
    
        // Main Price
        $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
        $price = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
    
        // Sale Price
        $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
        sort( $prices );
        $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
    
        if ( $price !== $saleprice && $product->is_on_sale() ) {
            $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
        }
   
       echo '<div class="single-product__price price">'.$price.'</div>
              <div class="hidden-variable-price single-product__price-is-hidden" >'.$price.'</div>';
   }

    public function calculate_discount($product){

    }
/**
 * @snippet       Display Discount Percentage @ Loop Pages - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=21997
 * @author        Rodolfo Melogli
 * add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_show_sale_percentage_loop', 25 );
 * @compatible    WC 3.1.0
 */
    public function show_sale_percentage() {
        global $product;   
        if ( $product->is_on_sale() ) { 
        if ( ! $product->is_type( 'variable' ) ) {
        $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
        } else {
        $max_percentage = 0;
        foreach ( $product->get_children() as $child_id ) {
            $variation = wc_get_product( $child_id );
            $price = $variation->get_regular_price();
            $sale = $variation->get_sale_price();
            if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
            if ( $percentage > $max_percentage ) {
                $max_percentage = $percentage;
            }
        }
        } 
        return   round($max_percentage) . "%";
        }
    }



    // Categroy filter
    // Shop query for sidebar


    function filter_product_query( $q ){
        $taxonomies = array();
        if (!empty($_GET['category'])) {
            $categories = explode(',',$_GET['category']);
            $taxonomies[] = array (
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $categories
            );
        }
        // https://wordpress.stackexchange.com/questions/25076/how-to-filter-wordpress-search-excluding-post-in-some-custom-taxonomies
        $taxonomy_query = array('relation' => 'OR', $taxonomies);
        if (!empty( $taxonomies)) {
            $q->set('tax_query', $taxonomy_query);
        }
    }


    /**
     * Outputs a checkout/address form field.
     *
     * @param string $key Key.
     * @param mixed  $args Arguments.
     * @param string $value (default: null).
     * @return string
     */
    function woocommerce_form_field( $key, $args, $value = null ) {
        $defaults = array(
            'type'              => 'text',
            'label'             => '',
            'description'       => '',
            'placeholder'       => '',
            'maxlength'         => false,
            'required'          => false,
            'autocomplete'      => false,
            'id'                => $key,
            'class'             => array(),
            'label_class'       => array(),
            'input_class'       => array(),
            'return'            => false,
            'options'           => array(),
            'custom_attributes' => array(),
            'validate'          => array(),
            'default'           => '',
            'autofocus'         => '',
            'priority'          => '',
        );

        $args = wp_parse_args( $args, $defaults );
        
        $args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

        if ( $args['required'] ) {
            $args['class'][] = 'validate-required';
            $required = ' *';
           //$required        = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
        } else {
            $required = '';
        }

        if ( is_string( $args['label_class'] ) ) {
            $args['label_class'] = '';
            $args['label_class'] = array( $args['label_class'] );
        }

        if ( is_null( $value ) ) {
            $value = $args['default'];
        }
        

        // Custom attribute handling.
        $custom_attributes         = array();
        $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );

        if ( $args['maxlength'] ) {
            $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
        }

        if ( ! empty( $args['autocomplete'] ) ) {
            $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
        }

        if ( true === $args['autofocus'] ) {
            $args['custom_attributes']['autofocus'] = 'autofocus';
        }

        if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
            foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
                $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
            }
        }

        if ( ! empty( $args['validate'] ) ) {
            foreach ( $args['validate'] as $validate ) {
                $args['class'][] = 'validate-' . $validate;
            }
        }

        $field           = '';
        $label_id        = $args['id'];
        $sort            = $args['priority'] ? $args['priority'] : '';
        $field_container = '<div class="billing-fields__item %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '"><div class="input-field">%3$s</div></div>';

        switch ( $args['type'] ) {
            case 'country':
                $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

                if ( 1 === count( $countries ) ) {

                    $field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

                    $field .= '<input class="validate" type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" readonly="readonly" />';

                } else {

                    $field = '<select class="validate" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes );

                    foreach ( $countries as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                    }

                    $field .= '</select>';

                    $field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '">' . esc_html__( 'Update country', 'woocommerce' ) . '</button></noscript>';

                }

                break;
            case 'state':
                /* Get country this state field is representing */
                $for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
                $states      = WC()->countries->get_states( $for_country );

                if ( is_array( $states ) && empty( $states ) ) {

                    $field_container = '<div class="billing-fields__item input-field %1$s" id="%2$s" style="display: none"><div class="input-field">%3$s</div></div>';

                    $field .= '<input class="validate" type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes )  . '" readonly="readonly" />';

                } elseif ( ! is_null( $for_country ) && is_array( $states ) ) {

                    $field .= '<select class="validate" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
                        <option value="">' . esc_html__( 'Select a state&hellip;', 'woocommerce' ) . '</option>';

                    foreach ( $states as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                    }

                    $field .= '</select>';

                } else {

                    $field .= '<input class="validate" type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                }

                break;
            case 'textarea':
                $field .= '<textarea class="validate" name="' . esc_attr( $key ) . '" class="input-text1 ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] )  . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

                break;
            case 'checkbox':
                $field = '<label class="checkbox validate' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
                        <input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] )  . checked( $value, 1, false ) . ' /> ' . $args['label'] .  '</label>';

                break;
            case 'password':
            case 'text':
            case 'email':
            case 'tel':
            case 'number':
                $field .= '
                <input class="validate" type="' . esc_attr( $args['type'] ) . '"  name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"   value="' . esc_attr( $value ) . '"  />';
               // $field .= '<input type="' . esc_attr( $args['type'] ) . '" class=" ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder1="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                break;
            case 'select':
                $field   = '';
                $options = '';

                if ( ! empty( $args['options'] ) ) {
                    foreach ( $args['options'] as $option_key => $option_text ) {
                        if ( '' === $option_key ) {
                            // If we have a blank option, select2 needs a placeholder.
                            if ( empty( $args['placeholder'] ) ) {
                                $args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
                            }
                            $custom_attributes[] = 'data-allow_clear="true"';
                        }
                        $options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
                    }

                    $field .= '<select value="" class="validate" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder1="' . esc_attr( $args['placeholder'] ) . '">
                            ' . $options . '
                        </select>';
                }

                break;
            case 'radio':
                $label_id = current( array_keys( $args['options'] ) );

                if ( ! empty( $args['options'] ) ) {
                    foreach ( $args['options'] as $option_key => $option_text ) {
                        $field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
                        $field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . " ". $required . '</label>';
                    }
                }

                break;
        }

        if ( ! empty( $field ) ) {
            $field_html = '';

            if ( $args['label'] && 'checkbox' !== $args['type'] && 'select1' != $args['type'] && 'country' != $args['type']  ) {
                //$field_html .=  '<label for="' . esc_attr( $label_id ) . '1">labela'.$args['label'].'</label>';
                $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '"><span>' . $args['label'] . $required . '</span></label>';
            }

            $field_html .= $field;
//var_dump($args['type']);
            if ( 'country' == $args['type']) {
                 $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="select-label-fix ' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
            }

            if ( $args['description'] ) {
                $field_html .= '<span class="description">' . esc_html( $args['description'] ) . '</span>';
            }

            $field_html .= '<span class="helper-text errorClass" data-error="wrong" data-success=""></span>';
            $container_class = esc_attr( implode( ' ', $args['class'] ) );
            $container_id    = esc_attr( $args['id'] ) . '_field';
            $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
        }

        $field =  apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

        if ( $args['return'] ) {
            return  $field;
        } else {
            echo $field; // WPCS: XSS ok.
        }
    }

      
}
