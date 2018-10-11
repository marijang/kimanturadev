<?php
/**
 * Header Serch form
 *
 * @package Kimnatura\Template_Parts\Header
 */
use Kimnatura\Admin\Menu as Menu;
use Kimnatura\Helpers\General_Helper as Helper;
$menu             = new Menu\Menu();
//$blog_name        = get_bloginfo( 'name' );
//$blog_description = get_bloginfo( 'description' );
//$header_logo_info = $blog_name . ' - ' . $blog_description;
$helper = new Helper();


$current_user      =  wp_get_current_user();
$name              =  $current_user->firstname . ' '.$current_user->lastname;
//var_dump($current_user);
if(!$current_user->firstname ){
    $name = $current_user->user_nicename;
    //user_email
}
$icons_dir =  KIM_IMAGE_URL . 'social-share/';
$array = array(
    array(
        "value" => 'Facebook',
        "link"  => 'https://www.facebook.com/pg/kimnatura.hr/',
        "image" => 'facebookb.svg'
    )
);
?>
  <div class="header__main-menu" id="menu">
<?php
    echo esc_html( $menu->bem_menu( 'header_main_nav', ' main-navigation--primary main-navigation' ) );
  ?>
    <div class="header__mobile-user-login  mobile-only">   
  <?php if(is_user_logged_in()):  ?>
    <a href="/my-account/edit-account" class="main-navigation__link is-logged-in">
            <i class="material-icons">account_circle</i>
            <span class="main-navigation__user-info"><?php echo $name;  ?></span>
            </a>
    <?php else:  ?>
    <a href="/my-account/edit-account" class="main-navigation__link is-logged-in">
    <i class="material-icons">account_circle</i>
    <span class="main-navigation__user-info">Prijava</span>
    </a>
    <?php endif  ?>
   
  
    </div>

    
  <div class="header__mobile-user-menu mobile-only">
      <!--<a href="" class="main-navigation__link header__mobile-lang">Engleski</a>-->
      
      
    <div class="header__mobile-contact">
     <div class="header__mobile-contact-phone"><a href="tel:+385993474302">+385993474302</a></div>
     <div class="header__mobile-contact-mail"><a href="mailto:info@kimnatura.hr">info@kimnatura.hr</a></div>
     <div class="footer__links footer__links--social header__mobile-contact-social">
        <ul class="social-followus__menu">
            <?php
            foreach($array as $item){
            ?>
                <li class="social-followus__item">
                    <a target="_blank" rel="noopener noreferrer" href="<?php echo $item['link']?>" class="social-followus__link">
                    <?php  get_template_part('skin/public/images/inline/inline-'.$item['image']) ?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>    
      </div>
      <div class="header__mobile-contact-copyright"> <?php echo $helper->print_copyright(); ?></div>
    </div>
 

    

</div>

  </div>

   <div class="header__user-menu">
  
  

<ul id="site-header-cart" class="main-navigation main-navigation--secondary">
    <li class="main-navigation__item">
   
       <?php   
       if (current_user_can('editor') || current_user_can('administrator') ) { 
           if (ICL_LANGUAGE_CODE == 'hr')  {?>
        <a class="header__language" data-lang="en" href="<?php echo get_site_url() . '/en/' ?>"> EN </a>
           <?php  } else { ?>
        <a class="header__language" data-lang="hr" href="<?php echo get_site_url() . '/hr/' ?>"> HR </a>
       <?php } }?> 
       
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


  </div>