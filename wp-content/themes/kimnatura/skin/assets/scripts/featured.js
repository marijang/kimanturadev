import $ from 'jquery';
global.$ = global.jQuery = $;

$(document).ready(function() {
    var imageActive = $('.slick-active .featured-link__image');
    var h = imageActive.height();
    if (h == 0){
        h = '250px';
    }
    $('.slick-list .featured-link__image').css('max-height',h);
});