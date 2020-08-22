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

			<div class="footer-branding grid-item grid-xs-12 grid-md-6">
				<span class="title">
				Cultivating CAlly -
				</span>
				<span class="sub-title">
				A Community Garden Project
				</span>
			</div>
				
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
			
			<div class="footer-navigation grid-item grid-xs-12">

				<div class="grid-row-holder">

					<?php wp_nav_menu( array(
					'menu' => 'Footer Navigation',
					'container_class' =>'menu-footer grid-row-holder grid-item grid-xs-12 grid-md-6',
					) );?>
					
					<div class="svs-branding grid-item grid-xs-12 grid-md-6">
					
						<div class="svs-wrap">
							by:
							<a href="https://svs.design">
							svs.design
							</a>
						</div>


					</div>

				</div><!-- .grid-row-holder -->

			</div><!-- .footer-navigation -->

		</div><!-- .grid-row-holder -->

	</div><!-- .grid-container -->

</div><!-- id="footer-nav-area" -->