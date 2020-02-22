<?php
/**
 *  Theseus
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *   - Set "active classes of first items; nav titles, bullets +  - with js?
 *
 **/
?>

<?php // the following moved into header template
/*
<div id="intro-area" class="visible">

	<?php get_template_part( 'theseus_animation' );?>

</div>	
*/ ?>

<!-- moved nto header.php so delete this <div id="main" class="wrapper"> -->


<?php //start contebnt - i.e the blcoks ?>
  		<?php the_content(); // review this ?>
 <?php // end contebnt - i.e the blcoks ?>

	<?php if ( have_rows( 'page_content' ) ): 
	$navitemid = 1; 
	$navtitleid = 1; 
	?>

 		<?php // review this nav fixer; move nav into other template



 		 ?>
	<div class="nav-fixer">

		<div class="grid-container navigation">

			<div class="grid-row-holder">

	 			<div class="nav-toggle-wrapper">

	 				<div class="nav-toggle">

						<?php //get_template_part( 'nav_toggle_animation' );?>

					<!--	<div class="svg-icon">
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

		       					<a href="#item-<?php echo $navtitleid ;?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="no-ajaxy nav-item">
		       						<?php the_sub_field( 'menu_title' ); ?>
								</a>

							<?php elseif ( get_row_layout() == 'approach' ) : ?>

		       					<a href="#item-<?php echo $navtitleid ;?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="no-ajaxy nav-item">
		       						<?php the_sub_field( 'menu_title' ); ?>
								</a>

							<?php elseif ( get_row_layout() == 'clients' ) : ?>
		       					
		       					<a href="#item-<?php echo $navtitleid ;?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="no-ajaxy nav-item">
		       						<?php the_sub_field( 'menu_title' ); ?>
								</a>

							<?php elseif ( get_row_layout() == 'team' ) : ?>

		       					<a href="#item-<?php echo $navtitleid ;?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="no-ajaxy nav-item">
		       						<?php the_sub_field( 'menu_title' ); ?>
								</a>

							<?php elseif ( get_row_layout() == 'contact' ) : ?>

		       					<a href="#item-<?php echo $navtitleid ;?>" data-nav-item="item-<?php echo $navtitleid++ ;?>" class="no-ajaxy nav-item">
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


	 		<?php // END review this nav fixer; move nav into other template



 		 ?>


	 		<?php // review this page content; move nav into other template?



 		 ?>

	<?php if ( have_rows( 'page_content' ) ): 
	$itemid = 1;?>

	<div class="main-fixer">
		
	 	<div class="grid-container main">

	 	      	<div id="counter"></div><!-- get rid of this -->

					<?php while ( have_rows( 'page_content' ) ) : the_row(); ?>
						
						<?php if ( get_row_layout() == 'introduction' ) : ?>
				       
					        <section id="item-<?php echo $itemid; ?>" data-content-item="item-<?php echo $itemid++ ;?>" class="content-item fade-item grid-row-holder" data-move-ratio="0">

								<h1 class="intro grid-item push-left-lg-2 grid-xs-10 grid-md-5 grid-lg-4">

								<?php the_sub_field( 'introduction' ); ?>

								</h1>
								
								<h2 class="grid-item grid-xs-10 grid-md-5 grid-lg-4">
								<?php the_sub_field( 'further_description' ); ?>
								</h2>

							</section><!-- .content-item-->


						<?php elseif ( get_row_layout() == 'approach' ) : ?>
						
							<section id="item-<?php echo $itemid; ?>" data-content-item="item-<?php echo $itemid++ ;?>" class="content-item fade-item grid-row-holder" data-move-ratio="0">

								
								<div class="grid-item push-left-lg-2 grid-xs-10 grid-md-5 grid-lg-4">
								<?php the_sub_field( 'introduction' ); ?>
								</div>


								<?php if ( have_rows( 'details' ) ) : ?>

									<div class="grid-item grid-xs-10 grid-md-5 grid-lg-4">

										<?php while ( have_rows( 'details' ) ) : the_row(); ?>

											<?php if (get_sub_field( 'header' )):?>

												<h3 class="approach-item">
												<?php the_sub_field( 'header' ); ?>
												</h3>
												
											<?php endif;// if(get_sub_field( 'header' );)  ?>

												<div class="description">
													<p>
	 												<?php the_sub_field( 'description' ); ?>
	 												</p>
												</div><!--.description -->

										<?php endwhile; ?>

									</div><!-- grid-item grid-xs-10 grid-lg-4 -->

								<?php else ://if ( have_rows( 'details' ) ) : ?>
									<?php // no rows found ?>
								<?php endif;//if ( have_rows( 'details' ) ) : ?>

							</section><!-- .content-item-->

						<?php elseif ( get_row_layout() == 'clients' ) : ?>

							<section id="item-<?php echo $itemid; ?>" data-content-item="item-<?php echo $itemid++ ;?>" class="content-item fade-item grid-row-holder" data-move-ratio="0">

								<?php// the_sub_field( 'menu_title' ); ?>
								
								<div class="grid-item push-left-lg-2 grid-xs-10 grid-md-5 grid-lg-4">
									
									<p>
										<?php the_sub_field( 'introduction' ); ?>
									</p>

								</div>

								<?php if ( have_rows( 'client' ) ) : ?>
									
									<div class="grid-item push-left-lg-2 grid-lg-8">

										<?php while ( have_rows( 'client' ) ) : the_row(); ?>

											<div class="logo-item">

											<?php // the_sub_field( 'client_name' ); ?>
											<?php $client_logo = get_sub_field( 'client_logo' ); ?>
											<?php if ( $client_logo ) { ?>
												<img class="client-logo grid-xs-10" src="<?php echo $client_logo['url']; ?>" alt="<?php echo $client_logo['alt']; ?>" />
											<?php } ?>
											<?php// the_sub_field( 'client_link' ); ?>
											
											</div>


										<?php endwhile; ?>
										
									</div><!-- grid-item push-left-lg-2-->

								<?php else : //if ( have_rows( 'client' ) ) :?>
									
									<?php // no rows found ?>

								<?php endif; //if ( have_rows( 'client' ) ) : ?>

							</section><!-- .content-item-->

						<?php elseif ( get_row_layout() == 'team' ) : ?>

							<section id="item-<?php echo $itemid; ?>" data-content-item="item-<?php echo $itemid++ ;?>" class="content-item fade-item grid-row-holder" data-move-ratio="0">

								<?php// the_sub_field( 'menu_title' ); ?>
								<?php if ( have_rows( 'team_member' ) ) : ?>
									
									<?php while ( have_rows( 'team_member' ) ) : the_row(); ?>
								
									<div class="grid-item push-left-lg-2 grid-xs-10 grid-md-3 grid-lg-2">
									
										<h3 class="team-member">
										<?php the_sub_field( 'team_member_name' ); ?>
										</h3>
										<h4 class="team-title">
										<?php the_sub_field( 'team_member_title' ); ?>
										</h4>
									</div>


									<div class="grid-item grid-xs-10 grid-md-7 grid-lg-6">
										<p><?php the_sub_field( 'team_member_description' ); ?></p>
									</div>

									<?php endwhile; ?>
								<?php else : ?>
									<?php // no rows found ?>
								<?php endif; ?>

							</section><!-- .content-item-->

						<?php elseif ( get_row_layout() == 'contact' ) : ?>

							<section id="item-<?php echo $itemid; ?>" data-content-item="item-<?php echo $itemid++ ;?>" class="content-item fade-item grid-row-holder" data-move-ratio="0">

								<?php// the_sub_field( 'menu_title' ); ?>
								 
								<div class="grid-item push-left-md-3 push-left-lg-4 grid-xs-10 grid-sm-5 grid-md-4 grid-lg-4">

									<div class="contact-item h3"><?php the_sub_field( 'postal_address_title' ); ?></div>
									<div class="contact-item"><?php the_sub_field( 'postal_address' ); ?></div>
									<div class="contact-item">
										<a href="mailto:<?php the_sub_field( 'email_address' ); ?>?subject=<?php the_sub_field( 'email_subject_title' ); ?>"><?php the_sub_field( 'email_address' ); ?>
										</a>
									</div>
									<div class="contact-item"><?php the_sub_field( 'phone_number' ); ?></div>
	 
	 							</div>
								
								<div class="grid-item grid-xs-10 grid-sm-5 grid-md-3 grid-lg-2">
								 	
								 	<a class="privacy" href="<?php echo home_url();?>/privacy-policy/">
								 	Privacy policy
								 	</a>

								</div>

								<div class="grid-item grid-xs-10 grid-sm-5 grid-md-3 grid-lg-2">
								 	
								 	<a class="privacy jobs" href="<?php echo home_url();?>/vacancy-opportunities/">
								 	Job Vacancies
								 	</a>

								</div>

								<?php if ( get_sub_field( 'map' ) == 1 ) : ?>

									<div id="g-map-holder">
											
										<div id="g-map-mask">
 										<div id="g-map"></div>
										</div>

									</div> 

								<?php else : // no map: ?>
									<?php // no rows found ?>
								<?php endif; ?>
									
				
							</section><!-- .content-item-->	

						<?php endif; ?>

					<?php endwhile; //while ( have_rows( 'page_content' ) ) : the_row(); ?>

				</div><!-- .grid-row-holder.main -->

	<?php else: // if ( have_rows( 'page_content' ) ):?>

		<?php // no layouts found ?>

	<?php endif; // if ( have_rows( 'page_content' ) ): ?>

	</div><!-- .main-fixer -->


	 		<?php // END eview this page content; move nto other template?



 		 ?>
<!-- moved nto header.php so delete this <div id="main" class="wrapper"> -->

 
