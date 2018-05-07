<?php
/**
 * Single page for Posts
 *
 * @package Kimnatura
 */

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
   
    get_template_part( 'template-parts/single/'.get_post_type() );
  }
}

do_action('b4b_after_single_page');
get_footer();
