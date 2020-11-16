<?php ob_start();?>
<?php
session_start();
include('auth.php');
include_once('connect.php');
if ($_SESSION['role'] != "admin") {
    header('location: home.php');
    exit();
  }
$change = "$_GET[change]";
$datetime = date('Y-m-d H:i:s');

$sql = "UPDATE `create_project` SET status = '$_GET[change]',last_change = '".$datetime."' WHERE project_id = '$_GET[project_id]'";
$result = mysqli_query($conn, $sql);


if ($change == 'อนุมัติ') {

    $sql2 = "UPDATE `history` SET status = 'ดำเนินการ' WHERE project_id = '$_GET[project_id]'";
    $result2 = mysqli_query($conn, $sql2);


    echo "<script>alert('อนุมัติโครงการเรียบร้อย');
    window.location='request.php';</script>";

    
} else if ($change == 'ไม่อนุมัติ') {
    echo "<script>alert('ส่งคืนโครงการเรียบร้อย');
    window.location='request.php';</script>";
} else if ($change == 'กำลังดำเนินการ') {
    echo "<script>alert('สถานะ : กำลังดำเนินการ');
    window.location='request.php';</script>";
} else if ($change == 'เสร็จสิ้น') {
    $sql3 = "UPDATE `history` SET status = 'เสร็จสิ้น' WHERE project_id = '$_GET[project_id]'";
    $result3 = mysqli_query($conn, $sql3);

    echo "<script>alert('สถานะ : เสร็จสิ้น');
    window.location='request.php';</script>";
}
?>