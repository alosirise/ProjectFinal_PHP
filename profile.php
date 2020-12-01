<?php ob_start(); ?>
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

    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="bew.css">
</head>

<body>
    <div class="" id="nav"></div>
    <div class="row">
        <div class="col-4 offset-md-4 form-div">
            <form action="" method="POST">
                <div class="form-group">
                    <center><label style="font-size: 32px; padding-top:50px;">โปรไฟล์</label><br><br>
                        <?php
                        $profile_id = $_GET['profile_id'];

                        include_once('connect.php');
                        $sql2 = "SELECT * FROM images WHERE id = '" . $profile_id . "'";
                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                echo '<img id="profileDisplay" src="data:image;base64,' . $row["image"] . '">';
                            }
                        } else {
                            echo '<img src="images/placeholder_2.jpg" id="profileDisplay">';
                        }
                        ?>
                </div>


<br>

                <?php
                if ($_SESSION['id'] == $_GET['profile_id']) {
                ?>
                    <center><button type="button" class="btn btn-primary" onclick="location.href='editprofile.php'">Edit</button></center></center>
                <?php
                }
                ?>
<br>

                <?php

                $sql = "SELECT * FROM profile WHERE profile_id = '$_GET[profile_id]'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table class="table " id=table>';
                    while ($row = $result->fetch_assoc()) {
                        $date = new DateTime($row["dateofbirth"]);
                        echo '<tr><td>ชื่อ-สกุล</td><td>' . $row["firstname_surname"] . '</td></tr>' .
                            '<tr><td>วัน/เดือน/ปีเกิด</td><td>' . date_format($date, "d/m/Y") . '</td></tr>
                            <tr><td>ที่อยู่</td><td>' . $row["address2"] . '</td></tr>
                            <tr><td>เบอร์โทร</td><td>' . $row["telephone"] . '</td></tr>
                            <tr><td>อีเมลล์</td><td>' . $row["email"] . '</td></tr>
                            <tr><td>แพ้ยา/อาหาร</td><td>' . $row["drug_food_allergy"] . '</td></tr>
                            <tr><td>เพศ</td><td>' . $row["sex"] . '</td></tr></table>';
                    }
                }
                ?><br><br>
            </form>
        </div>
    </div>
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>
</body>

</html>