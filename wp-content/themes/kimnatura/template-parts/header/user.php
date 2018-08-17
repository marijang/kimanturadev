<?php
/**
 * Header Serch form
 *
 * @package Kimnatura\Template_Parts\Header
 */


$current_user      =  wp_get_current_user();
$name              =  $current_user->firstname . ' '.$current_user->lastname;
//var_dump($current_user);
if(!$current_user->firstname ){
    $name = $current_user->user_nicename;
    //user_email
}

?>

<ul id="site-header-cart" class="main-navigation main-navigation--secondary">
    <li class="main-navigation__item desktop-only">
       <!-- <a href="" class="main-navigation__link">EN</a> -->
    </li>
    <li class="main-navigation__item" id="eng">
        <a href="#" id="btn-search" class="main-navigation__link">
            <i class="material-icons mi">search</i>
        </a>
    </li>
    <li class="main-navigation__item desktop-only">
    <?php if(is_user_logged_in()):  ?>
    <a href="/my-account/edit-account" class="main-navigation__link is-logged-in">
            <i class="material-icons">account_circle</i>
            <span class="main-navigation__user-info"><?php echo $name;  ?></span>
            </a>
    <?php else:  ?>
    <a href="/my-account/edit-account" class="main-navigation__link">
    <i class="material-icons">account_circle</i>
    </a>
    <?php endif  ?>
        
    </li>
    <li class="main-navigation__item">
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" id="cart" title="Cart" class="main-navigation__cart main-navigation__link">
		<i class="material-icons mi">shopping_cart</i>
		<span class="main-navigation__badge"><?php echo WC()->cart->get_cart_contents_count();?></span> 
        </a>
    </li>
</ul>