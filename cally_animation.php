<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 *  
 */
?>
 

<?php if( get_field('colour_scheme', 'option') == 'black' ): 
$class = 'white-anim'; ?>
<?php else:  $class = 'black-anim'; ?> 
<?php endif; ?>

<div id="animation-small" class="<?php echo $class;?>"></div>
<div id="animation-large" class="<?php echo $class;?>"></div>

