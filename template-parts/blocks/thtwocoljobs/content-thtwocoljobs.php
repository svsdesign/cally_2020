<?php

/**
 * Two col Text Jobs Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-two-col-jobs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = ' th-block text-two-col-jobs-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>



<?php if( have_rows('two_column_content_jobs') ): ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> block-z-index-2">  

        <?php while( have_rows('two_column_content_jobs') ): the_row(); 
        // vars
        $title = get_sub_field('title');
        $subtitle = get_sub_field('sub_title');           
        $details = get_sub_field('details');
        $description = get_sub_field('description');
        ?>

            <div class="repeater-row">
        
                <div class="two-col-block clear-right-col"> 

                    <div class="title-wrap">

                        <?php if( $title ): ?>

                            <h3 class="title">
                                <?php echo $title; ?>
                            </h3><!-- .title -->
                     
                        <?php endif; ?>

                          <?php if( $subtitle ): ?>

                            <h3 class="subtitle">
                                <?php echo $subtitle; ?>
                            </h3><!-- .subtitle -->
                     
                        <?php endif; ?>
                    
                    </div>


                    <?php if( $details ): ?>

                        <div class="details">
                            <p>
                            <?php echo $details; ?>
                            </p>
                        </div><!-- .detail -->
                    
                    <?php endif; ?>

                </div><!-- .two-col-block --> 

                <?php if( $description ): ?>

                    <div class="two-col-block">        

                        <div class="description">
                            <!-- <p> review use of <p> -->
                            <?php echo $description; ?>
                            <!-- review use of <p> -->
                        
                        </div><!-- .description -->
            
                    </div><!-- .text-two-col-block --> 
                
                <?php endif; ?>

            </div><!-- repeater-row-->

        <?php endwhile; ?>
  
        <style type="text/css">
            #<?php echo $id; ?> {
                
            }
        </style>

    </div> <!-- th-block -->      

<?php endif; // if have rows ?>