<section class="section newsletter" style="background-image:url(<?php echo b4b_get_theme_image('newsletter.png'); ?>);">
 
  <?php
  echo '<h3 class="newsletter__title section__title">'.__('Prijavite se na naš newsletter','b4b').'</h3>'; 
  ?>
  <?php
  echo do_shortcode('[mc4wp_form id="4266"]');
  ?>
</section>