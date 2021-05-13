            <main class="content">
				<div class="container-fluid p-0">
                <?php if ($this->session->flashdata('session_propose_branch_create')){ ?>
                <div class="row">    
                    <div class="alert alert-success  alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Created</strong> - <?php echo $this->session->flashdata('session_propose_branch_create'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_propose_branch_modify')){ ?>
                <div class="row">    
                    <div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Updated</strong> - <?php echo $this->session->flashdata('session_propose_branch_modify'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_propose_branch_remove')){ ?>
                <div class="row">    
                    <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Deleted</strong> - <?php echo $this->session->flashdata('session_propose_branch_remove'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
					<h1 class="h3 mb-3">Area</h1>
                    
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0 col">Area - List</h5>
                                  
								</div>
								<div class="card-body">
                                <div class="row col-2 offset-10">
                                    <a class="btn btn-primary col" href="<?php echo site_url('propose-branch/create'); ?>"> Add</a>
                                    
                               </div>
                                <div class="column">
                                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Region Name</th>
                                                <th>District Name</th>
                                                <th>Area Name</th>
                                                <th>Branch Name</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th colspan="2">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($propose_branch){
                                                    foreach ($propose_branch as $propose_branchrow): 
                                            ?>
                                
                                                    <tr>
                                                        <td><?php echo html_escape($propose_branchrow->BranchInformationId); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->BranchName); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->AreaName); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->DistrictName); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->RegionName); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->CreatedAt); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->UpdatedAt); ?></td>
                                                        <td><a class="btn btn-primary" href="<?php echo site_url('propose-branch/modify/'.$propose_branchrow->BranchInformationId); ?>"> modify</a></td>
                                                        <td><a class="btn btn-danger" href="<?php echo site_url('propose-branch/remove/'.$propose_branchrow->BranchInformationId); ?>"> remove</a></td>
                                                    </tr>
                                            <?php 
                                                    endforeach;
                                                } else {
                                            ?>
                                                        <tr><td colspan="9">No Propose Branch record found.</td></tr>
                                            <?php 
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <p><?php echo $links; ?></p>
                                </div>
                        
                                

								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

