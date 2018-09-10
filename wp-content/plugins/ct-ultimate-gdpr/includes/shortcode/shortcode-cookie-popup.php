<?php

/**
 * Class CT_Ultimate_GDPR_Shortcode_Cookie_Popup
 */
class CT_Ultimate_GDPR_Shortcode_Cookie_Popup {

	/**
	 * @var string
	 */
	public static $tag = 'ultimate_gdpr_cookie_popup';

	/**
	 * CT_Ultimate_GDPR_Shortcode_Cookie_Popup constructor.
	 */
	public function __construct() {
		add_shortcode( self::$tag, array( $this, 'process' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts_action' ) );
	}

	/**
	 *
	 */
	public function wp_enqueue_scripts_action() {

		if ( get_post() && false !== strpos( get_post()->post_content, "[{$this::$tag}]" ) ) {

			CT_Ultimate_GDPR::instance()
			                ->get_controller_by_id( CT_Ultimate_GDPR_Controller_Cookie::ID )
			                ->wp_enqueue_scripts_action( true );

			wp_localize_script( 'ct-ultimate-gdpr-cookie-popup', 'ct_ultimate_gdpr_cookie_shortcode_popup',
				array(
					'always_visible' => true,
				)
			);

		}
	}


	/**
	 * Shortcode callback
	 *
	 * @param $atts
	 *
	 * @param string $content
	 *
	 * @return string
	 */
	public function process( $atts, $content = '' ) {

		return $this->render( $content );

	}

	/**
	 * Render shortcode template
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function render( $content ) {

		$options = array_merge(
			CT_Ultimate_GDPR::instance()->get_controller_by_id( CT_Ultimate_GDPR_Controller_Cookie::ID )->get_default_options(),
			CT_Ultimate_GDPR::instance()->get_admin_controller()->get_options( CT_Ultimate_GDPR_Controller_Cookie::ID ),
			array( 'cookie_modal_always_visible' => true ),
			array( 'content' => $content )
		);

		ob_start();
		ct_ultimate_gdpr_locate_template(
			"cookie-group-popup",
			true,
			$options
		);

		return ob_get_clean();

	}
}