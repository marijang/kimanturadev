$(document).ready(function() {
$('#proceed-to-payment').on('click',function(e){
    e.preventDefault();
    if (!$("form[name='checkout']").valid()) {
}else {
    $('#payment-details,#wc-multistep-payment-title').show();
    $('#customer-details,#wc-multistep-details-title').hide();
    $('#wc-multistep-payment').addClass('is-active');
    $('#wc-multistep-payment').removeClass('is-disabled');
    $('#wc-multistep-details').removeClass('is-active');
    $('#wc-multistep-details').addClass('is-activated');
}
});


});