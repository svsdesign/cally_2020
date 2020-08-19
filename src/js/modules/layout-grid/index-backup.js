/*! svs - gridwork*/
/*

- look at ways of improving transitions/scaling of items:
  https://packery.metafizzy.co/extras.html#animating-item-size
  https://codepen.io/desandro/pen/jGJKL
    Aims: don't want to see any lags/ widening+narrowing spacing during screen resize

    // TODO isues: not working properly on Firefox? - issue wiht calculatig ratios:
    // look at order of renderibng + avaibilty of item(s) width and height measurments

*/

export default function init() {

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

    //  console.log("hello here"+positions+"");

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

 
    function gridimageorientation($thisitem, thisimagewidth, thisimageheight) {

      console.log("gridimageorientation" + $thisitem + "");

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


    function fade() {
      // review this function
      
      var animation_height = $(window).innerHeight() * 0.25; //0.25;// was 0.25
      var ratio = Math.round((1 / animation_height) * 100) / 10; //ratio

      $('.fade-item').each(function () { // might need to review this

        var objectTop = $(this).offset().top,
          windowBottom = $(window).scrollTop() + ($(window).innerHeight() * 1), //was  *0.8),

          itemratio = $(this).attr("item-ratio"),
          imageratio = $(this).find("img").attr("itemimage-ratio"),
          //console.log("itemratio" + itemratio+"");
          //console.log("imageratio" + imageratio+"")
          appliedratio = ratio * imageratio;
        //console.log("appliedratio" + appliedratio +"");

        if (objectTop < windowBottom) {

          //console.log("if ( objectTop < windowBottom )")
          $(this).find("span.item-status").html('becoming visible');

          if (objectTop < windowBottom - animation_height) {
            // console.log("item fully visble after leaving the bottom")
            $(this).find("span.item-status").html('item fully visble after leaving the bottom');

            //$(this).find("img").css("padding-top",0);
            /*  $(this).css( {
                        transition: 'opacity 0.1s linear',
                        opacity: 1
                    } );*/
            // console.log("hello fade into 1");
            $(this).find(".image-wrap").css("margin-top", (-((windowBottom - objectTop) * (appliedratio))));

          } else {


            // console.log("the item is slowly being revealed from the bottom");
            $(this).find("span.item-status").html('the items is slowly being revealed from the bottom');
            // as soon as it is fully revealed is jumps to a a negative value in one go - say: -25px_
            // in need to ensure that the value goes from 0 to this value udring this stage of scollring
            // $(this).find("img").css("padding-top",((windowBottom - objectTop) * ratio));
            // $(this).find("img").css("margin-top","0");
            $(this).find("image-wrap").css("margin-top", (-((windowBottom - objectTop) * (appliedratio))));

            /* $(this).css( {
                        transition: 'opacity 0.25s linear', // look to apply further ccs transitions?
                        opacity: (windowBottom - objectTop) * ratio
                    } );*/
          }

        } else { //else if ( objectTop < windowBottom )
          // console.log("else so not fading into 1");

          $(this).find("span.item-status").html('not visible');
          // $(this).find("img").css("margin-top","0");

          // $(this).css( 'opacity', 0.1 );
        }

      }); //  $('.th-block').each(function()


      if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        // if at the bottom of th page: ensure everything visbile
        // console.log("bottom of page")
        $('.fade-item').css({
          transition: 'opacity 0.1s linear',
          opacity: 1
        });

      } //

    } // function fade()


    //----------------------------------------
    // The magic
    //----------------------------------------

    $('form').submit(function (e) {
      e.preventDefault();
      var _this = $(this);
      var url = _this.attr('action');
      var method = _this.attr('method');
      var data = _this.serializeArray();
      var btn = _this.find('button[type="submit"]');
      var modal = $('#modalResponse');

      if ($('#ag_wysiwyg_editor').length && typeof tinyMCE !== 'undefined') {
        data.push({
          name: 'fields[ag_wysiwyg_editor]',
          value: tinyMCE.get('ag_wysiwyg_editor').getContent()
        });
      }

      // btn.prop( { 'disabled' : true } );

      $.ajax({
        url: url,
        method: method,
        beforeSend: function (xhr) {
          xhr.setRequestHeader('X-WP-Nonce', WP_settings.nonce);
        },
        data: data,
        dataType: 'json',
      }).always(function (data) {
        //   btn.removeProp( 'disabled' );
        modal.find('.modal-body').html('<pre>' + JSON.stringify(data, null, "\t") + '</pre>');
        modal.modal('show');
      });

      return false;
    });


    // move these variables elsewhere I reckon - near init

    var mediaImage, // becomes wp.media library
        $imagethumb = $('.acf-image-edit'),
        newitemid; // declare before use

    // consider moving this into one function
    // the run for each on intial load

    $imagethumb.click(function () {

      var $this = $(this),
        thisitemid = $this.closest(".grid-item").attr("data-item-id"),
        $thisitem = $(`.grid-item[data-item-id=${thisitemid}]`),
        $thisimage = $thisitem.find(".acf-image");

      //  console.log("thisitemid"+thisitemid+"");


      if (!$.isFunction(wp.media)) {
        //console.log("! $.isFunction( wp.media )");
        return;
      }


      if (mediaImage) {
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
        // after I've selected say item one (regardless of position; so could be any time) - replaced the image
        // then start replacing other images - its still replaces this intial item
        // console.log("mediaImage.on( 'select', function()");
        // console.log("$thisimage"+ $thisimage+"");

        //var $thisitem = $thisitem;
        var image = mediaImage.state().get('selection').first().toJSON(),
          $thisitem = $thisimage.closest(".grid-item"),
          thisimagewidth = image.width,
          thisimageheight = image.height;


        $('.media-modal-close').trigger('click');
        // $( '#acf-image' ).val( image.id );

        //  $thisimage.css("background","yellow"); // and its changing the correct input
        // console.log("image.id"+image.id+"");
        // console.log("image.id"+image.url+"");

        // console.log("image.id"+image.id+"");
        // console.log("image.url"+image.url+"");

        // console.log("image.width"+image.width+"");
        // console.log("image.height"+image.height+"");


        $thisimage.val(image.id); // set id value on input field
        $thisitem.find('img').remove(); // remove existing image
        $thisitem.find('.image-wrap').append($('<img src="' + image.url + '"">'));
        gridimageorientation($thisitem, thisimagewidth, thisimageheight); // calculate new ratio + assign classes

        // scroll to the active item
        $('html, body').animate({

          scrollTop: $thisitem.offset().top
        }, 200);
        // console.log("scrolling");


        // console.log("thisitemwidth"+thisitemwidth+"");

        // $thisitem.find('.image-wrap img').css("width","100%");
        // $thisitem.find('.image-wrap img').css("height","auto");

        // $thisitem.find('.image-wrap img').css("width",image.width);
        // $thisitem.find('.image-wrap img').css("height",image.height);

      }); //mediaImage.on( 'select', function()

      mediaImage.open();

      return false;

    }); //    $imagethumb.click( function()

    function imageremove(itemid) { // for new items

      // console.log("imageedelete function itemid" + itemid + "");

      var $thisimagedelete = $(`#acf-image-remove-${itemid}`);

      $thisimagedelete.click(function () {

        var $this = $(this),
          // thisimagethumbid = $this.attr("id"),
          thisitemid = $this.closest(".grid-item").attr("data-item-id"),
          $thisitem = $(`.grid-item[data-item-id=${thisitemid}]`);
        //  $thisimage = $thisitem.find(".acf-image");
        // console.log(" thisitemid deleting" + thisitemid+"");
        $thisitem.find('img').remove(); // remove existing image
        // need to remove from input value aswell:

        $thisitem.find('input.acf-image').val(""); //update to empyt value


        return false;
      });


    } // function imageremove($imagethumb)


    function imageedit(itemid) { // for new items

      // console.log("imageedit function itemid" +itemid+"");

      var $thisimagethumb = $(`#acf-image-edit-${itemid}`);

      $thisimagethumb.click(function () {

        var $this = $(this),
          thisimagethumbid = $this.attr("id"),
          thisitemid = $this.closest(".grid-item").attr("data-item-id"),
          $thisitem = $(`.grid-item[data-item-id=${thisitemid}]`),  
          $thisimage = $thisitem.find(".acf-image");


        // $thisitem.css("background","red");
        // console.log("! $.isFunction( wp.media )");
        //  console.log(".acf-image-edit click"+thisimagethumbid+"");
        // console.log("$thisd"+$this+"");
        // console.log("thisitemid"+thisitemid+"");


        if (!$.isFunction(wp.media)) {
          //console.log("! $.isFunction( wp.media )");
          return;
        }


        if (mediaImage) {
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

          // console.log("mediaImage.on( 'select', function()");
          // console.log("$thisimage"+ $thisimage+"");

          //var $thisitem = $thisitem;
          var image = mediaImage.state().get('selection').first().toJSON();

          $('.media-modal-close').trigger('click');
          var $thisitem = $thisimage.closest(".grid-item"),
            thisimagewidth = image.width,
            thisimageheight = image.height;

          $thisimage.val(image.id); // thi sis the input field

          // console.log("image.id"+image.id+"");
          // console.log("image.url"+image.url+"");


          $thisitem.find('img').remove(); // remove existing image
          $thisitem.find('.image-wrap').append($('<img src="' + image.url + '"">'));
          gridimageorientation($thisitem, thisimagewidth, thisimageheight); // calculate new ratio + assign classes

          // scroll to the active item
          $('html, body').animate({

            scrollTop: $thisitem.offset().top
          }, 200);
          console.log("scrolling");


        }); //mediaImage.on( 'select', function() {


        mediaImage.open();

        return false;
      });


    } // function imageedit($imagethumb)


    function removeClassByPrefix($this, prefix) {
      var regx = new RegExp('\\b' + prefix + '.*?\\b', 'g');
      $this.className = $this.className.replace(regx, '');
      return $this;
    }

    function itemedit($thisitem) { // for new items

      var $this = $thisitem,

        //image:
        thisitemidvalue = $this.find('input.input-id').val(),

        thisitemwidthvalue = $this.find('input.input-width').val(),
        thisitemheightvalue = $this.find('input.input-height').val(),
        thisitemzindexvalue = $this.find('input.input-z-index').val(),
        applyxvalue = $this.find('input.input-image-position-x').val()+ "%",
        applyyvalue = $this.find('input.input-image-position-y').val()+ "%",
        applyscalevalue  = $this.find('input.input-image-scale').val()/100,
        $inputfields = $this.find('input');

 
       // console.log("thisitemid" + thisitemidvalue + "");

      // console.log("thisitemwidthvalue"+thisitemwidthvalue+"");
      // console.log("thisitemheightvalue"+thisitemheightvalue+"");
      // console.log("thisitemzindexvalue"+thisitemzindexvalue+"");

     /* $inputfields.focus(function () {
        // review this - does it improved / hinder UX?
        $thisfield = $(this);

        // $('html, body').animate({
          // scrollTop: $thisfield.offset().top
        // }, 100);
       

      }); // on focus

      */

 

      $inputfields.on('input', function() {

        // console.log("$inputfields changed")

      var $thisfield = $(this),
          newvalue = $thisfield.val(),
          thisfieldtype = $thisfield.attr('data-input-type'); // should get

        // console.log("thisfield type= "+thisfieldtype);

        // TODO - @tom - I epext there's maybe a better way of writtin this js, using less lines + an "input item variable" of sorts?

        if (thisfieldtype == "input-id") {

          console.log("id field change" + newvalue + "")
          //newvalue

        } else if (thisfieldtype == "input-width") {

          var thisclass = "grid-item-width", // this prefix of class
              newclass = "grid-item-width-" + (newvalue/25) + "", // divide by four

              classes = $this.attr('class').split(" ").filter(function (c) {

              return c.lastIndexOf(thisclass, 0) !== 0;

               });

          $this.attr('class', classes.join(" ").trim());
          $this.addClass(newclass);
          $grid.packery('layout');

          var thisimagewidth, // declare - but don't assign value yet
              thisimageheight; // declare - but don't assign value yet
        
            gridimageorientation($thisitem, thisimagewidth, thisimageheight); // assign image orientation classes

        } else if (thisfieldtype == "input-height") {

          var thisclass = "grid-item-height", // this prefix of class
            newclass = "grid-item-height-" + (newvalue/25) + "",
            classes = $this.attr('class').split(" ").filter(function (c) {
              return c.lastIndexOf(thisclass, 0) !== 0;
            });

          $this.attr('class', classes.join(" ").trim());
          $this.addClass(newclass);
          $grid.packery('layout');

          var thisimagewidth, // declare - but don't assign value yet
            thisimageheight; // declare - but don't assign value yet
          gridimageorientation($thisitem, thisimagewidth, thisimageheight); // assign image orientation classes


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

         console.log("applyvalue x position" +applyxvalue+"")
       
       /*  transform: 
         translateX(<?php echo esc_attr( $v['image_position_x'] ); ?>%)
         translateY(<?php echo esc_attr( $v['image_position_y'] ); ?>%)
         scale(<?php echo esc_attr( $v['image_scale']/100); ?>);
*/

          $this.find(".inner-grid-item").css("transform", "translateX("+applyxvalue+") translateY("+applyyvalue+") scale("+applyscalevalue+")"); // to do - ensure cross browser


        } else if (thisfieldtype == "input-image-position-y") {

            applyyvalue = newvalue + "%";


            console.log("applyvalue y position" +applyyvalue+"");

 
            $thisfield.attr("value", newvalue);
            $this.find(".inner-grid-item").css("transform", "translateX("+applyxvalue+") translateY("+applyyvalue+") scale("+applyscalevalue+")"); // to do - ensure cross browser


          
          // console.log("scale value from insdie the input y " +applyscalevalue+"");
          // console.log("x value value from inside the input y " +applyxvalue+"");
          // console.log("applyyvalue from inside the input y " +applyyvalue +"");

       // $this.find(".inner-grid-item").css("transform", "translateY("+applyyvalue+")"); // to do - ensure cross browser

          


        } else if (thisfieldtype == "input-image-scale") {

            applyscalevalue = (newvalue/100); // value: 1 - 200. So divided by 100
        
            console.log("applyvalue scale" +applyscalevalue+"");

            $thisfield.attr("value", newvalue);
          
            $this.find(".inner-grid-item").css("transform", "translateX("+applyxvalue+") translateY("+applyyvalue+") scale("+applyscalevalue+")"); // to do - ensure cross browser
 
        };

      }); //$inputfields.change(function() {



      // other inner positions + scalling;
      // fields yet to be added




    } // function itemedit(itemid){ // for new items


    function _checkitemid(itemid) {

      /* review this entire function - it createus a loop of sorts


      */
      /*
         // check if the id already exists
          console.log("checkitemid("+itemid+")");

          if( ($('.repeater-item' ).attr('data-item-id',itemid)).length){

             console.log("attr data-item-id="+itemid+"exist");
             $( '.repeater-item' ).attr('data-item-id',itemid).css("background","red");
             // itemid++;
              console.log("itemid about to return"+itemid+"");
              itemid++;

              console.log("itemid atfter adding"+itemid+"");
             // newitemid = itemid;
          var tempid = itemid;
              console.log("newitemid about to return"+tempid+"");


            // this creating a loop of sorts-- no good.


            // checkitemid(tempid);// check this tempid

             break;
         // newitemid = tempid;
             //return itemid;
          //  return newitemid;

           // itemid++;
           // console.log("attr exist?");

          } else {
            console.log("id doesn't exist - so return the this itemid"+ itemid+"");
            newitemid = itemid;

            return newitemid

           // return itemid;

          }
       //   return itemid;

       return newitemid;
       */

    } //function checkitemid(itemid)
    
    
    // TYPE: Repeater
    //----------------------------------------

    var verifyItemsRepeater = function () {
      var removeRow = $('.repeater .remove-row');
      if ($('.repeater > .repeater-item').length == 1) {
        removeRow.hide();
      } else {
        removeRow.show();
      }
    };

    verifyItemsRepeater(); // initial - move to better place - or inside an init function of sorts

    $('.repeater-wrap > .add-row').click(function () {
      // console.log("hello add a row")

      var clone = $('.repeater > .repeater-item:last').clone();
      // var itemid =  $( clone ).attr('data-item-id'); // this still the old one.
      //  itemid++;// so add one

      // we need to chech here if this id already existt:
      //if it does try next id+ unitll this work
      //   console.log("Old item Id"+itemid+"");


      var ids = $('.repeater-item').map(function () {
        return $(this).attr('data-item-id');
      });
      var maxValueInArray = Math.max.apply(Math, ids);

      console.log("MaxValueInArray" + maxValueInArray)

      // checkitemid(itemid); //TO DO - is this correct way of ensuring I get the correct value - badly coded?



      var itemid = maxValueInArray + 1; // used updated itemid

      // console.log(newIndex +"newIndex");
      // console.log("returned newitemid"+ newitemid+"");
      console.log("updated item id" + itemid + "");

      // $(clone).find( 'input' ).val( '' );// this clears the values in the cloned item

      //$( clone ).insertBefore( $( this ) );
      $(clone).insertAfter('.repeater > .repeater-item:last'); // insert at the bottm of grid
      var newIndex = $('.repeater > .repeater-item').length - 1;

      $('.repeater > .repeater-item:last').attr('data-item-id', itemid); //update item id
      //  $('.repeater > .item:last').attr('data-item-id','hello'+);
      console.log(newIndex + "newIndex");


      $('.repeater > .repeater-item:last [name], .repeater > .repeater-item:last[name]').attr('name', function (index, name) {
        return name.replace(/\[\d+\]/, '[' + newIndex + ']');
      });

      // was index now id variable
      //$('.repeater > .repeater-item:last').find('.acf-image-edit').attr('id','acf-image-edit-'+newIndex+''); //update item id on edit button
      //$('.repeater > .repeater-item:last').find('.acf-image-remove').attr('id','acf-image-remove-'+newIndex+''); //update item id on remove button
      //id variable:
      $('.repeater > .repeater-item:last').find('.acf-image-edit').attr('id', 'acf-image-edit-' + itemid + ''); //update item id on edit button
      $('.repeater > .repeater-item:last').find('.acf-image-remove').attr('id', 'acf-image-remove-' + itemid + ''); //update item id on remove button


      // update id on item and also id on inputfield
      console.log(newIndex + "update id");

      //chang selector to $(clone) as well? - this bit messy?
      $('.repeater > .repeater-item:last').attr('data-item-id-id', '' + itemid + ''); //update item id on remove button
      $('.repeater > .repeater-item:last').find('.input-id').attr('value', '' + itemid + ''); //update item id on remove button

      makedraggable($(clone)); // allow item to become draggabel
      imageedit(itemid); // allow edit on image
      imageremove(itemid); // allow delete of image
      itemedit($(clone)) // allow edit on other fields of cloned item

      // and would update coordinates here aswell
      $grid.packery('appended', $(clone));

      var positions = $grid.packery('getShiftPositions', 'data-item-id'),
        // localStorage.setItem( 'dragPositions', JSON.stringify( positions ) );
        jsonpositions = JSON.stringify(positions);
      // console.log("posititions = "+jsonpositions+"");

      // updat the text area value
      $('#coordinates').val(jsonpositions);

      verifyItemsRepeater(); // verify items

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

    function makedraggable($newitem) {

      // console.log("make new item draggable");

      $grid.find($newitem).each(function (i, itemElem) {
        var draggie = new Draggabilly(itemElem);
        $grid.packery('bindDraggabillyEvents', draggie);
        // console.log("make draggable")
      });

    } // function makedraggable($newitem){

    //fade();
    console.log("imagesloading");
    
    
    var $grid = $('.grid').imagesLoaded(function() {

       console.log("imagesloaded - how may times?");

      $('body').addClass("images-loaded");

      $grid.packery({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true,
        //gutter: '.gutter-sizer', // not needed?
        // stagger: 30 // animated
        initLayout: false // disable initial layout
        // initLayout: true // enable this then reset the values if problems

      });


      //$(document).on( 'click', '.repeater .remove-row', function() {
      //was docuyment - changed to grid, for packery integrations

      $(document).on('click', '.repeater .remove-row', function () {
        console.log("remove-row click")

        var item = $('.repeater > .repeater-item');
        if (item.length == 1) {
          item.find('input').val(''); // this means I can't delete the last - is this required?
        } else {

          var $closest = $(this).closest('.repeater-item');
          // $( this ).closest( '.repeater-item' ).remove();
          $grid.packery('remove', $closest).packery('shiftLayout');
          //Update the coordinates values
          // move this after verify?
          var positions = $grid.packery('getShiftPositions', 'data-item-id'),
              jsonpositions = JSON.stringify(positions);

          console.log("posititions = " + jsonpositions + "");

          // updat the text area value
          $('#coordinates').val(jsonpositions);
          //   $grid.packery('reloadItems')

          verifyItemsRepeater();

        }
        // verifyItemsRepeater();

        return false;
      });



      //INIT
      // move this each function into inital an init function?
      //$('.grid-item') relative to the grid
      $('.grid-item').each(function () {
        // console.log("each grid item - iniitally")
        var $thisitem = $(this),
          itemid = $thisitem.attr('data-item-id'),
          thisimagewidth, // declare - but don't assign value yet
          thisimageheight; // declare - but don't assign value yet

          gridimageorientation($thisitem, thisimagewidth, thisimageheight)
          itemedit($thisitem); // allow editing of heights, width, z-index etc.
          imageremove(itemid); // allow delete of image

      }); //$('.grid-item').each( function( )





      // get saved dragged positions
      // this gets the data from the local storage
      // var initPositions = localStorage.getItem('dragPositions');
      // more info: https://www.w3schools.com/html/html5_webstorage.asp

      // this gets the data from the field
    
      // TODO - ensure this is a unique; grid based balue

    //  var initPositions = $('#coordinates').val();
      
 
/*
need to have all this code attached to a .grid-layer + unique id?

*/

  var $coordinates = $grid.parent('.grid-layer').find('.coordinates'),
      initPositions = $coordinates.attr('value');

     

      // init layout with saved positions
      $grid.packery('initShiftLayout', initPositions, 'data-item-id');



      if ($('body').hasClass('logged-in')){

            // make draggable
          $grid.find('.grid-item').each(function (i, itemElem) {
            var draggie = new Draggabilly(itemElem);
            $grid.packery('bindDraggabillyEvents', draggie);
            console.log("make draggable")
          });

          // save drag positions on event
          $grid.on('dragItemPositioned', function () {
            console.log("$grid.on( 'dragItemPositioned'");
            console.log("positions" +positions+ "");

            // save drag positions
            var positions = $grid.packery('getShiftPositions', 'data-item-id');
            // from local storage:
            // localStorage.setItem( 'dragPositions', JSON.stringify( positions ) );

            var jsonpositions = JSON.stringify(positions);
            //console.log("posititions = "+jsonpositions+"");
            console.log("posititions = " + JSON.stringify(positions) + "");

            // updat the text area value
            $('#coordinates').val(jsonpositions);
            $('#coordinates').attr('value', jsonpositions);

          });// $grid.on('dragItemPositioned', function () 

      } else { // not logged-in:
        // no requirements for draggability needed

      }//if ($(body).hasClass('logged-in')){



 

      //END INIT



      /*
      Considerations:
      if more items are added or removed after the local files is saved, the layout will break - so ensure that I clear / reset /rewrite the files
      or change the variable name (with the associated arrangment data) everything the admin changes the layout

        /*   localStorage.setItem(
        this will require cookies + consent tools accordingly I  think*/

      /* use this if I don't use the above
    // make all grid-items draggable
    $grid.find('.grid-item').each( function( i, gridItem ) {
      var draggie = new Draggabilly( gridItem );
      // bind drag events to Packery
      $grid.packery( 'bindDraggabillyEvents', draggie );
    });

    $grid.on( 'layoutComplete',
            function( event, laidOutItems ) {

      console.log( 'Packery layout completed on ' +     laidOutItems.length + ' items' );
      fade();
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





      // Bind to scroll
      $(window).scroll(function () {
        // consider removing some variable declartion from the fade function: and place elsewhere
        fade(); // run fade funcion on scroll
      }); // scroll function

      $(window).scrollTop($(window).scrollTop() + 1);

      // trigger initial to ensure all object are layed out (includign thenegative offests)

      // dev toggle - remove from this function and place in sepeate files
      $(".dev-layout-grid-toggle").click(function () {

        if ($('body').hasClass("dev-layout-grid-on")) {

          $('body').removeClass('dev-layout-grid-on');
        } else {

          $('body').addClass('dev-layout-grid-on');

        } //click

      }); //  $(".dev-toggle").click(function ( )

    }); //image loaded
 
} //export default function init()