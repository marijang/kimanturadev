import 'slick-carousel';

$(function() {
  $('.hero-slider-slick').on('init', function(event, slick){
    event.preventDefault();
    $('.hero-slider-slick .slick-active').find('.hero__item').addClass('animated');
});
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
            fade:false,
            dots: false,
            adaptiveHeight: true
          }
        }
      ],
    });





$('.hero-slider-slick').on('beforeChange', function(event, slick, currentSlide, nextSlide){
  event.preventDefault();
  var $slide = $(slick.$slides[currentSlide]);
  console.log($slide.find('.hero_item'));
  $slide.find('.hero_item').removeClass('animated');
 // var activeSlide = $('.hero-slider-slick .slick-active').find('.hero__item');
  var otherSlides = $('.hero-slider-slick .slick-slide').find('.hero__item');
  otherSlides.removeClass('animated');
  event.preventDefault();
});
$('.hero-slider-slick').on('afterChange', function(event, slick, currentSlide){
  var $slide = $(slick.$slides[currentSlide]);
  $slide.find('.hero__item').addClass('animated');
});

    $('.sastojci-slider-slick').slick({
      // normal options...
            infinite: true,
            slidesToShow: 1,
            dots:true,
            arrows:true,
            fade:true,
            autoplay:true,
            dotsClass: 'sastojci__paging',
            customPaging: function (slider, i) {
                //FYI just have a look at the object to find available information
                //press f12 to access the console in most browsers
                //you could also debug or look in the source
                //console.log(slider);
                return  (i + 1) + '/' + slider.slideCount;
            },

            cssEase: 'ease-in-out',
           // speed: 500,
            //fade: true,
  //cssEase: 'linear',
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

$('.sastojci-slider-slick1').on('beforeChange', function(event, slick, currentSlide, nextSlide){
    $('.sastojci-slider-slick').parent().removeClass('animated');
});
$('.sastojci-slider-slick1').on('afterChange', function(event, slick, currentSlide){
   var $slide = $(slick.$slides[currentSlide]);
    slick.$slides.removeClass('animated');
  //  $slide.addClass('animated');
    $('.sastojci-slider-slick1').parent().removeClass('animated');
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