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
    
</section>
<?php
get_template_part( 'template-parts/single/newsletter' );
get_sidebar();
get_footer();
