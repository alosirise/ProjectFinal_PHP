<?php ob_start();?>
<?php
    session_start();
    include('auth.php');

    if($_SESSION['role'] != "admin"){
        header('location: home.php');
        exit();
    }
    
include_once('connect.php');
          
  $sql = "UPDATE `member` SET role ='$_GET[change]'   WHERE id = '$_GET[id]'";
  $result = mysqli_query($conn, $sql);
  if($result){
        header("location:manage_account.php");
  }else
  echo "Not Change";
?>