(function($){
  
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
console.log("hello image block scripts");

 var initializeBlock = function images($block){
     // console.log("images loaded applied here")
     
    var $thisimageblock = $block.find("img");  

        $thisimageblock.each(function() {  

         // console.log("each admin image here?");
         
          var $thisimage = $(this);

               $thisimage.imagesLoaded( {
                // options...
                },
                function() {
           
                  // console.log("images have loaded?");
               
                  var oldSrc = $thisimage.attr('src'),
                      newSrc = $thisimage.attr('data-src');

                     //console.log("newSrc" + newSrc +"");

                     $thisimage.attr('src', newSrc);
                     $thisimage.addClass("loaded"); // possibly not need

                }

              ); // 

        });//  $thisimageblock.each(function()

    };//function images($block)

    // Initialize each block on page load (front end).
    $(document).ready(function(){

        console.log("doc ready into wp-admin")
        // if I only want to run the scripts on the admins side:
        if ($("body").hasClass("wp-admin")) {

            $(".image-one-col-block").each(function() {

             // console.log("this + "+$(this)+"")
                initializeBlock( $(this) );

            });//  $thisimageblock.each(function()

        }//end if I only want to run the scripts on the admins side:

    });


     //$.getScript( "https://npmcdn.com/flickity@2/dist/flickity.pkgd.js", function( data, textStatus, jqxhr ) {

    //)}

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        //console.log("window.acf");
        // this mean that maybe I can't re-use this script for all of image type content
        // unless I use furhter variables or include a main "image loading" js script from elsewher

        window.acf.addAction( 'render_block_preview/type=thonecolimage', initializeBlock );

    }

})(jQuery);