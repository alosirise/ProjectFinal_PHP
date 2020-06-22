<?php
session_start();
include('auth.php');
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
      <h2 style=" padding :30px; ">โครงการของทั้งหมด</h2>


        <?php


        include_once('connect.php');
        $sql = "SELECT * FROM create_project WHERE status ='อนุมัติ'";
        $result = $conn->query($sql);
        $number = 1;
        if ($result->num_rows > 0) {

          echo '
            <table class="w3-table-all" style="width:130%">
              <thead>
                <tr class="w3-blue-gray">
                 <th style="width:4%" ></th>
                  <th style="width:35%" >ชื่อโครงการ</th>
           
                  <th style="width:20%"> รายละเอียดโครงการ</th>
                  <th style="width:20%">แบบฟอร์ม</th>
    
                </tr>
              </thead> ';
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            $number++;
            echo "<tr><td></td><td>" . $row["name_project"] . "</td>  
            <td>  <button type='button' class='btn btn-info' style='width:10'> รายละเอียดโครงการ</button></a></td> 
            <td>   <button type='button' class='btn btn-success' style='width:10'>แบบฟอร์ม</button></a></td> 
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
      <!-- Compiled and minified JavaScript -->

      <script src="index.js"></script>
</body>

</html>