/*
Theme Name: theseus
Theme URI: http://theseus.agency
Description: Theseus Theme
Author: Simon van Stipriaan
Author URI: http://svs.design
 
navigation.js - handles the serving up of scripts for the entire website
*/



jQuery(document).ready(function($) {

var navapp = (function() {
  var navapp = {
    _setEnquireMsgs: function() {
      // Media queries breakpoints
      // MQ integers
      var screenBase = 1;
      var screenoutBase = 319;
      var screenXXS = 320;
      var screenoutXXS = 599;
      var screenXS = 600;
      var screenoutXS = 767;
      var screenSM = 768;
      var screenoutSM = 991;
      var screenMD = 992;
      var screenoutMD = 1199;
      var screenLG = 1200;
      var screenoutLG = 9999; // extra large number so the last media querry doesn't fall outside any screensize as it increases from 1200

      // Define media queries using MQ variables
      var mQueryBase = 'screen and (min-width:' + screenBase + 'px) and (max-width:' + screenoutBase + 'px)',
          mQueryUptoSM = 'screen and (min-width:' + screenBase + 'px) and (max-width:' + screenoutXS + 'px)',
          mQuerySM = 'screen and (min-width:' + screenSM + 'px) and (max-width:' + screenoutSM + 'px)',
          mQuerySMPLUS = 'screen and (min-width:' + screenSM + 'px)';



    // START GLOBAL FUNCTIONS
     
    /* headroom */

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
                  "unpinned": "unpinned",
                  "frozen": "frozen",

                }

            });

            $('#header-nav-area').hover(function(){
                 
               //console.log("sc-player hover")
               // ensure headroom pinned
                forceheadroompin();

            }); // hover 


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



    function detectopofmainfixer(){
      console.log("detectopofmainfixer()");

        /*
        $(window).on('scroll', function() {
            var pos = $('#main.main-fixer').scrollTop();
            if (pos == 0) {
                console.log('top of the div?');

            }
        });
        */  





$(window).scroll(function() {

    var 
      //mainoffset = $('#main').offset().top,
      //  mainHeight = $('#main').outerHeight(),
      //  windowHeight = $(window).height(),
        windowScrolltop = $(this).scrollTop();

        $intro = $('#intro-area'),
        introheight = $intro.height(),
        reached = windowScrolltop - introheight;
        //  console.log((mainoffset-windowHeight) , windowScrolltop);
        // console.log("this?" + (mainoffset-windowHeight) , windowScrolltop +"");

//        console.log("windowScrolltop" + windowScrolltop +"");
 //       console.log("reached" + (windowScrolltop - introheight) +"");


    if (reached > 0){

    // console.log("if reached" + reached +"");
    

     $('body').addClass('main-reached');

     // if ($("#header-nav-area").not('.unpinned, .pinned')){ // meaning headroom no longer eixist?
      unfreezeheadroom();
      //}

    } else if(reached == 0){
      
      $('body').addClass('main-reached');
   // we want to force the pin, but only once, when we hit 0?
     //  console.log("reeach + forcing headpin" + reached +"");
 
      forceheadroompin();// don't run continuasly - only when we're at zero

  

    } else {

     // console.log("not reached" + reached +"");

       $('body').removeClass('main-reached');

     // if ($("#header-nav-area").is('.unpinned, .pinned')){ // ensure to only destroy if we have the item
      //if ($("#header-nav-area").hasClass(", pinned")){ 
       //  console.log("freeze headroom");
         freezeheadroom();// if we destroy it; does that mean we need to re-start it
       //}


    }
    // $('#main').fadeIn(3500);



});

// the problem is that the when we are at the top = 0 so I need to add / rmnove the height of the intro area

/*
 $(window).on('scroll', function () {
    var $main = $('#main'),
        $intro = $('#intro-area'),
        introheight = $intro.height(),
    // i need to add the introarea height in as well
  //  var scrollTop = $(this).scrollTop();
    
       scrollTop = $main.scrollTop();


    if (scrollTop === 0) {
      //$('#main');
      console.log("scrollTop === 0" + scrollTop +"");
    $('body').addClass('main-reached');

    } else {
      console.log("else" + scrollTop +"");
         $('body').removeClass('main-reached');

    }
 });
*/
        /*$(window).bind('scroll', function() {
            if($(window).scrollTop() >= $('#main').offset().top + $('#main').outerHeight() - window.innerHeight) {
                console.log('bottom of intro area reached');
            } else{
                console.log('bottom of intro area not reached');


            }

        });
*/
/*

        $(window).on('scroll', function() {

      console.log("scroll");

          var scrollTop = $('#main.main-fixer').scrollTop();

                              console.log("scrollTop" +scrollTop+"")

          if (scrollTop + $('#main.main-fixer').innerHeight() >= this.scrollHeight) {
            //$('#message').text('end reached');
          //$("body").addClass('main-reached');
                    console.log("if what")

          } else if (scrollTop <= 0) {
           // $('#message').text('Top reached');
             $("body").addClass('main-reached')

          } else {
            console.log("else - so remove main")
                      $("body").removeClass('main-reached')

           // $('#message').text(''); // else needed?
          }
        });

*/

     }//function detectopofmainfixer

    function destroyheadroom(){
      // to destroy
     // console.log("destroyheadroom")

      $("#header-nav-area").headroom("destroy");

    }// destroyheadroom()
 
  
    function freezeheadroom(){
      // to freeze
      //console.log("freezeheadroom")

      $("#header-nav-area").headroom("freeze");

    }// freezeheadroom();


 
    function unfreezeheadroom(){
      // to unfreeze
     // console.log("freezeheadroom");

      $("#header-nav-area").headroom("unfreeze");

    }// unfreezeheadroom();


   function forceheadroompin(){

       if ($("#header-nav-area").hasClass("unpinned")){
        
          $("#header-nav-area").removeClass("unpinned");
          $("#header-nav-area").addClass("pinned");

          //console.log("unpinned - now pinned");

       }

    }//forceheadroom


  /* end headroom */

      // END GLOBAL FUNCTIONS


      // START Media queries based on class


            $(function () // on document.ready()
            {
                if ($('#toggle-item').length > 0) 
                {

                  var $this = $('#toggle-item');

                      $this.click(function(){

                         if ($('body').hasClass('nav-on')) {
                          // turn nav off:

                          $('body').removeClass('nav-on');

                        } else {
                          // turn nav on:
                          $('body').addClass('nav-on');

                        }// ifnav on

                     }); // click
                    

                    initheadroom();// also start headroom
                    detectopofmainfixer();// run detetcing top of main fixer
                /*
                #toggle-itme
                */

                }
            });


          

            $(function () // on document.ready()
            {
               // if ($('body.home').length > 0) 
               if ($('body.home').length > 0) 

               {


                    var rtime;
                    var timeout = false;
                    var delta = 200;
                    $(window).resize(function() {
                        rtime = new Date();
                        if (timeout === false) {
                            timeout = true;
                            setTimeout(resizeend, delta);
                        }
                    });


                    function resizeend() {
                      
                        if (new Date() - rtime < delta) {
                            setTimeout(resizeend, delta);
                        } else {

                        timeout = false;
                        //console.log("hello resize");
                        // add function
                        //index_nav_sections(); // re-adjust nav marker positions
                        


                        } //else 

                     };//resizeend fucntion

                


                /*
                .home
                */

                }
            });



     

  

      // END  Media queries based on class
 

      //
      //
      //
      // 'screenBase' media query


      enquire.register(mQueryBase, function() {
      // console.log('media query xs matched: viewport width ' + screenBase);
      // console.log('query that acts as starting point: + 1 and goes upto 480');
      //
      //
      //
 
          /*  RUN JS IF IS HOME   -  + 1 and goes upto 480 */
   

            $(function () // on document.ready()
            {
                if ($('body.home').length > 0)
                {

  



        /*
        body.home
        */

                }
            });

        /*  END OF:  RUN JS IF IS HOME  */
     



 
      });  // END screenBase query that acts as starting point: + 1 and goes upto 480


       



    
      //
      //
      //
      // screenXS media query - query that acts going into XS: 480 and goes upto SM: 768
     
      
      enquire.register(mQueryUptoSM, function() {
          //    console.log('query that acts as upto 768');


      //
      //
      //


 

            /*  RUN JS IF IS _body  -  goes upto SM: 768 */
   

             $(function () // on document.ready()
            {
                if ($('_body').length > 0) 
                {
                

                }
            });

            /*  END RUN JS IF IS _body  -  goes upto SM: 768 */


      });  // END query that acts going into upto SM: 768 


      //
      //
      //
      // screenSMPLUS media query - 768 +
     
      
        enquire.register(mQuerySMPLUS, function() {
      //     console.log('query that acts as - SM: 768  +');
      

      //
      //
      //

 

 

             /*  RUN JS IF IS _body  -  query that acts going into SM: 768 + */
   

             $(function () // on document.ready()
            {
                if ($('_body').length > 0) 
                {
          
 
      

                }
            });
             
            /*  END RUN JS IF IS _body  -  query that acts going into SM: 768 + */


    


      }); // END   query that acts going into SM: 768 +

      //
      //
      //
      // screenUptoSMPLUS media query  
      //
      //
      //


//// END specific media queries >> 



    },

    init: function() {
      this._setEnquireMsgs();
    }
  };

  return navapp;

}());


navapp.init();

}); ///  ENDS  read.QUERY