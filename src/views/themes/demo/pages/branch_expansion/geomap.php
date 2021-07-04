	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Propose Branch - Approval</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Propose Branch - Geomap</h5>
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
														<div class="form-group">
														<label class="form-label" for="locationnameid">Branch Name</label>
														<select class="form-control mb-3" id="locationnameid" name="locationnameid">
														<?php if(empty($branch)) { ?>
																<option>--No Branch Option.--</option>															
														<?php } else { ?>
															<option value="0">All Branches</option>
															<?php foreach ($branch as $branchrow): ?>
																<option value="<?php echo $branchrow->LocationNameId; ?>" <?php echo html_escape(set_select('locationnameid', $branchrow->LocationNameId, ((empty(set_select('locationnameid', $branchrow->LocationNameId)) ) ? true : false ))); ?> ><?php echo $branchrow->LocationName; ?></option>
															<?php endforeach; ?>
														<?php }  ?>
														</select>

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
				<?php
					if($propose_branch){
						foreach ($propose_branch as $propose_branchrow): 
				?>
							<div class="offcanvas offcanvas-end" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="offcanvasRight-<?php echo $propose_branchrow->BranchInformationId;?>" aria-labelledby="offcanvasWithBackdropLabel">
								<div class="offcanvas-header">
									<h5 id="offcanvasRightLabel"><?php echo $propose_branchrow->BranchInformationId;?></h5>
									<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
								</div>
								<div class="offcanvas-body">
								<div class="col">
							<div class="card">
								<div class="card-header">
									<div class="card-actions float-end">
										<div class="dropdown show">
											<a href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" class="">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
											</a>

											<div class="dropdown-menu dropdown-menu-end">
												<a class="dropdown-item" href="<?php echo site_url('propose-branch/approve/' .$propose_branchrow->BranchInformationId);?>">Approve</a>
												<a class="dropdown-item" href="<?php echo site_url('propose-branch/list-isp/' .$propose_branchrow->BranchInformationId);?>">ISP</a>
												<a class="dropdown-item" href="<?php echo site_url('propose-branch/modify/' .$propose_branchrow->BranchInformationId);?>">Modify</a>
												<a class="dropdown-item" href="<?php echo site_url('propose-branch/remove/' .$propose_branchrow->BranchInformationId);?>">Remove</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0"><?php echo $propose_branchrow->BranchName;?></h5>
								</div>
								<div class="card-body">
									<div class="row g-0">
										<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
											<img src="<?php echo base_url();?>assets/theme-demo/img/lightblue-pin.png" width="64" height="64" class="rounded-circle mt-2" alt="Angelica Ramos">
										</div>
										<div class="col-sm-9 col-xl-12 col-xxl-9">
											<strong>Description</strong>
											<p><?php echo $propose_branchrow->Description;?>.</p>
										</div>
									</div>

									<table class="table table-sm mt-2 mb-4">
										<tbody>
											<tr>
												<th>Area Name</th>
												<td><?php echo $propose_branchrow->AreaName;?></td>
											</tr>
											<tr>
												<th>District Name</th>
												<td><?php echo $propose_branchrow->DistrictName;?></td>
											</tr>
											<tr>
												<th>RegionName</th>
												<td><?php echo $propose_branchrow->RegionName;?></td>
											</tr>
											<tr>
												<th>Latitude</th>
												<td><?php echo $propose_branchrow->Latitude;?></td>
											</tr>
											<tr>
												<th>Longtitude</th>
												<td><?php echo $propose_branchrow->Longtitude;?></td>
											</tr>
											<tr>
												<th>Opening Date</th>
												<td><span class="badge bg-success"><?php echo $propose_branchrow->OpeningDate;?></span></td>
											</tr>
										</tbody>
									</table>

									<strong>Branch Information Details</strong>

									<ul class="timeline mt-2 mb-0">
										<li class="timeline-item">
											<strong>Contact Name</strong>
											<p><?php echo $propose_branchrow->ContactPerson;?>.</p>
										</li>
										<li class="timeline-item">
											<strong>Contact Number</strong>
											<p><?php echo $propose_branchrow->ContactNumber;?>.</p>
										</li>
										<li class="timeline-item">
											<strong>Owner Address</strong>
											<p><?php echo $propose_branchrow->ContactAddress;?>.</p>
										</li>
										<li class="timeline-item">
											<strong>Sq. Area</strong>
											<p><?php echo $propose_branchrow->SquareMeter;?>.</p>
										</li>
			
										<li class="timeline-item">
											<strong>Rental Price</strong>
											<p><?php echo $propose_branchrow->RentalPrice;?>.</p>
										</li>
										<li class="timeline-item">
											<strong>Date Created</strong>
											 <p><?php echo $propose_branchrow->CreatedAt;?></p>
										</li>
										<li class="timeline-item">
											<strong>Last Updated</strong>
											 <p><?php echo $propose_branchrow->UpdatedAt;?></p>
										</li>
									</ul>

								</div>
							</div>
						</div>
								</div>
							</div>
				<?php 
						endforeach;
					}
				?>
						
			</main>

