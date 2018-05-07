import 'slick-carousel';

$(function() {

$(".slider-slick").slick({

  // normal options...
  infinite: false,
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  dots:true,

  // the magic
  responsive: [{

      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        infinite: true
      }

    }, {

      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        dots: true
      }

    }, {

      breakpoint: 300,
      settings: "unslick" // destroys slick

    }]
});
  
});