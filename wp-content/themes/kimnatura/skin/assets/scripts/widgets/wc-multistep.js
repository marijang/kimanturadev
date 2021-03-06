
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

    var getCookiebyName = function(name){
        var pair = document.cookie.match(new RegExp(name + '=([^;]+)'));
        return !!pair ? pair[1] : null;
    };
    var lang = getCookiebyName('_icl_current_language');

    if (lang == 'hr') {
$("form[name='checkout']").validate({
     // Specify validation rules
     rules: {
       // The key name on the left side is the name attribute
       // of an input field. Validation rules are defined
       // on the right side
       billing_first_name: "required",
       billing_last_name: "required",
       billing_email: {"required" : true, "email" : true },
       billing_address_1: "required",
       billing_city: "required",
       billing_postcode: "required",
       billing_phone : {
        required: true,
        number: true
      } ,
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
       billing_first_name: "Ime je potrebno polje",
       billing_last_name: "Prezime je potrebno polje",
       billing_email: {"required" : "Email adresa je potrebno polje", "email" : "Email nije ispravnog formata" },
       billing_address_1: "Adresa je potrebno polje",
       billing_city: "Grad je potrebno polje",
       billing_postcode: "Poštanski broj je potrebno polje",
       billing_phone : {"required" : "Telefonski broj je potrebno polje","number" : "Telefonski broj mora biti numeričkog formata"},
       shipping_first_name : "Ime je potrebno polje",
       shipping_last_name : "Prezime je potrebno polje",
       shipping_address_1 : "Adresa je potrebno polje",
       shipping_city : "Grad je potrebno polje",
       shipping_postcode : "Poštanski broj je potrebno polje"

     },
     errorPlacement: function(error, element) {
         element.addClass('invalid');
         var el = element.parent().find('.errorClass');
         if (el.length)
             el.attr('data-error', error.text());
            
         else 
        
             element.parent().parent().find('.errorClass').attr('data-error', error.text());
       }
   }); } else {
    $("form[name='checkout']").validate({
        // Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          billing_first_name: "required",
          billing_last_name: "required",
          billing_email: {"required" : true, "email" : true },
          billing_address_1: "required",
          billing_city: "required",
          billing_postcode: "required",
          billing_phone : {
           required: true,
           number: true
         } ,
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
          billing_first_name: "Name is required",
          billing_last_name: "Last name is required",
          billing_email: {"required" : "Email address is required", "email" : "Email format is wrong" },
          billing_address_1: "Address is required",
          billing_city: "City is required",
          billing_postcode: "Post code is required",
          billing_phone : {"required" : "Phone number is required","number" : "Phone number format is wrong"},
          shipping_first_name : "Name is required",
          shipping_last_name : "Last name is required",
          shipping_address_1 : "Address is required",
          shipping_city : "City is required",
          shipping_postcode : "Post code is required"
   
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

   }

   
 
});
