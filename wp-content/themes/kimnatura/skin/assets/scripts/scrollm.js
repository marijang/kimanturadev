var test = 'test';



$(function() {
    var elem = document.getElementById('page-navigation');
    var scrollMonitor = require("scrollMonitor");
    var RevealFx = require("./revealfx");
    console.log(RevealFx);


    $('.article-list').each(function(index, section) {
        var elementWatcher = scrollMonitor.create( section );

        var rev3 = new RevealFx(section, {
            revealSettings : {
              bgcolor: '#fcf652',
              direction: 'rl',
              onCover: function(contentEl, revealerEl) {
                contentEl.style.opacity = 1;
              }
            }
          });
    
          
    rev4 = new RevealFx(section.querySelector(".article-list__content"), {
              revealSettings : {
              bgcolor: '#7f40f1',
              direction: 'rl',
              delay: 250,
              onCover: function(contentEl, revealerEl) {
                contentEl.style.opacity = 1;
              }
            }
    });
    
    rev5 = new RevealFx(section.querySelector(".article-list__image"), {
      revealSettings : {
      bgcolor: '#00000',
      direction: 'rl',
      delay: 150,
      onCover: function(contentEl, revealerEl) {
        contentEl.style.opacity = 1;
      }
    }
    });

        elementWatcher.enterViewport(function() {
            console.log( 'I have entered the viewport' );
            rev3.reveal();
            rev4.reveal();
            rev5.reveal();
            //elementWatcher.destroy();
        });
        elementWatcher.exitViewport(function() {
            console.log( 'I have left the viewport' );
        });

    });

});
