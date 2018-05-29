<?php
/**
 * The Widgets specific functionality.
 *
 * @since   2.0.0
 * @package Kimnatura\Admin
 */

namespace Kimnatura\Admin;

/**
 * Class Widgets
 */
class Widgets {

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
   * Set up widget areas
   *
   * @since 2.0.0
   */
  public function register_widget_position() {
    register_sidebar(
      array(
          'name'          => esc_html__( 'Blog', 'kimnatura' ),
          'id'            => 'blog',
          'description'   => esc_html__( 'Description', 'kimnatura' ),
          'before_widget' => '',
          'after_widget'  => '',
          'before_title'  => '',
          'after_title'   => '',
      )
    );
    register_sidebar(
      array (
          'name' => __( 'Shop', 'kimnatura' ),
          'id' => 'woocommerce-shop',
          'description' => __( 'Custom Sidebar', 'kimnatura' ),
          'before_widget' => '',
          'after_widget' => "",
          'before_title' => '<h4>',
          'after_title' => '</h4>',
      )
    );
    register_sidebar(
      array (
          'name' => __( 'Mega Menu', 'kimnatura' ),
          'id' => 'mega-menu',
          'description' => __( 'Mega Menu', 'kimnatura' ),
          'before_widget' => '',
          'after_widget' => "",
          'before_title' => '',
          'after_title' => '',
      )
    );
  }

}
