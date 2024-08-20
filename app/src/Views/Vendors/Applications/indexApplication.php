<div class="container">
    <?php if(empty($applications)) {?>
        <p class="mt-5 fw-bolder">No available applications</p>
    <?php } ?>
    <?php $colNumber = 0; ?>
    <?php foreach($applications as $application) { ?>
        <?php if ($colNumber % 3 == 0) { ?>
            <div class="row justify-content-around mt-4">
        <? } ?>
        <div class="col-4">
            <div class="card" style="width: 95%">
                <img src="<?=$application['cover_photo']?>" class="card-img-top" style="max-width: 100%">
                <div class="card-body">
                    <h5 class="card-title"><?= $application['title'] ?></h5>
                    <p class="card-text"><?= strlen($application['description']) > 1000 ? substr($application['description'],0, 1000)."..." : $application['description'] ?></p>
                    <?php if(isset($application['status'])) {
                            $statusClass = match($application['status']) {
                                'waitlist' => 'text-secondary',
                                'approved' => 'text-success',
                                'denied' => 'text-danger'
                            };
                    ?>
                    <p class="text-center">Status: <span class="<?=$statusClass ?> fw-bolder"><?=ucwords($application['status']) ?></span></p>
                    <?php } else { ?>
                        <p class="text-center"><a href="<?=ROOT?>/vendors/applications/<?= $application['id'] ?>/apply" class="btn btn-primary">Apply</a></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if (++$colNumber % 3 == 0 || $colNumber == count($applications)) { ?>
            </div>
        <? } ?>
    <? }?>  
    </div>
</div>