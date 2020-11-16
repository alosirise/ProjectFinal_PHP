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
<style>
    .container {
        position: relative;
        width: 50%;
    }

    .image {
        opacity: 1;
        display: flex;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .container:hover .image {

        opacity: 0.5;

    }

    .container:hover .middle {
        opacity: 1;
    }

    .text {
        cursor: pointer;
        vertical-align: middle;
        width: 249px;
        height: 249px;
        border-radius: 50%;

        transition: opacity .6s;
        background: black;
        color: whitesmoke;
        font-size: 27px;

    }
</style>

<body>
    <div class="" id="nav"></div>
    <div class="row">
        <div class="col-4 offset-md-4 form-div">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <center><label style="font-size: 32px;">โปรไฟล์</label><br><br>
                        <?php
                        include_once('connect.php');
                        $session = $_SESSION['id'];
                        $sql4 = "SELECT * FROM images WHERE id = '" . $_SESSION['id'] . "'";
                        $result4 = mysqli_query($conn, $sql4);
                        if ($result4->num_rows > 0) {
                            while ($row = $result4->fetch_assoc()) {
                                echo '<div class="container"> <div class="text" ><img id="profileDisplay" class="image"  style="cursor: pointer;"onclick="triggerClick()"
                                 src="data:image;base64,' . $row["image"] . '"><div class="middle" onclick="triggerClick()">
                                Edit</div></div>
                               </div> </center>';
                            }
                        } else {
                            echo '<div class="container"> <div class="text"><img id="profileDisplay" class="image"  style="cursor: pointer;"onclick="triggerClick()"
                            src="images/placeholder_2.jpg">
                            <div class="middle" onclick="triggerClick()">Edit</div></div>
                          </div> </center>';
                        }
                        echo '<input type="file" name="image" id="image" style="display: none;" onchange="displayImage(this)">
                    </div>   <br>';

                        $sql = "SELECT * FROM `profile` WHERE profile_id = '" . $_SESSION['id'] . "'";
                        $result = mysqli_query($conn, $sql);

                        //fix current date
                        $current_date = date("Y-m-d");
                     
                        if ($result->num_rows > 0) {
                            echo '<table class="table" id=table>';

                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <tr><td>ชื่อ-สกุล</td><td><input type="text" value="' . $row["firstname_surname"] . '" name="firstname_surname" required></td></tr>
                                <tr><td>วัน/เดือน/ปีเกิด</td><td> <input type="date" value="' . $row["dateofbirth"] . '" name="dateofbirth" min="1900-01-01" max="' . $current_date . '"></td></tr>
                                <tr><td>ที่อยู่</td><td><textarea name="address2" required rows="3" cols="30">' . $row["address2"] . '</textarea></td></tr>
                                <tr><td>เบอร์โทร</td><td><input type="text" value="' . $row["telephone"] . '" name="telephone" pattern=".{9,10}" required title="9 to 10 characters"></td></tr>
                                <tr><td>อีเมลล์</td><td><input type="email" value="' . $row["email"] . '" name="email" required></td></tr>
                                <tr><td>แพ้ยา/อาหาร</td><td><input type="text" value="' . $row["drug_food_allergy"] . '" name="drug_food_allergy" required></td></tr>';

                                if ($row["sex"] == "male") {
                                    echo '<tr><td>เพศ</td><td>
                <input type="radio" name="sex" value="ชาย" checked>
                <label for="male">ชาย</label>
                <input type="radio" name="sex" value="หญิง">
                <label for="male">หญิง</label></td>';
                                } else {
                                    echo '<tr><td>เพศ</td><td>
                <input type="radio" name="sex" value="ชาย">
                <label for="male">ชาย</label>
                <input type="radio" name="sex" value="หญิง" checked>
                <label for="male">หญิง</label></td>';
                                }

                                echo '</tr><br>';
                                echo '<tr><td colspan=4>
                                <center><button type="submit" class="btn btn-primary" name="submit1">Save</button></center></td></tr>';
                            }
                        }

                        ?>

                        
                </div>
        </div>
    </div>
    </form>

    <?php
    function saveimage($name, $image)
    {
        $conn = new mysqli('localhost', 'root', '', 'basic');
        if ($conn->connect_errno) {
            die("Connection Filed" . $conn->connect_error);
        }
        $session = $_SESSION['id'];

        $sql2 = "DELETE FROM images WHERE id = '" . $session . "'";
        $result2 = mysqli_query($conn, $sql2);
        $sql3 = "INSERT INTO images (id,name,image) VALUES ('$session','$name','$image')";
        $result3 = mysqli_query($conn, $sql3);

        $conn->close();
    }
    if (isset($_POST['submit1'])) {
        $session = $_SESSION['id'];
        $firstname_surname = $_POST['firstname_surname'];
        $dateofbirth = $_POST["dateofbirth"];
        $address2 = $_POST["address2"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];
        $drug_food_allergy = $_POST["drug_food_allergy"];
        $sex = $_POST["sex"];

        $sql2 = "UPDATE `profile` SET firstname_surname = '" . $firstname_surname . "' ,dateofbirth = '" . $dateofbirth . "' ,address2 = '" . $address2 . "'
        ,telephone = '" . $telephone . "' ,email = '" . $email . "' ,drug_food_allergy = '" . $drug_food_allergy . "' ,sex = '" . $sex . "' WHERE profile_id='" . $session . "'";
        $result = mysqli_query($conn, $sql2);
        echo "<script>window.location='profile.php?profile_id=$_SESSION[id]';</script>";
        if (empty($_FILES['image']['tmp_name'])) {
            echo "Please select image.";
        } else {
            $image = addslashes($_FILES['image']['tmp_name']);
            $name = addslashes($_FILES['image']['name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);

            saveimage($name, $image);
        }
    }
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script>
        function triggerClick() {
            console.log("click");
            document.querySelector('#image').click();
        }

        function displayImage(e) {
            console.log("display");
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
    <script src="index.js"></script>
</body>

</html>