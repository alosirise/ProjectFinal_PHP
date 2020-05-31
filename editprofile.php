<!doctype html>
<html lang="en">

<head>
    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="tis-620">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
        <div class="" id="nav"></div>
        <div class="row">
            <div class="col-lg-4"></div>  
            <div class="col-lg-1" style="font-size: 32px;">โปรไฟล์</div>
        </div>
        <form action="" method="POST">
<?php
    session_start();
    include_once('connect.php');
    $sql = "SELECT * FROM `profile`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '
           <div class="col-lg-8 mx-auto">ชื่อ <input type="text" value="'.$row["firstname"].'" name="firstname"></div> 
           <div class="col-lg-8 mx-auto">นามสกุล <input type="text" value="'.$row["surname"].'" name="surname"></div>
           <div class="col-lg-8 mx-auto">วัน/เดือน/ปีเกิด <input type="date" value="'.$row["dateofbirth"].'" name="dateofbirth"></div>
           <div class="col-lg-8 mx-auto">ที่อยู่ <input type="text" value="'.$row["address2"].'" name="address"></div>
           <div class="col-lg-8 mx-auto">เบอร์โทร <input type="text" value="'.$row["telephone"].'" name="telephone"></div>
           <div class="col-lg-8 mx-auto">อีเมลล์ <input type="text" value="'.$row["email"].'" name="email"></div>
           <div class="col-lg-8 mx-auto">แพ้ยา/อาหาร <input type="text" value="'.$row["drug_food_allergy"].'" name="drug_food_allergy"></div>
           <div class="col-lg-8 mx-auto">เพศ <input type="text" value="'.$row["sex"].'" name="sex"></div>';
        }
    }
?>

<div class="col-lg-8 mx-auto" style="margin-top:5px;">
    <button type="submit" class="btn btn-primary" name="submit">Save</button>
</div>
</form>

<?php

    if(isset($_POST['submit'])){
        $session=$_SESSION['id'];
        $firstname = $_POST['firstname'];
        $surname = $_POST["surname"];
        $dateofbirth = $_POST["dateofbirth"];
        $address2 = $_POST["address"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];
        $drug_food_allergy = $_POST["drug_food_allergy"];
        $sex = $_POST["sex"];   

        $sql2 = "UPDATE `profile` SET firstname = '".$firstname."' ,surname = '".$surname."' ,dateofbirth = '".$dateofbirth."' ,address2 = '".$address2."'
        ,telephone = '".$telephone."' ,email = '".$email."' ,drug_food_allergy = '".$drug_food_allergy."' ,sex = '".$sex."' WHERE id='".$session."'";
        $result = mysqli_query($conn , $sql2);
        header('location:profile.php');
    }
?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>
</body>

</html>