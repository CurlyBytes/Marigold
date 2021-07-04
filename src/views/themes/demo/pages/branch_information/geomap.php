	
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
						
			</main>

