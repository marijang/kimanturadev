<?php

/**
 * Class CT_Ultimate_GDPR_Shortcode_Myaccount
 */
class CT_Ultimate_GDPR_Shortcode_Myaccount {

	/**
	 * @var string
	 */
	private $tag = 'ultimate_gdpr_myaccount';

	/**
	 * CT_Ultimate_GDPR_Shortcode_Myaccount constructor.
	 */
	public function __construct() {
		add_shortcode( $this->tag, array( $this, 'process' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts_action' ) );
	}

	/**
	 *
	 */
	public function wp_enqueue_scripts_action() {
		if ( get_post() && false !== strpos( get_post()->post_content, "[$this->tag]" ) ) {
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'ct-ultimate-gdpr-tabs', ct_ultimate_gdpr_url( 'assets/js/shortcode-myaccount.js' ), array( 'jquery-ui-tabs' ), ct_ultimate_gdpr_get_plugin_version() );
			wp_enqueue_style( 'ct-ultimate-gdpr-jquery-ui', ct_ultimate_gdpr_url( 'assets/css/jquery-ui.min.css' ), ct_ultimate_gdpr_get_plugin_version() );

			if ( CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_recaptcha_secret', '', CT_Ultimate_GDPR_Controller_Services::ID ) ) {
				wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
			}

		}
	}

	/**
	 * Shortcode callback
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function process( $atts ) {

		$services = CT_Ultimate_GDPR_Model_Services::instance()->get_services( array(), 'forgettable' );
		CT_Ultimate_GDPR_Model_Front_View::instance()->set( 'services', $services );
		CT_Ultimate_GDPR_Model_Front_View::instance()->set( 'recaptcha_key', CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_recaptcha_key', '', CT_Ultimate_GDPR_Controller_Services::ID ) );

		return $this->render();

	}

	/**
	 * Render shortcode template
	 */
	public function render() {

		ob_start();
		ct_ultimate_gdpr_render_template(
			ct_ultimate_gdpr_locate_template(
				"/shortcode/shortcode-myaccount",
				false
			),
			true,
			CT_Ultimate_GDPR_Model_Front_View::instance()->to_array()
		);

		return ob_get_clean();

	}
}