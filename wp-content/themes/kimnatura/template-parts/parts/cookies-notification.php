<?php
/**
 * Cookies Law notification
 *
 * @package Kimnatura\Template_Parts\Parts
 */

global $inf_theme_options;
$cookies_notification = $inf_theme_options['cookies_notification_description'];

if ( ! empty( $cookies_notification ) && ! isset( $_COOKIE['cookie-law'] ) ) { // Input var okay.
?>

  <div class="cookies-notification js-cookies-notification">
    <div class="cookies-notification__wrap">
      <div class="cookies-notification__close">
         <i class="material-icons">clear</i>
      </div>
      <div class="cookies-notification__desc content-style content-style--small">
        <?php //echo wp_kses_post( $cookies_notification ); 
        get_template_part( 'template-parts/parts/gdpr-policy' );
        ?>
      </div>
      <a href="#" class="btn btn--small btn--ghost cookies-notification__btn js-cookies-notification-btn">
        <?php esc_html_e( 'I agree', 'kimnatura' ); ?>
      </a>
    </div>
  </div>

<?php
}
