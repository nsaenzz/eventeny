<div class="container">
    <div class="col-12 d-flex justify-content-center" style=")">
        <div class="card col-12 col-sm-4 mt-3 mt-md-5 mb-3 mb-md-5">
            <div class="card-body">
                <h5 class="card-title mt-2 mb-3 mb-md-5">Application Form <?= $application->title ?></h5>
                <form method="post">
                    <!-- Name input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="name">Business Name</label>
                        <input type="text" id="name" name="business_name" 
                            class="form-control  <?php if(isset($errors['business_name'])) echo "is-invalid" ?>" 
                            max="255" aria-describedby="nameFeedback" required 
                            value="<?= isset($business_name) ? $name : $userInfo->name?>"
                        />
                        <?php if(isset($errors['business_name'])) {
                                foreach($errors['business_name'] as $error) { ?>
                                    <div id="nameFeedback" class="invalid-feedback">
                                        <?=$error?>
                                    </div>
                        <?php }} ?>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="email">Business Email address</label>
                        <input type="email" id="email" name="business_email" 
                            class="form-control  <?php if(isset($errors['business_email'])) echo "is-invalid" ?>"
                            max="255" aria-describedby="emailFeedback" required 
                            value="<?= isset($business_email) ? $email : $userInfo->email ?>"
                        />
                        <?php if(isset($errors['business_email'])) {
                                foreach($errors['business_email'] as $error) { ?>
                                    <div id="emailFeedback" class="invalid-feedback">
                                        <?=$error?>
                                    </div>
                        <?php }} ?>
                    </div>

                    <!-- Phone input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="phone">Business Phone Number</label>
                        <input type="tel" id="phone" name="business_phone" 
                                class="form-control <?php if(isset($errors['business_phone'])) echo "is-invalid" ?>"
                                placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                value="<?php if(isset($business_phone)) echo $business_phone ?>"
                                required
                        />
                        <?php if(isset($errors['business_phone'])) {
                                foreach($errors['business_phone'] as $error) { ?>
                                    <div id="phoneFeedback" class="invalid-feedback">
                                        <?=$error?>
                                    </div>
                        <?php }} ?>
                    </div>

                    <!-- Submit button -->
                    <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mt-lg-4 mb-3">Apply</button>
                </form>
            </div>
        </div>
    </div>
</div>