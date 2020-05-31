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

    <?php
   
    session_start();
    
    include_once('connect.php');
    $sql = "SELECT name_project,creator FROM create_project WHERE id = '".$_SESSION['id']."' ";
    $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        echo '
        <div class="row">
          <div class="col-lg-3"></div>
          <div class="w3-container col-lg-6 center " >
            <h2 style=" padding :30px; ">โครงการของฉัน</h2>
           
            <table class="w3-table-all">
              <thead>
                <tr class="w3-blue-gray">
                  <th style="width:60%" >ชื่อโครงการ</th>
                  <th style="width:20%">ผู้สร้าง</th>
                  <th style="width:10%">อนุมัติ</th>
                  <th ></th>
                 
            
                </tr>
              </thead>';
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name_project"]. "</td> <td>" . $row["creator"]. "</td> 
            <td><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='inlineCheckbox1' value='option1'></td>
            <td><button type='button' class='btn btn-primary'>Edit</button></td> </tr>";
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