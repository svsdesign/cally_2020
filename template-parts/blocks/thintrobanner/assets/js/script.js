(function($){
      //  console.log("(function($)");
console.log("hello - introblock  block script");

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

    var initializeBlock = function introbanner($block){
  
        if ($("body").hasClass("wp-admin")) { // If I only want to call this on the admin side

        var $thisbannerblock = $block.find("img");  // just target img?

        $thisbannerblock.each(function() {  

         console.log("each 'intro banner block image '");
             
                var $thisbannerimg = $(this);

                $thisbannerimg.imagesLoaded( {
                    // options...
                    },
                    function() {
                    console.log("images have loaded");
                    var oldSrc = $thisbannerimg.attr('src'),
                        newSrc =$thisbannerimg.attr('data-src');
                        $thisbannerimg.attr('src', newSrc);
                        $thisbannerimg.addClass("loaded"); // possibly not need

                    }

                ); // 

            });//  $thisimageblock.each(function()

        }//if ($("body").hasClass("wp-admin"))

    };//function images($block)
  
    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        //console.log("window.acf");
        window.acf.addAction( 'render_block_preview/type=thintrobanner', initializeBlock );

    }
      
})(jQuery);