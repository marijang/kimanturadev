<div class="mega-menu" id="menu-wrap">
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
            
                <div class="mega-menu__form-wrapper">
                    <form class="mega-menu__form" role="mega-menu" method="get" onsubmit="event.preventDefault()" id="mega-menu-form">
                        <input id="mega-menu-input" class="mega-menu__input" value="<?php the_search_query(); ?>" name="s" type="search" placeholder="Traži" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
                        <span class="mega-menu__info">Upišite pojam za pretraživanje</span>
                    </form>
                </div>
            </div>
				
		</div>
			<div class="mega-menu__inner mega-menu__inner--down" id='mega-menu-down'>
				<section id="mega-menu-results" class="section section__spacing-top--medium section__spacing-bottom--medium">
                </section>
            </div>
    <!-- </div> -->
</div><!-- /search -->