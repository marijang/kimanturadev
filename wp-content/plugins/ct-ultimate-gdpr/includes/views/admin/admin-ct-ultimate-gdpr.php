<?php

/**
 * The template for displaying main plugin options page
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


    <!-- TABS ( cc ) -->
    <h2 class="nav-tab-wrapper">
        <a href="#" class="nav-tab nav-tab-active">
			<?php echo esc_html__( 'Introduction', 'ct-ultimate-gdpr' ); ?>
        </a>
        <a href="<?php echo admin_url( 'admin.php?page=ct-ultimate-gdpr-plugins' ); ?>" class="nav-tab">
			<?php echo esc_html__( 'Compatibility', 'ct-ultimate-gdpr' ); ?>
        </a>
    </h2>
    <!-- END TABS ( cc ) -->

    <div class="ct-ultimate-gdpr-width"><!-- ADD DIV WITH .ct-ultimate-gdpr-width ( cc ) -->

        <div class="ct-ultimate-gdpr-inner-wrap"><!-- ADD DIV WITH .ct-ultimate-gdpr-inner-wrap ( cc ) -->
            <p>
                <strong><?php echo esc_html__( 'The GDPR was approved and adopted by the EU Parliament in April 2016.', 'ct-ultimate-gdpr' ); ?></strong>
				<?php echo esc_html__( " The regulation will take effect after a two-year transition period and, unlike a Directive it does not require any enabling legislation to be passed by government; meaning it will be in force May 2018.", 'ct-ultimate-gdpr' ); ?>
            </p>

            <p>
				<?php echo esc_html__( "The GDPR not only applies to organisations located within the EU but it will also apply to organisations located outside of the EU if they offer goods or services to, or monitor the behaviour of, EU data subjects. It applies to all companies processing and holding the personal data of data subjects residing in the European Union, regardless of the company's location.", 'ct-ultimate-gdpr' ); ?>
            </p>

            <p>

				<?php echo esc_html__( "This plugin will create a form where users can request access to or deletion of their personal data, stored on
                your website. It is also possible to:", 'ct-ultimate-gdpr' ); ?>

            </p>
            <ol>
                <li><?php echo esc_html__( "create a custom cookie notice and block all cookies until cookie consent is given", 'ct-ultimate-gdpr' ); ?></li>
                <li><?php echo esc_html__( "set up redirects for your Terms and Conditions and Privacy Policy pages until consent is given", 'ct-ultimate-gdpr' ); ?></li>
                <li><?php echo esc_html__( "browse user requests for data access/deletion and set custom email notifications", 'ct-ultimate-gdpr' ); ?></li>
                <li><?php echo esc_html__( "send custom email informing about data breach to all users which left their email at your site", 'ct-ultimate-gdpr' ); ?></li>
                <li><?php echo esc_html__( "automatically add consent boxes for various forms on your website", 'ct-ultimate-gdpr' ); ?></li>
                <li><?php echo esc_html__( "pseudonymize some of user data stored in database", 'ct-ultimate-gdpr' ); ?></li>
                <li><?php echo esc_html__( "check currently activated plugins for GDPR compliance", 'ct-ultimate-gdpr' ); ?></li>
            </ol>
            <p></p>

            <p>
				<?php echo esc_html__( "To start, browse through settings. Then, create a new page with shortcode:", 'ct-ultimate-gdpr' ); ?><strong> <?php echo esc_html__( '[ultimate_gdpr_myaccount]', 'ct-ultimate-gdpr' ); ?></strong>
            </p>
        </div><!-- ADD CLOSING DIV FOR .ct-ultimate-gdpr-inner-wrap ( cc ) -->

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="col-md-12 ct-ultimate-gdpr-avail-sc ct-ultimate-gdpr-inner-wrap">
                    <strong class="text-capitalize ct-ultimate-gdpr-head"><?php echo esc_html__( 'Available Shortcodes', 'ct-ultimate-gdpr' ); ?></strong>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="ct-ultimate-gdpr-compact-list">
                                <li>
                                    <div class="row no-gutters">
                                        <span class="col-4">
                                            <?php echo esc_html__( 'User Settings:', 'ct-ultimate-gdpr' ); ?>
                                        </span>
                                        <span class="col-8">
                                            <strong>
                                                <?php echo esc_html__( '[ultimate_gdpr_myaccount]', 'ct-ultimate-gdpr' ); ?>
                                            </strong>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="row no-gutters">
                                        <span class="col-4">
                                            <?php echo esc_html__( 'Privacy Policy Button:', 'ct-ultimate-gdpr' ); ?>
                                        </span>
                                        <span class="col-8">
                                            <strong>
                                                <?php echo esc_html__( '[ultimate_gdpr_policy_accept]', 'ct-ultimate-gdpr' ); ?>
                                            </strong>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="row no-gutters">
                                        <span class="col-4">
                                            <?php echo esc_html__( 'Terms and Conditions Button:', 'ct-ultimate-gdpr' ); ?>
                                        </span>
                                        <span class="col-8">
                                            <strong>
                                                <?php echo esc_html__( '[ultimate_gdpr_terms_accept]', 'ct-ultimate-gdpr' ); ?>
                                            </strong>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="row no-gutters">
                                        <span class="col-4">
                                            <?php echo esc_html__( 'Cookie Popup Link:', 'ct-ultimate-gdpr' ); ?>
                                        </span>
                                        <span class="col-8">
                                            <strong>
                                                <?php echo esc_html__( '[ultimate_gdpr_cookie_popup]', 'ct-ultimate-gdpr' ); ?>
                                            </strong>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="row no-gutters">
                                        <span class="col-4">
                                            <?php echo esc_html__( 'Display Cookies List:', 'ct-ultimate-gdpr' ); ?>
                                        </span>
                                        <span class="col-8">
                                            <strong>
                                                <?php echo esc_html__( '[render_cookies_list]', 'ct-ultimate-gdpr' ); ?>
                                            </strong>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="col-md-12 ct-ultimate-gdpr-avail-sc ct-ultimate-gdpr-inner-wrap">
                    <strong class="text-capitalize ct-ultimate-gdpr-head"><?php echo esc_html__( 'System requirements:', 'ct-ultimate-gdpr' ); ?></strong>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="ct-ultimate-gdpr-compact-list text-capitalize">
                                <li>
                                    <div class="row no-gutters">
                                        <span class="col-6 col-sm-4 col-md-6 col-lg-4">
                                            <?php echo esc_html__( 'PHP Version:', 'ct-ultimate-gdpr' ); ?>
                                        </span>
                                        <span class="col-6 col-sm-8 col-md-6 col-lg-8">
                                            <strong>
                                        <?php echo esc_html__( '7.2+', 'ct-ultimate-gdpr' ); ?>
                                    </strong>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="row no-gutters">
                                        <span class="col-6 col-sm-4 col-md-6 col-lg-4">
                                            <?php echo esc_html__( 'Memory limit:', 'ct-ultimate-gdpr' ); ?>
                                        </span>
                                        <span class="col-6 col-sm-8 col-md-6 col-lg-8">
                                            <strong>
                                        <?php echo esc_html__( '64 MB', 'ct-ultimate-gdpr' ); ?>
                                    </strong>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="row no-gutters">
                                        <span class="col-6 col-sm-4 col-md-6 col-lg-4">
                                            <?php echo esc_html__( 'Disk space:', 'ct-ultimate-gdpr' ); ?>
                                        </span>
                                        <span class="col-6 col-sm-8 col-md-6 col-lg-8">
                                            <strong>
                                        <?php echo esc_html__( '10 MB', 'ct-ultimate-gdpr' ); ?>
                                    </strong>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="col-xs-12 col-md-12 ct-ultimate-gdpr-inner-wrap">
                    <strong><?php echo esc_html__( 'Any questions?', 'ct-ultimate-gdpr' ); ?></strong>
                    <p>
	                    <?php echo esc_html__( 'Please have a look at the', 'ct-ultimate-gdpr' ); ?> <a href="https://createit.support/" class="text-capitalize ct-ultimate-gdpr-link"><?php echo esc_html__( 'Support forum', 'ct-ultimate-gdpr' ); ?></a> <?php echo esc_html__( 'or ask your questions via e-mail', 'ct-ultimate-gdpr' ); ?>
                        <a href="mailto:support@createit.pl" class="ct-ultimate-gdpr-link"><?php echo esc_html__( 'Any questions?', 'ct-ultimate-gdpr' ); ?></a>
                    </p>
                    <p><?php echo esc_html__( 'Link to our ', 'ct-ultimate-gdpr' ); ?> <a href="http://gdpr-plugin.readthedocs.io/" class="ct-ultimate-gdpr-link"><?php echo esc_html__( 'Documentation', 'ct-ultimate-gdpr' ); ?></a></p>
                </div>
            </div>
        </div>

    </div><!-- ADD CLOSING DIV FOR .ct-ultimate-gdpr-width ( cc ) -->

</div>
