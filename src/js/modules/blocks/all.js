export function images($block){
console.log("images loaded applied here")
  
    var $thisimageblock = $block.find("img");  // just target img?
    $thisimageblock.css("backgroun","red");

    $thisimageblock.each(function() {  

      console.log("each image? block");
      
        var $thisimage = $(this);

            $thisimage.imagesLoaded( {
              // options...
              },
              function() {
                
             console.log("images have loaded");
                var oldSrc = $thisimage.attr('src'),
                    newSrc = $thisimage.attr('data-src');
                  $thisimage.attr('src', newSrc);
                  $thisimage.addClass("loaded"); // possibly not need

              }

            ); // 

      });//  $thisimageblock.each(function()

  };//function images($block)

  export function introbanner($block){
  console.log("images loaded applied here")
      
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

  };//function introbanner($block){
    

export function slideshow($block){

    //$.getScript( ""+themeurl+'/assets/js/site.js', function( data, textStatus, jqxhr ) {
    $.getScript( "https://npmcdn.com/flickity@2/dist/flickity.pkgd.js", function( data, textStatus, jqxhr ) {

   console.log(" hello function slideshow($block)")
  var $thisgallery = $block.find(".slideshow-carousel");  

       images($thisgallery);

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
          // arrowShape: '82.9312793 24.4501626 86.9653917 27.5504528 49.7576146 75.9653917 12.5498374 27.5504528 16.5839498 24.4501626 49.7576146 67.615895',

        });

      });//get flickity pkg script

}; // function gallery($block)

export function map($block){

  console.log("function map($block) - ONE")

        if ($('#g-map').length > 0){ //if element exists / map turned on
        // console.log("#g-map.length > 0")

            //var gMapsLoaded = false; // maybe I need to put this variable else where?
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
                var image = ""+themeurl+'/assets/svg/map_marker_svg_40px.svg?i='+(index++);
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

} // function gallery($block)