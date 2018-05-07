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
<section class="single-product__section section section__spacing-top--default" id="<?php echo esc_attr( $post->ID ); ?>">
  <div class="single-product__content section__content section__content-style section__content-media-style">
    <?php the_content(); ?>
  </div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</section>
