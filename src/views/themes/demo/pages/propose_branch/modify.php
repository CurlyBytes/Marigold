	
			<main class="content">
				<div class="container-fluid p-0">

			
					<div class="row">
						<div class="col-12">
							<div class="card">
						
								<div class="card-body">

									<div class="column">
										<?php echo form_open('propose-branch/modify/'. $propose_branch->BranchInformationId); ?>
										<input type="hidden" name="branchinformationid" value="<?php echo $propose_branch->BranchInformationId; ?>">
										<input type="hidden" name="branchinformationdetailid" value="<?php echo $propose_branch_details->BranchInformationDetailId; ?>">
										<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="branchid">Branch Name</label>
														<select class="form-control mb-3 <?php echo (form_error('branchid') ? 'is-invalid' : 'is-valid');?>" id="branchid" name="branchid">
														<?php if(empty($branch)) { ?>
																<option>--No Propose Branch Option.--</option>															
														<?php } else { ?>
															<?php foreach ($branch as $branchrow): ?>
																<option value="<?php echo $branchrow->LocationNameId; ?>" <?php echo set_select('locationnameidparent', $branchrow->LocationNameId, (($branchrow->LocationNameId == $propose_branch->BranchId) ? true: false)); ?> ><?php echo $branchrow->LocationName; ?></option>
															<?php endforeach; ?>
														<?php }  ?>
														</select>
														</select>
														<?php echo form_error('branchid'); ?> 
													</div>
													
												</div>
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="openingdate">Opening Date</label>
														<input type="date" class="form-control  <?php echo (form_error('openingdate') ? 'is-invalid' : 'is-valid');?>" id="openingdate" name="openingdate" placeholder="Opening Date" value="<?php echo html_escape(set_value('openingdate', date('Y-m-d', strtotime($propose_branch->OpeningDate)))); ?>">
														<?php echo form_error('openingdate'); ?> 

													
													</div>
												</div>

											</div>

											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="latitude">Latitude</label>
														<input type="text" class="form-control  <?php echo (form_error('latitude') ? 'is-invalid' : 'is-valid');?>" id="latitude" name="latitude" placeholder="latitude" value="<?php echo html_escape(set_value('latitude', $propose_branch->Latitude)); ?>">
														<?php echo form_error('latitude'); ?> 
													</div>
												</div>

												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="longtitude">Longtitude</label>
														<input type="text" class="form-control  <?php echo (form_error('longtitude') ? 'is-invalid' : 'is-valid');?>" id="longtitude" name="longtitude" placeholder="longtitude" value="<?php echo html_escape(set_value('longtitude', $propose_branch->Longtitude)); ?>">
														<?php echo form_error('longtitude'); ?> 
													</div>
												</div>
											</div>

										
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="branchlocation">Branch Location</label>
														
														<textarea  class="form-control  <?php echo (form_error('branchlocation') ? 'is-invalid' : 'is-valid');?>" id="branchlocation" name="branchlocation" cols="20"  rows="2"><?php echo html_escape(set_value('branchlocation', $propose_branch_details->BranchLocation)); ?></textarea>
														<?php echo form_error('branchlocation'); ?> 
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="rentalprice">Rental Price</label>
														<input type="text" class="form-control  <?php echo (form_error('rentalprice') ? 'is-invalid' : 'is-valid');?>" id="rentalprice" name="rentalprice" placeholder="rentalprice" value="<?php echo html_escape(set_value('rentalprice', $propose_branch_details->RentalPrice)); ?>">
														<?php echo form_error('rentalprice'); ?> 
													</div>
												</div>
											
											</div>
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="ratings">Ratings</label>
														<input type="text" class="form-control  <?php echo (form_error('ratings') ? 'is-invalid' : 'is-valid');?>" id="ratings" name="ratings" placeholder="ratings" value="<?php echo html_escape(set_value('ratings', $propose_branch_details->Ratings)); ?>">
														<?php echo form_error('ratings'); ?> 
													</div>
												</div>
											
											</div>
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label class="form-label" for="otherdetails">OtherDetails</label>
														
														<textarea  class="form-control  <?php echo (form_error('otherdetails') ? 'is-invalid' : 'is-valid');?>" id="description" name="description" cols="20"  rows="2"> 
															<?php echo html_escape(set_value('otherdetails', $propose_branch_details->OtherDetails)); ?>
														</textarea>
														<?php echo form_error('otherdetails'); ?> 
													</div>
												</div>
											</div>
										
											<div class="row">
												
												<div class="col">
													<?php  if($branchphoto){
														$totalrecord = count($branchphoto);
											
														$count = 0;
														foreach ($branchphoto as $branchphotorow){
															$count++;
																if($count % 2 ==  0) {?>
																	<div class="row m-2">
																		<div class="col  m-1"><img src="<?php echo '/uploads/files/' . $branchphotorow->PhotoName; ?>" width="400" height="350" /></div>
																	
																<?php } else { ?>
																	
																		<div class="col m-1	"><img src="<?php echo '/uploads/files/' . $branchphotorow->PhotoName; ?>" width="400" height="350"  /></div>
																	</div>
																<?php } ?>
																
															<?php } 
														} else { ?>
                                                        <span>No Propose Branch Images found.</span>
                                            		<?php } ?>
													
												</div>
											</div>

											<div class="row">
											<div class="column table-responsive">
                                    <table class="table table-striped table-responsive table-striped  is-narrow table-hover is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>Internet Service Provider Name</th>
                                                <th>Technology Type</th>
                                                <th>Speed</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th colspan="2">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($internetserviceprovider){
                                                    foreach ($internetserviceprovider as $internetserviceproviderrow): 
                                            ?>
                                
                                                    <tr>
                                                        <td><?php echo html_escape($internetserviceproviderrow->InternetServiceProviderName); ?></td>
                                                        <td><?php echo html_escape($internetserviceproviderrow->InternetServiceTechnologyType); ?></td>
                                                        <td><?php echo html_escape($internetserviceproviderrow->Speed); ?></td>  
                                                        <td><?php echo html_escape($internetserviceproviderrow->CreatedAt); ?></td>
                                                        <td><?php echo html_escape($internetserviceproviderrow->UpdatedAt); ?></td>
                                                        <td><a class="btn btn-primary" href="<?php echo site_url('propose-branch/modify-isp/'. $internetserviceproviderrow->BranchInformationId . '/'. $internetserviceproviderrow->InternetServiceProviderId); ?>"> modify</a></td>
                                                        <td><a class="btn btn-danger" href="<?php echo site_url('propose-branch/remove-isp/'. $internetserviceproviderrow->BranchInformationId . '/' . $internetserviceproviderrow->InternetServiceProviderId); ?>"> remove</a></td>
                                                    </tr>
                                            <?php 
                                                    endforeach;
                                                } else {
                                            ?>
                                                        <tr><td colspan="7">No ISP record found.</td></tr>
                                            <?php 
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <p><?php echo $links; ?></p>
                                </div>
											</div>

					

											<button type="submit" class="btn btn-primary btn-block">Submit</button>
											<a class="btn btn-secondary col" href="<?php echo site_url('propose-branch'); ?>"> Cancel</a>
											
											<a class="btn btn-info col" href="<?php echo site_url('propose-branch/photo-replace/'. $propose_branch->BranchInformationId); ?>"> Replace All Images</a>
										<?php echo form_close(); ?>  
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

