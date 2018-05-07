

$(function() {
    function incrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).parent();
        var currentVal = parseInt(parent.find('input').val(), 10);
      
        if (!isNaN(currentVal)) {
          parent.find('input').val(currentVal + 1);
        } else {
          parent.find('input').val(0);
        }
      }
      
    function decrementValue(e) {
        e.preventDefault();
        var parent = $(e.target).parent();;
        var currentVal = parseInt(parent.find('input').val(), 10);
        
        if (!isNaN(currentVal) && currentVal > 0) {
            parent.find('input').val(currentVal - 1);
        } else {
            parent.find('input').val(0);
        }
    }
    
    $('.input-number__wrapper').on('click', '.input-number__decrement', function(e) {
       
        decrementValue(e);
    });
    
    $('.input-number__wrapper').on('click', '.input-number__increment', function(e) {
        incrementValue(e);
    });
})
