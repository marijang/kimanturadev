<?php
/**
 * The Admin specific functionality.
 * General stuff that is not specific to any class.
 *
 * @since   2.0.0
 * @package Kimnatura\Admin
 */

namespace Kimnatura\Admin;

use Kimnatura\Helpers as General_Helpers;
use Kimnatura\Admin\b4bProductCategories_widget as b4bProductCategories_widget;
/**
 * Class Admin
 */
class Admin {

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
   * General Helper class
   *
   * @var object General_Helper
   *
   * @since 2.0.1
   */
  public $general_helper;

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

    $this->general_helper = new General_Helpers\General_Helper();
  }

  /**
   * Register the Stylesheets for the admin area.
   *
   * @since 2.0.0
   */
  public function enqueue_styles() {

    $main_style = '/skin/public/styles/applicationAdmin.css';
    wp_register_style( $this->theme_name . '-style', get_template_directory_uri() . $main_style, array(), $this->general_helper->get_assets_version( $main_style ) );
    wp_enqueue_style( $this->theme_name . '-style' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since 2.0.0
   */
  public function enqueue_scripts() {

    $main_script = '/skin/public/scripts/applicationAdmin.js';
    wp_register_script( $this->theme_name . '-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ), true );
    wp_enqueue_script( $this->theme_name . '-scripts' );

  }

  /**
   * Method that changes admin colors based on environment variable
   *
   * @param string $color_scheme Color scheme string.
   * @return string              Modified color scheme.
   *
   * @since 2.1.0
   */
  public function set_admin_color_based_on_env( $color_scheme ) {
    if ( ! defined( 'KIM_ENV' ) ) {
      return false;
    }

    if ( KIM_ENV === 'production' ) {
      $color_scheme = 'sunrise';
    } elseif ( KIM_ENV === 'staging' ) {
      $color_scheme = 'blue';
    } else {
      $color_scheme = 'fresh';
    }

    return $color_scheme;
  }


  /**
   * Method that adds Widget
   *
   * @param string $color_scheme Color scheme string.
   * @return string              Modified color scheme.
   *
   * @since 2.1.0
   */
  function b4bProductCategories_widget() { 
      register_widget( new b4bProductCategories_widget() );
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
}
