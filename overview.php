<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 *  
 */


$introtext = get_field('introduction_text'); // intorcopy

	if( is_page('about-plan') ):
		
	// need to determine if U wan t to serve up alink or #hash?
	// $fs_link = "page-is-active";
// 	about + plan  page 

	
?>


<?php elseif( is_page('freeling-street') ): 
$fs_activeclass = "page-is-active";

?>		


<?php elseif( is_page('bridgeman-road') ): 
$br_activeclass = "page-is-active";
//	bridgeman-road
?>

<?php elseif( is_page('estate-walk') ):
$ew_activeclass = "page-is-active";
?>

<?php endif;?>
 
			



<div class="sub-navigation-wrap">

	<div class="sub-navigation">

		<div class="nav-positioner">

			<ul class="sections">

				<li data-section-title="bridgeman-road"
					class="<?php if (isset($br_activeclass)): { echo $br_activeclass;}endif;?>">
					<a href="<?php echo home_url();?>/bridgeman-road/">
					Bridgeman Road
					</a>

				</li>
				<li class="line 
				<?php if (isset($br_activeclass)): { echo $br_activeclass;}endif;?>
				<?php if (isset($fs_activeclass)): { echo $fs_activeclass;}endif;?>
				">
				
				</li>	

				<li data-section-title="freeling-street"
					class="<?php if (isset($fs_activeclasss)): { echo $fs_activeclass;}endif;?>">

					<a href="<?php echo home_url();?>/freeling-street/">
 					Freeling Street
					</a>

				</li>
				<li class="line
				<?php if (isset($ew_activeclass)): { echo $ew_activeclass;}endif;?>
				<?php if (isset($fs_activeclass)): { echo $fs_activeclass;}endif;?>
				">
				
			</li>	

				<li data-section-title="estate-walk"
					class="<?php if (isset($ew_activeclass)): { echo $ew_activeclass;}endif;?>">
					<a href="<?php echo home_url();?>/estate-walk/">
					Estate Walk
					</a>
				</li>

			</ul>
			
		</div><!-- .inner -->

	</div><!-- .sub-navigation -->

</div><!-- .sub-navigation-wrap -->
 
<div class="project-overview">

	
	<?php if($introtext):?>

		<div class="intro-wrap">

			<h1 class="title intro">

				<?php echo $introtext; ?>

			</h1><!-- .title-intro -->	

		</div><!-- .intro-wrap-->

	<?php endif; // $introtext?>

	<div class="overview-images">
	
		<ul class="sections">

			<li data-section-title="bridgeman-road"
				class="<?php if (isset($br_activeclass)): { echo $br_activeclass;}endif;?>">
				<a href="<?php echo home_url();?>/bridgeman-road/">
 				</a>
				<div class="area bridgeman-area" style="background-image: url(<?php echo get_template_directory_uri() ?>/dist/img/overview-bridgeman-square.png);">
				</div>
			</li>
		
			 <li data-section-title="freeling-street"
				 class="<?php if (isset($fs_activeclasss)): { echo $fs_activeclass;}endif;?>">
				 <a href="<?php echo home_url();?>/freeling-street/">
 				</a>
				 <div class="area freeling-area" style="background-image: url(<?php echo get_template_directory_uri() ?>/dist/img/overview-freeling-square.png);">
				</div>
			</li>
			
			 <li data-section-title="estate-walk"
			 	class="<?php if (isset($ew_activeclass)): { echo $ew_activeclass;}endif;?>">
				 <a href="<?php echo home_url();?>/estate-walk/">
 				</a>
				<div class="area estate-area" style="background-image: url(<?php echo get_template_directory_uri() ?>/dist/img/overview-walkway-square.png);">
				</div>
			</li>

			<li class="overview-bg bg-is-active">
				 <div class="area" style="background-image: url(<?php echo get_template_directory_uri() ?>/dist/img/overview-grey-square.jpg);">
				</div>
			</li>

		</ul>
		
	</div><!-- .overview-images -->

</div><!-- .project-overview -->