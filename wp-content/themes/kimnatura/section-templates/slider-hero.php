<?php
/**
 * Section Display Highlighted News
 * 
 * Class: Blog
 * Function: last_new
 *
 * @package Kimnatura
 */
global $wpdb,$post;


$args = array( 'numberposts' => 10 ,'category_name' => '	slider-hero');
$result = get_posts( $args ) ;
?>
<div class="hero__slider-wrapper section">
<div class="  hero-slider-slick slick-slider">
<?php
foreach($result as $post):
  setup_postdata($post);
?>

    <div class="hero__item">
        <div class="hero__content">
            <h2 class="hero__title"><?php the_title(); ?></h2>
            <?php the_subtitle( '<div class="hero__description"><i>', '</i></div>' ); ?>
            <?php 
                if( has_excerpt() ){
                    the_excerpt();
                } else {
                    the_content(); 
                }
            ?>
            <a href="<?php echo  esc_url( get_permalink() )?>" rel="bookmark" class="section__link btn btn--ghost"><?php echo __('Saznaj više','kimnatura');?></a>
        </div>
         <?php the_post_thumbnail( 'full-width',array('class' => 'kenburns-bottom hero__image'));  ?>
</div><!--end of hero item-->

<?php
endforeach;
?>
</div>
</div>
<?php
wp_reset_postdata();	
