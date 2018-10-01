jQuery( document ).ready(function() {
    jQuery('#menu-toggle').on('click', function(){
        if(jQuery('#menu').hasClass('is-open')){
    jQuery('#menu').removeClass('is-open');
    jQuery('html').removeClass('mobile-menu-is-open');
    jQuery('#menu-toggle').parent().removeClass('is-active');
  }
  else{
    jQuery('#menu').addClass('is-open');
    jQuery('html').addClass('mobile-menu-is-open');
    jQuery('#menu-toggle').parent().addClass('is-active');
  }
});
});