<?php

/**
 * Class CT_Ultimate_GDPR_Service_Google_Analytics
 */
class CT_Ultimate_GDPR_Service_Google_Analytics extends CT_Ultimate_GDPR_Service_Abstract {

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
		return 'Google Analytics';
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
	 * @return mixed
	 */
	public function add_option_fields() {

		/* Cookie section */

		add_settings_field(
			"cookie_services_{$this->get_id()}_tracking_id", // ID
			esc_html__( "Google Analytics Tracking ID (disable tracking for this ID when cookies consent not given), eg. UA-118586768-1", 'ct-ultimate-gdpr' ), // Title
			array( $this, "render_field_cookie_services_{$this->get_id()}_tracking_id" ), // Callback
			CT_Ultimate_GDPR_Controller_Cookie::ID, // Page
			'ct-ultimate-gdpr-cookie_tab-1_section-4' // Section
		);

	}

	/**
	 * @param $cookies
	 * @param bool $force
	 *
	 * @return mixed
	 */
	public function cookies_to_block_filter( $cookies, $force = false ) {

		$cookies_to_block = array();
		if ( $force || CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_google_analytics_block_cookies', '', CT_Ultimate_GDPR_Controller_Services::ID ) ) {
			$cookies_to_block = array( '__utma', '__utmb', '__utmc', '__utmt', '__utmz', '_ga', '_gat', '_gid' );
		}
		$cookies_to_block = apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_cookies_to_block", $cookies_to_block );

		if ( is_array( $cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS ] ) ) {
			$cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS ] = array_merge( $cookies[ CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS ], $cookies_to_block );
		}

		return $cookies;

	}

	/**
	 *
	 */
	public function render_field_cookie_services_google_analytics_tracking_id() {

		$admin = CT_Ultimate_GDPR::instance()->get_admin_controller();

		$field_name = $admin->get_field_name( __FUNCTION__ );
		printf(
			"<input class='ct-ultimate-gdpr-field' type='text' id='%s' name='%s' value='%s' />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$admin->get_option_value_escaped( $field_name )
		);

	}

	/**
	 * @return mixed
	 */
	public function front_action() {

		// script for disabling GA tracking
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_static' ), 1 );

	}

	/**
	 *
	 */
	public function enqueue_static() {

		$id = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'cookie_services_google_analytics_tracking_id', '', CT_Ultimate_GDPR_Controller_Cookie::ID );

		// no ga id was set in option
		if ( ! $id ) {
			return;
		}

		// consent given, no need to block ga
		if ( CT_Ultimate_GDPR::instance()->get_controller_by_id( CT_Ultimate_GDPR_Controller_Cookie::ID )->is_consent_valid() ) {
			return;
		}

		wp_enqueue_script( 'ct-ultimate-gdpr-service-google-analytics', ct_ultimate_gdpr_url( '/assets/js/google-analytics.js' ) );
		wp_localize_script( 'ct-ultimate-gdpr-service-google-analytics', 'ct_ultimate_gdpr_service_google_analytics', array( 'id' => $id ) );

	}

	/**
	 * @return string
	 */
	protected function get_default_description() {
		return '';
	}

	/**
	 * Collect data of a specific user
	 *
	 * @return $this
	 */
	public function collect() {
		return $this;
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

		if ( $force || CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_google_analytics_block_cookies', '', CT_Ultimate_GDPR_Controller_Services::ID ) ) {

			$scripts_to_block = array(
				"google-analytics.com/analytics.js",
			);

		}

		$scripts_to_block = apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_script_blacklist", $scripts_to_block );

		if ( is_array( $scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS ] ) ) {
			$scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS ] = array_merge( $scripts[ CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS ], $scripts_to_block );
		}

		return $scripts;
	}
}