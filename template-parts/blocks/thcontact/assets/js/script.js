

(function($){
      //  console.log("(function($)");
    console.log("hello contact block script");

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

 var initializeBlock = function map($block){
     // console.log("images loaded applied here")
        console.log("each contact block?");
  
        var $thisblock = $block;
        var $thisgmap = $thisblock.find("#g-map");  // // resolve unique id

        //console.log("function map($block) - ONE")

            if ($thisgmap.length > 0){ //if element exists / map turned on
                console.log("#g-map.length > 0")

                var gMapsLoaded = false; // maybe I need to put this variable else where?
                var index=0;

                window.gMapsCallback = function(){
                    gMapsLoaded = true;
                    $(window).trigger('gMapsLoaded');
                }

                window.loadGoogleMaps = function(){
                 
                  //console.log("gMapsLoaded =" + gMapsLoaded + "");
                   
                    //I think this is the one I need to load - so find the other one & delete it
                    if(gMapsLoaded) return window.gMapsCallback();
                    var script_tag = document.createElement('script');
                    script_tag.setAttribute("type","text/javascript");
                    script_tag.setAttribute("src","https://maps.googleapis.com/maps/api/js?key=AIzaSyBUXYryE2krCQ7nIvVcXcFzWEPY0cEcXbE&callback=gMapsCallback");
                    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
                 
                }

                function initialize(){

                    var mapOptions = {
                        center: {lat: 51.5198038, lng: -0.1228228999999601},
                          zoom: 15,
                          panControl: false,
                          zoomControl: false,
                          draggable: true,
                          scrollwheel: false,
                          mapTypeControl: false,
                          scaleControl: false,
                          streetViewControl: false,
                          overviewMapControl: true,
                          styles: [{ "stylers": [
                                   { "saturation": "-90" }
                            ] } ],
                    }

                    /*https://stackoverflow.com/questions/22047466/how-to-add-css-class-to-a-googlemaps-marker */

                    map = new google.maps.Map(document.getElementById('g-map'),mapOptions);
            // var image = ""+themeurl+'/assets/svg/t_logo_svg.svg?i='+(index++);
                    var image = ""+themeurl+'/././assets/svg/map_marker_svg_40px.svg?i='+(index++);
                    var imageMarker = new google.maps.Marker({
                    position: {lat: 51.5198038, lng: -0.1228228999999601},
                    map: map,
                    optimized:false,
                    icon: image
                  });
                }

                $(window).bind('gMapsLoaded', initialize);
                window.loadGoogleMaps();

            } // if #g-map





    };//function map($block)


    // Initialize each block on page load (front end).
    $(document).ready(function(){

        // if I only want to run the scripts on the admins side:
        if ($("body").hasClass("wp-admin")) {
            //console.log("is admin")

            initializeBlock( $(this) );

         }//end if I only want to run the scripts on the admins side:


    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        console.log("window.acf");

           window.acf.addAction( 'render_block_preview/type=thcontact', initializeBlock );

    }

})(jQuery);