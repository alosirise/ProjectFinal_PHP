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
      <h2 style=" padding :30px; ">โครงการของฉัน</h2>

      <center>
        <button type="button" onclick="location.href = 'create_project.php'" class="btn btn-primary">สร้าง</button>
      </center>
      <form action="" method="POST">
        <?php


        include_once('connect.php');
        $sql = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' ";
        $result = $conn->query($sql);
        $number = 1;
        if ($result->num_rows > 0) {

          echo '
            <table class="w3-table-all">
              <thead>
                <tr class="w3-blue-gray">
                 <th style="width:4%" ></th>
                  <th style="width:40%" >ชื่อโครงการ</th>
           
                  <th style="width:10%"> จัดการโครงการ</th>
                  <th style="width:10%">จัดการแบบฟอร์ม</th>
                  <th style="width:10%">ส่ง</th>
                  <th style="width:10%">ลบ</th>
                </tr>
              </thead> ';
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            $number++;
            echo "<tr><td></td><td>" . $row["name_project"] . "</td>  
            <td><a href=arrange.php>    <button type='button' class='btn btn-primary' style='width:10'>จัดการโครงการ</button></a></td> 
            <td><a href=edit_project.php?project_id=" . $row['project_id'] . ">    <button type='button' class='btn btn-warning '>จัดการแบบฟอร์ม</button></a></td> 
            
            <td><a href=delete_project.php?project_id=" . $row['project_id'] . ">  <button type='button' name ='send' class='btn btn-success' disabled>ส่ง</button></a></td>
            <td><a href=delete_project.php?project_id=" . $row['project_id'] . ">  <button type='button' name ='delete' class='btn btn-danger' >ลบ</button></a></td>

            </tr>";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }
        ?>
      </form>


      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Compiled and minified JavaScript -->

      <script src="index.js"></script>
</body>

</html>