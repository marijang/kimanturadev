<?php
/**
 * List Single Post
 *
 * @package Kimnatura\Template_Parts\Listing\Articles
 */

// use Kimnatura\Theme\Utils as Utils;
// $images = new Utils\Images();
// $image  = $images->get_post_image( 'grid' );
?>
<article class="article-single">
  <div class="article-single__container">
    <div class="article-single__image">
      <a class="article-single__image-link" href="<?php the_permalink(); ?>">
        <?php  /*the_post_thumbnail( 'blog-list');*/ echo the_post_thumbnail('medium')?>
      </a>
    </div>
    <div>
    <div class="article-single__title">
      <header>
        <div class="article-single__heading">
          <?php esc_html( the_title() ); ?>
    </div>
      </header>
    </div>
    <?php if (get_post_type() == "product") : ?>
    <p class="featured-link__categories" style="margin-top: -16px;margin-bottom: 12px;"><?php 
    $product_cats = wp_get_post_terms( get_the_id(), 'product_cat' );
            $categories = "";
            for ( $i = 0; $i < sizeof($product_cats); $i++ ) {
                $categories = $categories . $product_cats[$i]->name;
                if ($i < sizeof($product_cats) - 1) {
                    $categories = $categories . ", ";
                }
            }
    echo $categories ?>   </p>
    <?php endif ?>
    <div class="article-single__description">
    <?php the_excerpt(); ?>
    </div>
    <div class="article-single__read-more">

        <a href="<?php echo  esc_url( get_permalink() )?>" rel="bookmark" class="article-single__link"><?php echo __('Saznaj više','kimnatura');?></a>
    </div>
  </div>
</div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</article>