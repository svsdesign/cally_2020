<?php 
	$edit = true;
	
	if ( $edit ) {
		global $post;

        $post_id = 2;


        $url     = site_url( 'wp-json/acf/v3/posts/' ) . $post_id;
		$post    = get_post( $post_id );
		
		setup_postdata( $post );
	} else {
		$url = site_url( 'wp-json/wp/v3/posts' );
	}

?>

<!--	<a href="https://github.com/airesvsg/acf-to-rest-api" target="_blank" id="ribbon"><img src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png"></a> -->

	<div class="container">
 
		<div class="row">

   			<div class="col-lg-12">
				<div class="input-group">
					<span class="input-group-addon">Endpoint</span>
					<input type="text" class="form-control" value="<?php echo esc_url( $url ); ?>" readonly>
				</div>
   			</div>

			<div class="col-lg-12">	           	
				
				<form action="<?php echo esc_url( $url ); ?>" method="<?php echo $edit ? 'PUT' : 'POST'; ?>">

					<?php if( ! $edit ) : ?>
						<div class="form-group">
							<label for="acf-title">Title</label>
							<input type="text" name="title" class="form-control" id="acf-title">
						</div>

						<div class="form-group">
							<label for="acf-content">Content</label>
							<textarea name="content" class="form-control" rows="3"  id="acf-content"></textarea>
						</div>
					<?php endif; ?>
					
					
					<div class="tab-content">

						<div role="tabpanel" class="tab-pane active" id="cnt-basic">

							<!-- text area -->
							<div class="form-group">
								<label for="acf-textarea">Packery Posistions</label>								
								<textarea name="fields[coordinates]" class="form-control" rows="3"  id="acf-textarea"><?php echo get_field( 'coordinates' ); ?></textarea>
							</div>
							
						</div><!-- tab-pane -->

									
					</div><!-- /tab-content -->

	           		<button type="submit" class="btn btn-success">Save</button>
				</form>
			</div><!-- /col-lg-12 -->
		</div>

		
	</div> <!-- /container -->
	
	<div class="modal fade" id="modalResponse" tabindex="-1" role="dialog" aria-labelledby="modalResponseLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalResponseLabel">Response</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    