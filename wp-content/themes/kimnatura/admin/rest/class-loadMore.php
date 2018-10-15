<?php
/**
 * The Menu specific functionality.
 *
 * http://kimnatura.test/wp-admin/admin-ajax.php?action=LoadMore
 * @since   2.0.0
 * @package Kimnatura\Admin\Menu
 */

namespace Kimnatura\Admin\Rest;
use Kimnatura\Admin\WP_AJAX as WP_AJAX;

Class LoadMore extends WP_AJAX
{
    protected $action = 'loadMore';

    protected function run()
    {
       
   // woocommerce_product_loop_start();

    $load  = $this->get('load',12);
    $start = $this->get('start',0); 
    $lang = $this->get('lang','hr'); 
    $categories = explode(',',$_GET['category']);
    global $sitepress;
    $sitepress->switch_lang($lang);
    

    $taxonomies = array();
    if (!empty($_GET['category'])) {
        $categories = explode(',',$_GET['category']);
        $taxonomies[] = array (
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $categories
        );
    
    // https://wordpress.stackexchange.com/questions/25076/how-to-filter-wordpress-search-excluding-post-in-some-custom-taxonomies
    $taxonomy_query = array('relation' => 'OR', $taxonomies);
    if (!empty( $taxonomies)) {
        //$q->set('tax_query', $taxonomy_query);
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $load, //$_POST['load'],
        'paged' => $start,
        'tax_query' => $taxonomy_query
        //'offset' => (($start + $load) - $load) 
    );
} else {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $load, //$_POST['load'],
        'paged' => $start
    );
}
    // Asos primjer load more
    $loop = new \WP_Query( $args );
    $total = $loop->found_posts; //$loop->post_count;

    $last  = min( $total, $load * $start );
    $total_left = $total - $last;
    $percentage = $last/$total*100;
    echo '<div class="total shop-catalog__results-wrap" data-products-left="'.$total_left.'">
    <div class="shop-catalog__results-count">'. __('Pregledali ste', 'kimnatura') . ' ' .$last. ' ' . __('od', 'kimnatura'). ' '.$total. ' ' . __('proizvoda', 'kimnatura') .'</div>
    <progress max="100" value="'.$percentage.'" class="shop-catalog__progress" aria-hidden="true"></progress>
    </div>';
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