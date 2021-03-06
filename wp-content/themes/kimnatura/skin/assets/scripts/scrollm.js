//import {scrollMonitor} from 'scrollMonitor';
//var scrollMonitor = require("scrollmonitor");
$(function() {
    var elem = document.getElementById('page-navigation');
    // (scrollMonitor);
    var scrollMonitor = require("scrollmonitor");
    var RevealFx = require("./revealfx");

    $('.section').each(function(index, section) {
        var elementWatcher = scrollMonitor.create( section );
        elementWatcher.enterViewport(function() {
            $(section).addClass('animated');
            elementWatcher.destroy();
        });
    });
   

    $('.gallery1').each(function(index, section) {
        var elementWatcher = scrollMonitor.create( section );
        elementWatcher.enterViewport(function() {
           // $('.addthis_toolbox').fadeOut();
        });
        elementWatcher.exitViewport(function() {
            $('.addthis_toolbox').fadeIn();
         });
         elementWatcher.lock();

         elementWatcher.stateChange(function() {
            $offset = $(section).offset().top- $(window).scrollTop() - $('.addthis_toolbox').height() ;
             ($(section).offset().top- $(window).scrollTop());
             (elementWatcher.bottom);
             (elementWatcher.height);
            if ( $offset < 0){
                if(!this.isAboveViewport){
                    $('.addthis_toolbox').fadeOut();
                }
                
            }
            $(section).toggleClass('fixed', this.isAboveViewport)
         });
    });

    $('.article-list').each(function(index, section) {
        var elementWatcher = scrollMonitor.create( section );
        elementWatcher.enterViewport(function() {
            var rev4 = new RevealFx(section.querySelector(".article-list__content"), {
                revealSettings : {
                bgcolor: '#3DC19E',
                direction: 'rl',
                delay: 250,
                onCover: function(contentEl, revealerEl) {
                  contentEl.style.opacity = 1;
                }
              }
            });
      
            var rev5 = new RevealFx(section.querySelector(".article-list__image"), {
                revealSettings : {
                bgcolor: '#00000',
                direction: 'rl',
                delay: 150,
                onCover: function(contentEl, revealerEl) {
                contentEl.style.opacity = 1;
                }
            }
            });
           // rev3.reveal();
            rev4.reveal();
            rev5.reveal();
            elementWatcher.destroy();
        });
        elementWatcher.exitViewport(function() {
           //  ( 'I have left the viewport' );
        });

    });
});
