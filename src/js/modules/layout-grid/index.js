/*! svs - gridwork*/
/*

- look at ways of improving transitions/scaling of items:
  https://packery.metafizzy.co/extras.html#animating-item-size
  https://codepen.io/desandro/pen/jGJKL
    Aims: don't want to see any lags/ widening+narrowing spacing during screen resize

    // TODO isues: not working properly on Firefox? - issue wiht calculatig ratios:
    // look at order of renderibng + avaibilty of item(s) width and height measurments

//Add in rotating options:
https://codepen.io/svsdesign/pen/qBdxjwN


rasterise imgage to canvas
//https://cburgmer.github.io/rasterizeHTML.js/
//https://github.com/cburgmer/rasterizeHTML.js/wiki/Limitations

canvas to image
https://stackoverflow.com/questions/23681325/convert-canvas-to-pdf


  // saving into wp cms
  // https://wordpress.stackexchange.com/questions/165321/saving-data-uri-to-media-library
  // downloadImage();


*/

import {
  detectAttrChange,
  hoverDiv

} from '../../utilities/helpers';


export default function init() {

  var mediaImage, // becomes wp.media library
    $imagethumb = $('.acf-image-edit'),
    newitemid, // declare before use
    submissionname, //move elswhere
    $startbutton = $('.dev-layout-grid-toggle'),
  

    OgGridContent,// declare before use
    OgCoordinates;
    // console.log("layout-grid/index.js");

  // external js: packery.pkgd.js, draggabilly.pkgd.js
  // add Packery.prototype methods
  // get JSON-friendly data for items posiredtions

  Packery.prototype.getShiftPositions = function (attrName) {
    // attrName = attrName || 'id';
    //
    attrName = attrName || 'data-item-id'; //was id

    var _this = this;
    return this.items.map(function (item) {
      return {
        attr: item.element.getAttribute(attrName),
        x: item.rect.x / _this.packer.width
      }
    });
  };

  Packery.prototype.initShiftLayout = function (positions, attr) {

   console.log("hello here"+positions+"");

    if (!positions) {
      // if no initial positions, run packery layout
      this.layout();
      return;
    }
    // parse string to JSON
    if (typeof positions == 'string') {

      try {
        positions = JSON.parse(positions);
        // console.log("positions"+positions+"");
      } catch (error) {
        // console.error( 'JSON parse error: ' + error );
        this.layout();
        return;
      }
    }
    // console.log("hello");
    //  attr = attr || 'id'; // default to id attribute
    attr = attr || 'data-item-id'; // default to data-item-id attribute

    // console.log("attr"+attr+"");
    this._resetLayout();
    // set item order and horizontal position from saved positions
    this.items = positions.map(function (itemPosition) {
      //console.log("attr"+attr+"")

      var selector = '[' + attr + '="' + itemPosition.attr + '"]'
      var itemElem = this.element.querySelector(selector);
      var item = this.getItem(itemElem);
      item.rect.x = itemPosition.x * this.packer.width;
      return item;
    }, this);
    this.shiftLayout();
  };
 
  //----------------------------------------
  // The magic
  //----------------------------------------

  $('form#grid').submit(function (e) {
    e.preventDefault();
    var _this = $(this),
      url = _this.attr('action'),
      // url = _this.attr('action') +'?_wpnonce=<nonce>', //temp test - ddon't work

      method = _this.attr('method'),
      data = _this.serializeArray(),
      // btn = _this.find('button[type="submit"]'),
      modal = $('#modalResponse');

    if ($('#ag_wysiwyg_editor').length && typeof tinyMCE !== 'undefined') {
      data.push({
        name: 'fields[ag_wysiwyg_editor]',
        value: tinyMCE.get('ag_wysiwyg_editor').getContent()
      });
    }

    // btn.prop( { 'disabled' : true } );
    // https://wordpress.stackexchange.com/questions/348231/how-do-i-correctly-setup-an-ajax-nonce-for-wordpress-rest-api

    /*local storage
    // https://stackoverflow.com/questions/56156486/how-to-store-form-data-in-local-storage

    // https://stackoverflow.com/questions/52474321/how-to-save-and-get-form-state-from-localstorage-in-jquery-javascript
    */

    $.ajax({
      url: url,
      // method: 'POST', // trhing to get local storage to work
      method: method,
      beforeSend: function (xhr) {
           xhr.setRequestHeader('X-WP-Nonce', WP_settings.nonce);
        // xhr.setRequestHeader( 'X-WP-Nonce', '<nonce>' ); // temp test - doesn't wor either logged in or not logged in.

      },
      data: data,
      dataType: 'json',
    }).always(function (data) {
      //   btn.removeProp( 'disabled' );
      //   modal.find('.modal-body').html('<pre>' + JSON.stringify(data, null, "\t") + '</pre>');
      modal.modal('show');
      $('.response-message-wrap').addClass('response-message-active');

      setTimeout(function () {

        $('.response-message-wrap').removeClass('response-message-active');

      }, 1000);

    });

    return false;
  });


 
  
  // TYPE: Repeater
  //----------------------------------------

  var verifyItemsRepeater = function ($closestrepeater) {
    // var thisrepeater = = $('.repeater .remove-row');
    var $thisrepeater = $closestrepeater,
      // var removeRow = $thisrepeater.find(".remove-row");
      removeRow = $('.repeater .remove-row');

    if ($('.repeater > .repeater-item').length == 1) {
      removeRow.hide();
    } else {
      removeRow.show();
    }
  };

  // used for packeruy: debounce
  function debounce(fn, threshold) {
    var timeout;
    return function debounced() {
      if (timeout) {
        clearTimeout(timeout);
      }

      function delayed() {
        fn();
        timeout = null;
      }
      setTimeout(delayed, threshold || 100);
    }
  } // end used for packery: debounce

  function makedraggable($newitem, $thisgrid) {
    // console.log("make new item draggable");

    $thisgrid.find($newitem).each(function (i, itemElem) {
      var draggie = new Draggabilly(itemElem);
      $thisgrid.packery('bindDraggabillyEvents', draggie);
      // console.log("make draggable")
      // TO DO: ensur the menu options re-opens after an item has been dragged; it closes atm
    });

  } // function makedraggable($newitem){

  function onSubmission(){
    // form can submitted now
    detectAttrChange();
  }// onSubmission()

    
  function captureCanvas(){
    console.log("function captureCanvas()");
    $('body').addClass("capturing-image");//hide none image elements
    // As its takes seconds for this class + consequent css rules to "take affect?"
    //timeoutadded; seem to solv ethe issue in chrome
    setTimeout(function(){ 
      
    if ($('#canvas-wrap').has('canvas').length) {
        console.log("delete exisint canvas");
      $('#canvas-wrap').find('canvas').remove(); // delete existing canvas
    }

    if ($('#export-image-wrap img').length) {
       console.log("delete existing image");
       $('#export-image-wrap').find('img').remove(); // delete existing img
    }
    // Way to increase resolution of the image generated via toDataURL
    //https://github.com/niklasvh/html2canvas/issues/241
    // https://stackoverflow.com/questions/18316065/set-quality-of-png-with-html2canvas
            

    // delete this:
    //https://stackoverflow.com/questions/18935518/on-render-in-html2canvas-the-page-is-scrolled-to-the-top
    // review this - to ensure position is relative maybe?
    // window.scrollTo(0, 0); // review thgus
    /*

      Unsupported CSS properties
      These CSS properties are NOT currently supported by html2canvas

      Amongst others:
      box-shadow <<< NOTE THIS!!!

    // end delete this - if working

    */
console.log("Window.innerWidth = " + window.innerWidth +"")
     var thescale =  (1 / window.innerWidth)*1000;
     console.log("thescale = " + thescale +"")
  
        // theheight = 
    //  html2canvas(document.querySelector("#grid-wraps"), {
      html2canvas(document.querySelector(".grid-layer"), {

// https://makitweb.com/take-screenshot-of-webpage-with-html2canvas/
//https://stackoverflow.com/questions/36472094/how-to-set-image-to-fit-width-of-the-page-using-jspdf

        //when scale is 4, values not saving into the databse; issuew ith number of characters maybe?


        //  scale:1, // instead of scale: //scale: 2 will double the resolution from the default 96dpi)
        // //consider setting equal size; so imports are always the same?
        //ie set height and width instead of scale?

          // logging:true,

          // 1:4 ratio
          // 5 x 16 squares as main grid + 
          // 2 cols left + 2 cols right + 3 rows top + 3 rows bottom
          //
          scale:thescale,
        //  width:1100, 
        //  height:550,
          // windowWidth:1100,
          // windowHeight:550,
          scrollY: (window.pageYOffset * -1), //https://stackoverflow.com/questions/18935518/on-render-in-html2canvas-the-page-is-scrolled-to-the-top

          // windowWidth:Window.innerWidth,
          // windowHeight:Window.innerHeight,
          // width: 2200, // this set canvas size but not image
          // height: 1100,// this set canvas size but not image

      }).then(canvas => {
          
        var img = document.createElement("img"); // create an image object
            img.src = canvas.toDataURL(); // get canvas content as data URI    
            getCanvas = canvas;

          //create images
          document.querySelector("#export-image-wrap").appendChild(img);
          //create canvas
          // document.querySelector("#canvas-wrap").appendChild(canvas);
        
          $('body').find("input[name='image-data_hidden_field']").val(img.src);
          // https://stackoverflow.com/questions/15153776/convert-base64-string-to-an-image-file
          // $('body').find("textarea[name='submission_description']").val(img.src);

          $('body').addClass("submission-previewed");// submit button now clickable

          //change width of export options buttons to fit next to preview image
          $('.export-options').removeClass("grid-md-9").addClass("grid-md-6")
     
          $('body').removeClass("capturing-image");
              
          //if the update class was added lets remove it; as there are no more update once we generate the next image:
          $('body').removeClass("update-available");

        });//  }).then(canvas => 
 
      }, 1);

  }// function captureCanvas(thishtml, thiscanvas)

  function downloadCanvas(link, canvasId, filename) {
    link.href = document.getElementById(canvasId).toDataURL();
    link.download = filename;
  }// function downloadCanvas(link, canvasId, filename) 

  function initiatepackery($thisgrid) {

    console.log("initiate $thisgrid" +$thisgrid+"");

    var $grid = $thisgrid.imagesLoaded(function () {

      // console.log("imagesloaded - how may times?");

      $('body').addClass("images-loaded"); // review this if more than one grid
      // flag if packery is initialized
      var isPackeryInit = false;
      var isEditModeActive;
      var isGridItemsActive = false;

      function checkPackery() {

        var breakpointName = getComputedStyle(document.body, ':after').content;
        // console.log("breakpointName is" +breakpointName+"");

        if (breakpointName === '"widescreen"' && !isPackeryInit) {

          // init packery if widescreen & not already init
       
          $grid.packery({
            itemSelector: '.layout-grid-item',
            columnWidth: '.grid-sizer', // dynamic size set via css
            percentPosition: true,
            //gutter: '.gutter-sizer', // not needed?
            // stagger: 30 // animated
            isHorizontal: true,
            initLayout: false // disable initial layout
            // initLayout: true // enable this then reset the values if problems

          });
        
          var $coordinates = $grid.closest('.grid-layer').find('.coordinates'),
              initPositions = $coordinates.attr('value');

           /*   var canvas = document.getElementById("canvas"),
              html_container = document.getElementById("tester-grid-id"),
              html = html_container.innerHTML;

            // get html and generate an image in canvas 
            rasterizeHTML.drawHTML(html, canvas);
              */

          if (isGridItemsActive == false) {

            // console.log(isGridItemsActive+ "isGridItemsActive");            
            isGridItemsActive = true;

              var $griditems = $grid.find('.layout-grid-item'),
              $coordinates = $grid.closest('.grid-layer').find('.coordinates'),
              initPositions = $coordinates.attr('value'),
              $addrow = $grid.closest('.grid-layer').find('.repeater-wrap .add-row');

              $griditems.each(function (i) {

                console.log("each grid item - iniitally");

                var $thisitem = $(this),
                  $originalimage = $thisitem.find('img:not(.place-holder)'),
                  thisimageurl = $originalimage.attr("src"),
                  $thisplaceholder = $thisitem.find('img.place-holder'),
                  itemid = $thisitem.attr('data-item-id'),
                  $thisUi = $thisitem.find('.image-ui'),
                  $thisUiAppend = $thisUi.parent('label'),
                  $thisUiId = $thisUi.attr('id'),
                  thisimagewidth, // declare - but don't assign value yet
                  thisimageheight; // declare - but don't assign value yet

                  

                if ($originalimage.length > 0) {
                  gridImageOrientation($thisitem, thisimagewidth, thisimageheight);
                  itemEdit($thisitem, $grid); // allow editing of heights, width, z-index etc.
                  imageRemove(itemid); // allow delete of image

                  // TODO - review use of Javascript here:
                  // https://stackoverflow.com/questions/40947200/convert-image-extracted-from-url-to-base64
                  // https://stackoverflow.com/questions/22172604/convert-image-url-to-base64

                  convertImgToDataURLviaCanvas(thisimageurl, function (base64_data) {
                    // console.log(" $griditems. each base64_data");
                    $thisplaceholder.attr("src", base64_data);
                    // $thisimage.insertAfter('<img src="'+base64_data+'"/>');
                  });
 

                } else {
                  // there might not be an image available
                  // However, we still need to allow the item to be edited
                  gridImageOrientation($thisitem, thisimagewidth, thisimageheight);
                  itemEdit($thisitem, $grid); // allow editing of heights, width, z-index etc.
                  imageRemove(itemid); // allow delete of image

                } //if ($originalimage.length > 0)
                // console.log("$thisUi" + $thisUi+"");
                // $('#'+$thisUiId+'').css("background","red");
                // $thisUi.iconselectmenu()
                // $thisitem.css("opacity","0.2");
  
                

                $('#'+$thisUiId+'')
                  .iconselectmenu({
                    appendTo:$thisUiAppend,
                    // maxHeight:300, -- set via css atm
                    width: 'auto',
                    style: 'dropdown',
                    change: function( event, ui ) { 
                         console.log("change" +ui+"");
                        // $(ui.item.element).css("background","red");
                       var thisimage = $(ui.item.element).attr("data-segment-image");
                       var imagetype = $(ui.item.element).attr("data-segment-type");

                      //  console.log("thisimage" +thisimage+"");
                       $originalimage.attr("src",thisimage);//replace image 
                       $originalimage.attr("data-segment-type", imagetype);

                      //  console.log("imagetype = "+imagetype+"");
                       updateImageObject($thisitem, imagetype);

                        // canvashasChanged as soon as items are changed
                        canvasChange();    
  
                    }, //change functions
                     //change  
                    select: function( event, ui ) {
                        // $(ui).selectmenu( "close" ); // close
                          console.log("close this grid-item-options-toggle");
                          $thisitem.find('.grid-item-options-toggle').click();//trigger click
                        }//select
                  })
                  .iconselectmenu("menuWidget")
                  .addClass("ui-menu-icons avatar");  

                  //  $('#'+$thisUiId+'').css("background","red");
                  // $('#'+$thisUiId+'').iconselectmenu("open");// open by default - doesn't seem to work - i guess because I can't open all in one go... as opening one closes others
                  
              }); //$('.layout-grid-item').each( function( )

              $addrow.click(function () {
                // $('.repeater-wrap > .add-row').click(function () {

                console.log("hello add a row");
                // issue here: adding a row + then try to edit the item


                var $this = $(this),
                  $coordinates = $this.closest('.grid-layer').find('.coordinates'),
                  $repeateritems = $this.closest('.grid-layer').find('.repeater-item'),
                  $closestrepeater = $this.closest('.grid-layer').find('.repeater'),
                  $lastitem = $closestrepeater.find('.repeater-item:last'),
                  clone = $lastitem.clone(),
                  ids = $repeateritems.map(function () {
                    return $(this).attr('data-item-id');
                  }),
                  maxValueInArray = Math.max.apply(Math, ids),
                  itemid = maxValueInArray + 1; // used updated itemid

                $(clone).insertAfter($lastitem); // insert at the bottom of grid

                // ater item istertd new last items variable:
                var $newlastitem = $closestrepeater.find('.repeater-item:last'),
                    newIndex = $('.repeater > .repeater-item').length - 1,
                    $thisUi = $newlastitem.find('.image-ui'),
                    $thisUiAppend = $thisUi.parent('label');
                    // $thisUiId = $thisUi.attr('id');
                    // $('#'+$thisUiId+'').iconselectmenu('destroy'); // destroy the current select menu - doesn't really work
 
                    $newlastitem.find('.ui-selectmenu-button, .ui-front').remove(); //remove existing iconmenu

                    $newlastitem.attr('data-item-id', itemid); //update item id


                $closestrepeater.find('.repeater-item:last[name]').attr('name', function (index, name) {
                  return name.replace(/\[\d+\]/, '[' + newIndex + ']');
                });

                $closestrepeater.find('.repeater-item:last [name]').attr('name', function (index, name) {
                  return name.replace(/\[\d+\]/, '[' + newIndex + ']');
                });

                //to do - remove unneeded update & functions

                $newlastitem.find('.acf-image-edit').attr('id', 'acf-image-edit-' + itemid + ''); //update item id on edit button
                $newlastitem.find('.acf-image-remove').attr('id', 'acf-image-remove-' + itemid + ''); //update item id on remove button
                $newlastitem.attr('data-item-id-id', '' + itemid + ''); //update item id on remove button
                $newlastitem.find('.input-id').attr('value', '' + itemid + ''); //update item id on remove button
                $newlastitem.find('.image-ui').attr('id', 'acf-post-object-' + itemid + '');//update id on acf ui (postobject) field

                // $thisUi.css("background","yellow");

                var $thisUiId = $thisUi.attr('id'),
                    $originalimage = $newlastitem.find('img:not(.place-holder)');

                    //  console.log("$thisUiId" +$thisUiId+"");

                      // change this based on abovecode of init item

                      $('#'+$thisUiId+'')
                        .iconselectmenu({
                          appendTo:$thisUiAppend,
                          // maxHeight:300, -- set via css atm
                          width: 'auto',
                          style: 'dropdown',
                          change: function( event, ui ) { 
                              // console.log("change" +ui+"");
                              // $(ui.item.element).css("background","red");
                            var thisimage = $(ui.item.element).attr("data-segment-image");
                            var imagetype = $(ui.item.element).attr("data-segment-type");

                            // console.log("thisimage" +thisimage+"");
                            $originalimage.attr("src",thisimage);//replace image 
                            $originalimage.attr("data-segment-type", imagetype);
                            // console.log("imagetype = "+imagetype+"");

                            updateImageObject($thisitem, imagetype)
                  
                        
                            // Canvas has Changed as soon as items are changed
                            canvasChange();    

                          }, //change functions
                          //change  
                          select: function( event, ui ) {
                              // $(ui).selectmenu( "close" ); // close
                                // console.log("close this grid-item-options-toggle");
                                $newlastitem.find('.grid-item-options-toggle').click();//trigger click
                              }//select
                        })
                        .iconselectmenu("menuWidget")
                        .addClass("ui-menu-icons avatar");

                        
                      //end change this based on abovecode of init iitems

                makedraggable($(clone), $grid); // allow item to become draggabel
                // imageEdit(itemid, $grid); // allow edit on image
                imageEdit(itemid);
                imageRemove(itemid); // allow delete of image
                itemEdit($(clone), $grid); // allow edit on other fields of cloned item

                // and would update coordinates here aswell

                // to do: ensure this is taregetting the right grid:
                $grid.packery('appended', $(clone));
 
                var positions = $thisgrid.packery('getShiftPositions', 'data-item-id'),
                  jsonpositions = JSON.stringify(positions);
 
                $coordinates.val(jsonpositions);
                verifyItemsRepeater($closestrepeater); // verify items

                //update coordinates
                localStorage.setItem("coordinates",  jsonpositions);
                //update html for local storage
                var gridContent = document.getElementById("tester-grid-id").innerHTML;//
                localStorage.setItem("gridContent",gridContent);
                // console.log("gridContent" +gridContent+"");

                // review this UX behaviour:
                $(clone).addClass("item-added"); //make clear which item has been added

                $('html, body').animate({
                  scrollTop: $(clone).offset().top
                }, 200);

                setTimeout(function () {

                  $(clone).removeClass("item-added"); // remove active signifying class after a while

                }, 600);

 
                return false;
              });

              $(document).on('click', '.repeater .remove-row', function () {
                // console.log("remove-row click");

                var item = $('.repeater > .repeater-item');

                if (item.length == 1) {

                  item.find('input').val(''); // this means I can't delete the last - is this required?

                } else {

                  var $closest = $(this).closest('.repeater-item'),
                    $closestrepeater = $(this).closest('.repeater'),
                    $coordinates = $grid.closest('.grid-layer').find('.coordinates');

                  // TODO ensure we are targetting the correct $grid item here:

                  $grid.packery('remove', $closest).packery('shiftLayout');

                  var positions = $grid.packery('getShiftPositions', 'data-item-id'),
                    jsonpositions = JSON.stringify(positions);

                    localStorage.setItem("coordinates",  jsonpositions);

                  // console.log("posititions = " + jsonpositions + "");

                  // TODO ensure we are updating the correct grid coordinates here:
                  // $('#coordinates').val(jsonpositions);
                  $coordinates.val(jsonpositions);


                  // consider onldy doing this if we are not logged in
                      //update html for local storage
                  var gridContent = document.getElementById("tester-grid-id").innerHTML;//
                  localStorage.setItem("gridContent",gridContent);
                  console.log("gridContent" +gridContent+"");
    
                  //  verifyItemsRepeater();
                  verifyItemsRepeater($closestrepeater);

                }
                // verifyItemsRepeater();
              // AOS.refreshHard(); //review


                return false;
              });

            }//if (isGridItemsActive === false) 

            // console.log("before packery init initPositions " +initPositions+"");
            // init layout with saved positions
            if ($('body').hasClass('logged-in')) {

                $grid.packery('initShiftLayout', initPositions, 'data-item-id');
                // console.log("storedcoordinates" +initPositions+"");

            
              }else{ //not logged in

                // console.log("not logged in here ");
                // var storedcoordinates = JSON.parse(localStorage.getItem('coordinates'));
                var storedcoordinates = localStorage.getItem('coordinates');

               if (storedcoordinates  == null){
                //if coordinates cleared or not existed; use orginal ones
                 var storedcoordinates = initPositions;

                 console.log("initPositins" +initPositions+"");
               }

                console.log("storedcoordinates - in local storage:" +storedcoordinates+"");
                $grid.packery('initShiftLayout', storedcoordinates, 'data-item-id');

                
            }//if ($('body').hasClass('logged-in'))

            if ($('body').hasClass('logged-in')) {
              // console.log("logged in");
              // make draggable
              $grid.find('.layout-grid-item').each(function (i, itemElem) {
                var draggie = new Draggabilly(itemElem);
                $grid.packery('bindDraggabillyEvents', draggie);
                // console.log("make draggable")
              });

              // save drag positions on event
              $grid.on('dragItemPositioned', function () {
               console.log("$grid.on( 'dragItemPositioned - logged in'");
                // console.log("positions" +positions+ "");

                // save drag positions
                var positions = $grid.packery('getShiftPositions', 'data-item-id');
                // from local storage:
                // localStorage.setItem( 'dragPositions', JSON.stringify( positions ) );

                var jsonpositions = JSON.stringify(positions);
                //console.log("posititions = "+jsonpositions+"");
                // console.log("posititions = " + JSON.stringify(positions) + "");

                // updat the text area value
                $coordinates.val(jsonpositions);
                $coordinates.attr('value', jsonpositions);

                // canvashasChanged
                canvasChange();    

                      
                if ($('.item-edit-active').length){
                  // console.log("close menu if it exists:");           
                   $('.item-edit-active').find('.grid-item-options-toggle').click();//trigger click
                }
               
                //END review this _ its positions + also suggest placing into one fucntion so we can use it in other places aswell
 
                // localStorage.setItem("coordinates",  jsonpositions);

                //  TODO - update this for unique gird
                // $('.coordinates').val(jsonpositions);
                // $('.coordinates').attr('value', jsonpositions);

              }); // $grid.on('dragItemPositioned', function ()

            } else { //if ($(body).hasClass('logged-in')){

              console.log("not logged in");

              $grid.find('.layout-grid-item').each(function (i, itemElem) {
                var draggie = new Draggabilly(itemElem);
                $grid.packery('bindDraggabillyEvents', draggie);
                // console.log("make draggable")
              });

              // save drag positions on event
              $grid.on('dragItemPositioned', function () {
               console.log("dragItemPositioned - not logged in");
                  //ensure not overflow + but trigger this before we then save the coordinates etc
                  console.log("positions" +positions+ "");

                 $grid.packery('layout').trigger('layoutComplete');

                // save drag positions
                var positions = $grid.packery('getShiftPositions', 'data-item-id');

            
                var jsonpositions = JSON.stringify(positions);
                //console.log("posititions = "+jsonpositions+"");
                // console.log("posititions = " + JSON.stringify(positions) + "");

             
                // updat the text area value
                $coordinates.val(jsonpositions);
                $coordinates.attr('value', jsonpositions);

                localStorage.setItem("coordinates",  jsonpositions);
               // canvashasChanged
                  canvasChange();  
             
                  if ($('.item-edit-active').length){
                    // console.log("close menu if it exists:");           
                     $('.item-edit-active').find('.grid-item-options-toggle').click();//trigger click
                  }

                   // $('body').trigger('resize');  // trying to solve overflow issues
                      /* delete this
                  var newwidth = $(window).width();
                  var newheight = $(window).height();

                  console.log("newheight " +newheight +"");
                  
                  window.resizeTo(newwidth, newheight) */
              
              }); // $grid.on('dragItemPositioned', function ()

            } //if ($('body').hasClass('logged-in'))

            // Bind to scroll
            // $(window).scroll(function () {
            //   // consider removing some variable declartion from the fade function: and place elsewhere
            //   gridfade(); // run fade function on scroll
            // }); // scroll function

            if ($('body').hasClass("is-touch")) {

                console.log("ensure to have touch screen message enabled")
              // $(window).scroll(function () {

                // activeTouchItem();
                // ActiveTouchItem();//
                // if we have a touch device + before breakpoint - body is-touch we
                // TO DO; add "hover state" style

                //ebd if touch

              // }); // scroll function

            } //if ($('body').hasClass("is-touch")

          // $(window).scrollTop($(window).scrollTop() + 1);
          //trigger initial scroll to ensure all object are layed out (includign thenegative offests)
          /// far too much shite in this function - tidy up

          isPackeryInit = true;
          // if edit mode was alredy active
          console.log(isEditModeActive+ "isEditModeActive");

          if (isEditModeActive === true){
            //reopen edit mode
            console.log(isEditModeActive);

            $('body').addClass('dev-layout-grid-on')
            //scroll to the top of the grid
          
          }// if (isEditModeActive === true)

          setTimeout(function () {
            // console.log("trigger layoutComplete");     
            $grid.packery('layout').trigger('layoutComplete'); // this works - but lets ensure its on the correct place
  
          }, 100);

        } else if (breakpointName === '"default"' && isPackeryInit) {
          // disable packery if default and already intialized

          $grid.packery('destroy');
          // AOS.refreshHard(); //review
          isPackeryInit = false;
         
          console.log( "Hello breakpoint - mobile?");

          // edit mode - close it - but set variable to true to re-open on 
          if ($('body').hasClass("dev-layout-grid-on")) {
            isEditModeActive = true;
            $('body').removeClass('dev-layout-grid-on')
          }else{
            //not active
            isEditModeActive = false;
          }

        } else{
          // AOS.refreshHard(); //review
          // console.log( "AOS.refreshHard(); - mobile?");
        }
          
      } //  function checkPackery()

      checkPackery();
      // AOS.init();

      // check this on resize, debounced
      $(window).on('resize', debounce(checkPackery, 200));

    }); //var $grid = $thisgrid.imagesLoaded(function()

  } // function initiatepackery()

  $('input[name="submission_name"]').on('change', function () {

    submissionname = $('input[name="submission_name"]').val();

  var posttitle = submissionname;

    $('input[name="post_title"]').val(""+posttitle+"");
    // $('input[name="submission_name"]').val(""+submissionname+"");

    console.log("submissionname =" +submissionname+"");
    console.log("posttitle =" +posttitle+"");

  });

  $("#load-image").on('click', function () {
    //load image before download possible
    console.log("load-image click");
    captureCanvas();
    // $('input[name="submission_name"]').css("background","red");
    // var submissionname = $('input[data-input-type]').val();
  //  var submissionname = $('input[name="submission_name"]').val();//.attr('data-input-type');

    // console.log("submissionname on load =" +submissionname+"");

    //once this is done, we''l be able t download and also submit submission
    //takes fucking ages to load; how to resolve; could the data
  });
  
  $("#download-image").on('click', function () {
   // Now browser starts downloading it instead of just showing it

    // console.log("hello dowload click - ensure to update the picture name is submiossion title exists");
  
    var imgageData = getCanvas.toDataURL("image/png");
        // submissionname = $('input[data-input-type]').val();
   
        console.log("submissionname on download =" +submissionname+"");
    //  console.log("name" +submissionname +'');

    // TO DO figure out isues with space on not a problem is reality?

    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    // $("#download-image").attr("download", "your_pic_name.png").attr("href", newData);
    $("#download-image").attr("download", ""+ submissionname +"'s Freeling Street.png").attr("href", newData);

  });


  $(".dev-layout-grid-toggle").click(function () {

    if ($('body').hasClass("dev-layout-grid-on")) {

      $('body').removeClass('dev-layout-grid-on');
      $("#size-wrap").removeClass('grid-container');

    } else {

      $('body').addClass('dev-layout-grid-on');
      $("#size-wrap").addClass('grid-container');

      console.log("scrolling to the top of grid")
    
      $('html, body').animate({
        scrollTop: $('.grid-layer').offset().top - 0 // top of grid            
       }, 'slow');


    } //click

  }); //  $(".dev-toggle").click(function ( )
  // dev toggle - TO DO - move this elsewhere

  //initial innit

  // ensure to target each grid that might exist on teh page
  function initgriditems() {

    $('.grid').each(function () {

      $thisgrid = $(this);

       /*


    You can use document.getElementById("myID").innerHTML, like this:

    var = tabelaContent; 

    tabelaContent = document.getElementById("tabela").innerHTML
    localStorage.setItem("tabelaContent",tabelaContent);
    
    */

    if ($("body").hasClass("logged-in")){
      //if logged in don't use local storage
      
      verifyItemsRepeater($thisgrid); // initial - move to better place - or inside an init function of sorts
      initiatepackery($thisgrid);


    } else {

      // if not logged in we look if local storage has saved.
      // if not use the what's and save the og content as a variable?
      // there and save it to the local storage
      //

      if (localStorage.getItem("gridContent") === null) {

        // console.log("each grid");
        //   gridid = number;
        //   console.log("number"+number+++"";)
  
        verifyItemsRepeater($thisgrid); // initial - move to better place - or inside an init function of sorts
        initiatepackery($thisgrid);
        var OgGridContent = document.getElementById("tester-grid-id").innerHTML;
        var gridContent = document.getElementById("tester-grid-id").innerHTML;//
        localStorage.setItem("gridContent",gridContent);
        console.log("gridContent" +gridContent+"");

      } else {
        var OgGridContent = document.getElementById("tester-grid-id").innerHTML;
        var gridContent = localStorage.getItem("gridContent");

        // console.log("HAS local storage gridContent" +gridContent+"");

      // gridContent.innerHTML = '<pre>' + localStorage.getItem('gridContent') + '</pre>';

      
              // localStorage.setItem("coordinates",  jsonpositions);
        $("#tester-grid-id").empty();

        $("#tester-grid-id").append(gridContent);
            // I should look into what is being appended here; and remove the aditional/existing Iconwidget DOM stuff  
        $("#tester-grid-id").find('.ui-selectmenu-button').remove(); 
        $("#tester-grid-id").find('.ui-selectmenu-menu.ui-front').remove(); 


            verifyItemsRepeater($thisgrid);
            //init function of sorts
            initiatepackery($thisgrid);
        
        
          // console.log("gridContent" +gridContent+"");
          // localStorage.setItem("gridContent",gridContent);

        $("#clear-local-storage").click(function () {

          console.log("clearing local storage");
          localStorage.removeItem('gridContent');
          localStorage.removeItem('coordinates');
       
          location.reload();

     /* I've tried to re-initate the whole packery stuff; but quite complimcated + gave uip
          $("#tester-grid-id").empty();
          $("#tester-grid-id").append(OgGridContent);



          $("#tester-grid-id").find('.ui-selectmenu-button').remove(); 
          $("#tester-grid-id").find('.ui-selectmenu-menu.ui-front').remove(); 

          // $thisUi = $thisitem.find('.image-ui'),
          // $thisUiAppend = $thisUi.parent('label'),
         // $("#tester-grid-id").css("background","red");
          
         var $thisgrid = $('#tester-grid-id');//#tester-grid-id .grid
         $thisgrid.css("background","red");
          verifyItemsRepeater($thisgrid); // initial - move to better place - or inside an init function of sorts
          initiatepackery($thisgrid);
    
          
          //need to change coordinates to orginals 

          // and also serve up the html;

          // I guess this means I have to store this data; i.e before "replacing it" - store it elsewhere?

          //  trigger relayout 
          // $thisgrid.packery('layout'); // don't layout on z-index, as it re-arranges existinglayout
     END I've tried to re-initate the whole packery stuff; but quite complimcated + gave uip

           */
      
         }); //  $(".dev-toggle").click(function ( )
      

      }//if (localStorage.getItem("gridContent") === null) 

    }// if ($("body").hasClass("logged-in"))
  
    
    });

  } //initgrid()

  initgriditems(); // start initial init
  hoverDiv($startbutton);//
  onSubmission();// even listner for attr change

} //export default function init()




export function canvasChange(){
  console.log("canvasChange()");

  // if we have generated an initial preview:
  if($("body").hasClass("submission-previewed")){
        //once an edit has been made to the canvas, we can allow update availability

        $("body").addClass("update-available");
        $("a#load-image").text("Update Preview Image");
       

  }/* else{
    console.log("change detected be non preview click yet;")

 }  */
 //if($("body").hasClass("submission-previewed")

}//CanvasChange()

export function removeClassByPrefix($this, prefix) {
  var regx = new RegExp('\\b' + prefix + '.*?\\b', 'g');
  $this.className = $this.className.replace(regx, '');
  return $this;
}

export function itemEdit($thisitem, $grid) {

  // console.log("itemedit");

  var $this = $thisitem,
    // $grid = $grid,
    $thisedittoggle = $thisitem.find('.grid-item-options-toggle').not(".grid-item-options-toggle-rotate"),
    $thisrotatetoggle = $thisitem.find('.grid-item-options-toggle-rotate'),

    //image:
    thisitemidvalue = $this.find('input.input-id').val(),

    thisitemwidthvalue = $this.find('input.input-width').val(),
    thisitemheightvalue = $this.find('input.input-height').val(),
    thisitemzindexvalue = $this.find('input.input-z-index').val(),
    applyrotate = $this.find('input.input-rotate').val() + "deg",

    applyxvalue = $this.find('input.input-image-position-x').val() + "%",
    applyyvalue = $this.find('input.input-image-position-y').val() + "%",
    applyscalevalue = $this.find('input.input-image-scale').val() / 100,
    $inputfields = $this.find('input');
    $postfield = $this.find('.post-object select');

  $thisedittoggle.click(function () {
    console.log("click; activate edit item");

    if ($this.hasClass("item-edit-active")) {

      $this.removeClass("item-edit-active");
      $('body').removeClass("edit-active");

    } else {

      //remove other active items:
      $('.layout-grid-item.repeater-item').removeClass("item-edit-active");
      //add active
      $this.addClass("item-edit-active");
      $('body').addClass("edit-active");
      // $this.find('.image-ui').css("background","red");
      // $postfield.selectmenu( "open" );// doesnt work because not initiated yet?
      $this.find('.ui-button').click(); // the post object select field; ensure its open
    }

  }); // $this.click

  $thisrotatetoggle.click(function () {
    // console.log("click; rotate clicking");

    var $thisrotate = $this.find('input.input-rotate'),
        thisrotatevalue = Number($thisrotate.val());
        
    // console.log("thisrotate" +$thisrotate +"");
    // console.log("thisrotatevalue" +thisrotatevalue +"");

    if (thisrotatevalue == 270){

     var thisnewrotatevalue = 0;

     } else {
       
      var thisnewrotatevalue = Number(thisrotatevalue + 90);
    }
    $thisrotate.val(thisnewrotatevalue);

    console.log("thisnewrotatevalue" +thisnewrotatevalue +"");
    $this.find(".inner-grid-item").css("transform", "rotate(" + thisnewrotatevalue + "deg)"); // to do - ensure cross browser
    $this.find('.grid-item-options-toggle-rotate .rotate').css("transform", "rotate(" + thisnewrotatevalue + "deg)");
    $this.find('input.input-rotate').val(thisnewrotatevalue);
 
    //update local storage:
    var gridContent = document.getElementById("tester-grid-id").innerHTML;//
    localStorage.setItem("gridContent",gridContent);

    // Canvas has Changed as soon as items are rotated
    canvasChange(); 

  }); // $this.click


  /*$postfield.css("background","red");
  $postfield.on('selectmenuchange', function() {
   console.log("$postfield");

  });
  */

  $inputfields.on('input', function () {

    // console.log("$inputfields changed")

    var $thisfield = $(this),
      newvalue = $thisfield.val(),
      thisfieldtype = $thisfield.attr('data-input-type'); // should get

    // console.log("thisfield type= "+thisfieldtype);


    if (thisfieldtype == "image_rotate") {

  console.log("rotate input on pinput change");


      applyrotatevalue = newvalue + "deg";
      // $this.find(".inner-grid-item").css("left", applyvalue);
      // $this.find(".inner-grid-item").css("transform", "translateX("+applyzvalue+")"); // to do - ensure cross browser

      $thisfield.attr("value", newvalue);
      console.log("newvalue" +newvalue+"")

      // console.log("applyvalue x position" +applyxvalue+"")

      $this.find(".inner-grid-item").css("transform", "rotate(" + applyrotatevalue + ")"); // to do - ensure cross browser

    }else if (thisfieldtype == "input-id") {

      // console.log("id field change" + newvalue + "")
      //newvalue

    } else if (thisfieldtype == "input-width") {
      
      var thisclass = "grid-item-width", // this prefix of class
        newclass = "grid-item-width-" + (newvalue / 25) + "", // divide by four

        classes = $this.attr('class').split(" ").filter(function (c) {

          return c.lastIndexOf(thisclass, 0) !== 0;

        });

      $this.attr('class', classes.join(" ").trim());
      $this.addClass(newclass);
      $grid.packery('layout');

      var thisimagewidth, // declare - but don't assign value yet
        thisimageheight; // declare - but don't assign value yet

      gridImageOrientation($thisitem, thisimagewidth, thisimageheight); // assign image orientation classes

    } else if (thisfieldtype == "input-height") {

      var thisclass = "grid-item-height", // this prefix of class
        newclass = "grid-item-height-" + (newvalue / 25) + "",
        classes = $this.attr('class').split(" ").filter(function (c) {
          return c.lastIndexOf(thisclass, 0) !== 0;
        });

      $this.attr('class', classes.join(" ").trim());
      $this.addClass(newclass);
      $grid.packery('layout');

      var thisimagewidth, // declare - but don't assign value yet
        thisimageheight; // declare - but don't assign value yet
      gridImageOrientation($thisitem, thisimagewidth, thisimageheight); // assign image orientation classes

    } else if (thisfieldtype == "input-z-index") {

      var thisclass = "item-z-index", // this prefix of class
        newclass = "item-z-index-" + newvalue + "",
        classes = $this.attr('class').split(" ").filter(function (c) {
          return c.lastIndexOf(thisclass, 0) !== 0;
        });

      $this.attr('class', classes.join(" ").trim());
      $this.addClass(newclass);
      //$grid.packery('layout'); // don't layout on z-index, as it re-arranges existinglayout

    } else if (thisfieldtype == "input-image-position-x") {

      applyxvalue = newvalue + "%";
      // $this.find(".inner-grid-item").css("left", applyvalue);
      // $this.find(".inner-grid-item").css("transform", "translateX("+applyzvalue+")"); // to do - ensure cross browser

      $thisfield.attr("value", newvalue);
      // console.log("newvalue" +newvalue+"")

      // console.log("applyvalue x position" +applyxvalue+"")

      $this.find(".inner-grid-item").css("transform", "translateX(" + applyxvalue + ") translateY(" + applyyvalue + ")"); // to do - ensure cross browser

    } else if (thisfieldtype == "input-image-position-y") {

      applyyvalue = newvalue + "%";

      // console.log("applyvalue y position" +applyyvalue+"");

      $thisfield.attr("value", newvalue);
      $this.find(".inner-grid-item").css("transform", "translateX(" + applyxvalue + ") translateY(" + applyyvalue + ")"); // to do - ensure cross browser
      // console.log("scale value from insdie the input y " +applyscalevalue+"");
      // console.log("x value value from inside the input y " +applyxvalue+"");
      // console.log("applyyvalue from inside the input y " +applyyvalue +"");

      // $this.find(".inner-grid-item").css("transform", "translateY("+applyyvalue+")"); // to do - ensure cross browser

    } else if (thisfieldtype == "input-image-scale") {

      applyscalevalue = (newvalue / 100); // value: 1 - 200. So divided by 100

      // console.log("applyvalue scale" +applyscalevalue+"");

      $thisfield.attr("value", newvalue);

      $this.find(".inner-grid-item .image-wrap img").css("transform", "scale(" + applyscalevalue + ")"); // to do - ensure cross browser

    };

  }); //$inputfields.change(function()

   //update local storage:
   var gridContent = document.getElementById("tester-grid-id").innerHTML;//
   localStorage.setItem("gridContent",gridContent);

} // function itemedit(itemid){ // for new items

//not using this function I don't think
// export function imageEdit(itemid, $grid) { // for new items
export function imageEdit(itemid) { // for new items

  console.log("imageedit function itemid" + itemid + "");
  // error:

  //app.min.js:3 Uncaught ReferenceError: mediaImage is not defined

  /* how to replicate:

  Click "Add Row"
  Open item's options
  Click "Replace Image"

  This error only occurs if we haven't opened the media window previously
  Suggesting that maybe the  "mediaImage" isn't known after adding item

  wp.media variable declared as expeectd
  so maybe need do "redeclare" mediaImage ? or diff variable

  I'm 50% sure that this wasn't an issue before - i.e not qutie sure
  */

  var $thisimagethumb = $(`#acf-image-edit-${itemid}`);

  console.log("$thisimagethumb" + $thisimagethumb + "");

  $thisimagethumb.click(function () {

    var $this = $(this),
      thisimagethumbid = $this.attr("id"),
      thisitemid = $this.closest(".layout-grid-item").attr("data-item-id"),
      // $thisitem = $grid.closest(`.layout-grid-item[data-item-id=${thisitemid}]`),
      $thisitem = $(`.layout-grid-item[data-item-id=${thisitemid}]`),
      // this probably means we have more than one item per page on /projects
      // look to ensure I can target - Or just don't allow edit on /projects page?

      $thisimage = $thisitem.find(".acf-image"),
      mediaImage; // declared this to ensure new items can use the media library


 

    if (!$.isFunction(wp.media)) {
      console.log("! $.isFunction( wp.media )");
      return;
    }


    if (mediaImage) { // (mediaImage returns undefined on new items; why?

      console.log("mediaImage");
      mediaImage.open();
      return;

    }

    mediaImage = wp.media({
      library: {
        type: 'image'
      },
      multiple: false
    });

    mediaImage.on('select', function () {

      console.log("mediaImage.on( 'select', function()");
      // console.log("$thisimage"+ $thisimage+"");

      //var $thisitem = $thisitem;
      var image = mediaImage.state().get('selection').first().toJSON();

      $('.media-modal-close').trigger('click');
      var $thisitem = $thisimage.closest(".layout-grid-item"),
        thisimagewidth = image.width,
        thisimageheight = image.height,
        thisimageurl = image.url; //$(this).find('img:not(.place-holder)').attr("src"),


      $thisimage.val(image.id); // thi sis the input field

      // console.log("image.id"+image.id+"");
      // console.log("image.url"+image.url+"");

      $thisitem.find('img').remove(); // remove existing images
      $thisitem.find('.image-wrap').append($('<img src="' + image.url + '"">'));
      $thisitem.find('.image-wrap').append($('<img class="place-holder" src="' + image.url + '"">'));

      gridImageOrientation($thisitem, thisimagewidth, thisimageheight); // calculate new ratio + assign classes

      convertImgToDataURLviaCanvas(thisimageurl, function (base64_data) {
        // console.log( base64_data );
        //  $thisplaceholder.attr("src",base64_data);
        $thisitem.find('img.place-holder').attr("src", base64_data);
        // $thisimage.insertAfter('<img src="'+base64_data+'"/>');
      });



      // scroll to the active item
      $('html, body').animate({

        scrollTop: $thisitem.offset().top
      }, 200);
      // console.log("scrolling");


    }); //mediaImage.on( 'select', function() {


    mediaImage.open();

    return false;
  });


} // function imageEdit($imagethumb)


export function imageRemove(itemid) { // for new items

  // console.log("imageedelete function itemid" + itemid + "");

  var $thisimagedelete = $(`#acf-image-remove-${itemid}`);

  $thisimagedelete.click(function () {

    var $this = $(this),
      // thisimagethumbid = $this.attr("id"),
      thisitemid = $this.closest(".layout-grid-item").attr("data-item-id"),
      $thisitem = $(`.layout-grid-item[data-item-id=${thisitemid}]`);
    //  $thisimage = $thisitem.find(".acf-image");
    // console.log(" thisitemid deleting" + thisitemid+"");
    $thisitem.find('img').remove(); // remove existing images
    // need to remove from input value aswell:

    $thisitem.find('input.acf-image').val(""); //update to empyt value

    return false;
  });


} // function imageRemove($imagethumb)


export function convertImgToDataURLviaCanvas(url, callback) {
  let img = new Image();

  img.crossOrigin = 'Anonymous';

  img.onload = function () {
    let canvas = document.createElement('CANVAS');
    let ctx = canvas.getContext('2d');
    let dataURL;
    canvas.height = this.height;
    canvas.width = this.width;
    // ctx.drawImage(this, 0, 0);
    //   ctx.fillStyle = "#09f";
    ctx.fillStyle = "#000"; // in theory we could now specify colour overlay choice aswll
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    dataURL = canvas.toDataURL();
    callback(dataURL);
    canvas = null;
  };

  img.src = url;
}

export function updateImageObject($thisitem, imagetype){

//export function updateImageObject($newlastitem, ){
//  console.log("updateImageObject:")
// console.log(imagetype);

 
  var zIndexClass = $thisitem.attr('class').split(' ');

  for (var i = 0; i < zIndexClass.length; i++) {
      if (zIndexClass[i].indexOf('item-z-index') != -1) {
        $thisitem.removeClass(zIndexClass[i]);
      }
  }
 

  if (imagetype == 'tree') {
  //find the z-index and change it

  // console.log("updating tree z-ndex");

    $thisitem.attr("data-item-z-index","2");
    $thisitem.find("[data-input-type='input-z-index']").val("2");
    $thisitem.addClass("item-z-index-2");

  } else if (imagetype == 'normal'){

    $thisitem.attr("data-item-z-index","1");
    $thisitem.find("[data-input-type='input-z-index']").val("1");
    $thisitem.addClass("item-z-index-1");
  //  console.log("updatingnormal z-ndex");

  }




}//export function updateImageObject()


/* to do - delete the following stuff */

/*
Considerations:
if more items are added or removed after the local files is saved, the layout will break - so ensure that I clear / reset /rewrite the files
or change the variable name (with the associated arrangment data) everything the admin changes the layout

  /*   localStorage.setItem(
  this will require cookies + consent tools accordingly I  think*/

/* use this if I don't use the above
    // make all grid-items draggable
    $grid.find('.layout-grid-item').each( function( i, gridItem ) {
      var draggie = new Draggabilly( gridItem );
      // bind drag events to Packery
      $grid.packery( 'bindDraggabillyEvents', draggie );
    });

    $grid.on( 'layoutComplete',
            function( event, laidOutItems ) {

      console.log( 'Packery layout completed on ' +     laidOutItems.length + ' items' );
      gridfade();
    }
            );

  REST API + JSON Storage:
  https://stackoverflow.com/questions/43787499/wordpress-rest-api-write-to-json-file

  Upload file using JSON:
  https://gist.github.com/ahmadawais/0ccb8a32ea795ffac4adfae84797c19a



loading and saving a json file using javascript and the wordpress Rest Api:
https://www.google.com/search?q=loadind+and+saving+a+json+file+using+javascript+and+the+wordpress+Rest+Api&rlz=1C5CHFA_enGB789GB794&oq=loadind+and+saving+a+json+file+using+javascript+and+the+wordpress+Rest+Api&aqs=chrome..69i57.19392j0j7&sourceid=chrome&ie=UTF-8
finding it hard to find easy digestiable code expamples

https://www.sitepoint.com/wordpress-json-rest-api/

Last answer seems to be viable route to explore - but still using PHP; not sure if best approach?
https://stackoverflow.com/questions/39565706/post-request-with-fetch-api


Tutorial that shows a bit of JS: POST + json files.
https://medium.com/@omobolanlearogundade/creating-a-simple-web-app-using-wordpress-rest-api-with-javascript-ab4e3bfa4898



VArious
 :
 https://stackoverflow.com/questions/43328595/access-a-local-json-file-in-wordpress-theme
https://www.toptal.com/wordpress/beginners-guide-wordpress-rest-api
https://wordpress.stackexchange.com/questions/348231/how-do-i-correctly-setup-an-ajax-nonce-for-wordpress-rest-api
https://deliciousbrains.com/wp-rest-api-customizing-endpoints-adding-new-ones/


30th APRIL:

"save json data to custom field acf wordpress rest api javascript"
https://www.google.com/search?q=save+json+data+to+custom+field+acf+wordpress+rest+api+javascript:

- https://www.22nds.com/acf-repeater-field-javascript/
This interesting but quite an old article:

The plugin still relative though I think:
https://github.com/airesvsg/acf-to-rest-api

Examples of its use:
http://airesgoncalves.com.br/acf-to-rest-api/


Because this is a completely new approach for me, I figured I should achieve it in simple step:

i.e  as follow

- First try and load and save an ACF field using the REST API (+ Maybe using that 'ACF to REST plugin') using JS
-
Continue on this:
https://github.com/airesvsg/acf-to-rest-api

*/



export function gridImageOrientation($thisitem, thisimagewidth, thisimageheight) {

  // console.log("gridimageorientation" + $thisitem + "");

  //item:
  var $this = $thisitem,
    thiswidth = $this.width(),
    thisheight = $this.height(),
    thiswidthtoheightratio = (thiswidth / thisheight),
    //image:
    $thisimage = $this.find('img'),
    thisimagewidth = thisimagewidth;
  //   thisimageheight =  thisimageheight;
  //  console.log("this thisimagewidth"+thisimagewidth+"");

  if (thisimagewidth == undefined) {

    //  console.log("if undefined: thisimagewidth"+thisimagewidth+"");
    var thisimagewidth = $thisimage.width(),
      thisimageheight = $thisimage.height();

  } else {

    // console.log("ELSE this thisimagewidth"+thisimagewidth+"");


    var thisimagewidth = thisimagewidth,
      thisimageheight = thisimageheight;
    //  thisimagewidthtoheightratio = (thisimagewidth / thisimageheight);§

  };

  var thisimagewidthtoheightratio = (thisimagewidth / thisimageheight);


  // console.log("thiswidth = "+thiswidth+"");
  // console.log("thisheight = "+thisheight+"");
  // console.log("thisimagewidth = "+thisimagewidth+"");
  // console.log("thisimageheight = "+thisimageheight+"");

  $this.attr("item-ratio", ""); // remove existing value
  $thisimage.attr("itemimage-ratio", ""); // remove existing value
  // set new value
  $this.attr("item-ratio", thiswidthtoheightratio);
  $thisimage.attr("itemimage-ratio", thisimagewidthtoheightratio);

  // ensure any existing classes are removed fromt this item & image classes, as it might be duplicate
  $this.removeClass("square-item image-larger-than-item vertical-item horizontal-item ratio-equal image-larger-than-item");
  $thisimage.removeClass("square-image vertical-image horizontal-image");


  if (thiswidth == thisheight) {
    //width equals height = square item

    $this.addClass("square-item");

    if (thiswidthtoheightratio == thisimagewidthtoheightratio) {
      // console.log("ratio equal")

    } else if (thiswidthtoheightratio > thisimagewidthtoheightratio) {
      //the image is larger than th container it fits within:

      $this.addClass("image-larger-than-item");

    } else if (thiswidthtoheightratio > thisimagewidthtoheightratio) {} //height ratio

  } else if (thiswidth < thisheight) {

    //width smaller than height = vertical item
    $this.addClass("vertical-item");

  } else if (thiswidth > thisheight) {
    //width larger than height = horizontal item

    $this.addClass("horizontal-item");
    // console.log("thiswidthtoheightratio"+thiswidthtoheightratio+"")

    //console.log("thisimagewidthtoheightratio"+thisimagewidthtoheightratio+"")
    if (thiswidthtoheightratio == thisimagewidthtoheightratio) {
      // console.log("ratio equal")
    } else if (thiswidthtoheightratio > thisimagewidthtoheightratio) {
      //the image is larger than th container it fits within:

      $this.addClass("image-larger-than-item");

    } else if (thiswidthtoheightratio > thisimagewidthtoheightratio) {

    } //height ratio

  } //itemratio

  /*
  I want to add the classes
      - if the item is horizontal or vertical shaped
      - if the image is horizonal or vertical shaped
      - based on adding these classes I should be able to set the correct image classes for width and height
  */

  if (thisimagewidth == thisimageheight) {
    $thisimage.addClass("square-image");
  } else if (thisimagewidth < thisimageheight) {
    $thisimage.addClass("vertical-image");
  } else if (thisimagewidth > thisimageheight) {
    $thisimage.addClass("horizontal-image");
  } ///image width vs height ratio


} //  function gridimageorientation($thisitem)


export function gridfade() {
  // review this function

  var animation_height = $(window).innerHeight() * 0.25; //0.25; //0.25;// was 0.25
  var ratio = Math.round((1 / animation_height) * 100) / 10; //ratio

  $('.grid-fade-item').each(function () { // might need to review this


    var objectTop = $(this).offset().top,
      windowBottom = $(window).scrollTop() + ($(window).innerHeight() * 1), //was  *0.8),

      itemratio = $(this).attr("item-ratio"),
      itemheight = $(this).height(),
      imageratio = $(this).find("img").attr("itemimage-ratio"),
      appliedratio = ratio * imageratio;

    if (objectTop < windowBottom) {

      //console.log("if ( objectTop < windowBottom )")
      $(this).find("span.item-status").html('becoming visible');
      //TODO - set up this fading using matrix transform?
      //http://danielblom.com/stills/hilux/
      // this is not true the item is not fully visible yet:
      // if (objectTop < windowBottom - animation_height) {
      if (objectTop < windowBottom - (itemheight / 2)) {

        $(this).find("span.item-status").html('item no half visble after leaving the bottom');
        $(this).addClass('fade-in');

      } else if (objectTop < windowBottom - itemheight) {

        $(this).find("span.item-status").html('item fully visble after leaving the bottom');


        //$(this).find("img").css("padding-top",0);
        /*  $(this).css( {
                    transition: 'opacity 0.1s linear',
                    opacity: 1
                } );*/
        // console.log("hello fade into 1");
        // $(this).addClass('')
        // $(this).find(".image-wrap").css("margin-top", (-((windowBottom - objectTop) * (appliedratio))));
        // $(this).addClass('fade-in');

      } else {
        // $(this).addClass('fade-in');


        // console.log("the item is slowly being revealed from the bottom");
        $(this).find("span.item-status").html('the items is slowly being revealed from the bottom');
        // as soon as it is fully revealed is jumps to a a negative value in one go - say: -25px_
        // in need to ensure that the value goes from 0 to this value udring this stage of scollring
        // $(this).find("img").css("padding-top",((windowBottom - objectTop) * ratio));
        // $(this).find("img").css("margin-top","0");
        // $(this).find("image-wrap").css("margin-top", (-((windowBottom - objectTop) * (appliedratio))));

        /* $(this).css( {
                    transition: 'opacity 0.25s linear', // look to apply further ccs transitions?
                    opacity: (windowBottom - objectTop) * ratio
                } );*/
      }

    } else { //else if ( objectTop < windowBottom )
      // console.log("else so not fading into 1");

      $(this).find("span.item-status").html('not visible');
      // $(this).find("img").css("margin-top","0");
      $(this).removeClass('fade-in');
      // $(this).css( 'opacity', 0.1 );
    }

  }); //  $('.th-block').each(function()


  if ($(window).scrollTop() + $(window).height() == $(document).height()) {
    // if at the bottom of th page: ensure everything visbile
    // console.log("bottom of page")
    $('.grid-fade-item').css({
      transition: 'opacity 0.1s linear',
      opacity: 1
    });

  } //

} // function gridfade()

/*
export function initgriditems() {
  // ensure to target each grid that might exist on the page
  $('.grid').each(function () {

  console.log("each grid");
    $thisgrid = $(this);
    //   gridid = number;
    //   console.log("number"+number+++"";)

    verifyItemsRepeater($thisgrid); // initial - move to better place - or inside an init function of sorts
    initiatePackery($thisgrid);

    /*


You can use document.getElementById("myID").innerHTML, like this:

var = tabelaContent; 

tabelaContent = document.getElementById("tabela").innerHTML
localStorage.setItem("tabelaContent",tabelaContent);
 

var gridContent = document.getElementById("tester-grid-id").innerHTML;//
    console.log("gridContent" +gridContent+"");

    localStorage.setItem("gridContent",gridContent);

    localStorage.setItem("coordinates",  jsonpositions);

  });

} //initgrid()
*/