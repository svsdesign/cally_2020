<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 *  
 */
?>
<div id="header-nav-area" class="nav-item"> <!-- grid-container class removed; delete this commments --> 

	<div class="navigation grid-container nav-fixer"><!-- this the navare item that moves-->
 
 			<div id="menu-positioner-wrap">	 
 				
 				<div id="positioner">
	 				<div id="inner-positioner">
	 				</div>
	 			</div>

 			</div><!--#menu-positioner-wrap-->

			<div class="menu-wrap">	 

				<?php wp_nav_menu( array(
				    'menu' => 'Header Navigation',
				    'container_class' =>'menu-header',
				    ) );
				?> 
		 		
		 	</div><!--.menu-wrap-->
 
	</div><!-- grid-container -->

	 <div class="nav-toggle-wrapper grid-container">

		<?php get_template_part( 'nav_toggle_animation' );?>

	</div><!--.navgiation-toggle.grid-container-->

</div><!-- id="header-nav-area" class="nav-item"-->