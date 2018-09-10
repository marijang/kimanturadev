$(document).ready(function() {
    $("a").on("touchend", function(e) {
      var el = $(this);
      el.click();
    });
  });