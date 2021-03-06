<?php

/**
 * Class CT_Ultimate_GDPR_Controller_Services
 */
class CT_Ultimate_GDPR_Controller_Services extends CT_Ultimate_GDPR_Controller_Abstract {

	/**
	 *
	 */
	const ID = 'ct-ultimate-gdpr-services';

	/**
	 * Get unique controller id (page name, option id)
	 */
	public function get_id() {
		return self::ID;
	}

	/**
	 * Init after construct
	 */
	public function init() {
		if ( function_exists( 'acf' ) ) {
			add_filter( 'ct_ultimate_gdpr_cookie_get_cookies_to_block', array( $this, 'cookies_to_block_filter' ) );
			add_filter( 'ct_ultimate_gdpr_controller_cookie_script_blacklist', array(
				$this,
				'script_blacklist_filter'
			) );
		}
		$this->create_ct_ugdpr_service_post_type();
	}

	/**
	 * @return bool|mixed
	 */
	private function is_request_consents_log() {
		return ct_ultimate_gdpr_get_value( 'ct-ultimate-gdpr-log', $this->get_request_array() );
	}

	/**
	 * Download logs of all user consents
	 */
	private function download_consents_log() {

		$rendered = $this->logger->render_logs( $this->logger->get_logs() );

		// download
		header( "Content-Type: application/octet-stream" );
		header( "Content-Disposition: attachment; filename='{$this->get_id()}-logs.txt'" );
		echo $rendered;
		exit;

	}

	/**
	 * Do actions on frontend
	 */
	public function front_action() {
		$services = CT_Ultimate_GDPR_Model_Services::instance()->get_services( array(),'active' );

		/** @var CT_Ultimate_GDPR_Service_Abstract $service */
		foreach ( $services as $service ) {
			$service->front_action();
		}
	}

	/**
	 * Do actions in admin (general)
	 */
	public function admin_action() {
	}

	/**
	 * Do actions on current admin page
	 */
	protected function admin_page_action() {

		if ( $this->is_request_consents_log() ) {
			$this->download_consents_log();
		}

	}

	/**
	 * Get view template string
	 * @return string
	 */
	public function get_view_template() {
		return 'admin/admin-services';
	}

	/**
	 * Add menu page (if not added in admin controller)
	 */
	public function add_menu_page() {
		add_submenu_page(
			'ct-ultimate-gdpr',
			esc_html__( 'Services', 'ct-ultimate-gdpr' ),
			esc_html__( 'Services', 'ct-ultimate-gdpr' ),
			'manage_options',
			'ct-ultimate-gdpr-services',
			array( $this, 'render_menu_page' )
		);
	}

	/**
	 * @return mixed
	 */
	public function add_option_fields() {

		/* Section */

		add_settings_section(
			'ct-ultimate-gdpr-services', // ID
			esc_html__( 'Services options', 'ct-ultimate-gdpr' ), // Title
			null, // callback
			$this->get_id() // Page
		);

		add_settings_section(
			'ct-ultimate-gdpr-services_accordion-1', // ID
			esc_html__( 'Services options', 'ct-ultimate-gdpr' ), // Title
			null, // callback
			$this->get_id() // Page
		);

		add_settings_section(
			'ct-ultimate-gdpr-services_accordion-2', // ID
			esc_html__( 'Services options', 'ct-ultimate-gdpr' ), // Title
			null, // callback
			$this->get_id() // Page
		);

		/* Section fields */

		// options will be generated by services

		add_settings_field(
			'services_recaptcha_key', // ID
			esc_html__( "Recaptcha key (for myaccount shortcode submissions)", 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_recaptcha_key' ), // Callback
			$this->get_id(), // Page
			'ct-ultimate-gdpr-services' // Section
		);

		add_settings_field(
			'services_recaptcha_secret', // ID
			esc_html__( "Recaptcha secret key (for myaccount shortcode submissions)", 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_recaptcha_secret' ), // Callback
			$this->get_id(), // Page
			'ct-ultimate-gdpr-services' // Section
		);

		add_settings_field(
			'services_logger_pseudonymized_ip', // ID
			esc_html__( "When logging consents of users who did not accept Privacy Policy, log their IP", 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_logger_pseudonymized_ip' ), // Callback
			$this->get_id(), // Page
			'ct-ultimate-gdpr-services' // Section
		);

		add_settings_field(
			'services_logger_pseudonymized_user_agent', // ID
			esc_html__( "When logging consents of users who did not accept Privacy Policy, log their User Agent", 'ct-ultimate-gdpr' ), // Title
			array( $this, 'render_field_services_logger_pseudonymized_user_agent' ), // Callback
			$this->get_id(), // Page
			'ct-ultimate-gdpr-services' // Section
		);

	}

	/**
	 *
	 */
	public function render_field_services_recaptcha_key() {

		$admin = CT_Ultimate_GDPR::instance()->get_admin_controller();

		$field_name = $admin->get_field_name( __FUNCTION__ );
		printf(
			"<input type='text' id='%s' name='%s' value='%s' />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$admin->get_option_value_escaped( $field_name, '' )
		);

	}

	/**
	 *
	 */
	public function render_field_services_recaptcha_secret() {

		$admin = CT_Ultimate_GDPR::instance()->get_admin_controller();

		$field_name = $admin->get_field_name( __FUNCTION__ );
		printf(
			"<input type='text' id='%s' name='%s' value='%s' />",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$admin->get_option_value_escaped( $field_name, '' )
		);

	}

	/**
	 *
	 */
	public function render_field_services_logger_pseudonymized_ip() {

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
	public function render_field_services_logger_pseudonymized_user_agent() {

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
	 * @return array
	 */
	public function get_default_options() {

		return apply_filters( "ct_ultimate_gdpr_controller_{$this->get_id()}_default_options", array() );

	}

	/**
	 * @param $cookies
	 *
	 * @return mixed
	 */
	public function cookies_to_block_filter( $cookies ) {
		$cookies_to_block = array();
		$args             = array( 'post_type' => 'ct_ugdpr_service', 'numberposts' => - 1 );
		$posts            = get_posts( $args );
		foreach ( $posts as $post ) {
			$is_active = get_post_meta( $post->ID, 'is_active', true );
			if ( ! $is_active ) {
				continue;
			}
			$cookie_names_str = get_post_meta( $post->ID, 'cookie_name', true );
			$cookie_name      = array_map( 'trim', explode( ',', $cookie_names_str ) );
			$cookie_type      = get_post_meta( $post->ID, 'type_of_cookie', true );
			if ( isset( $cookies_to_block[ $cookie_type ] ) ) {
				$cookies_to_block[ $cookie_type ] = array_merge( $cookies_to_block[ $cookie_type ], $cookie_name );
			} else {
				$cookies_to_block[ $cookie_type ] = $cookie_name;
			}
			$cookies_to_block = apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_cookies_to_block", $cookies_to_block );

			if ( isset( $cookies[ $cookie_type ] ) && is_array( $cookies[ $cookie_type ] ) && isset( $cookies_to_block[ $cookie_type ] ) && is_array( $cookies_to_block[ $cookie_type ] ) ) {
				$cookies[ $cookie_type ] = array_merge( $cookies[ $cookie_type ], $cookies_to_block[ $cookie_type ] );
			}

		}
		array_filter( $cookies );

		return $cookies;

	}

	/**
	 * @param $scripts
	 *
	 * @return mixed
	 */
	public function script_blacklist_filter( $scripts ) {

		if ( ! function_exists( 'acf' ) ) {
			return $scripts;
		}

		$scripts_to_block = array();
		$args             = array( 'post_type' => 'ct_ugdpr_service', 'numberposts' => - 1 );
		$posts            = get_posts( $args );
		foreach ( $posts as $post ) {
			$is_active = get_post_meta( $post->ID, 'is_active', true );
			if ( ! $is_active ) {
				continue;
			}
			$script_names_str = get_post_meta( $post->ID, 'script_name', true );
			$script_name      = array_map( 'trim', explode( ',', $script_names_str ) );
			$script_type      = get_post_meta( $post->ID, 'type_of_cookie', true );
			if ( isset( $scripts_to_block[ $script_type ] ) ) {
				$scripts_to_block[ $script_type ] = array_merge( $scripts_to_block[ $script_type ], $script_name );
			} else {
				$scripts_to_block[ $script_type ] = $script_name;
			}
			$scripts_to_block = apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_script_blacklist", $scripts_to_block );
			if ( isset( $scripts[ $script_type ] ) && is_array( $scripts[ $script_type ] ) && isset( $scripts_to_block[ $script_type ] ) && is_array( $scripts_to_block[ $script_type ] ) ) {
				$scripts[ $script_type ] = array_merge( $scripts[ $script_type ], $scripts_to_block[ $script_type ] );
			}
		}

		return $scripts;
	}

	/**
	 *
	 */
	public function create_ct_ugdpr_service_post_type() {
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'               => _x( 'Services', 'Post Type General Name', 'ct-ultimate-gdpr' ),
			'singular_name'      => _x( 'Services', 'Post Type Singular Name', 'ct-ultimate-gdpr' ),
			'menu_name'          => __( 'Services', 'ct-ultimate-gdpr' ),
			'parent_item_colon'  => __( 'Parent Services', 'ct-ultimate-gdpr' ),
			'all_items'          => __( 'All Services', 'ct-ultimate-gdpr' ),
			'view_item'          => __( 'View Service', 'ct-ultimate-gdpr' ),
			'add_new_item'       => __( 'Add New Service', 'ct-ultimate-gdpr' ),
			'add_new'            => __( 'Add New', 'ct-ultimate-gdpr' ),
			'edit_item'          => __( 'Edit Service', 'ct-ultimate-gdpr' ),
			'update_item'        => __( 'Update Service', 'ct-ultimate-gdpr' ),
			'search_items'       => __( 'Search Services', 'ct-ultimate-gdpr' ),
			'not_found'          => __( 'Not Found', 'ct-ultimate-gdpr' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'ct-ultimate-gdpr' ),
		);

		// Set other options for Custom Post Type
		$args = array(
			'label'               => __( 'services', 'ct-ultimate-gdpr' ),
			'description'         => __( 'Services', 'ct-ultimate-gdpr' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'custom-fields', 'revisions' ),
			'hierarchical'        => true,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => array( 'with_front' => false ),
			'capability_type'     => 'page',
		);

		// Registering your Custom Post Type
		register_post_type( 'ct_ugdpr_service', $args );

	}

}