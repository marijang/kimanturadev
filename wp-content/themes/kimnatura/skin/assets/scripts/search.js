/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2016, Codrops
 * http://www.codrops.com
 */
$(document).ready( function() {
   
	    var mainContainer = document.querySelector('.main-wrap'),
		openCtrl = document.getElementById('btn-search'),
		closeCtrl = document.getElementById('btn-search-close'),
		searchContainer = document.querySelector('.search'),
        inputSearch = searchContainer.querySelector('.search__input'),
        search = document.getElementById('search-wrap'),
        searchUp = document.getElementById('search-up'),
        searchDown = document.getElementById('search-down'),
        body = $('body');

	function init() {
		initEvents();	
	}

	function initEvents() {
		openCtrl.addEventListener('click', openSearch);
        closeCtrl.addEventListener('click', closeSearch);
		document.addEventListener('keyup', function(ev) {
			// escape key.
			if( ev.keyCode == 27 ) {
                closeSearch();
                closeCtrl.click();
			}
		});
    }
    
    function searchScroll() {
        console.log($(search).scrollTop());
        if ($(search).scrollTop() > 0){
            $(searchUp).addClass("scrolled");
            $(searchDown).addClass("scrolled");
		}
		else
		{
            $(searchUp).removeClass("scrolled");
            $(searchDown).removeClass("scrolled");
		}
    }


	function openSearch() {
        body.addClass('search-show');
		mainContainer.classList.add('main-wrap--hide');
        searchContainer.classList.add('search--open');
        search.addEventListener('scroll', searchScroll);
		setTimeout(function() {
			inputSearch.focus();
		}, 500);
	}

	function closeSearch() {
        body.removeClass('search-show');
		mainContainer.classList.remove('main-wrap--hide');
        searchContainer.classList.remove('search--open');
        search.removeEventListener('scroll', searchScroll);
		inputSearch.blur();
		inputSearch.value = '';
    }
    
    

    init();
    


});

// $(window).scroll(function(){
//     console.log('tu samm');
//     $('#search-nav').toggleClass('scrolled', $(document).scrollTop() > 0);
//  });


$(function() {
    var action = 'search';
    // var url = themeLocalization.ajaxurl + '?action=example&start=2&load=2';
    // var allPanels = $('.shop-categories__childs').show();
    $('#btn-search').on('click', function(e){
        e.preventDefault();
        
        // var $input = $form.find('input[name="s"]');
        // var query = $input.val();

        var $this = $(this);
        var $query  = $this.data('current');
        var url = themeLocalization.ajaxurl + '?action=search';
        $.ajax({
            type : "get",
            //dataType : "json",
            url : url,
           // data : {action: action, post_id : post_id, nonce: nonce},
            success: function(response) {
               if(response) {
                   $("#search-results").html(response);
               }
               else {
                  alert("Your vote could not be added")
               }
            }
         });   
    });

    

    function search( event ) {
        event.preventDefault();
        var $this = $(this);
        var $input = $this.find('input[name="s"]');
        var search = $this.val();
        var url = themeLocalization.ajaxurl + '?action=search&search='+search;
        $.ajax({
            type : "get",
            //dataType : "json",
            url : url,
           // data : {action: action, post_id : post_id, nonce: nonce},
            success: function(response) {
               if(response) {
                    $("#search-results").html(response);
               }
               else {
                  alert("Your vote could not be added")
               }
            }
         });
        };

    $( "#search-form" ).submit(search);
    $( '#search-input' ).keyup(search);
    $('#btn-search-close').click(search);

	
});





