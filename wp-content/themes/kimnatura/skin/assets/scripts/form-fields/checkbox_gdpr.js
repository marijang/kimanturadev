$( document ).ready(function() {
var i = 0;
  $('.woocommerce-MyAccount-content .ct-ultimate-gdpr-consent-field').each(function() {
    $(this).attr('required', false);
    $(this).attr('id', $(this).attr('id') + i);
    i++;
    var label =  $(this).next();
    var text = label.html();
    label.html('');
    label.append('<span>' + text + ' *</span>');
    $(this).prependTo(label);
    label.wrap('<p class="form-row terms wc-terms-and-conditions"></p>');
});


$('.woocommerce-ResetPassword.lost_reset_password .ct-ultimate-gdpr-consent-field').each(function() {
    var label =  $(this).next();
    var text = label.html();
    label.html('');
    label.append('<span>' + text + ' *</span>');
    $(this).prependTo(label);
    label.wrap('<p class="form-row terms wc-terms-and-conditions"></p>');
});

$('.woocommerce-MyAccount-content [for="ct-ultimate-gdpr-consent-field-woocommerce"]').each(function() {
    $(this).click(function() {
        var cb = $(this).find('input');
        if (cb.attr('checked')) {
            cb.attr('checked', false);
            //cb.parent().addClass('checkbox__invalid');
        } else {
            cb.attr('checked', true);
            cb.parent().removeClass('checkbox__invalid');
        }
    });
    });

    var inputWoo = $('.register #ct-ultimate-gdpr-consent-field-woocommerce');
    inputWoo.attr('required', false);
    var labelWoo = $(".register [for='ct-ultimate-gdpr-consent-field-woocommerce']");
    var textWoo = labelWoo.html();
    labelWoo.html('');
    //label.append('<span>' + split[0]  + ' odredbama <a href="/pravila-privatnosti" target="_blank" > Pravila o privatnosti</a> *</span>');
    labelWoo.append('<span>'+ textWoo + '</span>');
    inputWoo.prependTo(labelWoo);
    labelWoo.wrap('<p class="form-row terms wc-terms-and-conditions"></p>');
    labelWoo.click(function() {
        var cbWoo = $(this).find('input');
        if (cbWoo.attr('checked')) {
            cbWoo.attr('checked', false);
            //cb.parent().addClass('checkbox__invalid');
        } else {
            cbWoo.attr('checked', true);
            cbWoo.parent().removeClass('checkbox__invalid');
        }
    });

    var input = $('#ct-ultimate-gdpr-consent-field-mailchimp');
    input.attr('required', false);
    var label1 = $(".newsletter [for='ct-ultimate-gdpr-consent-field-mailchimp']");
    var text1 = label1.text();
    label1.text('');
    //label.append('<span>' + split[0] + split[1]  + ' na <a href="/pravila-privatnosti" target="_blank" > Pravila o privatnosti</a> *</span>');
    label1.append('<span>' + text1 + ' *</span>');
    input.prependTo(label1);
    var el = label1.wrap('<p class="form-row terms wc-terms-and-conditions"></p>');
    el.appendTo('.newsletter__content')
    label1.click(function() {
        var cb = $(this).find('input');
        if (cb.checked) {
            cb.checked==false;
            //cb.parent().addClass('checkbox__invalid');
        } else {
            cb.checked==true;
            $(this).find('input').parent().removeClass('checkbox__invalid');
        }
    });
    


    // input checkbox na stranici za plaćanje
    var inputPay = $('.woocommerce-additional-fields #ct-ultimate-gdpr-consent-field');
    inputPay.attr('required', false);
    var labelPay = $('.woocommerce-additional-fields .checkbox');
    var textPay = labelPay.html();
    
    labelPay.html('');
    labelPay.prepend(inputPay);
    //label.append('<span>' + split[0]  + ' odredbama <a href="/pravila-privatnosti" target="_blank" > Pravila o privatnosti</a> *</span>');
    labelPay.append('<span> ' + textPay + '</span>');
    
    //labelPay.wrap('<p class="form-row terms wc-terms-and-conditions"></p>');
    // labelPay.click(function() {
    //     var cbPay = $(this).find('input');
    //     if (cbPay.attr('checked')) {
    //         cbPay.attr('checked', false);
    //         //cb.parent().addClass('checkbox__invalid');
    //     } else {
    //         cbPay.attr('checked', true);
    //         cbPay.parent().removeClass('checkbox__invalid');
    //     }
    // });

    // Za newsletter
    // var check = $('.mc4wp-form-fields [for="ct-ultimate-gdpr-consent-field"]').parent();
    // check.appendTo('.mc4wp-form-fields .newsletter__content');
    // $('[name="mc4wp-subscribe"').removeClass('filled-in');
    // var appto = $('.mc4wp-form-fields [name="EMAIL"]').parent()
    // $('<span class="helper-text errorClass" data-error="wrong"></span>').appendTo(appto);
    // $('.mc4wp-form-fields [name="EMAIL"]').attr('id', 'EMAIL');
    // $('.mc4wp-form-fields [name="EMAIL"]').prop('type', 'text');
    // var mchp_ckeckbox_label = $('[name="mc4wp-subscribe"]').parent().find('span');
    // mchp_ckeckbox_label.text("Prihvaćam da se moji podaci prebace na Mailchimp poslužitelj. ")
    // $('<a href="https://mailchimp.com/legal/terms/">Više informacija</a>').appendTo(mchp_ckeckbox_label); 
    // $('<span> *</span>').appendTo(mchp_ckeckbox_label); 
    // mchp_ckeckbox_label.css('font-family', '"Merriweather", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"');
    // $('.mc4wp-form-fields label[for="EMAIL"]').text('Email adresa');

    // Za plaćanje
    // var input = $('#ct-ultimate-gdpr-consent-field');
    // input.attr('required', false);
    // var label = input.parent();
    // var text = label.text();
    // // (text);
    // label.text('');
    // var split1 = text.split('odredbama');
    // label.append('<span>' + split1[0] + ' odredbama <a href="/pravila-privatnosti" target="_blank" >Pravila o privatnosti</a> *</span>');
    // input.prependTo(label);

    
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
    var span_contact = $('<span>' + label_contact.html() + '</span>');
    label_contact.html(' ');
    span_contact.appendTo(label_contact);
    input_contact.prependTo(label_contact);

  $('.wpforms-form button').removeClass();
  $('.wpforms-form button').addClass('form-button'); 
    

  $('abbr.required').replaceWith('*');

  $('.newsletter__content input[name="EMAIL"]').parent().css('margin-bottom', "0px");


    $('input [name!="EMAIL"]').focus();



}); 
