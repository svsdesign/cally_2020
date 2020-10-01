<?php

// Add WP-admin customisations

function mttd_save_image_data($image_data) {
    $post_id = get_the_ID();

    if (preg_match('/^data:image\/(\w+);base64,/', $image_data, $type)) {
        $image_data = substr($image_data, strpos($image_data, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif

        if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
            throw new \Exception('invalid image type');
        }
        $image_data = str_replace( ' ', '+', $image_data );
        $image_data = base64_decode($image_data);

        if ($image_data === false) {
            throw new \Exception('base64_decode failed');
        }
    } else {
        throw new \Exception('did not match data URI with image data');
    }

    $filename = "submission-{$post_id}.{$type}";

    // file_put_contents($filename, $image_data);


    $upload_dir = wp_upload_dir();

    if ( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
    }
    else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }

    file_put_contents( $file, $image_data );

    $wp_filetype = wp_check_filetype( $filename, null );

    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name( $filename ),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $file );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    return $attach_id;
}

function my_acf_load_field( $field ) {
    if( $field['name'] == 'image-data_hidden_field' ) :

        if( get_field('an_image_test') == '' ):

            $image_data = get_field('image-data_hidden_field');
            $attachment_id = mttd_save_image_data( $image_data );

            update_field('an_image_test', $attachment_id);

        endif;
    endif;

    // $attachment_id

    return $field;
}

// Apply to all fields.
// add_filter('acf/load_field', 'my_acf_load_field');

// Apply to select fields.
// add_filter('acf/load_field/type=select', 'my_acf_load_field');

// Apply to fields named "custom_select".
add_filter('acf/load_field', 'my_acf_load_field');

// Hide coordinates field
add_filter('acf/prepare_field/name=coordinates', 'mttd_hide_acf_fields');
function mttd_hide_acf_fields( $field ) {

	switch($field['_name']) :
		// Which field are we looking for?
		case 'coordinates':
            // Set the CLASS of the field to use css to hide
            $field['wrapper']['style'] = 'display: none';
        break;
		default:
        break;

    endswitch;

    return $field;
}

// Capture pre-sanitised filename for images
add_action( 'wp_handle_upload_prefilter', '_remember_presanitized_filename' );
function _remember_presanitized_filename( $file ) {
    $file_parts = pathinfo( $file['name'] );
    set_transient( '_set_attachment_title', $file_parts['filename'], 30 );
    return $file;
}
/*
add_action( 'add_attachment', '_set_attachment_title' );
function _set_attachment_title( $attachment_id ) {
    $title = get_transient( '_set_attachment_title' );
    if ( $title ) {

        // to update attachment title and caption
        wp_update_post( array( 'ID' => $attachment_id, 'post_title' => $title, 'post_excerpt' => $title ) );

        // to update other metadata
        update_post_meta( $attachment_id, '_wp_attachment_image_alt', $title );

        // delete the transient for this upload
        delete_transient( '_set_attachment_title' );
    }
}
*/
/*
// Default user theme
function set_default_admin_color($user_id) {
    $args = array(
        'ID' => $user_id,
        'admin_color' => 'midnight'
    );
    wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');
*/
/*
// Set featured image as the ACF image
function acf_set_featured_image( $value, $post_id, $field ) {

    if($value != '') :

        add_post_meta($post_id, '_thumbnail_id', $value);

    endif;

    return $value;
}
// add_filter('acf/update_value/name=featured_landscape', 'acf_set_featured_image', 10, 3);
*/
/*
// Check if Yoast is installed
if(in_array('plugin-directory/wordpress-seo/wp-seo.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    // Disable the WPSEO v3.1+ Primary Category feature.

    add_filter( 'wpseo_primary_term_taxonomies', '__return_empty_array' );
    remove_action( 'admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
    remove_action( 'all_admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );

    //Disable the WPSEO v3.1+ Primary Category feature.

    add_filter( 'wpseo_primary_term_taxonomies', '__return_empty_array' );
}
*/
/*
// Is blog?
function is_blog() {
    global $post;
    $posttype = get_post_type( $post );
    return ( ( $posttype == 'post' ) && ( is_home() || is_single() || is_archive() || is_category() || is_tag() || is_author() ) ) ? true : false;
}

function mttd_fix_blog_current_class_cpt( $classes, $item, $args ) {
    global $post;

    if( !is_blog() ) {
        $blog_page_id = intval( get_option('page_for_posts') );
        if( $blog_page_id != 0 && $item->object_id == $blog_page_id ) :

            unset($classes[array_search('current_page_parent', $classes)]);

        endif;
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'mttd_fix_blog_current_class_cpt', 10, 3 );
*/

function mttd_footer_admin () {

    echo 'By <a href="https://svs.design">svs.design</a>';

}
/*
function mttd_add_editor_styles() {

    add_editor_style();

}
*/
/*
function mttd_custom_image_size() {
    // Set default values for the upload media box
    // update_option('image_default_align', 'center' );
    update_option('image_default_size', '16-9-large' );

}
// add_action('after_setup_theme', 'mttd_custom_image_size');
*/
/*
function mttd_add_editor_fonts() {

    $font_url = str_replace(',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic:latin');
    add_editor_style( $font_url );

}
*/
/*
//TODO Add FM logo to admin login
function mttd_login_logo() {
    ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?= get_stylesheet_directory_uri(); ?>/logo.svg);
            background-size: 100%;
            width: 300px;
            height: 90px;
        }
        body #g-recaptcha-0 {
            margin-bottom: 20px;
        }
    </style>
<?php
}
*/
// add_action( 'login_enqueue_scripts', 'mttd_login_logo' );
/*
function mttd_admin_url() {
    return home_url();
}
add_filter('login_headerurl', 'mttd_admin_url');
add_filter('admin_footer_text', 'mttd_footer_admin');

add_action('admin_init', 'mttd_add_editor_styles');
add_action('after_setup_theme', 'mttd_add_editor_fonts');

remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'check_and_publish_future_post');
remove_action('wp_head', 'wp_print_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('wp_print_styles', 'print_emoji_styles' );
*/
/*
// remove script handles we don't need, each with their own conditions
//add_action('wp_print_scripts', 'mttd_remove_scripts', 100000);
//add_action('wp_print_footer_scripts',  'mttd_remove_scripts', 100000);

function mttd_remove_scripts(){

    if( !is_admin() ) :
        // Remove jQuery script effects
        wp_deregister_script("jquery-ui-core");
        wp_deregister_script("jquery-effects-core");
        wp_deregister_script("jquery-effects-shake");

        wp_dequeue_script("jquery-ui-core");
        wp_dequeue_script("jquery-effects-core");
        wp_dequeue_script("jquery-effects-shake");
    endif;
}
function mttd_remove_styles(){

    if( !is_admin() ) :
        // wp_deregister_style('wppas_php_style');
        // wp_dequeue_style('wppas_php_style');
    endif;
}

// remove styles we don't need
add_action('wp_print_styles', 'mttd_remove_styles', 100000);
add_action('wp_print_footer_scripts', 'mttd_remove_styles', 100000);

*/
