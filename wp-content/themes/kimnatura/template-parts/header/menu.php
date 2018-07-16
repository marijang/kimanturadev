<?php
/**
 * Header Serch form
 *
 * @package Kimnatura\Template_Parts\Header
 */
use Kimnatura\Admin\Menu as Menu;
$menu             = new Menu\Menu();
$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description' );
$header_logo_info = $blog_name . ' - ' . $blog_description;


$current_user      =  wp_get_current_user();
$name              =  $current_user->firstname . ' '.$current_user->lastname;
//var_dump($current_user);
if(!$current_user->firstname ){
    $name = $current_user->user_nicename;
    //user_email
}

?>

<?php
    echo esc_html( $menu->bem_menu( 'header_main_nav', ' main-navigation--primary main-navigation' ) );
  ?>
  <div class="header__mobile-user-menu mobile-only">
      <!--<a href="" class="main-navigation__link header__mobile-lang">Engleski</a>-->
  <?php if(is_user_logged_in()):  ?>
    <a href="/my-account/edit-account" class="main-navigation__link is-logged-in">
            <i class="material-icons">account_circle</i>
            <span class="main-navigation__user-info"><?php echo $name;  ?></span>
            </a>
    <?php else:  ?>
    <a href="/my-account" class="main-navigation__link is-logged-in">
    <i class="material-icons">account_circle</i>
    <span class="main-navigation__user-info">Log in / Sign up</span>
    </a>
    <?php endif  ?>
</div>