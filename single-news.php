<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 *  
 * 
 * 
 * To do - this is old/inp markup; so review everythin inside the barba container 
 */

get_header();?>

<div data-barba="container" data-barba-namespace="single-post"> <!-- ajax wrapper start -->

	<?php if ( have_posts() ) :?>
   
    <article class="grid-container main">
    
    	<?php while ( have_posts() ) : the_post();?>

		 	<?php get_template_part( 'content' , 'news' ); 
	 
		endwhile;?>

	</article>

<?php endif;?>

<?php wp_reset_query(); //reset?>	

</div><!-- class="ajax-container" data-barba="container" data-barba-namespace -->

<?php get_footer();?>