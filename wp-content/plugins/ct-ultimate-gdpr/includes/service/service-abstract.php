<?php

/**
 * Interface CT_Ultimate_GDPR_Service_Abstract
 */
abstract class CT_Ultimate_GDPR_Service_Abstract implements CT_Ultimate_GDPR_Service_Interface {

	/**
	 * Collected data array
	 *
	 * @var array
	 */
	protected $collected = array();

	/**
	 * User set by controllers
	 *
	 * @var CT_Ultimate_GDPR_Model_User
	 */
	protected $user;

	/**
	 * Group object to compare privacy levels
	 *
	 * @var CT_Ultimate_GDPR_Model_Group
	 */
	protected $group;

	/**
	 * Run on init
	 * @return void
	 */
	abstract public function init();

	/**
	 * Collect data of a specific user
	 *
	 * @return $this
	 */
	abstract public function collect();

	/**
	 * Get service name
	 *
	 * @return mixed
	 */
	abstract public function get_name();

	/**
	 * Is it active, eg. whether related plugin is enabled. Used mainly by Data Access controller
	 *
	 * @return bool
	 */
	abstract public function is_active();

	/**
	 * Can data be forgotten by this service?
	 *
	 * @return bool
	 */
	abstract public function is_forgettable();

	/**
	 * Forget specific user data
	 *
	 * @throws Exception
	 * @return void
	 */
	abstract public function forget();

	/**
	 * Add admin option fields
	 *
	 * @return mixed
	 */
	abstract public function add_option_fields();

	/**
	 * Do optional action on front
	 *
	 * @return mixed
	 */
	abstract public function front_action();

	/**
	 * Get group levels of this service
	 *
	 * @return array
	 */
	public function get_group_levels() {
		return apply_filters( "ct_ultimate_gdpr_service_{$this->get_id()}_group_levels", array( CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE ) );
	}

	/**
	 * Set group object and level
	 */
	public function set_group() {
		$this->group = new CT_Ultimate_GDPR_Model_Group;
		$this->group->add_levels( $this->get_group_levels() );
	}

	/**
	 * CT_Ultimate_GDPR_Service_Abstract constructor.
	 */
	public function __construct() {

		add_action( 'current_screen', array( $this, 'add_option_fields' ), 20 );

		if ( $this->is_active() ) {

			add_filter( 'ct_ultimate_gdpr_load_services', array( $this, 'register' ) );
			add_filter( "ct_ultimate_gdpr_breach_recipients_{$this->get_id()}", array(
				$this,
				"breach_recipients_filter"
			) );
			$this->set_group();
		}

		$this->init();
	}

	/** Dequeue scripts with specified content (external cookies)
	 *
	 * @param array $scripts
	 * @param bool $force
	 *
	 * @return array
	 */
	public function script_blacklist_filter( $scripts, $force = false ) {
		return $scripts;
	}

	/**
	 * Meant to be extended. Lists all cookies (or just prefixes) this service is using.
	 *
	 * @param $cookies
	 * @param bool $force
	 *
	 * @return mixed
	 */
	public function cookies_to_block_filter( $cookies, $force = false ) {
		return $cookies;
	}

	/**
	 * Render field for setting custom service description
	 */
	public function render_description_field() {

		$admin      = CT_Ultimate_GDPR::instance()->get_admin_controller();
		$field_name = "services_{$this->get_id()}_description";

		printf(
			"<textarea class='ct-ultimate-gdpr-field' id='%s' name='%s' rows='10' cols='100'>%s</textarea>",
			$admin->get_field_name( __FUNCTION__ ),
			$admin->get_field_name_prefixed( $field_name ),
			$admin->get_option_value_escaped( $field_name, $this->get_description() )
		);

	}

	/**
	 * Simple render of collected user data
	 *
	 * @param bool $human_readable
	 *
	 * @return string
	 */
	public function render_collected( $human_readable = false ) {

		$return = '';

		if ( ! empty( $this->collected ) ) {

			if ( $human_readable ) {

				$return = $this->render_human_data( $this->collected );

			} else {

				$return = ct_ultimate_gdpr_json_encode( $this->collected );

			}

		}

		return apply_filters( 'ct_ultimate_gdpr_service_render_collected', $return, $this->collected, $human_readable, $this->get_id() );
	}

	protected function render_human_data( $data ) {

		$return = '';

		if ( is_array( $data ) || is_object( $data ) ) {

			foreach ( $data as $item_key => $item ) {

				if ( is_array( $item ) || is_object( $item ) ) {

					if ( is_array( $item ) && isset( $item[0] ) && ! is_array( $item[0] ) ) {

						$return .= "$item_key: $item[0]" . PHP_EOL;

					} else {

						$return .= $this->render_human_data( $item );

					}

				} else {

					$return .= "$item_key: $item" . PHP_EOL;

				}

			}

		} else {

			$return .= $data;

		}

		return $return ;

	}

	/**
	 * Get service description
	 *
	 * @return string
	 */
	public function get_description() {

		$user_description = CT_Ultimate_GDPR::instance()->get_admin_controller()->get_option_value( "services_{$this->get_id()}_description", '', CT_Ultimate_GDPR_Controller_Services::ID );

		return $user_description ? $user_description : $this->get_default_description();
	}

	/**
	 * Get service id (based on class name)
	 *
	 * @return string
	 */
	public function get_id() {
		return strtolower( str_replace( 'CT_Ultimate_GDPR_Service_', '', get_called_class() ) );
	}

	/**
	 * Get default service description
	 *
	 * @return string
	 */
	protected function get_default_description() {
		return '';
	}

	/**
	 * Register add service to the collection
	 *
	 * @param $services
	 *
	 * @return array
	 */
	public function register( $services ) {

		if ( $this->is_active() ) {
			$services[] = $this;
		}

		return $services;
	}

	/**
	 * Set target user
	 *
	 * @param CT_Ultimate_GDPR_Model_User $user
	 *
	 * @return $this
	 */
	public function set_user( $user ) {

		$this->user = $user;

		return $this;

	}

	/**
	 * Set collected data
	 *
	 * @param array $collected
	 *
	 * @return $this
	 */
	protected function set_collected( $collected ) {
		$this->collected = apply_filters( 'ct_ultimate_gdpr_service_collected', $collected, $this->get_id(), $this->user );

		return $this;
	}

	/**
	 * Add breach recipients filter
	 *
	 * @param array $recipients
	 *
	 * @return array
	 */
	public function breach_recipients_filter( $recipients ) {
		return $recipients;
	}
}