	
			<main class="content">
				<div class="container-fluid p-0">



					<div class="row">
						<div class="col-12">
							<div class="card">
						
								<div class="card-body">

									<div class="column">
										<?php echo form_open('propose-branch/remove-isp/' . $propose_branch->BranchInformationId . '/' . $internetserviceprovider->InternetServiceProviderId); ?>
										<input type="hidden" name="branchinformationid" value="<?php echo $propose_branch->BranchInformationId; ?>">
										<input type="hidden" name="internetserviceproviderid" value="<?php echo $internetserviceprovider->InternetServiceProviderId; ?>">
					


											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="internetserviceprovidername">Internet Service Provider Name</label>
														<input type="text" class="form-control  <?php echo (form_error('internetserviceprovidername') ? 'is-invalid' : 'is-valid');?>" id="internetserviceprovidername" name="internetserviceprovidername" placeholder="Internet Service Provider Name" value="<?php echo html_escape(set_value('internetserviceprovidername', $internetserviceprovider->InternetServiceProviderName)); ?>" readonly>
														<?php echo form_error('internetserviceprovidername'); ?> 
													</div>
												</div>

												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="internetservicetechnologytype">Technology Type</label>
														<select class="form-control mb-3 <?php echo (form_error('internetservicetechnologytype') ? 'is-invalid' : 'is-valid');?>" id="internetservicetechnologytype" name="internetservicetechnologytype" readonly>
												
															
															<?php foreach ($internetservicetechnologytype as $internetservicetechnologytyperow): ?>
																<option value="<?php echo $internetservicetechnologytyperow; ?>" <?php echo set_select('internetservicetechnologytype', $internetservicetechnologytyperow, (($internetservicetechnologytyperow == $internetserviceprovider->InternetServiceTechnologyType) ? true: false)); ?> ><?php echo $internetservicetechnologytyperow; ?></option>
															<?php endforeach; ?>
														</select>
														<?php echo form_error('internetservicetechnologytype'); ?> 
													</div>
												</div>

												<div class="col mb-3">
													<div class="form-group">
													<label class="form-label" for="speed">Speed</label>
														<select class="form-control mb-3 <?php echo (form_error('speed') ? 'is-invalid' : 'is-valid');?>" id="speed" name="speed">
												
												<?php for ($x = 1; $x <= 100; $x++) { ?>
																<option value="<?php echo $x; ?>" <?php echo set_select('speed', $x, (($x == $internetserviceprovider->Speed) ? true: false)); ?> ><?php echo $x; ?></option>
															<?php } ?>
													
														</select>
													</div>
												</div>
											</div>

											<button type="submit"  name="uploadfile"class="btn btn-danger btn-block">Proceed</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('propose-branch/list-isp/' . $propose_branch->BranchInformationId); ?>"> Cancel</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

