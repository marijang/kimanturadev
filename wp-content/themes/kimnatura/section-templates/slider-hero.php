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
  $image  = $images->get_post_image( 'slider-full-width' );
  $words  = explode(' ',get_the_title());
?>

    <div class="hero__item" >
    <div class="hero__bg" class="kenburns-bottom" style="background-image: url('<?php echo esc_url( $image['image'] ); ?>');"> </div>
        <div class="hero__content">
            <h2 class="hero__title"><?php //the_title(); ?>  
            <?php 
                $delay = 0.0;
                foreach($words as $word ){
                    $letters  = str_split($word, 1);
                    echo ' <span class="word">';
                    foreach($letters as $letter ){
                    echo '<span class="letter" style="transition-delay: '.$delay.'s;">'.$letter.'</span>';
                    $delay = $delay + 0.05;
                    }
                    echo '</span>';
                }
            ?>
            </h2>
            
            <?php 
            echo '<div class="hero__description" style="transition-delay: '.$delay.'s;">';
            the_subtitle( '<em>', '</em>' ); ?>
            <?php 
                if( has_excerpt() ){
                    the_excerpt();
                } else {
                    the_content(); 
                }
            echo '</div>';
            ?>
            
            <a href="<?php echo  esc_url( get_permalink() )?>" rel="bookmark" class="hero__link btn btn--primary-color" style="transition-delay: <?php echo $delay;?>s;"><?php echo __('Saznaj više','kimnatura');?></a>
       
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
