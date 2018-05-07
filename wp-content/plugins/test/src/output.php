<?php
/**
 * Output of the Custom Meta Box content on the front-end.
 *
 * @package     ChristophHerr\CustomMetaBox\Src
 * @since       1.0.0
 * @author      christophherr
 * @link        https://www.christophherr.com
 * @license     GNU General Public License 2.0+
 */

namespace ChristophHerr\CustomMetaBox\Src;

add_action( 'genesis_entry_header', __NAMESPACE__ . '\add_subtitle_to_posts', 11 );
/**
 * Add subtitle to posts
 *
 * @return void
 */
function add_subtitle_to_posts() {
	if ( ! is_single() ) {
		return;
	}
	$post_id       = get_the_ID();
	$subtitle      = get_post_meta( $post_id, 'productIds', true );
	//$show_subtitle = get_post_meta( $post_id, 'show_subtitle', true );
	return;

	if ( ! $show_subtitle ) {
		return;
	}
	?>
	<h2 class="entry-subtitle">
		<?php
			esc_html_e( $subtitle );
		?>
	</h2>
	<?php
}
