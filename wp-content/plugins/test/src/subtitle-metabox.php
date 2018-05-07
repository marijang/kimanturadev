<?php
/**
 * Custom Meta Box
 *
 * @package     ChristophHerr\CustomMetaBox\Src
 * @since       1.0.0
 * @author      christophherr
 * @link        https://www.christophherr.com
 * @license     GNU General Public License 2.0+
 */

namespace ChristophHerr\CustomMetaBox\Src;

use WP_Post;
add_action( 'admin_menu', __NAMESPACE__ . '\register_subtitle_meta_box' );
/**
 * Register the meta box.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_subtitle_meta_box() {
	add_meta_box(
		'b4bwpp_meta_box_addons',
		__( 'B4B Post addons', 'b4b-post-addons' ),
		__NAMESPACE__ . '\render_meta_box',
		'post'
	);
}

/**
 * Render the meta box
 *
 * @since 1.0.0
 *
 * @param WP_Post $post Instance of the post for this meta box.
 * @param array   $meta_box Array of meta box arguments.
 *
 * @return void
 */
function render_meta_box( WP_Post $post, array $meta_box ) {
	// Security with a nonce.
	wp_nonce_field( 'custom_meta_box_save', 'custom_meta_box_nonce' );

	// Get the metadata.
	$productIds      = get_post_meta( $post->ID, 'productIds', true );
	$products        = get_products();
	//$show_subtitle = get_post_meta( $post->ID, 'show_subtitle', true );

	// Do any processing that needs to be done.

	// Load the view file.
	include B4BWPP_META_BOX_URL . 'src/views/subtitle.php';
}

add_action( 'save_post', __NAMESPACE__ . '\save_meta_box', 10, 2 );
/**
 * Save changes to the custom meta box.
 *
 * @since 1.0.0
 *
 * @param integer  $post_id Post ID.
 * @param stdClass $post Post object.
 *
 * @return bool
 */
function save_meta_box( $post_id, $post ) {
	// Make sure it's the right metabox.
	if ( ! array_key_exists( 'b4b_post_addons', $_POST ) ) {
		return false;
	}

	// Make sure the nonce matches.
	if ( ! wp_verify_nonce( $_POST['b4b_post_addons_nonce'], 'b4b_post_addons_save' ) ) {
		return false;
	}

	// Merge with defaults.
	$metadata = wp_parse_args(
		$_POST['b4b_post_addons'],
		array(
			'productIds'      => '',
			//'show_subtitle' => 0,
		)
	);

	// Loop through the custom fields and update the `wp_postmeta` database.
	foreach ( $metadata as $meta_key => $value ) {
		if ( ! $value ) {
			delete_post_meta( $post_id, $meta_key );
			continue;
		}
		if ( 'productIds' === $meta_key ) {
			$value = sanitize_text_field( $value );
		} else {
			$value = 1;
		}
		update_post_meta( $post_id, $meta_key, $value );
	}



	
}

function getProducts(){
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

