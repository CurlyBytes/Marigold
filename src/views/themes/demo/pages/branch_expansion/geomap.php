	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Branch Expansion - Approval</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Branch Expansion - Geomap</h5>
								</div>
									<div class="card-body">
										<div  class="column">
											<?php echo form_open('branch-expansion'); ?>
												<div class="row">
													<div class="col mb-3">
														<div class="form-group">
															<label class="form-label" for="openingdate">Opening Date</label>
															<input type="month" class="form-control  <?php echo (form_error('openingdate') ? 'is-invalid' : 'is-valid');?>" id="openingdate" name="openingdate" placeholder="Beginning Date" value="<?php echo html_escape(set_value('openingdate', date('Y-m', strtotime(date("Y-m"))))); ?>">
															<?php echo form_error('openingdate'); ?> 
														</div>
													</div>	
												</div>
												<button type="submit" class="btn btn-secondary btn-block">Filter</button>
											<?php echo form_close(); ?>
										</div>
									</div>



									<?php if(empty($propose_branch)){ ?>
										<h3>No Branch Proposal Yet. Go create at <a href="<?php echo site_url('propose-branch');?>">Branch Proposal</a></h3>
									<?php } else { ?>
										<div  class="column" id="mapCanvas">
										</div>
									<?php } ?>
							</div>
						</div>
					</div>

				</div>
			</main>

