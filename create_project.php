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


    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="jquery.datetimepicker.css">
</head>
<style type="text/css">
    #startDate,
    #endDate {
        text-align: center;
        width: 100px;
    }

    #startTime,
    #endTime {
        text-align: center;
        width: 70px;
    }
</style>

<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="index.js"> </script>

    <div class="" id="nav"></div>
    <form action="" method="POST">
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
                     &nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-xs" id="addRow1" style="cursor: pointer;"> <i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>
                    <div style ="padding-left : 12px; padding-top: 6px;">         
                        <table>  
                                <tr>
                                <td ><input type="text" class ="form-control" name="objective[]" id="objective"></td>
                                <td><a class="remove " >-</td>
                                </tr>      

                        </table><tbody1> </tbody><br>
                      
                    </div>

                    <div>
                        <label for="exampleFormControlInput1">กลุ่มเป้าหมาย</label>
                        <input type="text" class="form-control text" id="target_group" name="target_group"></td>
                    </div>

                    <div>
                        
                        
                    <label for="exampleFormControlInput1">ระยะเวลาในการจัดการโครงการ</label>   
                    <input type="text" class="form-control text" id="duration" name="duration"></td>   
                        <div style ="padding-left : 12px; "> 
                        <table>
                       
                        <br>
                                    <td style="padding-right : 30px;" >เริ่มวันที่ <input type="button" class="form-control" name="startDate" id="startDate" value=""></td>
                                    <td style="padding-right : 70px;">   เวลา  <input type="button" class="form-control "name="startTime" id="startTime" value=""></td>
                                
                                    <td style="padding-right : 30px" >  สิ้นสุดวันที่ &nbsp;&nbsp; <input type="button"  class="form-control" name="endDate" id="endDate" value=""></td> 
                                    <td>   เวลา  <input type="button" class="form-control " name="endTime" id="endTime" value=""> </td>
                             
                                    
                        </table>
                     
                        </div>
                    </div>

                    <label for="exampleFormControlInput1">วิทยากร</label>
                    &nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-xs" id="addRow2" style="cursor: pointer;"> <i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>
                    <div style ="padding-left : 12px; padding-top: 6px;">
                        <table>
                                <tr>
                                    <td><input type="text" class ="form-control" name="lecturer[]" id="lecturer"></td>
                                    <td><a class="remove" >-</td>
                                </tr>                 
                        </table><tbody2> </tbody><br>

                    </div>
                 
                  

                    <div>
                        <label for="exampleFormControlInput1">สถานที่อบรม</label>
                        <input type="text" class="form-control text" id="location" name="location"></td>
                    </div>

                    <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label> &nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-xs" id="addRow3" style="cursor: pointer;"> <i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>
                    <div style ="padding-left : 12px; padding-top: 6px;">   
                        <table>                          
                                <tr>
                                    <td><input type="text" class ="form-control"  name="benefits[]" id="benefits"></td>
                                    <td><a class="remove" >-</td>
                                </tr>
                          
                        </table><tbody3> </tbody><br>
                    </div>
                  
              
                    <div>
                        <label for="exampleFormControlInput1">ค่าลงทะเบียนอบรม</label>
                        <input type="text" class="form-control text" id="cost" name="cost"></td>
                    </div>

                    <div>
                        <label for="exampleFormControlInput1">งบประมาณค่าใช้จ่าย</label>
                        <div id="includedContent" name ="budget"></div>
                    </div>

                    <label for="exampleFormControlInput1">คณะทำงาน</label> &nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-xs" id="addRow4" style="cursor: pointer;"> <i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>
                    <div style ="padding-left : 12px; padding-top: 6px;">   
                        <table>
                                <tr>
                                    <td><input type="text" class ="form-control" name="working_group[]" id="working_group"></td>
                                    <td><a class="remove" >-</td>
                                </tr>
                        </table><tbody4> </tbody><br>
                    </div>
                   
                  
                </div>
            </div>
        </div>
    </div>
    ';
        ?>

        <div class="card-footer text-center">
            <input type="submit" name="submit" class="btn btn-success " value="Submit">
        </div>

    </form>
    <?php
    if (isset($_POST["submit"])) {

        echo '<script> console.log(sessionStorage.getItem("objective"));</script>';
        echo $objective_length = '<script> console.log(sessionStorage.getItem("objective_length"));</script>';

        $objective = $_POST['objective'];
        $lecturer = $_POST['lecturer'];
        $benefits = $_POST['benefits'];
        $working_group = $_POST['working_group'];


        $user_id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $name_project = $_POST['name_project'];
        $respondsible_department = $_POST['respondsible_department'];
        $principle = $_POST['principle'];
        $target_group = $_POST['target_group'];
        $duration = $_POST['duration'];
        $location = $_POST['location'];

        $cost = $_POST['cost'];
        $status = "-";

        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];


        // echo $startDate;
        // echo $endDate;
        // echo $startTime;
        // echo $endTime;

        $sql = "SELECT name_project FROM create_project WHERE name_project='$name_project'";
        $result1 = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result1) > 0) {
            echo '<script>alert("ชื่อของโปรเจคซ้ำกับที่มีอยู่แล้ว โปรดตั้งชื่ออื่น")</script>';
        } else if ($name_project == "") {
            echo '<script>alert("กรุณาตั้งชื่อโปรเจ็ค")</script>';
        } else {
            $datetime = date('Y-m-d H:i:s');

            $sql2 = "INSERT INTO create_project (id,creator ,name_project,respondsible_department,principle,target_group,duration,location,cost,status,last_change) 
                VALUES ( '$user_id','$username','$name_project', '$respondsible_department','$principle','$target_group','$duration','$location','$cost','$status','$datetime')";
            $result2 = mysqli_query($conn, $sql2);

            echo $sql2;

            $project_id;
            $sql_check = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' ";
            $result_check = $conn->query($sql_check);
            while ($row = $result_check->fetch_assoc()) {
                $project_id = $row['project_id'];
            }

            $count = max(count($objective), count($lecturer), count($benefits), count($working_group));
            $sql4 = "INSERT INTO mutiple_text (project_id ,objective,lecturer,benefits,working_group)   VALUES";
            for ($x = 0; $x < $count; $x++) {
                echo " round = ", $x;
                $sql4 .= "('$project_id','" . $_POST['objective'][$x] . "','" . $_POST['lecturer'][$x] . "','" . $_POST['benefits'][$x] . "','" . $_POST['working_group'][$x] . "'),";
            }

            $sql4  = rtrim($sql4, ",");
            $result4 = mysqli_query($conn, $sql4);



            $count_table = max(count($_POST['no']), count($_POST['list']), count($_POST['quantity']), count($_POST['rate']), count($_POST['cost1']));
            $sql5 = "INSERT INTO budget_form (project_id ,no,list,quantity,rate,cost)   VALUES";
            for ($x = 0; $x < $count_table; $x++) {
                echo " round = ", $x;
                $sql5 .= "('$project_id','" . $_POST['no'][$x] . "','" . $_POST['list'][$x] . "','" . $_POST['quantity'][$x] . "','" . $_POST['rate'][$x] . "','" . $_POST['cost1'][$x] . "'),";
            }

            $sql5  = rtrim($sql5, ",");
            $result5 = mysqli_query($conn, $sql5);






            echo "<script>alert('สร้างโครงการแล้ว ขั้นตอนถัดไป กรุณาสร้างแบบฟอร์ม');
                window.location='myproject.php';</script>";
        }
    }
    ?>



    <script type="text/javascript">
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









        $(function() {
            var optsDate = {
                format: 'Y-m-d', // รูปแบบวันที่ 
                formatDate: 'Y-m-d',
                timepicker: false,
                closeOnDateSelect: true,
            }
            var optsTime = {
                format: 'H:i', // รูปแบบเวลา
                step: 30, // step เวลาของนาที แสดงค่าทุก 30 นาที 
                formatTime: 'H:i',
                datepicker: false,
            }
            var setDateFunc = function(ct, obj) {
                var minDateSet = $("#startDate").val();
                var maxDateSet = $("#endDate").val();

                if ($(obj).attr("id") == "startDate") {
                    this.setOptions({
                        minDate: false,
                        maxDate: maxDateSet ? maxDateSet : false
                    })
                }
                if ($(obj).attr("id") == "endDate") {
                    this.setOptions({
                        maxDate: false,
                        minDate: minDateSet ? minDateSet : false
                    })
                }
            }

            var setTimeFunc = function(ct, obj) {
                var minDateSet = $("#startDate").val();
                var maxDateSet = $("#endDate").val();
                var minTimeSet = $("#startTime").val();
                var maxTimeSet = $("#endTime").val();

                if (minDateSet != maxDateSet) {
                    minTimeSet = false;
                    maxTimeSet = false;
                }

                if ($(obj).attr("id") == "startTime") {
                    this.setOptions({
                        defaultDate: minDateSet ? minDateSet : false,
                        minTime: false,
                        maxTime: maxTimeSet ? maxTimeSet : false
                    })
                }
                if ($(obj).attr("id") == "endTime") {
                    this.setOptions({
                        defaultDate: maxDateSet ? maxDateSet : false,
                        maxTime: false,
                        minTime: minTimeSet ? minTimeSet : false
                    })
                }
            }

            $("#startDate,#endDate").datetimepicker($.extend(optsDate, {
                onShow: setDateFunc,
                onSelectDate: setDateFunc,
            }));

            $("#startTime,#endTime").datetimepicker($.extend(optsTime, {
                onShow: setTimeFunc,
                onSelectTime: setTimeFunc,
            }));

        });
    </script>
    <script src="jquery.datetimepicker.full.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</body>

</html>