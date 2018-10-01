$(document).ready(function() {
var start = 730;
var scrollTo = 490;
if ( (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) ) {
	start = 400;
	var scrollTo = 120;
}
// ===== Scroll to Top ==== 
$(window).scroll(function() {
  if ($(this).scrollTop() >= start) {        // If page is scrolled more than 50px
      $('#return-to-top').fadeIn(200);    // Fade in the arrow
  } else {
      $('#return-to-top').fadeOut(200);   // Else fade out the arrow
  }
});
$('#return-to-top').click(function() {      // When arrow is clicked
  $('body,html').animate({
      scrollTop : scrollTo                     // Scroll to top of body
  }, 500);
});
});
