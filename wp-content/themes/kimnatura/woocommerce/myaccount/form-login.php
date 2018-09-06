<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<script>
	jQuery( document ).ready(function() {
		jQuery('.register').children().css('display', 'none');
		jQuery('#reg-toggle').parent().css('display', 'block');
		// jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'none');
		// jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'none');
		// jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
		jQuery('#username').focus();
	jQuery('#log-toggle').on('click', function(){
		jQuery('#reg-box').removeClass('is-active');
		jQuery('#log-box').addClass('is-active');
		jQuery('.register').children().css('display', 'none');
		jQuery('#reg-toggle').parent().css('display', 'block');
	});
	jQuery('#reg-toggle').on('click', function(){
			jQuery('#log-box').removeClass('is-active');
			jQuery('#reg-box').addClass('is-active');
			jQuery('.register').children().css('display', 'block');
			jQuery('#reg-toggle').parent().css('display', 'none');
			jQuery('.woocommerce-terms-and-conditions').css('display', 'none');
			// jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'inline-block');
			// jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'inline-block');
			//jQuery('.woocommerce-privacy-policy-text').css('display', 'block');
	});
	jQuery('#log-toggle-mobile').on('click', function(){
			jQuery('#reg-box').removeClass('is-active');
			jQuery('#log-box').addClass('is-active');
			jQuery('.register').children().css('display', 'none');
			jQuery('#reg-toggle').parent().css('display', 'block');
	});
	jQuery('#reg-toggle-mobile').on('click', function(){
			jQuery('#log-box').removeClass('is-active');
			jQuery('#reg-box').addClass('is-active');
			jQuery('.register').children().css('display', 'block');
			jQuery('#reg-toggle').parent().css('display', 'none');
			jQuery('.woocommerce-terms-and-conditions').css('display', 'none');
			//jQuery('.woocommerce-privacy-policy-text').css('display', 'block');
	});


	// jQuery( document ).ready(function() {
	// 	jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'none');
	// 	jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'none');
	// 	jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
	// 	jQuery('#username').focus();
	// 	jQuery('#log-toggle').on('click', function(){
	// 		jQuery('#reg-box').removeClass('is-active');
	// 		jQuery('#log-box').addClass('is-active');
	// 		jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'none');
	// 		jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'none');
	// 		jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
	// });
	// jQuery('#reg-toggle').on('click', function(){
	// 		jQuery('#log-box').removeClass('is-active');
	// 		jQuery('#reg-box').addClass('is-active');
	// 		jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'inline-block');
	// 		jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'inline-block');
	// 		//jQuery('.woocommerce-privacy-policy-text').css('display', 'block');
	// });
	// jQuery('#log-toggle-mobile').on('click', function(){
	// 		jQuery('#reg-box').removeClass('is-active');
	// 		jQuery('#log-box').addClass('is-active');
	// 		jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'none');
	// 		jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'none');
	// 		jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
	// });
	// jQuery('#reg-toggle-mobile').on('click', function(){
	// 		jQuery('#log-box').removeClass('is-active');
	// 		jQuery('#reg-box').addClass('is-active');
	// 		jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'inline-block');
	// 		jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'inline-block');
	// 		//jQuery('.woocommerce-privacy-policy-text').css('display', 'block');
	// });
});
</script>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>


<p class="login__mobile-buttons">
	<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
	<a class="btn btn--ghost-inverted btn--small" name="login-toggle" id='log-toggle-mobile'><?php esc_html_e( 'Login', 'woocommerce' ); ?></a>
	<a class="btn btn--ghost-inverted btn--small" name="register-toggle" id="reg-toggle-mobile"><?php esc_html_e( 'Register', 'woocommerce' ); ?></a>
</p>

<div class="u-columns col2-set login__boxes" id="customer_login">

	<div id="log-box" class="u-column1 col-1 login__box login__box--log is-active">

<?php endif; ?>

		<div class="login__box-title"><?php esc_html_e( 'Login', 'woocommerce' ); ?></div>
		<p class="login__box-description">Unesite korisničke podatke za prijavu.</p>

		<form class="woocommerce-form1111 woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login__row input-field">
				<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input autofocus type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				<span class="helper-text errorClass" data-error="wrong"></span>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login__row input-field">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input autofocus class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
				<span class="helper-text errorClass" data-error="wrong"></span>
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row login__btn-row" id="submit-btn">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button  btn btn--primary-color btn--small" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
				<!-- <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label> -->
			</p>
			<p class="form-row login__btn-row" id="toggle-btn">
				<?php// wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<a class="btn btn--ghost-inverted-color btn--small" name="login-toggle" id='log-toggle'><?php esc_html_e( 'Login', 'woocommerce' ); ?></a>
			</p>
			

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div id="reg-box" class="u-column2 col-2 login__box login__box--reg">

		<div class="login__box-title"><?php esc_html_e( 'Register', 'woocommerce' ); ?></div>
		<p class="login__box-description">Otvarite račun na našim stranicama kako bi brže kupovali i imali pregled povijesti kupnje.</p>

		<form method="post" class="register" autocomplete="off">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login__row">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="off" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login__row input-field">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			    <span class="helper-text errorClass" data-error="wrong"></span>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p style="margin-bottom: 0px;" class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login__row input-field">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" autocomplete="new-password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
					<span class="helper-text errorClass" data-error="wrong"></span>
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-FormRow form-row login__btn-row" id="submit-btn">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="btn btn--primary-color btn--small woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
			</p>
			<p class="woocommerce-FormRow form-row login__btn-row" id="toggle-btn">
				
				<a class="btn btn--ghost-inverted-color btn--small" name="register-toggle" id="reg-toggle"><?php esc_html_e( 'Register', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<script>
 $(window).on('load', function() {
  $('input[type="text"], input[type="password"]').click();
});
</script>