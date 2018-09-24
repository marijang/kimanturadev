import $ from 'jquery';
global.$ = global.jQuery = $;
import Headroom from 'headroom.js';
$(function() {
// grab an element

var myElement = document.querySelector("#page-navigation");
// construct an instance of Headroom, passing the element
var headroom  = new Headroom(myElement,{
    // callback when pinned, `this` is headroom object
    onPin : function() {
        $('.shop-categories__list').addClass('shop-categories__list--headup');
        //$('.shop-catalog__filter').addClass('shop-categories__list--headup');
    },
    // callback when unpinned, `this` is headroom object
    onUnpin : function() { ('HEADROOM:Vidi me MZ kako radim:)');
      $('.shop-catalog__filter').removeClass('shop-categories__list--headup');
    },
    // callback when above offset, `this` is headroom object
    onTop : function() {
        $('.shop-catalog__filter').addClass('shop-categories__list--headup');
        $('.shop-catalog__filter').removeClass('shop-categories__list--headup');
    },
    // callback when below offset, `this` is headroom object
    onNotTop : function() {
       
        $('.shop-catalog__filter').addClass('shop-categories__list--headup');
    },
    // callback at bottom of page, `this` is headroom object
    onBottom : function() {},
    // callback when moving away from bottom of page, `this` is headroom object
    onNotBottom : function() {}
});

// initialise

headroom.init({
    tolerance: 50,
    offset : 250
});

});

