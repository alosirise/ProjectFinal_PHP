<?php 
session_start();
include('auth.php');
include_once('connect.php');

                   $sql2 = "UPDATE `create_project` SET status = 'อนุมัติ' WHERE project_id = '$_GET[project_id]'";
                   $result = mysqli_query($conn, $sql2);

                   echo "<script>alert('อนุมัติโครงการเรียบร้อย');
                   window.location='request.php';</script>";
 ?>