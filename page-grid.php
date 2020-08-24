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

	<?php /*	// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :?>

			<div class="comments-wrap grid-container"> 
		
				<?php comments_template();?>
	
			</div>
 		<?php
	endif; */ ?>


</div ><!-- data-barba="container" data-barba-namespace=" ">  ajax wrapper start -->

<?php endif;

get_footer();?>

