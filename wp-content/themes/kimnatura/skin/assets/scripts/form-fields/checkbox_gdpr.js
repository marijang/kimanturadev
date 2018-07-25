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
    var mchp_ckeckbox_label = $('[name="mc4wp-subscribe"]').parent().find('span');
    mchp_ckeckbox_label.text("Prihvaćam da se moji podaci prebace na Mailchimp poslužitelj. ")
    $('<a href="https://mailchimp.com/legal/terms/">Više informacija</a>').appendTo(mchp_ckeckbox_label); 
    $('<span> *</span>').appendTo(mchp_ckeckbox_label); 
    mchp_ckeckbox_label.css('font-family', '"Merriweather", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"');

    $('.mc4wp-form-fields label[for="EMAIL"]').text('Email adresa');

    // Za plaćanje
    var input = $('#ct-ultimate-gdpr-consent-field');
    input.attr('required', false);
    var label = input.parent();
    var text = label.text();
    //console.log(text);
    label.text('');
    label.append('<span>' + text + '</span>');
    input.prependTo(label);
   /* label.click(function() {
        var cb = $(this).find('input');
        if (cb.attr('checked')) {
            cb.attr('checked', false);
            //cb.parent().addClass('checkbox__invalid');
        } else {
            cb.attr('checked', true);
            cb.parent().removeClass('checkbox__invalid');
        }
    });*/
      
   // $('.woocommerce-additional-fields__field-wrapper').appendTo('#payment');
    //$('#payment .form-row.place-order').appendTo('#payment');
    

    // Kontakt
    var input_contact = $('.contact__field--inverted input[type="checkbox"]');
    var label_contact = input_contact.parent().find('label');
    var span_contact = $('<span>' + label_contact.text() + '</span>');
    label_contact.text(' ');
    span_contact.appendTo(label_contact);
    input_contact.prependTo(label_contact);

  $('.wpforms-form button').removeClass();
  $('.wpforms-form button').addClass('form-button'); 
    

  $('abbr.required').replaceWith('*');
}); 