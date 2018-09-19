
<div class="search" id="search-wrap">
    <!-- <div class="search__content"> -->
        <div id="search-up" class="search__inner search__inner--up">
			
            <div class="search__header">
    
                    <a class="search__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
                        <img class="search__logo-img" src="<?php echo esc_url( KIM_IMAGE_URL . 'logo-white.svg' ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
                    </a>
                
                    <div class="search__btn-close" id="btn-search-close"><i class="material-icons">close</i></div>
  
            
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
                <div class="search__loader" >
	<!-- Loader 9 -->

<svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" enable-background="new 0 0 0 0" xml:space="preserve">
    <rect x="20" y="20" width="4" height="10" fill="#000" transform="translate(0 15.5206)">
      <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0" begin="0" dur="0.6s" repeatCount="indefinite"></animateTransform>
    </rect>
    <rect x="30" y="20" width="4" height="10" fill="#000" transform="translate(0 2.18727)">
      <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0" begin="0.2s" dur="0.6s" repeatCount="indefinite"></animateTransform>
    </rect>
    <rect x="40" y="20" width="4" height="10" fill="#000" transform="translate(0 11.1461)">
      <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0" begin="0.4s" dur="0.6s" repeatCount="indefinite"></animateTransform>
    </rect>
</svg>
<p>Pretraga u tijeku<br>Molimo pričekajte</p>
</div>
				    <section id="search-results" class="">
                    </section>
                </div>
            </div>
    <!-- </div> -->
</div><!-- /search -->