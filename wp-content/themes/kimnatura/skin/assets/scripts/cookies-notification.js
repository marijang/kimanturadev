import {cookies} from './helpers/cookies';

$(function() {
  $('.js-cookies-notification-btn,.cookies-notification__close').on('click', function(e) {
    e.preventDefault();

    $('.js-cookies-notification').fadeOut();

    cookies.setCookie('cookie-law', 'true', cookies.setOneMonth(), '/');
  });
});
