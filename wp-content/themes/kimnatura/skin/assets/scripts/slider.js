import 'slick-carousel';

$(function() {

  $('.hero-slider-slick').slick({
// normal options...
      infinite: false,
      infinite: false,
      slidesToShow: 1,
      dots:true,
      arrows:false,
      //cssEase: 'ease-in-out',
      //autoplay:true,
      //autoplaySpeed: 3000
      fade:true,
      speed: 0,
      useCSS:false,
      useTransform:true,
      waitForAnimate: true,
      
      responsive: [
        {
          breakpoint: 600,
          settings: {
            arrows:true,

            dots: false
          }
        }
      ],
    });

$('.hero-slider-slick').on('beforeChange', function(event, slick, currentSlide, nextSlide){
  event.preventDefault();
  console.log(event);
 // slick.preventDefault();
  $('.hero-slider-slick').parent().removeClass('animated');
  var $slide = $(slick.$slides[currentSlide]);
  var $nextslide = $(slick.$slides[nextSlide]);
  $slide.removeClass('animated');
  $nextslide.addClass('animated');
  //$slide.find('h2').html('ok');
  //alert('before');
  $('.hero-slider-slick').parent().removeClass('animated');
  event.preventDefault();

});
$('.hero-slider-slick').on('afterChange1', function(event, slick, currentSlide){
  var $slide = $(slick.$slides[currentSlide]);
  slick.$slides.removeClass('animated');
  $slide.addClass('animated');
  //$slide.css('background','red');
  $('.hero-slider-slick').parent().removeClass('animated');
  //alert('ok');
});

    $('.sastojci-slider-slick').slick({
      // normal options...
            infinite: false,
            infinite: true,
            slidesToShow: 1,
            dots:true,
            arrows:true,
     
            dotsClass: 'sastojci__paging',
            customPaging: function (slider, i) {
                //FYI just have a look at the object to find available information
                //press f12 to access the console in most browsers
                //you could also debug or look in the source
                //console.log(slider);
                return  (i + 1) + '/' + slider.slideCount;
            },

           // cssEase: 'ease-in-out',
            speed: 500,
  fade: true,
  cssEase: 'linear',
            //fade: true,
            //autoplay:true,
            //autoplaySpeed: 3000
            responsive: [
              {
                breakpoint: 600,
                settings: {
                  arrows:true,
                  //dots: false
                }
              }
            ],
          });

$('.sastojci-slider-slick').on('beforeChange', function(event, slick, currentSlide, nextSlide){
    $('.sastojci-slider-slick').parent().removeClass('animated');
});
$('.sastojci-slider-slick').on('afterChange', function(event, slick, currentSlide){
   var $slide = $(slick.$slides[currentSlide]);
    slick.$slides.removeClass('animated');
    $slide.addClass('animated');
    //$slide.css('background','red');
    $('.sastojci-slider-slick').parent().removeClass('animated');
    //alert('ok');
});

$(".products__slider").slick({

  // normal options...
  infinite: false,
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  dots:true,
  centerMode:false,

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
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }

    }, {

      breakpoint: 300,
      settings: "unslick" // destroys slick

    }]
});
  
});