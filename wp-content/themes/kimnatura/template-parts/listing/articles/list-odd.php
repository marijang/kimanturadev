<?php
/**
 * List Simple Article
 *
 * @package Kimnatura\Template_Parts\Listing\Articles
 */

use Kimnatura\Theme\Utils as Utils;
$images = new Utils\Images();
$image  = $images->get_post_image( 'listing' );
?>
<article class="article-list">
  <div class="article-list__container">

    <div class="article-list__content">
      <header>
        <h2 class="article-list__heading">
          <a class="article-list__heading-link" href="<?php the_permalink(); ?>">
          <?php esc_html( the_title() ); ?>
          </a>
        </h2>
      </header>
      <div class="article-list__excerpt">
        <?php the_excerpt(); ?>
      </div>
      <a href="<?php echo  esc_url( get_permalink() )?>" rel="bookmark" class="article-list__link">Saznaj više</a>
    </div>
    <div class="article-list__image">
      <a class="article-list__image-link" href="<?php the_permalink(); ?>">
           <?php  the_post_thumbnail( 'listing'); ?>
      </a>
    </div>
  </div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</article>
