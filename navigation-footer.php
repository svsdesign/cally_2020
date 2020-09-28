<?php
/**
 *  Cally 2020
 *  
 *  Design + Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  
 */
?>

<div id="footer-nav-area">

	<div class="grid-container">

		<div class="grid-row-holder">

		<div class="footer-socials grid-item grid-xs-12 grid-md-6">
			
				<ul>
					<li>
						<a class="social-link" href="">
						<?php get_template_part( '/dist/svg/inline-twitter_svg' ); ?>						 
						</a>
					</li>
					<li>
						<a class="social-link" href="">
						<?php get_template_part( '/dist/svg/inline-instagram_svg' ); ?>						 
						</a>
					</li>
					<li>
						<a class="social-link" href="">
						<?php get_template_part( '/dist/svg/inline-facebook_svg' ); ?>						 
						</a>
					</li>
				</ul>

			</div><!-- .footer-socials -->

			<div class="footer-branding grid-item grid-xs-12 grid-md-6">
			
				<a href="<?php echo get_home_url();?>">
					<span class="title">
					Cultivating Cally -
					</span>
					<span class="sub-title">
					The Community Gardening Project
					</span>
				</a>
			</div>
			
			<div class="footer-sponsors cally-branding grid-item grid-xs-12">
					
				<div class="grid-row-holder">


					<div class="title grid-item grid-xs-12">
					A legacy project </br> brought to you by:
					</div>


					<div class="cally-fest-branding grid-item grid-xs-12 grid-md-6">

						<a href="https://thecallyfestival.com/">
						<?php get_template_part( '/dist/svg/inline-cally-fest_svg' ); ?>						 
						</a>

					</div><!-- .cally-fest-branding -->

					<div class="sponsor-branding grid-item grid-xs-12 grid-md-6">
						
						<ul>
							<li>
								<a class="proj-sponsor-link" href="">
 								<?php get_template_part( '/dist/svg/inline-islington-council_svg' ); ?>						 

								<?php //get_template_part( '/dist/svg/inline-twitter_svg' ); ?>						 
								</a>
							</li>
							<li>
								<a class="proj-sponsor-link" href="">
 								<?php get_template_part( '/dist/svg/inline-ipa_svg' ); ?>						 

								<?php //get_template_part( '/dist/svg/inline-twitter_svg' ); ?>						 
								</a>
							</li>
							<li>
								<a class="proj-sponsor-link" href="">
 								<?php get_template_part( '/dist/svg/inline-mayor-fund_svg' ); ?>						 
 								<?php //get_template_part( '/dist/svg/inline-twitter_svg' ); ?>						 
								</a>
							</li>
						</ul>

					</div>

				</div><!-- .grid-row-holder -->

			</div><!-- .footer-sponsor -->

			<div class="footer-navigation grid-item grid-xs-12">

				<div class="grid-row-holder">

					<?php wp_nav_menu( array(
					'menu' => 'Footer Navigation',
					'container_class' =>'menu-footer grid-item grid-xs-12 grid-md-7 grid-lg-8',
					) );?>
					
					<div class="svs-branding grid-item grid-xs-6 grid-md-3 grid-lg-2">
					
						<div class="svs-wrap">
							by:
							<a href="https://svs.design">
							svs.design
							</a>
						</div>


					</div>
					<div class="copyright grid-item grid-xs-6 grid-md-2 grid-lg-2">

					&copy; <?php echo date("Y"); ?>

				</div><!-- .grid-row-holder -->

			</div><!-- .footer-navigation -->

		</div><!-- .grid-row-holder -->

	</div><!-- .grid-container -->

</div><!-- id="footer-nav-area" -->