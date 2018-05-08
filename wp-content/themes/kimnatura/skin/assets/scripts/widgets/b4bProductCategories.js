$(function() {
    var allPanels = $('.shop-categories__childs').show();
    $('.shop-categories__icon').on('click', function(e){
        e.preventDefault();
        var $this = $(this);
        var $thislist = $this.parent().parent();
        
        $thislist.find('ul').slideToggle('fast');  // apply the toggle to the ul
        $thislist.toggleClass('is-expanded');
        if ($thislist.hasClass('is-expanded')){
            $thislist.find('.shop-categories__icon').html('keyboard_arrow_down');
        }else{
            $thislist.find('.shop-categories__icon').html('keyboard_arrow_up');
        }
        
    });

    var setValue = function(){
    var total = '';
    $.each($('input[name="product_cat[]"]:checked'), function( index, item ){ 
            value = $(this).val();
            $target = $('input[name="product_cat"]');
            if(index==0){
                total = value;
            }else{
                total = total + ','+ value;
            }
            $target.val(total);
        });
    }

    $('input[name="product_cat[]"]').on('click',function(){
        setValue();
        if($('input[name="product_cat"]').val()!=''){
        window.location.href = "/shop/?category="+$('input[name="product_cat"]').val();
        }
    });
	
});