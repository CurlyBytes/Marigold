            <main class="content">
				<div class="container-fluid p-0">
                <?php if ($this->session->flashdata('session_area_create')){ ?>
                <div class="row">    
                    <div class="alert alert-success  alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Created</strong> - <?php echo $this->session->flashdata('session_area_create'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_area_modify')){ ?>
                <div class="row">    
                    <div class="alert alert-primary alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Updated</strong> - <?php echo $this->session->flashdata('session_area_modify'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('session_area_remove')){ ?>
                <div class="row">    
                    <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Deleted</strong> - <?php echo $this->session->flashdata('session_area_remove'); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                    
					<div class="row">
						<div class="col-12">
							<div class="card">
	
								<div class="card-body">
                                <div class="row col-2 offset-10">
                                    <a class="btn btn-primary col" href="<?php echo site_url('area/create'); ?>"> Add</a>
                                    
                               </div>
                                <div class="column table-responsive">
                                    <table class="table table-striped table-responsive table-striped  is-narrow table-hover is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>District Name</th>
                                                <th>Area Name</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th colspan="2">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($area){
                                                    foreach ($area as $arearow): 
                                            ?>
                                
                                                    <tr>
                                                        <td><?php echo html_escape($arearow->LocationNameId); ?></td>
                                                        <td><?php echo html_escape($arearow->ParentName); ?></td>
                                                        <td><?php echo html_escape($arearow->ChildName); ?></td>
                                                        <td><?php echo html_escape($arearow->CreatedAt); ?></td>
                                                        <td><?php echo html_escape($arearow->UpdatedAt); ?></td>
                                                        <td><a class="btn btn-primary" href="<?php echo site_url('area/modify/'.$arearow->LocationNameId); ?>"> modify</a>
                                                        </td>
                                                        <td><a class="btn btn-danger" href="<?php echo site_url('area/remove/'.$arearow->LocationNameId); ?>"> remove</a></td>
                                                    </tr>
                                            <?php 
                                                    endforeach;
                                                } else {
                                            ?>
                                                        <tr><td colspan="7">No Area record found.</td></tr>
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

