<?php

/**
 * The template for displaying Contact Form 7 service view in wp-admin
 *
 * You can overwrite this template by copying it to yourtheme/ct-ultimate-gdpr/service folder
 *
 * @version 1.0
 *
 */

?>

<p>
    <span class="wpcf7-form-control-wrap accept-this-1">
        <span class="wpcf7-form-control wpcf7-acceptance">
            <span class="wpcf7-list-item">
                <input class="ct-ultimate-gdpr-consent-field" type="checkbox" name="ct-ultimate-gdpr-consent-field" required/>
                <label for="ct-ultimate-gdpr-consent-field">
                    <?php echo esc_html__('I consent to the storage of my data according to the Privacy Policy', 'ct-ultimate-gdpr'); ?>
                </label>
            </span>
        </span>
    </span>
</p>