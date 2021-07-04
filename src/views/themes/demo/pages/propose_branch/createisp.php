	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Internet Service Provider - Create</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Internet Service Provider: form fillup</h5>
								</div>
								<div class="card-body">

									<div class="column">
										<?php echo form_open('propose-branch/create-isp/' . $propose_branch->BranchInformationId); ?>
										<input type="hidden" name="branchinformationid" value="<?php echo $propose_branch->BranchInformationId; ?>">
					

											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="internetserviceprovidername">Internet Service Provider Name</label>
														<input type="text" class="form-control  <?php echo (form_error('internetserviceprovidername') ? 'is-invalid' : 'is-valid');?>" id="internetserviceprovidername" name="internetserviceprovidername" placeholder="Internet Service Provider Name" value="<?php echo html_escape(set_value('internetserviceprovidername')); ?>">
														<?php echo form_error('internetserviceprovidername'); ?> 
													</div>
												</div>

												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="internetserviceproviderpackagename">Internet Service Package Name</label>
														<input type="text" class="form-control  <?php echo (form_error('internetserviceproviderpackagename') ? 'is-invalid' : 'is-valid');?>" id="internetserviceproviderpackagename" name="internetserviceproviderpackagename" placeholder="Internet Service Package Name" value="<?php echo html_escape(set_value('internetserviceproviderpackagename')); ?>">
														<?php echo form_error('internetserviceproviderpackagename'); ?> 
													</div>
												</div>

												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="internetservicetechnologytype">Technology Type</label>
														<select class="form-control mb-3 <?php echo (form_error('internetservicetechnologytype') ? 'is-invalid' : 'is-valid');?>" id="internetservicetechnologytype" name="internetservicetechnologytype">
												
															<?php foreach ($internetservicetechnologytype as $internetservicetechnologytyperow): ?>
																<option value="<?php echo $internetservicetechnologytyperow ?>" <?php echo html_escape(set_select('internetservicetechnologytype', $internetservicetechnologytyperow, ((empty(set_select('internetservicetechnologytype', $internetservicetechnologytyperow)) ) ? true : false ))); ?> ><?php echo $internetservicetechnologytyperow; ?></option>
															<?php endforeach; ?>
													
														</select>
														<?php echo form_error('internetservicetechnologytype'); ?> 
													</div>
												</div>

												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="speed">Speed</label>
														<input type="text" class="form-control  <?php echo (form_error('speed') ? 'is-invalid' : 'is-valid');?>" id="speed" name="speed" placeholder="Speed" value="<?php echo html_escape(set_value('speed')); ?>">
														<?php echo form_error('speed'); ?> 
													</div>
												</div>
											</div>

											<button type="submit"  name="uploadfile"class="btn btn-primary btn-block">Submit</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('propose-branch/list-isp/' . $propose_branch->BranchInformationId); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

