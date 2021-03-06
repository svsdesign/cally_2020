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

<div data-barba="container" data-barba-namespace="archive"> <!-- ajax wrapper start -->
   
	<div class="grid-container main"> 
	 
	<h1 class="title intro"> 
		<!--
We'll keep you posted on the parks development here or sign up to our mailing list to also receive the latest news. 

Workshops, a gallery of designs, related projects and relevant news.
-->
</h1>
		<?php
		// set the "paged" parameter (use 'page' if the query is on a static front page)
		$newspaged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$newsargs = array(
			'post_type' => 'news',
			'post_status' => 'publish',
			'paged'          => $newspaged,
		);
		// the query
 		$news_query = new WP_Query( $newsargs ); 
	  	
	  		if ( $news_query->have_posts() ) :?>


				<div class="grid-row-holder">

					<?php
					// the loop
					$itemnumber = 0;

					while ( $news_query->have_posts() ) : $news_query->the_post(); 

						$newsid = get_the_ID();	
						$itemnumber++;			
						// end get fields
						// echo $newsid;
						if  ($itemnumber > 1) {// after the 1st item
						// for article items; 
							 $layoutclass = 'smaller-item grid-xs-12 grid-md-6';//grid-item-md-3 grid-item-lg-2 
						 } else{
					 		$layoutclass = 'grid-xs-12';//.$itemnumber.'-number';
			
						};

						?>
		
						<article class="news-item-<?php echo $itemnumber;?> news-item post-item-<?php echo $newsid;?> grid-item <?php echo $layoutclass;?>">
							<?php get_template_part( 'content', 'news' );?>
						</article>


					<?php
					// End the loop.
					endwhile;?>
					
				</div> <!-- .grid-row-holder"> -->

							
			<?php	
			$big = 999999999; // need an unlikely integer

			   $paginate = paginate_links( array(
			        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			        'format' => '?paged=%#%',
			        'current' => max( 1, get_query_var('paged')),
			        'total' => $news_query->max_num_pages,
			        'prev_next' =>true,
					'prev_text' => '<div class="small nav-previous align-left"><svg class="svg-icon previous-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div><div class="text">Newer News</div>',
					'next_text' => '<div class="small nav-next align-right"><svg class="svg-icon next-arrow-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g fill="#FFFFFF" fill-rule="nonzero"> <polygon transform="translate(19.874778, 20.000000) scale(-1, 1) rotate(-270.000000) translate(-19.874778, -20.000000) " points="19.8747779 29.2278846 37.6296018 6.12522213 39.8747779 7.85068148 19.8747779 33.8747779 -0.12522213 7.85068148 2.1199539 6.12522213"></polygon> </g> </g> </svg></div><div class="text">Older News</div>',
		    		));
			
				if ($paginate):?>
			
					<div class="page-nav">

						<div class="grid-container">

							<div class="page-nav-wrapper grid-item grid-xs-12">

								<?php echo $paginate;?>

							</div>
						
						</div>

					</div>	<!-- ".page-nav-->		 

				<?php endif;  // if we have paginated links ?>

			
	
			<?php endif;  // if ( $news_query->have_posts
				wp_reset_query(); 

			 // wp_reset_postdata();
			?>

		</div> <!-- container -->

	</div><!-- data-barba="container" data-barba-namespace="-->

<?php get_footer(); ?>