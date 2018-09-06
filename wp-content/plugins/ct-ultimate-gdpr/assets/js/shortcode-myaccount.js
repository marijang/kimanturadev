jQuery(document).ready(function ($) {

    if ( $("#tabs").tabs ) {
        $("#tabs").tabs({
            active: 0
        });
    }

    // SIMULATE CHECKBOX FUNCTION
    $( '.ct-ultimate-gdpr-container label[for*="ct-ultimate-gdpr-consent-"]' ).on( 'click', function() {
        var realCheckbox = $( this ).find( 'input[type="checkbox"]' );
        var ctCheckbox = $( this ).find( '.ct-checkbox' );
        checkboxFn( realCheckbox, ctCheckbox );
    } );
    $( '.ct-ultimate-gdpr-container .ct-ultimate-gdpr-service-options' ).on( 'click', function() {
        var realCheckbox = $( this ).find( 'input[type="checkbox"]' );
        var ctCheckbox = $( this ).find( '.ct-checkbox' );
        checkboxFn( realCheckbox, ctCheckbox );
    } );
    function checkboxFn( realCheckbox, ctCheckbox ) {
        if ( realCheckbox.is( ':checked' ) ) {
            realCheckbox.prop( 'checked', false );
            ctCheckbox.removeClass( 'ct-checked' );
        } else {
            realCheckbox.prop( 'checked', true );
            ctCheckbox.addClass( 'ct-checked' );
        }
    }

});
