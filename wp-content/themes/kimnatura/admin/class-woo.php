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
    add_image_size( 'shop-catalog', 250,200, true );
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
    wp_register_script( $this->theme_name . '-multistep-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ) );
    wp_enqueue_script( $this->theme_name . '-multistep-scripts' );

  }
/**
   * Register the JavaScript for the Single Product page .
   *
   * @since 2.0.0
   */
  public function enqueue_scripts_singlepage() {

    $main_script = '/skin/public/scripts/vendors/woocommerce/singlepage.js';
    wp_register_script( $this->theme_name . '-multistep-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ) );
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
        $fields["billing"]['billing_city']['class']         = array('form-row-first'); 
        $fields["billing"]['billing_postcode']['class']     = array('form-row-last');
        //$fields["billing"]['billing_country']['class']    	= array('form-row-wide');
        //var_dump($fields);
        return $fields;
  }
  
  /**
   * Create new image sizes
   *
   * @since 2.0.0
   */
  public function add_custom_image_sizes() {
        add_image_size( 'blogarchive', 576 , 500, true ); 
  }

  public function test(){
        echo "OK OVO RADI SADA";
       // add_filter('b4b_checkout_step','b4b_test');
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
        $productIDs = get_post_meta($post->ID,'custom_productIds',true);
        $title =  __('Vezani proizvodi','b4b');
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

    $this->enqueue_scripts_filter();
    $t = '';
    //$t.='C Step='.$step;
    if (is_cart()) {
      $step =  0;
    }
    if (Is_checkout()) {
      $step =  1;
    }
    if (is_wc_endpoint_url( 'order-pay' )) {
      $t .="order-pay";
      $step = 4;
    }
    if (is_wc_endpoint_url( 'order-received' )) {
      $t .="order-received";
    }
  
  
    if (is_account_page()) {
      $t .="acount_page";
    }
    if (is_cart()) {
      //$t .="Cart";
    }
     //var_dump($_POST);
    
    //is_order_received_page
  
    
    if (Is_view_order_page()) {
      $step =  2;
    }
    if (Is_order_received_page()) {
      $step =  3;
    }
    if (Is_view_order_page()) {
      $step =  4;
    }
     
    /*
     * Page title
     *  
    $t  .= '<header class="page__title">';
    $t  .= '<h1 class="page__title">'.get_the_title( ).'</h1>'; 
    $t  .= '<p class="page__description">'.get_the_subtitle().'</p>';
    $t  .= '</header>';
    */
      //$t.='Step='.$step;
    $t  .= '<ul class="cart-checkout-navigation">';
    // First item
    $t  .= '<li id="wc-multistep-cart" data-step="cart" class="cart-checkout-navigation__item '. ( ($step == 0 ) ? 'is-active' : '').' '. ( ($step > 0 ) ? 'is-activated' : '').'" >';
    //$t  .= __('Košarica','b4b');
    if ($step>0){
      $t .= '<a href="'.get_permalink( wc_get_page_id( 'cart' )).'">'.__('Košarica','b4b').'</a>';
    }else{
      $t .= '<a href="'.get_permalink( wc_get_page_id( 'cart' )).'">'.__('Košarica','b4b').'</a>';
    }
    $t  .= '</li>';
    // Second item
    $t  .= '<li id="wc-multistep-details" data-step="customer-details" class="cart-checkout-navigation__item '. ( ($step == 1) ? 'is-active' : '').'" >';
    $t  .= __('Dostava','b4b');
    $t  .= '</li>';
    // Third item
    $t  .= '<li id="wc-multistep-payment" data-step="payment" class="cart-checkout-navigation__item '. ( ($step == 2) ? 'is-active' : '').'" >';
    $t  .= __('Način plačanja','b4b');
    $t  .= '</li>';
    // Fourth Item
    $t  .= '<li id="wc-multistep-finish" data-step="finish" class="cart-checkout-navigation__item is-last 
    '. ( ($step == 3) ? ' is-active' : '').'" >';
    $t  .= __('Potvrda','b4b');
    $t  .= '</li>';
  
  
    $t  .=  "</ul>";
    //$t  .= '<div class="page__content">';  
    //$t  .= 'Show:'.($step == 0) ? 'is-active' : 'prazno';
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
			$message =  sprintf( 'Add %s more to get free shipping!', wc_price( $remaining ) );
		}
	}
	// Show info if price is not calculated just for info
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
							$message=  sprintf( 'If you add %s more to get free shipping!', wc_price( $remaining ) );
						}
					}
				}
				//echo $value->id;
				//echo $value->get_title();
				// var_dump($value);
			}
        }
    
	}
    if ( is_cart() ){
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
	$attribute =  $product->get_attribute('pakovanje');
	return 
		 '<div class="cart__item-name">'
		. $product->get_title()
		. '</div>'
		. '<p class="cart__item-desc">'
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
            echo '<div class="section__image">'.wp_get_attachment_image( $thumbnail_id , 'full-width' ) . '</div>';
        }else{
            echo '<div class="section__image">'.get_the_post_thumbnail(get_option( 'woocommerce_shop_page_id'),'full-width' ). '</div>';
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
        $output = '<div class="shop-catalog__image">';

        if ( has_post_thumbnail() ) {               
            $output .= get_the_post_thumbnail( $size );
        } else {
           //  $output .= wc_placeholder_img( $size );
             // Or alternatively setting yours width and height shop_catalog dimensions.
             // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
        }                       
        $output .= '</div>';
        echo $output;
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
                $price = '<span class="featured-link__sale-regular-price">'.wc_price($product->get_variation_regular_price( 'min', true )).'</span>';
                $price.=  wc_price($product->get_variation_price( 'min', true ).$product->get_price_suffix()) ;
            }
            else{
                $price=  wc_price($product->get_variation_price( 'min', true ).$product->get_price_suffix()) ;
            }
        }else{
            $price= $product->get_price_html();
        }
        ?>
            <div class="shop-catalog__price"><?php echo $price ?></div>
        <?php 
        
        $string =''; 
        if ($product->is_type( 'variable' )) 
        {
            $attributes =  $product->get_variation_attributes() ;
            $string ='<div class="shop-catalog__variations">';
            foreach($attributes as $attribute){
                foreach ($attribute as $variation){
                    $string .='<span>'.$variation.'<span>';
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
		$html .= '' . __( 'Idi na proizvod','b4b' ) . '';
		//$html .= '' . __( 'View product' ) . '';

		$html .= '</a>';
	}else{
		$html = '<a href="' . esc_url( get_permalink($product->get_ID())) . '" class="shop-catalog__link-product btn btn--ghost btn--small  btn--fluid1" >';
		//$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '' . __( 'Idi na proizvod','b4b' ) . '';
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
        /*
        foreach ( $attributes as $attribute_name => $attribute ) :
            $s = sanitize_title( $attribute_name );
            echo '<h5>'.wc_attribute_label( $attribute_name ).'</h5>';  
            foreach ( $available_variations as $options) {
                $variation_id = $options['variation_id'];
                $optionattr = $options['attributes'];
                $variable_product = new WC_Product_Variation( $variation_id );
                echo '<div>'; 

                echo '<span class="featured-link__option-name">'.$optionattr['attribute_'.sanitize_title($attribute_name)].'</span>'; 
                // from get_price_html
                if ( $variable_product->is_on_sale() ) {
                    $price = wc_format_sale_price( 
                                  wc_get_price_to_display( $variable_product, 
                                                           array( 'price' => $variable_product->get_regular_price() ) ),
                                                           wc_get_price_to_display( $variable_product ) 
                             ) . $variable_product->get_price_suffix();
                    $price = 
                             '<span class="featured-link__sale-price">'
                             .wc_price(wc_get_price_to_display( $variable_product ))
                             .$variable_product->get_price_suffix()
                             .'</span>'
                             .'<span class="featured-link__regular-price">'
                             .wc_price($variable_product->get_regular_price()).$variable_product->get_price_suffix()
                             .'</span>';
                } else {
                    $price = wc_price( wc_get_price_to_display( $variable_product ) ) . $variable_product->get_price_suffix();
                }
                echo '<span class="featured-link__option-price">'.$price.'</span>';
                echo '</div>';

             }      

        endforeach;
        */
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
}
