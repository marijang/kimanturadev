<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp_query;

$per_page = wc_get_loop_prop( 'loop' ); //get_option( 'posts_per_page' );


$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

$total_all = $wp_query->found_posts; //$loop->post_count;
$total_left = $total_all - $wp_query->post_count;
$last  = min( $total_all, $per_page * $current );
$percentage = $last/$total_all*100;

if ( $total <= 1 ) {
	return;
}
?>
<div class="shop-catalog__pagination">
	<div class="shop-catalog__num-of-items">
		<div class="total shop-catalog__results-wrap" data-products-left="<?php echo $total_left ?>">
    	<div class="shop-catalog__results-count"><?php echo __('Pregledali ste', 'kimnatura') . ' ';  ?> <?php echo $last . ' '; ?> <?php echo __('od', 'kimnatura') . ' ';?> <?php echo $total_all . ' '; ?> <?php echo __('proizvoda', 'kimnatura'); ?></div>
    	<progress max="100" value="'.$percentage.'" class="shop-catalog__progress" aria-hidden="true"></progress>
    </div>
	</div>
	<a href="/page/2" class="btn btn--grey-color shop-catalog__btn-shop-more" data-current="<?php echo max( 1, $current ); ?>" data-per-page="<?php echo max( 1, $per_page ); ?>" id="show-more-products"><?php echo __('Prikaži više', 'kimnatura'); ?></a>
	<div class="shop-catalog__loader">
	<!-- Loader 9 -->

<svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
  viewBox="0 0 64 64" enable-background="new 0 0 0 0" xml:space="preserve">
    <rect x="20" y="20" width="4" height="10" fill="#000">
      <animateTransform attributeType="xml"
        attributeName="transform" type="translate"
        values="0 0; 0 20; 0 0"
        begin="0" dur="0.6s" repeatCount="indefinite" />
    </rect>
    <rect x="30" y="20" width="4" height="10" fill="#000">
      <animateTransform attributeType="xml"
        attributeName="transform" type="translate"
        values="0 0; 0 20; 0 0"
        begin="0.2s" dur="0.6s" repeatCount="indefinite" />
    </rect>
    <rect x="40" y="20" width="4" height="10" fill="#000">
      <animateTransform attributeType="xml"
        attributeName="transform" type="translate"
        values="0 0; 0 20; 0 0"
        begin="0.4s" dur="0.6s" repeatCount="indefinite" />
    </rect>
</svg>
</div>

</div>
<nav class="woocommerce-pagination" style="display:none;">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
			'base'         => $base,
			'format'       => $format,
			'add_args'     => false,
			'current'      => max( 1, $current ),
			'total'        => $total,
			'prev_text'    => '&larr;',
			'next_text'    => '&rarr;',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3,
		) ) );
	?>
</nav>

<a href="javascript:" id="return-to-top"><i class="material-icons">
arrow_upward
</i></a>

