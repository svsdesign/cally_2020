<?php
/**
 *  cally_2020
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  
 */
 
// Require our CPTs
require 'inc/post-types.php';
// Include helps and customisation files
include 'inc/customisations.php';
include 'inc/helpers.php';
include 'inc/blocks.php';


// Constant definitions
define('TXTDOMAIN', 'cally_2020');


// Enable the option show in rest
add_filter( 'acf/rest_api/field_settings/show_in_rest', '__return_true' );

// Enable the option edit in rest
add_filter( 'acf/rest_api/field_settings/edit_in_rest', '__return_true' );

//and also that you have activated fields in rest api as depicted in image below.

function svs_add_crossorigina( $tag, $handle ) {
    if ( TXTDOMAIN .'-polyfill' === $handle ) {
        return str_replace( "src", "crossorigin='anonymous' src", $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'svs_add_crossorigina', 10, 2 );


function cally_2020_style() {   
wp_enqueue_style( 'style', get_stylesheet_uri() );
}
// add_action( 'wp_enqueue_scripts', 'cally_2020_style' );


// Add theme gulp'ed & minified CSS/JS
function svs_add_theme_files() {

    wp_enqueue_media(); // front end WP media scripts
	
    if ( !is_admin() ) :
        // Remove as we don't want WP built it jQuery
		wp_deregister_script( 'jquery' );
		
		//remove jquery ui script as its clashing with Discuz and my script equeue below
	 	wp_deregister_script( 'jquery-ui-core' );
		//But have added back in again, because was causing issue with front end; seem to al lwork at
		//if not maybe try and move wp_enqueue_media() from above to somewhere else after?		
		
		// /wp-includes/js/plupload/plupload.js
		
    endif;

    // Main budkled site styles
    wp_enqueue_style( TXTDOMAIN .'-style', get_template_directory_uri() .'/dist/css/style.min.css', null, filemtime( get_stylesheet_directory() .'/dist/css/style.min.css' ) );

    // Pull in any vendors styles and site app
    // wp_enqueue_style( TXTDOMAIN .'-aos-css', '//unpkg.com/aos@2.3.1/dist/aos.css', null, null, false );

    // Browserify & jQuery for local development
    if ( $_SERVER['REMOTE_ADDR'] === '::1' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ):

        wp_enqueue_script( 'jquery', get_template_directory_uri() .'/dist/js/jquery.js', array(), null, false );
     	wp_enqueue_script( 'jquery ui', get_template_directory_uri() .'/dist/js/jquery-ui.min.js', array(), null, false );
        wp_enqueue_script( '__bs_script__', 'http://'. $_SERVER['SERVER_NAME'] .':3000/browser-sync/browser-sync-client.js', array(), '2.17.3', true );
 
    else:

       wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array(), null, false );
	   wp_enqueue_script( 'jquery ui', get_template_directory_uri() .'/dist/js/jquery-ui.min.js', array(), null, false );
 
    endif;

    // Pull in any vendors scripts and site app
    // wp_enqueue_script( TXTDOMAIN .'-gsap', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js', null, null, true );
    wp_enqueue_script( TXTDOMAIN .'-polyfill', '//polyfill.io/v3/polyfill.min.js?features=default%2CArray.prototype.find%2CIntersectionObserver', null, null, true ); // review this - is it needed?
    // wp_enqueue_script( TXTDOMAIN .'-aos', '//unpkg.com/aos@2.3.1/dist/aos.js', null, '2.3.1', true );
    wp_enqueue_script( TXTDOMAIN .'-vendors', get_template_directory_uri() .'/dist/js/vendors.min.js', array('jquery'), filemtime( get_stylesheet_directory().'/dist/js/vendors.min.js' ), true );
    // wp_enqueue_script( TXTDOMAIN .'-app', get_template_directory_uri() .'/dist/js/app.min.js', array('jquery', TXTDOMAIN .'-vendors', 'wp-mediaelement','media-upload','wp-plupload-all'), filemtime( get_stylesheet_directory().'/dist/js/app.min.js' ), true );
    wp_enqueue_script( TXTDOMAIN .'-app', get_template_directory_uri() .'/dist/js/app.min.js', array('jquery', TXTDOMAIN .'-vendors'), filemtime( get_stylesheet_directory().'/dist/js/app.min.js' ), true );

    // Localise our app scipt above with any PHP/site variables we may need
    $theme_vars = array(
        'base_url' => home_url(),
        'template_url' => get_stylesheet_directory_uri(),
        'root' => esc_url_raw( rest_url() ),
        'nonce' => wp_create_nonce( 'wp_rest' )
    );
    wp_localize_script( TXTDOMAIN .'-app', 'WP_settings', $theme_vars );


	
}
add_action( 'wp_enqueue_scripts', 'svs_add_theme_files' );




function svs_admin_enqueue_scripts() {

	wp_enqueue_script( TXTDOMAIN .'-app-admin', get_template_directory_uri() . '/dist/js/app.admin.min.js', array('jquery'), filemtime( get_stylesheet_directory().'/dist/js/app.admin.min.js' ), true );

}
add_action('acf/input/admin_enqueue_scripts', 'svs_admin_enqueue_scripts');

//do_action( 'wp_enqueue_media' );



function svs_admin_block_assets() {

	//wp_enqueue_style('admin-artist-block',''.get_stylesheet_directory_uri().'/template-parts/blocks/inpartist/assets/css/style.css', array(), '1');
	wp_enqueue_style('admin-blocks',''.get_stylesheet_directory_uri().'/dist/css/admin.style.min.css', array(), '1');
 	//enquire js
	// wp_enqueue_script('th-admin-enquire', ''.get_stylesheet_directory_uri().'/assets/js/enquire.js', array( 'jquery' ), '', true );


	 // admin js: - review
	//   wp_enqueue_script('inp-admin-site', ''.get_stylesheet_directory_uri().'/dist/js/app.admin.min.js', array( 'jquery' ), '', true );

}
add_action( 'enqueue_block_editor_assets', 'svs_admin_block_assets' );



/* 

TOD O - ensure the headroom scripts are added to the vendords

function site_scripts() {

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

wp_enqueue_script( 'site', get_template_directory_uri() . '/assets/js/site.js', array('jquery'), false, true );

}

add_action( 'wp_enqueue_scripts', 'site_scripts' );
*/

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
    echo'<link rel="icon" type="image/png" sizes="32x32" href="'. $favicon_url .'/assets/site-icons/back-end/favicon-32x32.png">';
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
// Delete this I think

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
//  add_action( 'enqueue_block_editor_assets', 'my_admin_block_assets' );
 
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





//start svs added - as part of acf api:
function _checked( $haystack, $current, $echo = true ) {
	if ( is_array( $haystack ) ) {
		if ( in_array( $current, $haystack ) ) {
			$current = $haystack = true;
		} else {
			$current = ! ( $haystack = true );
		}
	}

	return checked( $haystack, $current, $echo );
}
//end svs added - as part of acf api:


/*
 * Add filter attribute 
 */

add_filter( 'walker_nav_menu_start_el', 'modify_walker_data_attr', 10, 4);

function modify_walker_data_attr( $item_output, $item, $depth, $args )
{

    // I use ACF for adding field to a menu item
    // https://www.advancedcustomfields.com/resources/adding-fields-menu-items/
	$data_hover = get_field('prevent', $item);
	


	$old = '<a';
	if (!empty($data_hover)) {
    $new = '<a data-barba-prevent="'.$data_hover.'" ';
	}else{
	$new = '<a';
	}

    $item_output = str_replace($old, $new, $item_output);

	return $item_output;
	

}
//ACF COMMENTS

 
	//news
	function my_news_comment_template( $comment, $args, $depth ) {
 	?>
 
		<div class="comment">

			<?php  
			// $comment_id = "comment_".$comment."";
			$testfield = get_field('test', $comment);
			if( $testfield ): ?>
 		
			<?php echo $testfield ;?>

			<?php endif; ?>
			<br>
			<?php 
			$testfield2 = get_field('field_test', $comment);
			if( $testfield2 ): ?>
 
 			<?php echo $testfield2 ;?>

			<?php endif; ?>
			<br>
			<?php
			$tags = get_field('test_tag', $comment);?>
				<?php if( $tags ): ?>
 			<ul>
			 <?php echo $tags ;?>

			</ul>
			<br>
			<?php endif;  ?>

			<?php if( get_field('image_test', $comment) ): ?>
 				<img src="<?php the_field('image_test', $comment); ?>" />
			
			<?php endif; ?>
		
		</div>
		
		<?php
	}
 
	
	
// grid template
// review this - delete it probably not needed anymore
	function my_gridpage_comment_template( $comment, $args, $depth ) {
	?>

		<div class="comment">
		a comment

			<?php  
			// $comment_id = "comment_".$comment."";
			$testfield = get_field('test', $comment);
			if( $testfield ): ?>
		
			<?php echo $testfield ;?>

			<?php endif; ?>
			<br>
			
			<?php  
			// $comment_id = "comment_".$comment."";
			$testfield = get_field('an_image_test', $comment);

			if( $testfield ): ?>

				<img src="<?php the_field('an_image_test', $comment); ?>" />
			
			<?php endif; ?>
		
		</div>
		
	<?php
}


//END ACF COMMENTS



add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet', 20 );
function remove_default_stylesheet() {
      wp_dequeue_style( 'cookie-notice-front' ); // cookie notice plugin
}



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

 

//add_action('init’, ‘register_field_group');
/*
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
		array(
			'key' => 'field_5c1a88e680beb',
			'label' => 'Keep Intro Logo Visible',
			'name' => 'keep_intro_logo',
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
				'no' => 'No',
				'yes' => 'Yes',
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
*/
/*
//This converst the php imports to the json file:
// get all the local field groups 
$field_groups = acf_get_local_field_groups();

// loop over each of the gield gruops 
foreach( $field_groups as $field_group ) {

	// get the field group key 
	$key = $field_group['key'];

	// if this field group has fields 
	if( acf_have_local_fields( $key ) ) {
	
      	// append the fields 
		$field_group['fields'] = acf_get_local_fields( $key );

	}

	// save the acf-json file to the acf-json dir by default 
	acf_write_json_field_group( $field_group );

}
*/


/* Add custom post type to USP Meta Box - delet this pronbably nnot using it anymore
function usp_meta_box_custom_post_types($post_types) {
	
	array_push($post_types, 'news'); // change 'book' to your custom post type
	
	return $post_types;
	
}
add_filter('usp_meta_box_post_types', 'usp_meta_box_custom_post_types');
*/
?>		
 
