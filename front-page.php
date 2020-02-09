<?php
/**
 *  Theseus
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  
 */

get_header();

if ( have_posts() ) :?>
 
	<div class="grid-container main"><!-- id wasa id="site-wrap" - reivew delete this? -->

		<?php while ( have_posts() ) : the_post();
			
			//get_template_part( 'theseus-page' ); was this - but now just use content? or content-page?
		// was this - but not sure if this is a good way to work?	get_template_part( 'content' );
				  		get_template_part( 'content-page' );
			// maybe my ajax issues are dereived from this?

		endwhile;?>

	</div><!--  class="grid-container main #site-wrap -->

<?php endif;

get_footer();?>
