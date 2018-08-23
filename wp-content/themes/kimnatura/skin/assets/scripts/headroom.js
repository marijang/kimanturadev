

var Headroom = require("headroom.js");
$(function() {
// grab an element

var myElement = document.querySelector("#page-navigation");
// construct an instance of Headroom, passing the element
var headroom  = new Headroom(myElement);



// initialise

headroom.init({
    tolerance: 5,
    offset : 205
});

});

