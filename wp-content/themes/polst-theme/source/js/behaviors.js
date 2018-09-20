
(function( $ ){

	//======================================
	// navigation

	jQuery('ul.js-superfish').superfish({
		delay:       700,                            // delay on mouseout
		animation:   {opacity:'show'},  // fade-in and slide-down animation
		speed:       100,                          // faster animation speed
		autoArrows:  true,                            // disable generation of arrow mark-up
		disableHI:     true,
		speedOut:      0
	});

	// highlight ancestors for single and single-blog
	if ( jQuery('body').hasClass('single-post') ) {
		jQuery('.menu a  span:contains("News")').parents('li.menu-item').addClass('current-menu-ancestor');	
	}

	if ( jQuery('body').hasClass('single-blog') ) {
		jQuery('.menu a span:contains("Resources")').parents('li.menu-item').addClass('current-menu-ancestor');
		jQuery('.menu a  span:contains("Blog")').parents('li.menu-item').addClass('current-menu-item');	
	}
	
	//======================================
	// clone bottom navigation and appent to top

	if ( jQuery('body').hasClass('page-template-page_news') ) {
		jQuery('.archive-pagination').clone().prependTo( 'main.content' ).addClass('top-pagination');	
	}
	

	//======================================
	// carousels
	
	$('.module-image-carousel').slick({
		dots: true,
		nav: true,
		autoplay: true,
		autoplaySpeed: 5000,
	    prevArrow: '<span class="icon-arrow-left"></span>',
	    nextArrow: '<span class="icon-arrow-right"></span>',
	});


	//======================================
	// fitvids

	$(".entry-content").fitVids();

	//======================================
	// Print page
	
	$('#print-page').click(function() {
		window.print();  
		// return false; 
	});


	//======================================
	// Add shadows on table elements if they are overflowing
	
	// if ( $('table').width() > $(this).parent('.table-holder-outer').width() + 10 ) {
	// 	$('.table-holder-outer').addClass('overflowing');
	// }
	
	
	//======================================
	// Handle modals
	$('.js-open-modal').click(function(event) {
		var $target = $(this).attr('data-target');
		// $($target).addClass('open');
		$($target).fadeIn('fast');
		$('body').addClass('modal-open');
		event.preventDefault();
	});
	$('.js-close-modal').click(function() {
		// $('.js-modal-handler').removeClass('open');
		$('.js-modal-handler').fadeOut('fast');
		$('body').removeClass('modal-open');
	});

})( jQuery );


jQuery(document).ready(function() {

	// tooltips
	jQuery(function () {
		if ( jQuery('[data-toggle="tooltip"]').length > 0 ) {
			jQuery('[data-toggle="tooltip"]').tooltip();
		}
		
	});

	// data tables 
	if (jQuery('.data_table').length > 0 ) { 

		// resources table
		var table = jQuery('#resources_table').DataTable({
			"paging": false, 
		    // select: true,
		    "stateSave": false,
		    "scrollX": true,
		    "columnDefs": [
	            {
	                "targets": [ 5 ],
	                "visible": false,
	                "searchable": true
	            },
	            {
	                "targets": [ 6 ],
	                "visible": false,
	                "searchable": true
	            }
	        ],
	        "aaSorting": []
		    
		});
	 
		jQuery('.resource-filter-select').change( function() {

		 	var allFilters = jQuery('.resource-filter-select').map(function(){
		    return jQuery(this).val();
			}).get();

		 	allFilters = allFilters.join( " " );
			table.search( allFilters ).draw(); 
	   	});

	   	jQuery('.js-reset-filters').click(function(event) {
	   		var allFilters = jQuery('.resource-filter-select').map(function(){
		    return jQuery(this).val('');
			}).get();
			table.search( allFilters ).draw(); 
	   		table.search( '' ).draw(); 
	   	});


	   	// newsletter archave table
	   	jQuery('#nla_table').DataTable({
			"paging": false,
	        "aaSorting": false 
		});

	}

});


    

// 
// (function( $ ){
// var time = 7; // time in seconds
 
// var $progressBar,
//     $bar, 
//     $elem, 
//     isPause, 
//     tick,
//     percentTime;

// // Init the carousel
// $('#module-image-carousel').owlCarousel({
//     loop: true,
//     margin: 10,
//     nav: true,
//     items: 1,
//     onInitialized: progressBar,
//     onTranslated: moved,
//     onDrag: pauseOnDragging
// });

// // Init progressBar where elem is $("#owl-demo")
// function progressBar(){    
//     // build progress bar elements
//     buildProgressBar();
    
//     // start counting
//     start();
// }

// // create div#progressBar and div#bar then prepend to $("#owl-demo")
// function buildProgressBar(){
//     $progressBar = $("<div>",{
//         id:"progressBar"
//     });
    
//     $bar = $("<div>",{
//         id:"bar"
//     });
    
//     $progressBar.append($bar).prependTo($("#owl-demo"));
// }

// function start() {
//     // reset timer
//     percentTime = 0;
//     isPause = false;
    
//     // run interval every 0.01 second
//     tick = setInterval(interval, 10);
// };

// function interval() {
//     if(isPause === false){
//         percentTime += 1 / time;
        
//         $bar.css({
//             width: percentTime+"%"
//         });
        
//         // if percentTime is equal or greater than 100
//         if(percentTime >= 100){
//             // slide to next item 
//             $("#owl-demo").trigger("next.owl.carousel");
//             percentTime = 0; // give the carousel at least the animation time ;)
//         }
//     }
// }

// // pause while dragging 
// function pauseOnDragging(){
//     isPause = true;
// }

// // moved callback
// function moved(){
//     // clear interval
//     clearTimeout(tick);
    
//     // start again
//     start();
// }

// })( jQuery );

//======================================
// equal height columns
jQuery(window).load(function() {

// jQuery(function ($) {
    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = [],
        $el,
        currentDiv,
        topPosition = 0;

    jQuery('.eqh').each(function() {

        $el = jQuery(this);
        topPosition = $el.position().top;

        if (currentRowStart !== topPosition) {

            // we just came to a new row.  Set all the heights on the completed row
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }

            // set the variables for the new row
            rowDivs.length = 0; // empty the array
            currentRowStart = topPosition;
            currentTallest = $el.height();
            rowDivs.push($el);

        } else {

            // another div on the current row.  Add it to the list and check if it's taller
            rowDivs.push($el);
            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

        }
       
        // do the last row
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
   
    });
});




// ****************************************************************************************
// responsive nav 2
( function ( document, $, undefined ) {
	'use strict';

	var leaven              = {},
		mainMenuButtonClass = 'menu-toggle',
		subMenuButtonClass  = 'sub-menu-toggle';

	leaven.init = function() {
		var toggleButtons = {
			menu : $( '<button />', {
				'class' : mainMenuButtonClass,
				'aria-expanded' : false,
				'aria-pressed' : false,
				'role' : 'button'
				} )
				.append( leaven.params.mainMenu ),
			submenu : $( '<button />', {
				'class' : subMenuButtonClass,
				'aria-expanded' : false,
				'aria-pressed' : false,
				'role' : 'button'
				} )
				.append( $( '<span />', {
					'class' : 'screen-reader-text',
					text : leaven.params.subMenu
				} ) )
		};
		$( 'nav.nav-primary ' ).before( toggleButtons.menu ); // add the main nav buttons
		$( 'nav.nav-primary  .sub-menu' ).before( toggleButtons.submenu ); // add the submenu nav buttons
		$( '.' + mainMenuButtonClass ).each( _addClassID );
		$( window ).on( 'resize.leaven', _doResize ).triggerHandler( 'resize.leaven' );
		$( '.' + mainMenuButtonClass ).on( 'click.leaven-mainbutton', _mainmenuToggle );
		$( '.' + subMenuButtonClass ).on( 'click.leaven-subbutton', _submenuToggle );
	};

	// add nav class and ID to related button
	function _addClassID() {
		var $this = $( this ),
			nav   = $this.next( 'nav.nav-primary ' ),
			id    = 'class';
		$this.addClass( $( nav ).attr( 'class' ) );
		if ( $( nav ).attr( 'id' ) ) {
			id = 'id';
		}
		$this.attr( 'id', 'mobile-' + $( nav ).attr( id ) );
	}

	// Change Skiplinks and Superfish
	function _doResize() {
		var buttons = $( 'button[id^=mobile-]' ).attr( 'id' );
		if ( typeof buttons === 'undefined' ) {
			return;
		}
		_superfishToggle( buttons );
		_changeSkipLink( buttons );
		_maybeClose( buttons );
	}

	/**
	 * action to happen when the main menu button is clicked
	 */
	function _mainmenuToggle() {
		var $this = $( this );
		_toggleAria( $this, 'aria-pressed' );
		_toggleAria( $this, 'aria-expanded' );
		$this.toggleClass( 'activated' );
		$this.next( 'nav.nav-primary , .sub-menu' ).slideToggle( 'fast' );
	}

	/**
	 * action for submenu toggles
	 */
	function _submenuToggle() {

		var $this  = $( this ),
			others = $this.closest( '.menu-item' ).siblings();
		_toggleAria( $this, 'aria-pressed' );
		_toggleAria( $this, 'aria-expanded' );
		$this.toggleClass( 'activated' );
		$this.next( '.sub-menu' ).slideToggle( 'fast' );

		others.find( '.' + subMenuButtonClass ).removeClass( 'activated' ).attr( 'aria-pressed', 'false' );
		others.find( '.sub-menu' ).slideUp( 'fast' );

	}

	/**
	 * activate/deactivate superfish
	 */
	function _superfishToggle( buttons ) {
		if ( typeof $( '.js-superfish' ).superfish !== 'function' ) {
			return;
		}
		if ( 'none' === _getDisplayValue( buttons ) ) {
			$( '.js-superfish' ).superfish( {
				'delay': 100,
				'animation': {'opacity': 'show', 'height': 'show'},
				'dropShadows': false
			});
		} else {
			$( '.js-superfish' ).superfish( 'destroy' );
		}
	}

	/**
	 * modify skip links to match mobile buttons
	 */
	function _changeSkipLink( buttons ) {
		var startLink = 'genesis-nav',
			endLink   = 'mobile-genesis-nav';
		if ( 'none' === _getDisplayValue( buttons ) ) {
			startLink = 'mobile-genesis-nav';
			endLink   = 'genesis-nav';
		}
		$( '.genesis-skip-link a[href^="#' + startLink + '"]' ).each( function() {
			var link = $( this ).attr( 'href' );
			link = link.replace( startLink, endLink );
			$( this ).attr( 'href', link );
		});
	}

	function _maybeClose( buttons ) {
		if ( 'none' !== _getDisplayValue( buttons ) ) {
			return;
		}
		$( '.menu-toggle, .sub-menu-toggle' )
			.removeClass( 'activated' )
			.attr( 'aria-expanded', false )
			.attr( 'aria-pressed', false );
		$( 'nav.nav-primary , .sub-menu' )
			.attr( 'style', '' );
	}

	/**
	 * generic function to get the display value of an element
	 * @param  {id} $id ID to check
	 * @return {string}     CSS value of display property
	 */
	function _getDisplayValue( $id ) {
		var element = document.getElementById( $id ),
			style   = window.getComputedStyle( element );
		return style.getPropertyValue( 'display' );
	}

	/**
	 * Toggle aria attributes
	 * @param  {button} $this     passed through
	 * @param  {aria-xx} attribute aria attribute to toggle
	 * @return {bool}           from _ariaReturn
	 */
	function _toggleAria( $this, attribute ) {
		$this.attr( attribute, function( index, value ) {
			return _ariaReturn( value );
		});
	}

	/**
	 * update aria-xx value of an attribute
	 * @param  {aria-xx} value passed from function
	 * @return {bool}
	 */
	function _ariaReturn( value ) {
		return 'false' === value ? 'true' : 'false';
	}

	$(document).ready(function () {
		leaven.params = typeof LeavenL10n === 'undefined' ? '' : LeavenL10n;

		if ( typeof leaven.params !== 'undefined' ) {
			leaven.init();
		}
	});

})( document, jQuery );