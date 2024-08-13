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
                    </tr>
                </thead>
                <tbody>
                <?php foreach($applications as $application) { ?>
                    <tr>
                        <th scope="row"><a class="" href="<?=ROOT?>/organizer/applications/<?= $application['id'] ?>"><?= $application['id'] ?></a></th>
                        <td><?= $application['title'] ?></td>
                        <td><?= $application['description'] ?></td>
                        <td>$<?= number_format($application['price'], 2) ?></td>
                    </tr>
                <? }?>   
                </tbody> 
            </table>
        </div>
    </div>
</div>
