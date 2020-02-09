<?php

/**
 * Contact + Map Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contact-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = ' th-block contact-block two-col-block';
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

 // vars
$title = get_field('title');
$text_area = get_field('text_area') ?: 'Your text here...';
$logos = get_field('logos');
$map = get_field('map'); // reivew
?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

        <div class="left-area">    

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

            <?php if( $logos ): ?>
  
                <div class="logos">
               
                    <?php foreach( $logos as $logo ): ?>

                        <div class="logo">

                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />

                        </div>

                    <?php endforeach; ?>
                
                </div><!--.logos-->

            <?php endif; // if logos ?>
      
        </div><!-- left-area-->

        <div class="right-area"> 
        
            <?php if( $map ): ?>

                <div class="map-wrap"> 

                     <div id="g-map-holder">
                                            
                        <div id="g-map-mask">
                            <div id="g-map">
                            </div>
                        </div>

                    </div> 

                </div><!-- .map-wrap-->        
            
            <?php endif; // if map ?>

        </div><!-- .right-area -->        

        <style type="text/css">
            #<?php echo $id; ?> {

            }
        </style>

    </div> <!-- th-block --> 