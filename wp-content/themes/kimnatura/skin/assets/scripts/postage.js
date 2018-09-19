

import $ from 'jquery';
global.$ = global.jQuery = $;

$(function(){
    $( document.body ).on( 'updated_cart_totals',function(){
        $('.cart__banner').addClass('cart__banner--loading');
        //alert("Ok sada moram ici po poruku");
        var url = themeLocalization.ajaxurl + '?action=free-postage';
        $.ajax({
             type : "get",
             url : url,
             success: function(response) {
                if(response) {
                    if($('.cart__banner').length > 0){
                        var amount = $(response).find('.amount').html();
                        $('.cart__banner').find('.amount').html(amount);
                        $('.cart__banner').removeClass('cart__banner--loading');
                    } else {
                        $('.woocommerce').before(response);
                    }
                }
                else {
                    $('.cart__banner').remove();
                }
             }
          });   
    } );
});