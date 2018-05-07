<?php
/**
 * Main header bar
 *
 * @package Kimnatura\Template_Parts\Header
 */

use Kimnatura\Admin\Menu as Menu;
$menu             = new Menu\Menu();
$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description' );
$header_logo_info = $blog_name . ' - ' . $blog_description;
?>

<progress class="reading__progress js-progress" value="0" max="1"></progress>

<div class="header__container" id="page-navigation">
  <div class="header__container-inner">
  <a class="header__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
    <img class="header__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo.svg' ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
  </a>
 
  <div class="header__main-menu">
  <?php
    echo esc_html( $menu->bem_menu( 'header_main_nav', ' main-navigation--primary main-navigation' ) );
  ?>
  </div>
  <div class="header__user-menu">
    <?php
    get_template_part( 'template-parts/header/user', '' );
  ?>
  </div>
</div>
</div>
<i class="material-icons">menu</i>
