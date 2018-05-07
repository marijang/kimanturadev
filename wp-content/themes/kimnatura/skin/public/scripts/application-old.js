
$inputs = function () {
    return jQuery('.c_input input');
  };
  
  function setInputActiveState(input) {
    jQuery(input).parent().addClass('active');
  }
  function unsetInputActiveState(input) {
    var $this = jQuery(input);
    var $formGroup = $this.parent();
  
    // remove active state if input is empty
    if (!$this.val()) $formGroup.removeClass('active');
  }
  
  var initializeInputs = function () {
    $inputs().each(function (index, input) {
      var $input = jQuery(input);
  
      // shouldn't be inited twice
      if ($input.data('c_input')) return;
  
      // set flag
      $input.data('c_input', true);
  
      $input.on({
        focusin: function focusin() {
          setInputActiveState(input);
        },
        focusout: function focusout() {
          unsetInputActiveState(input);
        }
      });
  
      if (input.value) setInputActiveState(input);
    });
  }
  
  
  
    //init inputs
    initializeInputs();
  
  
    (function() {
   
      window.inputNumber = function(el) {
    
        var min = el.attr('min') || false;
        var max = el.attr('max') || false;
    
        var els = {};
    
        els.dec = el.prev();
        els.inc = el.next();
    
        el.each(function(i,item) {
          //console.log(item);
          init(jQuery(item));
        });
    
        function init(el) {
    
          els.dec.on('click', decrement);
          els.inc.on('click', increment);
    
          function decrement() {
            var value = el[0].value;
            value--;
            if(!min || value >= min) {
              el[0].value = value;
            }
          }
    
          function increment() {
            var value = el[0].value;
            value++;
            if(!max || value <= max) {
              el[0].value = value++;
            }
          }
        }
      }
    })();
    //FontAwesomeConfig = { searchPseudoElements: true };
    //inputNumber(jQuery('.input__number'));
  
    jQuery(document).ready(function($){
     // jQuery('img').materialbox();
      jQuery('select').formSelect();
      jQuery('input[type="checkbox"]').addClass("filled-in");
      jQuery('input[type="radio"]').addClass("with-gap");
      jQuery('.collapsible').collapsible();
      jQuery('.carousel').carousel();
      jQuery('.modal').modal();
      jQuery('.modal-trigger').modal();
     // jQuery("#site-navigation").headroom();
    });
          
  
  
  //- Reading Progress Indicator
  jQuery(document).ready(function(){
  
    const progress = document.querySelector(".js-progress");
    const body = document.body;
    const html = document.documentElement;
  
    const updateSizes = () => ({
        height: Math.max(
            body.scrollHeight,
            body.offsetHeight,
            html.clientHeight,
            html.scrollHeight,
            html.offsetHeight
        ),
        vh: Math.max(html.clientHeight, window.innerHeight || 0)
    });
  
    let scrollY = 0;
    let sizes = updateSizes();
  
    const update = () =>
    progress.setAttribute(
        "value",
        100 - (sizes.height - scrollY - sizes.vh) / sizes.height * 100
    );
  
    const onScroll = () => {
        scrollY =
            (window.pageYOffset || document.scrollTop) -
            (document.clientTop || 0);
        requestAnimationFrame(update);
    };
  
    const onResize = () => {
        sizes = updateSizes();
        requestAnimationFrame(update);
    };
  
    if (progress) {
        progress.setAttribute("max", 100);
        window.addEventListener("scroll", onScroll, false);
        window.addEventListener("resize", onResize, false);
    }
  
  });
  
  // Social share 
  jQuery(document).ready(function(){
  // Sticky Social share
  // When the user scrolls the page, execute myFunction 
  window.onscroll = function() {myFunction()};
  
  // Get the navbar
  var pageContent = document.getElementById("page-content");
  var gallery = jQuery('.gallery');
  var socialshare = jQuery('#social-share');
  var socialshareHeight = jQuery('#social-share').height();
  var addthis = jQuery('.addthis_toolbox');
  var socialshareOffsetTop = 90;
  socialshareHeight = socialshareHeight+socialshareOffsetTop;
  
  var galleryPos = Array();
  gallery.each(function(i,item){
      galleryPos.push({ 'offset': item.offsetTop - socialshareHeight, 'height': jQuery(item).height()+socialshareHeight-socialshareOffsetTop } );
  });
  
  if(socialshare.length>0){
    window.onscroll = function() {myFunction()};
  }
  
  
  var x = jQuery('.sticky');
  
  socialshare.append(addthis);
  
  // Get the offset position of the navbar
  var pageContentOffset = pageContent.offsetTop - socialshareHeight;
  var stickyvisible = true;
  var currentPosition = 0;
  
  // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function myFunction() {
    if (window.pageYOffset >= pageContentOffset) {
      socialshare.addClass("is-active");
    } else {
      x.removeClass("is-active");
    }
    for(var i = currentPosition; i<galleryPos.length; i++){
      var $height = galleryPos[i].height;
      var $offset = galleryPos[i].offset;
      $height = $offset + $height;
      if(window.pageYOffset>= galleryPos[i].offset){
        stickyvisible = false;
      }
      if(window.pageYOffset>= $height){
        stickyvisible = true;
      }
      if(window.pageYOffset<= $offset){
        stickyvisible = true;
      }
    }
    if(stickyvisible){
      //x.html('vidljiv');
      x.addClass('fadeIn300');
      x.removeClass('fadeOut300');
    }else{
     // x.html('ne vidljiv');
      x.addClass('fadeOut300');
      x.removeClass('fadeIn300');
    }
  }
  });
  
  /// Skoro na svim stranicama gdje ima slider
  jQuery(window).load(function() {
    jQuery('.products__slider').owlCarousel({
        margin:0,
        loop:true,
        autoWidth:true,
       // autoHeight:true,
        items:3,
        nav:true,
        dots:true,
        navText: [
            '<i class="mi">&#xE314;</i>',
            '<i class="mi">&#xE315;</i>'
          ],
          responsive: {
            0: {
              items: 1
            },
            600: {
              items: 2
            },
            1000: {
              items: 2
            }
          },
          autoplay: true,
          autoplayHoverPause: true,
    })
    });
    
  
  // grab an element
  var myElement = document.getElementById("site-header");
  // construct an instance of Headroom, passing the element
  var headroom  = new Headroom(myElement);
  // initialise
  headroom.init(); 
    
  
  jQuery(window).load(function() {
    jQuery(".loadingdiv").removeClass("spinner");
  });
  
  
  
  
  