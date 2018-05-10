<?php
/**
 * The template for displaying all pages
 * Template Name: Contact
 *
 * This is the template that displays Contact by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package b4b
 */

get_header();
?>
<section class="section section--wide section--background">
   <div class="section__container">
        <header class="section__header">
                <?php the_title( '<h1 class="section__title">', '</h1>' ); ?>
                <?php the_subtitle( '<h4 class="section__description">', '</h4>' ); ?>
        </header><!-- .entry-header -->
  
    <div class="section__content">
       <?php the_post(); the_content(); ?>
    </div>
    <div id="newsletter" class="modal">
        <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
        </div>
        <button data-target="modal1" class="btn btn--primary modal-trigger">Modal</button>
        <?php
        echo do_shortcode('[mc4wp_form id="4266"]');
        ?>
    </div>
</section>
<?php
get_sidebar();
get_footer();
