<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CT_Ultimate_GDPR_Controller_Admin
 *
 */
class CT_Ultimate_GDPR_Controller_Admin {

	/**
	 * @var string
	 */
	private $option_name = 'ct-ultimate-gdpr';

	/**
	 * CT_Ultimate_GDPR_Admin constructor.
	 */
	public function __construct() {

		$this->register_menu_pages();
		$this->register_option_fields();
		$this->register_styles();

		// set plugin compatibility with itself
		add_filter( 'ct_ultimate_gdpr_controller_plugins_compatible_ct-ultimate-gdpr/ct-ultimate-gdpr.php', '__return_true' );
		add_filter( 'ct_ultimate_gdpr_controller_plugins_collects_data_ct-ultimate-gdpr/ct-ultimate-gdpr.php', '__return_true' );

	}

	/**
	 * @return string
	 */
	public function get_plugin_domain() {
		return CT_Ultimate_GDPR::DOMAIN;
	}

	/**
	 * register_option_fields
	 */
	private function register_option_fields() {
		add_action( 'current_screen', array( $this, 'add_option_fields' ), 5 );
		add_filter( 'whitelist_options', array( $this, 'whitelist_options_filter' ) );
	}

	/**
	 * register_menu_pages
	 */
	private function register_menu_pages() {
		add_action( 'admin_menu', array( $this, 'add_menu_pages' ) );
	}

	/**
	 * Fix WP options bug. @see https://wordpress.stackexchange.com/questions/139660/error-options-page-not-found-on-settings-page-submission-for-an-oop-plugin
	 *
	 * @param $whitelist
	 *
	 * @return mixed
	 */
	public function whitelist_options_filter( $whitelist ) {

		global $wp_settings_fields;

		foreach ( $wp_settings_fields as $field_group_name => $field_group ) {

			if ( 0 === strpos( $field_group_name, $this->get_option_name() ) ) {

				// point section settings to main page option settings
				$whitelist[ $field_group_name ] = array( $field_group_name );

			}
		}

		return $whitelist;
	}

	/**
	 * @param $method_name
	 *
	 * @return string
	 */
	public function get_field_name( $method_name ) {

		$field_name = explode( '_', $method_name );
		array_splice( $field_name, 0, 2 );
		$field_name = implode( '_', $field_name );

		return $field_name;

	}

	/**
	 * @param $field_name
	 *
	 * @return string
	 */
	public function get_field_name_prefixed( $field_name ) {
		$field_name_array    = explode( '_', $field_name );
		$option_name_postfix = array_shift( $field_name_array );

		return $this->get_option_name() . "-$option_name_postfix" . "[$field_name]";

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 *
	 * @return array
	 */
	public function sanitize( $input ) {
		return $input;
	}

	/**
	 * @return string
	 */
	public function get_option_name() {
		return apply_filters( 'ct_ultimate_gdpr_admin_get_option_name', $this->option_name );
	}

	/**
	 * @param $option_name
	 * @param mixed $default
	 * @param string $section_id
	 * @param string $translate_type for wpml id translations
	 *
	 * @return mixed|string
	 */
	public function get_option_value( $option_name, $default = '', $section_id = '', $translate_type = '' ) {
		$section_id || $section_id = $this->get_current_section();
		$options = $this->get_options( $section_id );

		return isset( $options[ $option_name ] ) ? ( $translate_type ? ct_ultimate_gdpr_wpml_translate_id( $options[ $option_name ], $translate_type ) : $options[ $option_name ] ) : $default;
	}

	/**
	 * @param $option_name
	 * @param string $default
	 *
	 * @return string
	 */
	public function get_option_value_escaped( $option_name, $default = '' ) {
		return esc_attr( $this->get_option_value( $option_name, $default ) );
	}

	/**
	 *
	 */
	private function register_styles() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts_action' ) );
	}

	/**
	 * Enqueue script on our menu pages only
	 *
	 * @param $hook_suffix
	 */
	public function admin_enqueue_scripts_action( $hook_suffix ) {

		wp_register_style( 'ct-ultimate-gdpr-admin-style', ct_ultimate_gdpr_url( '/assets/css/admin.min.css' ), array(), ct_ultimate_gdpr_get_plugin_version() );
		wp_enqueue_style( 'ct-ultimate-gdpr-admin-style' );

		if ( false !== stripos( $hook_suffix, 'ct-ultimate-gdpr' ) ) {

			wp_register_script( 'ct-ultimate-gdpr-bootstrap-script', ct_ultimate_gdpr_url() . '/assets/js/bootstrap/bootstrap.min.js', array( 'jquery' ), ct_ultimate_gdpr_get_plugin_version() );
			wp_enqueue_script( 'ct-ultimate-gdpr-bootstrap-script' );
			wp_enqueue_script(
				'ct-ultimate-gdpr-admin',
				ct_ultimate_gdpr_url( '/assets/js/admin.min.js' ),
				array( 'jquery', 'wp-color-picker' ),
				ct_ultimate_gdpr_get_plugin_version(),
				true
			);
			wp_localize_script( 'ct-ultimate-gdpr-admin', 'ct_ultimate_gdpr_admin_translations',
				array(
					'enabled' => esc_html__( 'Enabled', 'ct-ultimate-gdpr' ),
					'enable' => esc_html__( 'Enable', 'ct-ultimate-gdpr' ),
					'disabled' => esc_html__( 'Disabled', 'ct-ultimate-gdpr' ),
					'disable' => esc_html__( 'Disable', 'ct-ultimate-gdpr' ),
				)
			);

			wp_enqueue_style( 'ct-ultimate-gdpr-bootstrap-style', ct_ultimate_gdpr_url( '/assets/css/bootstrap/bootstrap.min.css' ) );
			wp_enqueue_style( 'font-awesome', ct_ultimate_gdpr_url( '/assets/css/fonts/font-awesome/css/font-awesome.min.css' ) );
			wp_enqueue_style( 'wp-color-picker' );

		}

	}

	/**
	 * Add menu pages
	 */
	public function add_menu_pages() {

		add_menu_page(
			esc_html__( 'Ultimate GDPR', 'ct-ultimate-gdpr' ),
			esc_html__( 'Ultimate GDPR', 'ct-ultimate-gdpr' ),
			'manage_options',
			'ct-ultimate-gdpr',
			array( $this, 'render_menu_page' ),
			'none'
		);

	}

	/**
	 * @param $method
	 * @param $arguments
	 */
	public function __call( $method, $arguments ) {

		/** Render menu page callbacks */
		if ( 0 === strpos( $method, 'render_menu_page' ) ) {
			$this->render_menu_page( $method );

			return;
		}

		echo "$method not found";
	}

	/**
	 * @param $method_name
	 */
	public function render_menu_page( $method_name ) {

		$method_name = str_replace( 'render_menu_page_', '', $method_name );
		if ( $method_name ) {
			$method_name = str_replace( '_', '-', strtolower( $method_name ) );
		}

		$template_name = 'admin/admin-ct-ultimate-gdpr';
		if ( $method_name ) {
			$template_name .= "-$method_name";
		}

		$template_name = apply_filters( 'ct_ultimate_gdpr_admin_template_name', $template_name, $method_name );

		ct_ultimate_gdpr_locate_template( $template_name );

	}

	/**
	 * Add option fields to menu pages
	 */
	public function add_option_fields() {

		register_setting(
			$this->get_option_name(), // Option group
			$this->get_option_name(), // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

	}

	/**
	 * @param string $section_id
	 *
	 * @return array
	 */
	public function get_options( $section_id = '' ) {

		$option_name = $section_id ? $section_id : $this->get_option_name();
		$options     = get_option( $option_name, array() );

		return ! empty( $options ) ? $options : $this->load_default_options( $option_name );
	}

	/**
	 * @return string
	 */
	private function get_current_section() {

		if ( ! get_current_screen() ) {

			// get default option
			return $this->get_option_name();

		}

		$screen  = get_current_screen()->id;
		$section = explode( '_', $screen );
		$section = array_pop( $section );

		return $section;
	}

	/**
	 * @param $option_name
	 *
	 * @return array
	 */
	private function load_default_options( $option_name ) {

		$controller = CT_Ultimate_GDPR::instance()->get_controller_by_id( $option_name );
		$options    = $controller ? $controller->get_default_options() : array();
		update_option( $option_name, $options );

		return $options;
	}


}
