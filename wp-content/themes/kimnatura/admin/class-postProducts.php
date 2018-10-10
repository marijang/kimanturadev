<?php
/**
 * The users specific functionality.
 *
 * @since   2.0.0
 * @package Medicoteka\Admin
 */

namespace Kimnatura\Admin;

class PostProducts {
	private $screen = array(
		'post',
	);
	private $meta_fields = array(
		array(
			'label' => 'Featured products',
			'id' => 'post_products',
			'type' => 'select',
			'options' => array(
				'',
			),
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
			if ( $post_id && in_category( 'slider-hero', $post_id ) ) {
			add_meta_box(
				'postproducts',
				__( 'Uključeni proizvodi', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'normal',
				'default'
			);
		}
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'postproducts_data', 'postproducts_nonce' );
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
        $output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
            $meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
            if (empty($meta_value)) {
                $meta_value = array();
            }
			switch ( $meta_field['type'] ) {
				case 'select':
                $input = sprintf(
                    '<select multiple id="%s" name="%s[]">',
                    $meta_field['id'],
                    $meta_field['id']
                );
                $args = array(
					'post_type' => 'product',
					'posts_per_page' => -1
                    );              
                
                $query = new \WP_Query( $args );
                $posts = $query->posts;
                $input .= ''; 
                foreach ( $posts as $post ) {
                    $terms = get_the_terms( $post->ID, 'product_cat' );
                    $cat = '';
                    $cnt = 0;
                    foreach ($terms as $term) {
                        $cnt++;
                        if (count($terms) == $cnt)
                            $cat .= $term->name;
                        else {
                            $cat = $cat . $term->name . ', ';
                        }
                    }
                    $input .= sprintf(
                        '<option %s value="%s">%s (%s)</option>',
                        in_array($post->ID, $meta_value) ? 'selected' : '',
                        $post->ID,
                        $post->post_title,
                        $cat
                    );
                }
                $input .= '</select>';
                break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><td class="post-products">'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['postproducts_nonce'] ) )
			return $post_id;
		$nonce = $_POST['postproducts_nonce'];
		if ( !wp_verify_nonce( $nonce, 'postproducts_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
                    update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
               
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
