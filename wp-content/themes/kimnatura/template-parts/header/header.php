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
<script>
	jQuery( document ).ready(function() {
		jQuery('#menu-toggle').on('click', function(){
			if(jQuery('#menu').hasClass('is-open')){
        jQuery('#menu').removeClass('is-open');
        jQuery('html').removeClass('mobile-menu-is-open');
        jQuery('#menu-toggle').parent().removeClass('is-active');
      }
      else{
        jQuery('#menu').addClass('is-open');
        jQuery('html').addClass('mobile-menu-is-open');
        jQuery('#menu-toggle').parent().addClass('is-active');
      }
	});
});
</script>
<?php get_template_part( 'template-parts/header/head/loader' ); ?>
<div class="header__container" id="page-navigation">
  <div class="header__container-inner">
  <div class="header__hamb">

    <div class='toggle'  id="menu-toggle">
  <span></span>
  <span></span>
  <span></span>
  </div>
  </div>
  <a class="header__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
    <img class="header__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo.svg' ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
  </a>
 

  <?php
    get_template_part( 'template-parts/header/menu', '' );
  ?>
  
 



</div>
</div>

