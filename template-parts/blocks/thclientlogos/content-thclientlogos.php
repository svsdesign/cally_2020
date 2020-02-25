<?php

/**
 * Client Logo Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'client-logos-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'th-block client-logos-block four-col-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
  
$images = get_field('client_logos');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
if( $images ): ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

       
        <?php foreach( $images as $image ): ?>

            <div class="client-logo-image image-wrap">
    
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
               <!-- <img src="<?php //echo esc_url($image['url']); ?>" alt="<?php// echo esc_attr($image['alt']); ?>" /> -->
                       
            </div>

        <?php endforeach; ?>
     
        <style type="text/css">
            #<?php echo $id; ?> {
                
            }
        </style>
   
    </div> <!-- th-block -->     


<?php endif; ?>

