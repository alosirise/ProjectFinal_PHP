<?php ob_start();?>
<?php 
    if(!isset($_SESSION['username'])){
        header('location:signin.php');
        exit();
    }
?>
