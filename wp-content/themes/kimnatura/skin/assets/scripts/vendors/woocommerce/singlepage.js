$(document).ready(function($) {
    $('input[name="variation_id"], input.variation_id').on('change', function(){

        var variation_id = $('input.variation_id').val();
        if( '' != $('input.variation_id').val() ){
            $('.single-product__js-variations').removeClass('is-active');
            $('#product-single-variation-id-'+variation_id).addClass('is-active');
        } 
        else {
            
        }
 
    });
    
});