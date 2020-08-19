import {
  domReady,
  menupositioner,
  destroyheadroom,
  freezeheadroom,
  unfreezeheadroom,
  forceheadroompin,
  unforceheadroompin
 } from '../../utilities/helpers';

 export default function init() {


   
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

 


  if ($('#toggle-item').length > 0) 
  {

    console.log("if #toggle-item")

      if ($("#header-nav-area").length > 0) 
      {
                // but only do this if the nav is off 
            // hover  triggers on + of
            // mopusenter ontry trigglers it once
          $('#header-nav-area').mouseenter(function(){
                
          console.log("#header-nav-area hover")
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

  } //#toggle-item




} //export default function init()
