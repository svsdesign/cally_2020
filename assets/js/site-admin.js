/*
Theme Name: theseus
Theme URI: http://theseus.agency
Description: Theseus Theme
Author: Simon van Stipriaan
Author URI: http://svs.design
TO DO;

- If I use js media queires: mmake sure my breakpionts are correct -- Don't think theay AR?E



 */


console.log("site-admin.js loaded")
/* I need to think properly how to structure my scripts

  - Ensure I'm not looading script libraries that I don't need - how does this work with wordpreses enqueu + REST API < do my research first


  - Ensure I'm not looading scripts over and over again
  - some scripts should only load once:
    - dev tools; grids (but update via js)
    - navigations (but update via js - during browsing experience)
    - detect touch (this won't change after initial site load)
    - "start" - initial opacity / site loadng script - images loaded
  
    Other scripts
    - page /post specific

  - Only rune the barba script once!
  

*/

jQuery(document).ready(function($) {



// RUN SITE
var adminapp = (function() {
  var adminapp = {
    _setEnquireMsgs: function() {
      // Media queries breakpoints
      // MQ integers
      var screenBase = 1;
      var screenoutBase = 319;
      var screenXXS = 320;
      var screenoutXXS = 639;
      var screenXS = 640;
      var screenoutXS = 1279;
      var screenSM = 1280;
      var screenoutSM = 1439;
      var screenMD = 1440; // last scss breakpoint currently
      var screenoutMD = 2879;
      var screenLG = 2880;
      var screenoutLG = 9999; // extra large number so the last media querry doesn't fall outside any screensize as it increases from 1200

      // Define media queries using MQ variables
 
      var mQueryBase = 'screen and (min-width:' + screenBase + 'px) and (max-width:' + screenoutBase + 'px)';       // query that acts as starting point: 1 and goes upto XS: 480
      var mQueryXXS = 'screen and (min-width:' + screenXXS + 'px) and (max-width:' + screenoutXXS + 'px)';           // query that acts going into XS: 480 and goes upto SM: 768
      var mQueryXS = 'screen and (min-width:' + screenXS + 'px) and (max-width:' + screenoutXS + 'px)';           // query that acts going into XS: 480 and goes upto SM: 768
      var mQueryUptoSM = 'screen and (max-width:' + screenSM + 'px)';       //query that acts going back down into XS: - 768
      var mQuerySM = 'screen and (min-width:' + screenSM + 'px) and (max-width:' + screenoutSM + 'px)';           // query that acts going into SM: 768 and goes upto MD: 992
      var mQuerySMPLUS = 'screen and (min-width:' + screenSM + 'px)';           // query that acts going into SM: 768 and goes upto MD: 992
      var mQueryMD = 'screen and (min-width:' + screenMD + 'px) and (max-width:' + screenoutMD + 'px)';           // query that acts going into MD: 992 and goes upto LG: 1200
      var mQueryLG = 'screen and (min-width:' + screenLG + 'px)';           // query that acts going into LG: 1200
   
    //START global Variables
    
    
    // END global Variables

     // START global functions

      function detecttouch(){

        if ("ontouchstart" in window)
        {

          //console.log("user can touch");
          $("body").removeClass('is-not-touch');      
          $("body").addClass('is-touch');      
          // run("touch");
        }
        else
        {
          //console.log("user can use their mouse");
          $("body").removeClass('is-touch');      
          $("body").addClass('is-not-touch');      
         //  run("mouse");
         }// if ("ontouchstart" in window)

      }; //detect
      detecttouch(); // run functions straigh away

 
      function opacity(){

        //  $("body").addClass('pre-loaded');


          $("body").imagesLoaded(function(){ // consider a lazloadng options?
  

            console.log("Images have loaded")
                  
                 function waitloading(){

                 $("body").addClass('loaded')

                 }; //waitloading()
                 setTimeout(waitloading, 200);

           }); //imagesloaded

      }; //opacity
     
  

    function orientation(){
    
    //console.log("hell-orientation")
        var winwidth = $(window).width();
        var winheight = $(window).height();
         var isHorizontal;



        if (winwidth > winheight ) {
            /* horizontal orientation */
            $("body").addClass('horizontal');

            $("body").removeClass('vertical');
        //    var isHorizontal = true;
        } else{
              /* vertical orientation */

            $("body").removeClass('horizontal');
            $("body").addClass('vertical');
         //    var isHorizontal = false;


        }//else

    } // function orientation
    orientation();

  
   /* function recordcircle(){

    //  console.log("each recordcircle");

        $(".record-circle-container").each(function() {
     
       console.log("each recordcirlce container")

          var $thiscontainer = $(this),
              $thiscircle = $(this).find(".record-circle");
              $thiscontainer.removeClass("active","rotating","rotated");// incase its active still - seems to be some buggy behavior atm
 
           //   console.log('just remove classes');

          $thiscircle.hover(function() {
          
            if($thiscircle.hasClass("rotating")){
 
              $thiscircle.removeClass("rotating"); 
              $thiscircle.removeClass("rotate");
              $thiscontainer.removeClass("active");

            } else {

               $thiscircle.addClass("rotating");
               $thiscircle.addClass("rotate");
               $thiscontainer.addClass("active");

            } // if

          }); // hover

        }); // each $(".record-circle")

    } // function recordscircle

  */

// END global functions

// add script for reasize of 
 /*
       
    function start(){


      //console.log("function start()")
 
    //  setTimeout(typesystem, 2000);  // start type: system
       
    opacity(); // turn on visibility

    };
    setTimeout(start,0); //added a time outfunction; because of fonts need loading first?
   */                

      //
      //
      //
      // 'selector' media query

      $(function () // on document.ready()
            {

                 opacity(); // turn on visibility

                  	console.log('on document ready');
                 // 	console.log("find a selector for the block")
             		 // recordcircle();

            	// RECORD BLOCK - 

                   if ($("div[data-type='acf/inprelease']").length > 0) 
                  {
                  	console.log('[data-type="acf/inprelease]')
          
             		  recordcircle();



                 /*
                 div[data-type='acf/inprelease']
                 */

                };  

     	      	// END RECORD BLOCK - 


            	// BODY  

	               if ($('.sleave-square').length > 0) 
	              {
          				console.log("sleave-square")
           				//recordcircle()


                 /*
                 body
                 */

                };  



            	// BODY  

	               if ($('.wp-block').length > 0) 
	              {
          				console.log("wp-block")
           				//recordcircle()


                 /*
                 body
                 */

                };  

     	      	// END BODY
                      

      }); // END  Media queries function class - selectors
 
 

      //
      //
      //
      // 'screenBase' media query 1 - 319

      enquire.register(mQueryBase, function() {
      
            $(function () // on document.ready()
            {
                if ($('body').length > 0)
                {

               // console.log("base 1 - 319 ")
     
                }
            });
 
            /* body */

      });  // END screenBase

  
    // END queries

    },

    init: function() {
      this._setEnquireMsgs();
    }
  };

  return adminapp;

}());


adminapp.init(); // initial initiation

}); ///  ENDS  read.QUERY
