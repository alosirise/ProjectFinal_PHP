<?php
session_start();
include('auth.php');
if ($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin") {
  header('location: home.php');
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Project</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- Bootstrap navbar CSS-->
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<style>
  #main {
    position: absolute;
    top: 50px;
    right: 25px;
    bottom: 25px;
    left: 24%;
  }
</style>

<body>
  <div class="" id="nav"></div>

  <div id="main">

    <div class="w3-container col-lg-10 center ">
      <h2 style=" padding :30px; ">โครงการของฉัน</h2>

      <center>
        <a href=create_project.php><button type="button" class="btn btn-primary">สร้าง</button></a>
      </center>

      <?php


      include_once('connect.php');
      $sql = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' ";
      $result = $conn->query($sql);
      $number = 0;
      $_SESSION['go'] = 'go_project';
      if ($result->num_rows > 0) {

        echo '
            <table class="table table-responsive" id="table" >
              <thead>
                <tr class="w3-blue-gray">
                 <th style="width:4%" >ที่</th>
                  <th style="width:35%" >ชื่อโครงการ</th>
           
                  <th data-orderable="false" style="width:17%"> จัดการโครงการ</th>
                  <th data-orderable="false" style="width:17%">จัดการแบบฟอร์ม</th>
                  <th data-orderable="false" style="width:7%"></th>
                  <th style="width:10%"> สถานะ</th>
                  <th data-orderable="false" style="width:10%">ส่ง</th>
                  <th data-orderable="false" style="width:10%">ลบ</th>
               
                </tr>
              </thead> ';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $number++;
          echo "<tr><td>" . $number . ".</td><td>" . $row["name_project"] . "</td>  
          ";
          if ($row["status"] == 'อนุมัติ' || $row["status"] == 'กำลังดำเนินการ') {
            echo "
            <td><a href=edit_project.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-primary' style='width:10' disabled>จัดการโครงการ</button></a></td> 
            <td><a href=create_form.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-warning ' disabled >จัดการแบบฟอร์ม</button></a></td> 

            ";
          } else {
            echo " <td><a href=edit_project.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-primary' style='width:10'>จัดการโครงการ</button></a></td> 
              <td><a href=create_form.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-warning ' >จัดการแบบฟอร์ม</button></a></td> ";
          }
          if ($row["status"] == 'อนุมัติ') {
            echo "<td><a href=answer_form.php?project_id=" . $row['project_id'] . "> <i class='fa fa-book fa-lg' aria-hidden='true'></i></a></td>";
          } else {
            echo "<td></td>";
          }

          if ($row["status"] == 'อนุมัติ') {
            echo "
            <th><a style=color:forestgreen;>" . $row["status"] . "</a> </th>";
          } else if ($row["status"] == 'ไม่อนุมัติ') {
            echo "
            <th><a style=color:red;>" . $row["status"] . "</a> </th>";
          } else if ($row["status"] == 'กำลังดำเนินการ') {
            echo "
            <th><a style=color:blue;>" . $row["status"] . "</a> </th>";
          } else {
            echo "
            <th>" . $row["status"] . "</th>";
          }



          if ($row["status"] == '-' || $row["status"] == 'ไม่อนุมัติ') {
            echo "
            <td><a href=waiting_project.php?project_id=" . $row['project_id'] . ">  <button type='button' name ='send' class='btn btn-success' >ส่ง</button></a></td>
            ";
          } else  if ($row["status"] == 'อนุมัติ') {
            echo "<td></td>";
          } else {

            echo "<td><a href=cancel_send.php?project_id=" . $row['project_id'] . ">  <button type='button' name ='send' class='btn btn-success' >ยกเลิก</button></a></td>";
          }


          echo "
            <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" href=delete_project.php?project_id=" . $row['project_id'] . " >  <button type='button' name ='delete' class='btn btn-danger' >ลบ</button></a></td>         
            </tr>";
        }
        echo "</table>";
      } else {
        echo "0 results";
      }
      ?>


      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

      <script>
        $(document).ready(function() {
          $('#table').DataTable({
            "pagingType": "full_numbers",
          });
        });
      </script>
      <!-- Compiled and minified JavaScript -->

      <script src="index.js"></script>
</body>

</html>