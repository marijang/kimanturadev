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
 * Class Media
 */
class Blog {

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

 

  public function b4b_test($step=1) {
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
    $t  .= 'oooooo<ul class="page__shop-checkout-navigation">';
    // First item
    $t  .= '<li id="wc-multistep-cart" data-step="cart" class="page__shop-checkout-navigation-item '. ( ($step == 0 ) ? 'is-active' : '').' '. ( ($step > 0 ) ? 'is-activated' : '').'" >';
    //$t  .= __('Košarica','b4b');
    if ($step>0){
      $t .= '<a href="'.get_permalink( wc_get_page_id( 'cart' )).'">'.__('Košarica','b4b').'</a>';
    }else{
      $t .= '<a href="'.get_permalink( wc_get_page_id( 'cart' )).'">'.__('Košarica','b4b').'</a>';
    }
    $t  .= '</li>';
    // Second item
    $t  .= '<li id="wc-multistep-details" data-step="customer-details" class="page__shop-checkout-navigation-item '. ( ($step == 1) ? 'is-active' : '').'" >';
    $t  .= __('Dostava','b4b');
    $t  .= '</li>';
    // Third item
    $t  .= '<li id="wc-multistep-payment" data-step="payment" class="page__shop-checkout-navigation-item '. ( ($step == 2) ? 'is-active' : '').'" >';
    $t  .= __('Način plačanja','b4b');
    $t  .= '</li>';
    // Fourth Item
    $t  .= '<li id="wc-multistep-finish" data-step="finish" class="page__shop-checkout-navigation-item is-last 
    '. ( ($step == 3) ? ' is-active' : '').'" >';
    $t  .= __('Potvrda','b4b');
    $t  .= '</li>';
  
  
    $t  .=  "</ul>";
    //$t  .= '<div class="page__content">';  
    //$t  .= 'Show:'.($step == 0) ? 'is-active' : 'prazno';
    return $t;
  }

  public function inf_exclude_category( $query ) {
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

  /**
   * Enable SVG uplod in media
   *
   * @param array $mimes Load all mimes types.
   * @return array       Return original and updated.
   *
   * @since 2.0.0
   */
  public function enable_mime_types( $mimes ) {

  }

  /**
   * Enable SVG preview in Media Library
   *
   * @param array      $response   Array of prepared attachment data.
   * @param int|object $attachment Attachment ID or object.
   * @param array      $meta       Array of attachment meta data.
   *
   * @since 2.0.2 Added checks if xml file is valid.
   * @since 2.0.0
   */
  public function enable_svg_library_preview( $response, $attachment, $meta ) {
    if ( $response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists( 'SimpleXMLElement' ) ) {
      try {
        $path = get_attached_file( $attachment->ID );

        if ( file_exists( $path ) ) {
          // phpcs:disable
          $svg_content = file_get_contents( $path );
          // phpcs:enable

          if ( ! $this->general_helper->is_valid_xml( $svg_content ) ) {
            new \WP_Error( sprintf( esc_html__( 'Error: File invalid: %s', 'kimnatura' ), $path ) );
            return false;
          }

          $svg    = new \SimpleXMLElement( $svg_content );
          $src    = $response['url'];
          $width  = (int) $svg['width'];
          $height = (int) $svg['height'];

          // media gallery.
          $response['image'] = compact( 'src', 'width', 'height' );
          $response['thumb'] = compact( 'src', 'width', 'height' );

          // media single.
          $response['sizes']['full'] = array(
              'height'      => $height,
              'width'       => $width,
              'url'         => $src,
              'orientation' => $height > $width ? 'portrait' : 'landscape',
          );
        }
      } catch ( Exception $e ) {
        new \WP_Error( sprintf( esc_html__( 'Error: %s', 'kimnatura' ), $e ) );
      }
    }

    return $response;
  }

 

  /**
   * Wrap utility class arround iframe to enable responsive
   *
   * @param  string $html   Iframe html to wrap around.
   * @return string Wrapped Iframe with a utility class.
   *
   * @since 2.0.0
   */
  public function wrap_responsive_oembed_filter( $html ) {
    $return = '<span class="iframe u__embed-video-responsive">' . $html . '</span>';
    return $return;
  }
}
