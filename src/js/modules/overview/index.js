/*! svs - overview */

/*
import {
  detectAttrChange,
  hoverDiv

} from '../../utilities/helpers';
*/

export default function init() {

  // console.log("overview js functions");


  if ($(".project-overview").length > 0) 
  {


      $('ul.sections li a').mouseenter(function(){
  
        var $this = $(this).parent("li"),
            thissection = $this.attr("data-section-title"),
            $nextline = $('ul.sections li[data-section-title="'+thissection+'"]').next(".line"),
            $previousline = $('ul.sections li[data-section-title="'+thissection+'"]').prev( ".line" );

            //  console.log("'ul.sections li  hover")
            //  console.log("thissections = "+thissection+"")

          // ensure headroom pinned
              if ($this.hasClass('section-is-active')){
                // IF ITS ALREADY ACTIVE - I DON'T REALLY NEED THE ABILTIY TO TURN IT OF?
                /*  $this.removeClass('section-is-active')
                $previousline.removeClass('section-is-active');
                $nextline.removeClass('section-is-active');
                */
              // if the nav is already on, lets not change the classes further
              } else{
                // remove other classes

                $('ul.sections li').removeClass('section-is-active');
                    // I think that ass soon as we have an initial mouseent that the is page active class no longer required?
                // kepe 
                // $('ul.sections li').removeClass('page-is-active');

                
                //add new classes
                $this.addClass('section-is-active');
                $previousline.addClass('section-is-active');
                $nextline.addClass('section-is-active');

                // $("ul.sections li[data-section-title='freeling-street']").addClass('section-is-active');
 
                $('ul.sections li[data-section-title="'+thissection+'"]').addClass('section-is-active');    
       
              return;

              };

            return;


      }); // hover 

  };// if ($("#header-nav-area").length > 0) 


} //export default function init()


