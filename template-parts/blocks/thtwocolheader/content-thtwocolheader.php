<?php

/**
 * Two col Text Block Header Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-two-col-left-header-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'th-block text-two-col-block-left-header two-col-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

 ?>

<?php if( have_rows('two_col_content_header') ): ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

        <?php while( have_rows('two_col_content_header') ): the_row(); 
            // vars
            $title = get_sub_field('title');
            $text_area = get_sub_field('text_area');
            ?>

                <!--<div class="repeater-row"> -->
                     
                    <?php if( $title ): ?>
                        
                        <h1 class="intro clear-col-item">
                            <?php echo $title; ?>
                        </h1><!-- .title -->
                        <!-- make sure this columns is cleared at all times -->
             
                    <?php endif; ?>

                    <?php if( $text_area ): ?>

                        <h3 class="text-area">
                            <p>
                            <?php echo $text_area; ?>
                            </p>
                        </h3><!-- .text-area -->

                    <?php endif; ?>
                
               <!-- </div>repeater-row-->

        <?php endwhile; ?>

        <style>
            #<?php echo $id; ?> {
                
            }
        </style>

          
    </div> <!-- th-block -->     

<?php endif; // if have rows ?>

