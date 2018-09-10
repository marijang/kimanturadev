<?php

/**
 * Class CT_Ultimate_GDPR_Service_Flamingo
 */
class CT_Ultimate_GDPR_Service_Flamingo extends CT_Ultimate_GDPR_Service_Abstract {

	/**
	 * @return void
	 */
	public function init() {
		add_filter( 'ct_ultimate_gdpr_controller_plugins_compatible_flamingo/flamingo.php', '__return_true' );
		add_filter( 'ct_ultimate_gdpr_controller_plugins_collects_data_flamingo/flamingo.php', '__return_true' );
	}

	/**
	 * @return $this
	 */
	public function collect() {

		global $wpdb;

		$query = $wpdb->prepare( "
				SELECT post_content FROM {$wpdb->posts}
				WHERE post_content LIKE %s
				AND post_type = 'flamingo_inbound'
			",
			"%" . $this->user->get_email() . "%"
		);

		$collected = $wpdb->get_results( $query, ARRAY_A );

		return $this->set_collected( $collected );
	}

	/**
	 * @return mixed
	 */
	public function get_name() {
		return apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_name", 'Flamingo' );
	}

	/**
	 * @return bool
	 */
	public function is_active() {
		return function_exists( 'flamingo_init' );
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
		$query = $wpdb->prepare( "
				DELETE FROM {$wpdb->posts}
				WHERE post_content LIKE %s
				AND post_type = 'flamingo_inbound'
			",
			"%" . $this->user->get_email() . "%"
		);
		$wpdb->query( $query );

	}

	/**
	 * @return mixed
	 */
	public function add_option_fields() {


		add_settings_section(
			'ct-ultimate-gdpr-services-flamingo_accordion-7', // ID
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ), // Title
			null, // callback
			CT_Ultimate_GDPR_Controller_Services::ID // Page
		);

		/*add_settings_field(
			"services_{$this->get_id()}_header", // ID
			$this->get_name(), // Title
			'__return_empty_string', // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-flamingo_accordion-7'// Section
		);*/

        add_settings_field(
            "services_{$this->get_id()}_service_name", // ID
            sprintf( esc_html__( "[%s] Name", 'ct-ultimate-gdpr' ), $this->get_name() ), // Title
            array( $this, "render_name_field" ), // Callback
            CT_Ultimate_GDPR_Controller_Services::ID, // Page
            'ct-ultimate-gdpr-services-flamingo_accordion-7'// Section
        );

		add_settings_field(
			"services_{$this->get_id()}_description", // ID
			sprintf( esc_html__( "[%s] Description", 'ct-ultimate-gdpr' ), $this->get_name() ), // Title
			array( $this, "render_description_field" ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-flamingo_accordion-7'// Section
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
		return esc_html__( 'Flamingo gathers data entered by users in CF7 forms', 'ct-ultimate-gdpr' );
	}
}