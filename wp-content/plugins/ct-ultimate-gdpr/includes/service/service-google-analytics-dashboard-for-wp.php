<?php

/**
 * Class CT_Ultimate_GDPR_Service_Google_Analytics_For_Wordpress
 */
class CT_Ultimate_GDPR_Service_Google_Analytics_Dashboard_For_WP extends CT_Ultimate_GDPR_Service_Abstract {


	/**
	 * Run on init
	 * @return void
	 */
	public function init() {
		$this->maybe_disable_tracking();
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
	 * Get service name
	 *
	 * @return mixed
	 */
	public function get_name() {
		return "Google Analytics Dashboard For WP";
	}

	/**
	 * Is it active, eg. whether related plugin is enabled
	 *
	 * @return bool
	 */
	public function is_active() {
		return function_exists( 'GADWP' );
	}

	/**
	 * Can data be forgotten by this service?
	 *
	 * @return bool
	 */
	public function is_forgettable() {
		return false;
	}

	/**
	 * Forget specific user data
	 *
	 * @throws Exception
	 * @return void
	 */
	public function forget() {
	}

	/**
	 * Add admin option fields
	 *
	 * @return mixed
	 */
	public function add_option_fields() {

		// important: if service is not active and option is hidden, then its value gets lost when saved
		if ( ! $this->is_active() ) {
			return;
		}

		add_settings_section(
			'ct-ultimate-gdpr-services-googleanalyticsdashboardforwp_accordion-10', // ID
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ), // Title
			null, // callback
			CT_Ultimate_GDPR_Controller_Services::ID // Page
		);

		/* Services section */

		add_settings_field(
			"cookie_services_{$this->get_id()}_disabled", // ID
			"[{$this->get_name()}] Disable all tracking for users who did not accept cookies", // Title
			array( $this, "render_field_cookie_services_google_analytics_dashboard_for_wp_disabled" ), // Callback
			CT_Ultimate_GDPR_Controller_Cookie::ID, // Page
			'ct-ultimate-gdpr-services-googleanalyticsdashboardforwp_accordion-10'
		);


	}

	/**
	 *
	 */
	public function render_field_cookie_services_google_analytics_dashboard_for_wp_disabled() {

		$admin      = CT_Ultimate_GDPR::instance()->get_admin_controller();
		$field_name = $admin->get_field_name( __FUNCTION__ );
		printf(
			"<input class='ct-ultimate-gdpr-field' type='checkbox' id='%s' name='%s' %s />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$admin->get_option_value_escaped( $field_name ) ? 'checked' : ''
		);

	}

	/**
	 *
	 */
	public function maybe_disable_tracking() {

		if (
			CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( "cookie_services_google_analytics_dashboard_for_wp_disabled", '', CT_Ultimate_GDPR_Controller_Cookie::ID ) &&
			! CT_Ultimate_GDPR::instance()->get_controller_by_id( CT_Ultimate_GDPR_Controller_Cookie::ID )->is_consent_valid()
		) {
			add_filter( 'gadwp_analytics_script_path', '__return_empty_string' );
			add_filter( 'gadwp_gtag_script_path', '__return_empty_string' );
		}

	}

	/**
	 * Do optional action on front
	 *
	 * @return mixed
	 */
	public function front_action() {
	}
}