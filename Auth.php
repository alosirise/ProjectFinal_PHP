<?php 
    if(!isset($_SESSION['username'])){

        header("Location : signin.php");
        exit();
    }
?>
