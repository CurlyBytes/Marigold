	
			<main class="content">
				<div class="container-fluid p-0">

		

					<div class="row">
						<div class="col-12">
							<div class="card">
					
								<div class="card-body">

									<div class="column">
										<?php echo form_open('district/create'); ?>
										<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="locationnameidparent">Region Name</label>
														<select class="form-control mb-3 <?php echo (form_error('locationnameidparent') ? 'is-invalid' : 'is-valid');?>" id="locationnameidparent" name="locationnameidparent">
														<?php if(empty($region)) { ?>
																<option>--No Region Option.--</option>															
														<?php } else { ?>
															<?php foreach ($region as $regionrow): ?>
																<option value="<?php echo $regionrow->LocationNameId; ?>" <?php echo html_escape(set_select('locationnameidparent', $regionrow->LocationNameId, ((empty(set_select('locationnameidparent', $regionrow->LocationNameId)) ) ? true : false ))); ?> ><?php echo $regionrow->LocationName; ?></option>
															<?php endforeach; ?>
														<?php }  ?>
														</select>
														<?php echo form_error('locationnameidparent'); ?> 
													</div>
													
												</div>
												<div class="col mb-3">
	
													<div class="form-group">
														<label class="form-label" for="locationname">District Name</label>
														<input type="text" class="form-control  <?php echo (form_error('locationname') ? 'is-invalid' : 'is-valid');?>" id="locationname" name="locationname" placeholder="District Name" value="<?php echo html_escape(set_value('locationname')); ?>">
														<?php echo form_error('locationname'); ?> 
													</div>
													
												</div>
											</div>

											<button type="submit" class="btn btn-primary btn-block">Submit</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('district'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

