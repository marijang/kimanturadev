<?php
/**
 * Add This Snippets
 *
 * @package Kimnatura\Template_Parts\Parts
 */

?>

<!-- AddThis Button BEGIN -->
<div class="section__share-sticky">
<script type="text/javascript">
var addthis_share1 = {
   url: "<?php the_title(); ?>",
   title: "<?php the_title(); ?>",
   description: "<?php echo esc_html( strip_tags( get_the_excerpt() ) ); ?>",
   media: "<?php echo esc_html( $image['image'] ); ?>"
}
</script>
<div class="addthis_sharing_toolbox addthis_toolbox" data-url="<?php the_permalink(); ?>" data-title="<?php the_title_attribute(); ?>">

<div class="custom_images">
  <a class="addthis_button_facebook" fb:like:layout="button_count">
  <span class="at_flat_counter" style="line-height: 32px; font-size: 11.4px;"></span>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-facebook-1" class="at-icon at-icon-facebook" style="fill: rgb(34, 34, 34); width: 32px; height: 32px;"><title id="at-svg-facebook-1">Facebook</title><g><path d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z" fill-rule="evenodd"></path></g></svg></a>

  <a class="addthis_button_email">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-email-5" class="at-icon at-icon-email" style="fill: rgb(34, 34, 34); width: 32px; height: 32px;"><title id="at-svg-email-5">Email</title><g><g fill-rule="evenodd"></g><path d="M27 22.757c0 1.24-.988 2.243-2.19 2.243H7.19C5.98 25 5 23.994 5 22.757V13.67c0-.556.39-.773.855-.496l8.78 5.238c.782.467 1.95.467 2.73 0l8.78-5.238c.472-.28.855-.063.855.495v9.087z"></path><path d="M27 9.243C27 8.006 26.02 7 24.81 7H7.19C5.988 7 5 8.004 5 9.243v.465c0 .554.385 1.232.857 1.514l9.61 5.733c.267.16.8.16 1.067 0l9.61-5.733c.473-.283.856-.96.856-1.514v-.465z"></path></g></svg></a>
</div>

</div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php get_theme_mod('addthis_code')?>"></script>
<!-- AddThis Button END -->
</div>