import $ from 'jquery';

//$(function() {
$(document).ready(function(){
    var $select = $("select.js-select-toggle");
    
    var event = new CustomEvent('change', {
        bubbles: true
    });

    $select.each(function(){
        var $options    = $("option",this);
        var $thisselect = $(this);
        var select = this;
        var $btngroup   = $('<div class="select-toggle__button-group btn1"></div>');
        //$thisselect.addClass('browser-default');
        $thisselect.hide();
        $options.each(function() {
            if ($(this).val()){
                var $btn = $('<div class="select-toggle__button btn1" data-value="'+$(this).val()+'">'+$(this).text()+'</div>');
                if($(this).is(':checked')) $btn.addClass('is-active');
                var val =  $(this).val();
                $btn.on('click',function(){
                    $(select).val(val);
                    // Fix for .trigger()
                    select.dispatchEvent(event);
                    $(this).parent().find('.is-active').removeClass('is-active');
                    $(this).addClass('is-active');
                });   
                $btngroup.append($btn);   
            }
        });
        $thisselect.after($btngroup);
    });
})
