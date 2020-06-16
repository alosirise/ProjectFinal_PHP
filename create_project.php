<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin") {
    header('location: home.php');
    exit();
}
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="index.js"> </script>

    <div class="" id="nav"></div>
    <form action="" method="POST" onsubmit="return save()">
        <?php

        include_once('connect.php');

        echo ' 
        <div class="row">
        <div class="col-lg-3"></div>
        <div class="w3-container col-lg-6 center">
            <h2 style=" padding :45px;">สร้างโครงการ</h2>
            <div class="card">
                <div class="card-body">
                    <div>
                        <label for="exampleFormControlInput1">ชื่อโครงการ</label>
                        <input type="text" class="form-control text" id="name_project" name="name_project"></td>
                    </div>
                    <div>
                        <label for="exampleFormControlInput1">หน่วยงานที่รับผิดชอบ</label>
                        <input type="text" class="form-control text" id="respondsible_department" name="respondsible_department"></td>
                    </div>
                    <div>
                        <label for="exampleFormControlInput1">หลักการและเหตุผล</label>
                        <textarea class="form-control text" id="principle" name="principle" rows="3"></textarea>
                    </div>
                    
                    <label for="exampleFormControlInput1">วัตถุประสงค์</label>
                    <div>         
                        <table>  
                                <tr>
                                <td ><input type="text" class ="form-control" name="objective[]" id="objective"></td>
                                <td><a class="remove " >-</td>
                                </tr>      

                        </table><tbody1> </tbody><br>
                        <a class="btn btn-primary pull-left " id="addRow1" style="cursor: pointer;"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a><br><br>
                    </div>

                    <div>
                        <label for="exampleFormControlInput1">กลุ่มเป้าหมาย</label>
                        <input type="text" class="form-control text" id="target_group" name="target_group"></td>
                    </div>

                    <div>
                        <label for="exampleFormControlInput1">ระยะเวลาในการจัดการโครงการ</label>
                        <input type="text" class="form-control text" id="duration" name="duration"></td>
                    </div>

                    <label for="exampleFormControlInput1">วิทยากร</label>
                    <div>
                        <table>
                                <tr>
                                    <td><input type="text" class ="form-control" name="lecturer[]" id="lecturer"></td>
                                    <td><a class="remove" >-</td>
                                </tr>                 
                        </table><tbody2> </tbody><br>
                        <a class="btn btn-primary pull-left" id="addRow2" style="cursor: pointer;"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a><br><br>
                    </div>
                 
                  

                    <div>
                        <label for="exampleFormControlInput1">สถานที่อบรม</label>
                        <input type="text" class="form-control text" id="location" name="location"></td>
                    </div>

                    <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label>
                    <div>
                        <table>                          
                                <tr>
                                    <td><input type="text" class ="form-control"  name="benefits[]" id="benefits"></td>
                                    <td><a class="remove" >-</td>
                                </tr>
                          
                        </table><tbody3> </tbody><br>
                        <a class="btn btn-primary pull-left" id="addRow3" style="cursor: pointer;"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a><br><br>
                    </div>
                  
              
                    <div>
                        <label for="exampleFormControlInput1">ค่าลงทะเบียนอบรม</label>
                        <input type="text" class="form-control text" id="cost" name="cost"></td>
                    </div>

                    <div>
                        <label for="exampleFormControlInput1">งบประมาณค่าใช้จ่าย</label>
                        <div id="includedContent" name ="budget"></div>
                    </div>

                    <label for="exampleFormControlInput1">คณะทำงาน</label>
                    <div>
                        <table>
                                <tr>
                                    <td><input type="text" class ="form-control" name="working_group" id="working_group"></td>
                                    <td><a class="remove" >-</td>
                                </tr>
                        </table><tbody4> </tbody><br>
                        <a class="btn btn-primary pull-left" id="addRow4" style="cursor: pointer;"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a><br><br>
                    </div>
                   
                  
                </div>
            </div>
        </div>
    </div>
    ';
        ?>

        <script>
            function save() {
                var objective = $("input[name='objective[]']")
                    .map(function() {
                        return $(this).val();
                    }).get();


                sessionStorage.setItem("objective_length", objective.length);
                sessionStorage.setItem("objective", JSON.stringify(objective));
                console.log(sessionStorage.getItem("objective"));
                console.log("object_length : ", objective.length);




                var lecturer = $("input[name='lecturer[]']")
                    .map(function() {
                        return $(this).val();
                    }).get();

                sessionStorage.setItem("lecturer", JSON.stringify(lecturer));
                console.log(sessionStorage.getItem("lecturer"));



                var benefits = $("input[name='benefits[]']")
                    .map(function() {
                        return $(this).val();
                    }).get();

                sessionStorage.setItem("benefits", JSON.stringify(benefits));
                console.log(sessionStorage.getItem("benefits"));



                var working_group = $("input[name='working_group[]']")
                    .map(function() {
                        return $(this).val();
                    }).get();

                sessionStorage.setItem("working_group", JSON.stringify(working_group));
                console.log(sessionStorage.getItem("working_group"));
            }
        </script>
        <div class="card-footer text-center">
            <input type="submit" name="submit" class="btn btn-success " value="Submit">
        </div>

    </form>
    <?php
    if (isset($_POST["submit"])) {


        echo '<script> console.log(sessionStorage.getItem("objective"));</script>';
         echo $objective_length = '<script> console.log(sessionStorage.getItem("objective_length"));</script>';

        echo $objective_length = '<script> parseInt(sessionStorage.getItem("objective_length"), 10);</script>';
        
        for ($x = 0; $x < $objective_length ; $x++) {echo "wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww",$x;
        //     $sql4 = "INSERT INTO mutiple_text (objective,lecturer,benefits,working_group) 
        // VALUES ( '$objective[$x]','$lecturer[$x]','$benefits[$x]','$working_group[$x]')";
        //     $result4 = mysqli_query($conn, $sql4);
        }

        $user_id = $_SESSION['id'];
        $username = $_SESSION['username'];
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
        $budget = 'sss';
        $working_group = $_POST['working_group'];

        $sql = "SELECT name_project FROM create_project WHERE name_project='$name_project'";
        $result1 = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result1) > 0) {
            echo '<script>alert("ชื่อของโปรเจคซ้ำกับที่มีอยู่แล้ว โปรดตั้งชื่ออื่น")</script>';
        } else if ($name_project == "") {
            echo '<script>alert("กรุณาตั้งชื่อโปรเจ็ค")</script>';
        } else {

            $sql2 = "INSERT INTO create_project (id,creator ,name_project,respondsible_department,principle,target_group,duration,location,cost,budget) 
                VALUES ( '$user_id','$username','$name_project', '$respondsible_department','$principle','$target_group','$duration','$location','$cost','$budget')";
            $result2 = mysqli_query($conn, $sql2);



            $sql3 = "INSERT INTO budget_form (no,list,quantity,rate,cost) 
                 VALUES ( '$no','$list','$quantity','$rate','$cost_budget')";
            $result3 = mysqli_query($conn, $sql3);



            if ($result2) {
                echo "<script>alert('ส่งคำร้องขอแล้ว โปรดรอการอนุมัติ');
                window.location='myproject.php';</script>";
            }
        }
    }
    ?>



    <script>
        var objective_replace = '<tr><td style ="width = 25%;"><input type="text" class ="form-control" name="objective[]" id="objective"></td><td><a class="remove" >-</td></tr>';
        var lecturer_replace = '<tr><td><input type="text" class ="form-control" name="lecturer[]" id="lecturer"></td><td><a class="remove" >-</td></tr>';
        var benefits_replace = '<tr> <td><input type="text" class ="form-control"  name="benefits[]" id="benefits"></td><td><a class="remove" >-</td></tr>';
        var working_group_replace = '<tr><td><input type="text" class ="form-control" name="working_group[]" id="working_group"></td><td><a class="remove" >-</td></tr>';

        $(function() {
            $("#includedContent").load("table_create.php");
        });

        $(function() {
            $('tbody').sortable();

            $('#addRow1').click(function() {
                $('tbody1').before(objective_replace);
            });
            $('#addRow2').click(function() {
                $('tbody2').before(lecturer_replace);
            });
            $('#addRow3').click(function() {
                $('tbody3').before(benefits_replace);
            });
            $('#addRow4').click(function() {
                $('tbody4').before(working_group_replace);
            });


            $(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
            });
        });
    </script>
</body>

</html>