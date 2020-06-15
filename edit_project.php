<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin") {
    header('location: home.php');
    exit();
}
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <div class="" id="nav"></div>
    <form action="" method="POST">
        <?php
        include_once('connect.php');
        $sql = "SELECT * FROM create_project WHERE project_id = '$_GET[project_id]'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {


            while ($row = $result->fetch_assoc()) {
                $_SESSION['project_id'] = $row['project_id'];
                echo ' 
            <div class="row">
            <div class="col-lg-3"></div>
            <div class="w3-container col-lg-6 center">
                <h2 style=" padding :45px;">แก้ไขโครงการ</h2>
                <div class="card">
                    <div class="card-body">
                        <div>
                            <label for="exampleFormControlInput1">ชื่อโครงการ</label>
                            <input type="text" class="form-control text" id="name_project" name="name_project"  value="' . $row["name_project"] . '"></td>
                        </div>
                        <div>
                            <label for="exampleFormControlInput1">หน่วยงานที่รับผิดชอบ</label>
                            <input type="text" class="form-control text" id="respondsible_department" name="respondsible_department"   value="' . $row["respondsible_department"] . '"></td>
                        </div>
                        <div>
                            <label for="exampleFormControlInput1">หลักการและเหตุผล</label>
                            <textarea class="form-control text" id="principle" name="principle" rows="3" > ' . $row["principle"] . '</textarea>
                        </div>
                        
                        <label >วัตถุประสงค์</label>
                        <div>         
                            <table>            
                                    <tr>
                                    <td><input type="text" class ="form-control" name="objective" id="objective"></td>
                                    <td><a class="remove" >-</td>
                                    </tr>           
                            </table>  
                            <tbody1></tbody><br>
                         
                            <a class="btn btn-primary pull-left" id="addRow1" style="cursor: pointer;"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a><br><br>
                        </div>
                      
                        <div>
                        <label for="exampleFormControlInput1">กลุ่มเป้าหมาย</label>
                            <input type="text" class="form-control text" id="target_group" name="target_group"   value="' . $row["target_group"] . '"></td>
                        </div>
    
                        <div>
                            <label for="exampleFormControlInput1">ระยะเวลาในการจัดการโครงการ</label>
                            <input type="text" class="form-control text" id="duration" name="duration"   value="' . $row["duration"] . '"></td>
                        </div>
    
                        <label for="exampleFormControlInput1">วิทยากร</label>
                        <div>
                            <table>
                               
                                    <tr>
                                    <td><input type="text" class ="form-control" name="lecturer" id="lecturer"></td>
                                    <td><a class="remove" >-</td>
                                    </tr>                 
                                
                            </table> <tbody2></tbody><br>
                            <a class="btn btn-primary pull-left" id="addRow2" style="cursor: pointer;"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a><br><br>
                        </div>
                      
    
                        <div>
                            <label for="exampleFormControlInput1">สถานที่อบรม</label>
                            <input type="text" class="form-control text" id="location" name="location"   value="' . $row["location"] . '"></td>
                        </div>
    
                        <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label>
                        <div>
                            <table>                   
                                    <tr>
                                    <td><input type="text" class ="form-control"  name="benefits" id="benefits"></td>
                                    <td><a class="remove" >-</td>
                                    </tr>

                            </table><tbody3></tbody><br>   
                            <a class="btn btn-primary pull-left" id="addRow3" style="cursor: pointer;"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a><br><br>
                        </div>
                     
                  
                        <div>
                            <label for="exampleFormControlInput1">ค่าลงทะเบียนอบรม</label>
                            <input type="text" class="form-control text" id="cost" name="cost"   value="' . $row["cost"] . '"></td>
                        </div>
    
                        <div>
                            <label for="exampleFormControlInput1">งบประมาณค่าใช้จ่าย</label>
                            <div id="includedContent" name ="budget"   value="' . $row["budget"] . '"></div>
                        </div>
    
                        <label for="exampleFormControlInput1">คณะทำงาน</label>
                        <div>
                            <table>
                                    <tr>
                                    <td><input type="text" class ="form-control" name="working_group" id="working_group"></td>
                                    <td><a class="remove" >-</td>
                                    </tr>
                            </table> <tbody4></tbody><br>
                            <a class="btn btn-primary pull-left" id="addRow4" style="cursor: pointer;"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a><br><br>
                        </div>
                      
                       
                    </div>
                </div>
            </div>
        </div>
    ';
            }
        }
        ?>
        <div class="card-footer text-center">
            <a href='arrange.php'> <input type="submit" name="submit" class="btn btn-success " value="Submit"></a>
        </div>
    </form>
    <?php

    if (isset($_POST["submit"])) {

        $name_project = $_POST['name_project'];
        $respondsible_department = $_POST['respondsible_department'];
        $principle = $_POST['principle'];
        $objective = $_POST['objective'];
        $target_group = $_POST['target_group'];
        $duration = $_POST['duration'];
        $lecturer = $_POST['lecturer'];
        $location = $_POST['location'];
        $benefits = $_POST['benefits'];
        $cost = $_POST['cost'];

        $working_group = $_POST['working_group'];

        $sql2 = "UPDATE `create_project` SET name_project = '" . $name_project . "', respondsible_department = '" . $respondsible_department . "'  
            ,principle = '" . $principle . "',objective = '" . $objective . "',target_group = '" . $target_group . "',duration = '" . $duration . "',
            lecturer = '" . $lecturer . "',location = '" . $location . "',benefits = '" . $benefits . "',cost = '" . $cost . "',
            working_group = '" . $working_group . "'  WHERE project_id = '$_GET[project_id]'";
        $result = mysqli_query($conn, $sql2);

        if ($result) {
            echo "<script>alert('แก้ไขเรียบร้อย');
                window.location='myproject.php';</script>";
        }
    }
    ?>


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="index.js"> </script>
    <script>
        var html = '<tr><td><input type="text" class ="form-control" name="name"></td><td><a class="remove" >-</td></tr>';
        // var html = "echo ".'<tr><td><input type='."text".' name='."name".'></td><td><button class='."remove".'>-</button></td></tr>'." ";
        $(function() {
            $("#includedContent").load("table_edit.php");
        });
        $(function() {
            $('tbody').sortable();

            $('#addRow1').click(function() {
                $('tbody1').before(html);
            });
            $('#addRow2').click(function() {
                $('tbody2').before(html);
            });
            $('#addRow3').click(function() {
                $('tbody3').before(html);
            });
            $('#addRow4').click(function() {
                $('tbody4').before(html);
            });


            $(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
            });
        });
    </script>
</body>

</html>