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
wp_enqueue_script( 'site', get_template_directory_uri() . '/assets/js/site.js', array(), '1.0.0', true );
  



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



if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5c1a77cdb4be8',
	'title' => 'Website options',
	'fields' => array(
		array(
			'key' => 'field_5c1a77d680beb',
			'label' => 'Colour Scheme',
			'name' => 'colour_scheme',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'white' => 'White',
				'black' => 'Black',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => '',
			'layout' => 'vertical',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'website-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;




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
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
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
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
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
            'keywords'          => array('thliner'),
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
              wp_enqueue_script('flickity-pgkd', 'https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array( 'jquery' ), '', true ); // 
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


if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5e3ef30c2104e',
	'title' => 'Block:	Image Multi Column',
	'fields' => array(
		array(
			'key' => 'field_5e3ef30c267b5',
			'label' => 'Multi column Content',
			'name' => 'multi_col_content',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5e3ef30c2802d',
					'label' => 'Image',
					'name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_5e3ef30c28036',
					'label' => 'Image Caption',
					'name' => 'image_caption',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
			),
		),
		array(
			'key' => 'field_5e3ef33697feb',
			'label' => 'Number of Columns',
			'name' => 'number_of_columns',
			'type' => 'radio',
			'instructions' => 'Max number of images (columns) per row',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'one' => 'One',
				'two' => 'Two',
				'three' => 'Three',
				'four' => 'Four',
			),
			'allow_null' => 1,
			'other_choice' => 0,
			'default_value' => '',
			'layout' => 'vertical',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thmulticolimage',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e3eeedd9b409',
	'title' => 'Block:	Image One Column',
	'fields' => array(
		array(
			'key' => 'field_5e3eeedda0728',
			'label' => 'One column Content',
			'name' => 'one_col_content',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5e3eeedda1d3c',
					'label' => 'Image',
					'name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_5e3eeedda1d43',
					'label' => 'Image Caption',
					'name' => 'image_caption',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thonecolimage',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e3ecf7b439b0',
	'title' => 'Block: Client Logos',
	'fields' => array(
		array(
			'key' => 'field_5e3ecf7b4d276',
			'label' => 'Client Logos',
			'name' => 'client_logos',
			'type' => 'gallery',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'insert' => 'append',
			'library' => 'all',
			'min' => '',
			'max' => '',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thclientlogos',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e3fe43338d0b',
	'title' => 'Block: Contact',
	'fields' => array(
		array(
			'key' => 'field_5e3fe43345226',
			'label' => 'Title',
			'name' => 'title',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5e3fe43345232',
			'label' => 'Contact Details',
			'name' => 'text_area',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5e3fe43e1a26a',
			'label' => 'Map',
			'name' => 'map',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5e3fe49465ccd',
			'label' => 'Logos',
			'name' => 'logos',
			'type' => 'gallery',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'insert' => 'append',
			'library' => 'all',
			'min' => '',
			'max' => '',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thcontact',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e39693f0da8d',
	'title' => 'Block: Slideshow',
	'fields' => array(
		array(
			'key' => 'field_5e39696a77a54',
			'label' => 'Slideshow',
			'name' => 'slide_show',
			'type' => 'gallery',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'insert' => 'append',
			'library' => 'all',
			'min' => '',
			'max' => '',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5e3f12724d637',
			'label' => 'Slideshow Caption',
			'name' => 'slideshow_caption',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thslideshow',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e3ee8c33d3b8',
	'title' => 'Block: Text + Image Two Column',
	'fields' => array(
		array(
			'key' => 'field_5e3ee8c345a44',
			'label' => 'Two column Content',
			'name' => 'two_col_content',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5e3ee8c347249',
					'label' => 'Text Area',
					'name' => 'text_area',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
				array(
					'key' => 'field_5e3ee8e7dafa3',
					'label' => 'Image',
					'name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_5e3eec0f867fa',
					'label' => 'Image Caption',
					'name' => 'image_caption',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thtwocoltextimage',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e396c2b649bf',
	'title' => 'Block: Text One Column',
	'fields' => array(
		array(
			'key' => 'field_5e396c2b69ade',
			'label' => 'Title',
			'name' => 'title',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5e396c4e932f2',
			'label' => 'Text Area',
			'name' => 'text_area',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thonecol',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e3d53ebcf023',
	'title' => 'Block: Text Two Column',
	'fields' => array(
		array(
			'key' => 'field_5e3d5456015d6',
			'label' => 'Two column Content',
			'name' => 'two_col_content',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5e3d5512015d7',
					'label' => 'Title',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5e3d5538015d8',
					'label' => 'Text Area',
					'name' => 'text_area',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thtwocol',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e3ec57e98b4a',
	'title' => 'Block: Text Two Column Header',
	'fields' => array(
		array(
			'key' => 'field_5e3ec57e9e84b',
			'label' => 'Two column Content Header',
			'name' => 'two_col_content_header',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5e3ec57e9fef8',
					'label' => 'Title',
					'name' => 'title',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
				array(
					'key' => 'field_5e3ec57e9ff08',
					'label' => 'Text Area',
					'name' => 'text_area',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thtwocolheader',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e3d7cae39df5',
	'title' => 'Block: Text Two Column Jobs',
	'fields' => array(
		array(
			'key' => 'field_5e3d7e3a8c693',
			'label' => 'Two column Content Jobs',
			'name' => 'two_column_content_jobs',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5e3d7e518c694',
					'label' => 'Title',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5e3d7d06a68f9',
					'label' => 'Sub Title',
					'name' => 'sub_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5e3d7d17a68fa',
					'label' => 'Details',
					'name' => 'details',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'br',
				),
				array(
					'key' => 'field_5e3d7d2fa68fb',
					'label' => 'Description',
					'name' => 'description',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thtwocoljobs',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e3d80de8da63',
	'title' => 'Block: Text Two Column Left Header',
	'fields' => array(
		array(
			'key' => 'field_5e3d80de91a85',
			'label' => 'Two column Content Left Header',
			'name' => 'two_col_content_left_header',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5e3d80de92eb6',
					'label' => 'Title',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5e3d8b8b2514e',
					'label' => 'Subtitle',
					'name' => 'subtitle',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5e3d80de92ec1',
					'label' => 'Text Area',
					'name' => 'text_area',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
				),
			),
		),
		array(
			'key' => 'field_5e3ebea2bb52a',
			'label' => 'Column Sizing',
			'name' => 'column_sizing',
			'type' => 'radio',
			'instructions' => 'Size of Columns on Desktop',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'25-75' => '25% & 75%',
				'50-50' => '50% & 50%',
				'75-25' => '75% & 25%',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => '',
			'layout' => 'vertical',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thtwocolleftheader',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e4004d9edeb6',
	'title' => 'Block: Video',
	'fields' => array(
		array(
			'key' => 'field_5e4004da042fe',
			'label' => 'Video',
			'name' => 'video_url',
			'type' => 'text',
			'instructions' => 'svs to discuss w/ Mark regarding needs + options; i.e iframe embedds vs api usage?
allowing iframes would essentially mean anything can be embedded in this block. Discuss + resolve accordingly',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5e4004da042f0',
			'label' => 'Video Caption',
			'name' => 'video_caption',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/thvideo',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5c2799f6abe07',
	'title' => 'Page Template',
	'fields' => array(
		array(
			'key' => 'field_5c279a02b9c0f',
			'label' => 'Page Content',
			'name' => 'page_content',
			'type' => 'flexible_content',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layouts' => array(
				'5c279a1766cd0' => array(
					'key' => '5c279a1766cd0',
					'name' => 'content_item',
					'label' => 'Content Item',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5c279a27b9c10',
							'label' => 'Sub Title',
							'name' => 'sub_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5c279a35b9c11',
							'label' => 'Sub Item Content',
							'name' => 'sub_item_content',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
							'delay' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
			),
			'button_label' => 'Add Row',
			'min' => '',
			'max' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
			array(
				'param' => 'page',
				'operator' => '!=',
				'value' => '6',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'excerpt',
		1 => 'discussion',
		2 => 'comments',
		3 => 'format',
		4 => 'page_attributes',
		5 => 'featured_image',
		6 => 'categories',
		7 => 'tags',
		8 => 'send-trackbacks',
	),
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5bffee845dc91-2',
	'title' => 'theseus fields',
	'fields' => array(
		array(
			'key' => 'field_5bffef2295ba5',
			'label' => 'Page Content',
			'name' => 'page_content',
			'type' => 'flexible_content',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layouts' => array(
				'5bffef4e2bc4d' => array(
					'key' => '5bffef4e2bc4d',
					'name' => 'introduction',
					'label' => 'Introduction',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5bffef6195ba6',
							'label' => 'Menu Title',
							'name' => 'menu_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bffefad95ba7',
							'label' => 'Introduction',
							'name' => 'introduction',
							'type' => 'textarea',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => 'br',
						),
						array(
							'key' => 'field_5bffefbc95ba8',
							'label' => 'Further Description',
							'name' => 'further_description',
							'type' => 'textarea',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => 'br',
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_5bffefd86557e' => array(
					'key' => 'layout_5bffefd86557e',
					'name' => 'approach',
					'label' => 'Approach',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5bffefe16557f',
							'label' => 'Menu Title',
							'name' => 'menu_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bfff01065580',
							'label' => 'Introduction',
							'name' => 'introduction',
							'type' => 'textarea',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => 'br',
						),
						array(
							'key' => 'field_5bfff03565581',
							'label' => 'Details',
							'name' => 'details',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'collapsed' => '',
							'min' => 0,
							'max' => 0,
							'layout' => 'table',
							'button_label' => '',
							'sub_fields' => array(
								array(
									'key' => 'field_5bfff04c65582',
									'label' => 'Header',
									'name' => 'header',
									'type' => 'text',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'maxlength' => '',
								),
								array(
									'key' => 'field_5bfff05565583',
									'label' => 'Description',
									'name' => 'description',
									'type' => 'textarea',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'maxlength' => '',
									'rows' => '',
									'new_lines' => 'br',
								),
							),
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_5bfff0d567dbe' => array(
					'key' => 'layout_5bfff0d567dbe',
					'name' => 'clients',
					'label' => 'Clients',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5bfff0e667dbf',
							'label' => 'Menu Title',
							'name' => 'menu_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bfff0ff67dc0',
							'label' => 'Introduction',
							'name' => 'introduction',
							'type' => 'textarea',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => '',
						),
						array(
							'key' => 'field_5bfff10f67dc1',
							'label' => 'Client',
							'name' => 'client',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'collapsed' => '',
							'min' => 0,
							'max' => 0,
							'layout' => 'block',
							'button_label' => '',
							'sub_fields' => array(
								array(
									'key' => 'field_5bfff11a67dc2',
									'label' => 'Client Name',
									'name' => 'client_name',
									'type' => 'text',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'maxlength' => '',
								),
								array(
									'key' => 'field_5bfff13267dc3',
									'label' => 'Client Logo',
									'name' => 'client_logo',
									'type' => 'image',
									'instructions' => 'Upload as a white image - the code will invert the colour according to theme colour choice',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'return_format' => 'array',
									'preview_size' => 'thumbnail',
									'library' => 'all',
									'min_width' => '',
									'min_height' => '',
									'min_size' => '',
									'max_width' => '',
									'max_height' => '',
									'max_size' => '',
									'mime_types' => '',
								),
								array(
									'key' => 'field_5bfff15267dc4',
									'label' => 'Client Link',
									'name' => 'client_link',
									'type' => 'text',
									'instructions' => 'Enter as https://site.name',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'maxlength' => '',
								),
							),
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_5bfff19bba587' => array(
					'key' => 'layout_5bfff19bba587',
					'name' => 'team',
					'label' => 'Team',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5bfff1c5ba58a',
							'label' => 'Menu Title',
							'name' => 'menu_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bfff1a4ba588',
							'label' => 'Team Member',
							'name' => 'team_member',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'collapsed' => '',
							'min' => 0,
							'max' => 0,
							'layout' => 'table',
							'button_label' => '',
							'sub_fields' => array(
								array(
									'key' => 'field_5bfff1c0ba589',
									'label' => 'Team Member Name',
									'name' => 'team_member_name',
									'type' => 'text',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'maxlength' => '',
								),
								array(
									'key' => 'field_5bfff1f2ba58b',
									'label' => 'Team Member Title',
									'name' => 'team_member_title',
									'type' => 'textarea',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'maxlength' => '',
									'rows' => 2,
									'new_lines' => 'br',
								),
								array(
									'key' => 'field_5bfff1feba58c',
									'label' => 'Team Member Description',
									'name' => 'team_member_description',
									'type' => 'textarea',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'maxlength' => '',
									'rows' => '',
									'new_lines' => 'br',
								),
							),
						),
					),
					'min' => '',
					'max' => '',
				),
				'layout_5bfff236ba58d' => array(
					'key' => 'layout_5bfff236ba58d',
					'name' => 'contact',
					'label' => 'Contact',
					'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_5c1117155ac37',
							'label' => 'Menu Title',
							'name' => 'menu_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bfff2feba592',
							'label' => 'Postal Address Title',
							'name' => 'postal_address_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bfff2abba590',
							'label' => 'Postal Address',
							'name' => 'postal_address',
							'type' => 'textarea',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => '',
						),
						array(
							'key' => 'field_5bfff244ba58f',
							'label' => 'Email Address',
							'name' => 'email_address',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bfff327ba593',
							'label' => 'Email Subject Title',
							'name' => 'email_subject_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5bfff2f6ba591',
							'label' => 'Phone Number',
							'name' => 'phone_number',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5c2a56097306b',
							'label' => 'Activate Map',
							'name' => 'map',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => '',
							'ui_off_text' => '',
						),
					),
					'min' => '',
					'max' => '',
				),
			),
			'button_label' => 'Add Content Block',
			'min' => '',
			'max' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page',
				'operator' => '==',
				'value' => '6',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
		1 => 'excerpt',
		2 => 'discussion',
		3 => 'comments',
		4 => 'format',
		5 => 'page_attributes',
		6 => 'featured_image',
		7 => 'categories',
		8 => 'tags',
		9 => 'send-trackbacks',
	),
	'active' => true,
	'description' => '',
));

endif;
// END ACF FIELDS


?>
