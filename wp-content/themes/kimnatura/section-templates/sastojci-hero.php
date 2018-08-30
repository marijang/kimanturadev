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



$args = array( 'numberposts' => 1000 ,'category_name' =>'sastojci');
$result = get_posts( $args ) ;


?>
<div class="sastojci__slider-wrapper section section__spacing-top--default section__spacing-bottom--medium">

<div class="sastojci__slider sastojci-slider-slick slick-slider">
<?php
foreach($result as $post):
  setup_postdata($post);

  $images = new Utils\Images();
  $image  = $images->get_post_image( 'slider-full-width' );
  $words    = explode(' ',get_the_title());
  $letters  = str_split(get_the_title(), 1);
//   $thumb_id = get_post_thumbnail_id();
//   $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'slider-full-width', true);
//   $thumb_url = $thumb_url_array[0];
?>

    <div class="sastojci__item" >
    <div class="sastojci__bg" class="kenburns-bottom" style="background-image: url('<?php echo esc_url( $image['image'] ); ?>');">
    <div class="animate-bg"></div> 
    </div>
    <div class="sastojci__content">
            <div class="animate-bg"></div> 
            <h2 class="sastojci__title"><?php the_title(); ?>
         
            </h2>
            <?php the_subtitle( '<div class="sastojci__description"><em>', '</em></div>' ); ?>
            <?php 
                if( has_excerpt() ){
                    the_excerpt();
                } else {
                    the_content(); 
                }
            ?>
         
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
