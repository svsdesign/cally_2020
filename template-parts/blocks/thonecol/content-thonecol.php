<?php

/**
 * One col Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-one-col-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'th-block text-one-col-block one-col-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$title = get_field('title') ?: 'Your title here...';
$text_area = get_field('text_area') ?: 'Your text here...';
//$author = get_field('author') ?: 'Author name';

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  
      
    <?php if( $title ): ?>

        <h3 class="title">
            <?php echo $title; ?>
        </h3><!-- .title -->

    <?php endif; ?>

    <?php if( $text_area ): ?>

        <div class="text-area">
            <p>
            <?php echo $text_area; ?>
            </p>
        </div><!-- .text-area -->

    <?php endif; ?>

    <style type="text/css">
        #<?php echo $id; ?> {
            
        }
    </style>

</div> <!-- th-block -->     
  
