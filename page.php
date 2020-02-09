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

			if( is_page('theseus') ): /*if is_page('work') */

				get_template_part( 'theseus-page' );


			elseif( is_page('privacy-policy') ): 

		 
		  		get_template_part( 'content-page' );

					 
			else: /* other pages - use same template as Privacy Policy */?>
		  	
		  		<?php get_template_part( 'content-page' )?>

			<?php endif;

		endwhile;?>

	</div><!-- class="grid-container main" -->

<?php endif;

get_footer();?>

