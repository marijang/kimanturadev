<?php

/**
 * Class CT_Ultimate_GDPR_Service_Youtube
 */
class CT_Ultimate_GDPR_Service_Youtube extends CT_Ultimate_GDPR_Service_Abstract {

	/**
	 * @return void
	 */
	public function init() {
	}

	/**
	 * @return $this
	 */
	public function collect() {
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function get_name() {
		return apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_name", 'Youtube' );
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

		if ( $force || CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_youtube_remove_iframe', '', CT_Ultimate_GDPR_Controller_Services::ID ) ) {

			$scripts_to_block = array(
				".youtube.com/",
			);

		}

		$scripts_to_block = apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_script_blacklist", $scripts_to_block );

		if ( is_array( $scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE ] ) ) {
			$scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE ] = array_merge( $scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE ], $scripts_to_block );
		}

		return $scripts;
	}

	/**
	 * @return mixed
	 */
	public function add_option_fields() {

		add_settings_section(
			'ct-ultimate-gdpr-services-youtube_accordion-22', // ID
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ), // Title
			null, // callback
			CT_Ultimate_GDPR_Controller_Services::ID // Page
		);


		add_settings_field(
			"services_{$this->get_id()}_header", // ID
			$this->get_name(), // Title
			'__return_empty_string', // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-youtube_accordion-22' // Section
		);

		add_settings_field(
			'services_youtube_remove_iframe', // ID
			esc_html__( '[Youtube] Remove youtube iframes until Necessary cookies accepted', 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_youtube_remove_iframe' ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-youtube_accordion-22' // Section
		);

	}

	public function cookies_to_block_filter( $cookies, $force = false ) {

		$cookies_to_block = array();
		if ( $force || CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_youtube_block_cookies', '', CT_Ultimate_GDPR_Controller_Services::ID ) ) {
			$cookies_to_block = array( 'APISID', 'CONSENT', 'GPS', 'HSID', 'LOGIN_INFO', 'PREF', 'SAPISID', 'SID', 'SSID', 'VISITOR_INFO1_LIVE', 'YSC' );
		}
		$cookies_to_block = apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_cookies_to_block", $cookies_to_block );

		if ( is_array( $cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE ] ) ) {
			$cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE ] = array_merge( $cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE ], $cookies_to_block );
		}

		return $cookies;

	}

	/**
	 *
	 */
	public function render_field_services_youtube_remove_iframe() {

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
	 * @return mixed
	 */
	public function front_action() {
	}

	/**
	 * @return string
	 */
	protected function get_default_description() {
		return esc_html__( 'Youtube creates cookies', 'ct-ultimate-gdpr' );
	}
}