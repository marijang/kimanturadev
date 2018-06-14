var $ = require('jquery');

var cart = {
    changeProductQty: function () {
        $('.qty').change();
        alert('ok');
    }
}


module.exports = cart;