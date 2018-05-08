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
add_action( 'admin_menu', __NAMESPACE__ . '\register_portfolio_meta_box' );
/**
 * Register the meta box.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_portfolio_meta_box() {
	add_meta_box(
		'portfolio_custom_meta_box',
		__( 'Portfolio', 'custom-meta-box' ),
		__NAMESPACE__ . '\render_portfolio_meta_box',
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
function render_portfolio_meta_box( WP_Post $post, array $meta_box ) {
	// Security with a nonce.
	wp_nonce_field( 'portfolio_meta_box_save', 'potfolio_meta_box_nonce' );

	// Get the metadata.
	$client_name = get_post_meta( $post->ID, 'client_name', true );
	$client_url  = get_post_meta( $post->ID, 'client_url', true );

	// Do any processing that needs to be done.

	// Load the view file.
	include CUSTOM_META_BOX_DIR . 'src/views/portfolio.php';
}

add_action( 'save_post', __NAMESPACE__ . '\save_portfolio_meta_box', 10, 2 );
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
function save_portfolio_meta_box( $post_id, $post ) {
	// Make sure it's the right metabox.
	if ( ! array_key_exists( 'portfolio', $_POST ) ) {
		return false;
	}

	// Make sure the nonce matches.
	if ( ! wp_verify_nonce( $_POST['potfolio_meta_box_nonce'], 'portfolio_meta_box_save' ) ) {
		return false;
	}

	// Merge with defaults.
	$metadata = wp_parse_args(
		$_POST['portfolio'],
		array(
			'client_name'      => '',
			'client_url' => '',
		)
	);

	// Loop through the custom fields and update the `wp_postmeta` database.
	foreach ( $metadata as $meta_key => $value ) {
		if ( ! $value ) {
			delete_post_meta( $post_id, $meta_key );
			continue;
		}
		if ( 'client_name' === $meta_key ) {
			$value = sanitize_text_field( $value );
		} else {
			$value = esc_url_raw( $value );
		}
		update_post_meta( $post_id, $meta_key, $value );
	}
}

