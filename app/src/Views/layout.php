<head>
<?php include BASE_PATH . "/src/Views/Layouts/header.php";?>
</head>
<body>
<?php   
        include BASE_PATH . "/src/Views/Layouts/flash.php";
        include BASE_PATH . "/src/Views/Layouts/Navbar/navbar.php";
        include BASE_PATH . "/src/Views/$view.php";
        include BASE_PATH . "/src/Views/Layouts/footer.php";
?>
</body>