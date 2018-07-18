<?php

/**
 * Class CT_Ultimate_GDPR_Service_Facebook_Pixel
 */
class CT_Ultimate_GDPR_Service_Facebook_Pixel extends CT_Ultimate_GDPR_Service_Abstract {

	/**
	 * @return void
	 */
	public function init() {
	}

	/**
	 * @return $this
	 */

	/**
	 * @return mixed
	 */
	public function get_name() {
		return 'Facebook Pixel';
	}

	/**
	 * @return bool
	 */
	public function is_active() {
		return true;
	}

	/**
	 * @return bool
	 */
	public function is_forgettable() {
		return false;
	}

	/**
	 * @throws Exception
	 * @return void
	 */
	public function forget() {
	}

	/**
	 * @param array $scripts
	 *
	 * @param bool $force
	 *
	 * @return array
	 */
	public function script_blacklist_filter( $scripts, $force = false ) {

		$scripts_to_block = array();

		if ( $force || CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_facebook_pixel_block_cookies', '', CT_Ultimate_GDPR_Controller_Services::ID ) ) {

			$scripts_to_block = array(
				"pixel-cat.",
				"fbq('init'",
				"www.facebook.com/tr?id",
				"/pixelyoursite/"
			);

		}

		$scripts_to_block = apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_script_blacklist", $scripts_to_block );

		if ( is_array( $scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING ] ) ) {
			$scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING ] = array_merge( $scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING ], $scripts_to_block );
		}

		return $scripts;

	}

	/**
	 * @return mixed
	 */
	public function add_option_fields() {


		add_settings_section(
			'ct-ultimate-gdpr-services-facebookpixel_accordion-6', // ID
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ), // Title
			null, // callback
			CT_Ultimate_GDPR_Controller_Services::ID // Page
		);

		add_settings_field(
			"services_{$this->get_id()}_header", // ID
			$this->get_name(), // Title
			'__return_empty_string', // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-facebookpixel_accordion-6'// section
		);

		add_settings_field(
			"services_{$this->get_id()}_block_cookies", // ID
			sprintf( esc_html__( "[%s] Block Facebook Pixel cookies when a user doesn't accept Advertising cookies", 'ct-ultimate-gdpr' ), $this->get_name() ), // Title
			array( $this, "render_field_services_facebook_pixel_block_cookies" ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-facebookpixel_accordion-6' // section
		);

	}

	/**
	 *
	 */
	public function render_field_services_facebook_pixel_block_cookies() {

		$admin = CT_Ultimate_GDPR::instance()->get_admin_controller();

		$field_name = $admin->get_field_name( __FUNCTION__ );
		printf(
			"<input class='ct-ultimate-gdpr-field' type='checkbox' id='%s' name='%s' %s />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$admin->get_option_value_escaped( $field_name ) ? 'checked' : ''
		);

	}

	/**
	 * @param array $cookies
	 * @param bool $force
	 *
	 * @return array
	 */
	public function cookies_to_block_filter( $cookies, $force = false ) {

		$cookies_to_block = array();
		if ( $force || CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_facebook_pixel_block_cookies', '', CT_Ultimate_GDPR_Controller_Services::ID ) ) {
			$cookies_to_block = array(
				'act',
				'wd',
				'xs',
				'datr',
				'sb',
				'presence',
				'c_user',
				'fr',
				'pl',
				'reg_ext_ref',
				'reg_fb_gate',
				'reg_fb_ref'
			);
		}
		$cookies_to_block = apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_cookies_to_block", $cookies_to_block );

		if ( is_array( $cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING ] ) ) {
			$cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING ] = array_merge( $cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING ], $cookies_to_block );
		}

		return $cookies;

	}

	/**
	 * @return mixed
	 */
	public function front_action() {

		if ( apply_filters( 'ct_ultimate_gdpr_controller_cookie_group_level', 0 ) < min( $this->get_group_levels() ) ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_static' ), 1 );
		}

	}

	/**
	 *
	 */
	public function enqueue_static() {
		wp_enqueue_script( 'ct_ultimate_gdpr_service_facebook_pixel', ct_ultimate_gdpr_url( 'assets/js/service-facebook-pixel.js' ) );
	}

	/**
	 * @return string
	 */
	protected function get_default_description() {
		return '';
	}

	/**
	 * @return array
	 */
	public function get_group_levels() {
		return apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_group_levels", array( CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING ) );
	}

	/**
	 * Collect data of a specific user
	 *
	 * @return $this
	 */
	public function collect() {
		return $this;
	}
}