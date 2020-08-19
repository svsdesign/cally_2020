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
 

<?php if ( is_home() ) :?>

 	<?php the_content();?>


<?php endif;// is home ?>

<?php if (is_page()) : ?>
 
	<?php the_content();?>

<?php endif; // is page ?>

<?php if (is_single()):?>

	<?php the_content(); ?>
 

<?php endif; // is single ?>

<?php if (is_archive()) : ?>	


<?php endif;  // is archive ?>
