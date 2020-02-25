<?php

/**
 * Multi Col Image Block Template. - 
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
$id = 'image-multi-col-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


$number_of_columns = get_field('number_of_columns');

if( $number_of_columns == 'one' ) {

    $colclass = 'one-col-block';
 
} elseif( $number_of_columns == 'two') {

    $colclass = 'two-col-block';
 

} elseif( $number_of_columns == 'three') {
   
    $colclass = 'three-col-block';

} elseif( $number_of_columns == 'four') {

    $colclass = 'four-col-block';

}

// Create class attribute allowing for custom "className" and "align" values.
$className = ' th-block image-multi-col-block ' . $colclass;

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>

<?php if( have_rows('multi_col_content') ):?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

        <?php while( have_rows('multi_col_content') ): the_row(); 
        // vars
       // $title = get_sub_field('title');
        $image = get_sub_field('image');
        $image_caption = get_sub_field('image_caption') ?: 'Your Caption here...';
        ?>
            <div class="repeater-row">        

                <?php if( $image ): ?>

                    <div class="image-area">

                        <?php if( $image ): ?>

                            <div class="image-wrap">
                                   
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                               <!-- <img src="<?php //echo esc_url($image['url']); ?>" alt="<?php// echo esc_attr($image['alt']); ?>" /> -->
                                 
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