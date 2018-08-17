<?php
/**
 * Theme Name: kimnatura
 * Description: kimnatura
 * Author: marijan <marijan>
 * Author URI:
 * Version: 1.0
 * Text Domain: kimnatura
 *
 * @package Kimnatura
 */

//namespace Kimnatura;



/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );




//exclude_category(1);
//use Kimnatura\Includes\Loader;
//$loader = new Loader();
//$loader->add_action( 'pre_get_posts', null, 'exclude_category' );

if ( class_exists( 'Subtitles' ) && method_exists( 'Subtitles', 'subtitle_styling' ) ) {
	remove_action( 'wp_head', array( Subtitles::getInstance(), 'subtitle_styling' ) );
}
add_filter('subtitle_view_supported', '__return_false');


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}


$inf_theme_options['cookies_notification_description'] = 'Za pružanje boljeg korisničkog iskustva, ova stranica koristi cookies. Nastavkom pregleda stranice slažete se s korištenjem kolačića.';

/**
 * Theme version global
 *
 * @since 2.0.0
 * @package Kimnatura
 */
define( 'KIM_THEME_VERSION', '1.0.1' );

/**
 * Theme name global
 *
 * @since 2.0.0
 * @package Kimnatura
 */
define( 'KIM_THEME_NAME', 'kimnatura' );

/**
 * Global image path
 *
 * @since 2.0.0
 * @package Kimnatura
 */
define( 'KIM_IMAGE_URL', get_template_directory_uri() . '/skin/public/images/' );

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 *
 * @since 2.1.0 Using Composer based autloader.
 * @since 2.0.0
 * @package Kimnatura
 */
require WP_CONTENT_DIR . '/../vendor/autoload.php';

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 *
 * @since 2.0.0
 */
function init_theme() {
    $plugin = new \Kimnatura\Includes\Main();
    $plugin->run();


    //$loader = $loader->get_loader();

}
// CHANGE
init_theme();




//inf_test();
/* Exclude some categories */
add_action( 'pre_get_posts', 'test',10 );

function test( $query ) {
  $slugs = array('slider','homepage','sastojci');
  foreach($slugs as $slug){
      $cat = get_category_by_slug($slug); 
      if ($cat instanceof WP_TERM){
          $catIDs[] = $cat->term_id;
      }
      
  }  
  if ( $query->is_home() && $query->is_main_query() ) {
      foreach($catIDs as $cat){
          $query->set( 'cat', '-'.$cat );
      }
      
  }
}


function eyespeak_share() { ?>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#domready=1"></script>
      <div class="sharing sharing__inline">
  
          <div class="addthis_toolbox" addthis:url="http://example.com" addthis:title="An excellent website">
              <div class="custom_images">
                  <a class="addthis_button_twitter"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-twitter-2" class="at-icon at-icon-twitter" style="fill: rgb(34, 34, 34); width: 32px; height: 32px;"><title id="at-svg-twitter-2">Twitter</title><g><path d="M27.996 10.116c-.81.36-1.68.602-2.592.71a4.526 4.526 0 0 0 1.984-2.496 9.037 9.037 0 0 1-2.866 1.095 4.513 4.513 0 0 0-7.69 4.116 12.81 12.81 0 0 1-9.3-4.715 4.49 4.49 0 0 0-.612 2.27 4.51 4.51 0 0 0 2.008 3.755 4.495 4.495 0 0 1-2.044-.564v.057a4.515 4.515 0 0 0 3.62 4.425 4.52 4.52 0 0 1-2.04.077 4.517 4.517 0 0 0 4.217 3.134 9.055 9.055 0 0 1-5.604 1.93A9.18 9.18 0 0 1 6 23.85a12.773 12.773 0 0 0 6.918 2.027c8.3 0 12.84-6.876 12.84-12.84 0-.195-.005-.39-.014-.583a9.172 9.172 0 0 0 2.252-2.336" fill-rule="evenodd"></path></g></svg></a>
                  <a class="addthis_button_facebook">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-facebook-1" class="at-icon at-icon-facebook" style="fill: rgb(34, 34, 34); width: 32px; height: 32px;"><title id="at-svg-facebook-1">Facebook</title><g><path d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z" fill-rule="evenodd"></path></g></svg>
          </a>
                  <a class="addthis_button_pinterest"></a>
          <a class="addthis_button_email"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-email-5" class="at-icon at-icon-email" style="fill: rgb(34, 34, 34); width: 32px; height: 32px;"><title id="at-svg-email-5">Email</title><g><g fill-rule="evenodd"></g><path d="M27 22.757c0 1.24-.988 2.243-2.19 2.243H7.19C5.98 25 5 23.994 5 22.757V13.67c0-.556.39-.773.855-.496l8.78 5.238c.782.467 1.95.467 2.73 0l8.78-5.238c.472-.28.855-.063.855.495v9.087z"></path><path d="M27 9.243C27 8.006 26.02 7 24.81 7H7.19C5.988 7 5 8.004 5 9.243v.465c0 .554.385 1.232.857 1.514l9.61 5.733c.267.16.8.16 1.067 0l9.61-5.733c.473-.283.856-.96.856-1.514v-.465z"></path></g></svg></a>
          <a id="atcounter"></a>
              </div>
          </div>
      </div>
      <script>
          var addthis_share = {
              // ... other options
              url_transforms : {
                  shorten: {
                      twitter: 'bitly'
                  }
              }, 
              shorteners : {
                  bitly : {}
              }
      }
     // addthis.counter("#atcounter");
          jQuery(document).ready(function($) {
              jQuery('.sharing-button').click(function(){
                  $(this).parent('.sharing').toggleClass('active');
              });
          });
      </script>
  <?php
  } 

/**
 * Customizer additions.
 */
require get_template_directory() . '/widgets/b4bProductCategories.php';


add_filter("woocommerce_checkout_fields", "order_fields");
function order_fields($fields) {
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

// Register Custom Taxonomy
function slidercategory() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Categories General Name', 'b4b' ),
		'singular_name'              => _x( 'Categorie', 'Categories Singular Name', 'b4b' ),
		'menu_name'                  => __( 'Categories', 'b4b' ),
		'all_items'                  => __( 'All Items', 'b4b' ),
		'parent_item'                => __( 'Parent Item', 'b4b' ),
		'parent_item_colon'          => __( 'Parent Item:', 'b4b' ),
		'new_item_name'              => __( 'New Item Name', 'b4b' ),
		'add_new_item'               => __( 'Add New Item', 'b4b' ),
		'edit_item'                  => __( 'Edit Item', 'b4b' ),
		'update_item'                => __( 'Update Item', 'b4b' ),
		'view_item'                  => __( 'View Item', 'b4b' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'b4b' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'b4b' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'b4b' ),
		'popular_items'              => __( 'Popular Items', 'b4b' ),
		'search_items'               => __( 'Search Items', 'b4b' ),
		'not_found'                  => __( 'Not Found', 'b4b' ),
		'no_terms'                   => __( 'No items', 'b4b' ),
		'items_list'                 => __( 'Items list', 'b4b' ),
		'items_list_navigation'      => __( 'Items list navigation', 'b4b' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'slider_cat', array( 'slider' ), $args );

}
//add_action( 'init', 'slidercategory', 0 );
// Register Custom Post Type
function slider() {

	$labels = array(
		'name'                  => _x( 'Sliders', 'Post Type General Name', 'b4b' ),
		'singular_name'         => _x( 'Slider', 'Post Type Singular Name', 'b4b' ),
		'menu_name'             => __( 'Sliders', 'b4b' ),
		'name_admin_bar'        => __( 'Slider', 'b4b' ),
		'archives'              => __( 'Item Archives', 'b4b' ),
		'attributes'            => __( 'Item Attributes', 'b4b' ),
		'parent_item_colon'     => __( 'Parent Item:', 'b4b' ),
		'all_items'             => __( 'All Items', 'b4b' ),
		'add_new_item'          => __( 'Add New Item', 'b4b' ),
		'add_new'               => __( 'Add New', 'b4b' ),
		'new_item'              => __( 'New Item', 'b4b' ),
		'edit_item'             => __( 'Edit Item', 'b4b' ),
		'update_item'           => __( 'Update Item', 'b4b' ),
		'view_item'             => __( 'View Item', 'b4b' ),
		'view_items'            => __( 'View Items', 'b4b' ),
		'search_items'          => __( 'Search Item', 'b4b' ),
		'not_found'             => __( 'Not found', 'b4b' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'b4b' ),
		'featured_image'        => __( 'Featured Image', 'b4b' ),
		'set_featured_image'    => __( 'Set featured image', 'b4b' ),
		'remove_featured_image' => __( 'Remove featured image', 'b4b' ),
		'use_featured_image'    => __( 'Use as featured image', 'b4b' ),
		'insert_into_item'      => __( 'Insert into item', 'b4b' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'b4b' ),
		'items_list'            => __( 'Items list', 'b4b' ),
		'items_list_navigation' => __( 'Items list navigation', 'b4b' ),
		'filter_items_list'     => __( 'Filter items list', 'b4b' ),
	);
	$rewrite = array(
		'slug'                  => 'news',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Slider', 'b4b' ),
		'description'           => __( 'Sliders', 'b4b' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'slider_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-slides',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
    register_post_type( 'slider', $args );
   // flush_rewrite_rules();

}
//add_action( 'init', 'slider', 10 );
//flush_rewrite_rules();

//kod za dodavanje checkboxa za prihvaćanje uvjeta korištenja
add_action( 'woocommerce_register_form', 'add_terms_and_conditions_to_registration', 20 );
function add_terms_and_conditions_to_registration() {

    $terms_page_id = wc_get_page_id( 'terms' );

    if ( $terms_page_id > 0 ) {
        $terms         = get_post( $terms_page_id );
        $terms_content = has_shortcode( $terms->post_content, 'woocommerce_checkout' ) ? '' : wc_format_content( $terms->post_content );

        if ( $terms_content ) {
            echo '<div class="woocommerce-terms-and-conditions" style="display: none; max-height: 200px; overflow: auto;">' . $terms_content . '</div>';
        }
        ?>
        <p id="terms_cond" class="form-row terms wc-terms-and-conditions">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" 
				name="terms" 
				<?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" /> 
				<span><?php printf( __( 'Pristajem na <a href="%s"  class="woocommerce-terms-and-conditions-link">uvjete korištenja</a>', 'woocommerce' ), "/uvjeti-koristenja-internetske-stranice" ); ?></span> <span class="required">*</span>
            </label>
            <input type="hidden" name="terms-field" value="1" />
        </p>
    <?php
    }
} 

// Validate required term and conditions check box
add_action( 'woocommerce_register_post', 'terms_and_conditions_validation', 20, 3 );
function terms_and_conditions_validation( $username, $email, $validation_errors ) {
    if ( ! isset( $_POST['terms'] ) )
        $validation_errors->add( 'terms_error', __( 'Terms and condition are not checked!', 'woocommerce' ) );

    return $validation_errors;
}


// Link za preuzimanje računa
add_filter('woocommerce_thankyou_order_received_text', 'wpo_wcpdf_thank_you_link', 10, 2);
function wpo_wcpdf_thank_you_link( $text, $order ) {
    if ( is_user_logged_in() ) {
        $order_id = method_exists($order, 'get_id') ? $order->get_id() : $order->id;
        $pdf_url = wp_nonce_url( admin_url( 'admin-ajax.php?action=generate_wpo_wcpdf&template_type=invoice&order_ids=' . $order_id . '&my-account'), 'generate_wpo_wcpdf' );
        $text .= '<div class="thanks__button"><a class="checkout-button button alt wc-forward btn btn--primary-color" href="'.esc_attr($pdf_url).'">Preuzmite PDF</a></div>';
    }
    return $text;
}


add_filter( 'login_redirect', function( $url, $query, $user ) {
	return home_url();
}, 10, 3 );



remove_filter( 'woocommerce_checkout_fields', 'woocommerce_checkout_fields_filter', 100 );


add_filter( 'wpo_wcpdf_invoice_title', 'wpo_wcpdf_invoice_title' );
function wpo_wcpdf_invoice_title () {
    $invoice_title = 'PONUDA';
    return $invoice_title;
}

add_filter( 'wpo_wcpdf_filename', 'wpo_wcpdf_custom_filename', 10, 4 );
function wpo_wcpdf_custom_filename( $filename, $template_type, $order_ids, $context ) {
    $invoice_string = _n( 'invoice', 'invoices', count($order_ids), 'woocommerce-pdf-invoices-packing-slips' );
    $new_prefix = _n( 'ponuda', 'ponuda', count($order_ids), 'woocommerce-pdf-invoices-packing-slips' );
    $new_filename = str_replace($invoice_string, $new_prefix, $filename);
 
    return $new_filename;
}

// Brisanje svih vrsta naplate dostave (npr. flat rate:)
/**
 * @snippet       Removes shipping method labels @ WooCommerce Cart
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=484
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 2.6.2
 */
 
add_filter( 'woocommerce_cart_shipping_method_full_label', 'bbloomer_remove_shipping_label', 10, 2 );

function bbloomer_remove_shipping_label($label, $method) {
$new_label = preg_replace( '/^.+:/', '', $label );
return $new_label;
}
