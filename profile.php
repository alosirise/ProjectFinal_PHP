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
                    <center><label style="font-size: 32px;">โปรไฟล์</label><br><br>
                    <?php
                    include_once('connect.php');
                    $sql2 = "SELECT * FROM images WHERE id = '" . $_SESSION['id'] . "'";
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
                <center><button type="button" class="btn btn-primary" onclick="location.href='editprofile.php'">Edit</button></center>
                </center>
                <?php

                $sql = "SELECT * FROM `profile` WHERE id = '" . $_SESSION['id'] . "'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $date = new DateTime($row["dateofbirth"]);
                        echo '
           <div class="col-lg-8 mx-auto">ชื่อ : ' . $row["firstname"] . '</div> 
           <div class="col-lg-8 mx-auto">นามสกุล : ' . $row["surname"] . '</div>' .
                            '<div class="col-lg-8 mx-auto">วัน/เดือน/ปีเกิด : ' . date_format($date, "d/m/Y") . '</div>
           <div class="col-lg-8 mx-auto">ที่อยู่ : ' . $row["address2"] . '</div>
           <div class="col-lg-8 mx-auto">เบอร์โทร : ' . $row["telephone"] . '</div>
           <div class="col-lg-8 mx-auto">อีเมลล์ : ' . $row["email"] . '</div>
           <div class="col-lg-8 mx-auto">แพ้ยา/อาหาร : ' . $row["drug_food_allergy"] . '</div>
           <div class="col-lg-8 mx-auto">เพศ : ' . $row["sex"] . '</div>';
                    }
                }
                ?>
            </form>
        </div>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>
</body>

</html>