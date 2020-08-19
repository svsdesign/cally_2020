/*! Tom Greenhill - breakpoints.js */

// https://github.com/jnordberg/browsernizr/
import mq from 'browsernizr/lib/mq';

const device = {

  min(s) {
    const
      size = s.trim(),
      sizes = {
        xxsmall: '480px',
        xsmall: '600px',
        small: '769px',
        medium: '992px',
        large: '1200px',
        xlarge: '1430px'
      };

    if (sizes.hasOwnProperty(size)) {
      return mq(`only screen and (min-width: ${sizes[size]})`);
    }

    throw new ReferenceError(`The size ${size} is not a valid breakpoint: ${JSON.stringify(sizes)}`);
  },

  max(s) {
    const
      size = s.trim(),
      sizes = {
        xxsmall: '479px',
        xsmall: '599px',
        small: '768px',
        medium: '991px',
        large: '1199px',
        xlarge: '1429px'
      };

    if (sizes.hasOwnProperty(size)) {
      return mq(`only screen and (max-width: ${sizes[size]})`);
    }

    throw new ReferenceError(`The size ${size} is not a valid breakpoint: ${JSON.stringify(sizes)}`);
  }

};

export default device;
