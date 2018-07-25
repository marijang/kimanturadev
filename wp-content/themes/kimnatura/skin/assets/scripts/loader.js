
$(function() {
    
    
    
  
    $(document).ready(function() {
        

        $(window).on("load", function() {
            if (localStorage.getItem("lastRun") === null || (Math.abs(new Date(localStorage.getItem("lastRun")) - new Date()) / 36e5) > 1) {
                $("body").addClass("loader-open");
                $(".loader__wrap").addClass("view");
                $('.loader-hidden').removeClass('loader-hidden');
                localStorage.setItem('lastRun', new Date());
            }
        
        setTimeout(function() {
                
                $(".view").addClass("loader-hidden");
                setTimeout(function() {
                    $("body").removeClass("loader-open");
                   
                },2000)
            }, 2500) //1500

      
            
        });

    });


   
   // $(window).on("beforeunload", function() {
        //$(window).scrollTop(0)
        //$(".view").removeClass("loader-hidden");
    //})

});
