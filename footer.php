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
	<?php include( 'signup.php' );?>

	<?php include( 'navigation-footer.php' ); // this good idea? - is this inside ajax? - review?>


</div><!-- id="main" //barba -->

<?php wp_footer(); //?>

<?php// echo do_shortcode('[cookies_revoke]')?>

 

<?php if (home_url() == "http://localhost:8888/cally-2020") :?>
<?php //if (home_url() == "dontshow") :?>

	<div class="dev-grid-toggle">
	</div>

	<div class="dev-grid grid-container">

		<div class="grid-row-holder">

		    <div class="grid-item grid-xs-12 grid-sm-6 grid-md-3"><div class="inner"></div></div>
		    <div class="grid-item grid-xs-12 grid-sm-6 grid-md-3"><div class="inner"></div></div>
		    <div class="grid-item grid-xs-12 grid-sm-6 grid-md-3"><div class="inner"></div></div>
		    <div class="grid-item grid-xs-12 grid-sm-6 grid-md-3"><div class="inner"></div></div>
 
		</div>

	</div>

	<div style="display:none;" class="dev-base-lines"></div>
	
<?php else:?>
<?php endif; // if we're locally ?>

	 
</body>
</html>
