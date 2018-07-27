<?php
/**
 * Single Post
 *
 * @package Kimnatura\Template_Parts\Single
 */




?>
<!-- Single Highlighted Content Section -->
<article class="article  section--highlighted-color" id="<?php echo esc_attr( $post->ID ); ?>">
  <div class="section section__highlighted section__spacing-top--large  section__spacing-bottom--large">
      <header class="section__header">
          <h2 class="section__title section__title--center">
            <?php the_title(); ?>
          </h2>
          <?php //the_subtitle( '<p class="section__description section__description--center">', '</p>' ); ?>
      </header>
      <div class="section__inner">
      <div class="section__content article__content-style article__content-media-style">
          <?php 
           if( has_excerpt() ){
			 the_excerpt();
		   } else {
             the_content(); 
           }
           ?>
          <a href="<?php echo  esc_url( get_permalink() )?>" rel="bookmark" class="section__link"><?php echo __('Saznaj više','kimnatura');?></a>
      </div>
      <div class="section__image">  <?php the_post_thumbnail( 'highlighted',array('class' => 'kenburns-bottom'));  ?></div>
      </div>
      <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
  </div>

</article>
