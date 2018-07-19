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
            //cb.parent().addClass('checkbox__invalid');
        } else {
            cb.attr('checked', true);
            cb.parent().removeClass('checkbox__invalid');
        }
    });

    // Za newsletter
    var check = $('.mc4wp-form-fields [for="ct-ultimate-gdpr-consent-field"]').parent();
    check.appendTo('.mc4wp-form-fields .newsletter__content');
    $('[name="mc4wp-subscribe"').removeClass('filled-in');
    var appto = $('.mc4wp-form-fields [name="EMAIL"]').parent()
    $('<span class="helper-text errorClass" data-error="wrong"></span>').appendTo(appto);
    $('.mc4wp-form-fields [name="EMAIL"]').attr('id', 'EMAIL');
    $('.mc4wp-form-fields [name="EMAIL"]').prop('type', 'text');

    // Za plaćanje
    
}); 