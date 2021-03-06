<?php
/**
 * Account section
 *
 * @package Kimnatura\Template_Parts\Account
 */



$cart_total = WC()->cart->get_displayed_subtotal();
?>



<?php if (!(!is_user_logged_in() && wp_is_mobile())) {  
if (is_user_logged_in() || (!is_user_logged_in() && strpos(home_url( $wp->request ), 'my-account') === false && strpos(home_url( $wp->request ), 'cart') === false)) : ?>
<div class="navigation-user">
        <div class="navigation-user__wrap">
	    <?php
		if ( is_user_logged_in() ) {
			$current_user = wp_get_current_user();
        ?>
				<nav id="settings-menu" class="account__navigation-user navigation-user__account-menu">
					<ul class="navigation-user__menu">
						<?php 
						$endpoints = wc_get_account_menu_items();
					    // Sort 
						ksort($endpoints);
						// Remove dashboard
						unset($endpoints['dashboard']);
						//foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
						<?php
							$is_current_item = '';
							//var_dump(wc_get_account_menu_item_classes( $endpoint ));
							/*if(array_search('current-menu-item', $endpoint->classes) != 0)
							{
								$is_current_item = ' is-active"';
							}*/
							if (is_wc_endpoint_url( 'view-order' )){
							}
							if (is_wc_endpoint_url( 'edit-account' )){
							}
							
							if (is_wc_endpoint_url( 'edit-address' )){
							}							
							//$endpoints = array('edit-account', 'edit-address','view-order' )
						?>
						<?php foreach ( $endpoints as $endpoint => $label ) : 
								$is_current_item = '';
								$classes = explode(' ',wc_get_account_menu_item_classes( $endpoint ));
								//var_dump(wc_get_account_menu_item_classes( $endpoint ));
								if(array_search('is-active', $classes) != 0)
								{
									$is_current_item = ' is-active"';
								}
							
							?>
							<li class=" navigation-user__menu-item">
								<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="navigation-user__menu-link <?php echo $is_current_item ?>">
									<?php echo esc_html( $label ); ?>
							    </a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
				
		<div class="navigation-user__info">
		   <span class="navigation-user__info-name"> <?php echo $current_user->user_email?></span>
		</div>
		<div class="navigation-user__logout" id="settings-logout">
		   <a href="<?php echo 	esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="navigation-user__info-link" ><?php echo __('Odjavite se','b4b') ?></a>
		</div>
		<div class="navigation-user__settings" id="settings-toggle"><i class="material-icons">settings</i></div>
		<?php
		} else { ?>
			<div class="navigation-user__login">
				
                 <?php do_action('woocommerce_custom_login_form'); ?>
            
			</div>
		<?php
		
		}
	
		?>
		</div>
		</div>
	<?php endif;
	}?>