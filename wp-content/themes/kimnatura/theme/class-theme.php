<?php
/**
 * The Theme specific functionality.
 *
 * @since   2.0.0
 * @package Kimnatura\Theme
 */

namespace Kimnatura\Theme;




use Kimnatura\Helpers as General_Helpers;
//use Kimnatura\Shortcodes\Gmap as Gmap;


/**
 * Class Theme
 */
class Theme {

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
   * Register the Stylesheets for the theme area.
   *
   * @since 2.0.0
   */
  public function enqueue_styles() {

    $main_style_vendors = '/skin/public/styles/vendors.css';
    wp_register_style( $this->theme_name . '-style-vendors', get_template_directory_uri() . $main_style_vendors, array(), $this->general_helper->get_assets_version( $main_style_vendors ) );
    //wp_enqueue_style( $this->theme_name . '-style-vendors' );

    $main_style = '/skin/public/styles/application.css';
    wp_register_style( $this->theme_name . '-style', get_template_directory_uri() . $main_style, array(), $this->general_helper->get_assets_version( $main_style ) );
    wp_enqueue_style( $this->theme_name . '-style' );

  }

  /**
   * Register the JavaScript for the theme area.
   *
   * First jQuery that is loaded by default by WordPress will be deregistered and then
   * 'enqueued' with empty string. This is done to avoid multiple jQuery loading, since
   * one is bundled with webpack and exposed to the global window.
   *
   * @since 2.0.0
   */
  public function enqueue_scripts() {
    // jQuery.
    wp_deregister_script( 'jquery-migrate' );
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/skin/public/scripts/vendors/jquery.3.3.1.min.js', array(), '3.3.1');
    wp_enqueue_script( 'jquery' );

    // JS.
    if ( ! is_page_template( 'page-templates/page-old-browser.php' ) ) {
      wp_register_script( $this->theme_name . '-webfont', get_template_directory_uri() . '/skin/public/scripts/vendors/webfont.1.6.26.min.js', array(), '1.6.26');
      wp_enqueue_script( $this->theme_name . '-webfont' ); // Fonts loaded via JS fonts.js.

      $main_script_vandors = '/skin/public/scripts/vendors.js';
      wp_register_script( $this->theme_name . '-scripts-vendors', get_template_directory_uri() . $main_script_vandors, array(), $this->general_helper->get_assets_version( $main_script_vandors ) );
      wp_enqueue_script( $this->theme_name . '-scripts-vendors' );

      $main_script_vandors = '/skin/public/scripts/vendors/anime.min.js';
      wp_register_script( $this->theme_name . 'anime-scripts-vendors', get_template_directory_uri() . $main_script_vandors, array(), $this->general_helper->get_assets_version( $main_script_vandors ));
      wp_enqueue_script( $this->theme_name . 'anime-scripts-vendors' );

      $main_script_vandors = '/skin/public/scripts/vendors/materialize.min.js';
    
      wp_register_script( $this->theme_name . 'materialize-scripts-vendors', get_template_directory_uri() . $main_script_vandors, array(), $this->general_helper->get_assets_version( $main_script_vandors ) );
      wp_enqueue_script( $this->theme_name . 'materialize-scripts-vendors');
    

      $main_script = '/skin/public/scripts/application.js';
      wp_register_script( $this->theme_name . '-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ));
      wp_enqueue_script( $this->theme_name . '-scripts');


      //wp_register_script( $this->theme_name . '-old-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ) );
      //wp_enqueue_script( $this->theme_name . '-old-scripts' );
      // If using WPML.
      $ajax_url = '';
      if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
        $ajax_url .= admin_url( 'admin-ajax.php?lang=' . ICL_LANGUAGE_CODE );
      } else {
        $ajax_url .= admin_url( 'admin-ajax.php' );
      }

      // Glbal variables for ajax and translations.
      wp_localize_script(
        $this->theme_name . '-scripts', 'themeLocalization', array(
            'ajaxurl' => $ajax_url,
        )
      );
    }
  }


  
  /**
   * Register the JavaScript for the theme area.
   *
   * FAnother thing we recommend is to remove query strings from your static resources. 
   * Resources with a “?” in the URL are not cached by some proxy caching servers or CDNS, 
   * which could result in a large missed opportunity for increased speeds. 
   * One way to do this would be to add the following to your functions.php file.
   *
   * @since 2.0.0
   */
  function _remove_script_version( $src ){
    $parts = explode( '?ver', $src );
    return $parts[0];
  }

  
  function add_shortcodes(){
    $contactmap = new Shortcodes\Gmap();
    add_shortcode( 'b4b-map', array($contactmap,'shortcode') );
  }


  function add_customizer( $wp_customize ) {
    //All our sections, settings, and controls will be added here
    $wp_customize->add_section( $this->theme_name.'_mailchimp', 
        array(
          'title'       => __( 'MailChimp', 'b4b' ), //Visible title of section
          'priority'    => 35, //Determines what order this appears in
          'capability'  => 'edit_theme_options', //Capability needed to tweak
          'description' => __('Allows you to customize Mailchimp settings for '.$this->theme_name, 'b4b'), //Descriptive tooltip
        ) 
    );

    $wp_customize->add_section( $this->theme_name.'_options', 
        array(
          'title'       => __( 'Options', 'kimnatura' ), //Visible title of section
          'priority'    => 35, //Determines what order this appears in
          'capability'  => 'edit_theme_options', //Capability needed to tweak
          'description' => __('Customizacija theme '.$this->theme_name, 'kimnatura'), //Descriptive tooltip
        ) 
    );
    //2. Register new settings to the WP database...
    $wp_customize->add_setting( 'mailchimp_newsletter_code', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
          'default'    => '0000', //Default setting/value to save
          'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
          'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
          'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        ) 
    );  
    $wp_customize->add_setting( 'footer_text', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
          'default'    => 'Test', //Default setting/value to save
          'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
          'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
          'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        ) 
    );  
    $wp_customize->add_setting( 'copyright_text', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
      array(
      'default'    => 'Test', //Default setting/value to save
      'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
      'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
      'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
      ) 
    ); 

    $wp_customize->add_setting( 'addthis_code', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
      'default'    => 'ra-5b0d243850ceafe8', //Default setting/value to save
      'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
      'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
      'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    ) 
    );  

    $wp_customize->add_control(
      new \WP_Customize_Control(
        $wp_customize,
        'options_addthis_control',
        array(
          'label'    => __( 'AddThis Code', 'kimnatura' ),
          'section'  => $this->theme_name.'_options',
          'settings' => 'addthis_code',
          'type'     => 'text',
        )
      )
    );
    $wp_customize->add_control(
      new \WP_Customize_Control(
        $wp_customize,
        'options_footertext_control',
        array(
          'label'    => __( 'Footer Text', 'kimnatura' ),
          'section'  => $this->theme_name.'_options',
          'settings' => 'footer_text',
          'type'     => 'textarea',
        )
        
      )
    );

    $wp_customize->add_control(
      new \WP_Customize_Control(
        $wp_customize,
        'mailchimp_newsletter_control',
        array(
          'label'    => __( 'Mailchimp Code', 'b4b' ),
          'section'  => $this->theme_name.'_mailchimp',
          'settings' => 'mailchimp_newsletter_code',
          'type'     => 'text',
          'choices'  => array(
            'left'  => 'left',
            'right' => 'right',
          ),
        )
      )
    );

  }


  /**
   * Remove password strength check.
   */
  public function iconic_remove_password_strength() {
    wp_dequeue_script( 'wc-password-strength-meter' );
  }


  public function login_redirect( $url, $query, $user ) {
    return home_url();
  }

}
