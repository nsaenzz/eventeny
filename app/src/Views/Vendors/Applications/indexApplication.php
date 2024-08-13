<div class="container">
    <div class="row justify-content-around">
        <div class="col-10">
            <h2 class="my-3">Applications Forms</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($applications as $application) { ?>
                    <tr> 
                        <th scope="row"><?= $application['id'] ?></th>
                        <td><?= $application['title'] ?></td>
                        <td><?= $application['description'] ?></td>
                        <td>$<?= number_format($application['price'], 2) ?></td>
                        <?php if(isset($application['status'])) {
                                $statusClass = match($application['status']) {
                                    'waitlist' => 'text-secondary',
                                    'approved' => 'text-success',
                                    'denied' => 'text-danger'
                                };
                        ?>
                            <td><span class="<?=$statusClass ?>"><?=ucwords($application['status']) ?></span></td>
                        <?php } else { ?>
                            <td><a type="button" class="btn btn-primary" href="<?=ROOT?>/vendors/applications/<?= $application['id'] ?>/apply">Apply</a></td>
                        <?php } ?>
                    </tr>
                <? }?>   
                </tbody> 
            </table>
        </div>
    </div>
</div>