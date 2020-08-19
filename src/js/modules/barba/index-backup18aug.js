import {
  domReady,
  menuClasses,
  opacity,
  imageopacity,
  menuPositioner,
  // navigation,
  orientation,
 } from '../../utilities/helpers';

/*
import {
  blocks
} from '../../utilities/blocks';
*/
// console.log("barba.js index");

// Modules.
/*import releasearchive from '../release-archive/index'
import artistarchive from '../artist-archive/index'
import frontpage from '../front-page/index'
*/
import blocks from '../../modules/blocks/index';
import layoutgrid from '../../modules/layout-grid/index';

// import siteload from '../../modules/siteload/index'


// TO DO - for cally site; review the following namespaces and ensure configured for the cally site

export default function init() {

 /* var activeradio = false,
      pausedradio = false,
      stickyradio = false,
      minimisedradio = false,
      hasradioblock = false, */
      touch = false;
   

 barba.init({
  views: [
    
    /*{
    namespace: 'page',
    beforeLeave(data) {
      console.log("before leave: namespace = page");
      // https://github.com/barbajs/barba/issues/51#issuecomment-531465899
      // Set <body> classes for "next" page - make sure this applied to all leaves; not just page
      //  var nextHtml = data.next.html;
              // var response = nextHtml.replace(/(<\/?)body( .+?)?>/gi, '$1notbody$2>', nextHtml)
              // var bodyClasses = $(response).filter('notbody').attr('class')
              // $("body").attr("class", bodyClasses);

      // do something before leaving the current `page` namespace
    }
  }, */
  {
    namespace: 'page',
    afterEnter(data) { 
      console.log("afterEnter: namespace = page");

       opacity();
       domReady(blocks);

    }
  },{
    namespace: 'archive',
    afterEnter(data) {
      console.log("afterEnter: namespace = archive");
 

      imageopacity();
      opacity();
      // domReady(siteload);
      // domReady(blocks); // probably not needed here
 
    }
  },{
    namespace: 'single-post',
    afterEnter(data) {
      console.log("afterEnter: namespace = single-post");
 
      imageopacity();
      opacity();
      // domReady(siteload);
      domReady(blocks);
 
    }
  },{
    namespace: 'layout-grid',
    afterEnter(data) {
      console.log("afterEnter: namespace = layout grid");
 
      opacity();
      domReady(layoutgrid);
      domReady(blocks);
 
    }
  }, {
    namespace: 'front-page',
    afterEnter(data) {
      console.log("afterEnter: namespace = front-page");
      
        opacity();
        // domReady(siteload);

        // domReady(frontpage);
        // domReady(blocks);
 

    }
  }
  ]
});


/*
barba.hooks.once((data) => {
  console.log("once - all namespaces");
  domReady(siteLoad);

}); //barba.hooks.once((data) =>
// "Note that beforeOnce, once and afterOnce global hooks are not permitted. - so what to do here
*/

// https://github.com/barbajs/barba/issues/51#issuecomment-531465899
//applies to all namespaces:

 
barba.hooks.beforeLeave((data) => {
  console.log("beforeleave");

    introanimationdone = true; // before initial leave

    if($('body').hasClass('is-not-touch')){
      touch = false;
    } else{
      touch = true
    }
    
    if($('body').hasClass('dev-grid-on')){
      devon = true;
    } else{
      devon = false;
    }
    
 
}); //barba.hooks.beforeLeave((data) =>
 

barba.hooks.afterLeave((data) => {
  console.log("afterleave")

  $('html, body').animate({
    scrollTop: $("body").offset().top 
  }, 10);


  // Set <body> classes for "next" page
  var nextHtml = data.next.html;
  var response = nextHtml.replace(/(<\/?)body( .+?)?>/gi, '$1notbody$2>', nextHtml);
  var bodyClasses = $(response).filter('notbody').attr('class');

  $("body").attr("class", bodyClasses);

  // Update the active menu item classes
  // https://github.com/barbajs/barba/issues/419
  // TODO: reveiw other active classes; is this all of them, I think so

  if (data.next.url.path) {
    const currentMenu = 'current-menu-item',
      currentPage = 'current_page_item',
      currentMenuAncestor = 'current-menu-ancestor',
      currentMenuParent = 'current-menu-parent',
      currentPageAncestor = 'current_page_ancestor';

    menuClasses(data, currentMenu);
    menuClasses(data, currentPage);
    menuClasses(data, currentMenuAncestor);
    menuClasses(data, currentMenuParent);
    menuClasses(data, currentPageAncestor);

  } //if ( data.next.url.path

  // set up additional clasess + variables
 
    if (devon == true) {
      $('body').addClass('dev-grid-on'); 
    }else{
      $('body').removeClass('dev-grid-on'); //remove in case
    }
  
    if (touch == true) {
      console.log("apply touch")
      $('body').addClass('is-touch'); 
      $("body").removeClass('is-not-touch');      

    }else{

      $("body").addClass('is-not-touch');      
      $("body").removeClass('is-touch');      
 
    }/// if minimisedradio

    if (introanimationdone == true){
              
       console.log("introanimation not needed anymore");
      //  $("body").attr("class", data.match(/body class=\"(.*?)\"/)[1]);
       $("body").addClass('animation-done');// add this after all the other classes added?
       $("body").addClass('animation-hide'); //add class so now hidden at all times?
       $("body").removeClass('animation-fix');// 

    } else{

      console.log("introanimationdone == false");

    }








    menuPositioner();//move menu
    orientation();

    
  //https://thisisadvantage.com/page-transitions-using-barba-js-wordpress-elementor/

  console.log("afterleave - reload script?")
  
  
  

  var new_imports = [];
  var new_evaluations = '';
  var new_style_imports = [];
  var new_style_evaluations = '';
 
 
 
  var script_tags = $(response).find('script');
  var style_tags = $(response).find('style');
 
  // var script_tags = nextHtml.find('script');
  // var script_tags = currentHtml.find('script');

  console.log("script_tags = " +script_tags+"");
  console.log("style_tags = " +style_tags+"");


  $(script_tags).each(function(i, s) {
      var src = $(s).attr('src');
      if (src) {
          // if not already initialized add it
          if (initialized_scripts.indexOf(src) == -1) {
              new_imports.push(src);
          }
      } else {
          // it is an inline script, will evaluate it
          new_evaluations += script_tags[i].innerHTML;
      }

      console.log("source = " +src+"");


      
  });


  
  $(style_tags).each(function(i, s) {
    var src = $(s).attr('src');
    if (src) {
        // if not already initialized add it
        if (initialized_style.indexOf(src) == -1) {
            new_style_imports.push(src);
        }
    } else {
        // it is an inline script, will evaluate it
        new_style_evaluations += style_tags[i].innerHTML;
    }

    console.log("source STyle = " +src+"");
});
    
// https://www.fjobeir.com/implement-barba-js-with-wordpress/

$.getMultiScripts = function(arr) {
  var _arr = $.map(arr, function(src) {
      return $.getScript(src);
  });
  _arr.push($.Deferred(function( deferred ){
      $( deferred.resolve );
  }));
  return $.when.apply($, _arr);
}

$.getMultiScripts(script_array).done(function() {
  // all done
}).fail(function(error) {
  // one or more scripts failed to load
}).always(function() {
  // always called, both on success and error
});

$.getMultiScripts(new_imports).done(function() {
  eval(new_evaluations);
}).fail(function(error) {
  // one or more scripts failed to load
}).always(function() {
  // always called, both on success and error
});
  /*
 $(response).find('script').each(function (i, script) {
      var $script = $(script);

      console.log("$script" +$script+"");

      $.ajax({
          url: $script.attr('src'),
          cache: true,
          dataType: 'script',
          success: function () {
              $script.trigger('load');
          }
      });
  });
    */
    
    /* delete this - tried to ensrue scripts initated on page change
    nextHtml.find('script').each(function (i, script) {
      var $script = $(script);
      $.ajax({
          url: $script.attr('src'),
          cache: true,
          dataType: 'script',
          success: function () {
              $script.trigger('load');
              console.log("scriptreload?")
          }
      });
    });

    */

/* integrate Analytics - this won't work - so research via barbav2 website I reckon

      // Inform Google Analytics of the change
        if ( typeof window.ga !== 'undefined' ) {
          // Universal Analytics
          window.ga('send', 'pageview', relativeUrl);
        } else if ( typeof window._gaq !== 'undefined' ) {
          // Legacy analytics
          window._gaq.push(['_trackPageview', relativeUrl]);
        }
            

        // Inform Google Analytics of the change
        if ( typeof window._gaq !== 'undefined' ) {
          window._gaq.push(['_trackPageview', relativeUrl]);
        }

        // Inform ReInvigorate of a state change
        if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
          reinvigorate.ajax_track(url);
          // ^ we use the full url here as that is what reinvigorate supports
        }*/





}); //barba.hooks.afterLeave((data) =>

/*
 
barba.hooks.afterEnter((data) => {



  console.log("afterenter - reload script?")
  
  
  

  var new_imports = [];
  var new_evaluations = '';

  // var nextHtml = data.next.html;
  var currentHtml = data.current.html;

  console.log("currentHtml = " +currentHtml+"");

  // var script_tags = nextHtml.find('script');
  var script_tags = currentHtml.find('script');

  console.log("script_tags = " +script_tags+"");

  $(script_tags).each(function(i, s) {
      var src = $(s).attr('src');
      if (src) {
          // if not already initialized add it
          if (initialized_scripts.indexOf(src) == -1) {
              new_imports.push(src);
          }
      } else {
          // it is an inline script, will evaluate it
          new_evaluations += script_tags[i].innerHTML;
      }

      console.log("source = " +src+"");
  });
    


  /*
    var nextHtml = data.next.html;

    nextHtml.find('script').each(function (i, script) {
        var $script = $(script);
        $.ajax({
            url: $script.attr('src'),
            cache: true,
            dataType: 'script',
            success: function () {
                $script.trigger('load');
            }
        });
    });

    
  */

// }); //barba.hooks.afterEnter((data) =>
 




 
    
   
  //  function that places jnitial loadec scripts in an array 
  
var initialized_scripts = [];

var initialized_style = [];

var script_tags = document.getElementsByTagName("script");
var style_tags = document.getElementsByTagName("style");

$(script_tags).each(function(i, s) {
    var src = $(s).attr('src');
    if (src) {
        initialized_scripts.push(src);
    }
    
    console.log("src" +src+"");
});
  
$(style_tags).each(function(i, s) {
  var src = $(s).attr('src');
  if (src) {
      initialized_style.push(src);
  }
  
  console.log("src" +src+"");
});
  
} //export default function init()
