	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Area - Create</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Area: form fillup</h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open('area/create'); ?>
										<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="locationnameidparent">District Name</label>
														<select class="form-control mb-3 <?php echo (form_error('locationnameidparent') ? 'is-invalid' : 'is-valid');?>" id="locationnameidparent" name="locationnameidparent">
															<option>--------</option>
															<?php foreach ($district as $districtrow): ?>
																<option value="<?php echo $districtrow->LocationNameId; ?>" <?php echo html_escape(set_select('locationnameidparent', $districtrow->LocationNameId, ((empty(set_select('locationnameidparent', $districtrow->LocationNameId)) ) ? true : false ))); ?> ><?php echo $districtrow->LocationName; ?></option>
															<?php endforeach; ?>
														</select>
														<?php echo form_error('locationnameidparent'); ?> 
													</div>
													
												</div>
												<div class="col mb-3">
	
													<div class="form-group">
														<label class="form-label" for="locationname">Area Name</label>
														<input type="text" class="form-control  <?php echo (form_error('locationname') ? 'is-invalid' : 'is-valid');?>">
														<?php echo form_error('locationname'); ?> 
													</div>
													
												</div>
											</div>

											<button type="submit" class="btn btn-primary btn-block">Submit</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('area'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>
