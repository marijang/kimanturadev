<?php

/**
 * Class CT_Ultimate_GDPR_Service_WP_User
 */
class CT_Ultimate_GDPR_Service_WP_User extends CT_Ultimate_GDPR_Service_Abstract {

	/**
	 * CT_Ultimate_GDPR_Service_WP_User constructor.
	 */
	public function __construct() {
		parent::__construct();

		/** Change priority of register in order to load this service last due to forgetting feature */
		remove_filter( 'ct_ultimate_gdpr_load_services', array( $this, 'register' ) );
		add_filter( 'ct_ultimate_gdpr_load_services', array( $this, 'register' ), 20 );

	}

	/**
	 * @return $this
	 */
	public function collect() {

		$meta = get_user_meta( $this->user->get_id() );

		return $this->set_collected( $meta ? $meta : array() );

	}

	/**
	 * @return mixed|string
	 */
	public function get_name() {
		return esc_html__( "WP User Data", 'ct-ultimate-gdpr' );
	}

	/**
	 * @return mixed
	 */
	public function is_active() {
		return true;
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

		$result = wp_delete_user( $this->user->get_id(), $this->user->get_target_user_id() );

		if ( ! ( $result ) ) {
			throw new Exception( sprintf( esc_html__( "Could not delete user data for user: %s", 'ct-ultimate-gdpr' ), $this->user->get_email() ) );
		}
	}

	/**
	 * @return mixed
	 */
	public function add_option_fields() {

		add_settings_section(
			'ct-ultimate-gdpr-services-wpuser_accordion-21', // ID
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ), // Title
			null, // callback
			CT_Ultimate_GDPR_Controller_Services::ID // Page
		);

		add_settings_field(
			'breach_services_wp_user',
			esc_html__( 'WP User Data', 'ct-ultimate-gdpr' ),
			array( $this, 'render_field_breach_services' ),
			CT_Ultimate_GDPR_Controller_Breach::ID,
			'ct-ultimate-gdpr-breach_section-2'
		);

		add_settings_field(
			"services_{$this->get_id()}_header", // ID
			$this->get_name(), // Title
			'__return_empty_string', // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-wpuser_accordion-21' // Section
		);

		add_settings_field(
			"services_{$this->get_id()}_description", // ID
			esc_html__( "[WP User Data] Description", 'ct-ultimate-gdpr' ), // Title
			array( $this, "render_description_field" ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-wpuser_accordion-21' // Section
		);

		add_settings_field(
			"pseudo_services_{$this->get_id()}_name", // ID
			esc_html__( "[WP User Data] Pseudonymize first and last name", 'ct-ultimate-gdpr' ), // Title
			array( $this, "render_field_pseudonymization_services_{$this->get_id()}_name" ), // Callback
			CT_Ultimate_GDPR_Controller_Pseudonymization::ID, // Page
			CT_Ultimate_GDPR_Controller_Pseudonymization::ID // Section
		);

		add_settings_field(
			"services_{$this->get_id()}_header", // ID
			$this->get_name(), // Title
			'__return_empty_string', // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-wpuser_accordion-21' // Section
		);

		add_settings_field(
			'services_wp_comments_network_signup_consent_field', // ID
			esc_html__( '[WP User] Inject consent checkbox to User network signup form fields', 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_wp_comments_network_signup_consent_field' ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-wpuser_accordion-21' // Section
		);

		add_settings_field(
			'services_wp_comments_register_consent_field', // ID
			esc_html__( '[WP User] Inject consent checkbox to User register form fields', 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_wp_comments_register_consent_field' ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-wpuser_accordion-21'// Section
		);

		add_settings_field(
			'services_wp_comments_lost_password_consent_field', // ID
			esc_html__( '[WP User] Inject consent checkbox to lost password form fields', 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_wp_comments_lost_password_consent_field' ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-wpuser_accordion-21' // Section
		);

	}

	/**
	 *
	 */
	public function render_field_services_wp_comments_register_consent_field() {

		$admin      = CT_Ultimate_GDPR::instance()->get_admin_controller();
		$field_name = $admin->get_field_name( __FUNCTION__ );
		$checked    = $admin->get_option_value( $field_name, '' ) ? 'checked' : '';
		printf(
			"<input class='ct-ultimate-gdpr-field' type='checkbox' id='%s' name='%s' value='%s' %s />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$this->get_id(),
			$checked
		);

	}

	/**
	 *
	 */
	public function render_field_services_wp_comments_lost_password_consent_field() {

		$admin      = CT_Ultimate_GDPR::instance()->get_admin_controller();
		$field_name = $admin->get_field_name( __FUNCTION__ );
		$checked    = $admin->get_option_value( $field_name, '' ) ? 'checked' : '';
		printf(
			"<input class='ct-ultimate-gdpr-field' type='checkbox' id='%s' name='%s' value='%s' %s />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$this->get_id(),
			$checked
		);

	}

	/**
	 *
	 */
	public function render_field_services_wp_comments_network_signup_consent_field() {

		$admin      = CT_Ultimate_GDPR::instance()->get_admin_controller();
		$field_name = $admin->get_field_name( __FUNCTION__ );
		$checked    = $admin->get_option_value( $field_name, '' ) ? 'checked' : '';
		printf(
			"<input class='ct-ultimate-gdpr-field' type='checkbox' id='%s' name='%s' value='%s' %s />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$this->get_id(),
			$checked
		);

	}

	/**
	 *
	 */
	public function render_field_pseudonymization_services_wp_user_name() {

		$admin      = CT_Ultimate_GDPR::instance()->get_admin_controller();
		$field_name = $admin->get_field_name( __FUNCTION__ );
		$checked    = $admin->get_option_value( $field_name, '' ) ? 'checked' : '';
		printf(
			"<input class='ct-ultimate-gdpr-field' type='checkbox' id='%s' name='%s' value='%s' %s />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$this->get_id(),
			$checked
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
	 * @param array $recipients
	 *
	 * @return array
	 */
	public function breach_recipients_filter( $recipients ) {
		return array_merge( $recipients, $this->get_all_users_emails() );
	}

	/**
	 * @return array
	 */
	private function get_all_users_emails() {

		$users_array = array();

		$users = get_users( array(
			'fields' => array( 'user_email' ),
		) );

		foreach ( $users as $user ) {

			if ( $user->user_email ) {
				$users_array[] = $user->user_email;
			}

		}

		return $users_array;

	}

	/**
	 * @return void
	 */
	public function init() {
		add_filter( 'ct_ultimate_gdpr_controller_pseudonymization_get_data_to_encrypt_meta_keys', array(
			$this,
			'add_user_meta_keys_to_encrypt'
		) );
		add_filter( 'ct_ultimate_gdpr_controller_pseudonymization_updated_user_meta_to_encrypt', array(
			$this,
			'add_user_meta_keys_to_encrypt'
		) );
		add_filter( 'wpmu_validate_user_signup', array( $this, 'wpmu_validate_filter' ) );
		add_filter( 'registration_errors', array( $this, 'registration_errors_filter' ) );
		add_filter( 'lostpassword_post', array( $this, 'lost_password_errors_filter' ) );
		add_action( 'register_form', array( $this, 'lost_password_add_form_fields' ) );
		add_action( 'lostpassword_form', array( $this, 'register_add_form_fields' ) );
		add_action( 'signup_extra_fields', array( $this, 'signup_add_form_fields' ) );


	}

	public function lost_password_errors_filter( $errors ) {

		$inject = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_wp_comments_lost_password_consent_field', false, CT_Ultimate_GDPR_Controller_Services::ID );

		if ( $inject && ! ct_ultimate_gdpr_get_value( 'ct-ultimate-gdpr-consent-field', $_REQUEST ) ) {

			/** @var WP_Error $errors */
			$errors->add( 'registerfail', esc_html__( 'Consent is required', 'ct-ultimate-gdpr' ) );

		}

		return $errors;

	}

	/**
	 * @param WP_Error $errors
	 *
	 * @return mixed
	 */
	public function registration_errors_filter( $errors ) {

		$inject = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_wp_comments_register_consent_field', false, CT_Ultimate_GDPR_Controller_Services::ID );

		if ( $inject && ! ct_ultimate_gdpr_get_value( 'ct-ultimate-gdpr-consent-field', $_REQUEST ) ) {

			/** @var WP_Error $errors */
			$errors->add( 'registerfail', esc_html__( 'Consent is required', 'ct-ultimate-gdpr' ) );

		}

		return $errors;
	}

	/**
	 * @param $result
	 *
	 * @return mixed
	 */
	public function wpmu_validate_filter( $result ) {

		$inject = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_wp_comments_network_signup_consent_field', false, CT_Ultimate_GDPR_Controller_Services::ID );

		if ( $inject && ! ct_ultimate_gdpr_get_value( 'ct-ultimate-gdpr-consent-field', $_REQUEST ) ) {

			/** @var WP_Error $errors */
			$errors = $result['errors'];
			$errors->add( 'user_name', __( 'Consent is required', 'ct-ultimate-gdpr' ) );

		}

		return $result;
	}

	/**
	 * @return mixed
	 */
	public function front_action() {
	}

	/**
	 *
	 */
	public function signup_add_form_fields() {

		$inject = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_wp_comments_network_signup_consent_field', false, CT_Ultimate_GDPR_Controller_Services::ID );

		if ( $inject ) {
			ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-wp-user-consent-field', false ), true );
		}
	}

	/**
	 *
	 */
	public function lost_password_add_form_fields() {

		$inject = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_wp_comments_lost_password_consent_field', false, CT_Ultimate_GDPR_Controller_Services::ID );

		if ( $inject ) {
			ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-wp-user-consent-field', false ), true );
		}
	}

	/**
	 *
	 */
	public function register_add_form_fields() {

		$inject = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( 'services_wp_comments_register_consent_field', false, CT_Ultimate_GDPR_Controller_Services::ID );

		if ( $inject ) {
			ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-wp-user-consent-field', false ), true );
		}
	}

	/**
	 * @return string
	 */
	protected function get_default_description() {
		return esc_html__( 'WordPress user data stored as user meta data in database', 'ct-ultimate-gdpr' );
	}

	/**
	 * @param $keys
	 *
	 * @return mixed
	 */
	public function add_user_meta_keys_to_encrypt( $keys ) {

		if ( CT_Ultimate_GDPR::instance()
		                     ->get_admin_controller()
		                     ->get_option_value(
			                     "pseudonymization_services_{$this->get_id()}_name",
			                     '',
			                     CT_Ultimate_GDPR_Controller_Pseudonymization::ID
		                     )
		) {
			array_push( $keys, 'first_name', 'last_name' );
		}

		return $keys;

	}

}