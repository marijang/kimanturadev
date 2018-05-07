<section class="section newsletter" style="background-image:url(<?php echo b4b_get_theme_image('newsletter.png'); ?>);">
 
  <?php
  echo '<h3 class="newsletter__title section__title">'.__('Prijavite se na naš newsletter','b4b').'</h3>'; 
  ?>
  <!-- Modal Structure -->
  <div id="newsletter" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
  <button data-target="modal1" class="btn btn--primary modal-trigger">Modal</button>
  <?php
  echo do_shortcode('[mc4wp_form id="4266"]');
  ?>
</section>