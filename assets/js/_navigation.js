/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 
TO DO - tidy this file up - remove vars that aren't needed


Don't think we even this file???

 */


console.log("navigation.js");
jQuery(document).ready(function($) {



	




//	var trigger_home = document.getElementById("trigger_home");
// var trigger_menu = document.getElementById("trigger_menu");
    
//    var toptriggerLine = document.getElementById("top_line");
//    var trigger_top_Line = document.getElementById("trigger_top_line");


//    var middletriggerLine = document.getElementById("middle_line");
//    var bottomtriggerLine = document.getElementById("bottom_line");
   var arrowmask = document.getElementById("arrowmask");

 
	var nav = document.getElementById( 'site-navigation' ), button, menu;
	if ( ! nav )
		return;
	button = nav.getElementsByClassName( 'menu-toggle' )[0];
	menu   = nav.getElementsByTagName( 'ul' )[0];
	


	
	
	if ( ! button )
		return;

	// Hide button if menu is missing or empty.
	if ( ! menu || ! menu.childNodes.length ) {
		button.style.display = 'none';
		return;
	}

	button.onclick = function toggler() {
		if ( -1 == menu.className.indexOf( 'nav-menu' ) )
			menu.className = 'nav-menu';

		if ( -1 != button.className.indexOf( ' toggled-on' ) ) {
			button.className = button.className.replace( ' toggled-on', '' );
			menu.className = menu.className.replace( ' toggled-on', '' );
		
	//		trigger_menu.beginElement();
	//		trigger_home.beginElement();

			//trigger_top_Line.beginElement();

			$('.home-icon').removeClass('on');
			$('#main').removeClass('on');
			$('#headfix').removeClass('on');

			$('.head-holder').css({ "background-color": "red" }); // fix for mobiles; hover state

			
	//		trigger_menu.setAttribute("from", "90 25 25");
    //    	trigger_menu.setAttribute("to", "0 25 25");

	//		trigger_home.setAttribute("from", "90 25 25");
     //   	trigger_home.setAttribute("to", "0 25 25");

 		    arrowmask.setAttribute("d", "M2.436,11.605L10,4.04l7.557,7.558l0,0c0.002,0.001,0.003,0.003,0.003,0.004 c0.559,0.558,1.464,0.558,2.021,0c0.559-0.559,0.559-1.464,0-2.021c-0.002-0.001-0.004-0.003-0.005-0.003h0.001l-9.573-9.575L10,0 L9.995,0.003L0.415,9.585l0,0c-0.554,0.557-0.552,1.459,0.003,2.016C0.975,12.157,1.877,12.159,2.436,11.605z");
		//	arrowmask.beginElement()

		//	setheightattr();
		//	totalhome();

    //        toptriggerLine.setAttribute("d", "M50,3.571C50,1.604,48.408,0.008,46.442,0l0,0H3.586l0,0C3.58,0,3.576,0,3.571,0C1.599,0,0,1.599,0,3.571 s1.599,3.571,3.571,3.571c0.005,0,0.009,0,0.015,0l0,0h42.856l0,0C48.408,7.135,50,5.539,50,3.571z");

    //        middletriggerLine.setAttribute("d", "M50,25c0-1.968-1.592-3.563-3.558-3.571l0,0H3.586l0,0c-0.006,0-0.01,0-0.015,0C1.599,21.429,0,23.027,0,25 s1.599,3.571,3.571,3.571c0.005,0,0.009,0,0.015,0l0,0h42.856l0,0C48.408,28.563,50,26.968,50,25z");

   //         bottomtriggerLine.setAttribute("d", "M50,46.429c0-1.968-1.592-3.563-3.558-3.571l0,0H3.586l0,0c-0.006,0-0.01,0-0.015,0C1.599,42.857,0,44.456,0,46.429 C0,48.4,1.599,50,3.571,50c0.005,0,0.009,0,0.015,0l0,0h42.856l0,0C48.408,49.992,50,48.396,50,46.429z");
        ////http://webbugtrack.blogspot.co.uk/2007/08/bug-242-setattribute-doesnt-always-work.html  
		
			
		} else {

			button.className += ' toggled-on';
			menu.className += ' toggled-on';
			
	//		trigger_menu.beginElement();
		//	trigger_home.beginElement();

		//	trigger_top_Line.beginElement();

			$('.home-icon').addClass('on');
			$('#main').addClass('on');
			$('#headfix').addClass('on');

				    arrowmask.setAttribute("d", "M17.564,11.374L10,18.939l-7.557-7.558l0,0C2.441,11.38,2.44,11.378,2.44,11.377 c-0.559-0.558-1.464-0.558-2.021,0c-0.559,0.558-0.559,1.462,0,2.021c0.002,0,0.004,0.002,0.005,0.002H0.423l9.572,9.574L10,22.979 l0.005-0.004l9.581-9.582l0,0c0.554-0.557,0.552-1.459-0.003-2.015C19.025,10.821,18.123,10.819,17.564,11.374z");
		//				arrowmask.beginElement()

		//	setheightattr();
		//	totalhome();

		
	//		trigger_menu.setAttribute("from", "0 25 25");
     //       trigger_menu.setAttribute("to", "90 25 25");	

	//		trigger_home.setAttribute("from", "0 25 25");
    //        trigger_home.setAttribute("to", "90 25 25");


  	//		toptriggerLine.setAttribute("d", "M1.046,48.954c1.392,1.392,3.646,1.395,5.041,0.009v0.001L48.944,6.106h-0.001c0.004-0.003,0.007-0.007,0.011-0.01 c1.395-1.395,1.395-3.656,0-5.051s-3.656-1.395-5.051,0c-0.004,0.003-0.007,0.007-0.01,0.011V1.056L1.036,43.913l0,0  C-0.349,45.309-0.346,47.562,1.046,48.954z");


  	//		middletriggerLine.setAttribute("d", "M28.558,25c0-1.968-1.592-3.563-3.558-3.571l0,0l0,0l0,0c-0.006,0-0.01,0-0.015,0c-1.973,0-3.571,1.599-3.571,3.571 s1.599,3.571,3.571,3.571c0.005,0,0.009,0,0.015,0l0,0l0,0l0,0C26.966,28.563,28.558,26.968,28.558,25z");

    //		bottomtriggerLine.setAttribute("d", "M48.954,48.954c1.392-1.392,1.395-3.646,0.01-5.041l0,0L6.106,1.056v0.001C6.104,1.053,6.1,1.049,6.097,1.046 c-1.395-1.395-3.656-1.395-5.051,0s-1.395,3.656,0,5.051C1.049,6.1,1.053,6.104,1.057,6.106H1.056l42.857,42.857v-0.001 C45.309,50.349,47.562,50.346,48.954,48.954z");


   

         	
		}
	};





	 function initheadroom(){

        if ($("#header-nav-area").length){
      
        console.log("#header-nav-area exists")

            $("#header-nav-area").headroom({
                  // vertical offset in px before element is first unpinned
                "offset": 0, // This value maybe a variable; we need to cater for the arhive page
                "tolerance": 5,
                    // scroll tolerance in px before state changes

                // "tolerance" : {
                //    "up" : ,
                //   "down" : 100
                //    },
                "classes": {
                  "initial": "animated",
                  "pinned": "pinned",
                  "unpinned": "unpinned"
                }

            });

/*
            $('#header-nav-area').hover(function(){
                 
               //console.log("sc-player hover")
               // ensure headroom pinned
                forceheadroompin();

            }); // hover 
*/

             /*

var options = {

    offset : 0,
    // scroll tolerance in px before state changes
    tolerance : 0,
    // or you can specify tolerance individually for up/down scroll
    tolerance : {
        up : 5,
        down : 0
    },
    // css classes to apply
    classes : {
        // when element is initialised
        initial : "headroom",
        // when scrolling up
        pinned : "headroom--pinned",
        // when scrolling down
        unpinned : "headroom--unpinned",
        // when above offset
        top : "headroom--top",
        // when below offset
        notTop : "headroom--not-top",
        // when at bottom of scoll area
        bottom : "headroom--bottom",
        // when not at bottom of scroll area
        notBottom : "headroom--not-bottom",
        // when frozen method has been called
        frozen: "headroom--frozen"
    },
    // element to listen to scroll events on, defaults to `window`
    scroller : someElement,
    // callback when pinned, `this` is headroom object
    onPin : function() {},
    // callback when unpinned, `this` is headroom object
    onUnpin : function() {},
    // callback when above offset, `this` is headroom object
    onTop : function() {},
    // callback when below offset, `this` is headroom object
    onNotTop : function() {},
    // callback when at bottom of page, `this` is headroom object
    onBottom : function() {},
    // callback when moving away from bottom of page, `this` is headroom object
    onNotBottom : function() {}
};
// pass options as the second argument to the constructor
// supplied options are merged with defaults
var headroom = new Headroom(element, options);




                */

      

        } else {
        console.log("#header-nav-area doesn't exist");
        }

    } // function initheadroom()

    /*

    function destroyheadroom(){
      // to destroy
      $("#header-nav-area").headroom("destroy");

    }// destroyheadroom()
*/

    /*
    function forceheadroompin(){

       if ($("#header-nav-area").hasClass("unpinned")){
        
          $("#header-nav-area").removeClass("unpinned");
          $("#header-nav-area").addClass("pinned");

          //console.log("unpinned - now pinned");

       }

    }//forceheadroom

    */


  /* end headroom */
} );


