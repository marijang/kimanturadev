<?php

/**
 * Class CT_Ultimate_GDPR_Service_Eform
 */
class CT_Ultimate_GDPR_Service_Eform extends CT_Ultimate_GDPR_Service_Abstract {

	/**
	 * @return void
	 */
	public function init() {
		add_filter( 'ct_ultimate_gdpr_controller_plugins_compatible_wp-fsqm-pro/ipt_fsqm.php', '__return_true' );
		add_filter( 'ct_ultimate_gdpr_controller_plugins_collects_data_wp-fsqm-pro/ipt_fsqm.php', '__return_true' );

		// better not validate in backend, since checkbox is added by front js
		//		add_filter( 'ipt_fsqm_filter_data_errors', array( $this, 'validate' ) );
	}

	/**
	 * @return $this
	 */
	public function collect() {

		global $wpdb;

		$results = $wpdb->get_results(
			$wpdb->prepare( "
				SELECT *
				FROM {$wpdb->prefix}fsq_data
				WHERE email = %s
				",
				$this->user->get_email()
			),
			ARRAY_A
		);

		$this->set_collected( $results );

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function get_name() {
		return 'eForm - WordPress Form Builder';
	}

	/**
	 * @return bool
	 */
	public function is_active() {
		return class_exists( 'IPT_FSQM_Loader' );
	}

	/**
	 * @return bool
	 */
	public function is_forgettable() {
		return true;
	}

	/**
	 * @throws Exception
	 * @return void
	 */
	public function forget() {

		global $wpdb;

		$wpdb->delete(
			"{$wpdb->prefix}fsq_data",
			array( 'email' => $this->user->get_email() )
		);

	}

	/**
	 * @param array $recipients
	 *
	 * @return array
	 */
	public function breach_recipients_filter( $recipients ) {

		global $wpdb;

		$results = $wpdb->get_results("
				SELECT DISTINCT email
				FROM {$wpdb->prefix}fsq_data
			",
			ARRAY_A
		);

		foreach ( $results as $result ) {

			if ( ! empty( $result['email'] ) ) {
				$recipients[ $result['email'] ] = $result['email'];
			}

		}

		return $recipients;

	}

	/**
	 * @return mixed
	 */
	public function add_option_fields() {

		add_settings_section(
			"ct-ultimate-gdpr-services-{$this->get_id()}_accordion-{$this->get_id()}", // ID
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ), // Title
			null, // callback
			CT_Ultimate_GDPR_Controller_Services::ID // Page
		);

		add_settings_field(
			"services_{$this->get_id()}_header", // ID
			$this->get_name(), // Title
			'__return_empty_string', // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			"ct-ultimate-gdpr-services-{$this->get_id()}_accordion-{$this->get_id()}"
		);

		add_settings_field(
			"services_{$this->get_id()}_description", // ID
			sprintf( esc_html__( "[%s] Description", 'ct-ultimate-gdpr' ), $this->get_name() ), // Title
			array( $this, "render_description_field" ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			"ct-ultimate-gdpr-services-{$this->get_id()}_accordion-{$this->get_id()}"
		);

		add_settings_field(
			"services_{$this->get_id()}_consent_field", // ID
			sprintf(
				esc_html__( "[%s] Inject consent checkbox to all forms", 'ct-ultimate-gdpr' ),
				$this->get_name()
			),
			array( $this, 'render_field_services_eform_consent_field' ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			"ct-ultimate-gdpr-services-{$this->get_id()}_accordion-{$this->get_id()}"
		);

		add_settings_field(
			"breach_services_{$this->get_id()}",
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ),
			array( $this, 'render_field_breach_services' ),
			CT_Ultimate_GDPR_Controller_Breach::ID,
			'ct-ultimate-gdpr-breach_section-2' // Section
		);


	}

	/**
	 *
	 */
	public function render_field_breach_services() {

		$admin      = CT_Ultimate_GDPR::instance()->get_admin_controller();
		$field_name = $admin->get_field_name( __FUNCTION__ );
		$values     = $admin->get_option_value( $field_name, array(), CT_Ultimate_GDPR_Controller_Breach::ID );
		$checked    = in_array( $this->get_id(), $values ) ? 'checked' : '';
		printf(
			"<input class='ct-ultimate-gdpr-field' type='checkbox' id='%s' name='%s[]' value='%s' %s />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$this->get_id(),
			$checked
		);

	}

	/**
	 *
	 */
	public function render_field_services_eform_consent_field() {

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
	 *
	 */
	public function render_field_services_eform_consent_field_position_first() {

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
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
	}

	/**
	 *
	 */
	public function wp_enqueue_scripts() {

		if ( $inject = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( "services_{$this->get_id()}_consent_field", '', CT_Ultimate_GDPR_Controller_Services::ID ) ) {
			wp_enqueue_script( 'ct-ultimate-gdpr-service-eform', ct_ultimate_gdpr_url( 'assets/js/service-eform.js' ) );
			wp_localize_script( 'ct-ultimate-gdpr-service-eform', 'ct_ultimate_gdpr_eform', array(
				'checkbox' => ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-eform-consent-field', false ) ),
			) );
		}
	}

	/**
	 * @return string
	 */
	protected function get_default_description() {
		return esc_html__( 'eForm gathers data entered by users in forms', 'ct-ultimate-gdpr' );
	}
}