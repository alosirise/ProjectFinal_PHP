<?php 
session_start();
include('auth.php');
include_once('connect.php');

    $username = $_COOKIE['username'];
    $sql = "DELETE FROM answer WHERE project_id = $_GET[project_id] and username = '$username'";
    $result = mysqli_query($conn, $sql);
    // echo $sql;

    echo "<script>window.location='answer_form.php?project_id=$_GET[project_id]';</script>";
