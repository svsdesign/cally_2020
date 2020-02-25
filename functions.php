<?php
/**
 *  Theseus
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  
 */

function theseus_style() {
   
 wp_enqueue_style( 'style', get_stylesheet_uri() );

 }
add_action( 'wp_enqueue_scripts', 'theseus_style' );


function site_scripts() {

/*
wp_enqueue_script(
'headroom',
'https://cdnjs.cloudflare.com/ajax/libs/headroom/0.10.3/headroom.min.js', //todo: place locacally?
array('jquery'),
false,
true 
);	
*/

wp_enqueue_script(
    'headroom',
    'https://cdnjs.cloudflare.com/ajax/libs/headroom/0.10.3/headroom.min.js',
    array('jquery'),
    false,
    true
);

wp_enqueue_script(
    'headroom-jquery',
    'https://cdnjs.cloudflare.com/ajax/libs/headroom/0.10.3/jQuery.headroom.min.js',
    array('jquery'),
    false,
    true
);



 
wp_enqueue_script( 'navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '1.0.0', true );


//	wp_enqueue_script( 'packery', 'https://unpkg.com/packery@2/dist/packery.pkgd.js', array(), '1.0.0', true );
 //   wp_enqueue_script( 'packery-drag', 'https://unpkg.com/draggabilly@2/dist/draggabilly.pkgd.js', array(), '1.0.0', true );
wp_enqueue_script( 'site', get_template_directory_uri() . '/assets/js/site.js', array('jquery'), false, true );
  



}

add_action( 'wp_enqueue_scripts', 'site_scripts' );





/* ALLOW SVG UPLOADS*/
	
function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

 
 


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Website Settings',
		'menu_title'	=> 'Website Settings',
		'menu_slug' 	=> 'website-settings',
//		'capability'	=> 'edit_posts',
	//	"capability"    => "manage_sites", // this is for super admins; no one else sees. (apparently)
		'redirect'		=> false,

	));
	
};





/* Add Navigations */

function register_navigations() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Navigation' ),
      'footer-menu' => __( 'Footer Navigation' )    
    )
  );
}
add_action( 'init', 'register_navigations' );


/* End Add Navigations */


/* Admin favicons  - TO DO - ensure files exist before adding php function */

function add_favicon() {
    $favicon_url = get_stylesheet_directory_uri();
    echo'<link rel="apple-touch-icon" sizes="180x180" href="'. $favicon_url .'/assets/site-icons/back-end/apple-touch-icon.png">';
    echo'<link rel="icon" type="image/png" sizes="32x32" href="'. $favicon_url .'/assets//site-icons/back-end/favicon-32x32.png">';
        '<link rel="icon" type="image/png" sizes="16x16" href="'. $favicon_url .'/assets/site-icons/back-end/favicon-16x16.png">';
        '<link rel="manifest" href="'. $favicon_url .'/assets/site-icons/back-end/site.webmanifest">';
        '<link rel="mask-icon" href="'. $favicon_url .'/assets/site-icons/back-end/safari-pinned-tab.svg" color="#f0523b">';
        '<link rel="shortcut icon" href="'. $favicon_url .'./assets/site-icons/back-end/favicon.ico">';
        '<meta name="msapplication-TileColor" content="#ffffff">';
        '<meta name="msapplication-config" content="'. $favicon_url .'/assets/site-icons/back-end/browserconfig.xml">';
        '<meta name="theme-color" content="#ffffff">';

}
//TO DO - ensure files exist before adding php function
//add_action('login_head', 'add_favicon');
//add_action('admin_head', 'add_favicon');


/* End admin favicons */



/* START ADMIN BLOCKS */

/*
function legit_block_editor_styles() {
wp_enqueue_style( 'legit-editor-styles', get_theme_file_uri( '/style-editor.css' ), false, '2.3', 'all' );} 
add_action( 'enqueue_block_editor_assets', 'legit_block_editor_styles' );

}
*/

function my_admin_block_assets() {

	//https://wp.zacgordon.com/2017/12/26/how-to-add-javascript-and-css-to-gutenberg-blocks-the-right-way-in-plugins-and-themes/
	//https://support.advancedcustomfields.com/forums/topic/js-fires-before-block-is-rendered/
	//https://kinsta.com/blog/critical-rendering-path/
	//https://modularwp.com/gutenberg-block-custom-styles/

	//wp_enqueue_style('admin-artist-block',''.get_stylesheet_directory_uri().'/template-parts/blocks/inpartist/assets/css/style.css', array(), '1');
	wp_enqueue_style('admin-blocks',''.get_stylesheet_directory_uri().'/admin-style.css', array(), '1');

	//enquire js
	wp_enqueue_script('th-admin-enquire', ''.get_stylesheet_directory_uri().'/assets/js/enquire.js', array( 'jquery' ), '', true );


	 // admin js: - review
	wp_enqueue_script('th-admin-site', ''.get_stylesheet_directory_uri().'/assets/js/site-admin.js', array( 'jquery' ), '', true );


}
 add_action( 'enqueue_block_editor_assets', 'my_admin_block_assets' );
 
/* END ADMIN BLOCKS */




add_filter('admin_body_class', 'wpse_320244_admin_body_class');

function wpse_320244_admin_body_class($classes) {
    global $post, $pagenow;

  // to return the value, and perhaps assign it to a variable for later use
 	$scheme = get_field('colour_scheme', 'option'); 

//	$scheme = "white";// temporary - if needed

	if  ($scheme == 'black'){
		$assignscheme = ' black-scheme';

	} elseif ($scheme == 'white'){
		$assignscheme = ' white-scheme'; // ensure space added before class

	} else{

		$assignscheme = ' white-scheme';

	}// end if
 
    // $pagenow contains current admin-side php-file
    // absint converts type to int, so we can use strict comparison
    if($pagenow === 'post.php' && absint($post->ID) === 8) {
    	        $classes .= $assignscheme;
    	        // don't probably bneed this if statement

    	        //$classes .= ' white-scheme';
    } else
    {

    	        $classes .= $assignscheme;

    }

    return $classes;
}


// ACF CUSTOM FIELDS

include_once( get_stylesheet_directory() .'/acf-fields.php');


//END ACF CUSTOM FIELDS




function my_acf_init() {
    
    // check function exists
    if( function_exists('acf_register_block') ) {
        
    // register a quote block:
    /* - delete this unless I need the support uoption - and use this as referene rthen
        acf_register_block(array(
            'name'              => 'inpquote',
            'title'             => __('Inp Quote'),
            'description'       => __('A custom quote block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
            'enqueue_assets'    => function(){
                //  wp_enqueue_script('inp-quote-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpquote/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'editor-quote',
          //  'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'           => array( 'mode' => false ),//If set to “Edit” it appears like a metabox in the content area. The user can switch the mode by clicking the button in the top right corner, unless you specifically disable it with 

            'keywords'          => array( 'inpquote'),
        ));
    //END delete this unless I need the support uoption - and use this as referene rthen

    */
      
    
    // register a text block:

		// one column: Text
    
        acf_register_block(array(
            'name'              => 'thonecol', //th_one_col
            'title'             => __('Text - One Column'),
            'description'       => __('Text - One Column'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thonecol'),
        ));

		
		// one column: Image

  		 acf_register_block(array(
            'name'              => 'thonecolimage', 
            'title'             => __('Image - One Column'),
            'description'       => __('Image - One Column'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){          
             wp_enqueue_script('th-one-col-image', ''.get_stylesheet_directory_uri().'/template-parts/blocks/thonecolimage/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thonecolimage'),
        ));
		// multi column: Image


		acf_register_block(array(
            'name'              => 'thmulticolimage', 
            'title'             => __('Image - Multi Column'),
            'description'       => __('Image - Multi Column'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
           
  //           wp_enqueue_script('th-multi-col-image', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thmulticolimage'),
        ));



		// two column: Text

        acf_register_block(array(
            'name'              => 'thtwocol', 
            'title'             => __('Text - Two Column'),
            'description'       => __('Text - Two Column'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thtwocol'),
        ));

		// two column: Text + Image

        acf_register_block(array(
            'name'              => 'thtwocoltextimage', 
            'title'             => __('Text + Image - Two Column'),
            'description'       => __('Text + Image - Two Column'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thtwocoltextimage'),
        ));

		// two column: Jobs

    	acf_register_block(array(
            'name'              => 'thtwocoljobs', 
            'title'             => __('Text - Two Column - Job Vacancy'),
            'description'       => __('Text - Two Column - Job Vacancy'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thtwocoljobs'),
        ));



 	   acf_register_block(array(
            'name'              => 'thtwocolleftheader', 
            'title'             => __('Text - Two Column - Left Header'),
            'description'       => __('Text - Two Column - Left Header'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thtwocolleftheader'),
        ));

  		acf_register_block(array(
            'name'              => 'thtwocolleftheaderimage', 
            'title'             => __('Text - Two Column - Left Header + Image'),
            'description'       => __('Text - Two Column - Left Header + Image'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thtwocolleftheaderimage'),
        ));
	 
		 acf_register_block(array(
            'name'              => 'thtwocolheader', 
            'title'             => __('Text - Two Column - Header'),
            'description'       => __('Text - Two Column - Header'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thtwocolheader'),
        ));

       

 	   acf_register_block(array(
            'name'              => 'thline', 
            'title'             => __('Line'),
            'description'       => __('Line'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thline'), // review this- its not liner sould be line?
        ));

 	    acf_register_block(array(
            'name'              => 'thspacer', 
            'title'             => __('Spacer'),
            'description'       => __('Spacer'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thspace'),
        ));

		 acf_register_block(array(
            'name'              => 'thclientlogos', 
            'title'             => __('Client Logos'),
            'description'       => __('Client Logos'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thclientlogos'),
        ));



  /*      acf_register_block(array(
            'name'              => 'inpimage',
            'title'             => __('Inp Image'),
            'description'       => __('A custom image block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
            'enqueue_assets'    => function(){
                //  wp_enqueue_script('inp-quote-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inpquote/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'format-image',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'          => array( 'mode' => false ),
            'keywords'          => array( 'inpimage'),
        ));
        */


  // register slideshow block:

       //https://www.advancedcustomfields.com/resources/acf_register_block_type/#examples
        acf_register_block(array(
            'name'              => 'thslideshow',
            'title'             => __('Slide Show'),
            'description'       => __('Slide Show'),// review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
          //  'enqueue_script'    => '',

            'enqueue_assets'    => function(){
            //  wp_enqueue_script('flickity-pgkd','https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array('jquery'), false, true);
           //    wp_enqueue_style( 'flickity styles', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css' );
//  //  wp_enqueue_style( 'flickity-style', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css'); // Styles moved into "block-gallery.scss"
           //   wp_enqueue_script('flickity-pgkd', 'https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array( 'jquery' ), '', true ); // 
            wp_enqueue_script('flickity-pgkd', 'https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array( 'jquery' ), '', true );

             wp_enqueue_script('th-slide-show-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/thslideshow/assets/js/script.js', array( 'jquery' ), '', true );

            },

            'icon'              => 'format-gallery',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'          => array( 'mode' => false ),
            'keywords'          => array( 'thslideshow'),
        ));



 // register contact block:

       //https://www.advancedcustomfields.com/resources/acf_register_block_type/#examples
        acf_register_block(array(
            'name'              => 'thcontact',
            'title'             => __('Contact'),
            'description'       => __('Contact'),// review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
          //  'enqueue_script'    => '',

            'enqueue_assets'    => function(){
            //  wp_enqueue_script('flickity-pgkd','https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array('jquery'), false, true);
           //    wp_enqueue_style( 'flickity styles', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css' );
//  //  wp_enqueue_style( 'flickity-style', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css'); // Styles moved into "block-gallery.scss"
//              wp_enqueue_script('flickity-pgkd', 'https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array( 'jquery' ), '', true ); // 
     //         wp_enqueue_script('th-slide-show-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/thslideshow/assets/js/script.js', array( 'jquery' ), '', true );

            },

            'icon'              => 'admin-comments',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'          => array( 'mode' => false ),
            'keywords'          => array( 'thcontact'),
        ));



  // register video block:

       //https://www.advancedcustomfields.com/resources/acf_register_block_type/#examples
        acf_register_block(array(
            'name'              => 'thvideo',
            'title'             => __('Video'),
            'description'       => __('Video'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
          //  'enqueue_script'    => '',

            'enqueue_assets'    => function(){
            //  wp_enqueue_script('flickity-pgkd','https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array('jquery'), false, true);
           //    wp_enqueue_style( 'flickity styles', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css' );
//  //  wp_enqueue_style( 'flickity-style', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css'); // Styles moved into "block-gallery.scss"
          //    wp_enqueue_script('flickity-pgkd', 'https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array( 'jquery' ), '', true ); // 
         //     wp_enqueue_script('th-slide-show-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/thslideshow/assets/js/script.js', array( 'jquery' ), '', true );

            },

            'icon'              => 'format-gallery',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'          => array( 'mode' => false ),
            'keywords'          => array( 'thvideo'),
        ));
		//end video

    }// if( function_exists('acf_register_block') )

}//function my_acf_init() 

add_action('acf/init', 'my_acf_init'); 



function my_acf_block_render_callback( $block ) {
    
    // convert name ("acf/quote") into path friendly slug ("quote")
    $slug = str_replace('acf/', '', $block['name']);
    
    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}/content-{$slug}.php") ) ) {
        include( get_theme_file_path("/template-parts/blocks/{$slug}/content-{$slug}.php") );
    } //if

}//function my_acf_block_render_callback( $block ) {

/* END BLOCKS */




/*
//wp_print_styles
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' ); // Wordpress core
  //  wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
}
//add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
*/
/*

function custom_theme_assets() {
wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'custom_theme_assets', 100 );
*/

/*
function remove_default_stylesheets() {
// wp_deregister_style( 'wp-block-library' );
 //wp_deregister_style( 'wp-block-library-theme' );   
// wp_dequeue_style( 'wp-block-library-theme' );
// wp_dequeue_style( 'wp-block-library' );
  //  wp_deregister_style('wp-admin');
}
add_action('admin_init','remove_default_stylesheets');
*/
/*V2 stuff to review; maybe add:*/

 

/* de-register/enqueue the cookie notice css scripts  - as per inp setup?
"cookie-notice-front"
        wp_enqueue_style( 'cookie-notice-front', plugins_url( 'css/front' . ( ! ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.min' : '' ) . '.css', __FILE__ ) );



add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet', 20 );
function remove_default_stylesheet() {
      wp_dequeue_style( 'cookie-notice-front' ); // cookie notice plugin
  //  wp_deregister_style( 'original-register-stylesheet-handle' );
 
   // wp_register_style( 'new-style', get_stylesheet_directory_uri() . '/new.css', false, '1.0.0' ); 
    //wp_enqueue_style( 'new-style' );
}

//


// "Un-register" the normal post + associated functions and options
https://www.mitostudios.com/blog/how-to-remove-posts-blog-post-type-from-wordpress/ 

// Remove side menu
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}

// Remove Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

// End remove normal post type
*/


/* END V2 stuff to review; maybe add:*/
/* START ACF FIELDS */


//add_action('init’, ‘register_field_group');


?>
