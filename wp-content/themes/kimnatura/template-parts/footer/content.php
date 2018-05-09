<?php
/**
 * Display footer content
 *
 * @package Kimnatura\Template_Parts\Footer
 */
use Kimnatura\Admin\Menu as Menu;
use Kimnatura\Helpers\General_Helper as Helper;
$menu             = new Menu\Menu();
$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description' );
$header_logo_info = $blog_name . ' - ' . $blog_description;
$helper = new Helper();
?>

<footer class="footer">
  <div class="footer__content">
      <div class="footer__links footer__content-media-style">
        <img class="footer__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo-white.svg' ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
        <p><?php echo get_theme_mod('footer_text'); ?>
            Smisliti kako dodati tekst ovdje
        </p>
      </div>
      <div class="footer__links">
        <?php echo esc_html( $menu->bem_menu( 'footer_main_nav', 'footer-nav' ) );?>
      </div>
      <div class="footer__links footer__links--social">
      <?php get_template_part( 'template-parts/footer/social', '' );  ?>    
      </div>
  </div>

  <div class="footer__info">
  <small>
    <?php $helper->print_copyright(); ?>
  </small>
  </div>
</footer>
