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
                            <strong>Updated</strong> - <?php echo $this->session->flashdata('session_branch_modify'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
					<h1 class="h3 mb-3">Branch</h1>
                    
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0 col">Branch - List</h5>
                                  
								</div>
								<div class="card-body">
                                <div class="row col-2 offset-10">
                                    <a class="btn btn-primary col" href="<?php echo site_url('branch/create'); ?>"> Add</a>
                                    
                               </div>
                                <div class="column">
                                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>District Name</th>
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
                                                        <td><?php echo $branchrow->LocationNameId; ?></td>
                                                        <td><?php echo  $branchrow->ParentName; ?></td>
                                                        <td><?php echo  $branchrow->ChildName; ?></td>
                                                        <td><?php echo  $branchrow->CreatedAt; ?></td>
                                                        <td><?php  echo $branchrow->UpdatedAt; ?></td>
                                                        <td>

                                                        <a class="btn btn-primary" href="<?php echo site_url('branch/modify/'.$branchrow->LocationNameId); ?>"> modify</a>
                                                        <a class="btn btn-danger" href="<?php echo site_url('branch/remove/'.$branchrow->LocationNameId); ?>"> remove</a>

                                                        </td>
                                                    </tr>
                                            <?php 
                                                    endforeach;
                                                } else {
                                            ?>
                                                        <tr><td colspan="6">No Branch record found.</td></trd>
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
