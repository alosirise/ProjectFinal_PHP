<?php ob_start();?>
<?php
session_start();
include('auth.php');
include_once('connect.php');

$change = "$_GET[change]";


$sql2 = "UPDATE `check_payment` SET status = '$_GET[change]'  WHERE firstname_surname = '$_GET[username]' AND project_id = '$_GET[id]'";
$result = mysqli_query($conn, $sql2);



    echo "<script>alert('สถานะ : รอยืนยันการชำระเงิน');
    window.location='answer_form.php?project_id=$_GET[id]';</script>";

 

?>