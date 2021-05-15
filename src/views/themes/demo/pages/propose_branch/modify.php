	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Propose Branch - Modify</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Propose Branch: form edit</h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open('propose-branch/modify'); ?>

										<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="branchid">Branch Name</label>
														<select class="form-control mb-3 <?php echo (form_error('branchid') ? 'is-invalid' : 'is-valid');?>" id="branchid" name="branchid">
														<?php if(empty($branch)) { ?>
																<option>--No Branch Option.--</option>															
														<?php } else { ?>
															<?php foreach ($branch as $branchrow): ?>
																<option value="<?php echo $branchrow->LocationNameId; ?>" <?php echo html_escape(set_select('branchid', $branchrow->LocationNameId, ((empty(set_select('branchid', $branchrow->LocationNameId)) ) ? true : false ))); ?> ><?php echo $branchrow->LocationName; ?></option>
															<?php endforeach; ?>
														<?php }  ?>
														</select>
														<?php echo form_error('branchid'); ?> 
													</div>
													
												</div>
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="openingdate">Opening Date</label>
														<input type="date" class="form-control  <?php echo (form_error('openingdate') ? 'is-invalid' : 'is-valid');?>" id="openingdate" name="openingdate" placeholder="Opening Date" value="<?php echo html_escape(set_value('openingdate', $propose_branch->OpeningDate)); ?>">
														<?php echo form_error('openingdate'); ?> 
													</div>
												</div>

											</div>

										<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="latitude">Latitude</label>
														<input type="text" class="form-control  <?php echo (form_error('latitude') ? 'is-invalid' : 'is-valid');?>" id="latitude" name="latitude" placeholder="latitude" value="<?php echo html_escape(set_value('latitude', $$propose_branch->Latitude)); ?>">
														<?php echo form_error('latitude'); ?> 
													</div>
												</div>

												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="longtitude">Longtitude</label>
														<input type="text" class="form-control  <?php echo (form_error('longtitude') ? 'is-invalid' : 'is-valid');?>" id="longtitude" name="longtitude" placeholder="longtitude" value="<?php echo html_escape(set_value('longtitude', $$propose_branch->Longtitude)); ?>">
														<?php echo form_error('longtitude'); ?> 
													</div>
												</div>
											</div>

											<button type="submit" class="btn btn-primary btn-block">Save</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('propose-branch'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

