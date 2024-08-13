<div id="bg-gradient" class="col-12 d-flex justify-content-center" style="height: calc(100vh - 56px)">
    <div class="card col-12 col-sm-4 mt-3 mt-md-5 mb-3 mb-md-5">
        <div class="card-body">
            <h5 class="card-title mt-2 mb-3 mb-md-5">Register</h5>
            <form method="post" onsubmit="return validatePassword()">
                <!-- Name input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" id="name" name="name" 
                        class="form-control  <?php if(isset($errors['name'])) echo "is-invalid" ?>" 
                        max="255" aria-describedby="nameFeedback" required 
                        value="<?php if(isset($name)) echo $name ?>"
                    />
                    <?php if(isset($errors['name'])) {
                            foreach($errors['name'] as $error) { ?>
                                <div id="nameFeedback" class="invalid-feedback">
                                    <?=$error?>
                                </div>
                    <?php }} ?>
                </div>
                <!-- Email input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email" 
                        class="form-control  <?php if(isset($errors['email'])) echo "is-invalid" ?>"
                        max="255" aria-describedby="emailFeedback" required 
                        value="<?php if(isset($email)) echo $email ?>"
                    />
                    <?php if(isset($errors['email'])) {
                            foreach($errors['email'] as $error) { ?>
                                <div id="emailFeedback" class="invalid-feedback">
                                    <?=$error?>
                                </div>
                    <?php }} ?>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" 
                        class="form-control  <?php if(isset($errors['password'])) echo "is-invalid" ?>" 
                        min="8" max="255" aria-describedby="passwordFeedback" 
                        value="<?php if(isset($password)) echo $password ?>" 
                        required
                    />
                    <?php if(isset($errors['password'])) {
                            foreach($errors['password'] as $error) { ?>
                                <div id="passwordFeedback" class="invalid-feedback">
                                    <?=$error?>
                                </div>
                    <?php }} ?>
                </div>

                <!-- Password Verify input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="password_confirmation">Verify Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                        class="form-control <?php if(isset($errors['password_confirmation'])) echo "is-invalid" ?>" 
                        min="8" max="255" aria-describedby="passwordConfirmationFeedback" 
                        value="<?php if(isset($password_confirmation)) echo $password_confirmation ?>" required 
                    />
                    <?php if(isset($errors['password_confirmation'])) {
                            foreach($errors['password_confirmation'] as $error) { ?>
                                <div id="passwordConfirmationFeedback" class="invalid-feedback">
                                    <?=$error?>
                                </div>
                    <?php }} ?>
                </div>

                <?php if(isset($user)) { ?>
                <div class="form-outline mb-4">
                    <label for="role">Role</label>
                    <select class="form-control <?php if(isset($errors['role'])) echo "is-invalid" ?>" id="role" name="role"  aria-describedby="typeFeedback"
                        value="<?php if(isset($role)) echo $role ?>"
                    >
                        <option value="organizer">Organizer</option>
                        <option value="vendor">Vendor</option>
                    </select>
                    <?php if(isset($errors['role'])) {
                            foreach($errors['role'] as $error) { ?>
                                <div id="typeFeedback" class="invalid-feedback">
                                    <?=$error?>
                                </div>
                    <?php }} ?>
                </div>
                <?php } ?>

                <!-- Submit button -->
                <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mt-lg-5 mb-4">Sign Up</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Already a member? <a href="/login">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>
</div>