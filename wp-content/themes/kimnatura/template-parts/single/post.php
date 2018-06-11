<?php
/**
 * Single Post
 *
 * @package Kimnatura\Template_Parts\Single
 */


use Kimnatura\Theme\Utils as Utils;
$images = new Utils\Images();
$image  = $images->get_post_image( 'full_width' );

?>


<!-- Single Content Section -->
<article class="single section section__spacing-top--default section--padding section--first section__spacing-bottom--medium" id="<?php echo esc_attr( $post->ID ); ?>">
<header class="section__header">
    <h1 class="section__title">
      <?php the_title(); ?>
    </h1>
    <?php the_subtitle( '<p class="section__description">', '</p>' ); ?>
  </header>
  <div class="single__image section__image" style="background-image: url('<?php echo esc_url( $image['image'] ); ?>');">
     
  </div>

  <div class="section__content content-about-us-style">
    <?php //require locate_template( 'template-parts/parts/addthis.php' ); ?>
    <div class="section__content-share">
        <?php the_content(); ?>
    </div>
  </div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</article>

