var getCookiebyName = function(name){
    var pair = document.cookie.match(new RegExp(name + '=([^;]+)'));
    return !!pair ? pair[1] : null;
};

$( document ).ready(function() {
    var lang = getCookiebyName('_icl_current_language');

    if (lang == 'hr') {
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
            // (element);
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



      //Account change
      $("#edit-billing").validate({
        // Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          billing_first_name: "required",
          billing_last_name: "required",
          billing_email: {"required" : true, "email" : true },
          billing_address_1: "required",
          billing_city: "required",
          billing_postcode: "required",
          billing_phone : {
           required: true,
           number: true
          }/*,
          shipping_first_name: {
              required : '#ship-to-different-address-checkbox:checked'
          },
          shipping_last_name: {
           required : '#ship-to-different-address-checkbox:checked'
          },
          shipping_address_1: {
           required : '#ship-to-different-address-checkbox:checked'
          },
          shipping_city: {
           required : '#ship-to-different-address-checkbox:checked'
          },
          shipping_postcode: {
           required : '#ship-to-different-address-checkbox:checked'
          } */
        },
        // Specify validation error messages
        messages: {
          billing_first_name: "Ime je potrebno polje",
          billing_last_name: "Prezime je potrebno polje",
          billing_email: {"required" : "Email adresa je potrebno polje", "email" : "Email nije ispravnog formata" },
          billing_address_1: "Adresa je potrebno polje",
          billing_city: "Grad je potrebno polje",
          billing_postcode: "Poštanski broj je potrebno polje",
          billing_phone : {"required" : "Telefonski broj je potrebno polje","number" : "Telefonski broj mora biti numeričkog formata"},
         /* shipping_first_name : "Ime je potrebno polje",
          shipping_last_name : "Prezime je potrebno polje",
          shipping_address_1 : "Adresa je potrebno polje",
          shipping_city : "Grad je potrebno polje",
          shipping_postcode : "Poštanski broj je potrebno polje" */
   
        },
        errorPlacement: function(error, element) {
            element.addClass('invalid');
            var el = element.parent().find('.errorClass');
            if (el.length)
                el.attr('data-error', error.text());
               
            else 
           
                element.parent().parent().find('.errorClass').attr('data-error', error.text());
          }
      });


      $("#edit-shipping").validate({
        // Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          shipping_first_name: "required",
          shipping_last_name: "required",
          shipping_address_1: "required",
          shipping_city: "required",
          shipping_postcode: "required"
        },
        // Specify validation error messages
        messages: {
          shipping_first_name : "Ime je potrebno polje",
          shipping_last_name : "Prezime je potrebno polje",
          shipping_address_1 : "Adresa je potrebno polje",
          shipping_city : "Grad je potrebno polje",
          shipping_postcode : "Poštanski broj je potrebno polje" 
   
        },
        errorPlacement: function(error, element) {
            element.addClass('invalid');
            var el = element.parent().find('.errorClass');
            if (el.length)
                el.attr('data-error', error.text());
               
            else 
           
                element.parent().parent().find('.errorClass').attr('data-error', error.text());
          }
      });


      $('.woocommerce-EditAccountForm').validate({
        // Specify validation rules
        rules: {
          account_first_name: {"required" : true, "minlength" : 2 },
          account_last_name: {"required" : true, "minlength" : 2 },
          account_email: {"required" : true, "email" : true },
          account_display_name: {"required" : true, "minlength" : 2 },
          'ct-ultimate-gdpr-consent-field' : "required",
          password_current : { required: function(element){
            return $("[name='password_1']").val() != "";
          }},
          password_1 : {"minlength" : 4},
          password_2 : {equalTo: "[name='password_1']", required: function(element){
            return $("[name='password_1']").val() != "";
          }},

        },
        // Specify validation error messages
        messages: {
            account_first_name: {"required" : "Ime je potrebno polje", "minlength" : "Ime mora sadržavati minimalno 2 znaka" },
            account_last_name: {"required" : "Prezime je potrebno polje", "minlength" : "Prezime mora sadržavati minimalno 2 znaka" },
            account_email: {"required" : "Email adresa je potrebno polje", "email" : "Email adressa nije ispravnog formata" },
            account_display_name: {"required" : "Ime za prikaz je potrebno polje", "minlength" : "Ime za prikaz mora sadržavati minimalno 2 znaka" },
            password_current: {"required" : "Trenutna lozinka je potrebno polje" },
            password_1: {"minlength" : "Lozinka mora sadržavati minimalno 4 znaka"},
            password_2: {"equalTo" : "Lozinke se ne podudaraju", "required" : "Potvrda nove lozinke je potrebno polje" },
   
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
          }
      });
    } else {
            // ENGLESKI


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
              email: {required : "Email addres is required", email : "Email format is wrong"},
              password: { required: "Password is required", minlength: "Password must be at least 4 letters long" }, 
              terms: "You must accept terms",
              'ct-ultimate-gdpr-consent-field': "You must accept privacy terms"
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
              username: "Email address is required",
              password: "Password is required"       
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
              'EMAIL': {"required" : "Email address is required", "email" : "Email format is wrong" },
              'ct-ultimate-gdpr-consent-field': "You must accept privacy terms",
              'mc4wp-subscribe' : "You must accept mailchimp terms"
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
                // (element);
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
    
    
    
          //Account change
          $("#edit-billing").validate({
            // Specify validation rules
            rules: {
              // The key name on the left side is the name attribute
              // of an input field. Validation rules are defined
              // on the right side
              billing_first_name: "required",
              billing_last_name: "required",
              billing_email: {"required" : true, "email" : true },
              billing_address_1: "required",
              billing_city: "required",
              billing_postcode: "required",
              billing_phone : {
               required: true,
               number: true
              }/*,
              shipping_first_name: {
                  required : '#ship-to-different-address-checkbox:checked'
              },
              shipping_last_name: {
               required : '#ship-to-different-address-checkbox:checked'
              },
              shipping_address_1: {
               required : '#ship-to-different-address-checkbox:checked'
              },
              shipping_city: {
               required : '#ship-to-different-address-checkbox:checked'
              },
              shipping_postcode: {
               required : '#ship-to-different-address-checkbox:checked'
              } */
            },
            // Specify validation error messages
            messages: {
              billing_first_name: "Name is required",
              billing_last_name: "Last name is required",
              billing_email: {"required" : "Email address is required", "email" : "Email format is wrong" },
              billing_address_1: "Address is required",
              billing_city: "City is required",
              billing_postcode: "Post code is required",
              billing_phone : {"required" : "Phone number is required","number" : "Phone number format is wrong"},
             /* shipping_first_name : "Ime je potrebno polje",
              shipping_last_name : "Prezime je potrebno polje",
              shipping_address_1 : "Adresa je potrebno polje",
              shipping_city : "Grad je potrebno polje",
              shipping_postcode : "Poštanski broj je potrebno polje" */
       
            },
            errorPlacement: function(error, element) {
                element.addClass('invalid');
                var el = element.parent().find('.errorClass');
                if (el.length)
                    el.attr('data-error', error.text());
                   
                else 
               
                    element.parent().parent().find('.errorClass').attr('data-error', error.text());
              }
          });
    
    
          $("#edit-shipping").validate({
            // Specify validation rules
            rules: {
              // The key name on the left side is the name attribute
              // of an input field. Validation rules are defined
              // on the right side
              shipping_first_name: "required",
              shipping_last_name: "required",
              shipping_address_1: "required",
              shipping_city: "required",
              shipping_postcode: "required"
            },
            // Specify validation error messages
            messages: {
              shipping_first_name : "Name is required",
              shipping_last_name : "Last name is required",
              shipping_address_1 : "Address is required",
              shipping_city : "City is required",
              shipping_postcode : "Post code is required" 
       
            },
            errorPlacement: function(error, element) {
                element.addClass('invalid');
                var el = element.parent().find('.errorClass');
                if (el.length)
                    el.attr('data-error', error.text());
                   
                else 
               
                    element.parent().parent().find('.errorClass').attr('data-error', error.text());
              }
          });
    
    
          $('.woocommerce-EditAccountForm').validate({
            // Specify validation rules
            rules: {
              account_first_name: {"required" : true, "minlength" : 2 },
              account_last_name: {"required" : true, "minlength" : 2 },
              account_email: {"required" : true, "email" : true },
              account_display_name: {"required" : true, "minlength" : 2 },
              'ct-ultimate-gdpr-consent-field' : "required",
              password_current : { required: function(element){
                return $("[name='password_1']").val() != "";
              }},
              password_1 : {"minlength" : 4},
              password_2 : {equalTo: "[name='password_1']", required: function(element){
                return $("[name='password_1']").val() != "";
              }},
    
            },
            // Specify validation error messages
            messages: {
                account_first_name: {"required" : "Name is required", "minlength" : "Name must contain at least 2 letters" },
                account_last_name: {"required" : "Last name is required", "minlength" : "Last name must contain at least 2 letters" },
                account_email: {"required" : "Email address is required", "email" : "Email format is wrong" },
                account_display_name: {"required" : "Display name is required", "minlength" : "Display name must contain at least 2 letters" },
                password_current: {"required" : "Current password is required" },
                password_1: {"minlength" : "Password must contain at least 4 letters"},
                password_2: {"equalTo" : "Passwords don't match", "required" : "Password confirmation is required" },
       
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
              }
          });
    }
}); 