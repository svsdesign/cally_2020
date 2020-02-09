<?php
/**
 *  Theseus
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  
 *
 **/
?>
<?php /*

TO DO
review this - i./e some template/if stamtents not need; ensur this works for post etc

*/

?>
 

<?php if ( is_home() ) :?>

 	<?php the_content();?>


<?php endif;// is home ?>

<?php if (is_page()) : ?>
 
	<?php the_content();?>

<?php endif; // is page ?>

<?php if (is_single()):
	// single
	//$newsid = get_the_ID();
 	//$newsimage = get_field('news_featured_image'); // image
 	//$newsdescription = get_field('news_summary_description');// text area - 200 characters limit
 	//$newscontent = get_field('news_content'); // wysiwig
 	?>

	<?php the_content(); ?>
 

<?php endif; // is single ?>

<?php if (is_archive()) : ?>	
 

<?php endif;  // is archive ?>
