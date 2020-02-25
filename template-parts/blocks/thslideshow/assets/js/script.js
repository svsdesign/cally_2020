//https://www.advancedcustomfields.com/resources/acf_register_block_type/


/* to do :

Tidy all this up; remove INP stuff


*/
console.log("hello - slider script");

(function($){
        console.log("(function($)");

    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    15/4/19
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */




    var initializeBlock = function( $block ) {
            
        //$block.find('img').doSomething();
         console.log('initializeBlock = function( $block ) - slideshow block');
 
        var $thisgallery = $block.find(".slideshow-carousel");   // review this   class name 
        // console.log('initializeBlock = function( $block ) - slideshow block from its own script.js file');

 var $thisimageblock = $thisgallery.find("img");  // just target img?

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
    //            arrowShape: '82.9312793 24.4501626 86.9653917 27.5504528 49.7576146 75.9653917 12.5498374 27.5504528 16.5839498 24.4501626 49.7576146 67.615895',

             });

    }//var initializeBlock = function( $block ) 

    // Initialize each block on page load (front end).
    $(document).ready(function(){

        // if I only want to run the scripts on the admins side:
        if ($("body").hasClass("wp-admin")) {
            //console.log("is admin")
             console.log("documentready - // Initialize each block on page load (front end). ")

               initializeBlock( $(this) );

         }//end if I only want to run the scripts on the admins side:


    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        console.log("window.acf");

           window.acf.addAction( 'render_block_preview/type=thslideshow', initializeBlock );

    }

})(jQuery);