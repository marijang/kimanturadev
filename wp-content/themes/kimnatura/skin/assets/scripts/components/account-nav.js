jQuery( document ).ready(function() {
    jQuery('#settings-toggle').on('click', function(){
        if(jQuery('#settings-menu').hasClass('is-open')){
            jQuery('#settings-menu').removeClass('is-open');
            jQuery('#settings-logout').removeClass('is-open');
            jQuery('#settings-toggle').removeClass('is-active');
          }
          else{
            jQuery('#settings-menu').addClass('is-open');
            jQuery('#settings-logout').addClass('is-open');
            jQuery('#settings-toggle').addClass('is-active');
          }
    });
});