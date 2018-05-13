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
use Kimnatura\Theme\Utils as Utils;



$args = array( 'numberposts' => 10 ,'category_name' => '	slider-hero');
$result = get_posts( $args ) ;


?>
<div class="hero__slider-wrapper section section__spacing-top--default section__spacing-bottom--medium">
<div class="hero__slider hero-slider-slick slick-slider">
<?php
foreach($result as $post):
  setup_postdata($post);

  $images = new Utils\Images();
  $image  = $images->get_post_image( 'full-width' );
?>

    <div class="hero__item" >
    <div class="hero__bg" class="kenburns-bottom" style="background-image: url('<?php echo esc_url( $image['image'] ); ?>');">
        <div class="hero__content">
            <h2 class="hero__title"><?php the_title(); ?></h2>
            <?php the_subtitle( '<div class="hero__description"><em>', '</em></div>' ); ?>
            <?php 
                if( has_excerpt() ){
                    the_excerpt();
                } else {
                    the_content(); 
                }
            ?>
            <a href="<?php echo  esc_url( get_permalink() )?>" rel="bookmark" class="hero__link btn btn--primary-color"><?php echo __('Saznaj više','kimnatura');?></a>
        </div>
        </div>
         <?php //the_post_thumbnail( 'full-width',array('class' => 'kenburns-bottom hero__image'));  ?>
</div><!--end of hero item-->

<?php
endforeach;
?>
</div>
</div>
<?php
wp_reset_postdata();	
