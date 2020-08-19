<?php



// ACF CUSTOM FIELDS

//include_once( get_stylesheet_directory() .'/acf-fields.php'); not using this; using JSON Instead:
// https://www.advancedcustomfields.com/resources/local-json/


//END ACF CUSTOM FIELDS




function my_acf_init() {
    
    // check function exists
    if( function_exists('acf_register_block') ) {
        
 
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

		// one column: Text Header

        acf_register_block(array(
            'name'              => 'thonecolheader', //th_one_col
            'title'             => __('Text - One Column Header'),
            'description'       => __('Text - One Column Header'), // review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',// https://www.advancedcustomfields.com/resources/acf_register_block_type/ + https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
            'enqueue_assets'    => function(){
            //  wp_enqueue_script('inp-text-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/inptext/assets/js/script.js', array( 'jquery' ), '', true );
            },
            'icon'              => 'admin-comments',//https://developer.wordpress.org/resource/dashicons/
            'keywords'          => array('thonecolheader'),
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
              wp_enqueue_script('th-multi-col-image', ''.get_stylesheet_directory_uri().'/template-parts/blocks/thmulticolimage/assets/js/script.js', array( 'jquery' ), '', true );
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
              wp_enqueue_script('th-two-col-text-image', ''.get_stylesheet_directory_uri().'/template-parts/blocks/thtwocoltextimage/assets/js/script.js', array( 'jquery' ), '', true );
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



        // register slideshow block:
        // https://www.advancedcustomfields.com/resources/acf_register_block_type/#examples
        acf_register_block(array(
            'name'              => 'thslideshow',
            'title'             => __('Slide Show'),
            'description'       => __('Slide Show'),// review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
            // 'enqueue_script'    => '',

            'enqueue_assets'    => function(){
            //  wp_enqueue_script('flickity-pgkd','https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array('jquery'), false, true);
            //  wp_enqueue_style( 'flickity styles', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css' );
            //  wp_enqueue_style( 'flickity-style', 'https://npmcdn.com/flickity@2.2.1/dist/flickity.css'); // Styles moved into "block-gallery.scss"
            //  wp_enqueue_script('flickity-pgkd', 'https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array( 'jquery' ), '', true ); // 
             wp_enqueue_script('flickity-pgkd', 'https://npmcdn.com/flickity@2/dist/flickity.pkgd.js', array( 'jquery' ), '', true );
             wp_enqueue_script('th-slide-show-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/thslideshow/assets/js/script.js', array( 'jquery' ), '', true );

            },

            'icon'              => 'format-gallery',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'          => array( 'mode' => false ),
            'keywords'          => array( 'thslideshow'),
        ));


        // register contact block:

        acf_register_block(array(
            'name'              => 'thcontact',
            'title'             => __('Contact'),
            'description'       => __('Contact'),// review this
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
          //  'enqueue_script'    => '',
            'enqueue_assets'    => function(){
            wp_enqueue_script('th-contact-script', ''.get_stylesheet_directory_uri().'/template-parts/blocks/thcontact/assets/js/script.js', array( 'jquery' ), '', true );
            },

            'icon'              => 'admin-comments',
          //'mode'              => 'preview',//"auto" or "preview" This lets you control how the block is presented the Gutenberg block editor. The default is “auto” which renders the block to match the frontend until you select it, then it becomes an editor. If set to “preview” it will always look like the frontend and you can edit content in the sidebar.
            'supports'          => array( 'mode' => false ),
            'keywords'          => array( 'thcontact'),
        ));

        // register video block:

        acf_register_block(array(
            'name'              => 'thvideo',
            'title'             => __('Video'),
            'description'       => __('Video'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'common',
          //  'enqueue_script'    => '',

            'enqueue_assets'    => function(){
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







/* END BLOCKS */




//Guttenberg additions

/**
 * Disable Editor
 *
 * @package      ClientName
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Templates and Page IDs without editor
 *
 */
function ea_disable_editor( $id = false ) {

	$excluded_templates = array(
		'page-grid.php'//,
		//'templates/contact.php'
	);

	$excluded_ids = array(
         get_option( 'page_on_front' ), // home = 237
         120  //projects = 120
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function ea_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( ea_disable_editor( $_GET['post'] ) )
        $can_edit = false;

    if ($post_type === 'projects')
        return false;

	return $can_edit;

}

// TO DO - review these exclusions:

// add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
// add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );

/**
 * Disable Classic Editor by template
 *
 */

function ea_disable_classic_editor() {

	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;

	if( ea_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

}
// TO DO - review these exclusions:
// add_action( 'admin_head', 'ea_disable_classic_editor' );


/**
 * Allow Block options
 *
 */

//TO DO - review this based on the theseus blocks + other still to be added
function allowed_block_types( $allowed_blocks, $post ) {

	$allowed_blocks = array(
	//	'core/image',
		// 'core/paragraph',
	//	'core/heading',
    //	'core/list'
     //   'templates/blocks/informationtext' // doesnt work
        'acf/informationtext'
	);

/*	if( $post->post_type === 'page' ) {
		$allowed_blocks[] = 'core/shortcode';
	}
 */
	return $allowed_blocks;

}
// add_filter( 'allowed_block_types', 'allowed_block_types', 10, 2 );

//https://stackoverflow.com/questions/54203925/remove-embedded-stylesheet-for-gutenberg-editor-on-the-back-end
add_filter( 'block_editor_settings' , 'remove_guten_wrapper_styles' );
function remove_guten_wrapper_styles( $settings ) {
    unset($settings['styles'][0]);
    return $settings;
}

?>