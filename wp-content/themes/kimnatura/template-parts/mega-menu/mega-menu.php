
<div class="mega-menu" id="mega-menu-wrap">
    <!-- <div class="search__content"> -->
        <div class="mega-menu__inner mega-menu__inner--up">
			
            <div class="mega-menu__header">
    
                    <a class="mega-menu__logo-link" href="<?php echo esc_url( home_url() ); ?>" >
                        <img class="mega-menu__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo-white.svg' ); ?>"  />
                    </a>
                
                    <div class="mega-menu__btn-close" id="btn-mega-menu-close"><i class="material-icons">close</i></div>
            </div>

            <div class="mega-menu__grid">
            <?php if (ICL_LANGUAGE_CODE == 'hr') {
                $suffix = '';
            } else {
                $suffix = ' - Engleski';
            } 
    
            ?>
            
              <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="mega-menu__column">
                    <?php 
                    $mega1 = wp_get_nav_menu_items("Mega " . $i . $suffix);
                    foreach ($mega1 as $menu) {
                        if ($menu->menu_item_parent == 0) {
                            echo '<h4 class="mega-menu__column-title"><a href="' . $menu->url . '">' . strtoupper($menu->title) . '</a></h4>';
                        }
                    }
                    ?>
                    <div class="menu-mega-2-engleski-container">
                    <ul id="menu-mega-2-engleski" class="menu">
                    <?php
                    foreach ($mega1 as $menu) {
                        if ($menu->menu_item_parent != 0) {
                            echo '<li id="menu-item-'. $menu->ID . '" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-'. $menu->ID . '"><a href="' . $menu->url . '">' . ucfirst($menu->title) . '</a></li>';
                        }
                    }
                    ?>
                    </ul>
                    </div>
                    </div>
            <?php   } ?>
                </div>
            <div class="mega-menu__show-all">
                <a href="<?php echo wc_get_page_permalink( 'shop' )?>" class=" btn btn btn--white-color"><?php echo __('Pogledajte sve proizvode', 'kimnatura'); ?></a>
            </div>
				
        </div>
    <!-- </div> -->
</div><!-- /search -->






