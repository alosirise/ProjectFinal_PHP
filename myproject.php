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
  <script src="https://kit.fontawesome.com/f7ef8136ea.js" crossorigin="anonymous"></script>


</head>
<style>
  #main {
    position: absolute;
    top: 50px;
    right: 25px;
    bottom: 25px;
    left: 24%;
  }

  td {
    text-align: center;
  }
  
</style>

<body>
  <div class="" id="nav"></div>
  <div id="main">

    <div class="w3-container col-lg-11 center "><br>
      <h2 style=" padding :20px; ">โครงการของฉัน</h2>

      <center>
        <a href=create_project.php><button type="button" class="btn btn-success btn-lg">สร้าง</button></a>
        <br><br><br>
        <ul class="nav nav-tabs" role="tablist">
          <li> <a href="#list1" class="active nav-link" role="tab" data-toggle="tab">
              <icon class="fa fa-home"></icon> แบบร่าง
            </a>

          </li>
          <li><a href="#list2" class=" nav-link" role="tab" data-toggle="tab">
              <i class="fa fa-user"></i> กำลังดำเนินการ
            </a>
          </li>
          <li><a href="#list3" class=" nav-link" role="tab" data-toggle="tab">
              <i class="fa fa-user"></i> รายการที่ถูกส่งคืน
            </a>
          </li>
          <li><a href="#list4" class=" nav-link" role="tab" data-toggle="tab">
              <i class="fa fa-user"></i> รายการที่อนุมัติแล้ว
            </a>
          </li>
        </ul>
      </center>

      <?php
      echo "<div class='tab-content'>
      <div class='tab-pane fade active show ' id='list1'>";
      echo "<h2 style=' padding :35px; '>แบบร่าง</h2>";
      include_once('connect.php');
      $sql = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' AND status = '-' ORDER BY last_change DESC";
      $result = $conn->query($sql);
      $number = 0;
      $_SESSION['go'] = 'go_project';
      if ($result->num_rows > 0) {

        echo '
            <table class="table table-responsive" id="table" >
              <thead>
                <tr class="w3-blue-gray">
                 <th class="text-center" style="width:1%" >ที่</th>
                  <th  style="width:45%" >ชื่อโครงการ</th>
           
                  <th class="text-center" data-orderable="false" style="width:9%"> จัดการโครงการ</th>
                  <th data-orderable="false"" style="width:9%"></th>
                  <th class="text-center" data-orderable="false" style="width:13%">แบบฟอร์มใบสมัคร</th>
                  <th class="text-center" data-orderable="false" style="width:9%">แบบประเมิน</th>
                  <th class="text-center"data-orderable="false" style="width:9%">CoC news</th>
                  <th class="text-center" data-orderable="false"style="width:8%"> สถานะ</th>
                  <th class="text-center" data-orderable="false" style="width:5%">ส่ง</th>
                  <th class="text-center" data-orderable="false" style="width:5%">ลบ</th>
       
                </tr>
              </thead> ';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $number++;
          echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'>" . $row["name_project"] . "</td>";
          echo " <td><a href=edit_project.php?project_id=" . $row['project_id'] . ">    <i class='far fa-file-alt fa-lg'></i></a></td>
              <td><a href=edit_detail_project.php?project_id=" . $row['project_id'] . "> <i class='far fa-image fa-lg'  ></i></a></td>
              <td><a href=create_form.php?project_id=" . $row['project_id'] . ">  <i class='far fa-list-alt fa-lg' ></i></a></td> 
              <td><a href=evaluate_form.php?project_id=" . $row['project_id'] . ">   <i class='far fa-clipboard fa-lg' ></i></a></td> 
              <td><a href=evaluate_form.php?project_id=" . $row['project_id'] . ">  <i class='far fa-newspaper fa-lg'></i></a></td> 
              <th style = 'text-align: center;'>" . $row["status"] . "</th>
              <td><a href=waiting_project.php?project_id=" . $row['project_id'] . ">  <button type='button' name ='send' class='btn btn-success' >ส่ง</button></a></td>
              <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" href=delete_project.php?project_id=" . $row['project_id'] . " >  <button type='button' name ='delete' class='btn btn-danger' >ลบ</button></a></td>   
              </tr>
              ";
        }
        echo "</table>";
      } else {
        echo "0 results";
      }
      echo "</div>";





      echo "<div class='tab-pane fade ' id='list2'>";
      echo "<h2 style=' padding :35px; '>กำลังดำเนินการ</h2>";

      $sql = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' AND status != 'ลบ' AND status = 'กำลังดำเนินการ' ORDER BY status DESC,last_change DESC";
      $result = $conn->query($sql);
      $number = 0;
      $_SESSION['go'] = 'go_project';
      if ($result->num_rows > 0) {
        echo '
            <table class="table table-responsive" id="table2" >
              <thead>
                <tr class="w3-blue">
                 <th class="text-center" style="width:1%" >ที่</th>
                  <th style="width:40%" >ชื่อโครงการ</th>      
                  <th class="text-center" data-orderable="false" style="width:10%"> จัดการโครงการ</th>
                  <th data-orderable="false""></th>
                  <th class="text-center" data-orderable="false" >แบบฟอร์มใบสมัคร</th>
                  <th class="text-center" data-orderable="false">แบบประเมิน</th>
                  <th class="text-center"data-orderable="false" >CoC news</th>
                  <th class="text-center" data-orderable="false" > สถานะ</th>
                  <th class="text-center" data-orderable="false" >ส่ง</th>
                
                </tr>
              </thead> ';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $number++;
          echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'>" . $row["name_project"] . "</td>  
          <td> <i class='far fa-file-alt fa-lg' aria-hidden='true'></i></td> 
          <td> <i class='far fa-image fa-lg' aria-hidden='true'></i> </td>
          <td><i class='far fa-list-alt fa-lg' aria-hidden='true' ></i></td> 
          <td><i class='far fa-clipboard fa-lg' aria-hidden='true'></i></td> 
          <td><i class='far fa-newspaper fa-lg'></i></td> 
          <th style = 'text-align: center;'><a style=color:blue; >" . $row["status"] . "</a> </th>
          <td><a href=cancel_send.php?project_id=" . $row['project_id'] . ">  <button type='button' name ='send' class='btn btn-success' >ยกเลิก</button></a></td>";
                
        }
        echo "</table>";
      } else {
        echo "0 results";
      }
      echo "</div>";








      echo "<div class='tab-pane fade ' id='list3'>";
      echo "<h2 style=' padding :35px; '>รายการที่ส่งคืน</h2>";

      $sql = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' AND status != 'ลบ' AND status = 'ไม่อนุมัติ' ORDER BY status DESC,last_change DESC";
      $result = $conn->query($sql);
      $number = 0;
      $_SESSION['go'] = 'go_project';
      if ($result->num_rows > 0) {
        echo '
            <table class="table table-responsive" id="table3" >
              <thead>
                <tr class="w3-red">
                 <th style="width:4%" >ที่</th>
                  <th style="width:45%" >ชื่อโครงการ</th>      
                  <th class="text-center" data-orderable="false" style="width:17%"> จัดการโครงการ</th>
                  <th class="text-center" data-orderable="false""></th>
                  <th class="text-center" data-orderable="false" style="width:13%">แบบฟอร์มใบสมัคร</th>
                  <th class="text-center" data-orderable="false" style="width:13%">แบบประเมิน</th>   
                  <th class="text-center"data-orderable="false" >CoC news</th>    
                  <th class="text-center" data-orderable="false" style="width:10%"> สถานะ</th>
                  <th class="text-center" data-orderable="false" style="width:10%">ส่ง</th>
                  <th class="text-center" data-orderable="false" style="width:5%">ลบ</th>
                
                </tr>
              </thead> ';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $number++;
          echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'>" . $row["name_project"] . "</td>  
          <td ><a href=edit_project.php?project_id=" . $row['project_id'] . "> <i class='far fa-file-alt fa-lg' ></i></a></td>
              <td ><a href=edit_detail_project.php?project_id=" . $row['project_id'] . "> <i class='far fa-image fa-lg' ></i></a></td>
              <td><a href=create_form.php?project_id=" . $row['project_id'] . "> <i class='far fa-list-alt fa-lg' ></i></a></td> 
              <td><a href=evaluate_form.php?project_id=" . $row['project_id'] . "><i class='far fa-clipboard fa-lg' ></i></a></td> 
              <td><a href=evaluate_form.php?project_id=" . $row['project_id'] . ">  <i class='far fa-newspaper fa-lg'></i></a></td> 
              <th style = 'text-align: center;'><a style=color:red;>" . $row["status"] . "</a> </th>
              <td><a href=waiting_project.php?project_id=" . $row['project_id'] . ">  <button type='button' name ='send' class='btn btn-success' >ส่ง</button></a></td> 
              <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" href=delete_project.php?project_id=" . $row['project_id'] . " >  <button type='button' name ='delete' class='btn btn-danger' >ลบ</button></a></td>";
        }
       
        echo "</table>";
      } else {
        echo "0 results";
      }
      echo "</div>";








      echo "<div class='tab-pane fade ' id='list4'>";
      echo "<h2 style=' padding :35px; '>รายการที่อนุมัติแล้ว</h2>";

      $sql = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' AND status = 'อนุมัติ'  ORDER BY status DESC,last_change DESC";
      $result = $conn->query($sql);
      $number = 0;
      $_SESSION['go'] = 'go_project';
      if ($result->num_rows > 0) {
        echo '
            <table class="table table-responsive" id="table4" >
              <thead>
                <tr class="w3-green">
                 <th style="width:4%" >ที่</th>
                  <th style="width:45%" >ชื่อโครงการ</th>      
                  <th class="text-center" data-orderable="false" style="width:17%"> จัดการโครงการ</th>
                  <th class="text-center" data-orderable="false""></th>
                  <th class="text-center" data-orderable="false" style="width:13%">แบบฟอร์มใบสมัคร</th>
                  <th class="text-center" data-orderable="false" style="width:13%">แบบประเมิน</th>
                  <th class="text-center"data-orderable="false"  >CoC news</th> 
                  <th data-orderable="false"></th>
                  <th data-orderable="false"></th>
                  <th class="text-center" data-orderable="false" style="width:10%"> สถานะ</th>
            
                
                </tr>
              </thead> ';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $number++;
          echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'>" . $row["name_project"] . "</td>  
          <td> <i class='far fa-file-alt fa-lg' aria-hidden='true'></i></td> 
            <td> <i class='far fa-image fa-lg' aria-hidden='true'></i> </td>
            <td><i class='far fa-list-alt fa-lg' aria-hidden='true' ></i></td> 
            <td><i class='far fa-clipboard fa-lg' aria-hidden='true'></i></td> 
            <td> <i class='far fa-newspaper fa-lg'></i></td> 
            <td><a href=answer_form.php?project_id=" . $row['project_id'] . "> <i class='fa fa-book fa-lg' ></i></a></td>
            <td><a href=create_registration.php?project_id=" . $row['project_id'] . "> <i class='fa fa-id-card fa-lg' ></i></a></td>
            <th style = 'text-align: center;'><a style=color:forestgreen;>" . $row["status"] . "</a></th> ";
        }
        echo "</table>";
      } else {
        echo "0 results";
      }
    



      echo "<h2 style=' padding :35px;  padding-top :100px;'>รายการที่เสร็จสิ้นแล้ว</h2>";

      $sql = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' AND status = 'เสร็จสิ้น' ORDER BY status DESC,last_change DESC";
      $result = $conn->query($sql);
      $number = 0;
      $_SESSION['go'] = 'go_project';
      if ($result->num_rows > 0) {
        echo '
            <table class="table table-responsive" id="table5" >
              <thead>
                <tr class="w3-blue-gray">
                 <th style="width:4%" >ที่</th>
                  <th style="width:40%" >ชื่อโครงการ</th>      
                  <th class="text-center" data-orderable="false" style="width:15%"> จัดการโครงการ</th>
                  <th data-orderable="false"></th>
                  <th class="text-center" data-orderable="false" style="width:15%">แบบฟอร์มใบสมัคร</th>
                  <th class="text-center" data-orderable="false" style="width:15%">แบบประเมิน</th>
                  <th class="text-center"data-orderable="false" >CoC news</th> 
                  <th class="text-center" data-orderable="false"></th><th data-orderable="false"></th>
                  <th class="text-center" data-orderable="false"style="width:25%"> สถานะ</th>
            
                
                </tr>
              </thead> ';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $number++;
          echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'>" . $row["name_project"] . "</td>  
          <td> <i class='far fa-file-alt fa-lg' aria-hidden='true'></i></td> 
            <td> <i class='far fa-image fa-lg' aria-hidden='true'></i> </td>
            <td><i class='far fa-list-alt fa-lg' aria-hidden='true' ></i></td> 
            <td><i class='far fa-clipboard fa-lg' aria-hidden='true'></i></td> 
            <td> <i class='far fa-newspaper fa-lg'></i></td> 
            <td><a href=answer_form.php?project_id=" . $row['project_id'] . "> <i class='fa fa-book fa-lg' ></i></a></td>
            <td><a href=create_registration.php?project_id=" . $row['project_id'] . "> <i class='fa fa-id-card fa-lg' ></i></a></td>
            <th style = 'text-align: center;'>" . $row["status"] . "</th>
          ";
          

        }
        echo "</table>";
      } else {
        echo "0 results";
      }
      echo "</div></div>
      <br><br><br><br><br>";

      ?>


      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

      <script>
        $(document).ready(function() {
          $('#table,#table2,#table3,#table4').DataTable({
            "pagingType": "full_numbers",
          });
        });
      </script>
  
      <script src="index.js"></script>
</body>

</html>