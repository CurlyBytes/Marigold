            <main class="content">
				<div class="container-fluid p-0">
                <?php if ($this->session->flashdata('session_branch_create')){ ?>
                <div class="row">    
                    <div class="alert alert-success  alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Created</strong> - <?php echo $this->session->flashdata('session_branch_create'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_branch_modify')){ ?>
                <div class="row">    
                    <div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Updated</strong> - <?php echo $this->session->flashdata('session_branch_modify'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_branch_remove')){ ?>
                <div class="row">    
                    <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Deleted</strong> - <?php echo $this->session->flashdata('session_branch_remove'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
			
                    
					<div class="row">
						<div class="col-12">
							<div class="card">
					
								<div class="card-body">
                                <div class="row col-2 offset-10">
                                    <a class="btn btn-primary col" href="<?php echo site_url('branch/create'); ?>"> Add</a>
                                    
                               </div>
                                <div class="column table-responsive">
                                    <table class="table table-striped table-responsive table-striped  is-narrow table-hover is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Area Name</th>
                                                <th>Branch Name</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th colspan="2">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($branch){
                                                    foreach ($branch as $branchrow): 
                                            ?>
                                
                                                    <tr>
                                                        <td><?php echo html_escape($branchrow->LocationNameId); ?></td>
                                                        <td><?php echo html_escape($branchrow->ParentName); ?></td>
                                                        <td><?php echo html_escape($branchrow->ChildName); ?></td>
                                                        <td><?php echo html_escape($branchrow->CreatedAt); ?></td>
                                                        <td><?php echo html_escape($branchrow->UpdatedAt); ?></td>
                                                        <td><a class="btn btn-primary" href="<?php echo site_url('branch/modify/'.$branchrow->LocationNameId); ?>"> modify</a></td>
                                                        <td><a class="btn btn-danger" href="<?php echo site_url('branch/remove/'.$branchrow->LocationNameId); ?>"> remove</a></td>
                                                    </tr>
                                            <?php 
                                                    endforeach;
                                                } else {
                                            ?>
                                                        <tr><td colspan="7">No Branch record found.</td></tr>
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

