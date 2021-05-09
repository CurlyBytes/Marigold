            <main class="content">
				<div class="container-fluid p-0">

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
                                <div class="column">
                                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Region Name</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($region as $regionrow): ?>
                                                    <tr>
                                                        <td><?php echo $regionrow->LocationNameId; ?></td>
                                                        <td><?php echo  $regionrow->LocationName; ?></td>
                                                        <td><?php echo  $regionrow->CreatedAt; ?></td>
                                                        <td><?php  echo $regionrow->UpdatedAt; ?></td>
                                                        <td>

                                                        <a class="btn btn-primary" href="<?php echo site_url('region/modify/'.$regionrow->LocationNameId); ?>"> modify</a>
                                                        <a class="btn btn-danger" href="<?php echo site_url('region/remove/'.$regionrow->LocationNameId); ?>"> remove</a>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
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

