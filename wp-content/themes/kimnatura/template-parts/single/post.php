<?php
/**
 * Single Post
 *
 * @package Kimnatura\Template_Parts\Single
 */


use Kimnatura\Theme\Utils as Utils;
$images = new Utils\Images();
$image  = $images->get_post_image( 'post_full_width' );


// Check if set featured image 2
if (kdmfi_has_featured_image('featured-image-2')){
    $image['image'] = kdmfi_get_featured_image_src( 'featured-image-2', 'full_width' );
}



?>


<!-- Single Content Section -->


<article  class="single section section__spacing-top--default1 section--padding section--first section__spacing-bottom--medium" id="<?php echo esc_attr( $post->ID ); ?>">
<?php if (!in_category('slider-hero') || wp_is_mobile()) : ?>
<header class="section__header">
    <h1 class="section__title">
      <?php the_title(); ?>
    </h1>
    <?php the_subtitle( '<p class="section__description">', '</p>' );?>
  </header>
<?php endif ?>

 
  
  <?php if (isset($image['image'])){ ?>
<div class="single__image section__image <?php echo in_category('slider-hero') ? 'single__image--hero' : '' ?>" style="background-image: url('<?php echo esc_url( $image['image'] ); ?>'); ">
<?php if (in_category('slider-hero') && !wp_is_mobile()) : ?>
<article  class="single section section__spacing-top--default section--padding section--first section__spacing-bottom--medium" id="<?php echo esc_attr( $post->ID ); ?>">
<header class="section__header">
    <h1 class="section__title">
      <?php the_title(); ?>
    </h1>
    <?php the_subtitle( '<p class="section__description">', '</p>' );?>
  </header>
<?php endif ?>
  </div>
<?php }?>

  <div class="section__content content-about-us-style1 section__content--has-share">
    <div class="section__share-add-wrap">
        <?php require locate_template( 'template-parts/parts/addthis.php' ); ?>
    </div>
    <div class="section__content-share content-style">
        <?php the_content(); ?>
    </div>
  </div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
  <?php if (in_category('slider-hero')) : ?>
      <section class="two-column-grid">
        <?php 
        $prods = get_post_meta( get_the_ID() , 'post_products', true );
        if ($prods != null ) {
        $args = array(
          'post_type' => 'product',
          'post__in'      => $prods,
					'posts_per_page' => -1
       );
       // The Query
       $the_query = new WP_Query( $args );
       if ($the_query->have_posts()) {
        $posts = $the_query->posts;
        foreach ($posts as $post) {
          get_template_part( 'template-parts/listing/articles/single-post' );
        }
      }
      wp_reset_query();
    }
         ?>        
      </section>
  <?php endif ?>
</article>
