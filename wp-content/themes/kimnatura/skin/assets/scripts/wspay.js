$( document ).ready(function() {
    var wspayControls = $('.wspay-controls');
    var proceedBtn = $('.wspay-controls > .button-proceed').addClass('btn btn--primary-color');
    proceedBtn.text('Nastavi na plaćanje');

    var cancelBtn = $('.wspay-controls > .button-cancel').css('display','none');
    proceedBtn.text('Odustani');
});