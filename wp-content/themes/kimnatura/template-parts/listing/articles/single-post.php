<?php
/**
 * List Single Post
 *
 * @package Kimnatura\Template_Parts\Listing\Articles
 */

use Kimnatura\Theme\Utils as Utils;
$images = new Utils\Images();
$image  = $images->get_post_image( 'listing' );
?>
<article class="article-single">
  <div class="article-single__container">
    <div class="article-single__image">
      <a class="article-single__image-link" href="<?php the_permalink(); ?>">
           <?php  the_post_thumbnail( 'blog-list'); ?>
      </a>
    </div>
    <div class="article-single__title">
      <header>
        <p class="article-single__heading">
          <?php esc_html( the_title() ); ?>
        </p>
      </header>
    </div>
    <div class="article-single__description">
Lorem
    </div>
    <div class="article-single__read-more">
        <a href="<?php echo  esc_url( get_permalink() )?>" rel="bookmark" class="article-single__link"><?php echo __('Saznaj više','kimnatura');?></a>
    </div>
  </div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</article>