//import {scrollMonitor} from 'scrollMonitor';
//var scrollMonitor = require("scrollmonitor");
$(function() {
    var elem = document.getElementById('page-navigation');
    //console.log(scrollMonitor);
    var scrollMonitor = require("scrollmonitor");
    var RevealFx = require("./revealfx");

    $('.section').each(function(index, section) {
        var elementWatcher = scrollMonitor.create( section );
        elementWatcher.enterViewport(function() {
            $(section).addClass('animated');
            elementWatcher.destroy();
        });
    });
   

    $('.gallery').each(function(index, section) {
        var elementWatcher = scrollMonitor.create( section );
        elementWatcher.enterViewport(function() {
           // $('.addthis_toolbox').fadeOut();
        });
        elementWatcher.exitViewport(function() {
           // $('.addthis_toolbox').fadeIn();
         });
    });

    $('.article-list').each(function(index, section) {
        var elementWatcher = scrollMonitor.create( section );
        elementWatcher.enterViewport(function() {
           // console.log( 'I have entered the viewport' );
           /*
            var rev3 = new RevealFx(section, {
                revealSettings : {
                bgcolor: '#fcf652',
                direction: 'rl',
                onCover: function(contentEl, revealerEl) {
                    contentEl.style.opacity = 1;
                }
                }
            });

            */
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
           // console.log( 'I have left the viewport' );
        });

    });

});
