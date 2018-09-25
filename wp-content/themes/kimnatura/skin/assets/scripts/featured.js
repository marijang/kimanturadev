import $ from 'jquery';
global.$ = global.jQuery = $;

$(document).ready(function() {
    var imageActive = $('.slick-list .featured-link__image');
    var w = imageActive.width();
    if (w == 0){
        w = 358;
    }
    var h = w/1.432;
    $('.slick-list .featured-link__image').css('max-height',h);
});