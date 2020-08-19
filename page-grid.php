<?php
/*  
 * Template Name: Layout Grid
 * 
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 *  
 *  page-grid.php
 * 
 *  This is the layout grid page temple
 */
get_header();

if ( have_posts() ) :?>


<div data-barba="container" data-barba-namespace="layout-grid"> <!-- ajax wrapper start -->
<?php// echo $namespace?>

		<?php while ( have_posts() ) : the_post();

			// if( is_page('theseus') ): /*if is_page('work') */

		 
		  		get_template_part( 'content-page-grid' );?>
 

			<?php //endif;

		endwhile;?>

</div ><!-- data-barba="container" data-barba-namespace=" ">  ajax wrapper start -->

<?php endif;

get_footer();?>

