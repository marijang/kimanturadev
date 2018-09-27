/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2016, Codrops
 * http://www.codrops.com
 */
//import $ from 'jquery';
//global.$ = global.jQuery = $;

$(document).ready( function() {

    var mainContainer = document.querySelector('.main-wrap'),
    openCtrl = $('#menu>ul>li>a').first()[0],
    closeCtrl = document.getElementById('btn-mega-menu-close'),
    megamenuContainer = document.querySelector('.mega-menu');
    // inputmegamenu = mega-menuContainer.querySelector('.mega-menu__input'),
    //megamenu = document.getElementById('mega-menu-wrap'),
    // megamenuUp = document.getElementById('mega-menu-up'),
    // megamenuDown = document.getElementById('mega-menu-down'),

    var body = $('body');
    var html = $('html');

function init() {
    initEvents();	
}

function initEvents() {
    openCtrl.addEventListener('click', function(ev){
        ev.preventDefault();
        if ($('.hero-slider-slick').length) {
             ('printam123');
            $('.hero-slider-slick').slick('slickPause');
        }
        body.addClass('mega-menu-show');
        mainContainer.classList.add('main-wrap--hide');
        megamenuContainer.classList.add('mega-menu--open');
        //megamenu.addEventListener('scroll', megamenuScroll);
    });
    closeCtrl.addEventListener('click', closemegamenu);
    document.addEventListener('keyup', function(ev) {
         // escape key.
        if( ev.keyCode == 27 ) {
             closemegamenu();
             closeCtrl.click();
         }
    });
}

// function megamenuScroll() {
//     if ($(megamenu).scrollTop() > 0){
//         $(megamenuUp).addClass("scrolled");
//         $(megamenuDown).addClass("scrolled");
//     }
//     else
//     {
//         $(megamenuUp).removeClass("scrolled");
//         $(megamenuDown).removeClass("scrolled");
//     }
// }


function openmegamenu(event) {
    // ('unutra sam');
    event.preventDefault();
    body.addClass('mega-menu-show');
    html.addClass('mega-menu-show');
    if ($('.hero-slider-slick').length) {
        $('.hero-slider-slick').slick('slickPause');
         ('printam');
    }
    mainContainer.classList.add('main-wrap--hide');
    megamenuContainer.classList.add('mega-menu--open');
    //megamenu.addEventListener('scroll', megamenuScroll);
    setTimeout(function() {
        inputmegamenu.focus();
    }, 500);
    
}

function closemegamenu() {
    if ($('.hero-slider-slick').length) {
         ('printammm');
        $('.hero-slider-slick').slick('slickPlay');
    }
    body.removeClass('mega-menu-show');
    html.removeClass('mega-menu-show');
    mainContainer.classList.remove('main-wrap--hide');
    megamenuContainer.classList.remove('mega-menu--open');
    //megamenu.removeEventListener('scroll', megamenuScroll);
}



init();



});

// $(window).scroll(function(){
//      ('tu samm');
//     $('#mega-menu-nav').toggleClass('scrolled', $(document).scrollTop() > 0);
//  });


$(function() {
var action = 'mega-menu';
// var url = themeLocalization.ajaxurl + '?action=example&start=2&load=2';
// var allPanels = $('.shop-categories__childs').show();
$('#btn-mega-menu').on('click', function(e){
    e.preventDefault();
    
    // var $input = $form.find('input[name="s"]');
    // var query = $input.val();

    var $this = $(this);
    var $query  = $this.data('current');
    var url = themeLocalization.ajaxurl + '?action=mega-menu';
    $.ajax({
        type : "get",
        //dataType : "json",
        url : url,
       // data : {action: action, post_id : post_id, nonce: nonce},
        success: function(response) {
           if(response) {
               $("#mega-menu-results").html(response);
           }
           else {
              alert("Your vote could not be added")
           }
        }
     });   
});



function megamenu( event ) {
    event.preventDefault();
    var $this = $(this);
    var $input = $this.find('input[name="s"]');
    var megamenu = $this.val();
    var url = themeLocalization.ajaxurl + '?action=mega-menu&mega-menu='+megamenu;
    $.ajax({
        type : "get",
        //dataType : "json",
        url : url,
       // data : {action: action, post_id : post_id, nonce: nonce},
        success: function(response) {
           if(response) {
                $("#mega-menu-results").html(response);
           }
           else {
              alert("Your vote could not be added")
           }
        }
     });
    };

$( "#mega-menu-form" ).submit(megamenu);
$( '#mega-menu-input' ).keyup(megamenu);
$('#btn-mega-menu-close').click(megamenu);


});





