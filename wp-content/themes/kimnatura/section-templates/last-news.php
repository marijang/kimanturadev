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


$args = array( 'numberposts' => 2 ,'category_name' => 'blog');
echo '<div class="section__bg" id="latest_news">';
echo '<div class="section section__spacing-top--medium section__spacing-bottom--medium">';
?>
<?php if (is_front_page()) :?>
<header class="section__header">
<h3 class="section__title section__title--center"><?php echo __('Zadnje novosti','b4b');?></h3>
</header>
<?php else :?>
<header class="section__header">
<h3 class="section__title section--title-center"><?php echo __('Zadnje novosti','b4b');?></h3>
</header>
<?php endif;?>
<?php
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