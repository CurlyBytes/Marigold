	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Branch Information - All Branches</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Branch Information - All Branches</h5>
								</div>
									<div class="card-body">
									
									</div>



									<?php if(empty($branch_information)){ ?>
										<h3>No Branch Information Yet. Go create and approve some branch first at <a href="<?php echo site_url('propose-branch');?>">Branch Proposal</a></h3>
									<?php } else { ?>
										<div  class="column" id="mapCanvas">
											
										</div>
									<?php } ?>
							</div>
						</div>
					</div>

				</div>
				<?php
					if($branch_information){
						foreach ($branch_information as $branch_informationrow): 
				?>
							<div class="offcanvas offcanvas-end" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="offcanvasRight-<?php echo $branch_informationrow->BranchInformationId;?>" aria-labelledby="offcanvasWithBackdropLabel">
								<div class="offcanvas-header">
									<h5 id="offcanvasRightLabel"><?php echo $branch_informationrow->BranchInformationId;?></h5>
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

								
										</div>
									</div>
									<h5 class="card-title mb-0"><?php echo $branch_informationrow->BranchName;?></h5>
								</div>
								<div class="card-body">
									<div class="row g-0">
										<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
											<img src="<?php echo base_url();?>assets/theme-demo/img/lightblue-pin.png" width="64" height="64" class="rounded-circle mt-2" alt="Angelica Ramos">
										</div>
										<div class="col-sm-9 col-xl-12 col-xxl-9">
											<strong>Description</strong>
											<p><?php echo $branch_informationrow->Description;?>.</p>
										</div>
									</div>

									<table class="table table-sm mt-2 mb-4">
										<tbody>
											<tr>
												<th>Area Name</th>
												<td><?php echo $branch_informationrow->AreaName;?></td>
											</tr>
											<tr>
												<th>District Name</th>
												<td><?php echo $branch_informationrow->DistrictName;?></td>
											</tr>
											<tr>
												<th>RegionName</th>
												<td><?php echo $branch_informationrow->RegionName;?></td>
											</tr>
											<tr>
												<th>Latitude</th>
												<td><?php echo $branch_informationrow->Latitude;?></td>
											</tr>
											<tr>
												<th>Longtitude</th>
												<td><?php echo $branch_informationrow->Longtitude;?></td>
											</tr>
											<tr>
												<th>Opening Date</th>
												<td><span class="badge bg-success"><?php echo $branch_informationrow->OpeningDate;?></span></td>
											</tr>
										</tbody>
									</table>

									<strong>Branch Information Details</strong>

									<ul class="timeline mt-2 mb-0">
										<li class="timeline-item">
											<strong>Contact Name</strong>
											<p><?php echo $branch_informationrow->ContactPerson;?>.</p>
										</li>
										<li class="timeline-item">
											<strong>Contact Number</strong>
											<p><?php echo $branch_informationrow->ContactNumber;?>.</p>
										</li>
										<li class="timeline-item">
											<strong>Owner Address</strong>
											<p><?php echo $branch_informationrow->BranchLocation;?>.</p>
										</li>
										<li class="timeline-item">
											<strong>Sq. Area</strong>
											<p><?php echo $branch_informationrow->SquareMeter;?>.</p>
										</li>
			
										<li class="timeline-item">
											<strong>Rental Price</strong>
											<p><?php echo $branch_informationrow->RentalPrice;?>.</p>
										</li>
										<li class="timeline-item">
											<strong>Date Created</strong>
											 <p><?php echo $branch_informationrow->CreatedAt;?></p>
										</li>
										<li class="timeline-item">
											<strong>Last Updated</strong>
											 <p><?php echo $branch_informationrow->UpdatedAt;?></p>
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

