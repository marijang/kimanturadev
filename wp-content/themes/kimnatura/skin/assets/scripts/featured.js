import $ from 'jquery';
global.$ = global.jQuery = $;

$(function() {
    var imageActive = $('.slick-active .featured-link__image');
    var h = image.height();
    $('.slick-list .featured-link__image').css('max-height',h);
});