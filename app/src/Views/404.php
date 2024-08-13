<head>
<?php include("Layouts/header.php");?>
<style>
    .center{text-align:center}
    #space-invaders {
    margin: 0 auto;
    display: block;
    background: white
    }
</style>
</head>
<body>
    <p class="center">Space Invadors destroyed this page! Take revenge on them!
    <br/> Use 
    <span class="label label-danger">Space</span> to shoot and 
    <span class="label label-danger">←</span>&#160;<span class="label label-danger"></span> to move!&#160;&#160;&#160;
    <button class="btn btn-default btn-xs" id="restart">Restart</button></p>

    <canvas id="space-invaders"/>
<?php include("Layouts/footer.php");?>
<script src="<?=ROOT?>/public/JS/spaceInvaders.js"></script>
</body>