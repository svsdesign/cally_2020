(function($){
      //  console.log("(function($)");
    console.log("hello - one column image block script");

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
  

        if ($("body").hasClass("wp-admin")) { // If I only want to call this on the admin side

        var $thisimageblock = $block.find("img");  // just target img?

            $thisimageblock.each(function() {  

            console.log("each 'one column image block'");
             
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

        }//if ($("body").hasClass("wp-admin"))

    };//function images($block)
  
    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        //console.log("window.acf");
        window.acf.addAction( 'render_block_preview/type=thonecolimage', initializeBlock );

    }
      
})(jQuery);