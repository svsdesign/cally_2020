

var $ = $ || jQuery;

(function($){
      //  console.log("(function($)");
   // console.log("hello multicolumnimage block script");

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

 var initializeBlock = function images($block){
     // console.log("images loaded applied here")
    // console.log("each multicolumnimage block?");

    var $thisimageblock = $block.find("img");  // just target img?

        $thisimageblock.each(function() {  

          //console.log("each multicolumnimage?");
         
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

    // Initialize each block on page load (front end).
    $(document).ready(function(){

        // if I only want to run the scripts on the admins side:
        if ($("body").hasClass("wp-admin")) {
            //console.log("is admin")
            // console.log("documentready - // Initialize each block on page load (front end). ")

               initializeBlock( $(this) );

         }//end if I only want to run the scripts on the admins side:

    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        console.log("window.acf");
    
        window.acf.addAction( 'render_block_preview/type=thmulticolimage', initializeBlock );

    }

})(jQuery);