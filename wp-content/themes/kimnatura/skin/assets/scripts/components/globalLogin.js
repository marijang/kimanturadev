$(document).ready(function() {
    $('.showlogin').click(function() {
            var block = $(this).parent().parent().find('.login');
            block.css('display', 'initial');
    })
});