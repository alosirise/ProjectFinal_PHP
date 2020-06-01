<?php 
    session_start();
    include('auth.php');

    if($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin"){
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="navbar.css">
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
            echo ' 
            <div class="row">
            <div class="col-lg-3"></div>
            <div class="w3-container col-lg-6 center">
                <h2 style=" padding :45px;">สร้างโครงการ</h2>
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
                            <textarea class="form-control text" id="principle" name="principle" rows="3" > ' . $row["principle"]. '</textarea>
                        </div>
                        
                        <label for="exampleFormControlInput1">วัตถุประสงค์</label>
                        <div>         
                            <table>
                                <tbody1>
                                    <tr>
                                        <td><input type="text" class ="form-control" name="objective" id="objective"   value="' . $row["objective"] . '"></td>
                                        <td><button class="remove">-</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button id="addRow1">+ Add</button>
                      
    
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
                                <tbody2>
                                    <tr>
                                        <td><input type="text" class ="form-control" name="lecturer" id="lecturer"  value="' . $row["lecturer"] . '"></td>
                                        <td><button class="remove">-</button></td>
                                    </tr>                 
                                </tbody>
                            </table>
                        </div>
                        <button id="addRow2">+ Add</button>
                      
    
                        <div>
                            <label for="exampleFormControlInput1">สถานที่อบรม</label>
                            <input type="text" class="form-control text" id="location" name="location"   value="' . $row["location"] . '"></td>
                        </div>
    
                        <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label>
                        <div>
                            <table>
                                <tbody3>
                                    <tr>
                                        <td><input type="text" class ="form-control"  name="benefits" id="benefits"  value="' . $row["benefits"] . '"></td>
                                        <td><button class="remove">-</button></td>
                                    </tr>
                              
                                </tbody>
                            </table>
                        </div>
                        <button id="addRow3">+ Add</button>
                  
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
                                <tbody4>
                                    <tr>
                                        <td><input type="text" class ="form-control" name="working_group" id="working_group"   value="' . $row["working_group"] . '"></td>
                                        <td><button class="remove">-</button></td>
                                    </tr>
                   
                                </tbody>
                            </table>
                        </div>
                        <button id="addRow4">+ Add</button>
                        <button id="getValues4">Get Values</button>
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
        if(isset($_POST["submit"])){
       
            $name_project =$_POST['name_project'];
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

            
            $sql2 = "UPDATE `create_project` SET name_project = '".$name_project."', respondsible_department = '".$respondsible_department."'  
            ,principle = '". $principle."',objective = '". $objective."',target_group = '".$target_group."',duration = '".$duration."',
            lecturer = '". $lecturer."',location = '".$location."',benefits = '".$benefits."',cost = '".$cost."',
            working_group = '".$working_group."'  WHERE project_id = '$_GET[project_id]'";
            $result = mysqli_query($conn , $sql2);

        }
        ?>
<!-- $budget = $_POST['budget']; -->
<!-- budget = '".$budget."', -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>
</body>

</html>