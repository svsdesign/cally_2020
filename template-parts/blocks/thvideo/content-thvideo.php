<?php

/**
 * Video Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
// determine further ocnfiguration after chatting to mark regarding design choices
// have set to two for now
// + sort aligment classes

// Create id attribute allowing for custom "anchor" value.
$id = 'video-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Create class attribute allowing for custom "className" and "align" values.
$className = ' th-block video-block ';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


$video = get_field('video_url'); // review this - ie. iframes instead?
$video_caption = get_field('video_caption') ?: 'Your Caption here...';
?>

<?php if( $video ): ?>

  	<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

        <div class="video-area">

            <?php if( $video ): ?>

                <div class="video-wrap">

                    <?php echo $video; ?>
                
                </div><!-- .video-wrap -->

            <?php endif; ?>

        </div><!-- .video-area -->

        <?php if( $video_caption): ?>
            
            <div class="grid-row-holder">
            
               <div class="video-caption caption grid-item grid-xs-12 grid-md-6">

                    <?php echo $video_caption; ?>
            
                </div><!-- .video-caption -->
          
            </div><!--.grid-row-holder-->

        <?php endif; //if $video_caption?>
              
        <style type="text/css">
            #<?php echo $id; ?> {
                
            }
        </style>  
  
    </div> <!-- th-block -->   

<?php endif;//if $video ?>
