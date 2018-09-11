<?php
/**
 * Newsletter Page
 *
 * @package Kimnatura\Template_Parts\Single
 */


?>
<!-- Single Content Section -->
<section class="newsletter section  section__spacing-top--medium section__spacing-bottom--medium " id="newsletter">
  <div class="newsletter__bg"></div>
  <header class="section__header">
    <h3 class="section__title section__title--center">
        Prijavite se na newsletter
    </h3>
  </header>
  <div class="section__content">
    <?php
        // echo do_shortcode('[mc4wp_form id="'.get_theme_mod('mailchimp_newsletter_code').'"]');
        echo do_shortcode('[mc4wp_form id="236"]');
        
        ?>
  </div>
</section>
