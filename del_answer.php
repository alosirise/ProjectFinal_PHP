<?php 
session_start();
include('auth.php');
include_once('connect.php');

    $num_del = $_COOKIE['transaction'];
    $sql = "DELETE FROM answer WHERE project_id = $_GET[project_id] and transaction = $num_del";
    // echo "$sql";
    $result = mysqli_query($conn, $sql);

    echo "<script>window.location='answer_form.php?project_id=$_GET[project_id]';</script>";
 ?>