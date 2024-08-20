<div class="container">
    <div class="col-12 justify-content-center">
        <div class="card mt-2 mt-md-3">
            <div class="card-header">
                <h5 class="card-title my-2">Application Form <?= $application['title'] ?></h5>
            </div>
            <div class="card-body"> 
                    <!-- Name input -->
                    <div class="row mb-2">
                        <div class="col">
                            <label class="form-label" for="name">Business Name</label>
                            <input type="text" id="name" name="business_name" 
                                class="form-control" 
                                max="255" aria-describedby="nameFeedback" required 
                                value="<?= $application['business_name'] ?>"
                            />
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col">
                            <!-- Email input -->
                            <label class="form-label" for="email">Business Email address</label>
                            <input type="email" id="email" name="business_email" 
                                class="form-control"
                                max="255" aria-describedby="emailFeedback" required 
                                value="<?= $application['business_email'] ?>"
                            />
                        </div>
                        <div class="col">
                            <!-- Email input -->
                            <label class="form-label" for="phone">Business Phone Number</label>
                            <input type="tel" id="phone" name="business_phone" 
                                    class="form-control"
                                    placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                    value="<?php $application['business_phone'] ?>"
                                    required
                            />
                        </div>
                    </div>

                    <div id="addedInputs">
                        <?php foreach ($application->getAdditionalInputs() as $addInput) {
                            echo $addInput->html;
                        }
                         ?>
                    </div>
            </div>
        </div>
    </div>
</div>