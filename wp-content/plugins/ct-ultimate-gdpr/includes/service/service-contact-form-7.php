<?php

/**
 * Class CT_Ultimate_GDPR_Service_Contact_Form_7
 */
class CT_Ultimate_GDPR_Service_Contact_Form_7 extends CT_Ultimate_GDPR_Service_Abstract {

	/**
	 * @return void
	 */
	public function init() {
		add_filter( 'ct_ultimate_gdpr_controller_plugins_compatible_contact-form-7/wp-contact-form-7.php', '__return_true' );
		add_filter( 'ct_ultimate_gdpr_controller_plugins_collects_data_contact-form-7/wp-contact-form-7.php', '__return_true' );
		add_action( 'wpcf7_mail_components', array( $this, 'wpcf7_mail_components_filter' ), 10, 3 );
	}

	/** Add 'gdpr accepted' note to admin mails
	 *
	 * @param $components
	 * @param $form
	 * @param $mailer
	 *
	 * @return mixed
	 */
	public function wpcf7_mail_components_filter( $components, $form, $mailer ) {

		if ( isset( $components['body'] ) ) {
			$components['body'] .= PHP_EOL . PHP_EOL . 'GDPR accepted: ' . date( get_option( 'date_format' ) ) . ' ' . date( get_option( 'time_format' ) );
		}

		return $components;
	}

	/**
	 * @return $this
	 */
	public function collect() {
		$this->set_collected( array() );

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function get_name() {
		return 'Contact Form 7';
	}

	/**
	 * @return bool
	 */
	public function is_active() {
		return function_exists( 'wpcf7' );
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

		add_settings_section(
			'ct-ultimate-gdpr-services-cform7_accordion-4', // ID
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ), // Title
			null, // callback
			CT_Ultimate_GDPR_Controller_Services::ID // Page
		);

		add_settings_field(
			"services_{$this->get_id()}_header", // ID
			$this->get_name(), // Title
			'__return_empty_string', // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-cform7_accordion-4'
		);

		add_settings_field(
			"services_{$this->get_id()}_description", // ID
			sprintf( esc_html__( "[%s] Description", 'ct-ultimate-gdpr' ), $this->get_name() ), // Title
			array( $this, "render_description_field" ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-cform7_accordion-4'
		);

		add_settings_field(
			'services_contact_form_7_consent_field', // ID
			sprintf(
				esc_html__( "[%s] Inject consent checkbox to all forms", 'ct-ultimate-gdpr' ),
				$this->get_name()
			),
			array( $this, 'render_field_services_contact_form_7_consent_field' ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-cform7_accordion-4'
		);

		add_settings_field(
			'services_contact_form_7_consent_field_position_first', // ID
			esc_html__( '[Contact Form 7] Inject consent checkbox as the first field instead of the last', 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_contact_form_7_consent_field_position_first' ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-cform7_accordion-4'
		);

	}

	/**
	 *
	 */
	public function render_field_services_contact_form_7_consent_field() {

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
	public function render_field_services_contact_form_7_consent_field_position_first() {

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
		add_filter( 'wpcf7_form_elements', array( $this, 'wpcf7_form_elements_filter' ), 100 );
	}

	/**
	 * @param $original_fields
	 *
	 * @return mixed
	 */
	public function wpcf7_form_elements_filter( $original_fields ) {

		$inject         = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_contact_form_7_consent_field', false, CT_Ultimate_GDPR_Controller_Services::ID );
		$position_first = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_contact_form_7_consent_field_position_first', false, CT_Ultimate_GDPR_Controller_Services::ID );
		$fields         = $original_fields;

		if ( $inject ) {

			if ( $position_first ) {
				$fields = ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-contact-form-7-consent-field', false ), false ) . $fields;
			} else {
				$fields .= ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-contact-form-7-consent-field', false ), false );
			}
		}

		return apply_filters( 'ct_ultimate_gdpr_service_contact_form_7_form_content', $fields, $original_fields, $inject, $position_first );
	}

	/**
	 * @return string
	 */
	protected function get_default_description() {
		return esc_html__( 'Contact Form 7 gathers data entered by users in forms', 'ct-ultimate-gdpr' );
	}
}