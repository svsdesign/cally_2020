export function domReady(fn) {
  if (document.readyState !== 'loading') {
    fn();
    return;
  }
  document.addEventListener('DOMContentLoaded', fn);
}//domReady(fn)

export function detectTouch(){
  console.log("detectTouch();")

  //https://medium.com/@david.gilbertson/the-only-way-to-detect-touch-with-javascript-7791a3346685
  // test this on IE - read the comments in the article RE issues
  //https://gist.github.com/adbario/4e33b07d618d499cd81eb691c746b47e#file-jquery-touch-detect-js
  //https://patrickhlauke.github.io/touch/tests/touch-feature-detect.html
  //https://stackoverflow.com/questions/21054126/how-to-detect-if-a-device-has-mouse-support
  //https://stackoverflow.com/questions/4817029/whats-the-best-way-to-detect-a-touch-screen-device-using-javascript
  //http://www.stucox.com/blog/you-cant-detect-a-touchscreen/

  if ("ontouchstart" in window)
  {

    // console.log("user can touch");
    $("body").removeClass('is-not-touch');      
    $("body").addClass('is-touch');      
    // run("touch");
    
     //https://stackoverflow.com/questions/23885255/how-to-remove-ignore-hover-css-style-on-touch-devices
    try { // prevent exception on browsers not supporting DOM styleSheets properly
          for (var si in document.styleSheets) {
              var styleSheet = document.styleSheets[si];
              if (!styleSheet.rules) continue;

              for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                  if (!styleSheet.rules[ri].selectorText) continue;

                  if (styleSheet.rules[ri].selectorText.match(':hover')) {
                      styleSheet.deleteRule(ri);
                  }
              }
          }
      } catch (ex) {}
  
  }
  else
  {
    //console.log("user can use their mouse");
    $("body").removeClass('is-touch');      
    $("body").addClass('is-not-touch');      
   //  run("mouse");
   }// if ("ontouchstart" in window)

};//detectTouch

//TO DO change to jquery markup?
export function SetAppHeight() {
 
  var $ = $ || jQuery;

  const initSubmenuHeight = () => {
    const doc = document.documentElement
   doc.style.setProperty('--submenu-height', `${window.innerHeight}px`)   
 }//ainitSubmenuHeight

  const initHeadroomHeight = () => {

    var headHeight = $("#header-nav-area").height();      

    const doc = document.documentElement;
   doc.style.setProperty('--headroom-height', headHeight +'px')   
 
 

  //  SetSubmenuHeight(headHeight);
 
  }//appHeigh
 



  const appHeight = () => {
     const doc = document.documentElement
    doc.style.setProperty('--site-height', `${window.innerHeight}px`)   
 
  }//appHeigh
 
  window.addEventListener('resize', appHeight)
  appHeight();
  initSubmenuHeight();
  initHeadroomHeight();

}//function SetAppHeight()

 
export function SetSubmenuHeight(headRoomStatus) {


  console.log("SetSubmenuHeight");
  console.log(" headRoomStatust" + headRoomStatus +"");

    const SubmenuHeight = () => {
      const doc = document.documentElement;
     
      if (headRoomStatus == "onPin"){
        var headHeight = $("#header-nav-area").outerHeight();       

        
        } else if (headRoomStatus == "onUnpin"){
          var headHeight = 0;      

      }
      
      // console.log("headheight" +headHeight+"");


      doc.style.setProperty('--submenu-height', `${(window.innerHeight - headHeight)}px`)   
  
    }//SubmenuHeight 
  
    const headroomHeight = () => {
      const doc = document.documentElement;
      if (headRoomStatus == "onPin"){
        var headHeight = $("#header-nav-area").outerHeight();      

        
        } else if (headRoomStatus == "onUnpin"){
        
          var headHeight = 0;      

        }
        

      doc.style.setProperty('--headroom-height', headHeight +'px')   
    }//headHeight 




  window.addEventListener('resize', SubmenuHeight);
  window.addEventListener('resize', headroomHeight);

  SubmenuHeight();
  headroomHeight();

}//function SetAppHeight()
 
export function detectAttrChange() {
console.log("detectAttrChange()");


  $(".wpuf-submit").on("remove", function () {
 
    // alert("Element was removed");

    
   
    // $(".wpuf-success").css("background","red");

     $("body").addClass('form-submitted');    
  
    
    function startScroll(){
      // $(window).scrollTop(eOffset - wHeight + eHeight); // See below for explanation

      console.log("scroll now");
    
        var wHeight = $(window).height();
        var eOffset = $('.wpuf-success').offset().top;
        var eHeight = $('.wpuf-success').height();

        $('html, body').animate({
            scrollTop: (eOffset - wHeight + eHeight)
            // scrollTop: $(".submission-form-wrap").offset().top

        }, 100);
     
       
    }; //startScroll

    setTimeout(startScroll, 500); 
    
    function removeSuccess(){

         $(".wpuf-success").css("display","none");

      }; //removeSuccess()
      setTimeout(removeSuccess, 6000);

  })


  
}//function detectAttrChange()

export function orientation(){
// review this - we might need it to esnure image orienations are correct
  var $ = $ || jQuery; // svs addition added based on Tom's fix

    console.log("hello orientation function")

  var winwidth = $(window).width(); // should be inner weidth
  var winheight = $(window).height(); // inner height
  var isHorizontal;

  if (winwidth > winheight ) {
    /* horizontal orientation */
    $("body").addClass('horizontal');
    $("body").removeClass('vertical');

   } else{
    /* vertical orientation */
    $("body").removeClass('horizontal');
    $("body").addClass('vertical');

  }//else

} // function orientation

export function opacity(){
    

    console.log("opacity() function")

    var $ = $ || jQuery; // svs addition added based on Tom's fix

  //  $("body").imagesLoaded(function(){ // consider a lazloadng options?
  console.log("removed imagesloaded")

      // console.log("Images have loaded in opacity() in helpers.js")
        
        function waitloading(){

        // $("body").addClass('loaded'); was this- bbut change to:
        //reivew as it might cause issues
        $("body").addClass('images-loaded');  

        if ($("body").hasClass("page-template-page-grid")){
          // as it takes ages to load; loader shown
          // this hides it after load
          console.log("grid loader removing")
          $("body").addClass('page-content-loaded');             
        }

        }; //waitloading()
        setTimeout(waitloading, 200);

    // }); //imagesloaded

};//opacity

export function imageopacity(){
    console.log("images loaded applied here")
      var $ = $ || jQuery; // svs addition added based on Tom's

      var $thisimageblock = $("body").find("img.apply-image-load");  // just target img?
   
      $thisimageblock.each(function() {  
  
        console.log("each image? block");
        
          var $thisimage = $(this);
  
              $thisimage.imagesLoaded( {
                // options...
                },
                function() {
                  
               console.log("images have loaded");
                  var oldSrc = $thisimage.attr('src'),
                      newSrc = $thisimage.attr('data-src');
                    $thisimage.attr('src', newSrc);
                    $thisimage.addClass("loaded"); // possibly not need
  
                }
  
              ); // 
  
        });//  $thisimageblock.each(function()
  
};//function imageopacity()

export function devGrid(){

// console.log("dev grid");

  if ($('.dev-grid').length > 0) 
  {
      
    var introHeight = $('#intro-area').height(),
        documentGridHeight = $('#main.wrapper').height(),
        $baselines = $(".dev-base-lines");
        pxlineheight = '10',//px
        vwlineheight = '1vw',//vw
        baselinecount =  documentGridHeight / pxlineheight;
        $baselines.css("height",documentGridHeight);// set height of the baseline area as documentGridHeight

        $('.dev-base-lines .base-line').remove(); // remove existing item(s);

  /* temp removed
        for (var i=0; i<baselinecount; i++){
            $('.dev-base-lines').append('<div class="base-line"></div>');
        };
  */     

      $('.dev-grid-toggle').click(function(){
      //console.log("click") ;       
        if ($('body').hasClass('dev-grid-on')) {
          // turn grid off:

          $('body').removeClass('dev-grid-on');

        } else {
          // turn grid on:
          $('body').addClass('dev-grid-on');

        }// if grid on

      }); // click

    /*
  .dev-grid
  */
  }

/* delet this I  reckon - or maybe integrate teh resize to make things upate accordingly */
/*
  var $toggle = $(".dev-toggle"), 
  $classtarget = $('body'); 

  $toggle.click(function(){
                              
      if ($classtarget.hasClass('dev-on')){
          
        $classtarget.removeClass('dev-on');

      } else{

        $classtarget.addClass('dev-on');

      }; // if $('body').hasClass('dev-on')


  }); // click      


  var rtimedev;
  var timeoutdev = false;
  var deltadev = 200;
  $(window).resize(function() {
      rtimedev = new Date();
      if (timeoutdev === false) {
          timeoutdev = true;
          setTimeout(resizeenddev, deltadev);
      }
  });

  function resizeenddev() {
    
      if (new Date() - rtimedev < deltadev) {
          setTimeout(resizeenddev, deltadev);
      } else {
          timeoutdev = false;
        var windowheight = $(window).height();
         //console.log("this working dev?")
          orientation(); //vertical or horizontal

      }   //else    

   };//resizeend fucntion
*/

}//export function devgrid()

export function previewSite(){

  // preview site - if cookies diables or not on
    // console.log("previewsite function");

      $("body").attrchange({
        trackValues: true, // set to true so that the event object is updated with old & new values
        callback: function(evnt) {
            if(evnt.attributeName == "class") { // which attribute you want to watch for changes
                
                    var $nobutton = $("#cn-refuse-cookie"),
                        $yesbutton = $("#cn-accept-cookie"),
                        $dotbutton = $(".cn-revoke-cookie")


                  if ($('body').hasClass('cookies-accepted')){
                     

                        $nobutton.hover(function(){ // was #cn-accept-cookie /#cookie-notice

                            $("body").addClass("preview-site g-scale");  //Add the active class to the area is hovered
                        }, function () {

                            $("body").removeClass("preview-site g-scale");
                        });
                      
                       $yesbutton.hover(function(){

                         //   console.log("has class cookies-accepted ")
                            $("body").addClass("preview-site");  //Add the active class to the area is hovered
                        }, function () {

                            $("body").removeClass("preview-site");
                        });

                  } else if ($('body').hasClass('cookies-refused')){

                        $nobutton.hover(function(){

                            $("body").addClass("preview-site g-scale");  //Add the active class to the area is hovered
                        }, function () {

                            $("body").removeClass("preview-site g-scale");
                        });

                        $yesbutton.hover(function(){ 
                          //  console.log("has class cookies-refused ")
                            $("body").addClass("preview-site");  //Add the active class to the area is hovered
                        }, function () {

                            $("body").removeClass("preview-site");
                        });

                        // preview on the dot:

                       $dotbutton.hover(function(){ 

                            $("body").addClass("preview-site");  //Add the active class to the area is hovered
                        }, function () {

                            $("body").removeClass("preview-site");
                        });

                  } else if ($('body').hasClass('cookies-not-set')){
          
                     
                       $yesbutton.hover(function(){ // was #cn-accept-cookie /#cookie-notice

                            $("body").addClass("preview-site");  //Add the active class to the area is hovered
                        }, function () {

                            $("body").removeClass("preview-site");
                        });

                        $nobutton.hover(function(){ // was #cn-accept-cookie /#cookie-notice

                          $("body").addClass("preview-site g-scale");  //Add the active class to the area is hovered
                      }, function () {

                          $("body").removeClass("preview-site g-scale");
                      });


                  }

              }//== "class"

          }

        });
        
}//previewSite();

export function menuPositioner(){
 console.log("menupositioner");

var $body = $('body'),
    $positioner = $("#positioner"),
    $menu = $("#menu-header-navigation"),
    $menuitems = $menu.children(),
    numberofmenuitems = $menuitems.length,
    $activemenuitem = $menu.children().filter(".current-menu-item"),
    positionerwidth = (100/numberofmenuitems);
    
    $menuitems.each(function() {
      var number = $(this).index() +1;
    // $(this).prepend("<span>" +  + "</span>");
      $(this).attr( "menu-number", number);

    });

    if ($body.hasClass('home')){

      console.log("is body");

      activemenuitemnumber = $activemenuitem.attr( "menu-number");
      applymarginleft = ((activemenuitemnumber * positionerwidth) - positionerwidth)+"%";
  
      //console.log("activemenuitemnumber" +activemenuitemnumber+"");
      $positioner.css("width",positionerwidth+"%");
      $positioner.css("margin-left", applymarginleft+"%");
      $positioner.animate({
          marginLeft: applymarginleft
      }, 500);

    } else if (($body.hasClass('parent-pageid-101')) || ($body.hasClass('parent-pageid-104'))){

      console.log("is parent of about");
    var $activemenuitem = $menu.children().filter(".about-link"),
    
    
      activemenuitemnumber = $activemenuitem.attr( "menu-number");
      applymarginleft = ((activemenuitemnumber * positionerwidth) - positionerwidth)+"%";
  
      //console.log("activemenuitemnumber" +activemenuitemnumber+"");
      $positioner.css("width",positionerwidth+"%");
      $positioner.css("margin-left", applymarginleft+"%");
      $positioner.animate({
          marginLeft: applymarginleft
      }, 500);

 
  
    } else if ($body.hasClass('single-news')){

      console.log("is single news - apply active to the parent");
    var $activemenuitem = $menu.children().filter(".news-link"),
    
    
      activemenuitemnumber = $activemenuitem.attr( "menu-number");
      applymarginleft = ((activemenuitemnumber * positionerwidth) - positionerwidth)+"%";
  
      //console.log("activemenuitemnumber" +activemenuitemnumber+"");
      $positioner.css("width",positionerwidth+"%");
      $positioner.css("margin-left", applymarginleft+"%");
      $positioner.animate({
          marginLeft: applymarginleft
      }, 500);

    } else {

    // default rules:

      activemenuitemnumber = $activemenuitem.attr( "menu-number");
      applymarginleft = ((activemenuitemnumber * positionerwidth) - positionerwidth)+"%";
  
      //console.log("activemenuitemnumber" +activemenuitemnumber+"");
      $positioner.css("width",positionerwidth+"%");
      $positioner.css("margin-left", applymarginleft+"%");
      $positioner.animate({
          marginLeft: applymarginleft
      }, 500);
      
    }// if class

 

}//menupositioner()

export function menuClasses(data, target) {

  $('.menu-item.' + target).each(function () {
    $(this).removeClass(target);
  });

  $(`.menu-item > a[href$="${ data.next.url.path }"]`).closest('.menu-item').each(function () {
    $(this).addClass(target);
  });

} //menuClasses(target)

export function contentHeight() {

  var  
  $maincontent = $("#main"),
  $containercontent = $(".grid-container.main"),
  $footercontent = $("#footer-nav-area");
  $containercontent.css("min-height","initial");// this to reset previous value

  var
  maincontentheight = $maincontent.height(),
  containercontentheight = $containercontent.height(),
  footercontentheight = $footercontent.outerHeight(),
  viewportheight = $(window).height(),
  minimumcontainerheight = (maincontentheight - footercontentheight);  
  $containercontent.css("min-height", minimumcontainerheight );

}//contentheight();

 /* blocks moved

 export function images($block){
  // console.log("images loaded applied here")
  
   var $thisimageblock = $block.find("img");  // just target img?

   $thisimageblock.each(function() {  

      // console.log("each image?);
      
       var $thisimage = $(this);

            $thisimage.imagesLoaded( {
             // options...
             },
             function() {
              // console.log("images have loaded");
               var oldSrc = $thisimage.attr('src'),
                   newSrc = $thisimage.attr('data-src');
                  $thisimage.attr('src', newSrc);
                  $thisimage.addClass("loaded"); // possibly not need

             }

           ); // 

     });//  $thisimageblock.each(function()

 };//function images($block)


export function slideshow($block){ // review this function; do I need it?

  
  //$.getScript( ""+themeurl+'/assets/js/site.js', function( data, textStatus, jqxhr ) {
   $.getScript( "https://npmcdn.com/flickity@2/dist/flickity.pkgd.js", function( data, textStatus, jqxhr ) {

  //console.log(" hello function slideshow($block)")
var $thisgallery = $block.find(".slideshow-carousel");  

     $thisgallery.flickity({
          imagesLoaded: true, 
          setGallerySize: false, //if you prefer to size the carousel with CSS, rather than using the size of cells.
     // default cellAlign: 'center'
          percentPosition: false, 
          freeScroll: false, 
          wrapAround: true, 
          arrowShape: { 
              x0: 20,
              x1: 50, y1: 50,
              x2: 60, y2: 50,
              x3: 30
            }
         // arrowShape: '82.9312793 24.4501626 86.9653917 27.5504528 49.7576146 75.9653917 12.5498374 27.5504528 16.5839498 24.4501626 49.7576146 67.615895',

       });

    });//get flickity pkg script

}; // function gallery($block)

export function map($block){ // review this function; do I need it?

  //console.log("function map($block) - ONE")

        if ($('#g-map').length > 0){ //if element exists / map turned on
        // console.log("#g-map.length > 0")

            //var gMapsLoaded = false; // maybe I need to put this variable else where?
            var index=0;

            window.gMapsCallback = function(){
                gMapsLoaded = true;
                $(window).trigger('gMapsLoaded');
            }

            window.loadGoogleMaps = function(){
             
              //console.log("gMapsLoaded =" + gMapsLoaded + "");
               
                //I think this is the one I need to load - so find the other one & delete it
                if(gMapsLoaded) return window.gMapsCallback();
                var script_tag = document.createElement('script');
                script_tag.setAttribute("type","text/javascript");
                script_tag.setAttribute("src","https://maps.googleapis.com/maps/api/js?key=AIzaSyBUXYryE2krCQ7nIvVcXcFzWEPY0cEcXbE&callback=gMapsCallback");
                (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
             
            }

            function initialize(){

                var mapOptions = {
                    center: {lat: 51.5198038, lng: -0.1228228999999601},
                      zoom: 15,
                      panControl: false,
                      zoomControl: false,
                      draggable: true,
                      scrollwheel: false,
                      mapTypeControl: false,
                      scaleControl: false,
                      streetViewControl: false,
                      overviewMapControl: true,
                      styles: [{ "stylers": [
                               { "saturation": "-90" }
                        ] } ],
                }
 
             

                map = new google.maps.Map(document.getElementById('g-map'),mapOptions);
        // var image = ""+themeurl+'/assets/svg/t_logo_svg.svg?i='+(index++);
                var image = ""+themeurl+'/assets/svg/map_marker_svg_40px.svg?i='+(index++);
                var imageMarker = new google.maps.Marker({
                position: {lat: 51.5198038, lng: -0.1228228999999601},
                map: map,
                optimized:false,
                icon: image
              });
            }

            $(window).bind('gMapsLoaded', initialize);
            window.loadGoogleMaps();

        } // if #g-map

} // function gallery($block)
*/
// end map funtion

export function clickcookierevoke() {
  // trigger a click on the default revoke button
  $('a.th-cookie-revoke').click(function() {
    $('.cn-revoke-cookie')[0].click(); // this does
    });

}//clickcookierevoke

export function topAnimation(){
  // console.log("function topAnimation()");


  setTimeout(function(){ 
    // console.log("hello");

    // console.log("setTimeout(function()");

      $('body').removeClass('animation-fix'); //ensure people can now scroll

      if ($('body').data('move-to')) { // if we have to scroll to a certain position

            var addattr = $('body').data('move-to');

            $('html, body').animate(
                { scrollTop: $("#"+addattr+"").offset().top + 1 },
                 600, function() {
                  
                  // Animation complete.
               
                                var $thisitem = $(window);
                    
                      $thisitem.on('scroll.startitem', function() { // bind event handler
                        var windowPos = $(this).scrollTop(),
                            mainScroll = $('#main').offset().top, 
                            scrollHeight = windowPos - mainScroll;
                
                        if ( scrollHeight >= 0 ) {
                
                          $('body').addClass('keep-intro show-nav-logo'); 
                          $thisitem.off('scroll.startitem');
                
                      }//if ( scrollHeight >= 0 )    
                    
                    });

                  $('body').removeAttr('data-move-to'); // remove attribute

            }); // animate
        
      } else{

        // console.log("about to animate?")

        $('html, body').animate(
            { scrollTop: $("#main").offset().top + 0 },
             600, function() {
              
              // Animation complete.
              var $thisitem = $(window);
       
              $thisitem.on('scroll.startitem', function() { // bind event handler
                var windowPos = $(this).scrollTop(),
                   mainScroll = $('#main').offset().top, 
                   scrollHeight = windowPos - mainScroll;
       
                if ( scrollHeight >= 0 ) {
       
                  $('body').addClass('keep-intro show-nav-logo'); 
                  $thisitem.off('scroll.startitem');
       
                }//if ( scrollHeight >= 0 )    
           
              });

          }); // animate

      } // if has move to data

  }, 200);

};// topanimation()

export function fade() {
  // console.log("function fade()");

  var animation_height = $(window).innerHeight() * 0.25; // was 0.25
  var ratio = Math.round( (1 / animation_height) * 10000 ) / 10000; //ratio

     $('.th-block').each(function() { // might need to review this

          var objectTop = $(this).offset().top;
          var windowBottom = $(window).scrollTop() + ($(window).innerHeight() *0.8);
          
          if ( objectTop < windowBottom ) {

              if ( objectTop < windowBottom - animation_height ) {
                 // $(this).html( 'fully visible' );

                  $(this).css( {
                      transition: 'opacity 0.1s linear',
                      opacity: 1
                  } );
                 // console.log("hello fade into 1");

              } else {
              //    $(this).html( 'fading in/out' );
                  $(this).css( {
                      transition: 'opacity 0.25s linear',
                      opacity: (windowBottom - objectTop) * ratio
                  } );
              }

          } else {
                // console.log("else so not fading into 1");

             // $(this).html( 'not visible' );
              $(this).css( 'opacity', 0.1 );
          }

      });//  $('.th-block').each(function()


      if($(window).scrollTop() + $(window).height() == $(document).height()) {
        // if at the bottom of th page: ensure everything visbile
        //console.log("bottom of page")
        $('.th-block').css( {
            transition: 'opacity 0.1s linear',
            opacity: 1
        } );

      }//

} // function fade()

export function destroyheadroom(){
  // to destroy
 // console.log("destroyheadroom")

  $("#header-nav-area").headroom("destroy");
   return;

}// destroyheadroom()

export function freezeheadroom(){
  // to freeze
   //console.log("freezeheadroom");

  $("#header-nav-area").headroom("freeze");
   return;

}// freezeheadroom();

export function unfreezeheadroom(){
  // to unfreeze
 // console.log("freezeheadroom");

  $("#header-nav-area").headroom("unfreeze");
   return;

}// unfreezeheadroom();

export function forceheadroompin(){

 // console.log('forceheadroompin();');


   if ($("#header-nav-area").hasClass("unpinned")){
    
      $("#header-nav-area").removeClass("unpinned");
      $("#header-nav-area").addClass("pinned");

      //console.log("unpinned - now pinned");

   }
   return;

}//forceheadroom

export function unforceheadroompin(){

  // console.log('unforceheadroompin();');

   if ($("#header-nav-area").hasClass("pinned")){
    
      $("#header-nav-area").removeClass("pinned");
      $("#header-nav-area").addClass("unpinned");

      //console.log("unpinned - now pinned");

   }
   return;

}//forceheadroom

export function removeCommentBubble(){
  // console.log(" function removeCommentBubble()")

  if ($('#wpd-bubble-wrapper').length){
  // console.log("#wpd-bubble-wrapper exists")
  $('#wpd-bubble-wrapper').remove();// remove it
  } //if($('#wpd-bubble-wrapper').length)

};//removeCommentBubble()
   
export function hoverDiv($thisitem) {

//  console.log("hoverDiv($thisitem)");
     $thisitem = $thisitem;

     var hoverloop;// declare
 /* to do

 still issue with scrip running to many times

 */


    var checkhoverDiv = function ($thisitem) {

      // console.log("initial chekchover div hover div");

      var hovermouseX = ($thisitem.width() / 2), //was 0,
          hovermouseY = ($thisitem.height() / 2), //was 0,
          hoverlimitX = $thisitem.width(), // was 9999,
          hoverlimitY = $thisitem.height(); // was 9999;

          $thisitem.on({
            mousemove: function (e) {
              var hoveroffset = $thisitem.offset();
              hovermouseX = Math.min(e.pageX - hoveroffset.left, hoverlimitX);
              hovermouseY = Math.min(e.pageY - hoveroffset.top, hoverlimitY);
              if (hovermouseX < 0) hovermouseX = 0;
              if (hovermouseY < 0) hovermouseY = 0;

              // console.log("hoverDiv($thisitem)");

            }
          });

          // cache the selector
        var hoverfollower = $thisitem.find('.inner-follow'),
            hoverxp = 0,
            hoveryp = 0;

 
          hoverloop = setInterval(function () {
            // change 12 to alter damping higher is slower
            hoverxp += (hovermouseX - hoverxp) / 1;//was 12
            hoveryp += (hovermouseY - hoveryp) / 1;//was 12
            hoverfollower.css({
              left: hoverxp,
              top: hoveryp
            });
            // console.log("interval in inital")

          }, 100); // was 10
   
    };// checkhoverDiv($thisitem)

    window.addEventListener('resize', function () {


      if ($('body').hasClass('dev-layout-grid-on')){
        console.log("resizing for hover div - but grid now active");

        return;

      } else{
        console.log("resizing for hover div");

        $thisitem = $('.dev-layout-grid-toggle'); //overrid the current var?
      
        checkhoverDiv = null; // should kills previous functions
        // hoverloop = null;
        clearInterval(hoverloop);

        // redeclare the function, using same var name

        var checkhoverDiv = function ($thisitem) {
          console.log("check hover div after resize");

        var hovermouseX = ($thisitem.width() / 2), //was 0,
          hovermouseY = ($thisitem.height() / 2), //was 0,
          hoverlimitX = $thisitem.width(), // was 9999,
          hoverlimitY = $thisitem.height(); // was 9999;

          $thisitem.on({
            mousemove: function (e) {
              var hoveroffset = $thisitem.offset();
              hovermouseX = Math.min(e.pageX - hoveroffset.left, hoverlimitX);
              hovermouseY = Math.min(e.pageY - hoveroffset.top, hoverlimitY);
              if (hovermouseX < 0) hovermouseX = 0;
              if (hovermouseY < 0) hovermouseY = 0;

              // console.log("hoverDiv($thisitem)");

            }
        });

        // cache the selector
        var hoverfollower = $thisitem.find('.inner-follow'),
          hoverxp = 0,
          hoveryp = 0;

          hoverloop = setInterval(function () {
          // change 12 to alter damping higher is slower
          hoverxp += (hovermouseX - hoverxp) / 1;//was 12
          hoveryp += (hovermouseY - hoveryp) / 1;//was 12
          hoverfollower.css({
            left: hoverxp,
            top: hoveryp
          });
          console.log("interval in resize")
         }, 100); // was 10



        };// checkhoverDiv($thisitem)

        checkhoverDiv($thisitem);// trigger

      }

    });


    $(".dev-layout-grid-toggle").click(function () {
      //clear loop as soon as user starts the grid
      clearInterval(hoverloop);
    });

  checkhoverDiv($thisitem);// initial




} //function hoverDiv($thisitem)




export function succesScroll(){

 
// nod sure need this funcntion

// once clicked evennt listen for this div

if ($(".wpuf-success").length) {

console.log("succes avaijlabve");
}




} //function succesScroll
