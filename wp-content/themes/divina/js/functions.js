/**
 * Theme functions file.
 *
 */

( function( $ ) {

	/**
 	* Load
 	*/
	$( window ).load( function() {
       	$( "#loading" ).fadeOut( 500 );
    } )

  	/**
 	* Add dropdown toggle that display child menu items.
 	*/
	$( '.main-navigation .menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"></button>' );
	/**
 	* Toggle buttons and submenu items with active children menu items.
 	*/
	$( '.main-navigation .current-menu-ancestor > button' ).addClass( 'toggle-on' );
	$( '.main-navigation .current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );
	$( '.dropdown-toggle' ).click( function( e ) {
		var _this = $( this );
		e.preventDefault();
		_this.toggleClass( 'toggle-on' );
		_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
		_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
	} );

	/**
 	* Toggle visibility menu for smartphone and tablet
 	*/
	$( '.secondary-toggle' ).click( function( e ){
		var _this = $( '.zona-menu' );
		e.preventDefault();
		_this.toggleClass( 'visibile' );
	} );

	/**
 	* Document ready
 	*/
 	$( document ).ready( function() {
 		
  		// Initialize nanoScroller
  		$( '.nano' ).nanoScroller();

  		// Initialize Fittext
  		$( '.site-title' ).fitText();
  		$( '.site-deswcription' ).fitText();
  		  	
	});

} )( jQuery );