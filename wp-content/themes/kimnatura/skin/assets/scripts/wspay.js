$( document ).ready(function() {

    var getCookiebyName = function(name){
        var pair = document.cookie.match(new RegExp(name + '=([^;]+)'));
        return !!pair ? pair[1] : null;
    };
    var lang = getCookiebyName('_icl_current_language');

    var wspayControls = $('.wspay-controls');
    var proceedBtn = $('.wspay-controls > .button-proceed').addClass('btn btn--primary-color');
    if (lang == 'hr') {
    proceedBtn.val('Nastavi na plaćanje');
    proceedBtn.text('Nastavi na plaćanje');
    } else {
        proceedBtn.val('Proceed to payment');
    proceedBtn.text('Proceed to payment');
    }

    var cancelBtn = $('.wspay-controls > .button-cancel').css('display','none');
    if (lang == 'hr') {
    proceedBtn.text('Odustani');
    } else {
        proceedBtn.text('Cancel');
    }
});