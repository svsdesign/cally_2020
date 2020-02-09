<?php
/**
 *  Theseus
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  // theme for privacy page (and standard template for the other pages)
 *
 **/
?>
 
<?php /* - moved this intro area into the header - I htink - review wiht the nav as well?  
<div id="intro-area" class="visible">

	<?php /// I need to pass in fields or body class 
	get_template_part( 'theseus_animation' );?>

</div>	
<?php // - END move this intro area into the header - I htink? */ ?>

<div id="main" class="wrapper">

	<?php $homepage = array (  	// query the other page whilst I'm here to get the correct links

	 	 'page_id' => '6', // REVIEW THIS - page id might be different
		); 

    	query_posts( $homepage  ); ?>
		
		<?php if ( have_posts() ) : ?>
		

			<?php while ( have_posts() ) : the_post(); ?>
					     
				<?php if ( have_rows( 'page_content' ) ): 
				$navitemid = 1; 
				$navtitleid = 1; 
				?>

				<div class="nav-fixer">

					<div class="grid-container navigation">

						<div class="grid-row-holder">

				 			<div class="nav-toggle-wrapper">

				 				<div class="nav-toggle">

									<?php get_template_part( 'nav_toggle_animation' );?>

									<!--<div class="svg-icon">
					 					<?php// get_template_part('assets/svg/inline', 't_toggle_svg'); ?>
									</div>  svg-icon -->	

				 				</div><!-- nav-toggle-wrapper -->

				 			</div><!-- nav-toggle-wrapper -->

				 		    <div class="nav-wrapper grid-item grid-xs-10 grid-lg-2">

								<div class="non-linear-dot-wrap">

									<div class="non-linear-dots nav-dots">

										<?php while ( have_rows( 'page_content' ) ) : the_row(); ?>
										
											<?php if ( get_row_layout() == 'introduction' ) : // &#9632;?>

						         				<div data-dot-item-non-linear="item-<?php echo $navitemid++ ;?>" class="non-linear-dot">&#11037;</div>

											<?php elseif ( get_row_layout() == 'approach' ) : ?>

						         				<div data-dot-item-non-linear="item-<?php echo $navitemid++ ;?>" class="non-linear-dot">&#11037;</div>

											<?php elseif ( get_row_layout() == 'clients' ) : ?>

						         				<div data-dot-item-non-linear="item-<?php echo $navitemid++ ;?>" class="non-linear-dot">&#11037;</div>

											<?php elseif ( get_row_layout() == 'team' ) : ?>

						        				<div data-dot-item-non-linear="item-<?php echo $navitemid++ ;?>" class="non-linear-dot">&#11037;</div>
							
											<?php elseif ( get_row_layout() == 'contact' ) : ?>

						         				<div data-dot-item-non-linear="item-<?php echo $navitemid++ ;?>" class="non-linear-dot">&#11037;</div>
											
											<?php endif; // get_row_layout() ?>
									
										<?php endwhile; //while ( have_rows( 'page_content' ) ) : the_row();?>

									 </div><!--non-linear-->

								</div><!--non-linear-dot-wrap-->

								<div class="nav-items">

						  			<?php while ( have_rows( 'page_content' ) ) : the_row(); ?>
									
										<?php if ( get_row_layout() == 'introduction' ) : ?>

					       					<a href="<?php echo get_permalink( $post->ID ); ?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="nav-item">
					       						<?php the_sub_field( 'menu_title' ); ?>
											</a>

										<?php elseif ( get_row_layout() == 'approach' ) : ?>

					       					<a href="<?php echo get_permalink( $post->ID ); ?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="nav-item">
					       						<?php the_sub_field( 'menu_title' ); ?>
											</a>

										<?php elseif ( get_row_layout() == 'clients' ) : ?>
					       					
					       					<a href="<?php echo get_permalink( $post->ID ); ?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="nav-item">
					       						<?php the_sub_field( 'menu_title' ); ?>
											</a>

										<?php elseif ( get_row_layout() == 'team' ) : ?>

					       					<a href="<?php echo get_permalink( $post->ID ); ?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="nav-item">
					       						<?php the_sub_field( 'menu_title' ); ?>
											</a>

										<?php elseif ( get_row_layout() == 'contact' ) : ?>

					       					<a href="<?php echo get_permalink( $post->ID ); ?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="nav-item">
					       						<?php the_sub_field( 'menu_title' ); ?>
											</a>

										<?php endif; // get_row_layout() ?>
								
									<?php endwhile; //while ( have_rows( 'page_content' ) ) : the_row();?>

						     	</div><!--nav-items-->

						     	<a class="nav-logo" href="<?php echo get_home_url(); ?>">
						     	
							     	<div class="svg-icon">
					 					<?php get_template_part('assets/svg/inline', 't_logo_svg'); ?>
									</div>   <!--svg-icon -->	

								</a>	

						     </div><!--nav-wrapper-->

						<?php else:// if ( have_rows( 'page_content' ) ):  ?>
							<?php // no layouts found ?>
						<?php endif; //  if ( have_rows( 'page_content' ) ): ?>
					
					</div><!-- grid-row-holder -->
				 	
				 	</div><!-- grid-container -->

				</div><!-- .nav-fixer -->

			<?php endwhile; // end of the loop. ?> 		 

		<?php endif; // endif have post ?>

 	<?php wp_reset_query();?><!-- Reset Query-->

	<?php if ( have_rows( 'page_content' ) ): 
	$itemid = 1;?>

		<div class="main-fixer">
			
		 	<div class="grid-container main">

				<?php while ( have_rows( 'page_content' ) ) : the_row(); ?>
					
					<?php if ( get_row_layout() == 'content_item' ) : ?>
			       
				        <section id="item-<?php echo $itemid; ?>" data-content-item="item-<?php echo $itemid++ ;?>" class="content-item fade-item grid-row-holder" data-move-ratio="0">

							<h3 class="grid-item grid-xs-10 push-left-lg-2 grid-lg-8">

							<?php the_sub_field( 'sub_title' ); ?>

							</h3>
							
							<div class="grid-item grid-xs-10 push-left-lg-2 grid-lg-8">
							<?php the_sub_field( 'sub_item_content' ); ?>
							</div>

						</section><!-- .content-item-->

					<?php endif; ?>

				<?php endwhile; //while ( have_rows( 'page_content' ) ) : the_row(); ?>

			</div><!-- .grid-container.main -->

		</div><!-- .main-fixer -->

	<?php else: // if ( have_rows( 'page_content' ) ):?>

		<?php // no layouts found ?>

	<?php endif; // if ( have_rows( 'page_content' ) ): ?>

</div><!-- #main.wrapper -->
