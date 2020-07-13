<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "admin") {
  header('location: home.php');
  exit();
}
$_SESSION['go'] ='go_request';
?>

<!doctype html>
<html lang="en">

<head>
  <title>Project</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" />
  <!-- Bootstrap navbar CSS-->
  <link rel="stylesheet" href="navbar.css">
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
      <br><br>
     
      <br> 
      <center><select style=" height:35px; width: 20%">
      <option value="all" >ทั้งหมด</option>
        <option value="request" >คำร้องขอสร้างโครงการ</option>
        <option value="accept">รายการที่อนุมัติแล้ว</option>
        <option value="reject" >รายการที่ปฎิเสธแล้ว</option>
      </select></center>

      <div id="request"><br><br> 
      <h2 style=" padding :20px;">คำร้องขอสร้างโครงการ</h2> 
        <?php
        include_once('connect.php');
        $sql = "SELECT * FROM create_project WHERE status = 'กำลังดำเนินการ'";
        $result = $conn->query($sql);
        $number = 0;

        if ($result->num_rows > 0) {

          echo '
            <table class="table table-responsive" id=table >
              <thead>
                <tr class="w3-blue-gray">
                 <th style="width:4%">ที่</th>
                  <th style="width:26%">ชื่อโครงการ</th>
                  <th style="width:15%">ชื่อผู้ใช้</th>
                  <th data-orderable="false" style="width:15%">ตรวจสอบโครงการ</th>
                  <th data-orderable="false" style="width:15%">ตรวจสอบแบบฟอร์ม</th>
                  <th data-orderable="false" style="width:5%"></th>
                  <th data-orderable="false" style="width:10%">ยอมรับ</th>
                  <th data-orderable="false" style="width:15%">ปฎิเสธ</th>
              
                </tr>
              </thead> ';
          // output data of each row
          //   " . $row["username"] . "
          while ($row = $result->fetch_assoc()) {
            $number++;
            echo "<tr><td>".$number.".</td><td>" . $row["name_project"] . "</td>  
            <td>" . $row["creator"] . "</td>  
            <td><a href=edit_project.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-primary' style='width:10'>ตรวจสอบโครงการ</button></a></td> 

            ", "
            <td><a href=create_form.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-warning ' >ตรวจสอบแบบฟอร์ม</button></a></td> 
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
      </div>


      <div id="accept">
        <br> <br> 
        <h2 style=" padding :20px;">รายการที่อนุมัติแล้ว</h2>
        <?php
        $sql2 = "SELECT * FROM create_project WHERE status = 'อนุมัติ'";
        $result2 = $conn->query($sql2);
        $number = 0;
        if ($result2->num_rows > 0) {
          echo '
                 <table class="table table-responsive" id=table2 >
                   <thead>
                     <tr class="w3-green">
                      <th style="width:4%">ที่</th>
                       <th style="width:26%">ชื่อโครงการ</th>
                       <th style="width:15%">ชื่อผู้ใช้</th>
                       <th data-orderable="false" style="width:15%">ตรวจสอบโครงการ</th>
                       <th data-orderable="false" style="width:15%">ตรวจสอบแบบฟอร์ม</th>
                       <th data-orderable="false" style="width:15%"></th>
                       <th data-orderable="false" style="width:15%">ปฎิเสธ</th>
                   
                     </tr>
                   </thead> ';
          // output data of each row
          //   " . $row["username"] . "
          while ($row2 = $result2->fetch_assoc()) {
            $number++;
            echo "<tr><td>".$number.".</td><td>" . $row2["name_project"] . "</td>  
                 <td>" . $row2["creator"] . "</td>  
                 <td><a href=edit_project.php?project_id=" . $row2['project_id'] . ">    <button type='button' class='btn btn-primary' style='width:10'>ตรวจสอบโครงการ</button></a></td> 
     
                 ", "
                 <td><a href=create_form.php?project_id=" . $row2['project_id'] . ">    <button type='button' class='btn btn-warning ' >ตรวจสอบแบบฟอร์ม</button></a></td> 
                  <td></td>
                 <td><a onClick=\"javascript: return confirm('ปฎิเสธโครงการ?');\" href=reject_project.php?project_id=" . $row2['project_id'] . " >  <button type='button' name ='delete' class='btn btn-danger' >ปฎิเสธ</button></a></td>
                 
                 </tr>";
          }
          echo "</table>";
        } else {
          echo "<h3>-ยังไม่มีรายการที่อนุมัติ-</h3>";
        }
        ?>
      </div>


      <div id="reject" >
        <br> <br> 
        <h2 style=" padding :20px;">รายการที่ปฎิเสธแล้ว</h2>
        <?php
        $sql3 = "SELECT * FROM create_project WHERE status = 'ไม่อนุมัติ'";
        $result3 = $conn->query($sql3);
        $number = 0;
     
        if ($result3->num_rows > 0) {
          echo '
           <table class="table table-responsive" id=table3 >
             <thead>
               <tr class="w3-red">
                <th style="width:4%">ที่</th>
                 <th style="width:26%">ชื่อโครงการ</th>
                 <th style="width:15%">ชื่อผู้ใช้</th>
                 <th data-orderable="false" style="width:15%">ตรวจสอบโครงการ</th>
                 <th data-orderable="false" style="width:15%">ตรวจสอบแบบฟอร์ม</th>
                 <th data-orderable="false" style="width:15%"></th>
                 <th data-orderable="false" style="width:15%">ยอมรับ</th>
           
             
               </tr>
             </thead> ';
          // output data of each row
          //   " . $row["username"] . "
          while ($row3 = $result3->fetch_assoc()) {
            $number++;
            echo "<tr><td>".$number.".</td><td>" . $row3["name_project"] . "</td>  
           <td>" . $row3["creator"] . "</td>  
           <td><a href=edit_project.php?project_id=" . $row3['project_id'] . ">    <button type='button' class='btn btn-primary' style='width:10'>ตรวจสอบโครงการ</button></a></td> 

           ", "
           <td><a href=create_form.php?project_id=" . $row3['project_id'] . ">    <button type='button' class='btn btn-warning ' >ตรวจสอบแบบฟอร์ม</button></a></td> 
            <td></td>
           <td><a onClick=\"javascript: return confirm('คุณต้องการอนุมัติโครงการ?');\" href=approve_project.php?project_id=" . $row3['project_id'] . " ><button type='button' name ='send' class='btn btn-success' >ยอมรับ</button></a></td>
           </tr>";
          }
          echo "</table>";
        } else {
          echo "<h3>-ยังไม่มีรายการที่ปฏิเสธ-</h3>";
        }
        ?>
      </div>





      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

      <script>  


        $(document).ready(function() {
              $("select").on("change", function() {
            if ($('select').val() == 'request') {
              $('#reject').hide();
              $('#accept').hide();
              $('#request').show();
            } else if($('select').val() == 'accept'){
              $('#reject').hide();
              $('#accept').show();
              $('#request').hide();
            }else if($('select').val() == 'reject') {
              $('#reject').show();
              $('#accept').hide();
              $('#request').hide();

            }else{
              $('#reject').show();
              $('#accept').show();
              $('#request').show();
            }
          });




          $('#table,#table2,#table3').DataTable({
            "pagingType": "full_numbers",
          });


        });
      </script>

      <script src="index.js"></script>
</body>

</html>