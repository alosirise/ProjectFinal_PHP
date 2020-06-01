<?php

    session_start();
    include('auth.php');

    if($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin"){
        header('location: home.php');
        exit();
    }
    

include_once('connect.php');


$sql = "DELETE FROM create_project WHERE project_id = '$_GET[project_id]'";

$result = mysqli_query($conn, $sql);

if($result)
    header("location:arrange.php");
else
    echo "Not Deleted";

?>