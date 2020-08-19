import {
  images,
  slideshow,
  map
} from '../../modules/blocks/all'

import {
  fade
} from '../../utilities/helpers';

 
//  console.log('blocks.js');


export default function blocks(){


    // if blocks exist: image-one-col-block
    if ($('.image-one-col-block, .text-two-col-image-block-left-header, .image-multi-col-block, .text-image-two-col-block, .client-logos-block').length > 0)
    {
      
      $('.image-one-col-block, .text-two-col-image-block-left-header, .image-multi-col-block, .text-image-two-col-block, .client-logos-block').each(function() {

      console.log("each .image-one-col-block, .text-two-col-image-block-left-header, .image-multi-col-block, .text-image-two-col-block, .client-logos-block");

      var $thisblock = $(this);
            images($thisblock);// run js if slideshow item exist
      });

    };// .slideshow-block

    // if blocks exist: Slideshow
    if ($('.slideshow-block').length > 0) 
    {
      $('.slideshow-block').each(function() {
      console.log("if slideshow-block");

      var $thisblock = $(this);  
          slideshow($thisblock);// run js if slideshow item exist
        });

    };// .slideshow-block


    // if blocks exist: Contact + Map
    if ($('.contact-block').length > 0) 
    {
        console.log("if contact block");
      $('.contact-block').each(function() {
      var $thisblock = $(this);  
          map($thisblock);// run js if slideshow item exist
        });

    };// .slideshow-block

    $(window).scroll(function(){
    //console.log("$(window).scroll(function(){");
    fade();
    });//  $(window).scroll(function(){  

  
};//blocks
