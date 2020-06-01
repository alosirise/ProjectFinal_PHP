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
</head>

<body>
    <div class="" id="nav"></div>
        <div class="row">
            <div class="col-lg-4"></div>  
            <div class="col-lg-1" style="font-size: 32px;">โปรไฟล์</div>
            <div class="col-lg-2" style="margin-top:5px;">
                <button type="button" class="btn btn-primary" onclick="location.href='editprofile.php'">Edit</button>  
            </div>
        </div>

<?php
    include_once('connect.php');
    $sql = "SELECT * FROM `profile` WHERE id = '".$_SESSION['id']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $date = new DateTime($row["dateofbirth"]);
            echo '
           <div class="col-lg-8 mx-auto">ชื่อ : '.$row["firstname"].'</div> 
           <div class="col-lg-8 mx-auto">นามสกุล : '.$row["surname"].'</div>'.
           '<div class="col-lg-8 mx-auto">วัด/เดือน/ปีเกิด : '.date_format($date,"d/m/Y").'</div>
           <div class="col-lg-8 mx-auto">ที่อยู่ : '.$row["address2"].'</div>
           <div class="col-lg-8 mx-auto">เบอร์โทร : '.$row["telephone"].'</div>
           <div class="col-lg-8 mx-auto">อีเมลล์ : '.$row["email"].'</div>
           <div class="col-lg-8 mx-auto">แพ้ยา/อาหาร : '.$row["drug_food_allergy"].'</div>
           <div class="col-lg-8 mx-auto">เพศ : '.$row["sex"].'</div>';
        }
    }
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>
</body>

</html>