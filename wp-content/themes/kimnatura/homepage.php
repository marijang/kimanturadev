<?php
/**
 * The template for displaying all pages
 * Template Name: Homepage
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


		<?php



get_template_part( 'section-templates/slider-hero' );
do_action('b4b_before_home_page');
get_template_part( 'section-templates/highlights' );

do_action('b4b_after_home_page');
get_template_part( 'section-templates/sastojci-hero' );
get_template_part( 'template-parts/single/newsletter' );
//get_sidebar();
get_footer();
