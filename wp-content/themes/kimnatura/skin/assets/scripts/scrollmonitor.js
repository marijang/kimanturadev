import scrollMonitor from "scrollMonitor";
//import $ from 'jquery';
//var scrollMonitor = require("./scrollMonitor"); 


//$(function(scrollMonitor) {
    $(function( ) {


    console.log(scrollMonitor);
   var myElement = document.getElementsByClassName("article-list")[0];
   var elem = $('.article-list');
   elem.html('afa');
   elem.css('background','red');
   console.log( $('.article-list'));


var elementWatcher = scrollMonitor.create( elem );
 
elementWatcher.enterViewport(function() {
    console.log( 'I have entered the viewport' );
});
elementWatcher.exitViewport(function() {
    console.log( 'I have left the viewport' );
});

//});
});