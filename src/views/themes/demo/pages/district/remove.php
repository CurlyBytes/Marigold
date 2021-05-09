

<?php
	$locationname = set_value('locationname') == false ? $district->LocationName : set_value('locationname');
	
?>		
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">District - Remove</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">District: </h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open('district/remove/'. $district->LocationNameId); ?>
										<input type="hidden" name="locationnameid" value="<?php echo $district->LocationNameId; ?>">
											<div class="row">
												<div class="mb-3">
													<h1 class="text-center">District</h1>
													<div class="form-group">
														<label class="form-label" for="locationname">District Name</label>
														<input type="text" class="form-control" id="locationname" name="locationname" placeholder="District Name" value="<?php echo $locationname; ?>" readonly>
														<?php echo form_error('locationname'); ?> 
													</div>
													
												</div>
											</div>
											<button type="submit" class="btn btn-danger btn-block">Proceed</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('district'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>



