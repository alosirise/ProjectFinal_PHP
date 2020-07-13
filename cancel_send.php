<?php 
session_start();
include('auth.php');
include_once('connect.php');

                   $sql2 = "UPDATE `create_project` SET status = '-' WHERE project_id = '$_GET[project_id]'";
                   $result = mysqli_query($conn, $sql2);

                   echo "<script>alert('ยกเลิกการส่งโครงการ');
                   window.location='myproject.php';</script>";
 ?>