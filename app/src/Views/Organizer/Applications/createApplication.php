<div id="bg-gradient" class="col-12 d-flex justify-content-center" style="">
    <div class="container">
        <div class="card mt-2 mt-md-4 mb-2 mb-md-4">
            <div class="card-header">
                <h5 class="card-title mt-2 mb-1 mb-md-2">Create New Application Form</h5>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
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
                            <div class="col-3">
                                <div class="form-outline mb-2 well input-daterange">
                                    <div id="deadline_from" class="input-append">
                                        <label for="dealineFrom">Deadline From</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control"
                                                id="deadlineFrom" name="deadline_from"
                                                value="<?= isset($deadline_from) ? $deadline_from : date("m/d/Y") ?>"/>
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-outline mb-2 well input-daterange">
                                    <div id="deadline_to" class="input-append">
                                        <label for="dealineTo">Deadline To</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control"
                                                id="deadlineTo" name="deadline_to" 
                                                value="<?= isset($deadline_to) ? $deadline_to : date("m/d/Y") ?>"/>
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Price input -->
                            <div class="col-2">
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
                            <!-- Picture input -->
                            <div class="col-4">
                                <label for="cover_photo" class="form-label">Cover Photo</label>
                                <input class="form-control" type="file" id="coverPhoto" name="cover_photo" accept="image/png, image/jpeg, image/jpg" 
                                    value="<?php if(isset($cover_photo)) echo $cover_photo ?>" >
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-3">
                            <label for="additional_inputs_group" class="form-label">Add additional inputs</label>
                        </div>
                    </div>
                    <div class="row mb-3" id="additional_inputs_group">
                        <div class="col-3">
                            <input type="checkbox" class="btn-check" id="btn-check-contact-name" value="input_contact_name" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="btn-check-contact-name" style="width: 100%;">Contact Name</label>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" class="btn-check" id="btn-check-business-address" value="input_address_group" autocomplete="off">
                            <label class="btn btn-outline-secondary me-3" for="btn-check-business-address" style="width: 100%;">Business Address</label><br>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" class="btn-check" id="btn-check-type-food" value="input_type_food" autocomplete="off">
                            <label class="btn btn-outline-secondary me-3" for="btn-check-type-food" style="width: 100%;">Type of Food/Goods to be sold</label>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" class="btn-check" id="btn-check-license-nro" value="input_vendor_license" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="btn-check-license-nro" style="width: 100%;">Food Vendor License#</label>
                        </div>
                        <input type="hidden" name="additional_inputs" id="additional-inputs">
                    </div>
                    <!-- Submit button -->
                    <div class="row mt-lg-4 mb-2">
                        <div class="col">
                            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Create Application Form</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-1 mt-md-1 mb-2 mb-md-4">
            <div class="card-header">
                <h5 class="card-title mt-2 mb-2 mb-md-3">View Form</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">

                        <!-- Name input -->
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" for="name">Business Name</label>
                                <input type="text" id="name"
                                    class="form-control" 
                                    max="255" aria-describedby="nameFeedback" required 
                                    value=""
                                />
                            </div> 
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <!-- Phone input -->
                                <label class="form-label" for="phone">Business Phone Number</label>
                                <input type="tel" id="phone"
                                        class="form-control"
                                        placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                        value=""
                                />
                            </div>
                            <div class="col">
                                <!-- Email input -->
                                <label class="form-label" for="email">Business Email address</label>
                                <input type="email" id="email"
                                    class="form-control"
                                    max="255" aria-describedby="emailFeedback" required 
                                    value=""
                                />
                            </div>
                        </div>
                        <div id="addedInputs">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?=ROOT?>/public/CSS/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="<?=ROOT?>/public/JS/jquery-3.7.1.min.js"></script>
<script src="<?=ROOT?>/public/JS/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
let additionalInputs = [];
$("#additional_inputs_group input:checkbox").click(function(){
    const inputVal = $(this).val()
    const index = additionalInputs.indexOf(inputVal);
    if (index > -1) {
        additionalInputs.splice(index, 1);
        $('#added_input__'+inputVal).remove()
        
    } else {
        additionalInputs.push($(this).val());
        let url = "<?=ROOT . "/organizer/applications/addInputs"?>"
        $.ajax({
            type: "POST",
            url: url,
            data: {inputName: inputVal},
            dataType: "json",
            success: function(data){
                const inputHtml = data['input'][0]['html']
                $("#addedInputs").append('<div id="added_input__' + inputVal + '">'+ inputHtml +'</div>')
                
            }
        })
    }
    $("#additional-inputs").val(additionalInputs)
})
</script>


 