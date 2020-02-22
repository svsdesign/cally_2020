/*
Theme Name: theseus
Theme URI: http://theseus.agency
Description: Theseus Theme
Author: Simon van Stipriaan
Author URI: http://svs.design
 
navigation.js - handles the serving up of scripts for the entire website
*/

console.log("navigation.js")

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
      console.log("inithreadroom - shoul be once, intuyll we destroy it")

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
      

        } else {
        //console.log("#header-nav-area doesn't exist");
        }

        return;
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

           //  console.log("windowScrolltop" + windowScrolltop +"");
           //  console.log("reached" + (windowScrolltop - introheight) +"");

 

            if (reached >= 0){

            // console.log("if reached" + reached +">0");
              
                  if($('body').hasClass('main-reached')){
                 
                        if  ($('body').hasClass('nav-on')){
                          // if nav on, don't do anything
                         // console.log("nav on atm?")

                        } else{
                          unfreezeheadroom();
                          return;

                        }// nav on

                  } else {

                  // unfreeze it, but won't happen more than once

                  $('body').addClass('main-reached');
                  //console.log("should be at top of page");
                  // annoying bug in safari - so apply  10ms second time out?
                  // maybe if I tie in the opacity of the itme with the scroll function - I won't have to add timeout function?

                  setTimeout(function(){ 
                   $('body, html').scrollTop(0);// aim is to ensure its at the top again
                  }, 10);

                  return;

                  }

              } else if (reached < 0){
              // meaning we havnen't reached anything yet
              //console.log("else if " + reached +"< 0");

            // $('body').removeClass('main-reached');

             // if ($("#header-nav-area").is('.unpinned, .pinned')){ // ensure to only destroy if we have the item
              //if ($("#header-nav-area").hasClass(", pinned")){ 
               //  console.log("freeze headroom");

                  if  ($('body').hasClass('nav-on')){
                    // if nav on, don't do anything
                   // console.log("nav on atm?")

                  } else{
                     freezeheadroom();// if we destroy it; does that mean we need to re-start it
                     return;
                  }// nav on

               //}


            } //} else if (reached < 0){


        return;

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
       return;

    }// destroyheadroom()
 
  
    function freezeheadroom(){
      // to freeze
       //console.log("freezeheadroom");

      $("#header-nav-area").headroom("freeze");
       return;

    }// freezeheadroom();


 
    function unfreezeheadroom(){
      // to unfreeze
     // console.log("freezeheadroom");

      $("#header-nav-area").headroom("unfreeze");
       return;

    }// unfreezeheadroom();


   function forceheadroompin(){

     // console.log('forceheadroompin();');


       if ($("#header-nav-area").hasClass("unpinned")){
        
          $("#header-nav-area").removeClass("unpinned");
          $("#header-nav-area").addClass("pinned");

          //console.log("unpinned - now pinned");

       }
       return;

    }//forceheadroom

 function unforceheadroompin(){

      console.log('unforceheadroompin();');

       if ($("#header-nav-area").hasClass("pinned")){
        
          $("#header-nav-area").removeClass("pinned");
          $("#header-nav-area").addClass("unpinned");

          //console.log("unpinned - now pinned");

       }
       return;

    }//forceheadroom
  /* end headroom */

/* nav toggling function */

        function navtogglingfunction(){

            console.log("click");
            // what we want to do is dissacosiate the closing of the nave with the normal body sate
            // so probably have a nav on and nav off class; each hs didderent animatin
            // then our normal body no longer assiging hte "nav-off" stagte
            if ( (!$('body').not('nav-off')) || (!$('body').not('nav-on')) ) {// chekc if we have "started the nav yet; i.e assiging a nav off"
            // "start the nav toggle" - for first time
               
               // unforceheadroompin(); // ensure headroom now turned off + freeze that position
               // freezeheadroom();

                destroyheadroom();

                $('body').addClass('nav-on');
                console.log("not either");
                return;

            } else if ($('body').hasClass('nav-on')) {

                // turn nav off:
                console.log("turn nav off")
                initheadroom();


                $('body').addClass('nav-off');
                $('body').removeClass('nav-on');
                return;

            } else { // if body hasClass nav-off - + others?

                // turn nav on:
                console.log("turn nav on")
                //    unforceheadroompin(); // ensure headroom now turned off + freeze that position
                //    freezeheadroom();
                // r- initheadroom          
                      destroyheadroom();

                $('body').addClass('nav-on');
                $('body').removeClass('nav-off');

                //if click statment to add here; if they click a menu item that tkes them away from current page
              
                //nav now on, but this function will run muiltiple times: apparently; so move it out of here?

                 var $mainmenuitmes = $('li.menu-item a');

                      $mainmenuitmes.click(function(){
                          
                          console.log("$mainmenuitmes.click(function()")

                          // close nave
                          $('body').addClass('nav-off');
                          $('body').removeClass('nav-on');
                          //re init headroom

                          initheadroom()
                          return;

                       }); // click
               return;
    
         
       

            }// ifnav on
         return;

        }//navtogglingfunction()

//   END navtogglingfunction()


      // END GLOBAL FUNCTIONS


      // START Media queries based on class


            $(function () // on document.ready()
            {
                if ($('#toggle-item').length > 0) 
                {


                   if ($("#header-nav-area").length > 0) 
                   {
                              // but only do this if the nav is off 
                          // hover  triggers on + of
                          // mopusenter ontry trigglers it once
                        $('#header-nav-area').mouseenter(function(){
                             
                           //console.log("sc-player hover")
                           // ensure headroom pinned
                               if ($('body').hasClass('nav-on')){
                                // if the nav is already on, lets not change the classes further
                               } else{
                                console.log("nav not on mouseenter")
                                forceheadroompin(); // fore headroom other wise
                                return;

                                };

                              return;
                        }); // hover 

                   };// if ($("#header-nav-area").length > 0) 


                  var $this = $('#toggle-item');

                      $this.click(function(){
                            

                            
                           navtogglingfunction();
                           return;

                     }); // click
                    

                    initheadroom();// also start headroom
                    detectopofmainfixer();// run detetcing top of main fixer
                    return;
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