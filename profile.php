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
            <div class="col-lg-2" style="margin-top:5px;">
                <button type="button" class="btn btn-primary" onclick="location.href='editprofile.php'">Edit</button>  
            </div>
        </div>

<?php 
    include_once('connect.php');
    $sql = "SELECT * FROM `profile`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $date = new DateTime($row["dateofbirth"]);
            echo '
           <div class="col-lg-8 mx-auto">Firstname : '.$row["firstname"].'</div> 
           <div class="col-lg-8 mx-auto">Surname : '.$row["surname"].'</div>'.
           '<div class="col-lg-8 mx-auto">Date of Birth : '.date_format($date,"m/d/Y").'</div>
           <div class="col-lg-8 mx-auto">Address : '.$row["address2"].'</div>
           <div class="col-lg-8 mx-auto">Tel : '.$row["telephone"].'</div>
           <div class="col-lg-8 mx-auto">Email : '.$row["email"].'</div>
           <div class="col-lg-8 mx-auto">Food/Drug Allergy : '.$row["drug_food_allergy"].'</div>
           <div class="col-lg-8 mx-auto">Sex : '.$row["sex"].'</div>';
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