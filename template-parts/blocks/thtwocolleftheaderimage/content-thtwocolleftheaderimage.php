<?php

/**
 * Two col Text Left header Block + Image Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-two-col-image-left-header-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = ' th-block text-two-col-image-block-left-header';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$columnsizing = get_field('column_sizing');
//25-75 : 25% & 75%
//50-50 : 50% & 50%
//75-25 : 75% & 25%


if( $columnsizing == '25-75' ) {

    $leftcolclass = 'grid-xs-12 grid-sm-12 grid-md-3';
    $rightcolclass = 'grid-xs-12 grid-sm-12 grid-md-9';

} elseif( $columnsizing == '50-50') {

    $leftcolclass = 'grid-xs-12 grid-sm-6 grid-md-6';
    $rightcolclass = 'grid-xs-12 grid-sm-6 grid-md-6';

} elseif( $columnsizing == '75-25') {

    $leftcolclass = 'grid-xs-12 grid-sm-12 grid-md-9';
    $rightcolclass = 'grid-xs-12 grid-sm-12 grid-md-3';

};?>

<?php if( have_rows('two_col_content_left_header') ): ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> grid-row-holder block-z-index-2">  


        <?php while( have_rows('two_col_content_left_header') ): the_row(); 
            // vars
            $image = get_sub_field('image');
            $title = get_sub_field('title');
            $subtitle = get_sub_field('subtitle');
            $text_area = get_sub_field('text_area');
            ?>
                      
                    <div class="title-area grid-item <?php echo $leftcolclass;?>">

                        <?php if( $image ): ?>

                            <div class="image-wrap">
    
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                               <!-- <img src="<?php //echo esc_url($image['url']); ?>" alt="<?php// echo esc_attr($image['alt']); ?>" /> -->
                        
                            </div><!-- .image-wrap -->

                        <?php endif; ?>
                
                        <?php if( $title ): ?>
                    
                            <h3 class="title">

                                 <?php echo $title; ?>

                            </h3><!-- class="title -->
   
                        <?php endif; //title ?>

                        <?php if( $subtitle ): ?>

                             <div class="sub-title">
                                
                                <?php echo $subtitle; ?>
       
                            </div><!-- .subtitle -->
         
                        <?php endif; // subtitle ?>

                    </div ><!-- .title-area grid-item -->
        
                    <div class="text-area grid-item <?php echo $rightcolclass;?>">

                         <?php if( $text_area ): ?>

                            <p>
                            <?php echo $text_area; ?>
                            </p>

                        <?php endif; ?>
                 
                    </div><!-- .text-area -->
                
            
                <!-- in need to make sure we're clearing after 1 repater - without using additioal divs? 
                        Maybe don't use repeater fields so all block listing are 1 per block? 
 
                        -->
        
        <?php endwhile; ?>
         
         <style type="text/css">
            #<?php echo $id; ?> {
                
            }
        </style>
 
    </div> <!-- th-block -->     

<?php endif; // if have rows ?>