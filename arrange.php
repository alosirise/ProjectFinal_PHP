<?php ob_start();?>
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
      <h2 style=" padding :30px; ">++++++ARRANGE ไม่ได้ใช้แล้ว+++++</h2>

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
                  <th style="width:65%" >ชื่อโครงการ</th>
                  <th style="width:12%">ผู้สร้าง</th>
                  <th style="width:5%">สถานะ</th>
                  <th style="width:10%"> แก้ไข</th>
                  <th style="width:10%">ลบ</th>
                 
                </tr>
              </thead> ';
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            $number++;
            echo "<tr><td></td><td>" . $row["name_project"] . "</td> <td>" . $row["creator"] . "</td> 
            <td><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='inlineCheckbox1' value='option1'></td>
            <td><a href=edit_project.php?project_id=".$row['project_id'].">    <button type='button' class='btn btn-warning'>แก้ไข</button></a></td> 
            <td><a href=delete_project.php?project_id=".$row['project_id'].">  <button type='button' name ='delete' class='btn btn-danger'>ลบ</button></a></td>
          
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