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
                <?php if ($this->session->flashdata('session_propose_branch_reupload')){ ?>
                <div class="row">    
                    <div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Updated All images </strong> - <?php echo $this->session->flashdata('session_propose_branch_reupload'); ?>
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


                <?php if ($this->session->flashdata('session_propose_branch_approve')){ ?>
                <div class="row">    
                    <div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Updated</strong> - <?php echo $this->session->flashdata('session_propose_branch_approve'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
					
                    
					<div class="row">
						<div class="col-12">
							<div class="card">
						
								<div class="card-body">
                                <div class="row col-2 offset-10">
                                    <a class="btn btn-primary col" href="<?php echo site_url('propose-branch/create'); ?>"> Add</a>
                                    
                               </div>
                                <div class="column table-responsive">
                                    <table class="table table-striped table-responsive table-striped  is-narrow table-hover is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>Region Name</th>
                                                <th>District Name</th>
                                                <th>Area Name</th>
                                                <th>Branch Name</th>
                                                <th>Latitude</th>
                                                <th>Longtitude</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th colspan="3">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($propose_branch){
                                                    foreach ($propose_branch as $propose_branchrow): 
                                            ?>
                                
                                                    <tr>
                                                        <td><?php echo html_escape($propose_branchrow->RegionName); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->DistrictName); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->AreaName); ?></td>  
                                                        <td><?php echo html_escape($propose_branchrow->BranchName); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->Latitude); ?></td>  
                                                        <td><?php echo html_escape($propose_branchrow->Longtitude); ?></td>  
                                                        <td><?php echo html_escape($propose_branchrow->CreatedAt); ?></td>
                                                        <td><?php echo html_escape($propose_branchrow->UpdatedAt); ?></td>
                                                        <td><a class="btn btn-info" href="<?php echo site_url('propose-branch/list-isp/'.$propose_branchrow->BranchInformationId); ?>"> isp</a></td>
                                                        <td><a class="btn btn-primary" href="<?php echo site_url('propose-branch/modify/'.$propose_branchrow->BranchInformationId); ?>"> modify</a></td>
                                                        <td><a class="btn btn-danger" href="<?php echo site_url('propose-branch/remove/'.$propose_branchrow->BranchInformationId); ?>"> remove</a></td>
                                                    </tr>
                                            <?php 
                                                    endforeach;
                                                } else {
                                            ?>
                                                        <tr><td colspan="11">No Propose Branch record found.</td></tr>
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

