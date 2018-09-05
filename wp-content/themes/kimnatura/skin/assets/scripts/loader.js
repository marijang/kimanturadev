import $ from 'jquery';
global.$ = global.jQuery = $;

function showLoader(){
    if (localStorage.getItem("lastRun") === null /*|| (Math.abs(new Date(localStorage.getItem("lastRun")) - new Date()) / 36e5) > 1*/) {
                        $("body").addClass("loader-open");
                     
                        $(".loader__wrap").addClass("view");
                        $('.loader-hidden').removeClass('loader-hidden');
                        localStorage.setItem('lastRun', new Date());
                        setTimeout(function() {
                        
                            $(".loader__wrap").addClass("loader-hidden");
                            setTimeout(function() {
                                $("body").removeClass("loader-open");
                               
                            },2000)
                         }, 2500); //1500
                   }
                   else{
                   // $('.loader__wrap').addClass('loader-hidden');
                   console.log('remove');
                    $('.loader__wrap').remove();
                    
                   }
}

$(document).ready(function() {
    showLoader();
});

// $(document).ready(function() {
//         $(window).on("load", function() {
//             console.log('ulaz');
//             if (localStorage.getItem("lastRun") === null /*|| (Math.abs(new Date(localStorage.getItem("lastRun")) - new Date()) / 36e5) > 1*/) {
//                 $("body").addClass("loader-open");
             
//                 $(".loader__wrap").addClass("view");
//                 $('.loader-hidden').removeClass('loader-hidden');
//                 localStorage.setItem('lastRun', new Date());
//                 setTimeout(function() {
                
//                     $(".loader__wrap").addClass("loader-hidden");
//                     setTimeout(function() {
//                         $("body").removeClass("loader-open");
                       
//                     },2000)
//                  }, 2500); //1500
//            }
//            else{
//            // $('.loader__wrap').addClass('loader-hidden');
//            console.log('remove');
//             $('.loader__wrap').remove();
            
//            }
        
     

      
            
//         });




   
   // $(window).on("beforeunload", function() {
        //$(window).scrollTop(0)
        //$(".view").removeClass("loader-hidden");
    //})

//});
