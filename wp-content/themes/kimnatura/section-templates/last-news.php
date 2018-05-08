<?php
/**
 * Section Display Last news
 * Used By
 * Class: Blog
 * Function: last_new
 *
 * @package Kimnatura
 */
global $wpdb,$post;


$args = array( 'numberposts' => 2 ,'category_name' => '');
echo '<div class="section__bg">';
echo '<div class="section section__spacing-top--medium1 section__spacing-bottom--medium">';
echo '<h2 class="section__title section__title--center ">'.__('Zadnje novosti','b4b').'</h2>';
$result = get_posts( $args ) ;
$current = 'even';
foreach($result as $post):
  setup_postdata($post);
  if($current == 'even'){
get_template_part( 'template-parts/listing/articles/list' );
    $current = 'odd';
  }else{
get_template_part( 'template-parts/listing/articles/list-odd' );
    $current = 'even';
  }
endforeach;
wp_reset_postdata();	
echo '</div>';
echo '</div>';