<?php
/**
 * Single Post
 *
 * @package Kimnatura\Template_Parts\Single
 */




?>

<!-- Single Content Section -->
<div class="section__container">
<article class="article section section__spacing-top--default section--first" id="<?php echo esc_attr( $post->ID ); ?>">
  <div class="article__container">
      <header class="article__header">
          <h2 class="article__title">
            <?php the_title(); ?>
          </h2>
          <?php the_subtitle( '<p class="article__description">', '</p>' ); ?>
      </header>
      <div class="article__image">  <?php the_post_thumbnail( 'full-width',array('class' => 'kenburns-bottom'));  ?></div>
      <div class="article__content article__content-style article__content-media-style">
          <?php the_content(); ?>
      </div>
      <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
  </div>

</article>
</div>
