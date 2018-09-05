
import $ from 'jquery';
global.$ = global.jQuery = $;
//
import Headroom from 'headroom.js';

//var Headroom = require("headroom.js");
$(function() {
// grab an element

var myElement = document.querySelector("#page-navigation");
// construct an instance of Headroom, passing the element
var headroom  = new Headroom(myElement,{
    // callback when pinned, `this` is headroom object
    onPin : function() {
        console.log('OK');
    },
    // callback when unpinned, `this` is headroom object
    onUnpin : function() {console.log('Vidi me kako radim');},
    // callback when above offset, `this` is headroom object
    onTop : function() {console.log('Vidi me opet');},
    // callback when below offset, `this` is headroom object
    onNotTop : function() {},
    // callback at bottom of page, `this` is headroom object
    onBottom : function() {},
    // callback when moving away from bottom of page, `this` is headroom object
    onNotBottom : function() {}
});

// initialise

headroom.init({
    tolerance: 5,
    offset : 205,
});

});

