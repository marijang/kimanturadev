<?php
/**
 * Single Page
 *
 * @package Kimnatura\Template_Parts\Single
 */

use Kimnatura\Theme\Utils as Utils;
$images = new Utils\Images();
$image  = $images->get_post_image( 'full_width' );
?>
<!-- Single Content Section -->
<article class="single section section__spacing-top--default section--padding section--first" id="<?php echo esc_attr( $post->ID ); ?>">
  <div class="single__image section__image" style="background-image: url('<?php echo esc_url( $image['image'] ); ?>');">
      <?php the_post_thumbnail('full-width'); ?>
  </div>
  <header class="section__header">
    <h1 class="section__title">
      <?php the_title(); ?>
    </h1>
    <?php the_subtitle( '<p class="section__description">', '</p>' ); ?>
  </header>
  <div class="section__content">

    <?php the_content(); ?>
  </div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</article>
