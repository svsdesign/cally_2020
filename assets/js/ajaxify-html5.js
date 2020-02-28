// Ajaxify
// v1.0.1 - 30 September, 2012 - svs.design edit or Thesues 2020
// https://github.com/browserstate/ajaxify


function menupositioner(){
    //console.log(" menupositioner");

  var $positioner = $("#positioner")
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
   
      activemenuitemnumber = $activemenuitem.attr( "menu-number");
      applymarginleft = ((activemenuitemnumber * positionerwidth) - positionerwidth)+"%";

      //console.log("activemenuitemnumber" +activemenuitemnumber+"");
      $positioner.css("width",positionerwidth+"%");
      $positioner.css("margin-left", applymarginleft+"%");
      $positioner.animate({
          marginLeft: applymarginleft
      }, 500);

}//menupositioner()



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

      menupositioner();

    // Prepare Variables
    var
      loaderanimationncss = false,
      /* Application Specific Variables */
      contentSelector = '#main.main-fixer',///'#site-wrap', /// this was #site-wrap; which is wrong?!
      $content = $(contentSelector).filter(':first'),
      contentNode = $content.get(0),
      $menu = $('#menu-header-navigation, #menu-footer-navigation');//.filter(':first'), //removed filster first; becuase we're g
      activeClass ='current_page_item', //current_page_item
      activeMenuClass ='current-menu-item', //current_page_item
      activeSelector = '.current_page_item',
      activeMenuSelector = '.current-menu-item',
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

    // console.log("rootUrl" + rootUrl +"");
    // Locally this is http://localhost:8888 & not http://localhost:8888/theseus-wp-2/ 
    
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
    
    // Ajaxify Helper
    $.fn.ajaxify = function(){
      // Prepare
      var $this = $(this);
      var n = 0;

    /// Ajaxify
    //  $this.find('a:internal:not(.no-ajaxy,[href^="#"],[href*="wp-login"],[href*="wp-admin"])').click(function(event){
      $this.find('a:internal:not(.no-ajaxy)').click(function(event){

        // Prepare
        var
          $this = $(this),
          $main = $('#site-wrap'), // content selector
          url = $this.attr('href'),
          title = $this.attr('title')||null,
          hashPos = url.indexOf('#'), hash;
   
          // Continue as normal for cmd clicks etc
          if ( event.which == 2 || event.metaKey ) { return true; }
          
            //edit to ensure we can still use /#  - https://github.com/browserstate/history.js/issues/57

          if (hashPos > -1) {
            
             // console.log("hash click")
             hash = url.substr(hashPos);
             url = url.substring(0, hashPos);
 
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

      $('#loader').addClass('on');
         loaderanimationncss = false;
         //console.log("loaderanimationncss = " +loaderanimationncss+"" );

      setTimeout(function (){
      // I want to ensure that the duration of the animation is fully played out before fading in
      // 2 sec for animation to fade into 0
      loaderanimationncss = true;
      //console.log("in timeout loaderanimationncss = " +loaderanimationncss+"" )

      }, 1000); 

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
 
            if (introanimationdone == true){
              
             // console.log("introanimation not needed anymore");
              $("body").attr("class", data.match(/body class=\"(.*?)\"/)[1]);
              $("body").addClass('animation-done');// add this after all the other classes added?
              $('body').addClass('animation-hide'); //add class so now hidden at all times?
              $("body").removeClass('animation-fix');// 

            } else {

              $("body").attr("class", data.match(/body class=\"(.*?)\"/)[1]);
            }
          
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
            
            // Update the menu
            $menuChildren = $menu.find(menuChildrenSelector);
            // targeting both the top and bottom menu 

            $menuChildren.filter(activeSelector).removeClass(activeClass); // page class
            $menuChildren.filter(activeMenuSelector).removeClass(activeMenuClass); // menu class
            
           if (rootUrl == 'http://localhost:8888/') {  // local:

               if (relativeUrl == 'theseus-wp-v2/'){// if theseus-wp-v2/ then this is likely to tbe the home-page link:
                
                $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]').filter('.menu-item-home');

              } else { //not homepage
                
                $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]');

              }

          }else{ // not local:

            if (relativeUrl == ''){ 
              // if blank then this is likely to tbe the home-page link:
              $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]').filter('.menu-item-home');
            } else{
              $menuChildren = $menuChildren.has('a[href^="'+relativeUrl+'"], a[href^="/'+relativeUrl+'"],a[href^="'+url+'"]');
            }//if (relativeUrl == '')

          }// if (rootUrl == 'http://localhost:8888/')  

          if ( $menuChildren.length === 1 ) {
          $menuChildren.addClass(activeClass); 
          $menuChildren.addClass(activeMenuClass); 

          //console.log("if ( $menuChildren.length === 1 )");
          } else {

          $menuChildren.addClass(activeClass); 
          $menuChildren.addClass(activeMenuClass); 
          //console.log("if ( $menuChildren.length" + $menuChildren.length +")" );
          }
 
          // Update the content
          $content.stop(true,true);
          $('html, body').animate({scrollTop: '0px'}, 0); // scroll to top of page
          /// review this - not sure what js is seeting the opacity atm?
          $content.html(contentHtml).ajaxify().css('opacity',0).show(); /* you could fade in here if you'd like */

          var check = function(){
              //console.log("check = " +loaderanimationncss+"" )

              if(loaderanimationncss == true){
                // run when condition is met
                // console.log("loaderanimationncss = true");
                $content.css('opacity',100);
                $('#loader').removeClass('on');

              }
              else {
              setTimeout(check, 10); // check again in a 10ms
              }
          }
          check();// ensure css animation has finished
       
         // move the active link positioner:
          menupositioner();

          // Update the title
          document.title = $data.find('.document-title:first').text();
          try {
            document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<','&lt;').replace('>','&gt;').replace(' & ',' &amp; ');
          }
          catch ( Exception ) { }
          
          // Add the scripts
          $scripts.each(function(){
          //  console.log("script each");
            var $script = $(this), scriptText = $script.text(), scriptNode = document.createElement('script');
            if ( $script.attr('src') ) {
              if ( !$script[0].async ) { scriptNode.async = false; }
              scriptNode.src = $script.attr('src');
            }             
              scriptNode.appendChild(document.createTextNode(scriptText));
              contentNode.appendChild(scriptNode);
          });
  
          // Complete the change /* http://balupton.com/projects/jquery-scrollto */
          if ( $body.ScrollTo||false ) { 
           // $body.ScrollTo(scrollOptions); 
          //  console.log("are we scrolling?")
          } 
                    
            if(window.location.hash) {
              
             // console.log("window.location.hash");
              var hash = $(location).attr('hash');
              $('html,body').animate({scrollTop: $(hash).offset().top},'slow');
              
              //console.log(hash);
              // Fragment exists
            } else {
              // Fragment doesn't exist
              // console.log("ELSE: window.location.hash");
              //$('html,body').animate({ scrollTop: 0 }, 'fast'); 

            }
            
            $.getScript( ""+themeurl+'/assets/js/site.js', function( data, textStatus, jqxhr ) {
            }); // get sscript        
             
          // Inform Google Analytics of the change

          // TO DO: ensure this works, but also inline with cookie consent tool

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
          // END Inform Google Analytics of the change

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