/*! svs.design - app.js */

// Polyfills.
// import es6Promise from 'es6-promise';
// import 'classlist-polyfill';

// Libraries.
// import 'browsernizr/test/css/objectfit';
// import 'browsernizr';
// import picturefill from 'picturefill';
// import svg4everybody from 'svg4everybody';
// import pace from 'pace-progress';

// Utilities.
 
import { domReady } from './utilities/helpers';
import { devGrid } from './utilities/helpers';
import { SetAppHeight } from './utilities/helpers';

import { detectTouch } from './utilities/helpers';
import { orientation } from './utilities/helpers';
// import { navigation } from './utilities/helpers';
import { menuPositioner } from './utilities/helpers';
 /*
import { domReady,
  devGrid,
  SetAppHeight, 
  detectTouch,
  orientation,
  menupositioner
 } from './utilities/helpers';
*/
// Modules.
import barba from './modules/barba/index';
import siteload from './modules/siteload/index'
import navigation from './modules/navigation/index';

const inpapp = {
  init() {
    console.log("init");

    // Polyfills etc.
    // es6Promise.polyfill();
    // polyfillArrayFrom();
    // polyfillArrayFind();
    // polyfillArrayFindIndex();
    // polyfillArrayIncludes();
    // picturefill();
    // svg4everybody();

    // Setup.
    // pace.start();
    // lazyLoad();

    // Modules.
     devGrid();
     SetAppHeight();
     orientation();
     detectTouch();// determine if we're on touch device or not
     barba();
     navigation();
     menuPositioner();//initial menu
     siteload();
    //  domReady(siteload);

    //  navigation();

    //  radioloader();

 
  }

};

domReady(inpapp.init);