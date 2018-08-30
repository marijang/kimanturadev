$( document ).ready(function() {
    $('.register').validate({
        // Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          email: {required: true,
                      email: true},
          password: {required: true,
                     minlength: 4},
          terms: "required",
          'ct-ultimate-gdpr-consent-field': "required"
        },
        // Specify validation error messages
        messages: {
          email: {required : "Email adresa je potrebno polje", email : "Email nije ispravnog formata"},
          password: { required: "Lozinka je potrebno polje", minlength: "Lozinka mora imati barem 4 znaka" }, 
          terms: "Potrebno je prihvatiti uvjete korištenja",
          'ct-ultimate-gdpr-consent-field': "Potrebno je prihvatiti uvjete privatnosti"
        },
        errorPlacement: function(error, element) {
            if (element.attr('type') != 'checkbox') {
            element.addClass('invalid');
            var el = element.parent().find('.errorClass');
            if (el.length)
                el.attr('data-error', error.text());
            else 
                element.parent().parent().find('.errorClass').attr('data-error', error.text());
            } else {
                element.parent().addClass('checkbox__invalid');
            }
          },
        unhighlight: function(element) {
                $(element).removeClass('invalid');
                $(element).addClass('valid');
        },
        onclick: function(element) {
            // if ($(element).attr('type') == 'checkbox') {
            //     $(element).parent().removeClass('checkbox__invalid');
            // }
            if ($(element).attr('checked')) {
                $(element).attr('checked', false);
                //$(element).parent().addClass('checkbox__invalid');
            } else {
                $(element).attr('checked', true);
                $(element).parent().removeClass('checkbox__invalid');
            }
        }
      });

      $('.login').validate({
        // Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          username: "required",
          password: "required"
        },
        // Specify validation error messages
        messages: {
          username: "Email adresa je potrebno polje",
          password: "Lozinka je potrebno polje"       
        },
        errorPlacement: function(error, element) {
            if (element.attr('type') != 'checkbox') {
            element.addClass('invalid');
            var el = element.parent().find('.errorClass');
            if (el.length)
                el.attr('data-error', error.text());
            else 
                element.parent().parent().find('.errorClass').attr('data-error', error.text());
            } else {
                element.parent().addClass('checkbox__invalid');
            }
          },
        unhighlight: function(element) {
                $(element).removeClass('invalid');
                $(element).addClass('valid');
        },
        onclick: function(element) {
            // if ($(element).attr('type') == 'checkbox') {
            //     $(element).parent().removeClass('checkbox__invalid');
            // }
            if ($(element).attr('checked')) {
                $(element).attr('checked', false);
                //$(element).parent().addClass('checkbox__invalid');
            } else {
                $(element).attr('checked', true);
                $(element).parent().removeClass('checkbox__invalid');
            }
        }
      });


      $('#mc4wp-form-1').validate({
        // Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          'EMAIL': {"required" : true, "email" : true },
          'mc4wp-subscribe': "required",
          'ct-ultimate-gdpr-consent-field' : "required"
        },
        // Specify validation error messages
        messages: {
          'EMAIL': {"required" : "Email adresa je potrebno polje", "email" : "Email nije ispravnog formata" },
          'ct-ultimate-gdpr-consent-field': "Potrebno je prihvatiti uvjete privatnosti",
          'mc4wp-subscribe' : "Potrebno je prihvatiti uvjete mailchimpa"
        },
        errorPlacement: function(error, element) {
            if (element.attr('type') != 'checkbox') {
            element.addClass('invalid');
            var el = element.parent().find('.errorClass');
            if (el.length)
                el.attr('data-error', error.text());
            else 
                element.parent().parent().find('.errorClass').attr('data-error', error.text());
            } else {
                element.parent().addClass('checkbox__invalid');
            }
          },
        unhighlight: function(element) {
            //console.log(element);
                $(element).removeClass('invalid');
                $(element).addClass('valid');
        },
        onclick: function(element) {
            // if ($(element).attr('type') == 'checkbox') {
            //     $(element).parent().removeClass('checkbox__invalid');
            // }
            if ($(element).attr('checked')) {
                $(element).attr('checked', false);
                //$(element).parent().addClass('checkbox__invalid');
            } else {
                $(element).attr('checked', true);
                $(element).parent().removeClass('checkbox__invalid');
            }
        }
      });

      $('abbr.required').replaceWith('*');
}); 