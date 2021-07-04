	
			<main class="content">
				<div class="container-fluid p-0">

			

					<div class="row">
						<div class="col-12">
							<div class="card">
							
								<div class="card-body">

									<div class="column">
										<?php echo form_open_multipart('propose-branch/photo-replace/'. $propose_branch->BranchInformationId); ?>
										<input type="hidden" name="branchinformationid" value="<?php echo $propose_branch->BranchInformationId; ?>">

									

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

