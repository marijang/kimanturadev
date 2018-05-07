<?php
/**
 * Theme Name: kimnatura
 * Description: kimnatura
 * Author: marijan <marijan>
 * Author URI:
 * Version: 1.0
 * Text Domain: kimnatura
 *
 * @package Kimnatura
 */

namespace Kimnatura;


inf_test();
/* Exclude some categories */
add_action( 'pre_get_posts', 'test',10 );

function test( $query ) {
  $slugs = array('slider','homepage','sastojci');
  foreach($slugs as $slug){
      $cat = get_category_by_slug($slug); 
      if ($cat instanceof WP_TERM){
          $catIDs[] = $cat->term_id;
      }
      
  }  
  if ( $query->is_home() && $query->is_main_query() ) {
      foreach($catIDs as $cat){
          $query->set( 'cat', '-'.$cat );
      }
      
  }
}
