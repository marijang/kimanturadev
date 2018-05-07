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

namespace Kimnatura;




//exclude_category(1);
//use Kimnatura\Includes\Loader;
//$loader = new Loader();
//$loader->add_action( 'pre_get_posts', null, 'exclude_category' );




// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * Theme version global
 *
 * @since 2.0.0
 * @package Kimnatura
 */
define( 'KIM_THEME_VERSION', '1.0.0' );

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
//require WP_CONTENT_DIR . '/../vendor/autoload.php';

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
    $plugin = new Includes\Main();
    $plugin->run();

    echo $plugin->get_theme_version();
    //$loader = $loader->get_loader();

}
// CHANGE
//init_theme();


function inf_test(){
  echo "OK";
}

inf_test();
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
