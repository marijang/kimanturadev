<?php

/**
 * Class CT_Ultimate_GDPR_Service_Quform
 */
class CT_Ultimate_GDPR_Service_Quform extends CT_Ultimate_GDPR_Service_Abstract {

	/**
	 * @return void
	 */
	public function init() {
		add_filter( 'ct_ultimate_gdpr_controller_plugins_compatible_quform/quform.php', '__return_true' );
		add_filter( 'ct_ultimate_gdpr_controller_plugins_collects_data_quform/quform.php', '__return_true' );
		add_filter( 'quform_pre_validate', array( $this, 'validate_consent' ), 10, 2 );
	}

	/**
	 * @return $this
	 */
	public function collect() {

		global $wpdb;

		$results = $wpdb->get_results(
			$wpdb->prepare( "
				SELECT e.*, ed.*
				FROM {$wpdb->prefix}quform_entries as e
				INNER JOIN {$wpdb->prefix}quform_entry_data as ed
				ON ed.entry_id = e.id
				WHERE ed.value = %s OR e.created_by = %d		
				",
				$this->user->get_email(),
				$this->user->get_id()
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
		return apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_name", 'Quform' );
	}

	/**
	 * @return bool
	 */
	public function is_active() {
		return class_exists( 'Quform_ClassLoader' );
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

		$result = $wpdb->query(
			$wpdb->prepare( "
				DELETE e, ed
				FROM {$wpdb->prefix}quform_entries as e
				INNER JOIN {$wpdb->prefix}quform_entry_data as ed
				ON ed.entry_id = e.id
				WHERE ed.value = %s OR e.created_by = %d		
				",
				$this->user->get_email(),
				$this->user->get_id()
			),
			ARRAY_A
		);

		if ( false === $result ) {
			throw new Exception( sprintf( esc_html__( 'There were problems forgetting data for user: %s', 'ct-ultimate-gdpr' ), $this->user->get_email() ) );
		}

	}

	/**
	 * @return mixed
	 */
	public function add_option_fields() {

		add_settings_section(
			'ct-ultimate-gdpr-services-quform_accordion-15', // ID
			esc_html__( $this->get_name(), 'ct-ultimate-gdpr' ), // Title
			null, // callback
			CT_Ultimate_GDPR_Controller_Services::ID // Page
		);


		/*add_settings_field(
			"services_{$this->get_id()}_header", // ID
			$this->get_name(), // Title
			'__return_empty_string', // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-quform_accordion-15' // Section
		);*/

        add_settings_field(
            "services_{$this->get_id()}_service_name", // ID
            sprintf( esc_html__( "[%s] Name", 'ct-ultimate-gdpr' ), $this->get_name() ), // Title
            array( $this, "render_name_field" ), // Callback
            CT_Ultimate_GDPR_Controller_Services::ID, // Page
            'ct-ultimate-gdpr-services-quform_accordion-15' // Section
        );

		add_settings_field(
			"services_{$this->get_id()}_description", // ID
			sprintf( esc_html__( "[%s] Description", 'ct-ultimate-gdpr' ), $this->get_name() ), // Title
			array( $this, "render_description_field" ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-quform_accordion-15' // Section
		);

		add_settings_field(
			"services_{$this->get_id()}_consent_field", // ID
			sprintf(
				esc_html__( "[%s] Inject consent checkbox to all forms", 'ct-ultimate-gdpr' ),
				$this->get_name()
			),
			array( $this, "render_field_services_{$this->get_id()}_consent_field" ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-quform_accordion-15' // Section
		);

		add_settings_field(
			"services_{$this->get_id()}_consent_field_position_first", // ID
			sprintf(
				esc_html__( "[%s] Inject consent checkbox as the first field instead of the last", 'ct-ultimate-gdpr' ),
				$this->get_name()
			),
			array( $this, "render_field_services_{$this->get_id()}_consent_field_position_first" ), // Callback
			CT_Ultimate_GDPR_Controller_Services::ID, // Page
			'ct-ultimate-gdpr-services-quform_accordion-15' // Section
		);

	}

	/**
	 *
	 */
	public function render_field_services_quform_consent_field() {

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
	public function render_field_services_quform_consent_field_position_first() {

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
		add_action( 'quform_pre_display', array( $this, 'add_form_fields' ) );
	}

	/**
	 *
	 * @param Quform_Form $form
	 *
	 * @return mixed
	 */
	public function add_form_fields( $form ) {

		$position_first = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( "services_{$this->get_id()}_consent_field_position_first", false, CT_Ultimate_GDPR_Controller_Services::ID );
		$inject         = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( "services_{$this->get_id()}_consent_field", false, CT_Ultimate_GDPR_Controller_Services::ID );

		// option set not to inject a checkbox
		if ( ! $inject ) {
			return $form;
		}

		$checkbox = new Quform_Element_Checkbox( $this->get_checkbox_id(), $form );

		$checkbox->setConfig( array(
			'label'    => ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-quform-consent-field', false ), false ),
			'required' => true,
		) );
		$checkbox->setOptions( array(
			array(
				'label' => ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-quform-consent-field', false ), false ),
				'value' => 'ok',
			)
		) );

		// add validator (only for visual red asterisk)
		$checkbox->addValidator( new Quform_Validator_Required( array() ) );

		if ( class_exists( 'ReflectionObject' ) ) {

			$elements = $form->getLastPage()->getElements();

			// add a checkbox as a first field
			if ( ! $elements || $position_first ) {
				$new_elements_order = array( $checkbox->getName() => $checkbox );
			}

			/** @var Quform_Element $element */
			foreach ( $elements as $element ) {

				// add a checkbox before a submit button
				if ( ! $position_first && $element->config( 'type' ) == 'submit' ) {
					$new_elements_order[ $checkbox->getName() ] = $checkbox;
				}

				$new_elements_order[ $element->getName() ] = $element;
			}

			// overwrite page's elements
			$page            = $form->getLastPage();
			$page_reflection = new ReflectionObject( $page );
			$property        = $page_reflection->getProperty( 'elements' );
			$property->setAccessible( true );
			$property->setValue( $page, $new_elements_order );
			$property->setAccessible( false );

			// overwrite form's last page
			$pages     = $form->getPages();
			$new_pages = count( $pages ) > 1 ?
				array_slice( $pages, 0, - 1 ) + array( $page->getName() => $page ) :
				array( $page->getName() => $page );

			$form_reflection = new ReflectionObject( $form );
			$property        = $form_reflection->getProperty( 'pages' );
			$property->setAccessible( true );
			$property->setValue( $form, $new_pages );
			$property->setAccessible( false );

		} else {

			// add a checkbox after submit button
			$form->getFirstPage()->addElement( $checkbox );

		}

		return apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_form_content", $form, $inject, $position_first );
	}

	/**
	 * @param $response
	 * @param Quform_Form $form
	 *
	 * @return array
	 */
	public function validate_consent( $response, $form ) {

		$inject = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( "services_{$this->get_id()}_consent_field", false, CT_Ultimate_GDPR_Controller_Services::ID );

		$key = "quform_" . $form->getCurrentPage()->getId() . "_" . $this->get_checkbox_id();

		if ( $inject && empty( $_POST[ $key ] ) ) {

			$response = array(
				'type'   => 'error',
				'error'  => array(),
				'errors' => array(
					$form->getCurrentPage()->getId() . "_" . $this->get_checkbox_id() =>
						ct_ultimate_gdpr_render_template( ct_ultimate_gdpr_locate_template( 'service/service-quform-consent-field-error-message', false ), false )
				),
				'page'   => $form->getCurrentPage()->getId(),
			);

		} elseif ( $inject ) {
			$this->log_user_consent();
		}

		return $response;
	}

	/**
	 * @return mixed|void
	 */
	private function get_checkbox_id() {
		return apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_form_content_id", 235423412 );
	}

	/**
	 * @return string
	 */
	protected function get_default_description() {
		return esc_html__( 'Quform gathers data entered by users in forms', 'ct-ultimate-gdpr' );
	}
}