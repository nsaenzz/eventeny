<nav class="navbar navbar-expand-lg navbar-light border-bottom"> 
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Neil-Eventely</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(!empty($user)) { 
                        if($user['role'] == 'organizer')
                            include BASE_PATH . "/src/Views/Layouts/Navbar/organizer.php";
                        if($user['role'] == 'vendor')
                            include BASE_PATH . "/src/Views/Layouts/Navbar/vendor.php";
                    }
                ?>
            </ul>
            <?php if(isset($user)) { ?>
                <div class="navbar-nav dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?=$user['name']?></a>
                    <ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="dLabel">            
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="<?=ROOT?>/logout">Logout</a></li>
                    </ul>
                </div>   
            <?php } else { ?>
                <a class="btn btn-secondary px-4 me-2" href="/login">Sign In</a>
                <a class="btn btn-success px-5" href="/signup">Sign Up</a>
            <?php } ?>
        </div>
    </div>
</nav>
