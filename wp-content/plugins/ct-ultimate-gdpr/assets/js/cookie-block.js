/**
 * block js set cookies
 *
 * @var ct-ultimate-gdpr-cookie-block.blocked - via wp_localize_script
 *
 **/

if (ct_ultimate_gdpr_cookie_block && ct_ultimate_gdpr_cookie_block.blocked) {

    try {

        var ct_ultimate_gdpr_cookie_setter_original = document.__lookupSetter__("cookie");
        var ct_ultimate_gdpr_cookie_getter_original = document.__lookupGetter__("cookie");
        var old_cookie = document.cookie;

        Object.defineProperty(document, 'cookie', {

            get: function () {
                return ct_ultimate_gdpr_cookie_getter_original ?
                    ct_ultimate_gdpr_cookie_getter_original.apply(document) : this._value;
            },
            set: function (val) {
                // single cookie
                if (val && val.indexOf('path=') > 0 && val.indexOf('expires=') > 0) {

                    var parts = val.split(';');
                    var name = parts[0].split('=')[0];
                    var value = parts[0].split('=')[1];

                    if ( name !== 'ct-ultimate-gdpr-cookie' && ( ct_ultimate_gdpr_cookie_block.level < 2 || ct_ultimate_gdpr_cookie_block.blocked.indexOf(name) !== -1 ) ) {
                        return; // console.log("[ultimate gdpr] cookie blocked: " + name);
                    }

                }

                this._value = val;
                //ct_ultimate_gdpr_cookie_setter_original && ct_ultimate_gdpr_cookie_setter_original.apply(document, arguments)

            },
            configurable: true
        });

        document.cookie = old_cookie;

    } catch (e) {
        // console.log(e);
    }

}
