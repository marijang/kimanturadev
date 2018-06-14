
<div class="mega-menu" id="mega-menu-wrap">
    <!-- <div class="search__content"> -->
        <div class="mega-menu__inner mega-menu__inner--up">
			
            <div class="mega-menu__header">
    
                    <a class="mega-menu__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
                        <img class="mega-menu__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo-white.svg' ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
                    </a>
                
                    <div class="mega-menu__btn-close" id="btn-mega-menu-close"><i class="material-icons">close</i></div>
                        <!-- <button id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
                            <svg class="icon icon--cross"><use xlink:href="#icon-cross"></use></svg>
                        </button> -->
            </div>

            <div class="mega-menu__grid"><?php dynamic_sidebar('mega-menu'); ?></div>
            <div class="mega-menu__show-all">
                <a href="/shop" class=" btn btn btn--ghost">Vidi sve proizvode</a>
            </div>
				
        </div>
    <!-- </div> -->
</div><!-- /search -->
