<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 * 
 * 
 * 
 * TO DO: tidy this up - its a c&p from tbe Twenty_Thirteen WP theme 
 * - Issues with BARBAjs:
 * relative topics
 * 
 * https://github.com/barbajs/barba/issues/122
 * 
 * 
 * 
 */
 //https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/comment-template/
//https://rudrastyh.com/wordpress/ajax-comments.html


//https://www.choosepizzi.net/wordpress-solve-ajax-conflicts-between-gravityform-and-barbajs/


// JETPACK: https://www.fjobeir.com/implement-barba-js-with-wordpress/
// is this in an iframe as well?



//https://winningwp.com/best-commenting-plugins-for-wordpress/


//VERy interesting:
// https://thisisadvantage.com/page-transitions-using-barba-js-wordpress-elementor/

//Rich text editor on comments
// https://wordpress.stackexchange.com/questions/22415/use-rich-text-editor-in-comments


//acf

//https://www.advancedcustomfields.com/resources/get-values-comment/
//https://wordpress.stackexchange.com/questions/244264/add-store-extra-fields-wordpress-comments
//https://stevepolito.design/blog/wordpress-acf-front-end-form-tutorial/
// https://www.advancedcustomfields.com/resources/acf_form/
// https://support.advancedcustomfields.com/forums/topic/custom-comment-field-not-to-display-on-reply/

 
    //+ Gravity forms
    //https://gravitywiz.com/upload-files-images-gravity-forms-advanced-custom-fields/

    //acf extended
    // https://wordpress.org/plugins/acf-extended/

//RE-captha
//https://betterstudio.com/blog/customize-wordpress-comment-form/


//WP native COMMENTS
//https://developer.wordpress.org/reference/functions/wp_list_comments/


// "Comments Form plugin"
//https://www.youtube.com/watch?v=GWtqDd7dKLI




//ASKIMET - implement for spam purposes?



/*
//Get only the approved comments
$args = array(
    'status' => 'approve'
);
 
// The comment Query
$comments_query = new WP_Comment_Query;
$comments = $comments_query->query( $args );
 
// Comment Loop
if ( $comments ) {
 foreach ( $comments as $comment ) {
 echo '<p>' . $comment->comment_content . '</p>';
 }
} else {
 echo 'No comments found.';
}*/
?>
<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
 


<?php if (is_single()):?>

 


<div id="comments" class="comments-area">
 
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'twentythirteen' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>
 
        <ol class="comment-list">


            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                    // 'callback'	  => 'my_news_comment_template' //https://www.advancedcustomfields.com/resources/get-values-comment/
                    'callback'	  => 'my_gridpage_comment_template' //https://www.advancedcustomfields.com/resources/get-values-comment/

                    ) );
            ?>
        </ol><!-- .comment-list -->
 

        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&amp;larr; Older Comments', 'twentythirteen' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &amp;rarr;', 'twentythirteen' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
        <?php endif; ?>
 
    <?php endif; // have_comments() ?>
 
    <?php comment_form(); ?>
 
</div><!-- #comments -->
 

<?php endif; // is single ?>
 
 




<?php if (is_page()) : //layout grid - maybe ensure not just page ?>


    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                // printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'twentythirteen' ),
                    // number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>
 
        <ol class="comment-list">


            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                     
                    // 'callback'	  => 'my_news_comment_template' //https://www.advancedcustomfields.com/resources/get-values-comment/

                     'callback'	  => 'my_gridpage_comment_template' //https://www.advancedcustomfields.com/resources/get-values-comment/
                ) );
            ?>
        </ol><!-- .comment-list -->
 

        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&amp;larr; Older Comments', 'twentythirteen' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &amp;rarr;', 'twentythirteen' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
        <?php endif; ?>
 
    <?php endif; // have_comments() ?>
 start comment form:
    <?php comment_form(); ?>
 end comment form


<?php endif; // is page ?>
