<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 * 
 *  content-submissions.php
 */
?>
 
<?php the_content();?>

 
<?php
$image_data = get_field('image-data_hidden_field'); //text
                                        
  if ( $image_data ) : ?>
    
    <?php 
//echo     $test; 

 
echo '<img class="submission-image" src="'.$image_data.'"/>';
?>
 
<?php 
// echo '<img src="data:image/jpeg;base64,'.base64_encode($test).'">';
?>  

<?php endif; 
