<?php
session_start();
include('auth.php');

//   if($_SESSION['role'] != id)

?>


<!doctype html>
<html lang="en">

<head>
    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="bew.css"> -->
</head>
<style>
    .parent {
        width: 100%;
        height: 400px;
        overflow: hidden;
    }

    /* This will style any <img> element in .parent div */
    .parent img {
        width: 100%;
        height: auto;
        cursor: pointer;
    }
</style>

<body>
    <div class="" id="nav"></div>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="w3-container col-lg-6 center">
                <h2 style=" padding :45px;">รายละเอียดโครงการ</h2>

                <div class="card">
                    <div class="card-body">

                        <?php
                        include_once('connect.php');
                        $sql = "SELECT * FROM create_project WHERE project_id = '$_GET[project_id]'";
                        $result = $conn->query($sql);

                        $sql_mutiple_text = "SELECT * FROM mutiple_text WHERE project_id = '$_GET[project_id]'";
                        $result_mutiple_text = $conn->query($sql_mutiple_text);

                        if ($result->num_rows > 0) {


                            while ($row = $result->fetch_assoc()) {
                                $_SESSION['project_id'] = $row['project_id'];
                                echo '   

                                      <h2 style=" padding :45px;">ชื่อโครงการ  : ' . $row["name_project"] . '</h2>
                                    
                                      ';

                                if ($row["image_project"] == NULL) {
                                    echo '<div class="parent"><img src="images/placeholder_2.jpg"   src="images/placeholder_2.jpg" id="profileDisplay" onclick="triggerClick()" ></div>';
                                } else {
                                    echo '<div class="parent"><img id="profileDisplay"  onclick="triggerClick()" src="data:image;base64,' . $row["image_project"] . '"></div>';
                                }
                                echo '<center><input type="file" name="image" id="image" style="display: none;" onchange="displayImage(this)"></center>';

                                echo '
                                <br><br>
                                      <h2 style=" padding :300 px;"></h2>
                                     
                                      <h4 style=" padding :25px;">สถานที่ : ' . $row["location"] . ' </h4>
                                      <h4 style=" padding :25px;">ระยะเวลา : ' . $row["duration"] . ' </h4>
                                      <h4 style=" padding :25px;">ราคา : ' . $row["cost"] . ' บาท </h4>
                                      </div>
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                              <div class="col-lg-3"></div>
                              <div class="w3-container col-lg-6 center">
                                  <h2 style=" padding :45px;"></h2>
                  
                                  <div class="card">
                                      <div class="card-body">
                              
                              
                              <h4 style=" padding :35px;">  รายละเอียด  <i class="fa fa-pencil-square-o " style="cursor: pointer;" onclick="edit(\'detail\')"></i></h4> 
                              <textarea class="form-control text" id=edit_detail name="detail" readonly rows="6" >' . $row["detail"] . '</textarea>
                              </div>
                              </div>
                          </div>
                      </div>



                      <div class="row">
                      <div class="col-lg-3"></div>
                      <div class="w3-container col-lg-6 center">
                          <h2 style=" padding :45px;"></h2>
          
                          <div class="card">
                              <div class="card-body">

                              <h4 style=" padding :20px;">รายชื่อผู้สมัคร </h4>
                             

                              </div>
                              </div>
                          </div>
                      </div>
                      ';
                            }
                        }
                        ?>
                        <div class="card-footer text-center">
                            <input type="submit" name="submit" class="btn btn-success " value="บันทึก">
                        </div>

    </form>
    <?php


    if (isset($_POST["submit"])) {
        echo "<script>console.log('cgdfdfgdfg' );</script>";
        $detail = $_POST['detail'];
        $sql2 = "UPDATE `create_project` SET detail = '" . $detail . "'  WHERE project_id = '$_GET[project_id]'";
        $result2 = mysqli_query($conn, $sql2);

        if ($_SESSION['go'] == "go_project") {
            echo "<script>window.location='myproject.php';</script>";
        } else if ($_SESSION['go'] == "go_request") {
            echo "<script>window.location='request.php';</script>";
        }

        echo '<pre>', print_r($_FILES), '</pre>';

        if (empty($_FILES['image']['tmp_name'])) {
            echo "Please select image.";
        } else {
            $image = addslashes($_FILES['image']['tmp_name']);
            $name = addslashes($_FILES['image']['name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);

            echo "<script>console.log('$name','$image');</script>";
            echo "<script>console.log('$_GET[project_id]' );</script>";

            $sql3 = "UPDATE `create_project` SET image_project = '" . $image . "',name_image = '" . $name . "'  WHERE project_id = '$_GET[project_id]'";
            $result3 = mysqli_query($conn, $sql3);
        }
    }
    ?>


    <script>
        function edit(type) {
            if ($('input[id=edit_' + type + '], textarea[id=edit_' + type + ']').is('[readonly]')) {

                $('input[id=edit_' + type + '], textarea[id=edit_' + type + ']').attr('readonly', false);
                // console.log("table id " +table_id);
            } else {

                $('input[id=edit_' + type + '], textarea[id=edit_' + type + ']').attr('readonly', true);
            }
        }
    </script>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="index.js"> </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>

</html>