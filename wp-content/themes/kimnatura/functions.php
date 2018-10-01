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
}
init_theme();















































