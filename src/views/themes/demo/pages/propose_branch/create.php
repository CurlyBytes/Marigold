	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Propose Branch - Create</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Propose Branch: form fillup</h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open_multipart('propose-branch/create'); ?>

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
														<input type="date" class="form-control  <?php echo (form_error('openingdate') ? 'is-invalid' : 'is-valid');?>" id="openingdate" name="openingdate" placeholder="Opening Date" value="<?php echo html_escape(set_value('openingdate', date('Y-m-d', strtotime(date("Y-m-d"))))); ?>">
														<?php echo form_error('openingdate'); ?> 
													</div>
												</div>

										</div>

											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="latitude">Latitude</label>
														<input type="text" class="form-control  <?php echo (form_error('latitude') ? 'is-invalid' : 'is-valid');?>" id="latitude" name="latitude" placeholder="latitude" value="<?php echo html_escape(set_value('latitude')); ?>">
														<?php echo form_error('latitude'); ?> 
													</div>
												</div>

												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="longtitude">Longtitude</label>
														<input type="text" class="form-control  <?php echo (form_error('longtitude') ? 'is-invalid' : 'is-valid');?>" id="longtitude" name="longtitude" placeholder="longtitude" value="<?php echo html_escape(set_value('longtitude')); ?>">
														<?php echo form_error('longtitude'); ?> 
													</div>
												</div>
											</div>

								
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="branchlocation">Branch Location</label>
														
														<textarea  class="form-control  <?php echo (form_error('branchlocation') ? 'is-invalid' : 'is-valid');?>" id="branchlocation" name="branchlocation" cols="20"  rows="2"><?php echo html_escape(set_value('branchlocation')); ?></textarea>
														<?php echo form_error('branchlocation'); ?> 
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="rentalprice">Rental Price</label>
														<input type="text" class="form-control  <?php echo (form_error('rentalprice') ? 'is-invalid' : 'is-valid');?>" id="rentalprice" name="rentalprice" placeholder="rentalprice" value="<?php echo html_escape(set_value('rentalprice')); ?>">
														<?php echo form_error('rentalprice'); ?> 
													</div>
												</div>
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="squaremeter">Square Meter</label>
														<input type="text" class="form-control  <?php echo (form_error('squaremeter') ? 'is-invalid' : 'is-valid');?>" id="squaremeter" name="squaremeter" placeholder="squaremeter" value="<?php echo html_escape(set_value('squaremeter')); ?>">
														<?php echo form_error('squaremeter'); ?> 
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="otherdetails">OtherDetails</label>
														
														<textarea  class="form-control  <?php echo (form_error('otherdetails') ? 'is-invalid' : 'is-valid');?>" id="otherdetails" name="otherdetails" cols="20"  rows="2"><?php echo html_escape(set_value('otherdetails')); ?></textarea>
														<?php echo form_error('otherdetails'); ?> 
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="files">Branch Images</label>
														<input type="file" class="form-control" name="files[]" multiple/>
														<?php echo form_error('files'); ?> 
													</div>
												</div>
											</div>
											<button type="submit"  name="uploadfile"class="btn btn-primary btn-block">Submit</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('propose-branch'); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

