<?php 

include BASE_PATH . "/src/Views/Layouts/Homepage/carousel.php";

?>

<div class="container">
    <div class="row justify-content-around text-center">
        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-primary btn-lg my-5" role="button" 
            href="<?php if(!empty($user)) {
                echo ROOT."/vendors/applications";
            } else {
                echo ROOT."/login?redirect=applications";
            }?>">View vendors' applications</a>
        </div>
    </div>
</div>