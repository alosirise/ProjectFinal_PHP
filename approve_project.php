<?php
session_start();
include('auth.php');
include_once('connect.php');

$change = "$_GET[change]";
$datetime = date('Y-m-d H:i:s');

$sql2 = "UPDATE `create_project` SET status = '$_GET[change]',last_change = '".$datetime."' WHERE project_id = '$_GET[project_id]'";
$result = mysqli_query($conn, $sql2);


if ($change == 'อนุมัติ') {
    echo "<script>alert('อนุมัติโครงการเรียบร้อย');
    window.location='request.php';</script>";
} else if ($change == 'ไม่อนุมัติ') {
    echo "<script>alert('ส่งคืนโครงการเรียบร้อย');
    window.location='request.php';</script>";
} else if ($change == 'กำลังดำเนินการ') {
    echo "<script>alert('สถานะ : กำลังดำเนินการ');
    window.location='request.php';</script>";
} else if ($change == 'เสร็จสิ้น') {
    echo "<script>alert('สถานะ : เสร็จสิ้น');
    window.location='request.php';</script>";
}
