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
            <h2 style=" padding :30px; ">จัดการบัญชี</h2>


            <?php


            include_once('connect.php');
            $sql = "SELECT * FROM  member ";
            $result = $conn->query($sql);
         
            if ($result->num_rows > 0) {
                echo '
            <table class="w3-table-all" style="width:130%">
              <thead>
                <tr class="w3-blue-gray">
                 <th style="width:4%" ></th>
                  <th style="width:35%" >ชื่อผู้ใช้</th>          
                  <th style="width:15%"> สถานะ</th>
                  <th style="width:15%"> แบน</th>
                  
                </tr>
              </thead> ';
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td></td><td>" . $row["username"] . "</td>  
                    <td>" . $row["role"] . "</td>  

                    <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" >  <button type='button' name ='delete' class='btn btn-danger' >ลบ/แบน</button></a></td>         
                    </tr>";
                }


                echo "</table>";
            } else {
                echo " 0 account";
            }
            ?>


            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <!-- Compiled and minified JavaScript -->

            <script src="index.js"></script>
</body>

</html>