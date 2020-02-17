<?php

/**
 * Slideshow Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'slideshow-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'th-block slideshow-block ';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$text = get_field('text') ?: 'Your text here...';
//$author = get_field('author') ?: 'Author name';
//$role = get_field('role') ?: 'Author role';
//$image = get_field('image') ?:'insert image';
//$background_color = get_field('background_color');
//$line_color = get_field('line_color');
//$text_color = get_field('text_color');

/* review this markup - its inp; so change the theseus classes etc */
?>
  
 <?php 
$images = get_field('slide_show');
$imagecaption = get_field('slideshow_caption'); // (thumbnail, medium, large, full or custom size)

$size = 'full'; // (thumbnail, medium, large, full or custom size)
if( $images ): ?>
     <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

        <div class="slideshow-carousel">
       
            <?php foreach( $images as $image ): ?>
                 <div class="slideshow-image">

                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

                </div>

            <?php endforeach; ?>
        
        </div><!--.slideshow-carousel-->

        <?php if( $imagecaption): ?>
            
            <div class="image-caption caption">
            
                <?php echo $imagecaption; ?>
            
            </div><!-- .image-caption -->

        <?php endif; //if $image_caption?>  
 
         <style type="text/css">
            #<?php echo $id; ?> {
             }
        </style>

    </div> <!--id=""-->

<?php endif; // if images ?>
 


