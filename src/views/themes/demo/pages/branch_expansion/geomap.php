	
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Propose Branch - Create</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Propose Branch: form fillup</h5>
								</div>
								<?php if(empty($propose_branch)){ ?>
									<div class="card-body">
										<h3>No Branch Proposal Yet. Go create at <a href="<?php echo site_url('propose-branch');?>">Branch Proposal</a></h3>
									</div>
								<?php } else { ?>
									<div class="card-body" id="mapCanvas">

									</div>
								<?php } ?>
							</div>
						</div>
					</div>

				</div>
			</main>

