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
 

<?php if ( is_user_logged_in() ):

the_content();?>

 <?php else: ?>

      <?php
      $image_data = get_field('image-data_hidden_field'); //text
      $submission_name = get_field('submission_name'); //text

      $submission_description = get_field('your_park_description'); //text
      $submission_suggestion = get_field('your_park_suggestion'); //text

/*
Edit Duplicate Move Delete
Text Area
2
Suggestion Message
Text Area
3
Image Test
an_image_testImage
4
Name
Text
5
Email
submission_email
*/


                       
      if ( $image_data ) : ?>

      <?php 
      //echo     $test; 
      echo '<img class="submission-image" src="'.$image_data.'"/>';
      ?>
      <?php endif;
      // echo '<img src="data:image/jpeg;base64,'.base64_encode($test).'">';
        ?>

    <?php if ($submission_name):?>
    
      <div class="submission-name">
        <?php echo $submission_name;?>
      </div>

    <?php endif; ?>

    <?php if ($submission_description):?>
    
      <div class="submission-description">
        <?php echo $submission_description;?>
      </div>

    <?php endif; ?>

    <?php if ($submission_suggestion):?>
    
    <div class="submission-suggestion">
      <?php echo $submission_suggestion;?>
    </div>

  <?php endif; ?>

    <?php //endif; ?>

  <?php endif;?>
