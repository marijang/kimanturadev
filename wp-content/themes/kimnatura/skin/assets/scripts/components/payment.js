$(document).ready(function() {
$("#place_order").click(function(){
	var checked = $("#terms:checked").length;
	var checked1 = $("#ct-ultimate-gdpr-consent-field:checked").length;
	if (checked1) {   //checked zakomentirano
		$("form[name='checkout']").submit();
	} 
	// if (!checked) {
	// 	$('#terms-error').addClass('checkbox__error-label--active');
	// 	$('#terms').parent().addClass("checkbox__error");
	// }
	if (!checked1) {
		$("#privacy-error").addClass('checkbox__error-label--active');
		$("#ct-ultimate-gdpr-consent-field").parent().addClass("checkbox__error");
	}
});
$('#terms').change(function() {
	if ($(this).parent().hasClass('checkbox__error')) {
		$(this).parent().removeClass('checkbox__error');
		$('#terms-error').removeClass('checkbox__error-label--active');
	}
});
$('#ct-ultimate-gdpr-consent-field').change(function() {
	if ($(this).parent().hasClass('checkbox__error')) {
		$(this).parent().removeClass('checkbox__error');
		$('#privacy-error').removeClass('checkbox__error-label--active');
	}
});
});