// https://www.fjobeir.com/implement-barba-js-with-wordpress/





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




// consider moving this elswhere

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
  
  
  
//scripts:







}); //barba.hooks.afterLeave((data) =>
   



barba.hooks.beforeEnter(({ current, next }) => {
  // Set <body> classes for the 'next' page
  if (current.container) {
    // // only run during a page transition - not initial load
    let nextHtml = next.html;
    let response = nextHtml.replace(
      /(<\/?)body( .+?)?>/gi,
      "$1notbody$2>",
      nextHtml
    );
    let bodyClasses = $(response).filter("notbody").attr("class");
    $("body").attr("class", bodyClasses);

  
  }
  console.log("beforeenter: reload scripts")
  // http://localhost:8888/cally-2020/wp-content/plugins/wpdiscuz/assets/third-party/font-awesome-5.13.0/css/fa.min.css?ver=7.0.7


   

  // Discuz
  // const baseURL = window.location.hostname;
  // if local - change this basically to ensure it works live and local



  /*
  if baseURL =="localhost"{

    const baseURL = "/cally-2020/
  }else{

    const baseURL

    }
 */
  const baseURL = window.location.hostname;
  const protocol = window.location.protocol;

console.log("baseURL" +baseURL+"");

//CSS
  const wpdiscuzCSSFa = "/cally-2020/wp-content/plugins/wpdiscuz/assets/third-party/font-awesome-5.13.0/css/fa.min.css";
  const wpdiscuzCSSMain = "/cally-2020/wp-content/plugins/wpdiscuz/themes/default/style.css";
  const wpdiscuzCSSCombo = "/cally-2020/wp-content/plugins/wpdiscuz/assets/css/wpdiscuz-combo.min.css";
  
//JS

  const wpdiscuzJSCombo = "/cally-2020/wp-content/plugins/wpdiscuz/assets/js/wpdiscuz-combo.min.js";
  

// Container

  const wpdiscusWrapper = next.container.querySelectorAll(".comments-wrap");


  // http://localhost:8888/wp-content/plugins/wpdiscuz/assets/third-party/font-awesome-5.13.0/css/fa.min.css
  // http://localhost:8888/cally-2020/wp-content/plugins/wpdiscuz/assets/third-party/font-awesome-5.13.0/css/fa.min.css?ver=7.0.7



/*
  // consider what variables I have / need?
  const wpdiscusVariables =
  'var gf_global = {"gf_currency_config":{"name":"Australian Dollar","symbol_left":"$","symbol_right":"","symbol_padding":" ","thousand_separator":",","decimal_separator":".","decimals":2},"base_url":"' +
  protocol +
  "//" +
  baseURL +
  '/wp-content/plugins/gravityforms","number_formats":[],"spinnerUrl":"' +
  protocol +
  "//" +
  baseURL +
  '/wp-content/plugins/gravityforms/images/spinner.gif"};';
*/

const wpdiscusVariables = 'var wpdiscuzAjaxObj = { "wc_hide_replies_text": "Hide Replies","wc_show_replies_text": "View Replies", "wc_msg_required_fields": "Please fill out required fields", "wc_invalid_field": "Some of field value is invalid", "wc_error_empty_text": "please fill out this field to comment", "wc_error_url_text": "url is invalid", "wc_error_email_text": "email address is invalid", "wc_invalid_captcha": "Invalid Captcha Code", "wc_login_to_vote": "You Must Be Logged In To Vote", "wc_deny_voting_from_same_ip": "You are not allowed to vote for this comment", "wc_self_vote": "You cannot vote for your comment", "wc_vote_only_one_time": "You\'ve already voted for this comment", "wc_voting_error": "Voting Error", "wc_comment_edit_not_possible": "Sorry, this comment is no longer possible to edit", "wc_comment_not_updated": "Sorry, the comment was not updated", "wc_comment_not_edited": "You\'ve not made any changes", "wc_msg_input_min_length": "Input is too short", "wc_msg_input_max_length": "Input is too long", "wc_spoiler_title": "Spoiler Title", "wc_cannot_rate_again": "You cannot rate again", "wc_not_allowed_to_rate": "You\'re not allowed to rate here", "wc_follow_user": "Follow this user", "wc_unfollow_user": "Unfollow this user", "wc_follow_success": "You started following this comment author", "wc_follow_canceled": "You stopped following this comment author.", "wc_follow_email_confirm": "Please check your email and confirm the user following request.", "wc_follow_email_confirm_fail": "Sorry, we couldn\'t send confirmation email.", "wc_follow_login_to_follow": "Please login to follow users.", "wc_follow_impossible": "We are sorry, but you can\'t follow this user.", "wc_follow_not_added": "Following failed. Please try again later.", "is_user_logged_in": "", "commentListLoadType": "0", "commentListUpdateType": "0", "commentListUpdateTimer": "30", "liveUpdateGuests": "0", "wordpressThreadCommentsDepth": "5", "wordpressIsPaginate": "0", "commentTextMaxLength": null, "commentTextMinLength": "1", "storeCommenterData": "100000", "socialLoginAgreementCheckbox": "1", "enableFbLogin": "0", "enableFbShare": "0", "facebookAppID": "", "facebookUseOAuth2": "0", "enableGoogleLogin": "0", "googleClientID": "", "googleClientSecret": "", "cookiehash": "f80d17f47ef46dbc2ecd16ce67aeab8e", "isLoadOnlyParentComments": "0", "scrollToComment": "1", "commentFormView": "collapsed", "enableDropAnimation": "1", "isNativeAjaxEnabled": "1", "enableBubble": "1", "bubbleLiveUpdate": "1", "bubbleHintTimeout": "45", "bubbleHintHideTimeout": "10", "cookieHideBubbleHint": "wpdiscuz_hide_bubble_hint", "bubbleShowNewCommentMessage": "1", "bubbleLocation": "content_left", "firstLoadWithAjax": "0", "wc_copied_to_clipboard": "Copied to clipboard!", "inlineFeedbackAttractionType": "blink", "loadRichEditor": "1", "wpDiscuzReCaptchaSK": "", "wpDiscuzReCaptchaTheme": "light", "wpDiscuzReCaptchaVersion": "2.0", "wc_captcha_show_for_guest": "0", "wc_captcha_show_for_members": "0", "wpDiscuzIsShowOnSubscribeForm": "0", "wmuEnabled": "1", "wmuInput": "wmu_files", "wmuMaxFileCount": "1", "wmuMaxFileSize": "2097152", "wmuPostMaxSize": "67108864", "wmuIsLightbox": "1", "wmuMimeTypes": {"jpg": "image/jpeg", "jpeg": "image/jpeg", "jpe": "image/jpeg", "gif": "image/gif", "png": "image/png", "bmp": "image/bmp", "tiff": "image/tiff", "tif": "image/tiff", "ico": "image/x-icon"}, "wmuPhraseConfirmDelete": "Are you sure you want to delete this attachment?", "wmuPhraseNotAllowedFile": "Not allowed file type", "wmuPhraseMaxFileCount": "Maximum number of uploaded files is 1", "wmuPhraseMaxFileSize": "Maximum upload file size is 2MB", "wmuPhrasePostMaxSize": "Maximum post size is 64MB", "msgEmptyFile": "File is empty. Please upload something more substantial. This error could also be caused by uploads being disabled in your php.ini or by post_max_size being defined as smaller than upload_max_filesize in php.ini.", "msgPostIdNotExists": "Post ID not exists", "msgUploadingNotAllowed": "Sorry, uploading not allowed for this post", "msgPermissionDenied": "You do not have sufficient permissions to perform this action", "wmuSecurity": "928bf9c030", "wmuKeyImages": "images", "wmuSingleImageWidth": "auto", "wmuSingleImageHeight": "200", "version": "7.0.7", "wc_post_id": "209", "loadLastCommentId": "3", "isCookiesEnabled": "1", "dataFilterCallbacks": [],"is_email_field_required": "1", "url":"' + protocol + "//" + baseURL + '/cally-2020/wp-admin/admin-ajax.php", "customAjaxUrl": "' + protocol + "//" + baseURL + '/cally-2020/wp-content/plugins/wpdiscuz/utils/ajax/wpdiscuz-ajax.php", "bubbleUpdateUrl":"' + protocol + "//" + baseURL + '/cally-2020/wp-json/wpdiscuz/v1/update","restNonce": "ac3ad6c7b7"  };';

  // const gformWrapper = next.container.querySelectorAll(".gform_wrapper");
  //  const gformSomethingElse = '/wp-content/plugins/gravityforms/css/somethingElse.min.css';

  if (wpdiscusWrapper) {
    // run if the page contains a form

    // consider use of vriables?

       const wpdiscusVariablesScript = document.createElement("script");
      wpdiscusVariablesScript.innerHTML = wpdiscusVariables;
      document.body.appendChild(wpdiscusVariablesScript);
 

    /*
    loadjscssfile(gravityFormJS, "js");
    loadjscssfile(gravityFormsJquery, "js");
    loadjscssfile(gformReset, "css");
    loadjscssfile(gformMainCSS, "css");
    loadjscssfile(gformReadyclass, "css");
    loadjscssfile(gformBrowser, "css");
    // loadjscssfile(gformSomethingElse, 'css')
    */
    
    loadjscssfile(wpdiscuzCSSFa, "css");
    loadjscssfile(wpdiscuzCSSMain, "css");
    loadjscssfile(wpdiscuzCSSCombo, "css");

    loadjscssfile(wpdiscuzJSCombo, "js");

    

/*
    if (window["gformInitDatepicker"]) {
      gformInitDatepicker();
    }
*/
    wpdiscusWrapper.forEach((element) => {
      const parent = element.parentElement;
      const scripts = parent.querySelectorAll("script");
      scripts.forEach((script) => {
        const scriptCode = script.innerHTML;
        const newScript = document.createElement("script");
        script.remove();
        newScript.innerHTML = scriptCode;
        parent.appendChild(newScript);
      });
    });

  }

  /*

  // DELETE START

  // GRAVITY FORMS
  const baseURL = window.location.hostname;
  const protocol = window.location.protocol;

  // Here we are manually reloading the gravity form scripts and styles. If you find that you get errors in future with missing assets, simply add them below.
  const gravityFormJS =
    "/wp-content/plugins/gravityforms/js/gravityforms.min.js";
  const gravityFormsJquery =
    "/wp-content/plugins/gravityforms/js/jquery.json.min.js";
  const gformReset = "/wp-content/plugins/gravityforms/css/formreset.min.css";
  const gformMainCSS = "/wp-content/plugins/gravityforms/css/formsmain.min.css";
  const gformReadyclass =
    "/wp-content/plugins/gravityforms/css/readyclass.min.css";
  const gformBrowser = "/wp-content/plugins/gravityforms/css/browsers.min.css";
  const gformVariables =
    'var gf_global = {"gf_currency_config":{"name":"Australian Dollar","symbol_left":"$","symbol_right":"","symbol_padding":" ","thousand_separator":",","decimal_separator":".","decimals":2},"base_url":"' +
    protocol +
    "//" +
    baseURL +
    '/wp-content/plugins/gravityforms","number_formats":[],"spinnerUrl":"' +
    protocol +
    "//" +
    baseURL +
    '/wp-content/plugins/gravityforms/images/spinner.gif"};';
  const gformWrapper = next.container.querySelectorAll(".gform_wrapper");
  //  const gformSomethingElse = '/wp-content/plugins/gravityforms/css/somethingElse.min.css';

  if (gformWrapper) {
    // run if the page contains a form
    const gformVariablesScript = document.createElement("script");
    gformVariablesScript.innerHTML = gformVariables;
    document.body.appendChild(gformVariablesScript);

    loadjscssfile(gravityFormJS, "js");
    loadjscssfile(gravityFormsJquery, "js");
    loadjscssfile(gformReset, "css");
    loadjscssfile(gformMainCSS, "css");
    loadjscssfile(gformReadyclass, "css");
    loadjscssfile(gformBrowser, "css");
    // loadjscssfile(gformSomethingElse, 'css')

    if (window["gformInitDatepicker"]) {
      gformInitDatepicker();
    }

    gformWrapper.forEach((element) => {
      const parent = element.parentElement;
      const scripts = parent.querySelectorAll("script");
      scripts.forEach((script) => {
        const scriptCode = script.innerHTML;
        const newScript = document.createElement("script");
        script.remove();
        newScript.innerHTML = scriptCode;
        parent.appendChild(newScript);
      });
    });

  }

   //END  DELETE
 */


  }); //barba.hooks.afterEnter((data) =>
 
  
} //export default function init()
