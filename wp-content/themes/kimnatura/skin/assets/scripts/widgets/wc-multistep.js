

(function($){
    $('#payment').hide();
    var navigation = $('.cart-checkout-navigation');
    var activestep = $('.cart-checkout-navigation__item.is-active');
    var prevStepButton = $('#wc-multistep-prev-step');
    var nextStepButton = $('#wc-multistep-next-step');

    var prevstep = activestep.prev();
    var nextstep = activestep.next();

    
    function init(){
        jQuery('input[name="payment_method"]:checked').parent().parent().addClass('is-active');
        var count = jQuery('input[name="payment_method"]').length;
        if (count>0){
            jQuery('input[name="payment_method"]').bind('change',function(){
                jQuery(this).parent().parent().parent().find('.is-active').removeClass('is-active');
                jQuery(this).parent().parent().addClass('is-active');
            });
            jQuery('.payment__method label').on('click',function(){
             
            });
        }
       
    }


    
    $('body').on('updated_checkout',function(){
        
    });

    prevStepButton.on('click',function(e){
        activestep.removeClass('is-active');
        prevstep.addClass('is-active');
        activestep = prevstep;
        if (activestep.data('step')=='customer-details'){
            $('#payment-details').hide();
            $('#customer-details').show();
        }
        e.preventDefault();
    });
    nextStepButton.on('click',function(e){
        activestep.removeClass('is-active');
        nextstep.addClass('is-active');
        activestep = nextstep;
        if (activestep.data('step')=='payment'){
            $('#payment-details').show();
            $('#customer-details').hide();
        }
        e.preventDefault();
        
    });





    $('#wc-multistep-details').on('click',function(e){
        if ($(this).hasClass('is-disabled')){
           
        }else{
            $('#payment-details,#wc-multistep-payment-title').hide();
            $('#customer-details,#wc-multistep-details-title').show();
            $(this).addClass('is-active');
            $('#wc-multistep-payment').removeClass('is-active');
            e.preventDefault();
        }
        
    });


   
    
    $('body').on("init_payment_methods",function(o){
  
        $('input[type="checkbox"]').addClass("filled-in");
       
    });

 
    
	
})(jQuery);



$(function() {
function init(){
    var count = jQuery('input[name="payment_method"]').length;
    if (count>0){
    
        jQuery('input[name="payment_method"]').bind('change',function(){
            jQuery(this).parent().parent().removeClass('is-active');
            jQuery(this).parent().addClass('is-active');
        });
        jQuery('.payment__method label').on('click',function(){
        
        });
    }
   
}

jQuery('body').on("update_checkout",function(o){
    //$('input[type="checkbox"]').addClass("filled-in");
    init();
    jQuery('input[name="payment_method"]:checked').parent().addClass('is-active');
    
});


init();
    jQuery('input[name="payment_method"]:checked').parent().addClass('is-active');
});






$(document).ready(function(){
$("form[name='checkout']").validate({
     // Specify validation rules
     rules: {
       // The key name on the left side is the name attribute
       // of an input field. Validation rules are defined
       // on the right side
       billing_first_name: "required",
       billing_last_name: "required",
       billing_email: "required",
       billing_address_1: "required",
       billing_city: "required",
       billing_postcode: "required",
       shipping_first_name: {
           required : '#ship-to-different-address-checkbox:checked'
       },
       shipping_last_name: {
        required : '#ship-to-different-address-checkbox:checked'
       },
       shipping_address_1: {
        required : '#ship-to-different-address-checkbox:checked'
       },
       shipping_city: {
        required : '#ship-to-different-address-checkbox:checked'
       },
       shipping_postcode: {
        required : '#ship-to-different-address-checkbox:checked'
       }
     },
     // Specify validation error messages
     messages: {
       billing_first_name: "Please enter your firstname",
       billing_last_name: "Please enter your lastname",
       billing_email: "Please enter your email address",
       billing_address_1: "Please enter your address",
       billing_city: "Please enter your city",
       billing_postcode: "Please enter your postcode"
     },
     errorPlacement: function(error, element) {
         element.addClass('invalid');
         var el = element.parent().find('.errorClass');
         if (el.length)
             el.attr('data-error', error.text());
         else 
             element.parent().parent().find('.errorClass').attr('data-error', error.text());
       }
   });

   


 
});
