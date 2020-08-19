
 
// Utilities.
import { domReady,
          opacity
 } from './utilities/helpers';
 import { orientation } from './utilities/helpers';


// Modules.
// import blocks from '../blocks/index';

const adminapp = {

  init() {
    // Modules.
    console.log("Admin App ");
    // example();
    // domReady(blocks);
     opacity();
     orientation();

  }

};

domReady(adminapp.init);
 