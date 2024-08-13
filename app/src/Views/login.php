<div id="bg-gradient" class="col-12 d-flex justify-content-center" style="height: calc(100vh - 56px)">
    <div class="card col-12 col-sm-4 mt-4 mt-md-5 mb-3 mb-md-5">
        <div class="card-body">
            <h5 class="card-title mt-2 mb-5">Welcome</h5>
            <form method="post">
                <!-- Email input -->
                <div class="mb-4">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email" value="<?php if(isset($email)) echo $email?>" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php if(isset($password)) echo $password?>" class="form-control" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"  
                                value="<?=$rememberme?>" id="rememberMe" class="rememberMe" checked 
                            />
                            <label class="form-check-label" for="rememberMe"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <input class="btn btn-primary" type="submit" value="Sign in" />

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="/signup">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>