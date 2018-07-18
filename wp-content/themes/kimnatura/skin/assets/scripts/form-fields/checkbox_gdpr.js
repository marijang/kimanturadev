$( document ).ready(function() {
    var input = $('.ct-ultimate-gdpr-consent-field');
    input.attr('required', false);
    var label = $("[for='ct-ultimate-gdpr-consent-field']");
    var text = label.text() + ' *';
    //console.log(text);
    label.text('');
    label.append('<span>' + text + '</span>');
    input.prependTo(label);
    label.wrap('<p class="form-row terms wc-terms-and-conditions"></p>');
    label.click(function() {
        var cb = $(this).find('input');
        if (cb.attr('checked')) {
            cb.attr('checked', false);
        } else {
            cb.attr('checked', true);
            cb.removeClass('checkbox__invalid');
        }
    });
   

   
}); 