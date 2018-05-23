<div class="search">
			<button id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
                <svg class="icon icon--cross"><use xlink:href="#icon-cross"></use></svg>
            </button>
			<div class="search__inner search__inner--up">
				<form class="search__form" role="search" method="get" action="<?php echo home_url( '/' ) ?>">
					<input class="search__input" value="<?php the_search_query(); ?>" name="s" type="search" placeholder="Search" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
					<span class="search__info">Hit enter to search or ESC to close</span>
				</form>
				
			</div>
			<div class="search__inner search__inner--down">
				<div class="search__related">
					<div class="search__suggestion">
						<h3>May We Suggest?</h3>
						<p>#drone #funny #catgif #broken #lost #hilarious #good #red #blue #nono #why #yes #yesyes #aliens #green</p>
					</div>
					<div class="search__suggestion">
						<h3>Needle, Where Art Thou?</h3>
						<p>#broken #lost #good #red #funny #hilarious #catgif #blue #nono #why #yes #yesyes #aliens #green #drone</p>
					</div>
				</div>
			</div>
        </div><!-- /search -->