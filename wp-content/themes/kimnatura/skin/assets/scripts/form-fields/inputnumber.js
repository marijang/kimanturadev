
import $ from 'jquery';
global.$ = global.jQuery = $;

$(function() {
$(document).ready(function(){


    var event = new CustomEvent('change', {
        bubbles: true
    });
    //const event = new Event('change');
    function incrementValue(e) {

        var fieldName = $(e.target).data('field');
        var parent = jQuery(e.target).parent();
        var currentVal = parseInt(parent.find('input').val(), 10);
        
        if (!isNaN(currentVal)) {
          parent.find('input').val(currentVal + 1);
          //parent.find('input').dispatchEvent(event);
        } else {
          parent.find('input').val(0);
         // parent.find('input').dispatchEvent(event);
        }
        //console.log(parent.find('input'));
        parent.find('input').trigger('change');
        parent.find('input').change();

        $('.qty').triggerHandler('change');
       // cart.changeProductQty();
       
       // document.getElementsByClassName('qty').dispatchEvent(event);
       // e.preventDefault();
        //alert('test');
      }
      
    function decrementValue(e) {
        e.preventDefault();
        var parent = $(e.target).parent();
        var currentVal = parseInt(parent.find('input').val(), 10);
        
        if (!isNaN(currentVal) && currentVal > 0) {
            parent.find('input').val(currentVal - 1);
            //parent.find('input').dispatchEvent(event);
        } else {
            parent.find('input').val(0);
            //parent.find('input').dispatchEvent(event);
        }
        parent.find('input').trigger('change');
        //document.getElementsByClassName('qty').dispatchEvent(event);
    }
    
    $('.input-number__wrapper').on('click', '.input-number__decrement', function(e) {
       
        decrementValue(e);

    });
    
    $('.input-number__wrapper').on('click', '.input-number__increment', function(e) {
        incrementValue(e);
    });
});
}); 
