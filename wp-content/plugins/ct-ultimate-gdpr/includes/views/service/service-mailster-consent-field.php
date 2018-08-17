<?php

/**
 * The template for displaying Mailster service view in wp-admin
 *
 * You can overwrite this template by copying it to yourtheme/ct-ultimate-gdpr/service folder
 *
 * @version 1.0
 *
 */

?>

<input class="ct-ultimate-gdpr-consent-field" type="checkbox" name="ct-ultimate-gdpr-consent-field" required />
<label for="ct-ultimate-gdpr-consent-field">
	<?php echo esc_html__( 'I consent to storage of my data according to Privacy Policy', 'ct-ultimate-gdpr' ); ?>
    <span class="mailster-required">*</span>
</label>