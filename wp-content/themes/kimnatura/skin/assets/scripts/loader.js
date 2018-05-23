
$(function() {
    $("body").addClass("loader-open");
    $(".loader__wrap").addClass("view");

    $(document).ready(function() {
        $(window).on("load", function() {
            setTimeout(function() {
                $(".view").addClass("loader-hidden");
                setTimeout(function() {
                    $("body").removeClass("loader-open");
                   
                },1600)
            }, 1500) //1500
        });

    });

    $(window).on("beforeunload", function() {
        $(window).scrollTop(0)
        //$(".view").removeClass("loader-hidden");
    })

});
