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
            'posts_per_page' => 2,
            'post_type' => array('product')
         );
    } else {
        $args = array(
            'post_status' => 'publish', //$_POST['load'],
            's' => $search,
            'post_type' => array('product')
         );
    }
    
   // $args = array( 'post_type' => 'product', 'posts_per_page' => $_POST['load'], 'product_cat' => ($subCatList ? $subCatList : $bool->slug), 'orderby' => 'title', 'order' => 'ASC', 'offset' => (($_POST['start'] + $_POST['load']) - $_POST['load']) );
    $query = new \WP_Query( $args );

    if ( $query->have_posts() ) {
    //var_dump($query);
        echo   '<header class="section__header">';
        if($search==''){
            echo '<h1 id="search-title" class="section__title">Zadnje s našeg bloga</h1>';
        } else {
            echo '<h1 id="search-title" class="section__title">Rezultati pretraživanja</h1>';
        }
        echo '</header><!-- .entry-header -->
                <div id="search-results" class="search__related">';

        while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post);// global $product;
            
            get_template_part( 'template-parts/listing/articles/single-post' );
        endwhile;


    } else {
            echo '<div id="search-results" class="search__empty" style="height: 100%;">';
            get_template_part( 'template-parts/listing/articles/empty' );
    }
    echo '</div>';
    wp_reset_postdata();

//     woocommerce_product_loop_end();

     wp_reset_query();
    }

}