<?php ob_start(); ?>
<?php
session_start();
include_once('connect.php');
?>
<!doctype html>
<html lang="en">

<head>

    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-5  mx-auto mt-5 ">
                <div class="card">
                    <form action="" method="POST" name="myForm" onsubmit="return validateForm()">
                        <div class="card-header text-center">Register</div>
                </div>

                <div class="card-body">
                    <div class="center">
                        <img src="pic.jpg" class="" style="width: 300px; padding-top: 50px; padding-bottom: 50px;">
                    </div>


                    <div class="form-row">
                        <div class="col form-group">
                            <label>First name </label>
                            <input type="text" id="firstname" class="form-control" name="firstname" required>
                        </div>
                        <div class="col form-group">
                            <label>Last name</label>
                            <input type="text" id="surname" class="form-control" name="surname" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" id="username" class="form-control" name="username" pattern=".{3,}[A-Za-z0-9]" title="Four or more characters and in A-z,a-z,0-9 format">
                        </div>
                    </div>
                    <div class="formgroup row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" id="password" class="form-control" name="password" pattern=".{7,}[A-Za-z0-9]" title="Eight or more characters and in A-z,a-z,0-9 format">
                        </div>
                    </div>

                    <div class="formgroup row">
                        <label for="password" class="col-sm-3 col-form-label">Confirm password</label>
                        <div class="col-sm-9">
                            <input type="password" id="confirm_password" class="form-control" name="confirm_password" pattern=".{7,}[A-Za-z0-9]" title="Eight or more characters and in A-z,a-z,0-9 format">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <input type="submit" name="submit" class="btn btn-success " value="Submit">


                    </form>
                    <input type="submit" name="back" class="btn btn-success " value="Back" onclick="back()">
                </div>

            </div>

        </div>
    </div>
    <?php

if (isset($_POST['submit'])) {
    $sql2 = "SELECT username FROM member WHERE username ='$_POST[username]'";
    $result2 = mysqli_query($conn, $sql2);

    if ($_POST["password"] != $_POST["confirm_password"]) {
        echo '<script>alert("Password is mismatch")</script>';
    } else if (mysqli_num_rows($result2) > 0) {
        echo '<script>alert("ชื่อของไอดีซ้ำกับที่มีอยู่แล้ว โปรดตั้งชื่ออื่น")</script>';
    } else {
        //remove back slash    
        $username = stripcslashes($_REQUEST['username']);
        //escape apecial character in string
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripcslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO member (id, username, password ,role) VALUES ( NULL,'$username', '" . md5($password) . "','user')";
        $result = mysqli_query($conn, $sql);

        $firstname = $_POST["firstname"];
        $surname = $_POST["surname"];

        $sql3="SELECT * FROM member WHERE username =  '".$username."'";
        $result3 = $conn ->query($sql3); 
        if($result3->num_rows > 0){
            $row = $result3->fetch_assoc();
                $profile_id = $row['id'];
        }

        $sql2 = "INSERT INTO profile (id, firstname_surname , dateofbirth, address2, telephone, email, drug_food_allergy, sex, profile_id) VALUES ( NULL,'$firstname $surname','1900-01-01','','','','','','$profile_id')";
        $result2 = mysqli_query($conn, $sql2);

        
        if ($result && $result2 && $result3) {
            echo '<script>alert("Registration Done")</script>';
        }
    }
}
?>
    <script>
        function validateForm() {
            var name = document.forms["myForm"]["username"].value;
            var password = document.forms["myForm"]["password"].value;
            var c_password = document.forms["myForm"]["confirm_password"].value;
            if (name == "") {
                alert("Name must be filled out");
                return false;
            } else if (password == "") {
                alert("password must be filled out");
                return false;
            } else if (c_password == "") {
                alert("Confirm password must be filled out");
                return false;
            } else {}
        }

        function back() {
            window.location = 'signin.php';
        }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="index.js"></script>
</body>

</html>