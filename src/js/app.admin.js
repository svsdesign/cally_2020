
 
// Utilities.
import {
          domReady,
          opacity,
          imageopacity
 } from './utilities/helpers';

 import { orientation 
} from './utilities/helpers';
// Modules.
  
// import {blocks} from './modules/blocks/index'; // cant seem to get this working

const adminapp = {
 
  init() {
    // Modules.
     console.log("IS Admin App js why is jquery not working - here ?! ");
   
    //  domReady(blocks); doesnt work?!
     // orientation();
     domReady(orientation);
     imageopacity()
     opacity();

  }

};

domReady(adminapp.init);
// console.log("what the fuck");
