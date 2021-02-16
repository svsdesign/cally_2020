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

<?php else:

    $image_data = get_field('image-data_hidden_field'); //text
    $submission_name = get_field('submission_name'); //text
    $submission_description = get_field('your_park_description'); //text
    $submission_suggestion = get_field('your_park_suggestion'); //text
    $submission_email = get_field('your_park_suggestion'); //text

      if ( $image_data ) : ?>
</br>
      <?php echo '<img class="submission-image" src="'.$image_data.'"/>';
     
      endif;
      // echo '<img src="data:image/jpeg;base64,'.base64_encode($test).'">';
        ?>

    <?php if ($submission_name):?>
      </br>
      <h2 class="submission-name">
        <?php echo $submission_name;?>
    </h2></br>

    <?php endif; ?>

    <?php if ($submission_description):?>
      <div class="submission-header"> Description</div>
     
      <div class="submission-description">
        <?php echo $submission_description;?>
      </div></br>

    <?php endif; ?>

    <?php if ($submission_suggestion):?>
      <div class="submission-header"> Suggestion</div>
    <div class="submission-suggestion">
      <?php echo $submission_suggestion;?>
    </div></br>

  <?php endif; ?>

<?php endif; ?>

 