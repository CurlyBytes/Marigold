            <main class="content">
				<div class="container-fluid p-0">
                <?php if ($this->session->flashdata('session_propose_branch_isp_create')){ ?>
                <div class="row">    
                    <div class="alert alert-success  alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Created</strong> - <?php echo $this->session->flashdata('session_propose_branch_isp_create'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_propose_branch_isp_modify')){ ?>
                <div class="row">    
                    <div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Updated</strong> - <?php echo $this->session->flashdata('session_propose_branch_isp_modify'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_propose_branch_isp_reupload')){ ?>
                <div class="row">    
                    <div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Updated All images </strong> - <?php echo $this->session->flashdata('session_propose_branch_isp_reupload'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_propose_branch_isp_remove')){ ?>
                <div class="row">    
                    <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Deleted</strong> - <?php echo $this->session->flashdata('session_propose_branch_isp_remove'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
	
                    
					<div class="row">
						<div class="col-12">
							<div class="card">
					
								<div class="card-body">
                                <div class="row col-2 offset-10">
                                    <a class="btn btn-primary col" href="<?php echo site_url('propose-branch/create-isp/'. $branchinformationid); ?>"> Add</a>
                                    
                               </div>
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
                                                        <td><?php echo html_escape($internetserviceproviderrow->InternetServiceProviderPackageName); ?></td>
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
                                <a class="btn btn-secondary col" href="<?php echo site_url('propose-branch'); ?>"> Propose Branch List</a>
                                

								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

