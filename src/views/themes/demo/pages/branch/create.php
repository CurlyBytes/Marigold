	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Branch - Create</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Branch: form fillup</h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open('branch/create'); ?>
										<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="locationnameidparent">Area Name</label>
														<select class="form-control mb-3 <?php echo (form_error('locationnameidparent') ? 'is-invalid' : 'is-valid');?>" id="locationnameidparent" name="locationnameidparent">
															<option>--------</option>
															<?php foreach ($area as $arearow): ?>
																<option value="<?php echo $arearow->LocationNameId; ?>" <?php echo html_escape(set_select('locationnameidparent', $arearow->LocationNameId, ((empty(set_select('locationnameidparent', $arearow->LocationNameId)) ) ? true : false ))); ?> ><?php echo $arearow->LocationName; ?></option>
															<?php endforeach; ?>
														</select>
														<?php echo form_error('locationnameidparent'); ?> 
													</div>
													
												</div>
												<div class="col mb-3">
	
													<div class="form-group">
														<label class="form-label" for="locationname">Branch Name</label>
														<input type="text" class="form-control  <?php echo (form_error('locationname') ? 'is-invalid' : 'is-valid');?>">
														<?php echo form_error('locationname'); ?> 
													</div>
													
												</div>
											</div>

											<button type="submit" class="btn btn-primary btn-block">Submit</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('branch'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>
