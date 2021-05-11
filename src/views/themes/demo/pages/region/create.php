
		<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Region - Create</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Region: form fillup</h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open('region/create'); ?>
											<div class="row">
												<div class="mb-3">
													<div class="form-group">
														<label class="form-label" for="locationname">Region Name</label>
														<input type="text" class="form-control <?php echo (form_error('locationname') ? 'is-invalid' : 'is-valid');?>" id="locationname" name="locationname" placeholder="Region Name" value="<?php echo html_escape(set_value('locationname')); ?>">
														<?php echo form_error('locationname'); ?> 
													</div>
													
												</div>
											</div>
											<button type="submit" class="btn btn-primary btn-block">Submit</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('region'); ?>"> Cancel</a>
                                    
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

