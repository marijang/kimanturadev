<?php

/**
 * The template for displaying cookie controller view in wp-admin
 *
 * You can overwrite this template by copying it to yourtheme/ct-ultimate-gdpr/admin folder
 *
 * @version 1.0
 *
 */

?>

<div class="ct-ultimate-gdpr-wrap">

    <div class="ct-ultimate-gdpr-branding">
        <div class="ct-ultimate-gdpr-img">
            <img src="<?php echo ct_ultimate_gdpr_url() . '/assets/css/images/branding.jpg' ?>">
        </div>
        <div class="text">
            <div class="ct-ultimate-gdpr-plugin-name"><?php echo esc_html__( 'Ultimate GDPR', 'ct-ultimate-gdpr' ); ?></div>
            <div class="settings"><?php echo esc_html__( 'Settings', 'ct-ultimate-gdpr' ); ?></div>
        </div>
    </div>


	<?php if ( isset( $options['notices'] ) ) : ?>
		<?php foreach ( $options['notices'] as $notice ) : ?>

            <div class="ct-ultimate-gdpr notice-info notice">
				<?php echo $notice; ?>
            </div>

		<?php endforeach; endif; ?>

	<?php if ( isset( $options['warnings'] ) ) : ?>
		<?php foreach ( $options['warnings'] as $notice ) : ?>

            <div class="ct-ultimate-gdpr warning-info warning">
                <h3><?php echo $notice; ?></h3>
            </div>

		<?php endforeach; endif; ?>

	<?php if ( isset( $options['errors'] ) ) : ?>
		<?php foreach ( $options['errors'] as $notice ) : ?>

            <div class="ct-ultimate-gdpr error-info error">
                <h3><?php echo $notice; ?></h3>
            </div>

		<?php endforeach; endif; ?>


    <h2 class="nav-tab-wrapper">
        <a href="#" id="cookie-popup" class="nav-tab nav-tab-active">
			<?php echo esc_html__( 'Cookie popup', 'ct-ultimate-gdpr' ); ?>
        </a>
        <a href="#" id="cookie-preference" class="nav-tab">
			<?php echo esc_html__( 'Preferences', 'ct-ultimate-gdpr' ); ?>
        </a>
        <a href="#" id="cookie-advanced" class="nav-tab">
			<?php echo esc_html__( 'Advanced settings', 'ct-ultimate-gdpr' ); ?>
        </a>
    </h2>


    <form method="post" action="options.php" enctype="multipart/form-data">

		<?php

		// This prints out all hidden setting fields
		settings_fields( CT_Ultimate_GDPR_Controller_Cookie::ID );
		ct_ultimate_gdpr_do_settings_sections( CT_Ultimate_GDPR_Controller_Cookie::ID );

		?>

        <div class="ct-ultimate-gdpr-msg-clone-static-caution ct-ultimate-gdpr-inner-wrap ct-ultimate-gdpr-width ct-submit-section">
            <p><?php echo esc_html__("Press 'Save changes' before downloading logs if you changed any options","ct-ultimate-gdpr"); ?></p>
		    <?php
		    submit_button();
		    ?>
        </div>

	</form>
</div>

<form method="post">
    <input type="submit" class="button button-secondary" name="ct-ultimate-gdpr-log"
           value="<?php echo esc_html__( 'Download consents log', 'ct-ultimate-gdpr' ); ?>"/>
</form>

<div class="submit">
    <form method="post">
        <input type="submit" class="button button-secondary" name="ct-ultimate-gdpr-check-cookies"
               value="<?php echo esc_html__( 'Detect cookies', 'ct-ultimate-gdpr' ); ?>"/>
    </form>
    <p>
        <?php echo esc_html__( 'Your website should be publicly accessible so that the Cookie Detector can work properly.', 'ct-ultimate-gdpr' ); ?>
    </p>
</div>

<div id="ct-ultimate-gdpr-cookies-scanner">
    <div class="ct-ultimate-gdpr-cookies-scanner-content">
        <div class="ct-ultimate-gdpr-cookies-scanner__Close">
            <span class="fa fa-times fa-2" aria-hidden="true"></span>
            <span class="sr-only"><?php echo esc_html__('Close', 'ct-ultimate-gdpr'); ?></span>
        </div>
        <h2 class="text-uppercase text-center"><?php echo esc_html__('Cookies Scanner', 'ct-ultimate-gdpr'); ?></h2>
        <div class="ct-ultimate-gdpr-cookies-scanner-content__details text-center">
            <p><?php echo esc_html__('Our busy bees are searching for cookies on:', 'ct-ultimate-gdpr'); ?><br><span class="ct-ultimate-gdpr-cookies-scanner__Notice ct-ultimate-gdpr-cookies-scanner__Notice--Bold ct-ultimate-gdpr-cookies-scanner-content__Sites"><?php echo esc_html__('posts and pages', 'ct-ultimate-gdpr'); ?></span><?php echo esc_html__(' of your WordPress site.', 'ct-ultimate-gdpr'); ?></p>
        </div>
        <div class="ct-ultimate-gdpr-cookies-scanner-content__progress ct-ultimate-gdpr__ProgressBar text-center">
            <div class="ct-ultimate-gdpr__ProgressBee text-center">

            </div>
        </div>
        <div class="ct-ultimate-gdpr-cookies-scanner-content__details text-center">
            <p><?php echo esc_html__('It can take up to few minutes. Thanks for your patience!', 'ct-ultimate-gdpr'); ?></p>
        </div>
        <div class="ct-ultimate-gdpr-cookies-scanner-content__scan">
            <span class="pull-left ct-ultimate-gdpr-cookies-scanner__Message"><?php echo esc_html__('We are currently scanning:', 'ct-ultimate-gdpr'); ?></span>
            <span class="pull-right ct-ultimate-gdpr-cookies-scanner__Notice"><span class="ct-ultimate-gdpr-cookies-scanner-content__scanned">0</span>/<span class="ct-ultimate-gdpr-cookies-scanner-content__scanTotal">0</span> URL</span>

        </div>
        <div class="ct-ultimate-gdpr-cookies-scanner-content__url">
            <span class="pull-left ct-ultimate-gdpr-cookies-scanner__Message">
                <?php echo esc_html__('Currently scanned URL:', 'ct-ultimate-gdpr'); ?>
            </span>
            <span class="pull-right ct-ultimate-gdpr-cookies-scanner__Notice ct-ultimate-gdpr-cookies-scanner-content__currentUrl"></span>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
