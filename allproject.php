<?php
session_start();
<<<<<<< Updated upstream
include('auth.php');
=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
 #main {
  position: absolute;
  top: 50px;
  right: 25px;
  bottom: 25px;
  left: 24%;
}
=======
  #main {
    position: absolute;
    top: 50px;
    right: 25px;
    bottom: 25px;
    left: 24%;
  }
>>>>>>> Stashed changes
</style>

<body>
  <div class="" id="nav"></div>


  <div id="main">

<<<<<<< Updated upstream
    <div class="w3-container col-lg-10 center">
      <h2 style=" padding :30px; ">โครงการของทั้งหมด</h2>
=======
    <div class="w3-container col-lg-11 center">
      <h2 style=" padding :30px; ">รายชื่อโครงการทั้งหมด</h2>
>>>>>>> Stashed changes


      <?php


      include_once('connect.php');
<<<<<<< Updated upstream
      $sql = "SELECT * FROM create_project WHERE status ='อนุมัติ'";
=======
      $sql = "SELECT * FROM create_project WHERE status ='อนุมัติ' ORDER BY last_change DESC ";
>>>>>>> Stashed changes
      $result = $conn->query($sql);
      $number = 0;
      if ($result->num_rows > 0) {

        echo '
            <table class="table table-responsive" id=table >
              <thead>
                <tr class="w3-blue-gray">
            
                <th style="width:4%" >ที่</th>

                  <th style="width:35%" >ชื่อโครงการ</th>
<<<<<<< Updated upstream
                  <th style="width:10%" >ชื่อผู้สร้าง</th>
                  <th data-orderable="false" style="width:20%"> รายละเอียดโครงการ</th>
                  <th data-orderable="false"style="width:20%">แบบฟอร์ม</th>
=======
                
                  <th data-orderable="false" style="width:20%"> รายละเอียดโครงการ</th>
                  
>>>>>>> Stashed changes
    
                </tr>
              </thead> ';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          $number++;
          echo "<tr><td>" . $number . ".</td><td>" . $row["name_project"] . "</td>  
<<<<<<< Updated upstream
          <td>" . $row["creator"] . "</td>  
            <td>  <a href=detail_project.php?project_id=" . $row['project_id'] . "><button type='button' class='btn btn-info' style='width:10'> รายละเอียดโครงการ</button></a></td> 
            <td>   <a href=question_form.php?project_id=" . $row['project_id'] . "><button type='button' class='btn btn-success' style='width:10'>แบบฟอร์ม</button></a></td> 
=======
        
            <td>  <a href=detail_project.php?project_id=" . $row['project_id'] . "><button type='button' class='btn btn-info' style='width:10'> รายละเอียดโครงการ</button></a></td> 
>>>>>>> Stashed changes
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
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#table').DataTable({
        "pagingType": "full_numbers",
      });


    });
  </script>



  <script src="index.js"></script>
</body>

</html>