<?php
/**
 * The Menu specific functionality.
 *
 * http://example.com/wp-admin/admin-ajax.php?action=example
 * @since   2.0.0
 * @package Kimnatura\Admin\Menu
 */

namespace Kimnatura\Admin\Rest;
use Kimnatura\Admin\WP_AJAX as WP_AJAX;

Class Example extends WP_AJAX
{
    protected $action = 'example';

    protected function run()
    {
     
       
   // woocommerce_product_loop_start();

    $load  = $this->get('load',6);
    $start = $this->get('start',0); 
    
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $load, //$_POST['load'],
        'offset' => (($start + $load) - $load) 
       // 'orderby' => 'date', // we will sort posts by date
        //'order'	=> $_POST['date'] // ASC или DESC
    );
   // $args = array( 'post_type' => 'product', 'posts_per_page' => $_POST['load'], 'product_cat' => ($subCatList ? $subCatList : $bool->slug), 'orderby' => 'title', 'order' => 'ASC', 'offset' => (($_POST['start'] + $_POST['load']) - $_POST['load']) );
    //$query = new WP_Query( $args );
    // Asos primjer load more
    $loop = new \WP_Query( $args );
    $total = $loop->found_posts; //$loop->post_count;
    $total_left = $total - $loop->post_count;
    echo '<div class="total-products">Ukupno postova:'.$total.', ostalo jos '.$total_left.', prikazujem '.$load.'</em>';
   // var_dump($loop);
    woocommerce_product_loop_start();
    while ( $loop->have_posts() ) : $loop->the_post(); global $product;
            //echo "ok";
  
			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );
        
			wc_get_template_part( 'content', 'product' );
        endwhile;
  //  }
    //wp_reset_postdata();

    woocommerce_product_loop_end();

    wp_reset_query();
    }
}