
<div class="mega-menu" id="mega-menu-wrap">
    <!-- <div class="search__content"> -->
        <div class="mega-menu__inner mega-menu__inner--up">
			
            <div class="mega-menu__header">
    
                    <a class="mega-menu__logo-link" href="<?php echo esc_url( home_url() ); ?>" >
                        <img class="mega-menu__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo-white.svg' ); ?>"  />
                    </a>
                
                    <div class="mega-menu__btn-close" id="btn-mega-menu-close"><i class="material-icons">close</i></div>
                        <!-- <button id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
                            <svg class="icon icon--cross"><use xlink:href="#icon-cross"></use></svg>
                        </button> -->
            </div>

            <div class="mega-menu__grid"><?php dynamic_sidebar('mega-menu'); ?></div>
            <div class="mega-menu__show-all">
                <a href="<?php echo wc_get_page_permalink( 'shop' )?>" class=" btn btn btn--white-color">Pogledajte sve proizvode</a>
            </div>
				
        </div>
    <!-- </div> -->
</div><!-- /search -->
