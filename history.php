<?php
session_start();
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

    <div class="w3-container col-lg-10 center">
      <h2 style=" padding :30px; ">ประวัติการเข้าร่วม</h2>

      <ul class="nav nav-tabs" role="tablist">
        <li> <a href="#list1" class="active nav-link" role="tab" data-toggle="tab">
            <icon class="fa fa-home"></icon> กำลังดำเนินการ
          </a>

        </li>
        <li><a href="#list2" class=" nav-link" role="tab" data-toggle="tab">
            <i class="fa fa-user"></i> เสร็จสิ้นแล้ว
          </a>

        </li>
      </ul>
      <br><br>

      <div class="tab-content">
        <div class="tab-pane fade active show " id="list1">
          <?php

          include_once('connect.php');
          $sql = "SELECT * FROM history WHERE username = '" . $_SESSION['username'] . "'  AND status ='ดำเนินการ'";


          $result = $conn->query($sql);
          $number = 0;
          if ($result->num_rows > 0) {

            echo ' 
            <table class="table table-responsive" id=table >
              <thead>
                <tr class="w3-blue-gray">
                <th style="width:4%" >ที่</th>
                  <th style="width:35%" >ชื่อโครงการ</th>
                  <th data-orderable="false" style="width:15%"> สถานะ</th>
                  <th data-orderable="false" style="width:20%"> รายละเอียดโครงการ</th>
                 
    
                </tr>
              </thead> ';
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $number++;
              echo "<tr><td>" . $number . "</td><td>" . $row["name_project"] . "</td>  
            <td>" . $row["status"] . "</td>
            <td>  <button type='button' class='btn btn-info' style='width:10'> รายละเอียด</button></a></td> 
            </tr>";
            }
            echo "</table>";
          } else {
            echo "0 results";
          }
          ?> </div>

        <div class="tab-pane fade" id="list2">
          <?php

          $sql = "SELECT * FROM history WHERE username = '" . $_SESSION['username'] . "' AND  status ='เสร็จสิ้น'";


          $result = $conn->query($sql);
          $number = 0;
          if ($result->num_rows > 0) {

            echo '<table class="table " id=table2 >
              <thead>
                <tr class="w3-blue-gray">
                <th style="width:4%" >ที่</th>
                  <th style="width:35%" >ชื่อโครงการ</th>
                  <th data-orderable="false" style="width:15%"> สถานะ</th>
                  <th data-orderable="false" style="width:20%"> รายละเอียดโครงการ</th>
                 
    
                </tr>
              </thead> ';
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              $number++;
              echo "<tr><td>" . $number . "</td><td>" . $row["name_project"] . "</td>  
            <td>" . $row["status"] . "</td>
            <td>  <button type='button' class='btn btn-info' style='width:10'> รายละเอียด</button></a></td> 
            </tr>";
            }
            echo "</table>";
          } else {
            echo "0 results";
          }
          ?>

        </div>
      </div>





    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#table,#table2').DataTable({
        "pagingType": "full_numbers",
      });


    });
  </script>



  <script src="index.js"></script>
</body>

</html>