

$(function() {
    var action = 'example';
    var url = themeLocalization.ajaxurl + '?action=example&start=2&load=2';
   // var allPanels = $('.shop-categories__childs').show();
    var loader = $('.shop-catalog__loader');
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
    $target = $('input[name="product_cat"]');
    $.each($('input[name="product_cat[]"]:checked'), function( index, item ){ 
            value = $(this).val();
            
            if(index==0){
                total = value;
            }else{
                total = total + ','+ value;
            }
            $target.val(total);
        });
        $target.val(total);
    }
    
    function calcHeight(){
        var countElements = Math.ceil($('.shop-catalog__items li').length/3)+1;
        var elementHeight = $('.shop-catalog__item:first').outerHeight()*2;
        return (countElements*elementHeight);
    }

    $('#show-more-products').on('click',function(e){
        e.preventDefault(); 
        var $this = $(this);
        loader.fadeIn('fast');
        var $get  = $this.data('current')+1;
        $this.data('current',$get);
        $this.hide();
        var $perpage  = $this.data('per-page');
        var url = themeLocalization.ajaxurl + '?action=example&start='+$get+'&load='+$perpage;
        $.ajax({
            type : "get",
            url : url,
            success: function(response) {
               if(response) {
                  var $items =  $('.shop-catalog__items li',response); 
                  var $num = $(response).filter('.total');
                  $this.data('current',$get);
                  $products_left = $num.data('products-left');
                  if($products_left==0){
                    $('.shop-catalog__num-of-items').html($num);
                  }else{
                    $('.shop-catalog__num-of-items').html($num);        
                    $this.fadeIn('slow');
                  }
                  $.each( $items,function(index,item){
                    $item = $(item);
                    $item.css('transition-delay',(index * 0.3)+'s');
                    $item.css('animation-delay',(index * 0.3)+'s');
                    $(".shop-catalog__items").append($item);
                    $items.addClass('animated');
                 });
                 $('.shop-catalog__items').css('max-height',calcHeight());
                  loader.fadeOut('fast');
               }
               else {
                  alert("Your vote could not be added")
               }
            }
         });   
    });

    $('input[name="product_cat[]"]').on('click',function(){
        setValue();
        if($('input[name="product_cat"]').val()!=''){
            window.location.href = "/shop/?category="+$('input[name="product_cat"]').val();
        }else{
            window.location.href = "/shop/";
        }
    });
	
});