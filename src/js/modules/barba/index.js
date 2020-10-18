// https://www.fjobeir.com/implement-barba-js-with-wordpress/





import {
  domReady,
  menuClasses,
  opacity,
  imageopacity,
  menuPositioner,
  removeCommentBubble,
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
import overview from '../../modules/overview/index';

// import siteload from '../../modules/siteload/index'


// TO DO - for cally site; review the following namespaces and ensure configured for the cally site

export default function init() {


 
// This function helps add and remove js and css files during a page transition
function loadjscssfile(filename, filetype) {
  if (filetype == "js") {
    //if filename is a external JavaScript file
    const existingScript = document.querySelector('script[src="${filename}"]');
    if (existingScript) {
      existingScript.remove();
    }
    var fileref = document.createElement("script");
    fileref.setAttribute("type", "text/javascript");
    fileref.setAttribute("src", filename);
  } else if (filetype == "css") {
    //if filename is an external CSS file
    const existingCSS = document.querySelector(`link[href='${filename}']`);
    if (existingCSS) {
      existingCSS.remove();
    }
    var fileref = document.createElement("link");
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("href", filename);
  }
  if (typeof fileref != "undefined")
    document.getElementsByTagName("head")[0].appendChild(fileref);
}
// END consider moving this elswhere






  var touch = false;
   

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
       domReady(overview);//review this; as we migh not have this on each /every page (such as privacy policies?)


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
 // consider changing this - atm it takes ages before the banner image is shown;
 // Because its waiting for all the images to load, inc

      opacity();
      // blocks();
      // 
      domReady(overview);
      domReady(layoutgrid);
      domReady(blocks);

    }
  }, {
    namespace: 'front-page',
    afterEnter(data) {
      console.log("afterEnter: namespace = front-page");
      
        imageopacity();
        opacity();
        domReady(blocks);

        // domReady(siteload);
        // domReady(frontpage);
    
 

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

  console.log("afterleave")

  if (data.next.url.path) {

    console.log("IF (data.next.url.path - apply menuclass changes")
    console.log("data.next.url.path" + data.next.url.path +"");

    const currentMenu = 'current-menu-item',
      currentPage = 'current_page_item',
      currentMenuAncestor = 'current-menu-ancestor',
      currentMenuParent = 'current-menu-parent',
      currentPageAncestor = 'current_page_ancestor';

    var thislinkdata = data.next.url.path;
    console.log("thislinkdata" +thislinkdata+"");

    if (thislinkdata == "/"){

      console.log("home url")
      console.log("we can assume its the home url on staging or live?");

      thislinkdata = thislinkdata;

    } else if( thislinkdata == "/cally-2020/"){
      console.log("home url")

      console.log("we can assume its home url on local");

      thislinkdata = thislinkdata;
   

    } else {
      thislinkdata = thislinkdata;
      console.log("else - so what kinda links we dealing wth?")

    }
      // console.log("menuClasses")
      menuClasses(thislinkdata, currentMenu);
      menuClasses(thislinkdata, currentPage);
      menuClasses(thislinkdata, currentMenuAncestor);
      menuClasses(thislinkdata, currentMenuParent);
      menuClasses(thislinkdata, currentPageAncestor);
 
  } else{
//    no (data.next.url.path

    // console.log("no (data.next.url.path?")

  }//if ( data.next.url.path

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


    removeCommentBubble();// remove any comment stuff we don't want to show after ajax page change
    // the scripts get re-loaded anyway next time enter the comment page - because prevent barbb



    menuPositioner();//move menu
    orientation();

    
  //https://thisisadvantage.com/page-transitions-using-barba-js-wordpress-elementor/

   
  
  
//scripts:
// https://wedevs.com/support/topic/loading-of-scripts






}); //barba.hooks.afterLeave((data) =>
   


  
} //export default function init()
