<?php
/**
 * Display regular index/home page
 *
 * @package Kimnatura
 */

get_header();
?>

<section class="section">
        <header class="section__header">
	        <h1 class="section__title">Novosti</h1>
	        <p class="section__description" style="display:none;" >Naše novosti</p>
	    </header><!-- .entry-header -->
      <?php
if ( have_posts() ) {
  $current = 'even';
  while ( have_posts() ) {
    the_post();
    if ($current=='even'){
      get_template_part( 'template-parts/listing/articles/list' );
      $current = 'odd';
    }else{
      get_template_part( 'template-parts/listing/articles/list-odd' );
      $current = 'even';
    }  
  }

  the_posts_pagination();

} else {

  get_template_part( 'template-parts/listing/articles/empty' );

};
?>
</section>
<?php
do_action('b4b_after_single_page');
get_footer();
