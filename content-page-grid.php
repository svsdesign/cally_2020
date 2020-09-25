<?php
/**
 *  Cally 2020
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 * 
 *  content-page-grid.php
 * 
 * TO DO
 * Remove aos references
 * Remove acf option fields that we don't need
 * Don't allow images to be selected/uploaded. They should just be the "featured image:" of said post
 * Ensure x amount of grid items. We talked about having a "sink" - but this maybe a bit complex
 * Ensure non logged in people can have the grid saved to their local storage
 * Ensure css from felicity layout grid and theseus grid are consolidated; sizes etc.
 * classes such as "site-grid-row-holder" to be added
 * Ensure styling for the options panel is improved + fixed in correct place etc
 * 
 * REST API + USERS
 * Ensure the js allows local storage for people not logged in & for people who are logged in; the "master" grid
 * This master grid to also be the initial grid that the local storage takes the values from
 * This might involved setting up additional rest api endpoint maybe
 * 
 * DEV GRIDS
 * Ensure there are no conflicts between the site's layout grid (thesues one) and the one we have for the layout grid (felicity's)
 * Ensure no conflicts in term of php/html markup; js and css.
 * 
 * 
 * Packery + JS issues
 * vendors.min.js?ver=1595432587:1 packery not initialized. Cannot call methods, i.e. $().packery("destroy")
 * 
 * 
 * 
 * https://wordpress.stackexchange.com/questions/348231/how-do-i-correctly-setup-an-ajax-nonce-for-wordpress-rest-api
 * 
 */
?>

<div class="page-loader-wrap"> 

    <div class="page-loader">
    Please wait, Interactive Grid Loading  
    </div>
          
</div><!--.page-loader-wrap-->

<div class="grid-container">

  <?php //additional content:
  the_content();?>

</div><!--.grid-container-->


 
  <?php if ( is_user_logged_in() ):

    $edit = true;
    $post_id = get_the_ID();
    $url     = site_url( 'wp-json/acf/v3/posts/' ) . $post_id;
	  $post  = get_post( $post_id );
      

    else:  // not logged in 

//gonzales example; local storage?
 /*
    $edit = true;
	
	if ( $edit ) {
		global $post;

		$post_id = get_the_ID();// was1;
		$url     = site_url( 'wp-json/acf/v3/post/' ) . $post_id;
		$post    = get_post( $post_id );
		
		setup_postdata( $post );
	} else {
		$url = site_url( 'wp-json/wp/v3/posts' );
    }*/

    $edit = true;
    $post_id = get_the_ID();
    $url     = site_url( 'wp-json/acf/v3/posts/' ) . $post_id;
 
    // $url     = site_url( 'wp-json/acf/v3/posts/' ) . $post_id ."?_wpnonce=<nonce>"; / 
    // $url     = site_url( 'wp-json/acf/v3/posts/' ) . $post_id ."?_wpnonce=&lt;nonce&gt;";
	$post  = get_post( $post_id );
      
 
 
    endif;//is_user_logged_in() ?>

<div class="touch-notification-wrapper">

  <div class="grid-container">

    <div class="site-grid-item site-grid-xxxs-16 site-grid-xxs-16">
      Sorry, our interactive grid is not supported on touch devices, please visit this page on a Desktop instead.
    </div><!-- .site-grid-item -->

  </div><!-- .grid-container -->

</div><!--touch-noticication-wrapper-->


<div class="small-screen-notification-wrapper">

  <div class="grid-container">

    <div class="site-grid-item site-grid-xxxs-16 site-grid-xxs-16">
      Sorry, our interactive grid is not supported on small screens, please enlarge your browser.
    </div><!-- .site-grid-item -->

  </div><!-- .grid-container -->

</div><!--touch-noticication-wrapper-->

<div class="grid-layer">
  
    <div class="reset-holder" data-html2canvas-ignore="true">

      <a id="clear-local-storage" type="button" class="clear-local-storage btn btn-primary download-image grid-xs-12">
        Reset Layout 
        <span  class="small">Clears all data and reloads page</span>
      </a> 
      
    </div>

    <div class="grid-container">

      <?php if ( is_user_logged_in() ) :?>
      
        <form id="grid" class="grid-row-holder" action="<?php echo esc_url( $url ); ?>" method="<?php echo $edit ? 'PUT' : 'POST'; ?>">

          <div class="site-grid-container dev-layout-grid-toggle-wrap">

            <div class="site-grid-row-holder">

                <div class="dev-layout-grid-toggle site-grid-item site-grid-xxxs-16 site-grid-xxs-16">

                    <div class="is-off">
                      <div class="follow">
                          <div class="inner-follow">
                          Click to Start
                          </div>
                        </div>
                    </div>

                    <div class="is-on">
                    Close Edit Mode
                    </div>

                </div><!-- .site-grid-item -->

            </div><!-- .site-grid-row-holder -->

          </div><!-- .dev-layout-grid-toggle -->

        <?php else: // not logged in?>

          <?php /* https://deliciousbrains.com/using-wp-rest-api-wordpress-4-4/
          
          doesn't worl  <form action="<?php echo esc_url( $url ); ?>?_wpnonce=<nonce>" method="<?php echo $edit ? 'PUT' : 'POST'; ?>">
                  <form action="<?php echo esc_url( $url ); ?>" method="<?php echo $edit ? 'PUT' : 'POST'; ?>">
          */?>

<?php /*    <form id="grid" action="<?php echo esc_url( $url ); ?>" method="<?php echo $edit ? 'PUT' : 'POST'; ?>">
 */?>        <div id="grid" class="grid-row-holder">
   
              <div class="site-grid-container dev-layout-grid-toggle-wrap">

                  <div class="site-grid-row-holder">

                      <div class="dev-layout-grid-toggle site-grid-item site-grid-xxxs-16 site-grid-xxs-16">

                        <div class="is-off">
                          <div class="follow">
                              <div class="inner-follow">
                              Click to Start
                              </div>
                            </div>
                        </div>

                         <!-- <div class="is-on"> not need
                          Close Edit Mode
                          </div> -->

                      </div><!-- .site-grid-item -->

                  </div><!-- .site-grid-row-holder -->

              </div><!-- .dev-layout-grid-toggle -->

          <?php /*- this "cooordinates input exist twice - that an error? */ ?>

          <?php  /* was this before adding same options as logged in
            <input type="hidden" name="fields[coordinates]" class="form-control" rows="3"  id="coordinates" value="<?php echo esc_attr( get_field( 'coordinates' )); ?>">
          */ ?>

      <?php endif;//is_user_logged_in() ?>


          <?php
          $repeater = get_field( 'layout_items' );

          if ( ! $repeater ) {
              $repeater = array(
                  array(
                    'item_id' => '', // w - 25 - 50 - 75 - 100
                    'item_size_w' => '', // w - 25 - 50 - 75 - 100
                    'item_size_h' => '',// h - 25 - 50 - 75 - 100
                    'item_z-index' => '',// image
                    'item_image' => '',// image
                    'image_scale' => '', // range: 1 to 100 - review this
                    'image_position_x' => '', // range: -100 to 100
                    'image_position_y' => '', // range: -100 to 100
                    'associated_segment' => '', // post object
                  )
              );
          } ?>

        <div class="repeater-wrap">

            <?php if ( is_user_logged_in() ) :?>

              <div class="grid-options-wrap site-grid-container">

                  <div class="site-grid-row-holder grid-options">

                      <button type="button" class="btn site-grid-item site-grid-xxxs-16 site-grid-xxs-2 btn-primary add-row">Add Item</button>
                      <button type="submit" class="btn site-grid-item site-grid-xxxs-16 site-grid-xxs-2 btn-success">Save All</button>
 
                      <div class="response-message-wrap site-grid-item">

                          <div class="response-message">
                          Layout Saved
                          </div>

                      </div><!--.response-message-wrap-->

                      <div class="grid-response site-grid-item site-grid-xxxs-16" style="display:block;">

                          <span class="input-group-addon">Endpoint</span>
                          <input type="text" class="form-control" value="<?php echo esc_url( $url ); ?>" readonly>

                          <div class="form-group">
                            <label>Packery Posistions</label>
                            <input type="text" name="fields[coordinates]" class="form-control coordinates" rows="3"  id="coordinates-<?php echo $post_id?>" value="<?php echo esc_attr( get_field( 'coordinates' )); ?>">
                          </div>

                      </div><!--.grid-response-->

                  </div><!--site-grid-row-holder-->

              </div><!-- .grid-options-wrap-->

            <?php else: // not logged in?>

              <div class="grid-options-wrap site-grid-container">

                  <div class="site-grid-row-holder grid-options">

                      <button type="button" class="btn site-grid-item site-grid-xxxs-16 site-grid-xxs-2 btn-primary add-row">Add Item</button>
                      <button type="submit" class="btn site-grid-item site-grid-xxxs-16 site-grid-xxs-2 btn-success">Save All</button>
                      <div class="response-message-wrap site-grid-item">

                          <div class="response-message">
                          Layout Saved
                          </div>

                      </div><!--.response-message-wrap-->

                      <div class="grid-response site-grid-item site-grid-xxxs-16" style="display:block">

                          <span class="input-group-addon">Endpoint</span>
                          <input type="text" class="form-control" value="<?php echo esc_url( $url ); ?>" readonly>

                          <div class="form-group">
                          <label>Packery Posistions</label>
                          <input type="text" name="fields[coordinates]" class="form-control coordinates" id="coordinates-<?php echo $post_id?>" value="<?php echo esc_attr( get_field( 'coordinates' )); ?>">
                          </div>

                      </div><!--.grid-response-->

                  </div><!--site-grid-row-holder-->

                  </div><!-- .grid-options-wrap-->

          
            <?php endif;//is_user_logged_in() ?>

              <div id="grid-wraps">

                <div id="tester-grid-id" class="grid repeater">

                    <?php foreach ( $repeater as $k => $v ):


                      $image_id     = $v['item_image'];//get_field( 'ag_image' );
                      $source_image = wp_get_attachment_image_src( $image_id, 'full' );

                    // review this - do we need tadd the active link in the item at data attribute?
                      foreach ( (array) get_posts((array('post_type' => 'segments','post_status' => 'publish'))) as $p ) :
                        if ( isset( $post_object->ID ) ) {
                          $selected = selected( $post_object->ID, $p->ID, false );
                        } else {
                          $selected = '';
                        }?>
                      <?php $activelink = get_permalink($p->ID); ?>

                      <?php endforeach; ?>

                      <?php

                      $class = '';

                      if ( !is_user_logged_in() ) :

                        // user is not logged in
                        $class = ' link-item';

                      endif;

                      ?>

                      <div data-item-id="<?php echo esc_attr( $v['item_id'] ); ?>"  data-url="<?php echo $activelink;?>" data-item-z-index="<?php echo esc_attr( $v['item_z-index'] ); ?>" name="fields[layout_items][<?php echo absint( $k ); ?>][item_size_w][item_size_h]['item_z-index']['image_scale]['image_position_x']['image_position_y']['associated_segment']['image_rotate]" 
                      class="layout-grid-item repeater-item grid-fade-item 
                      grid-item-width-<?php echo esc_attr( $v['item_size_w']/25 ); ?> 
                      item-z-index-<?php echo esc_attr( $v['item_z-index'] ); ?> 
                      grid-item-height-<?php echo esc_attr( $v['item_size_h']/25 ); ?><?php if (!$source_image ):?> blank-item<?php endif; ?><?php echo $class; ?>">


                        <?php /* [DOM] Found 21 elements with non-unique id #:
                            (More info: https://goo.gl/9p2vKq)
                              <input class=​"input-id" data-input-type=​"input-id" id type=​"number" name=​"fields[layout_items]​[0]​[item_id]​" value=​"4">​
                              TODO - resolve this.
                                  -->*/?>

                          <div class="grid-item-options-toggle">

                            <div class="is-on">
                            <?php /* Close */?>
                            </div>

                            <div class="is-off">
                            Edit
                            </div>

                          
                          </div><!--grid-item-options-toggle-->
                        
                          <div class="move-arrow-area">
                            <?php get_template_part( '/dist/svg/inline-move_arrow_svg' ); ?>						 
                           </div>


                          <div class="btn grid-item-options-toggle grid-item-options-toggle-rotate">

                            <div class="rotate" style="
                                transform:
                                rotate(<?php echo esc_attr( $v['item_rotate'] ); ?>deg)">

                  

                            <?php get_template_part( '/dist/svg/inline-rotate_arrow_svg' ); ?>						 

                                <label style="display:none;">

                                  <span class="options-item-title sub-title">rotate (in %)</span>
                                    <input class="input-rotate" data-input-type="input-rotate" min="0" max="360" step="90" type="number" name="fields[layout_items][<?php echo absint( $k ); ?>][item_rotate]" value="<?php echo esc_attr( $v['item_rotate'] ); ?>">
                                </label>
    
                            </div>
    
                          </div><!--grid-item-options-toggle-rotate-->

                          <div class="grid-item-options site-grid-container">

                            <div class="site-grid-row-holder">

                              <div class="grid-item-options-item item-options-item site-grid-item site-grid-xxxs-16 site-grid-xs-8 site-grid-sm-6">

                              
                              <!-- <div class="options left-options"> -->

                                  <?php /* <!--eventually hide input id field type="hidden" yet ensure remains updated -->*/?>

                                <div class="label-wrapper">

                                  <label style="display:none;"><!-- or hide like so -->
                                  <span class="options-item-title sub-title">ID</span>
                                  <input class="input-id" data-input-type="input-id" type="number" name="fields[layout_items][<?php echo absint( $k ); ?>][item_id]" value="<?php echo esc_attr( $v['item_id'] ); ?>">
                                  </label>

                                  <label style="display:none;">
                                  <span class="options-item-title sub-title">Width (in %)</span>
                                    <input class="input-width" data-input-type="input-width" min="25" max="100" step="25" type="number" name="fields[layout_items][<?php echo absint( $k ); ?>][item_size_w]" value="<?php echo esc_attr( $v['item_size_w'] ); ?>">
                                  </label>

                                  <label style="display:none;">
                                    <span class="options-item-title sub-title">Height (in %)</span>
                                    <input class="input-height" data-input-type="input-height" min="25" max="100" step="25" type="number" name="fields[layout_items][<?php echo absint( $k ); ?>][item_size_h]" value="<?php echo esc_attr( $v['item_size_h'] ); ?>">
                                  </label>

                                  <label style="display:none;">
                                    <span class="options-item-title sub-title">Z-index</span>
                                    <input class="input-z-index" data-input-type="input-z-index" min="1" max="190" step="1" type="number" name="fields[layout_items][<?php echo absint( $k ); ?>][item_z-index]" value="<?php echo esc_attr( $v['item_z-index'] ); ?>">
                                  </label>

                                </div>

                                <div class="post-options-item">

                                      <?php $post_object = $v['associated_segment']; // move this somwhere or just change  $post_object to correct value below ?>

                    
                                      <div class="options post-object">
                                        <fieldset>

                                          <label for="acf-post-object-<?php echo esc_attr( $v['item_id'] ); ?>">
                                        <!--  <span class="options-item-title">Associated Segment:</span>-->

                                      <?php/* select had this: id="acf-post-object" */?>
                                            <select class="form-control input-sm image-ui acf-post-object" 
                                            id="acf-post-object-<?php echo esc_attr( $v['item_id'] ); ?>" 
                                            name="fields[layout_items][<?php echo absint( $k ); ?>][associated_segment]">
                                              <option value="">SELECT:</option>
                                              <?php 
                                                //https://stackoverflow.com/questions/2965971/how-to-add-images-in-select-list
                                                // this bg doesn't work in most browsers; use jquery ui instead:
                                                //https://jqueryui.com/selectmenu/#custom_render
                                                foreach ( (array) get_posts((array('post_type' => 'segments','post_status' => 'publish', 'numberposts' => -1 ))) as $p ) :
                                                $segmentimage = get_field( 'segment_image',$p->ID ); //array
                                                $segmenttype = get_field( 'segment_type',$p->ID ); //radiobutton; return value

                                                  if ( isset( $post_object->ID ) ) {
                                                    $selected = selected( $post_object->ID, $p->ID, false );
                                                    // $segmentimage = get_field( 'segment_image',$p->ID ); //array
                                                  
                                                    
                                                  } else {
                                                    $selected = '';
                                                  }?>
                                                  
                                                                            
                                                
                                                <option <?php echo esc_attr( $selected ); ?> 
                                                <?php if( !empty($segmentimage) ): ?> 
                                                  data-segment-image="<?php echo $segmentimage['url']; ?>" 
                                                  data-segment-type="<?php echo $segmenttype;?>"
                                                  data-class="avatar" 
                                                  data-style="background-image: url('<?php echo $segmentimage['url']; ?>');"
                                                <?php endif; ?> 
                                                  value="<?php echo $p->ID; ?>">
                                                  
                                                  
                                                  <div class="title">
                                                  <div><?php echo $p->post_title; ?></div>
                                                  </div>
                                                 </option>
                                                <?php //echo $activelink;?>

                                                <?php endforeach; ?>

                                            </select>

                                          </label>
                                        
                                        </fieldset>

                                      </div>
                                      <!-- </div>  .options left-options -->

                                      <!--  <div class="options right-options"> -->

                                      </div><!-- .grid-item-options-item  -->

                              </div><!-- .grid-item-options-item  -->

                              <div class="grid-item-options-item image-options-item site-grid-item site-grid-xxxs-16 site-grid-xs-8 site-grid-sm-6" style="display:none;">

                                <div class="options-item-title">
                                  Image Options:
                                  </div>

                                  <label>
                                    <span class="options-item-title sub-title">Offset X</span>
                                    <input class="input-image-position-x" min="-100" max="100" data-input-type="input-image-position-x" type="range" name="fields[layout_items][<?php echo absint( $k ); ?>][image_position_x]" value="<?php echo esc_attr( $v['image_position_x'] ); ?>">
                                  </label>

                                  <label>
                                  <span class="options-item-title sub-title">Offset Y</span>
                                  <input class="input-image-position-y" min="-100" max="100" data-input-type="input-image-position-y" type="range" name="fields[layout_items][<?php echo absint( $k ); ?>][image_position_y]" value="<?php echo esc_attr( $v['image_position_y'] ); ?>">
                                  </label>

                                  <label>
                                  <span class="options-item-title sub-title">Scale</span>
                                  <input class="input-image-scale" min="1" max="200" data-input-type="input-image-scale" type="range" name="fields[layout_items][<?php echo absint( $k ); ?>][image_scale]" value="<?php echo esc_attr( $v['image_scale'] ); ?>">
                                  </label>

                              </div><!-- .grid-item-options-item  -->

                              <div class="grid-item-options-item button-options-item site-grid-item site-grid-xxxs-16 site-grid-sm-4" style="display:none;">

                                  <button type="button" class="btn acf-image-remove" id="acf-image-remove-<?php echo esc_attr( $v['item_id'] ); ?>">
                                  Remove image
                                  </button>

                                  <button type="button" class="btn acf-image-edit" id="acf-image-edit-<?php echo esc_attr( $v['item_id'] ); ?>">
                                  Replace image
                                  </button>

                                  <button type="button" class="btn btn-danger remove-row">
                                    Remove Item
                                  </button>

                                  <span class="item-status" style="display: none;"><!-- review use of this -->
                                  </span><!-- item-status -->

                                </div><!-- .grid-item-options-item-->

                            </div><!-- .site-grid-row-holder-->

                          </div><!--.grid-item-options-->

                          <div class="inner-grid-item" 
                          style="
                          transform:
                          rotate(<?php echo esc_attr( $v['item_rotate'] ); ?>deg)
                          translateX(<?php echo esc_attr( $v['image_position_x'] ); ?>%) 
                          translateY(<?php echo esc_attr( $v['image_position_y'] ); ?>%) 
                          scale(<?php echo esc_attr( $v['image_scale']/100); ?>)">

                            <div data-aos="fade-up" data-aos-mirror="true" data-aos-duration="750" data-aos-anchor-placement="center-bottom" class="image-wrap" style="<?php if($v['item_size_h'] > $v['item_size_w'] && $source_image ) : ?>height: calc(<?php echo esc_attr( $v['item_size_w'] ); ?>vw / <?php echo $source_image[1] / $source_image[2]; ?>);<?php elseif( $source_image ) : ?> width: calc(<?php echo esc_attr( $v['item_size_h'] ); ?>vw * <?php echo $source_image[1] / $source_image[2]; ?>);<?php endif; ?>">

                            <?php /* <div class="image-wrap"> */?>

                            <?php /*       <input type="hidden" name="fields[layout_items][<?php echo absint( $k ); ?>][item_image]" value="<?php echo absint( $image_id ); ?>" class="form-control acf-image" id="acf-image-<?php echo esc_attr( $v['item_id'] ); ?>"> */?>


                                      <?php if($v['associated_segment']) :
                          
                                        $segmentimage = get_field( 'segment_image',$v['associated_segment']->ID); //array
                                        // $segmenttype = get_field( 'segment_type',$v['associated_segment']->ID); 
                                        $segmenttype = get_field( 'segment_type',$v['associated_segment']->ID); 

                                        if ( $segmentimage ) : ?>
    
                                            <img src="<?php echo $segmentimage['url']; ?>" data-segment-type="<?php echo $segmenttype;?>" class=""/>

                                            <div class="text-wrap">

                                                <div class="title t-para" style="transform: scale(<?php echo 1 / (esc_attr( $v['image_scale']/100)); ?>);">
                                                    <?php echo get_the_title($v['associated_segment']->ID);?>
                                                </div>

                                            <!--<div class="date"> Delete this?
                                            <?php /*echo $year = get_field('project_year', $v['associated_segment']->ID);*/ ?>
                                            </div> -->

                                            </div>
                                          
                                          <?php else://if ( $segmentimage ) :  ?>
                                            no seggment image
                                        <?php endif;//if ( $segmentimage ) :  ?>

                                      <?php else:// if not associated postoject ?>

                                        no associated project = no image
    
                                      <?php endif; ?>

                                  <?php// else:

                                    // TODO - add placeholder
                                    ?>
                                        <!--<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTUyMjdkZDk5NjQgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNTIyN2RkOTk2NCI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI2MSIgeT0iOTQuNSI+MTcxeDE4MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==">
                                    -->
                                  <?php //endif; ?>

                              </div>

                          </div> <!--.inner-grid-item-->


                      <?php if ( is_user_logged_in() ) :?>
                        </div><!-- layout-grid-item -->
                      <?php else: // not logged in?>
                        </div><!-- layout-grid-item -->
                      <?php endif;//is_user_logged_in() ?>


                    <?php // $itemid++;
                    endforeach; ?>

                    <div class="grid-sizer"></div>

                </div><!-- grid -->
                  
                <div id="background-map" data-html2canvas-ignore="true">
                  <!-- review this bg-map - do we even need this? -->
                <img src="<?php echo get_template_directory_uri() ?>/dist/img/freeling-bg.jpg"/>
                </div>

              </div>
  

        </div><!-- repeater-wrap -->

      <?php if ( is_user_logged_in() ) :?>
      </form>
      <?php else: // not logged in?>
      </div>
      <?php endif;//is_user_logged_in() ?>

    </div><!--.grid-container-->

    <div id="outer-front-layer">
   
      <?php //additional content *consier furher divs etc. ?>

        <img src="<?php echo get_template_directory_uri() ?>/dist/img/freeling-front-outer.png"/>
           
    </div><!--.outer-front-layer-->
    
    <div id="outer-bg-layer">
  
      <?php //additional content *consier furher divs etc. ?>
      <img src="<?php echo get_template_directory_uri() ?>/dist/img/freeling-bg-outer.png"/>
           
    </div><!--.outer-bg-layer-->

</div><!--.grid-layer-->


<div class="submission-form-wrap">  

    <div class="exports-wrap">

      <!--<div class="submission-loader-wrap" data-html2canvas-ignore="true"> -->
        <div class="submission-loader-wrap"> 
            <!-- replace with gif of sorts -->
            <div class="submission-loader">
            Loading
            </div>

        </div><!--.submission-loader-wrap-->

        <div class="grid-container">

            <div class="grid-row-holder">

              <label id="preview-label" class="grid-item grid-xs-12 grid-sm-12 grid-md-3">
              Preview
              </label>

              <div class="exports grid-item grid-xs-12 grid-sm-12 grid-md-3">
             
                  <!-- <canvas id = "my-canvas" width="2200" height="1100"></canvas> -->

                      <div id="canvas-wrap">
                      </div><!-- #canvas-wrap -->

                      <div id="export-image-wrap">

                          <div class="submission-loader">
                          Loading
                          </div>
                          
                      </div><!-- #image-wrap -->
                  
              </div><!--.exports -->

              <div class="export-options grid-item grid-xs-12 grid-sm-12 grid-md-9">
         
                <a id="load-image" type="button" class="btn btn-primary download-image grid-xs-12">
                  Preview Image
                </a> 

                <a id="download-image" type="button" class="btn site-grid-item btn-primary download-image grid-xs-12">
                  Download Your Image
                </a>

                <a href="<?php the_permalink(); ?>" id="reload-page" type="button" class="btn btn-primary download-image grid-xs-12">
                  Start Again
                </a> 

              </div><!--.export-options-->
            
            </div><!--.grid-row-holder -->

        </div><!--.grid-container -->

    </div><!--.exports-wrap -->

        
        
    <div class="form-wrap">
       
          <div class="grid-container">

          <?php

//uploading imnages
//https://rudrastyh.com/wordpress/how-to-add-images-to-media-library-from-uploaded-files-programmatically.html
// https://stackoverflow.com/questions/11511511/how-to-save-a-png-image-server-side-from-a-base64-data-string

          //  https://stackoverflow.com/questions/49442428/attach-canvas-image-created-to-input-file-to-upload-it-html5-jquery
     
          
//          https://stackoverflow.com/questions/30323004/generate-post-request-for-storing-images-in-wordpress

     //https://stackoverflow.com/questions/22329481/compressing-base64-data-uri-images    
         //https://www.codegrepper.com/code-examples/php/convert+base64+to+image+php+example


// https://stackoverflow.com/questions/23323840/ajax-send-save-base64-encoded-image-to-server

         echo do_shortcode("[wpuf_form id='310']"); ?>
          <?php// echo do_shortcode("[wpuf_edit]");?>
          </div><!--.grid-container-->

    </div><!--.form-wrap -->


</div><!--.submission-form-wrap -->
