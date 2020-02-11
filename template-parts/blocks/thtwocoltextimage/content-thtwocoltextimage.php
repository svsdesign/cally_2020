<?php

/**
 * Two col Text + Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-image-two-col-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = ' th-block text-image-two-col-block two-col-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


/* to do:

- sort out the appropriate aligment coding:
classes; front end
center - this just left alligned?



*/
?>
<?php if( have_rows('two_col_content') ): ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

        <?php while( have_rows('two_col_content') ): the_row(); 
        // vars
       // $title = get_sub_field('title');
        $text_area = get_sub_field('text_area') ?: 'Your text here...';
        $image = get_sub_field('image');
        $image_caption = get_sub_field('image_caption') ?: 'Your Caption here...';
        ?>
            <div class="repeater-row">        

                <?php if( $text_area ): ?>

                    <div class="text-area">
                        <p>
                        <?php echo $text_area; ?>
                        </p>
                    </div><!-- .text-area -->
           
                <?php endif; ?>

                <?php if( $image ): ?>

                    <div class="image-area">

                        <?php if( $image ): ?>

                            <div class="image-wrap">

                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            
                            </div><!-- .image-wrap -->

                        <?php endif; ?>
 
                        <?php if( $image_caption): ?>
                            
                            <div class="image-caption caption">
                            
                                <?php echo $image_caption; ?>
                            
                            </div><!-- .image-caption -->

                        <?php endif; //if $image_caption?>

                    </div><!-- .image-area -->

                <?php endif;//if $image ?>
         
            </div><!-- repeater-row-->

        <?php endwhile; ?>

        <style type="text/css">
            #<?php echo $id; ?> {
                
            }
        </style>
  
    </div> <!-- th-block -->     

<?php endif; // if have rows ?>

