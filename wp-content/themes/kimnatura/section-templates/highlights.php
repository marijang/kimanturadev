<?php
/**
 * Section Display Highlighted News
 * 
 * Class: Blog
 * Function: last_new
 *
 * @package Kimnatura
 */
global $wpdb,$post;


$args = array( 'numberposts' => 2 ,'category_name' => 'homepage');
$result = get_posts( $args ) ;
$current = 'even';
foreach($result as $post):
  setup_postdata($post);
  get_template_part( 'template-parts/single/highlighted' );
endforeach;
wp_reset_postdata();	
