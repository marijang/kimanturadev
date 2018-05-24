

$(function() {
    var action = 'example';
    var url = themeLocalization.ajaxurl + '?action=example&start=2&load=2';
    var allPanels = $('.shop-categories__childs').show();
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
    
    $('#show-more-products').on('click',function(e){
        e.preventDefault(); 
        var $this = $(this);
        loader.fadeIn('fast');
        var $get  = $this.data('current');
        var $perpage  = $this.data('per-page');
        var url = themeLocalization.ajaxurl + '?action=example&start='+$get+'&load='+$perpage;
        $.ajax({
            type : "get",
            //dataType : "json",
            url : url,
           // data : {action: action, post_id : post_id, nonce: nonce},
            success: function(response) {
               if(response) {
                  var $items =  $('.shop-catalog__items li',response); 
                  var $num = $(response).filter('.total');

                  $('.shop-catalog__num-of-items').html($num);
              

               
 
                 $.each( $items,function(index,item){
                    $item = $(item);
                    $item.css('transition-delay',(index * 0.3)+'s');
                    $item.css('animation-delay',(index * 0.3)+'s');
                    $(".shop-catalog__items").append($item);
             
                  });
                 
                  loader.fadeOut('slow');
                  $items.addClass('animated');
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
        }
    });
	
});