<?php
/**
 * The file that defines the main start class
 *
 * A class definition that includes attributes and functions used across both the
 * theme-facing side of the site and the admin area.
 *
 * @since   2.0.0
 * @package Kimnatura\Includes
 */

namespace Kimnatura\Includes;

use Kimnatura\Admin as Admin;
use Kimnatura\Admin\Menu as Menu;
use Kimnatura\Plugins\Acf as Acf;
use Kimnatura\Plugins\MultipleFeaturedImages as Mfi;
use Kimnatura\Theme as Theme;
use Kimnatura\Theme\Utils as Utils;
use Kimnatura\Admin\Woo as Woo;

use Kimnatura\Admin\Rest\LoadMore as LoadMore;
use Kimnatura\Admin\Rest\Search as Search;
use Kimnatura\Admin\Rest\Postage as Postage;
use Kimnatura\Admin\MailChimp as MailChimp;
use Subtitles as Subtitles;
use Kimnatura\Admin\b4bProductCategories_widget;
use Kimnatura\Admin\PostProducts;
/**
 * The main start class.
 *
 * This is used to define admin-specific hooks, and
 * theme-facing site hooks.
 *
 * Also maintains the unique identifier of this theme as well as the current
 * version of the theme.
 */
class Main {

  /**
   * Loader variable for hooks
   *
   * @var Loader    $loader    Maintains and registers all hooks for the plugin.
   *
   * @since 2.0.0
   */
  protected $loader;

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
   * Load hooks and define some global variables.
   *
   * @since 2.0.0
   */
  public function __construct() {

    if ( defined( 'KIM_THEME_VERSION' ) ) {
      $this->theme_version = KIM_THEME_VERSION;
    } else {
      $this->theme_version = '1.0.0';
    }

    if ( defined( 'KIM_THEME_NAME' ) ) {
      $this->theme_name = KIM_THEME_NAME;
    } else {
      $this->theme_name = 'kimnatura';
    }
    
    $this->load_dependencies();
    $this->define_admin_hooks();
    $this->define_theme_hooks();
    $this->define_woo_hooks(); 
    $this->define_blog_hooks();
    $this->define_rest();
    $this->define_metaboxes();


  }

  public function define_rest(){
    LoadMore::listen();
    Search::listen();
    Postage::listen();
  }

  public function define_metaboxes() {
    new PostProducts($this->get_theme_info() );
  }

  /**
   * Load the required dependencies.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since 2.0.0
   */
  private function load_dependencies() {
    $this->loader = new Loader();
  
  }

  /**
   * Define the locale for this theme for internationalization.
   *
   * @since 2.0.0
   */
  private function set_locale() {
    $plugin_i18n = new Internationalization( $this->get_theme_info() );

    $this->loader->add_action( 'after_setup_theme', $plugin_i18n, 'load_theme_textdomain' );
  }

  /**
   * Register all of the hooks related to the admin area functionality.
   *
   * @since 2.0.0
   */
  private function define_admin_hooks() {
    $admin       = new Admin\Admin( $this->get_theme_info() );
    $login       = new Admin\Login( $this->get_theme_info() );
    $editor      = new Admin\Editor( $this->get_theme_info() );
    $admin_menus = new Admin\Admin_Menus( $this->get_theme_info() );
    $users       = new Admin\Users( $this->get_theme_info() );
    $widgets     = new Admin\Widgets( $this->get_theme_info() );
    $menu        = new Menu\Menu( $this->get_theme_info() );
    $media       = new Admin\Media( $this->get_theme_info() );
    $mailchimp   = new Admin\MailChimp;
    $mfi         = new Mfi($this->get_theme_info());
    // Mailchimp
    $this->loader->add_action('mc4wp_form_response_position', $mailchimp,'mc4wp_form_response_position');

    // 
    $this->loader->add_action( 'widgets_init',$admin, 'b4bProductCategories_widget' );

    // Plugins
    $this->loader->add_filter('kdmfi_featured_images',$mfi,'kdmfi_featured_images');

    // Admin.
    $this->loader->add_action( 'login_enqueue_scripts', $admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles', 50 );
    $this->loader->add_filter( 'get_user_option_admin_color', $admin, 'set_admin_color_based_on_env' );
    $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );

    // Login page.
    $this->loader->add_filter( 'login_headerurl', $login, 'custom_login_url' );

    // Editor.
    $this->loader->add_action( 'admin_init', $editor, 'add_editor_styles' );

    // Sidebar.
    $this->loader->add_action( 'admin_menu', $admin_menus, 'remove_sub_menus' );

    // Users.
    $this->loader->add_action( 'set_user_role', $users, 'send_main_when_user_role_changes', 10, 2 );
    $this->loader->add_action( 'admin_init', $users, 'edit_editors_capabilities' );

    // Widgets.
    $this->loader->add_action( 'widgets_init', $widgets, 'register_widget_position' );

    // Menu.
    $this->loader->add_action( 'after_setup_theme', $menu, 'register_menu_positions' );

    // Media.
    $this->loader->add_action( 'upload_mimes', $media, 'enable_mime_types' );
    $this->loader->add_action( 'wp_prepare_attachment_for_js', $media, 'enable_svg_library_preview', 10, 3 );
    $this->loader->add_action( 'embed_oembed_html', $media, 'wrap_responsive_oembed_filter', 10, 4 );
    $this->loader->add_action( 'after_setup_theme', $media, 'add_theme_support' );
    $this->loader->add_action( 'after_setup_theme', $media, 'add_custom_image_sizes' );
    $this->loader->add_filter( 'wp_handle_upload_prefilter', $media, 'check_svg_on_media_upload' );

    //$this->loader->add_action( 'init',$admin, 'slidercategory', 0 );
    //$this->loader-> add_action( 'init', $admin,'slider', 10 );




  }

  /**
   * Register all of the hooks related to the theme area functionality.
   *
   * @since 2.0.0
   */
  private function define_theme_hooks() {
    $theme           = new Theme\Theme( $this->get_theme_info() );
    $legacy_browsers = new Theme\Legacy_Browsers( $this->get_theme_info() );
    $gallery         = new Utils\Gallery( $this->get_theme_info() );
    $general         = new Theme\General( $this->get_theme_info() );
    $pagination      = new Theme\Pagination( $this->get_theme_info() );

    // Shortcodes
    $theme->add_shortcodes();

    // Enque styles and scripts.
    $this->loader->add_action( 'wp_enqueue_scripts', $theme, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $theme, 'enqueue_scripts' );

    // Remove styles
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
    remove_filter( 'woocommerce_checkout_fields', 'woocommerce_checkout_fields_filter', 100 );

    // Remove inline gallery css.
    add_filter( 'use_default_gallery_style', '__return_false' );
    if ( class_exists( 'Subtitles' ) && method_exists( 'Subtitles', 'subtitle_styling' ) ) {
      remove_action( 'wp_head', array( Subtitles::getInstance(), 'subtitle_styling' ) );
    }
    add_filter('subtitle_view_supported', '__return_false');

    // Legacy Browsers.
    //$this->loader->add_action( 'template_redirect', $legacy_browsers, 'redirect_to_legacy_browsers_page' );

    // Customizer
    $this->loader->add_action( 'customize_register',$theme,'add_customizer');

    /**
     * Optimizations
     *
     * This will remove some default functionality, but it mostly removes unnecessary
     * meta tags from the head section.
     */
    $this->loader->remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    $this->loader->remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    $this->loader->remove_action( 'wp_print_styles', 'print_emoji_styles' );
    $this->loader->remove_action( 'admin_print_styles', 'print_emoji_styles' );
    $this->loader->remove_action( 'wp_head', 'wp_generator' );
    $this->loader->remove_action( 'wp_head', 'wlwmanifest_link' );
    $this->loader->remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    $this->loader->remove_action( 'wp_head', 'rsd_link' );
    $this->loader->remove_action( 'wp_head', 'feed_links', 2 );
    $this->loader->remove_action( 'wp_head', 'feed_links_extra', 3 );
    $this->loader->remove_action( 'wp_head', 'rest_output_link_wp_head' );

     /**
     * Optimizations for cache
     *
     * This will remove some default functionality, but it mostly removes unnecessary
     * meta tags from the head section.
     */
    //$this->loader->add_filter( 'script_loader_src', $theme,'_remove_script_version', 15, 1 );
    //$this->loader->add_filter( 'style_loader_src', $theme,'_remove_script_version', 15, 1 );

    // Gallery.
    $this->loader->add_filter( 'post_gallery', $gallery, 'wrap_post_gallery', 10, 3 );

 

    // General.
    $this->loader->add_action( 'after_setup_theme', $general, 'add_theme_support' );
    $this->loader->add_filter( 'image_size_names_choose', $general, 'wpshout_custom_sizes', 10 );

    // Pagination.
    $this->loader->add_filter( 'next_posts_link_attributes', $pagination, 'pagination_link_next_class' );
    $this->loader->add_filter( 'previous_posts_link_attributes', $pagination, 'pagination_link_prev_class' );

    $this->loader->add_action( 'wp_print_scripts',$theme, 'iconic_remove_password_strength', 10 );

    $this->loader->add_filter( 'login_redirect', $theme,'login_redirect', 10, 3 );


   
    

  }

  /**
   * Register all of the hooks related to the blog functionality.
   *
   * @since 2.0.0
   */
  private function define_blog_hooks() {
    $woo          = new Woo( $this->get_theme_info() );
    $blog         = new Admin\Blog( $this->get_theme_info() );
    //$this->loader->add_action('pre_get_posts', $blog,'inf_exclude_category');
    $this->loader->add_action('b4b_after_single_page',$woo,'woocommerce_related_products',10);
    $this->loader->add_action('b4b_after_single_page',$blog,'last_news',20);
    $this->loader->add_action('b4b_before_home_page',$woo,'woocommerce_related_products',10);
    $this->loader->add_action('b4b_after_home_page',$blog,'last_news',20);
  }
  
  /**
   * Register all of the hooks related to the theme area functionality.
   *
   * @since 2.0.0
   */
  private function define_woo_hooks() {
    $woo          = new Woo( $this->get_theme_info() );
    $blog         = new Admin\Blog( $this->get_theme_info() );
    $this->loader->add_action( 'after_setup_theme', $woo, 'add_theme_support' );
    //$this->loader->add_action( 'wp_enqueue_scripts', $woo, 'enqueue_styles' );
    //$this->loader->add_action( 'wp_enqueue_scripts', $woo, 'enqueue_scripts' );
    $this->loader->remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message',10);
    $this->loader->add_action( 'woocommerce_cart_is_empty', $woo, 'woocommerce_cart_is_empty_message',10,1);
    
    // Enque styles and scripts.
    //$this->loader->add_action( 'wp_enqueue_scripts', $theme, 'enqueue_styles' );
    //$this->loader->add_action( 'wp_enqueue_scripts', $theme, 'enqueue_scripts' );

    // Remove inline gallery css.
    //add_filter( 'use_default_gallery_style', '__return_false' );

    add_action("init", function () {
        // removing the woocommerce hook
      remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 ); 
      remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
    
      // Remove image
      remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
      //add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

      // Remove upsell i crosell
      remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
      remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

      // Single variation
      remove_action('woocommerce_single_variation','woocommerce_single_variation',10);
      remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
      
    });
    
    // Remove Checkout form
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
    add_action('woocommerce_custom_login_form', 'woocommerce_checkout_login_form', 10);
   
    $this->loader->add_action( 'woocommerce_before_single_product',$woo, 'move_variations_single_price', 1 );


    $this->loader->remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    $this->loader->remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

    // Add action Related Products
    $this->loader->add_action('woocommerce_after_main_content',$woo,'woocommerce_related_products');
    // Add all Filters
    $this->loader->add_filter('b4b_woo_checkout_step',$woo,'multi_step');
    $this->loader->add_filter("woocommerce_checkout_fields", $woo, "custom_order_fields");
    $this->loader->add_filter('woocommerce_cart_item_name',$woo,'b4b_woocommerce_cart_item_name',10,3);


    $this->loader->add_action('woocommerce_before_shop_loop_item',$woo,'woocommerce_template_loop_product_link_open',10);
    //$this->loader->add_action('woocommerce_before_shop_loop_item',$woo,'woocommerce_template_loop_product_link_open',10);
    
    // Single variation
    // woocommerce_template_single_price ako zelimo u cijenu
    $this->loader->add_action('woocommerce_single_variation',$woo,'woocommerce_single_variation',10);;
    // Remove all actions
    $this->loader->remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description',10 );
    $this->loader->remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

    
    $this->loader->add_action( 'b4b_woo_shipping_notice', $woo, 'shipping_method_notice' );

    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
    add_action( 'b4b_woocommerce_checkout_payment', 'woocommerce_checkout_payment', 20 );
    
    $this->loader->add_filter( 'woocommerce_order_button_text',$woo, 'custom_order_button_text' ); 
    // Add all actions

    

    
    $this->loader->add_action( 'woocommerce_archive_description',$woo, 'category_description_title', 10, 2  );
    $this->loader->add_action( 'woocommerce_archive_description',$woo, 'woocommerce_category_image', 20, 2  );

    $this->loader->add_action( 'woocommerce_before_shop_loop_item_title',$woo, 'catalog_item_image', 10, 2  );
    $this->loader->add_action( 'woocommerce_shop_loop_item_title',$woo, 'catalog_item_title', 10, 2  );
    $this->loader->add_action( 'woocommerce_after_shop_loop_item_title',$woo, 'catalog_item_description', 10, 2  );
    $this->loader->add_action( 'woocommerce_loop_add_to_cart_link',$woo, 'catalog_item_add_to_cart', 10, 2  );



    // Filter
    
    $this->loader->add_action('woocommerce_product_query',$woo, 'filter_product_query' );
    $this->loader->add_action('woocommerce_after_main_content',$blog,'last_news');

    // Free shipping
    $this->loader->add_filter( 'woocommerce_package_rates',$woo,'my_hide_shipping_when_free_is_available', 1 );

    $this->loader->add_filter("woocommerce_checkout_fields",$woo, "order_fields");

    //kod za dodavanje checkboxa za prihvaćanje uvjeta korištenja
    $this->loader->add_action( 'woocommerce_register_form',$woo, 'add_terms_and_conditions_to_registration', 20 );


    // Link za preuzimanje računa
    $this->loader->add_filter('woocommerce_thankyou_order_received_text', $woo,'wpo_wcpdf_thank_you_link', 10, 2);

    $this->loader->add_action( 'woocommerce_register_post',$woo, 'terms_and_conditions_validation', 20, 3 );

    $this->loader->add_filter( 'wpo_wcpdf_invoice_title',$woo, 'wpo_wcpdf_invoice_title' );
    $this->loader->add_filter( 'wpo_wcpdf_filename',$woo, 'wpo_wcpdf_custom_filename', 10, 4 );
    $this->loader->add_filter( 'woocommerce_cart_shipping_method_full_label',$woo, 'bbloomer_remove_shipping_label', 10, 2 );
    $this->loader->add_filter( "woocommerce_catalog_orderby",$woo, "my_woocommerce_catalog_orderby", 20 );
    $this->loader->add_filter( 'woocommerce_package_rates',$woo, 'my_hide_shipping_when_free_is_available', 100 );
    $this->loader->add_filter( 'woocommerce_default_address_fields',$woo, 'custom_default_address_fields', 20, 1 );


    //$this->loader->add_action( 'woocommerce_cart_collaterals',$woo, 'myprefix_cart_extra_info', 10, 3 );
    $this->loader->add_action( 'woocommerce_check_cart_items',$woo, 'check_cart_weight', 10, 3 );

    $this->loader->add_filter( 'woocommerce_available_payment_gateways',$woo, 'bbloomer_payment_gateway_disable_country', 20, 1 );
    
    
  }
 
  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since 2.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The reference to the class that orchestrates the hooks.
   *
   * @return Loader Orchestrates the hooks.
   *
   * @since 2.0.0
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * The name used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @return string Theme name.
   *
   * @since 2.0.0
   */
  public function get_theme_name() {
    return $this->theme_name;
  }

  /**
   * Retrieve the version number.
   *
   * @return string Theme version number.
   *
   * @since 2.0.0
   */
  public function get_theme_version() {
    return $this->theme_version;
  }

  /**
   * Retrieve the theme info array.
   *
   * @return array Theme info array.
   *
   * @since 2.0.0
   */
  public function get_theme_info() {
    return array(
        'theme_name'    => $this->theme_name,
        'theme_version' => $this->theme_version,
    );
  }
}
