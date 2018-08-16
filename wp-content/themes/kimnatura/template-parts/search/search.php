
<div class="search" id="search-wrap">
    <!-- <div class="search__content"> -->
        <div id="search-up" class="search__inner search__inner--up">
			
            <div class="search__header">
    
                    <a class="search__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
                        <img class="search__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo-white.svg' ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
                    </a>
                
                    <div class="search__btn-close" id="btn-search-close"><i class="material-icons">close</i></div>
                        <!-- <button id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
                            <svg class="icon icon--cross"><use xlink:href="#icon-cross"></use></svg>
                        </button> -->
            
                <div class="search__form-wrapper">
                    <form class="search__form" role="search" method="get" onsubmit="event.preventDefault()" id="search-form">
                        <input id="search-input" class="search__input" value="<?php the_search_query(); ?>" name="s" type="search" placeholder="Traži" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
                        <span class="search__info">Upišite pojam za pretraživanje</span>
                    </form>
                </div>
            </div>
				
		</div>
			<div class="search__inner search__inner--down" id='search-down'>
                <div class="section section__spacing-top--medium section__spacing-bottom--medium">
				    <section id="search-results" class="">
                    </section>
                </div>
            </div>
    <!-- </div> -->
</div><!-- /search -->