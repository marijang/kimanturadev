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

  function last_news() {		
		get_template_part( 'section-templates/last-news' );
  }
  /*
  if ( is_front_page() && is_home() ) {
    // Default homepage
    $this->loader->add_action('b4b_after_single_page',$woo,'woocommerce_related_products',10);
    $this->loader->add_action('b4b_after_single_page',$blog,'last_news',20);  
  } elseif ( is_front_page() ){
  //Static homepage
  $this->loader->add_action('b4b_after_single_page',$woo,'woocommerce_related_products',10);
  $this->loader->add_action('b4b_after_single_page',$blog,'last_news',20);
  } elseif ( is_home()){
    //Blog page
    $this->loader->add_action('b4b_after_single_page',$woo,'woocommerce_related_products',10);
    //  $this->loader->add_action('b4b_after_single_page',$blog,'last_news',20);
  } else {
    //everything else
    $this->loader->add_action('b4b_after_single_page',$woo,'woocommerce_related_products',10);
    $this->loader->add_action('b4b_after_single_page',$blog,'last_news',20);
  }
  */

  public function dynamic_load($test=""){
    global $woo;
    if ( is_front_page() && is_home() ) {
      // Default homepage
      
      add_action('b4b_after_single_page',array($woo,'woocommerce_related_products'),10);
      add_action('b4b_after_single_page',array($this,'last_news'),20);  
    } elseif ( is_front_page() ){
    //Static homepage
    echo "TO";
       add_action('b4b_before_home_page',array($woo,'woocommerce_related_products'),10);
       add_action('b4b_after_single_page',array($this,'last_news'),20);
    } elseif ( is_home()){
      //Blog page
      add_action('b4b_after_single_page',array($this,'woocommerce_related_products'),10);
      //  $this->loader->add_action('b4b_after_single_page',$blog,'last_news',20);
    } else {
      //everything else
      add_action('b4b_after_single_page',array($woo,'woocommerce_related_products'),10);
      add_action('b4b_after_single_page',array($blog,'last_news'),20);
    }
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
