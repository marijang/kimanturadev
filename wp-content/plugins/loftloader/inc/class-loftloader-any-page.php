<?php
if(!class_exists('LoftLoader_Any_Page') && !class_exists('LoftLoader_Any_Page_Filter')){
	class LoftLoader_Any_Page{
		public function __construct(){
			add_action('add_meta_boxes', array($this, 'register_meta_boxes'));
			add_action('save_post', array($this, 'save_meta'), 10, 3);

			$this->alter_loftloader();
		}
		// Register loftloader shortcode meta box
		public function register_meta_boxes(){
		    add_meta_box('loftloader_any_page_meta', esc_html__('LoftLoader Any Page Shortcode', 'loftloader-any-page'), array($this, 'metabox_callback'), 'page', 'advanced');
		}
		// Show meta box html
		public function metabox_callback($post){
		    $shortcode = get_post_meta($post->ID, 'loftloader_page_shortcode', true);
		    $html  = '<textarea name="loftloader_page_shortcode" style="width: 100%;" rows="4">' . str_replace('/\\"/g', '\\\\"', $shortcode) . '</textarea>';
		    $html .= '<input type="hidden" name="loftloader_any_page_nonce" value="' . wp_create_nonce('loftloader_any_page_nonce') . '" />';
		    echo $html;
		}
		// Save loftloader shortcode meta
		public function save_meta($post_id, $post, $update){
			if(empty($update) || ($post->post_type !== 'page')) return;

		    if((wp_verify_nonce($_REQUEST['loftloader_any_page_nonce'], 'loftloader_any_page_nonce') !== false) && ($post->post_type === 'page')){
		    	update_post_meta($post_id, 'loftloader_page_shortcode', sanitize_text_field($_REQUEST['loftloader_page_shortcode']));
		    }
		    return $_post_id;
		}

		// Initial LoftLoader Pro Shortcode actions
		private function alter_loftloader(){
			new LoftLoader_Any_Page_Filter();
		}
	}

	class LoftLoader_Any_Page_Filter{
		private $defaults = array(); 
		private $page_settings = array();
		private $page_enabled = false;
		private $is_customize = false;
		public function __construct(){
			add_filter('loftloader_get_loader_setting', array($this, 'get_loader_setting'), 10, 2);
			add_filter('loftloader_loader_enabled', array($this, 'loader_enabled'));
			add_action('loftloader_settings', array($this, 'loader_settings'));
		}
		/**
		* @description get the plugin settings
		*/
		public function loader_settings(){ 
			global $wp_customize, $loftloader_default_settings;
			$this->is_customize = isset($wp_customize) ? true : false;
			if(((is_front_page() || is_home()) && (get_option('show_on_front', false) == 'page')) || is_page()){
				$page = get_queried_object();
				if(($atts = $this->get_loader_attributes($page->ID)) !== false){
					$this->page_settings = array_merge($loftloader_default_settings, $atts);
					$this->page_enabled = ($atts['loftloader_main_switch'] === 'on');
				}
			}
		}
		/**
		* @description helper function to get shortcode attributes
		*/
		private function get_loader_attributes($page_id){
			$loader = get_post_meta($page_id, 'loftloader_page_shortcode', true);
			$loader = trim($loader);
			if(!empty($loader)){
				$loader = substr($loader, 1, -1);
				return shortcode_parse_atts($loader);
			}
			return false;
		}
		/**
		* Helper function to test whether show loftloader
		* @return boolean return true if loftloader enabled and display on current page, otherwise false
		*/
		public function loader_enabled(){
			return $this->page_enabled;
		}
		/**
		* Helper function get setting option
		*/
		public function get_loader_setting($setting_value, $setting_id){
			return ($this->page_enabled && !$this->is_customize && isset($this->page_settings[$setting_id])) ? $this->page_settings[$setting_id] : $setting_value;
		}
	}

	new LoftLoader_Any_Page();
}