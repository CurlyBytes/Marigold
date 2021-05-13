
	
	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">District - Modify</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">District: form edit</h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open('district/modify/'. $district->LocationNameId); ?>
										<input type="hidden" name="locationnameid" value="<?php echo $district->LocationNameId; ?>">
										<input type="hidden" name="locationgroupid" value="<?php echo $group->LocationGroupId; ?>">
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="locationnameidparent">Region Name</label>
														<select class="form-control mb-3 <?php echo (form_error('locationnameidparent') ? 'is-invalid' : 'is-valid');?>" id="locationnameidparent" name="locationnameidparent">
														<?php if(empty($region)) { ?>
																<option>--No Region Option.--</option>															
														<?php } else { ?>
															<?php foreach ($region as $regionrow): ?>
																<option value="<?php echo $regionrow->LocationNameId; ?>" <?php echo set_select('locationnameidparent', $regionrow->LocationNameId, (($regionrow->LocationNameId == $group->LocationNameIdParent) ? true: false)); ?> ><?php echo $regionrow->LocationName; ?></option>
															<?php endforeach; ?>
														<?php }  ?>
														</select>
														<?php echo form_error('locationnameidparent'); ?> 
													</div>
													
												</div>
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="locationname">District Name</label>
														<input type="text" class="form-control <?php echo (form_error('locationname') ? 'is-invalid' : 'is-valid');?>" id="locationname" name="locationname" placeholder="District Name"  value="<?php echo html_escape(set_value('locationname', $district->LocationName)); ?>">
														<?php echo form_error('locationname'); ?> 
													</div>							
												</div>
											</div>

											<button type="submit" class="btn btn-primary btn-block">Save</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('district'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

