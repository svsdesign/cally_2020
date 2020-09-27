<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 *  
 * 
 *  TO DO - rmove all trace of theseus & configure correctly accoridngly
 *  ensure overview grid on displayed on all pages
 */
get_header();

if ( have_posts() ) :?>

<div data-barba="container" data-barba-namespace="page"> <!-- ajax wrapper start -->
<?php// echo $namespace?>

	<div class="grid-container main"><!-- id wasa id="site-wrap" - reivew delete this? -->

		<?php while ( have_posts() ) : the_post();

			if( is_page('theseus') ): /*if is_page('work') */

				get_template_part( 'theseus-page' );


			elseif( is_page('privacy-policy') ): 

		 
		  		get_template_part( 'content-page' );

					 
			else: /* other pages - use same template as Privacy Policy */?>

			<?php get_template_part( 'overview' ); // ensure this only displayed on teh appropriate pages

		  	get_template_part( 'content-page' )?>

			<?php endif;

		endwhile;?>

	</div><!-- class="grid-container main" -->

</div ><!-- data-barba="container" data-barba-namespace=" ">  ajax wrapper start -->

<?php endif;

get_footer();?>

