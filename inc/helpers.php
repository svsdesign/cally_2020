<?php

if( !function_exists( 'echo_array' ) ) :
    function echo_array( $array ) {
        echo '<pre>';
        print_r( $array );
        echo '</pre>';
    }
endif;

function mttd_get_id_by_slug( $page_slug ) {

    $page = get_page_by_path($page_slug);

    if ($page) return $page->ID;

    return null;

}

// Orders the videos array of projects in the order of placement for access while looping
/*function video_order($a,$b) {
    return ($a["video_placement_id"] <= $b["video_placement_id"]) ? -1 : 1;
}
*/

function error_check( $items ) {

    if( ( is_object( $items ) && is_wp_error( $items ) ) || ( is_array( $items ) && empty( $items )  ) ):

        die('Argument passed is not a WP object.');

    endif;
}

if( !function_exists( 'return_clean_url' ) ) :

    function return_clean_url( $url ) {

        // in case scheme relative URI is passed, e.g., //www.google.com/
        $url = trim($url, '/');

        // If scheme not included, prepend it
        if (!preg_match('#^http(s)?://#', $url)) :

            $url = 'http://' . $url;

        endif;

        $url_parts = parse_url( $url );

        // remove www
        $domain = preg_replace('/^www\./', '', $url_parts['host']);

        return $domain;

    }

endif;

if( !function_exists( 'break_email' ) ) :

    function break_email( $email ) {

        $email = trim($email);
        $parts = explode('@', $email);
        $place = trim( $parts[0] );
        $domain = trim( $parts[1] );

        return trim( $place . '<wbr>@' . $domain );

    }

endif;

if( !function_exists( 'remove_extra_spaces' ) ) :
    function remove_extra_spaces( $str ) {

        $output = trim(preg_replace('/(\s\s+|\t|\n)/', ' ', $str));

        return $output;

    }
endif;

if( !function_exists( 'get_attributes' ) ) :
    function get_attributes( $html = '<div></div>' ) {

        // http://stackoverflow.com/questions/34199944/how-can-i-get-all-attributes-with-php-xpath/34201029#34201029

        $output = array();
        $html = str_replace('&','&amp;', $html);
        $dom = new DOMDocument();
        $dom->loadHTML(trim($html));
        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query('//div/@*');

        foreach ($nodes as $node) {
            $output[$node->nodeName] = $node->nodeValue;
        }

        return $output;

    }
endif;