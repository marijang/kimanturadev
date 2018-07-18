<?php
/**
 * Created by PhpStorm.
 * User: CreateIT
 * Date: 5/18/2018
 * Time: 4:13 PM
 */

class CT_Ultimate_GDPR_Shortcode_Privacy_Policy {

    public function render_cookies_list() {
    	?>
        <div class="table-responsive">
            <table>
                <tr>
                    <th>
                        <?php echo esc_html__( 'Cookie names', 'ct-ultimate-gdpr' ); ?>
                    </th>
                    <th>
                        <?php echo esc_html__( 'Type of cookie', 'ct-ultimate-gdpr' ); ?>
                    </th>
                    <th>
                        <?php echo esc_html__( 'First or Third party', 'ct-ultimate-gdpr' ); ?>
                    </th>
                    <th>
                        <?php echo esc_html__( 'Can be blocked', 'ct-ultimate-gdpr' ); ?>
                    </th>
                    <th>
                        <?php echo esc_html__( 'Session or Persistent', 'ct-ultimate-gdpr' ); ?>
                    </th>
                    <th>
                        <?php echo esc_html__( 'Expiry Time', 'ct-ultimate-gdpr' ); ?>
                    </th>
                    <th>
                        <?php echo esc_html__( 'Purpose', 'ct-ultimate-gdpr' ); ?>
                    </th>
                </tr>
                <?php
                $this->render_cookies();
                ?>
            </table>
        </div>
		<?php
    }

    private function render_cookies() {
		$args = array( 'post_type' => 'ct_ugdpr_service', 'numberposts' => -1 );
		$posts = get_posts($args);
		foreach( $posts as $post ) {
			$is_active = get_post_meta( $post->ID, 'is_active', true );
			if( !$is_active ) {
				continue;
			}
			$cookie_names_str = get_post_meta( $post->ID, 'cookie_name', true );
			$cookie_type = get_post_meta( $post->ID, 'type_of_cookie', true );
			$cookie_type_label = CT_Ultimate_GDPR_Model_Group::get_label($cookie_type);
			$first_or_third_party = get_post_meta( $post->ID, 'first_or_third_party', true );
			$can_be_blocked = get_post_meta( $post->ID, 'can_be_blocked', true );
			$session_or_persistent = get_post_meta( $post->ID, 'session_or_persistent', true );
			$expiry_time_int = get_post_meta( $post->ID, 'expiry_time', true );
			$expiry_time = $expiry_time_int ? ct_ultimate_gdpr_date($expiry_time_int) : '';
			$purpose = get_post_meta( $post->ID, 'purpose', true );
			?>
			<tr>
				<td>
					<?php echo $cookie_names_str; ?>
				</td>
				<td>
					<?php echo $cookie_type_label; ?>
				</td>
				<td>
					<?php echo $first_or_third_party == 'first_party' ?
                        esc_html__( 'First party', 'ct-ultimate-gdpr') : esc_html__( 'Third party', 'ct-ultimate-gdpr'); ?>
				</td>
                <td>
					<?php if( $can_be_blocked ): ?>
                        <i class="fa fa-check" aria-hidden="true" style="color: green"></i>
					<?php else: ?>
                        <i class="fa fa-times" aria-hidden="true" style="color: red"></i>
					<?php endif ?>
				</td>
				<td>
					<?php echo $session_or_persistent == 'session' ?
						esc_html__( 'Session', 'ct-ultimate-gdpr') : esc_html__( 'Persistent', 'ct-ultimate-gdpr'); ?>

                </td>
				<td>
					<?php echo $expiry_time; ?>
				</td>
				<td>
					<?php echo $purpose; ?>
				</td>
			</tr>
			<?php
		}
	}

}

function render_cookies_list() {

    if ( ! function_exists('get_field' ) ) {
        return '';
    }

    $obj = new CT_Ultimate_GDPR_Shortcode_Privacy_Policy();
    ob_start();
    $obj->render_cookies_list();
    return ob_get_clean();
}

add_shortcode('render_cookies_list', 'render_cookies_list');