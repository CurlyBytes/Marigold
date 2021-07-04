

<?php
	$locationname = set_value('locationname') == false ? $region->LocationName : set_value('locationname');
?>		
			<main class="content">
				<div class="container-fluid p-0">

		

					<div class="row">
						<div class="col-12">
							<div class="card">
					
								<div class="card-body">

									<div class="column">
										<?php echo form_open('region/remove/'. $region->LocationNameId); ?>
										<input type="hidden" name="locationnameid" value="<?php echo $region->LocationNameId; ?>">
											<div class="row">
												<div class="mb-3">
													<div class="form-group">
														<label class="form-label" for="locationname">Region Name</label>
														<input type="text" class="form-control" id="locationname" name="locationname" placeholder="Region Name" value="<?php echo html_escape($locationname); ?>" readonly>
														<?php echo form_error('locationname'); ?> 
													</div>
													
												</div>
											</div>
											<button type="submit" class="btn btn-danger btn-block">Proceed</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('region'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>



