<?php ob_start();?>
<?php 
session_start();
include('auth.php');
include_once('connect.php');
$datetime = date('Y-m-d H:i:s');

                   $sql2 = "UPDATE `create_project` SET status = 'กำลังดำเนินการ' ,last_change = '".$datetime."' WHERE project_id = '$_GET[project_id]'";
                   $result = mysqli_query($conn, $sql2);


                   echo "<script>alert('ส่งคำขอเรียบร้อยเรียบร้อย โปรดรอแอดมินอนุมัติ');
                   window.location='myproject.php';</script>";
 ?>