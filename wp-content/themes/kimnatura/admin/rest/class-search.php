<?php
/**
 * The Menu specific functionality.
 *
 * http://kimnatura.test/wp-admin/admin-ajax.php?action=search
 * @since   2.0.0
 * @package Kimnatura\Admin\Menu
 */

namespace Kimnatura\Admin\Rest;
use Kimnatura\Admin\WP_AJAX as WP_AJAX;

Class Search extends WP_AJAX
{
    protected $action = 'search';

    protected function run()
    {

   // woocommerce_product_loop_start();
    $search = $this->get('search');

    if($search==''){
        $args = array(
            'post_status' => 'publish', //$_POST['load'],
            // 's' => $search,
            'posts_per_page' => 2
            // 'orderby' => 'date', // we will sort posts by date
             //'order'	=> $_POST['date'] // ASC или DESC
         );
    } else {
        $args = array(
            'post_status' => 'publish', //$_POST['load'],
            's' => $search
            // 'orderby' => 'date', // we will sort posts by date
             //'order'	=> $_POST['date'] // ASC или DESC
         );
    }
    
   // $args = array( 'post_type' => 'product', 'posts_per_page' => $_POST['load'], 'product_cat' => ($subCatList ? $subCatList : $bool->slug), 'orderby' => 'title', 'order' => 'ASC', 'offset' => (($_POST['start'] + $_POST['load']) - $_POST['load']) );
    $query = new \WP_Query( $args );

    if ( $query->have_posts() ) {
    //var_dump($query);
//     woocommerce_product_loop_start();
    while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post);// global $product;
//             //echo "ok";
  
// 			/**
// 			 * Hook: woocommerce_shop_loop.
// 			 *
// 			 * @hooked WC_Structured_Data::generate_product_data() - 10
// 			 */
// 			do_action( 'woocommerce_shop_loop' );
        get_template_part( 'template-parts/listing/articles/single-post' );
// 			wc_get_template_part( 'content', 'product' );
         endwhile;
//   //  }

        } else {
            get_template_part( 'template-parts/listing/articles/empty' );
        }
        wp_reset_postdata();

//     woocommerce_product_loop_end();

     wp_reset_query();
    }

}