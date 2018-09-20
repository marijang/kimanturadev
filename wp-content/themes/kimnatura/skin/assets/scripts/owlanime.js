

$(function() {
var x = 0,
  max = 300,
  min = -300,
  cor ='',
  count=$('.slick-dots button').length
  last=2;


function log(){
     ("X:"+x+' max:'+max+' min:'+min);
}
var start = false;
$('.slider-slick').on('mouseover',function(event){
     showCoords(event);
     if(!start){
        start = true;
        setTimeout(function(){
            //runner();
           },2000);
     }
     

});

function getOffset( el ) {
    var _x = 0;
    var _y = 0;
    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
        _x += el.offsetLeft - el.scrollLeft;
        _y += el.offsetTop - el.scrollTop;
        el = el.offsetParent;
    }
    return { top: _y, left: _x };
}
var offset = getOffset( document.getElementById('.slider-slick') ).top; 


/*
anime({
    targets: '.slick-dots button',
    translateX: function(el,i) {
      
      return 50 + (-50 * i);
    },
    translateY: function(el, i) {
        //return -300;
    },
    scale: function(el, i, l) {
      return (l - i) + .25;
    },
    rotate: function() { return anime.random(-360, 360); },
    duration: function() { return anime.random(1200, 1800); },
    duration: function() { return anime.random(800, 1600); },
    delay: function() { return 500 },
    direction: 'alternate',
    //loop: true
  });

*/

  


function showCoords(event) {
    x = event.clientX;
    var y = event.clientY;
    var coor = "X coords: " + x + ", Y coords: " + y;
   
}

var scale= 2;
var counter = 50;
function runner() {
    //log();
var el = document.querySelector('.slick-active1');
var eln = document.querySelector('.slick-dots1 li:not(.active)');
    anime({
      targets: el,
      scale: 3.6,
      translateX: -150,
      delay: function() { return 500 },
      direction: 'alternate'
    });
    anime({
        targets: '.slick-dots li:not(.active)',
        scale: 1.9,
        translateX: 150
      });
    setTimeout(function() {
        runner();
    }, 1000);
}
//runner();

});