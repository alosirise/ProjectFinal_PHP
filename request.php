<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "admin") {
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
</head>

<body>
  <div class="" id="nav"></div>

  <div class="row">
    <div class="col-lg-3"></div>
    <div class="w3-container col-lg-6 center ">


      <br><br>
      <h2 style=" padding :20px;">คำร้องขอสร้างโครงการ</h2>
      <?php


      include_once('connect.php');
      $sql = "SELECT * FROM create_project WHERE status = 'กำลังดำเนินการ'";
      $result = $conn->query($sql);
      $number = 1;

      if ($result->num_rows > 0) {

        echo '
            <table class="w3-table-all" style="width:130%">
              <thead>
                <tr class="w3-blue-gray">
                 <th style="width:4%"></th>
                  <th style="width:26%">ชื่อโครงการ</th>
                  <th style="width:15%">ชื่อผู้ใช้</th>
                  <th style="width:15%">ตรวจสอบโครงการ</th>
                  <th style="width:15%">ตรวจสอบแบบฟอร์ม</th>
                  <th style="width:5%"></th>
                  <th style="width:10%">ยอมรับ</th>
                  <th style="width:15%">ปฎิเสธ</th>
              
                </tr>
              </thead> ';
        // output data of each row
        //   " . $row["username"] . "
        while ($row = $result->fetch_assoc()) {
          $number++;
          echo "<tr><td></td><td>" . $row["name_project"] . "</td>  
            <td>" . $row["creator"] . "</td>  
            <td><a href=edit_project.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-primary' style='width:10'>ตรวจสอบโครงการ</button></a></td> 

            ", "
            <td><a href=edit_project.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-warning ' >ตรวจสอบแบบฟอร์ม</button></a></td> 
            <td></td>
            <td><a onClick=\"javascript: return confirm('คุณต้องการอนุมัติโครงการ?');\" href=approve_project.php?project_id=" . $row['project_id'] . " >    <button type='button' name ='send' class='btn btn-success' >ยอมรับ</button></a></td>
            <td><a onClick=\"javascript: return confirm('ปฎิเสธโครงการ?');\" href=reject_project.php?project_id=" . $row['project_id'] . " >  <button type='button' name ='delete' class='btn btn-danger' >ปฎิเสธ</button></a></td>
            
            </tr>";
        }
        echo "</table>";
      } else {
        echo "<h3>ยังไม่มีคำร้องขอในขณะนี้</h3>";
      }
      ?>

      <br> <br> <br>

      <h2 style=" padding :20px;">รายการที่อนุมัติแล้ว</h2>
      <?php
      $sql2 = "SELECT * FROM create_project WHERE status = 'อนุมัติ'";
      $result2 = $conn->query($sql2);
      $number = 1;
      if ($result2->num_rows > 0) {

        echo '
                 <table class="w3-table-all" style="width:130%">
                   <thead>
                     <tr class="w3-green">
                      <th style="width:4%"></th>
                       <th style="width:26%">ชื่อโครงการ</th>
                       <th style="width:15%">ชื่อผู้ใช้</th>
                       <th style="width:15%">ตรวจสอบโครงการ</th>
                       <th style="width:15%">ตรวจสอบแบบฟอร์ม</th>
                       <th style="width:15%"></th>
                       <th style="width:15%">ปฎิเสธ</th>
                   
                     </tr>
                   </thead> ';
        // output data of each row
        //   " . $row["username"] . "
        while ($row2 = $result2->fetch_assoc()) {
          $number++;
          echo "<tr><td></td><td>" . $row2["name_project"] . "</td>  
                 <td>" . $row2["creator"] . "</td>  
                 <td><a href=edit_project.php?project_id=" . $row2['project_id'] . ">    <button type='button' class='btn btn-primary' style='width:10'>ตรวจสอบโครงการ</button></a></td> 
     
                 ", "
                 <td><a href=edit_project.php?project_id=" . $row2['project_id'] . ">    <button type='button' class='btn btn-warning ' >ตรวจสอบแบบฟอร์ม</button></a></td> 
                  <td></td>
                 <td><a onClick=\"javascript: return confirm('ปฎิเสธโครงการ?');\" href=reject_project.php?project_id=" . $row2['project_id'] . " >  <button type='button' name ='delete' class='btn btn-danger' >ปฎิเสธ</button></a></td>
                 
                 </tr>";
        }
        echo "</table>";
      } else {
        echo "<h3>-ยังไม่มีรายการที่อนุมัติ-</h3>";
      }
      ?>




      <br> <br> <br>

      <h2 style=" padding :20px;">รายการที่ปฎิเสธแล้ว</h2>
      <?php
      $sql3 = "SELECT * FROM create_project WHERE status = 'ไม่อนุมัติ'";
      $result3 = $conn->query($sql3);
      $number = 1;
      if ($result3->num_rows > 0) {

        echo '
           <table class="w3-table-all" style="width:130%">
             <thead>
               <tr class="w3-red">
                <th style="width:4%"></th>
                 <th style="width:26%">ชื่อโครงการ</th>
                 <th style="width:15%">ชื่อผู้ใช้</th>
                 <th style="width:15%">ตรวจสอบโครงการ</th>
                 <th style="width:15%">ตรวจสอบแบบฟอร์ม</th>
                 <th style="width:15%"></th>
                 <th style="width:15%">ยอมรับ</th>
           
             
               </tr>
             </thead> ';
        // output data of each row
        //   " . $row["username"] . "
        while ($row3 = $result3->fetch_assoc()) {
          $number++;
          echo "<tr><td></td><td>" . $row3["name_project"] . "</td>  
           <td>" . $row3["creator"] . "</td>  
           <td><a href=edit_project.php?project_id=" . $row3['project_id'] . ">    <button type='button' class='btn btn-primary' style='width:10'>ตรวจสอบโครงการ</button></a></td> 

           ", "
           <td><a href=edit_project.php?project_id=" . $row3['project_id'] . ">    <button type='button' class='btn btn-warning ' >ตรวจสอบแบบฟอร์ม</button></a></td> 
            <td></td>
           <td><a onClick=\"javascript: return confirm('คุณต้องการอนุมัติโครงการ?');\" href=approve_project.php?project_id=" . $row3['project_id'] . " ><button type='button' name ='send' class='btn btn-success' >ยอมรับ</button></a></td>
           </tr>";
        }
        echo "</table>";
      } else {
        echo "<h3>-ยังไม่มีรายการที่ปฏิเสธ-</h3>";
      }
      ?>






      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Compiled and minified JavaScript -->

      <script src="index.js"></script>
</body>

</html>