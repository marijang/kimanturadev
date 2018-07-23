
$(function() {
    
    $("body").addClass("loader-open");
    $(".loader__wrap").addClass("view");
    
  
    $(document).ready(function() {
        if (localStorage.getItem("lastRun") === null || (Math.abs(new Date(localStorage.getItem("lastRun")) - new Date()) / 36e5) > 1) {
            $('.loader-hidden').removeClass('loader-hidden');
            localStorage.setItem('lastRun', new Date());
        }

        $(window).on("load", function() {
        
        
        setTimeout(function() {
                
                $(".view").addClass("loader-hidden");
                setTimeout(function() {
                    $("body").removeClass("loader-open");
                   
                },1100)
            }, 1000) //1500

      
            
        });

    });


   
   // $(window).on("beforeunload", function() {
        //$(window).scrollTop(0)
        //$(".view").removeClass("loader-hidden");
    //})

});
