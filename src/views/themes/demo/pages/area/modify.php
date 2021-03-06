
	
	
			<main class="content">
				<div class="container-fluid p-0">

			

					<div class="row">
						<div class="col-12">
							<div class="card">
				
								<div class="card-body">

									<div class="column">
										<?php echo form_open('area/modify/'. $area->LocationNameId); ?>
										<input type="hidden" name="locationnameid" value="<?php echo $area->LocationNameId; ?>">
										<input type="hidden" name="locationgroupid" value="<?php echo $group->LocationGroupId; ?>">
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="locationnameidparent">District Name</label>
														<select class="form-control mb-3 <?php echo (form_error('locationnameidparent') ? 'is-invalid' : 'is-valid');?>" id="locationnameidparent" name="locationnameidparent">
														<?php if(empty($district)) { ?>
																<option>--No District Option.--</option>															
														<?php } else { ?>
															<?php foreach ($district as $districtrow): ?>
																<option value="<?php echo $districtrow->LocationNameId; ?>" <?php echo set_select('locationnameidparent', $districtrow->LocationNameId, (($districtrow->LocationNameId == $group->LocationNameIdParent) ? true: false)); ?> ><?php echo $districtrow->LocationName; ?></option>
															<?php endforeach; ?>
														<?php }  ?>
														</select>
														<?php echo form_error('locationnameidparent'); ?> 
													</div>
													
												</div>
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="locationname">Area Name</label>
														<input type="text" class="form-control <?php echo (form_error('locationname') ? 'is-invalid' : 'is-valid');?>" id="locationname" name="locationname" placeholder="Area Name"  value="<?php echo html_escape(set_value('locationname', $area->LocationName)); ?>">
														<?php echo form_error('locationname'); ?> 
													</div>							
												</div>
											</div>

											<button type="submit" class="btn btn-primary btn-block">Save</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('area'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

