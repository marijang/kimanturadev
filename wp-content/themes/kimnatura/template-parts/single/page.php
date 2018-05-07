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
<article class="single section section__spacing-top--default" id="<?php echo esc_attr( $post->ID ); ?>">
  <div class="single__image" style="background-image: url('<?php echo esc_url( $image['image'] ); ?>');"></div>
  <header class="section__header">
    <h1 class="section__title">
      <?php the_title(); ?>
    </h1>
    <?php the_subtitle( '<p class="section__description">', '</p>' ); ?>
  </header>
  <div class="section__content section__content-style section__content-media-style">
    <?php the_content(); ?>
  </div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</article>
