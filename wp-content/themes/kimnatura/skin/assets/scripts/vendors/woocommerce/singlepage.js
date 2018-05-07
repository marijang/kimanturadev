$(document).ready(function($) {
    $('input[name="variation_id"], input.variation_id').on('change', function(){
       // $('form').on('update_variation_values', function(){
        
       // alert('test');
        var variation_id = $('input.variation_id').val();
//alert(variation_id);
        if( '' != $('input.variation_id').val() ){
            $('.single-product__js-variations').removeClass('is-active');
            $('#product-single-variation-id-'+variation_id).addClass('is-active');
        } 
        else {
        }
       /*
        if( '' != $('input.variation_id').val() ){
            if($('p.availability')) $('p.availability').remove();
            $('.single-product__price').html(
                $('div.woocommerce-variation-price > span.price').html())
                .append('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
            console.log($('input.variation_id').val());
        } else {
            $('.single-product__price').html($('div.hidden-variable-price').html());
            if($('p.availability'))
                $('p.availability').remove();
            console.log('NULL');
        }
        */
    });
    
});