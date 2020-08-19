import {
    fade,
    topAnimation
} from '../../utilities/helpers';

 
export default function siteLoad(){

  console.log("siteLoad");
 
  if (introanimationdone == false){
    console.log("(introanimationdone == false)");

   $('.fade-item').css( 'opacity', 0 ); // intial run
     fade(); // intial run
     topAnimation();// start top animation (large)
    //  topAnimationSmall();// start top animation (small)
    
    $('body').removeClass('site-loading'); //ensure people can now scroll


    $('body').addClass('animation-done'); //add class so not added ever again
      
      introanimationdone = true;

    } else {
      console.log("(introanimationdone == true)");

     $('.fade-item').css( 'opacity', 0 ); // intial run
     fade(); // intial run
    
     $('body').removeClass('site-loading'); //ensure people can now scroll

    }//       if $("body:not(.animation-done)"){

} // function indexsiteload();
