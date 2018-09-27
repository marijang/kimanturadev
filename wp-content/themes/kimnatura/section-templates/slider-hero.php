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
$images = new Utils\Images();


$args = array( 'numberposts' => 10 ,'category_name' =>'slider-hero');
$result = get_posts( $args ) ;


?>
<div class="hero__slider-wrapper section section__spacing-top--default section__spacing-bottom--medium">
<div class="hero__slider-indicator">
<div class="scroll-indicator">
	<div class="dots"></div>
</div>
</div>
<div class="hero__slider hero-slider-slick slick-slider">
<?php
$i = 0;
foreach($result as $post):
  setup_postdata($post);

 
  $image  = $images->get_post_image( 'slider-full-width' );
  $words  = preg_split('/\s+/', get_the_title());
  $class = '';
  if ($i==0){
      $class = 'animated1'; 
      
  }
  $i++;
?>

    <div class="hero__item <?php echo $class; ?>" >
    <div class="hero__bg" class="kenburns-bottom"  style="background-image: url('<?php echo esc_url( $image['image'] ); ?>'); transition-delay: .6s;"> </div>
        <div class="hero__content">
            <h2 class="hero__title"><?php //the_title(); ?>  
            <?php 
                $delay = 0.0;
                foreach($words as $word ){
                    $word = html_entity_decode($word);
                    //$letters  = utf8Split($word, 1);
                    $letters = array();
                    $strLen = mb_strlen($word, 'UTF-8');
                    for ($i = 0; $i < $strLen; $i++)
                    {
                      $letters[] = mb_substr($word, $i, 1, 'UTF-8');
                    }
                    echo ' <span class="word">';
                    foreach($letters as $letter ){
                    echo '<span class="letter" style="transition-delay: '.$delay.'s;">'. $letter .'</span>';
                    $delay = $delay + 0.03;
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
            <div class="hero__link" style="transition-delay:<?php echo $delay+0.03;?>s;">
            <a href="<?php echo  esc_url( get_permalink() )?>" rel="bookmark" class=" btn btn btn--primary-color" ><?php echo __('Saznaj više','kimnatura');?></a>
            </div>
        </div>
         <?php //the_post_thumbnail( 'full-width',array('class' => 'kenburns-bottom hero__image'));  ?>
</div><!--end of hero item-->

<?php

endforeach;
wp_reset_postdata();	
?>
</div>
</div>
<?php

