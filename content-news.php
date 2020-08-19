<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 *
 *  * To do - this is old/inp markup; so review everythin inside the barba container 
 */
?>


<?php if ( is_home()):?>
is home content-news.php
<?php the_content();?>

<?php endif;// is home */?>

<?php if (is_single()):
	$date = get_the_date('jS F Y');
	$categories = get_the_category( $post->ID );
 	$related = get_field('related_posts'); // post object
	?>

	<div class="header-wrap">
	
		<div class="post-title">
			<?php the_title();?>
		</div>

		<div class="line">
		</div>

		<div class="date">
			<?php echo $date;?>
		</div>
	</div><!--header-wrap-->
	
	<div class="post-wrap">
		<?php the_content();?>
	</div><!--post-wrap-->

	<?php	// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :?>

			<div class="comments-wrap">
		
				<?php comments_template();?>
	
			</div>

		<?php
	endif; ?>

	<?php if ( $related ) : 
		$related_count = count($related); 
		function echocheck($number){ 
			if($number % 2 == 0){
				$firstclass = "grid-md-12";
 				echo "even";  
			} 
			else{ 
				$firstclass = "grid-lg-6"; 
				echo "odd"; 
			} 
		} 
		function gridclass($number){ 
			if($number % 2 == 0){
				echo "grid-md-6"; 
 
			} 
			else{ 
				 echo "grid-md-12";

			} 
		} 

		
		
		?>
		



		<div class="related-items-wrap" data-total-post="<?php echocheck($related_count) ?>">

		<div class="related-items-title">
			Related Posts
		</div><!--.related-items-title-->

		<div class="grid-row-holder">

			<?php foreach( $related as $post):

				setup_postdata($post);
				$countpost = 0;
				$countpost++;
				$relatedtitle = get_the_title();
				$relatedurl = get_permalink($post->ID); //
				$featureimage = get_field('feature_image'); // image
	
				if ( get_post_status ($post->ID ) == 'publish'):?>

				<a href="<?php echo the_permalink();?>" class="grid-item grid-xs-12 <?php if ($countpost === 1 ):?><?php gridclass($related_count);?><?php endif;?>">

						<div class="header-wrap related-header-wrap">
							
							<div class="post-title">
								<?php the_title();?>
							</div>

							<div class="line">
							</div>

							<div class="date">
								<?php echo $date;?>
							</div>
							
						</div><!--header-wrap-->

						<?php if($featureimage)://	$featureimage available?>

							<div class="image-wrap">
						
								<img class="apply-image-load thumb-image-item" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo esc_url($featureimage['url']); ?>" alt="<?php echo esc_attr($featureimage['alt']); ?>" />
							
							</div><!-- .image-wrap -->			 

						<?php else: // $featureimage not available?>
							
						<?php 
						/*
						foreach($categories as $category){
						$categoryid = $category->cat_ID;
						//echo $categoryid;
						};

						if($categoryid == '7' ): // if merchandise: ?>
						
							<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/dist/img/news_placeholder_1.png">

						<?php elseif ($categoryid == '8' ): // if release: ?>
						
							<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/dist/img/release_placeholder_square.png">

						<?php elseif ($categoryid == '1' ): // if Uncategorised: ?>
							
							<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/dist/img/news_placeholder_1.png">

						<?php else: // No Category has been ticked: ?>

							<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/dist/img/news_placeholder_1.png">

						<?php endif; //$categories  */ ?>

						<?php endif; //$featureimage  ?>

					</a>

				<?php endif //( get_post_status ($post->ID ) == 'publish' ): ?>

			<?php endforeach; ?>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		
		</div><!--.grid-row-holder-->

		</div><!--.related-items-wrap -->
	
	<?php endif; ?>

<?php endif; // is single ?>

<?php if (is_archive()): 
	
	$featureimage = get_field('feature_image'); // image
	//$featureimagecredit =  get_field('feature_image_credit');  // text
	$date = get_the_date('jS F Y');
	$categories = get_the_category( $post->ID )
	?>
			
		
		<a href="<?php echo the_permalink();?>" class="">

			<div class="header-wrap">
				
				<div class="post-title">
					<?php the_title();?>
				</div>

				<div class="line">
				</div>

				<div class="date">
					<?php echo $date;?>
				</div>
				
			</div><!--header-wrap-->

			<?php if($featureimage)://	$featureimage available?>
			
				<div class="image-wrap">
             
					 <img class="apply-image-load thumb-image-item" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo esc_url($featureimage['url']); ?>" alt="<?php echo esc_attr($featureimage['alt']); ?>" />
 				  
				 </div><!-- .image-wrap -->			 

			<?php else: // $featureimage not available?>
				

				<?php 
				/*
				foreach($categories as $category){
				$categoryid = $category->cat_ID;
				//echo $categoryid;
				};

				if($categoryid == '7' ): // if merchandise: ?>
				
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/dist/img/news_placeholder_1.png">
 
				<?php elseif ($categoryid == '8' ): // if release: ?>
				
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/dist/img/release_placeholder_square.png">
 
				<?php elseif ($categoryid == '1' ): // if Uncategorised: ?>
					
					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/dist/img/news_placeholder_1.png">
 		
				<?php else: // No Category has been ticked: ?>

					<img class="thumb-image-item place-holder" src="<?php echo bloginfo('template_directory'); ?>/dist/img/news_placeholder_1.png">
 
				<?php endif; //$categories  */ ?>

			<?php endif; //$featureimage  ?>
 

		</a>

	</article><!-- .news-item -->


<?php endif;  // is archive ?>
