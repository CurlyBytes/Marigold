         
            <main class="content">
				<div class="container-fluid p-0">
                <?php if ($this->session->flashdata('session_region_create')){ ?>
                <div class="row">    
                    <div class="alert alert-success  alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Created</strong> - <?php echo $this->session->flashdata('session_region_create'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_region_modify')){ ?>
                <div class="row">    
                    <div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Updated</strong> - <?php echo $this->session->flashdata('session_region_modify'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_region_remove')){ ?>
                    <div class="row">    
                    <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Deleted</strong> - <?php echo $this->session->flashdata('session_region_remove'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
					<h1 class="h3 mb-3">Region</h1>
                    
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0 col">Region - List</h5>
                                  
								</div>
								<div class="card-body">
                                <div class="row col-2 offset-10">
                                    <a class="btn btn-primary col" href="<?php echo site_url('region/create'); ?>"> Add</a>
                                    
                               </div>
                                <div class="column table-responsive">
                                    <table class="table table-striped table-responsive table-striped  is-narrow table-hover is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Region Name</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th colspan="2">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($region){
                                                    foreach ($region as $regionrow): 
                                            ?>
                                  
                                                     <tr>
                                                        <td><?php echo html_escape($regionrow->LocationNameId); ?></td>
                                                        <td><?php echo html_escape($regionrow->LocationName); ?></td>
                                                        <td><?php echo html_escape($regionrow->CreatedAt); ?></td>
                                                        <td><?php echo html_escape($regionrow->UpdatedAt); ?></td>
                                                        <td><a class="btn btn-primary" href="<?php echo site_url('region/modify/'.$regionrow->LocationNameId); ?>"> modify</a></td>
                                                        <td><a class="btn btn-danger" href="<?php echo site_url('region/remove/'.$regionrow->LocationNameId); ?>"> remove</a></td>
                                                    </tr>
                                                <?php 
                                                        endforeach;
                                                    } else {
                                                ?>
                                                         <tr><td colspan="6">No District record found.</td></tr>
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

