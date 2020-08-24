<?php /* remnove default post
https://wordpress.stackexchange.com/questions/293148/how-do-i-remove-the-default-post-type-from-the-admin-toolbar
 */
 
function remove_default_post_type() {
    remove_menu_page('edit.php');
}

add_action('admin_menu','remove_default_post_type');





    /* MAP SEGMENTS */
 
    function post_type_segments() {
  
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'segments', 'Post Type General Name', 'cally' ),
            'singular_name'       => _x( 'segment', 'Post Type Singular Name', 'cally' ),
            'menu_name'           => __( 'segments', 'cally' ),
            'parent_item_colon'   => __( 'segments', 'cally' ),
            'all_items'           => __( 'All segments', 'cally' ),
            'view_item'           => __( 'View segments', 'cally' ),
            'add_new_item'        => __( 'Add New segments', 'cally' ),
            'add_new'             => __( 'Add New', 'cally' ),
            'edit_item'           => __( 'Edit segments', 'cally' ),
            'update_item'         => __( 'Update segments', 'cally' ),
            'search_items'        => __( 'Search segments', 'cally' ),
            'not_found'           => __( 'Not Found', 'cally' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'cally' ),
        );
         
        // Set other options for Custom Post Type
         
        $args = array(
            // 'label'               => __( 'segments', 'cally' ),
            // 'description'         => __( 'Cally Label segments', 'cally' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'taxonomies' => array('post_tag','category'),
            'show_in_rest' => true,
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'revisions'),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
          //'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            '_builtin' => false, // It's a custom post type, not built in
            '_edit_link' => 'post.php?post=%d',
            'capability_type' => 'post',
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
          //  'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            // 'query_var'           => true,
            // 'rewrite' => array('slug' => 'segments', 'with_front' => true ),
            $rewrite = array(
                'slug'                  => 'segments',
                'with_front'            => true,
                'pages'                 => true,
                'feeds'                 => true,
            ),
            'rewrite' =>  $rewrite,
            // 'query_var'           => 'post_type',//false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true
         );
         
        // Registering your Custom Post Type
    //  flush_rewrite_rules(false);
    //  flush_rewrite_rules();
   
        register_post_type( 'segments', $args );
   
    }
    
   
     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'post_type_segments' );






    /* NEWS */
 
    function post_type_news() {
     
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'News', 'Post Type General Name', 'cally' ),
            'singular_name'       => _x( 'News', 'Post Type Singular Name', 'cally' ),
            'menu_name'           => __( 'News', 'cally' ),
            'parent_item_colon'   => __( 'News', 'cally' ),
            'all_items'           => __( 'All News', 'cally' ),
            'view_item'           => __( 'View News', 'cally' ),
            'add_new_item'        => __( 'Add New News', 'cally' ),
            'add_new'             => __( 'Add New', 'cally' ),
            'edit_item'           => __( 'Edit News', 'cally' ),
            'update_item'         => __( 'Update News', 'cally' ),
            'search_items'        => __( 'Search News', 'cally' ),
            'not_found'           => __( 'Not Found', 'cally' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'cally' ),
        );
         
        // Set other options for Custom Post Type
         
        $args = array(
            // 'label'               => __( 'News', 'cally' ),
            // 'description'         => __( 'Cally Label News', 'cally' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'taxonomies' => array('post_tag','category'),
            'show_in_rest' => true,
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'revisions', 'comments'),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
          //'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            '_builtin' => false, // It's a custom post type, not built in
            '_edit_link' => 'post.php?post=%d',
            'capability_type' => 'post',
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
          //  'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            // 'query_var'           => true,
            // 'rewrite' => array('slug' => 'news', 'with_front' => true ),
            $rewrite = array(
                'slug'                  => 'news',
                'with_front'            => true,
                'pages'                 => true,
                'feeds'                 => true,
            ),
            'rewrite' =>  $rewrite,
            // 'query_var'           => 'post_type',//false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true
         );
         
        // Registering your Custom Post Type
    //  flush_rewrite_rules(false);
    //  flush_rewrite_rules();
 
        register_post_type( 'news', $args );

    }
    

     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'post_type_news' );
 
    
    /* MAP SUBMISSION */
 
 function post_type_submissions() {

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'submissions', 'Post Type General Name', 'cally' ),
        'singular_name'       => _x( 'submission', 'Post Type Singular Name', 'cally' ),
        'menu_name'           => __( 'Submissions', 'cally' ),
        'parent_item_colon'   => __( 'submissions', 'cally' ),
        'all_items'           => __( 'All submissions', 'cally' ),
        'view_item'           => __( 'View submissions', 'cally' ),
        'add_new_item'        => __( 'Add New submissions', 'cally' ),
        'add_new'             => __( 'Add New', 'cally' ),
        'edit_item'           => __( 'Edit submissions', 'cally' ),
        'update_item'         => __( 'Update submissions', 'cally' ),
        'search_items'        => __( 'Search submissions', 'cally' ),
        'not_found'           => __( 'Not Found', 'cally' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'cally' ),
    );
     
    // Set other options for Custom Post Type
     
    $args = array(
        // 'label'               => __( 'submissions', 'cally' ),
        // 'description'         => __( 'Cally Label submissions', 'cally' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'taxonomies' => array('post_tag','category'),
        'show_in_rest' => true,
        'supports' => array( 'title', 'author', 'revisions'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
      //'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        '_builtin' => false, // It's a custom post type, not built in
        '_edit_link' => 'post.php?post=%d',
        'capability_type' => 'post',
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
      //  'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        // 'query_var'           => true,
        // 'rewrite' => array('slug' => 'submissions', 'with_front' => true ),
        $rewrite = array(
            'slug'                  => 'submissions',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        ),
        'rewrite' =>  $rewrite,
        // 'query_var'           => 'post_type',//false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true
     );
     
    // Registering your Custom Post Type
//  flush_rewrite_rules(false);
//  flush_rewrite_rules();

    register_post_type( 'submissions', $args );

}


 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'post_type_submissions' );





 /*   add_action( 'pre_get_posts', function ( $query ) {
        if ( $query->is_post_type_archive( 'news' ) && $query->is_main_query() && ! is_admin() ) {
          $query->set( 'posts_per_page', 7 );
        }
      } );
      */
   /* add_action( 'pre_get_posts', function ( $q ) {

        if( !is_admin() && $q->is_main_query() && $q->is_post_type_archive( 'news' ) ) {
    
            $q->set( 'posts_per_page', 5 );
    
        }
    
    });*/
 /*
    function custom_posts_per_page( $query ) {

        if ( $query->is_archive('news') ) {
            set_query_var('posts_per_page', 5);
        }
        }
        add_action( 'pre_get_posts', 'custom_posts_per_page' );*/

    /*
    add_action( 'pre_get_posts' ,'wpse222471_query_post_type_news', 1, 1 );
    function wpse222471_query_post_type_portofolio( $query )
    {
        if ( ! is_admin() && is_post_type_archive( 'news' ) && $query->is_main_query() )
        {
            $query->set( 'posts_per_page', 5 ); //set query arg ( key, value )
        }
    }*/


/*
 
function set_posts_per_page_for_news( $news_query ) {
    if ( !is_admin() &&  $news_query ->is_main_query() && is_post_type_archive( 'news' ) ) {
      $news_query->set( 'posts_per_page', '6' );
    }
  }
  add_action( 'pre_get_posts', 'set_posts_per_page_for_news' );
 */
  
/*
    add_action( 'parse_query','changept' );
    function changept() {
        if( is_category() && !is_admin() )
            // set_query_var( 'post_type', array( 'post', 'your_custom_type' ) );
            set_query_var( 'post_type', array( 'post', 'news' ) );

            return;
    }
*/

    /**
 * Fix pagination on archive pages
 * After adding a rewrite rule, go to Settings > Permalinks and click Save to flush the rules cache
 */
/*
function my_pagination_rewrite() {
    add_rewrite_rule('news/page/?([0-9]{1,})/?$', 'index.php?category_name=blog&paged=$matches[1]', 'top');
}
 

    add_action('init', 'my_pagination_rewrite');
*/

// Bi DIRECTIONAL POST RELATION
//https://www.advancedcustomfields.com/resources/bidirectional-relationships/
//

function bidirectional_acf_update_value( $value, $post_id, $field  ) {

	// vars
	$field_name = $field['name'];
	$field_key = $field['key'];
	$global_name = 'is_updating_' . $field_name;

	// bail early if this filter was triggered from the update_field() function called within the loop below
	// - this prevents an inifinte loop
	if( !empty($GLOBALS[ $global_name ]) ) return $value;

	// set global variable to avoid inifite loop
	// - could also remove_filter() then add_filter() again, but this is simpler
	$GLOBALS[ $global_name ] = 1;

	// loop over selected posts and add this $post_id
	if( is_array($value) ) :

		foreach( $value as $post_id2 ) :

			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);

			// allow for selected posts to not contain a value
			if( empty($value2) ) {

				$value2 = array();

			}

			// bail early if the current $post_id is already found in selected post's $value2
			if( in_array($post_id, $value2) ) continue;

			// append the current $post_id to the selected post's 'related_posts' value
			$value2[] = $post_id;

			// update the selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);

		endforeach;

	endif;


	// find posts which have been removed
	$old_value = get_field($field_name, $post_id, false);

	if( is_array($old_value) ) :

		foreach( $old_value as $post_id2 ) :

			// bail early if this value has not been removed
			if( is_array($value) && in_array($post_id2, $value) ) continue;

			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);

			// bail early if no value
			if( empty($value2) ) continue;

			// find the position of $post_id within $value2 so we can remove it
			$pos = array_search($post_id, $value2);

			// remove
			unset( $value2[ $pos] );

			// update the un-selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);

        endforeach;

	endif;

	// reset global varibale to allow this filter to function as per normal
	$GLOBALS[ $global_name ] = 0;

	// return
    return $value;

}
add_filter('acf/update_value/name=related_posts', 'bidirectional_acf_update_value', 10, 3);


?>