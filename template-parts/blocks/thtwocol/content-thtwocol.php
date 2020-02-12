<?php

/**
 * Two col Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-two-col-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = ' th-block text-two-col-block two-col-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.

//$title = get_field('title') ?: 'Your title here...';
//$text_area = get_field('text_area') ?: 'Your text here...';
//$author = get_field('author') ?: 'Author name';
//$role = get_field('role') ?: 'Author role';
//$image = get_field('image') ?:'insert image';
//$background_color = get_field('background_color');
//$line_color = get_field('line_color');
//$text_color = get_field('text_color');
?>

<?php if( have_rows('two_col_content') ): ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

        <?php while( have_rows('two_col_content') ): the_row(); 
        // vars
        $title = get_sub_field('title');
        $text_area = get_sub_field('text_area');
        $break_column_options = get_sub_field('break_column_options');
        if( $break_column_options == 'before' ) {

            $breakclass = "clear-col-item clear-column-after";

        } elseif( $break_column_options == 'after') {

            $breakclass = "clear-col-item clear-column-after";

        } elseif( $break_column_options == 'none') {
            
            $breakclass = ""; //don't anything

        }; ?>

            <div class="repeater-row <?php echo $breakclass;?>">
                 
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
            
            </div><!-- repeater-row-->

        <?php endwhile; ?>

        <style type="text/css">
            #<?php echo $id; ?> {
                
            }
        </style>

    </div> <!-- th-block -->     

<?php endif; // if have rows ?>
