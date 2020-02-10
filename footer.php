<?php
/**
 *  Theseus
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 *  
 */
?>

	<?php include( 'navigation-footer.php' ); // this good idea? - is this inside ajax? - review?>

</div><!-- id="main" class="wrapper"> ajax wrapper ebmnd - pssoibly review if other items below also  need to move  -->


<?php wp_footer(); ?>
	


<?php if (home_url() == "http://localhost:8888/theseus-wp-v2") :?>
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

	<div class="dev-base-lines"></div>
<?php else:?>
<?php endif; // if we're locally ?>

	 
</body>
</html>
