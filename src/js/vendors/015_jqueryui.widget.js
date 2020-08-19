 
 $( function() {
  $.widget( "custom.iconselectmenu", $.ui.selectmenu, {

    
    _renderItem: function( ul, item ) {

      var li = $( "<li>" ),
        wrapper = $( "<div>", { text: item.label } );

      if ( item.disabled ) {
        li.addClass( "ui-state-disabled" );
      }

      $( "<span>", {
        style: item.element.attr( "data-style" ),
        "class": "ui-icon " + item.element.attr( "data-class" )
      })
        .appendTo( wrapper );

        // wrapper.css("background","red");

      return li.append( wrapper ).appendTo( ul )
    }

  });

 } ); 
 