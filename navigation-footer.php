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

		<div class="footer-branding">
			<span class="title">
			Cultivating CAlly -
			</span>
			<span class="sub-title">
			A Community Garden Project
			</span>
		</div>
		
		<div class="footer-socials">
			<ul>
				<li>
					<a href="">T
					</a>
				</li>
				<li>
					<a href="">I
					</a>
				</li>
				<li>
					<a href="">F
					</a>
				</li>
			</ul>
		</div><!-- .footer-socials -->
		
		<div class="footer-navigation">

			<?php wp_nav_menu( array(
			'menu' => 'Footer Navigation',
			'container_class' =>'menu-footer',
			) );?>
			
			<div class="svs-branding">
				by:
				<a href="https://svs.design">
				svs.design
				</a>
			</div>

		</div><!-- .footer-navigation -->

	</div><!-- .grid-container -->

</div><!-- id="footer-nav-area" -->