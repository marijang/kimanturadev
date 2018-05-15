<?php
/**
 * Social
 *
 * @package Kimnatura\Template_Parts\Footer
 */

/**
 * Include cookies template
 */
$icons_dir =  KIM_IMAGE_URL . 'social-share/';
$array = array(
    array(
        "value" => 'Facebook',
        "link"  => '#facebook',
        "image" => 'facebook.svg'
    ),
    array(
        "value" => 'Instagram',
        "link"  => '#instagram',
        "image" => 'instagram.svg'
    ),
    array(
        "value" => 'Twitter',
        "link"  => '#twitter',
        "image" => 'twitter.svg'
    )
);
?>
<div class="social-followus">
    <h5 class="social-followus__title"> <?php echo  __('Pratite nas','b4b');?></h5>
<ul class="social-followus__menu">
<?php
foreach($array as $item){
?>
    <li class="social-followus__item">
        <a href="<?php echo $item['link']?>" class="social-followus__link">
        <?php  get_template_part('skin/public/images/inline/inline',$item['image']) ?>
        </a>
    </li>


<?php
}
?>
</ul>
</div>

