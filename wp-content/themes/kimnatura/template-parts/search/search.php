<div class="search">
    <!-- <div class="search__content"> -->
        <div id="search-nav" class="search__inner search__inner--up">
			
            <div class="header__container search__header" id="page-navigation">
                <div class="header__container-inner">
    
                    <a class="header__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
                        <img class="header__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo-white.svg' ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
                    </a>
                
                    <div class="search__btn-close" id="btn-search-close"><i class="material-icons">close</i></div>
                        <!-- <button id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
                            <svg class="icon icon--cross"><use xlink:href="#icon-cross"></use></svg>
                        </button> -->
                </div>
            </div>
            <div class="search__form-wrapper">
				<form class="search__form" role="search" method="get" onsubmit="event.preventDefault()" id="search-form">
					<input class="search__input" value="<?php the_search_query(); ?>" name="s" type="search" placeholder="Traži" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
					<span class="search__info">Upišite pojam za pretraživanje</span>
                </form>
            </div>
				
		</div>
			<div class="search__inner search__inner--down">
				<section class="section section__spacing-top--medium">
                    <header class="section__header">
	                    <h1 id="search-title" class="section__title">Zadnje s našeg bloga</h1>
	                </header><!-- .entry-header -->
                    <div id="search-results" class="search__related">
                         
                            
                        
                        <!-- <div class="search__suggestion">
						    <h3>Needle, Where Art Thou?</h3>
						    <p>#broken #lost #good #red #funny #hilarious #catgif #blue #nono #why #yes #yesyes #aliens #green #drone</p>
                        </div> -->
                    </div>
				</div>
            </div>
    <!-- </div> -->
</div><!-- /search -->