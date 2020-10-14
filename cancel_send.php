<?php 
session_start();
include('auth.php');
include_once('connect.php');
<<<<<<< Updated upstream

                   $sql2 = "UPDATE `create_project` SET status = '-' WHERE project_id = '$_GET[project_id]'";
=======
$datetime = date('Y-m-d H:i:s');

                   $sql2 = "UPDATE `create_project` SET status = '-',last_change = '".$datetime."'  WHERE project_id = '$_GET[project_id]'";
>>>>>>> Stashed changes
                   $result = mysqli_query($conn, $sql2);

                   echo "<script>alert('ยกเลิกการส่งโครงการ');
                   window.location='myproject.php';</script>";
 ?>