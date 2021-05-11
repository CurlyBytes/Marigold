
	
	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Branch - Remove</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Branch: form delete</h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open('branch/modify/'. $branch->LocationNameId); ?>
										<input type="hidden" name="locationnameid" value="<?php echo $branch->LocationNameId; ?>">
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="locationnameidparent">District Name</label>
														<select class="form-control mb-3" id="locationnameidparent" name="locationnameidparent" readonly>
															<?php foreach ($district as $districtrow): ?>
																<option value="<?php echo $districtrow->LocationNameId; ?>" <?php echo html_escape(set_select('locationnameidparent', $districtrow->LocationNameId, ((empty(set_select('locationnameidparent', $districtrow->LocationNameId)) ) ? true : false ))); ?> ><?php echo $districtrow->LocationName; ?></option>
															<?php endforeach; ?>
														</select>
														<?php echo form_error('locationnameidparent'); ?> 
													</div>
													
												</div>
												<div class="col mb-3">
	
													<div class="form-group">
														<label class="form-label" for="locationname">Branch Name</label>
														<input type="text" class="form-control" id="locationname" name="locationname" placeholder="Branch Name"  readonly value="<?php echo html_escape(set_value('locationname', $branch->LocationName)); ?>">
														<?php echo form_error('locationname'); ?> 
													</div>
													
												</div>
											</div>

											<button type="submit" class="btn btn-primary btn-block">Proceed</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('branch'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

