$( document ).ready(function() {
    $('.register').validate({
        // Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          reg_email: {required: true,
                      email: true},
          reg_password: "required",
          terms: "required",
          'ct-ultimate-gdpr-consent-field': "required"
        },
        // Specify validation error messages
        messages: {
          reg_email: {required : "Email adresa je potrebno polje", email : "Email nije ispravnog formata"},
          reg_password: "Lozinka je potrebno polje",
          terms: "Potrebno je prihvatiti uvjete korištenja",
          'ct-ultimate-gdpr-consent-field': "Potrebno je prihvatit uvjete privatnosti"
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
        }
      });
}); 