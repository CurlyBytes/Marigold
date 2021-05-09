            <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Location Type</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Location Type List</h5>
								</div>
								<div class="card-body">

                                <div class="column">
                                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Location Name</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php foreach ($locationtype as $locationtyperow): ?>
                                                    <tr>
                                                        <td><?php echo $locationtyperow->LocationTypeId; ?></td>
                                                        <td><?php echo  $locationtyperow->LocationType; ?></td>
                                                        <td><?php echo  $locationtyperow->CreatedAt; ?></td>
                                                        <td><?php  echo $locationtyperow->UpdatedAt; ?></td>
                                                        <td>

                                                        <a class="btn btn-primary" href="<?php echo site_url('locationtype/modify/'.$locationtyperow->LocationTypeId) ?>"> modify</a>
                                                        <a class="btn btn-danger" href="<?php echo site_url('locationtype/remove/'.$locationtyperow->LocationTypeId) ?>"> remove</a>

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

