<?php

/**
 * The template for displaying Newsletter service view in wp-admin
 *
 * You can overwrite this template by copying it to yourtheme/ct-ultimate-gdpr/service folder
 *
 * @version 1.0
 *
 */

?>
<div class="tnp-field tnp-field-privacy">
    <input class="ct-ultimate-gdpr-consent-field" type="checkbox" name="ct-ultimate-gdpr-consent-field" id="ct-ultimate-gdpr-consent-field-newsletter" required>
    <label for="ct-ultimate-gdpr-consent-field-newsletter">
        <?php echo esc_html__('I consent to the storage of my data according to the Privacy Policy', 'ct-ultimate-gdpr'); ?>
    </label>
</div>