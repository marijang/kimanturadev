<?php
/**
 * Custom Meta Box Boilerplate Plugin
 *
 * @package     ChristophHerr\TeamMemberBiographies
 * @author      marijang
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: B4B Post Addons
 * Plugin URI:  https://github.com/bit4bytes/b4b-post-addons
 * Description: B4B Post Addons
 * Version:     1.0.0
 * Author:      marijang
 * Author URI:  https://www.bit4bytes.com
 * Text Domain: b4b-post-products
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace ChristophHerr\CustomMetaBox;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

/**
 * Register a meta box using a class.
 */


class WPDocs_Custom_Meta_Box {
 
    public $prefix = 'custom_';
    public $custom_meta_fields = array();
    /**
     * Constructor.
     */
    public function __construct() {
        if ( is_admin() ) {
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
            $this->custom_meta_fields = $this->get_fields($this->prefix);
        }
 
    }

    function get_fields($prefix){
        $custom_meta_fields = array(
            array(
                'label'=> 'Linked products',
                'desc'  => 'Enter linked products.',
                'id'    => $prefix.'productIds',
                'name'  => $prefix.'productIds',
                'type'  => 'multiple',
                'options' => array (
                    'one' => array (
                        'label' => 'Option One',
                        'value' => 'one'
                    ),
                    'two' => array (
                        'label' => 'Option Two',
                        'value' => 'two'
                    ),
                    'three' => array (
                        'label' => 'Option Three',
                        'value' => 'three'
                    )
                )
            )
        );
        return $custom_meta_fields;
    }


    public function getProducts($id){
        // Get all products from WooCommerce DB Tables
        global $wpdb;
        $wrpp_tnme = $wpdb->prefix . 'posts';
        $wrpp_relateddProds = $wpdb->get_results( "SELECT post_title, ID 
            FROM $wrpp_tnme 
            WHERE post_type = 'product' 
            AND post_title != 'Auto Draft' 
            GROUP BY ID ASC", OBJECT );
        $test = array();
       // $values = get_post_meta($post_id, $id, true);
        foreach ($wrpp_relateddProds as $wrpp_relateddProd) {
				$wrpp_prodpostid = $wrpp_relateddProd->ID;
				$wrpp_prodposttitle = $wrpp_relateddProd->post_title;
                //$wrpp_prodposttitle = wrpp_xss_strip($wrpp_prodposttitle);
            $test[$wrpp_prodpostid] = array (
                'label' => $wrpp_prodposttitle,
                'value' => $wrpp_prodpostid,
             //   'selected' => in_array( $wrpp_prodpostid,  $values )?'Y':'N'
            );
        }
        return $test;
    }
 
    /**
     * Meta box initialization.
     */
    public function init_metabox() {
        add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
        //add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );
        add_action( 'save_post',      array( $this, 'save_custom_meta' ), 10, 2 );
        add_filter( 'wp_insert_post_data', array( $this,'my_validation_function') );
       // add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );
    }
 
    /**
     * Adds the meta box.
     */
    public function add_metabox() {
        add_meta_box(
            'my-meta-box',
            __( 'B4B Related Products', 'textdomain' ),
            //array( $this, 'render_metabox' ),
            array( $this, 'show_custom_meta_box' ),
            'post',
            'advanced',
            'default'
        );
 
    }

    public function add_admin_scripts( $hook ) {
        global $post;
        
        // There's probably a better way to check the screen...
        if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            if ( 'post' === $post->post_type ) {     
                wp_enqueue_script(  'chosen', get_template_directory_uri().'/js/chosen/chosen.jquery.min.js', array( 'jquery' ), '1.0' );
                wp_enqueue_style( 'chosen', get_template_directory_uri().'/js/chosen/chosen.css' );
            }
        }
    }
 


 // The Callback
public function show_custom_meta_box() {
    global $custom_meta_fields, $post;
    // Use nonce for verification
    wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
  //  echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
  ?>
  <script type="text/javascript">
  jQuery(document).ready(function($){
      $( '.chosen-multi' ).chosen({
    no_results_text: "Oops, nothing found!",
    width: "95%"
  });
  });
  </script>
  <?php
        // Begin the field table and loop
        echo '<table class="form-table">';
        foreach ($this->custom_meta_fields as $field) {
            // get value of this field if it exists for this post
            $meta = get_post_meta($post->ID, $field['id'], true);
  
            // begin a table row with
            echo '<tr>
                    <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                    <td>';
                    switch($field['type']) {
                        // text
                        case 'text':
                        echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
                            <br /><span class="description">'.$field['desc'].'</span>';
                        break;
                        // textarea
                        case 'textarea':
                        echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
                            <br /><span class="description">'.$field['desc'].'</span>';
                        break;
                        // checkbox
                        case 'checkbox':
                        echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
                            <label for="'.$field['id'].'">'.$field['desc'].'</label>';
                        break;
                        // select
                        case 'select':
                        echo '<select name="'.$field['id'].'" id="'.$field['id'].'" class="chosen-multi">';
                        foreach ($field['options'] as $option) {
                            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                        }
                        echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                        break;
                        case 'multiple':
                        echo '<select name="'.$field['name'].'[]" id="'.$field['id'].'" class="chosen-multi" multiple data-placeholder="Select one or more">';
                        $field['options'] = $this->getProducts($field['id']);
                        if (!is_array($meta)){
                            $meta = array();
                        }
                        foreach ($field['options'] as $option) {
                            echo '<option', in_array($option['value'],$meta) ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                            
                        }
                        echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                        break;
                        // case items will go here
                    } //end switch
            echo '</td></tr>';
        } // end foreach
        echo '</table>'; // end table
    }


    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox( $post_id, $post ) {
        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';
 
        // Check if nonce is set.
        if ( ! isset( $nonce_name ) ) {
            return;
        }
 
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
 
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
 
        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }
 
        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }
    }
    // Save the Data
    public function save_custom_meta($post_id) {
        global $custom_meta_fields;
        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';
         // Check if nonce is set.
         if ( ! isset( $nonce_name ) ) {
            return;
        }
 
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
        /*
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id))
                return $post_id;
            } elseif (!current_user_can('edit_post', $post_id)) {
                return $post_id;
        }
        */
        // loop through fields and save the data
        foreach ($this->custom_meta_fields as $field) {
       
            if ($field['type']=='multiple'){
              //  $field = $field['id'];
               // $old = get_post_meta($post_id, $field['id'], true);
                if( isset($_POST[$field['name']]) ) {
                    $speak = implode(',', $_POST[$field['name']]);
                    //update_post_meta($post_id, $field['id'], $speak);
                }
          

               // var_dump($_POST['custom_multiple']);
                 $sanitized_data = array();
                 $data = (array) $_POST[$field['name']];
                // var_dump($data);
                // die();
                 foreach ($data as $key => $value) {
                    $sanitized_data[ $key ] = (int)strip_tags( stripslashes( $value ) );
                }
                $new =  $sanitized_data; 
                update_post_meta($post_id, $field['id'], $new);
            }else{
         
                $old = get_post_meta($post_id, $field['id'], true);
                $new = $_POST[$field['id']];
                if ($new && $new != $old) {
                    update_post_meta($post_id, $field['id'], $new);
                } elseif ('' == $new && $old) {
                    delete_post_meta($post_id, $field['id'], $old);
                }
            }
           
           
        } // end foreach
    }

   
   

    public function my_validation_function( $data ) {
        // Don't want to do this on autosave
        return $data;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return $data;
        if ( $data['some_key'] != 'some_value' ||
            $_POST['some_meta_key'] != 'some_meta_value' ) {
            $data['post_status'] = 'draft'; // or whatever status to revert to
            add_filter( 'redirect_post_location', array ($this,'remove_message')); // remove the publish success message
        }
        return $data;
    }

    public function remove_message( $location ) {
        return remove_query_arg( 'message', $location);
    }
}
 
new WPDocs_Custom_Meta_Box();