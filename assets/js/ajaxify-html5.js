// Ajaxify
// v1.0.1 - 30 September, 2012
// https://github.com/browserstate/ajaxify

/* nav toggling function */
// this exist twice :( - once in the navigation js file and once in here; really not ideal?
  /* -- dlete this function!!!
        function navtogglingfunction(){

            console.log("click");
            // what we want to do is dissacosiate the closing of the nave with the normal body sate
            // so probably have a nav on and nav off class; each hs didderent animatin
            // then our normal body no longer assiging hte "nav-off" stagte
            if ( (!$('body').not('nav-off')) || (!$('body').not('nav-on')) ) {// chekc if we have "started the nav yet; i.e assiging a nav off"
            // "start the nav toggle"
            unforceheadroompin(); // ensure headroom now turned off + freeze that position
            freezeheadroom();

            $('body').addClass('nav-on');
            console.log("not either")
            } else if ($('body').hasClass('nav-on')) {
            // turn nav off:
            console.log("turn nav off")
            unfreezeheadroom(); // enure to unfreeze headroom

            $('body').addClass('nav-off');
            $('body').removeClass('nav-on');

            } else { // chkeck 
            // turn nav on:
            console.log("turn nav on")
            unforceheadroompin(); // ensure headroom now turned off + freeze that position
            freezeheadroom();
            $('body').addClass('nav-on');
            $('body').removeClass('nav-off');

            }// ifnav on

        }//navtogglingfunction()

//   END navtogglingfunction()
*/


(function(window,undefined){
  
  // Prepare our Variables
  var
    History = window.History,
    $ = window.jQuery,
    document = window.document;

  // Check to see if History.js is enabled for our Browser
  if ( !History.enabled ) {
    return false;
  }

  // Wait for Document
  $(function(){
    // Prepare Variables
    var
      /* Application Specific Variables */
      contentSelector = '#main.main-fixer';///'#site-wrap', /// this was #site-wrap; which is wrong?!
      $content = $(contentSelector).filter(':first'),
      contentNode = $content.get(0),
  //    $menu = $('.nav-menu,#site-navigation,#menu-menu-1,#menu,#nav,nav:first,.nav:first').filter(':first'),
      $menu = $('#menu-header-navigation, #menu-footer-navigation');//.filter(':first'), //removed filster first; becuase we're g
      // issues here:
      // onngly use one class per "activeClass"

      activeClass ='current_page_item', //current_page_item
      activeMenuClass ='current-menu-item', //current_page_item

      //  activeClass ='active, selected, current, youarehere',
      activeSelector = '.current_page_item',
      activeMenuSelector = '.current-menu-item',

       // Other wise create more variables etc if I need to have classes for current page, current menu item etc.
      //current-menu-item, current_page_item

      // activeSelector = '.current-menu-item, .current-page-item, .active, .selected, .current, .youarehere',
      introanimationdone = false, // check against this - to determine if we need to add that class again

      menuChildrenSelector = '> li, > ul > li',
      completedEventName = 'statechangecomplete',
      /* Application Generic Variables */
      $window = $(window),
      $body = $(document.body),
      rootUrl = History.getRootUrl(),
      scrollOptions = {
        duration: 800,
        easing:'swing'
      };

      console.log("rootUrl" + rootUrl +"");// but  Locally this is http://localhost:8888 & not http://localhost:8888/theseus-wp-2/ 
    
    // Ensure Content
    if ( $content.length === 0 ) {
      $content = $body;
    }
    
    // Internal Helper
    $.expr[':'].internal = function(obj, index, meta, stack){
      // Prepare
      var
        $this = $(obj),
        url = $this.attr('href')||'',
        isInternalLink;
      
      // Check link
      isInternalLink = url.substring(0,rootUrl.length) === rootUrl || url.indexOf(':') === -1;
      //maybe I should check if link is actually "home" - this probaly why retruning 4?


      // Ignore or Keep
      return isInternalLink;
    };
    
    // HTML Helper
    var documentHtml = function(html){
      // Prepare
      var result = String(html)
        .replace(/<\!DOCTYPE[^>]*>/i, '')
        .replace(/<(html|head|body|title|meta|script)([\s\>])/gi,'<div class="document-$1"$2')
        .replace(/<\/(html|head|body|title|meta|script)\>/gi,'</div>')
      ;
      
      // Return
      return $.trim(result);
    };
    

//https://github.com/metafizzy/isotope/issues/594


    // Ajaxify Helper
    $.fn.ajaxify = function(){
      // Prepare
      var $this = $(this);
      var n = 0;

              // Ajaxify
    //  $this.find('a:internal:not(.no-ajaxy,[href^="#"],[href*="wp-login"],[href*="wp-admin"])').click(function(event){
      $this.find('a:internal:not(.no-ajaxy)').click(function(event){

        // Prepare
        var
          $this = $(this),
          $main = $('#site-wrap'), // content selector

          url = $this.attr('href'),
          title = $this.attr('title')||null,
          hashPos = url.indexOf('#'), hash;
  

          // basically if I click on a link in the menu, I want to close the menu,
          // so a

 

        // Continue as normal for cmd clicks etc
        if ( event.which == 2 || event.metaKey ) { return true; }
        
          //edit to ensure we can still use /#  - https://github.com/browserstate/history.js/issues/57

        if (hashPos > -1) {
          //console.log("hash click maybe?")

               // I've remoed this becuase its destroying my existing animation - look at add a class instead from other pages and assign #position accordingly?
               //     hash = url.substr(hashPos);
                //    url = url.substring(0, hashPos);
                // end remove

           };
           

        // Ajaxify this link
        History.pushState(null,title,url);
                if (hash) window.location.hash = hash;
        event.preventDefault();

        return false;
      });
      
      // Chain
      return $this;
    };
    
    
    // Ajaxify our Internal Links
    $body.ajaxify();
    
    // Hook into State Changes
    $window.bind('statechange',function(){
      // Prepare Variables
      var
        State = History.getState(),
        url = State.url,
        relativeUrl = url.replace(rootUrl,'');

      // Set Loading
    //  $(".home-icon").addClass('loading');
 

  
  

 
      
      // Start Fade Out
      // Animating to opacity to 0 still keeps the element's height intact
      // Which prevents that annoying pop bang issue when loading in new content

       $main = $('#site-wrap'), // content selector

      //$content.animate({opacity:100},800);
      $body.addClass('site-loading'); // this class is remove in the site.js
    

 
      // Ajax Request the Traditional Page
      $.ajax({
        url: url,
        success: function(data, textStatus, jqXHR){
          // Prepare
          var
            $data = $(documentHtml(data)),
            $dataBody = $data.find('.document-body:first'),
            bodyClasses = $data.find('.document-body:first').attr('class'),
            $dataContent = $dataBody.find(contentSelector).filter(':first'),
            introanimationdone = true, // once succesfully made an initial ajax transformation - change variable so we always add animation-done class 
            $menuChildren, 
            contentHtml, 
            $scripts;
          
        //  console.log("url: url," +url+"");

         // console.log("intro animation done? =" +introanimationdone+"");

            if (introanimationdone == true){
              
             // console.log("introanimation not needed anymore");
              $("body").attr("class", data.match(/body class=\"(.*?)\"/)[1]);
              $("body").addClass('animation-done');// add this after all the other classes added?
              $('body').addClass('animation-hide'); //add class so now hidden at all times?


              $("body").removeClass('animation-fix');// 

            } else {

              $("body").attr("class", data.match(/body class=\"(.*?)\"/)[1]);


            }
            //}
           // add
          //Add classes to body
          



          //  $("body").addClass('timer'); // timer anim
          //  $("#home-fill").attr("class", "on");
        //    $("#site-wrap").addClass('fromtransition'); // switchup the direction from which it loads

          //var trigger_fill = document.getElementById("trigger_fill");

          //trigger_fill.beginElement();
          
          // Fetch the scripts
          $scripts = $dataContent.find('.document-script');
          if ( $scripts.length ) {
            $scripts.detach();
          }

          // Fetch the content
          contentHtml = $dataContent.html()||$data.html();
          if ( !contentHtml ) {
            document.location.href = url;
            return false;
          }
          
         // console.log("$menu" + $menu + " how many");
          // Update the menu
          $menuChildren = $menu.find(menuChildrenSelector);
          /* targeting both the top and bottom menu

          */

          $menuChildren.filter(activeSelector).removeClass(activeClass); // page class
          $menuChildren.filter(activeMenuSelector).removeClass(activeMenuClass); // menu class
          
 
         // console.log("relativeUrl = "+ relativeUrl +"");
         // console.log("url = "+ url +"");
         // console.log("rootUrl = "+ rootUrl +"");

          

  
          /* TO DO - tidy this mess up

                    // issues with the homepage link - so additional js added here
               */
          if (rootUrl == 'http://localhost:8888/') {
          // local:

           //console.log("relativeUrl" +relativeUrl +"")
            if (relativeUrl == 'theseus-wp-v2/'){
              // if theseus-wp-v2/ blank then this is likely to tbe the home-page link:
              // check if it could be anything else
              // hompage
            //console.log("local site & should have just clicked on home page link?")
            $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]').filter('.menu-item-home');


            } else {
              //not homepage
            //console.log("local site & clickedsomething else?")
            $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]');


            }//if (relativeUrl == '')

          }else{ //if (rootUrl == 'http://localhost:8888/') 
          // not local:

            if (relativeUrl == ''){ 
              // if blank then this is likely to tbe the home-page link:
              // check if it could be anything else
              // hompage
          //  console.log("live site & should have just clicked on home page link?")
            $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]').filter('.menu-item-home');

            } else{
              //not homepage
            //console.log("live site & clickedsomething else?")
            $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]');


            }//if (relativeUrl == '')


          }// if (rootUrl == 'http://localhost:8888/') 

               // was this: -
                    //  $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]');

          /* END TO DO - tidy this mess up */



          if ( $menuChildren.length === 1 ) {
           $menuChildren.addClass(activeClass); 
           $menuChildren.addClass(activeMenuClass); 

           console.log("if ( $menuChildren.length === 1 )");
          } else {

            $menuChildren.addClass(activeClass); 
           $menuChildren.addClass(activeMenuClass); 

           console.log("if ( $menuChildren.length" + $menuChildren.length +")" );
     
            // so if not 1, still update the links? probaly not good idea for wahtever reason this was code liek this in the first plac 
            // atm moment it is this lknk that I need to target only; given the error that's occuring       
            //$(".menu-item-home").addClass(activeClass); 
            //$(".menu-item-home").addClass(activeMenuClass); 

                 //    $menuChildren.addClass(activeClass); 
                //   $menuChildren.addClass(activeMenuClass); 

          }
         // console.log("menuChildren =" + $menuChildren +"");

          // Update the content
          $content.stop(true,true);
          $('html, body').animate({scrollTop: '0px'}, 0); // scroll to top of page

          $content.html(contentHtml).ajaxify().css('opacity',100).show(); /* you could fade in here if you'd like */


          // Update the title
          document.title = $data.find('.document-title:first').text();
          try {
            document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<','&lt;').replace('>','&gt;').replace(' & ',' &amp; ');
          }
          catch ( Exception ) { }
          
          // Add the scripts
          $scripts.each(function(){
            var $script = $(this), scriptText = $script.text(), scriptNode = document.createElement('script');
            if ( $script.attr('src') ) {
              if ( !$script[0].async ) { scriptNode.async = false; }
              scriptNode.src = $script.attr('src');
            }
              
              scriptNode.appendChild(document.createTextNode(scriptText));
              contentNode.appendChild(scriptNode);
          });

          
          // Complete the change
          if ( $body.ScrollTo||false ) { 
           // $body.ScrollTo(scrollOptions); 

          //  console.log("are we scrolling?")
          } 
          /* http://balupton.com/projects/jquery-scrollto */
          
 


          
            if(window.location.hash) {
              
            //  var hash = $(location).attr('hash');
             // $('html,body').animate({scrollTop: $(hash).offset().top},'slow');
              
               // console.log('hashs')
                //console.log(hash);
              // Fragment exists
            } else {
              // Fragment doesn't exist
              
         //  $('html,body').animate({ scrollTop: 0 }, 'fast'); 

              //  console.log('no hashs')

            }

                     
 



      //  $('#loader').removeClass('on');
      //  $('.logo-mask').addClass('off');
  
          // Add further scripts
 
   

            //  $(document).imagesLoaded( function(){
                
         // setTimeout(function(){
   


 
             $.getScript( ""+themeurl+'/assets/js/site.js', function( data, textStatus, jqxhr ) {
            //$.getScript( "https://theseus.agency/wp-content/themes/theseus/assets/js/site.js", function( data, textStatus, jqxhr ) {
//                $.getScript( "../wp-content/themes/theseus/assets/js/site.js", function( data, textStatus, jqxhr ) {
              //   console.log( data ); // Data returned
              //  console.log( textStatus ); // Success
              //  console.log( jqxhr.status ); // 200
                    // console.log( ""+themeurl +"site - js loaded after ajax" );

 
 
/*
                  function waitloading(){
                          

                          $("body").removeClass('loading');
                          console.log('loading removed');
                         $("#site-wrap").removeClass('fromleft fromright fromtop frombottom fromtransition'); // remove the direction from which it loads

                       }//waitloading

                     


                      function start(){

                      //  var from = from;
                      //  console.log(from)

                   $window.trigger(completedEventName);

                  //$body.addClass(from);

                   $body.removeClass('wait');
                        console.log('wait removed')

                  setTimeout(waitloading, 2000);  

                      } setTimeout(start, 3000); //added a time outfunction; because of fonts need loading first
                         
*/
                             
                    
     
 
                          


              }); // get sscript
   
           //   }, 100); //timeout
                 //    
            //  }); // images loaded

            
          
  
          // Inform Google Analytics of the change
          //if ( typeof window._gaq !== 'undefined' ) {
          //  window._gaq.push(['_trackPageview', relativeUrl]);
          //}

          // Inform Google Analytics of the change
            if ( typeof window.ga !== 'undefined' ) {
          // Universal Analytics
              window.ga('send', 'pageview', relativeUrl);
          } else if ( typeof window._gaq !== 'undefined' ) {
          // Legacy analytics
          window._gaq.push(['_trackPageview', relativeUrl]);
            }

          // Inform ReInvigorate of a state change
          if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
            reinvigorate.ajax_track(url);
            // ^ we use the full url here as that is what reinvigorate supports
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          document.location.href = url;
          return false;
        }
      }); // end ajax


    

    }); // end onStateChange
    
  }); // end onDomLoad
  



})(window); // end closure

  