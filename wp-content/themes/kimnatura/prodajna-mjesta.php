<?php
/**
 * The template for displaying all pages
 * Template Name: Prodajna mjesta - template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kimnaturaV1
 */

get_header();
?>
    <section class="section">
        <header class="section__header">
	        <?php the_title( '<h1 class="section__title">', '</h1>' ); ?>
	        <?php the_subtitle( '<p class="section__description">', '</p>' ); ?>
	    </header><!-- .entry-header -->

        <div class="grid2">
            <figure class="grid2__item fig-item">
                <img alt="picture" src="<?php echo esc_url( KIM_IMAGE_URL . 'prod-baska.png' ); ?>" class="fig-item__img">
                <figcaption class="fig-item__caption grid2__caption">
                    <h5 class="grid2__title">Minerva obrt za trgovinu</h5>
                    <div class="grid2__icon-row">
                        <i class="material-icons mi grid2__icon">place</i>
                        <p class="grid2__icon-text">Baška Voda, Trg dr fra Jure Radića 4, 21320 Baška Voda</p>
                    </div>
                    <div class="grid2__icon-row">
                        <i class="material-icons grid2__icon">phone</i>
                        <p class="grid2__icon-text">0981997960</p>
                    </div>
                    <div class="grid2__icon-row">
                        <i class="material-icons grid2__icon">email</i>
                        <p class="grid2__icon-text">kim.natura@gmail.com</p>
                    </div>               
                </figcaption>
            </figure>
            <!-- <figure class="grid2__item fig-item">
                <img src="" alt="picture" class="fig-item__img">
                <figcaption class="fig-item__caption grid2__caption">
                    <h5 class="grid2__title">Kim Natura poslovnica 1</h5>
                    <div class="grid2__icon-row">
                        <i class="material-icons grid2__icon">place</i>
                        <p class="grid2__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                    </div>
                    <div class="grid2__icon-row">
                        <i class="material-icons grid2__icon">phone</i>
                        <p class="grid2__icon-text">0981997960</p>
                    </div>
                    <div class="grid2__icon-row">
                        <i class="material-icons grid2__icon">email</i>
                        <p class="grid2__icon-text">kim.natura@gmail.com</p>
                    </div>
                </figcaption>
            </figure>
            <figure class="grid2__item fig-item">
                <img src="" alt="picture" class="fig-item__img">
                <figcaption class="fig-item__caption grid2__caption">
                    <h5 class="grid2__title">Kim Natura poslovnica 1</h5>
                    <div class="grid2__icon-row">
                        <i class="material-icons grid2__icon">place</i>
                        <p class="grid2__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                    </div>
                    <div class="grid2__icon-row">
                        <i class="material-icons grid2__icon">phone</i>
                        <p class="grid2__icon-text">0981997960</p>
                    </div>
                    <div class="grid2__icon-row">
                        <i class="material-icons grid2__icon">email</i>
                        <p class="grid2__icon-text">kim.natura@gmail.com</p>
                    </div>
                </figcaption>
            </figure> -->
            

        </div>

        <h1 class="section__title section__header">Ostala prodajna mjesta</h1>
        <div class="grid3">
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Patrik obrt za trgovinu</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Kandlerova 42, 52100 Pula</p>
                </div>
            </div>
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Valsimot d.o.o</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Petra Krešimira IV bb, 53291 Novalja</p>
                </div>
            </div>
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">T.O. Omega</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Eufrazijeva 15, 52440 Poreč</p>
                </div>
            </div>
            <!-- <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Suvenirnica jedan</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                </div>
            </div>
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Suvenirnica jedan</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                </div>
            </div>
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Suvenirnica jedan</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                </div>
            </div>
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Suvenirnica jedan</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                </div>
            </div>
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Suvenirnica jedan</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                </div>
            </div>
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Suvenirnica jedan</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                </div>
            </div>
            <div class="grid3__item">
                <h2 class="grid3__item-title" style="font-weight: 500">Suvenirnica jedan</h2>
                <div class="grid3__icon-row">
                    <i class="material-icons grid3__icon">place</i>
                    <p class="grid3__icon-text">Lug Samoborski, Kneza Trpimira 15, Samobor</p>
                </div>
            </div> -->
        </div>
    </section>

<?php
get_sidebar();
get_footer();