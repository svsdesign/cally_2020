import {
  homegallery,
  homereleasegallery
} from '../../utilities/helpers';

console.log("front page index.js");
 
export default function init() {

    // console.log('body.post-type-archive-releases');
 
  if ($('.featured-home-carousel').length > 0){
    homegallery();// rule top featured gallery        
  } // if.featured-home-carousel

  if ($('.release-home-carousel').length > 0){
    homereleasegallery()
  } // if.featured-home-carousel

} //export default function init()
