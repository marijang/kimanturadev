<?php
/**
 * Template part for displaying related products on page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package b4b
 */


 //global $loop

use Kimnatura\Admin\Woo as Woo;
$woo  = new Woo();


?>
  <?php if (!is_front_page()) :?>
  <div class="section--highlighted-color">
  <?php endif?>
<section class="section related-products section__spacing-top--medium section__spacing-bottom--medium section--slider">
    <?php if (is_front_page()) :?>
    <header class="section__header">
    <h3 class="section__title section__title--center"><?php echo  $title;?></h3>
    </header>
    <?php else :?>
    <header class="section__header">
    <h3 class="section__title "><?php echo  $title;?></h3>
    </header>
    <?php endif;?>
    <div class="products__most-selling">
	   
	    <div class="products__slider-wrapper">
	       <div class=" products__slider slider-slick">
           <?php
	        if ( $loop->have_posts() ):
            while ( $loop->have_posts() ) : $loop->the_post(); 
               global $product; 
               $productid = $loop->post->ID;
               $sale = $woo->show_sale_percentage();
		    ?>
		<div >

        <a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured-link  <?php echo ($product->is_type( 'variable' ))?'featured-link__variable':'featured-link__simple'; ?>">
        <?php 
        if($product->is_on_sale()){
            $sale = $woo->show_sale_percentage();
            echo '<span class="featured-link__onsale">'.$sale .'</span>'; //  esc_html__( 'Sale!', 'woocommerce' ). '</span>';
        }
        if (has_post_thumbnail( $loop->post->ID )) 
        echo get_the_post_thumbnail($loop->post->ID, 'shop-catalog',array('class'=>'featured-link__image')); 
        else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />'; 
        ?>
          
          <div class="featured-link__movable">
               <div class="featured-link__description">
                    <div class="featured-link__title-container">
                        <h4 class="featured-link__title"><?php the_title();?></h4>
                        <p class="featured-link__categories"><?php
                        $args = array(
                            'orderby' => 'name',
                        );
                        $product_cats = wp_get_post_terms( $productid, 'product_cat', $args );
                        $cat_count = sizeof( $product_cats );
                        //var_dump($product);
                        echo '';
                        for ( $i = 0; $i < $cat_count; $i++ ) {
                            echo $product_cats[$i]->name;
                            echo ( $i === $cat_count - 1 ) ? '' : ', ';
                        }
                        echo '';
                        ?></p>
                    </div>
					<strong class="featured-link__price">
                        <?php 
                        //echo $product->get_price_html();
                        if (  $product->is_type( 'variable' ) ) {
                        if ( $product->is_on_sale() ) {
                            echo   '<span class="featured-link__sale-regular-price">'.wc_price($product->get_variation_regular_price( 'min', true )).'</span>';
                            echo  wc_price($product->get_variation_price( 'min', true ).$product->get_price_suffix()) ;
                        }
                        else{
                            echo  wc_price($product->get_variation_price( 'min', true ).$product->get_price_suffix()) ;
                        }
                        }else{
                            echo $product->get_price_html();
                        }
                        
                        ?>
                    </strong>
                </div>


                <div class="featured-link__options">
                    <?php
                    if ( $product->is_type( 'variable' ) ) {
                        $available_variations = $product->get_available_variations();           
                        $attributes =  $product->get_variation_attributes();
                        foreach ( $attributes as $attribute_name => $attribute ) :
                            $s = sanitize_title( $attribute_name );
                            echo '<h5>'.wc_attribute_label( $attribute_name ).'</h5>';  
                            foreach ( $available_variations as $options) {
                                $variation_id = $options['variation_id'];
                                $optionattr = $options['attributes'];
                                $variable_product = new WC_Product_Variation( $variation_id );
                                echo '<div>'; 

                                echo '<span class="featured-link__option-name">'.$optionattr['attribute_'.sanitize_title($attribute_name)].'</span>'; 
                                // from get_price_html
                                if ( $variable_product->is_on_sale() ) {
                                    $price = wc_format_sale_price( 
                                                  wc_get_price_to_display( $variable_product, 
                                                                           array( 'price' => $variable_product->get_regular_price() ) ),
                                                                           wc_get_price_to_display( $variable_product ) 
                                             ) . $variable_product->get_price_suffix();
                                    $price = '<span class="featured-link__regular-price">'
                                             .wc_price($variable_product->get_regular_price()).$variable_product->get_price_suffix()
                                             .'</span>'
                                             .'<span class="featured-link__sale-price">'
                                             .wc_price(wc_get_price_to_display( $variable_product ))
                                             .$variable_product->get_price_suffix()
                                             .'</span>';
                                             
                                } else {
                                    $price = wc_price( wc_get_price_to_display( $variable_product ) ) . $variable_product->get_price_suffix();
                                }
                                echo '<span class="featured-link__option-price">'.$price.'</span>';
                                echo '</div>';

                             }
                             
                        endforeach;

                        /*
                        foreach ( $available_variations as $attribute_name => $variation ) : 
                            $variation_id = $variation['variation_id'];
                            $product_variation_id = $variation['variation_id'];
                            $variable_product = new WC_Product_Variation( $variation_id );
                            

                           // $product_price = get_product_variation_price($product_variation_id);
                           // get_post_meta($variation_id, 'attribute_options');
                            foreach (wc_get_product($variation['variation_id'])->get_variation_attributes() as $val => $attr) {
                
                               echo '<span>'; 
                               echo wc_attribute_label( $attr ); 
                               echo '</span>';
                            }
                            //echo $attribute_name;
                        endforeach;
                        */
                    }
                    ?>
                </div>
                <div class="featured-link__button btn btn--primary btn--small ">Idi na proizvod</div>
            </div>
        </a>
       
			
		</div>
		<?php endwhile; 
		endif;
		
		?>
           </div>
		</div>
	</div>
</section>
<?php if (!is_front_page()) :?>
</div>
  <?php endif?>