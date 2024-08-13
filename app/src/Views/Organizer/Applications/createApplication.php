<div id="bg-gradient" class="col-12 d-flex justify-content-center" style="height: calc(100vh - 56px)">
    <div class="card col-12 col-sm-6 mt-3 mt-md-5 mb-3 mb-md-5">
        <div class="card-body">
            <h5 class="card-title mt-2 mb-2 mb-md-3">Create New Application Form</h5>
            <form method="post" onsubmit="return validatePassword()" enctype="multipart/form-data">
                <!-- Title input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="name">Title</label>
                    <input type="text" id="title" name="title" 
                        class="form-control  <?php if(isset($errors['title'])) echo "is-invalid" ?>" 
                        max="255" aria-describedby="titleFeedback" required 
                        value="<?php if(isset($title)) echo $title ?>"
                    />
                </div>

                <!-- Description input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="name">Description</label>
                    <textarea class="form-control <?php if(isset($errors['tile'])) echo "is-invalid" ?>" 
                        id="description" name="description" rows="4" style="height:auto;"
                        spellcheck="true" 
                    ><?php if(isset($description)) echo $description ?></textarea>
                </div>

                
                <div class="form-outline mb-3">
                    <div class="row gx-5">
                        <!-- Deadlines input -->
                        <div class="col">
                            <div class="form-outline mb-2 well input-daterange">
                                <div id="deadline_from" class="input-append">
                                    <label for="dealineFrom">Deadline From</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            id="deadlineFrom" name="deadline_from" data-provide="datepicker"
                                            value="<?= isset($deadline_from) ? $deadline_from : date("m/d/Y") ?>"/>
                                        <span class="input-group-text bg-light d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline mb-2 well input-daterange">
                                <div id="deadline_to" class="input-append">
                                    <label for="dealineTo">Deadline To</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            id="deadlineTo" name="deadline_to" data-provide="datepicker"
                                            value="<?= isset($deadline_to) ? $deadline_to : date("m/d/Y") ?>"/>
                                        <span class="input-group-text bg-light d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Price input -->
                        <div class="col">
                            <label class="form-label" for="password_confirmation">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="price" name="price" 
                                    class="form-control <?php if(isset($errors['price'])) echo "is-invalid" ?>" 
                                    min="0" max="999999" step="0.01" aria-describedby="price" 
                                    value="<?php if(isset($price)) echo $price ?>" 
                                    required 
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Picture input -->
                <div class="mb-3">
                    <label for="cover_photo" class="form-label">Cover Photo</label>
                    <input class="form-control" type="file" id="coverPhoto" name="cover_photo" accept="image/png, image/jpeg, image/jpg" 
                        value="<?php if(isset($cover_photo)) echo $cover_photo ?>" >
                </div>


                <!-- Submit button -->
                <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mt-lg-4 mb-4">Create</button>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?=ROOT?>/public/CSS/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="<?=ROOT?>/public/JS/jquery-3.7.1.min.js"></script>
<script src="<?=ROOT?>/public/JS/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">

</script>