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




    // hide payments
  
   // $('#customer_details').hide();

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
        $('#payment-details,#wc-multistep-payment-title').hide();
        $('#customer-details,#wc-multistep-details-title').show();
        $(this).addClass('is-active');
        $('#wc-multistep-payment').removeClass('is-active');

        e.preventDefault();
    });
    $('#proceed-to-payment').on('click',function(){
        init();
        $('#payment-details,#wc-multistep-payment-title').show();
        $('#customer-details,#wc-multistep-details-title').hide();
        $('#wc-multistep-payment').addClass('is-active');
        $('#wc-multistep-details').removeClass('is-active');
        $('#wc-multistep-details').addClass('is-activated');
    })
    
    $('body').on("init_payment_methods",function(o){
        alert('to je to');
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