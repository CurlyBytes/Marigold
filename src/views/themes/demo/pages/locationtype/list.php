<div class="container">
<h3 class="title is-3">CodeIgniter Database Pagination</h3>
<div class="column">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>ID</th>
                <th>Contact Name</th>
                <th>Contact Number</th>
                <th>Email</th>
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

                        <a class="btn btn-info" href="<?php echo site_url('locationtype/modify/'.$locationtyperow->LocationTypeId) ?>"> modify</a>
                        <a class="btn btn-primary" href="<?php echo site_url('locationtype/remove/'.$locationtyperow->LocationTypeId) ?>"> remove</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    <p><?php echo $links; ?></p>
</div>
</div>