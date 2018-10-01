$(document).ready(function() {

$(window).on('load', function() {
    $('input[type="text"], input[type="password"]').click();
  });


  jQuery( document ).ready(function() {
    jQuery('.register').children().css('display', 'none');
    jQuery('#reg-toggle').parent().css('display', 'block');
    // jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'none');
    // jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'none');
    // jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
    jQuery('#username').focus();
jQuery('#log-toggle').on('click', function(){
    jQuery('#reg-box').removeClass('is-active');
    jQuery('#log-box').addClass('is-active');
    jQuery('.register').children().css('display', 'none');
    jQuery('#reg-toggle').parent().css('display', 'block');
});
jQuery('#reg-toggle').on('click', function(){
        jQuery('#log-box').removeClass('is-active');
        jQuery('#reg-box').addClass('is-active');
        jQuery('.register').children().css('display', 'block');
        jQuery('#reg-toggle').parent().css('display', 'none');
        jQuery('.woocommerce-terms-and-conditions').css('display', 'none');
        jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
        // jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'inline-block');
        // jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'inline-block');
        //jQuery('.woocommerce-privacy-policy-text').css('display', 'block');
});
jQuery('#log-toggle-mobile').on('click', function(){
        jQuery('#reg-box').removeClass('is-active');
        jQuery('#log-box').addClass('is-active');
        jQuery('.register').children().css('display', 'none');
        jQuery('#reg-toggle').parent().css('display', 'block');
});
jQuery('#reg-toggle-mobile').on('click', function(){
        jQuery('#log-box').removeClass('is-active');
        jQuery('#reg-box').addClass('is-active');
        jQuery('.register').children().css('display', 'block');
        jQuery('#reg-toggle').parent().css('display', 'none');
        jQuery('.woocommerce-terms-and-conditions').css('display', 'none');
        jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
        //jQuery('.woocommerce-privacy-policy-text').css('display', 'block');
});


// jQuery( document ).ready(function() {
// 	jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'none');
// 	jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'none');
// 	jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
// 	jQuery('#username').focus();
// 	jQuery('#log-toggle').on('click', function(){
// 		jQuery('#reg-box').removeClass('is-active');
// 		jQuery('#log-box').addClass('is-active');
// 		jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'none');
// 		jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'none');
// 		jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
// });
// jQuery('#reg-toggle').on('click', function(){
// 		jQuery('#log-box').removeClass('is-active');
// 		jQuery('#reg-box').addClass('is-active');
// 		jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'inline-block');
// 		jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'inline-block');
// 		//jQuery('.woocommerce-privacy-policy-text').css('display', 'block');
// });
// jQuery('#log-toggle-mobile').on('click', function(){
// 		jQuery('#reg-box').removeClass('is-active');
// 		jQuery('#log-box').addClass('is-active');
// 		jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'none');
// 		jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'none');
// 		jQuery('.woocommerce-privacy-policy-text').css('display', 'none');
// });
// jQuery('#reg-toggle-mobile').on('click', function(){
// 		jQuery('#log-box').removeClass('is-active');
// 		jQuery('#reg-box').addClass('is-active');
// 		jQuery('.ct-ultimate-gdpr-consent-field').css('display', 'inline-block');
// 		jQuery('.ct-ultimate-gdpr-consent-field-woocommerce').css('display', 'inline-block');
// 		//jQuery('.woocommerce-privacy-policy-text').css('display', 'block');
// });
});

});


$(document).ready(function() {
	$('.woocommerce-error.woocommerce-message.woocommerce-message--alert').appendTo('.navigation-user');
});