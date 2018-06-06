<?php
/**
 * The General specific functionality.
 *
 * @since   2.0.0
 * @package Kimnatura\Theme
 */

namespace Kimnatura\Theme;

/**
 * Class General
 */
class General {

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
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 2.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name    = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
  }

  /**
   * Enable theme support
   *
   * @since 2.0.0
   */
  public function add_theme_support() {
    add_theme_support( 'title-tag', 'html5' );
    add_image_size( 'full-width', 1200,400, true );  //300 pixels wide (and unlimited height) 
    add_image_size( 'highlighted', 564,493, true ); // Try to not use
    add_image_size( 'shop-catalog', 375,250, true );
    add_image_size( 'shop-catalog-small', 342,228, true );
    add_image_size( 'sastojci', 1200,400, true );
    add_image_size( 'product', 585, 390,true);
    add_image_size( 'blog-list', 567, 493,true);
    add_image_size('gallery-large',668,437,true);
    add_image_size('gallery-small',468,437,true);
    add_image_size( 'slider-full-width', 1200,560, true );

 
  }




  public function wpshout_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
      'gallery-large' => __( 'Gallery Large' ),
      'gallery-small' => __( 'Gallery Small' ),
      'full-width' => __( 'Full Width' ),
      'highlighted' => __( 'Highlighetd Post' ),
      //'medium-something' => __( 'Medium Something' ),
    ) );
  }


}
