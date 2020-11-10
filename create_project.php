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

</head>


<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   

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
                <div class="card-body" style="width:90%;">
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
                    <br>
                   
                    <label for="exampleFormControlInput1">ระยะเวลาในการจัดการโครงการ</label>   
                    <div style ="padding-left : 12px;"> 
                    <table>  
                    <tr>
                        <td style="padding-right : 30px;><div id="pickup_date"><p><label class="form">เริ่มวันที่ : </label><input type="date" class="form-control" id="pick_date" name="pickup_date" onchange="cal()"</p></div></td>
                        <td ><div id="dropoff_date"><p><label class="form">สิ้นสุดวันที่ : </label><input type="date" class="form-control" id="drop_date" name="dropoff_date" onchange="cal()"/></p></div></td>
                       
                        </tr><tr>
                        <td ><div id="numdays"><p><label class="form">รวมทั้งหมด (วัน) : </label><input type="text" class="form-control" id="numdays2" name="numdays" readonly/></p></div><td>
                        </tr>
                    </table>  
                      
                    </div>
                    <br>
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
                        <label for="exampleFormControlInput1">ค่าลงทะเบียนอบรม (บาท)</label>
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
                                    <td ><input type="text" class ="form-control" name="working_group[]" id="working_group"></td>
                                    ';

        $sql3 = "SELECT working_group FROM name_coc";
        $result3 = $conn->query($sql3);
        ?>

        <!-- <td style="padding-left :15px;"><select id="selectBox" name="selectBox[]" style="width :110px; height: 30px; ">
                <?php
                // echo '<script>var array = [];</script>';
                // while ($row3 = $result3->fetch_assoc()) { {
                //         echo '<option value="' . $row3["working_group"] . '">' . $row3["working_group"] . '</option>';
                //         echo "<script>array.push('$row3[working_group]')</script>";
                //     }
                // }
                // echo "<script>console.log(array);</script>";
                ?>
            </select></td> -->



        <?php

        echo '<td><a class="remove" >-</td></tr></table><tbody4> </tbody><br></div>
                   
                  
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
        $location = $_POST['location'];

        $cost = $_POST['cost'];
        $status = "-";

        $pickup_date = $_POST['pickup_date'];
        $dropoff_date = $_POST['dropoff_date'];
        $numdays = $_POST['numdays'];

        // echo $startTime;
        // echo $endTime;

        $sql = "SELECT name_project FROM create_project WHERE name_project='$name_project'";
        $result1 = mysqli_query($conn, $sql);

        if ($numdays < 0) {
            echo '<script>alert("โปรดตรวจสอบ ระยะเวลาในการทำโปรเจคอีกครั้ง ")</script>';
            // } else if (mysqli_num_rows($result1) > 0) {
            //     echo '<script>alert("ชื่อของโปรเจคซ้ำกับที่มีอยู่แล้ว โปรดตั้งชื่ออื่น")</script>';
        } else if ($name_project == "") {
            echo '<script>alert("กรุณาตั้งชื่อโปรเจ็ค")</script>';
        } else {
            $datetime = date('Y-m-d H:i:s');

            $sql2 = "INSERT INTO create_project (id,creator ,name_project,respondsible_department,principle,target_group,location,cost,status,last_change,startDate,endDate,numdays,result_budget) 
                VALUES ( '$user_id','$username','$name_project', '$respondsible_department','$principle','$target_group','$location','$cost','$status','$datetime','$pickup_date','$dropoff_date','$numdays','" . $_POST['result'] . "')";
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
            $sql5 = "INSERT INTO budget_form (project_id ,no,list,quantity,rate,cost,title)   VALUES";
            for ($x = 0; $x < $count_table; $x++) {
                echo " round = ", $x;
                $sql5 .= "('$project_id','" . $_POST['no'][$x] . "','" . $_POST['list'][$x] . "','" . $_POST['quantity'][$x] . "','" . $_POST['rate'][$x] . "','" . $_POST['cost1'][$x] . "','" . $_POST['title'][$x] . "'),";
            }

            $sql5  = rtrim($sql5, ",");
            $result5 = mysqli_query($conn, $sql5);




            echo "<script>alert('สร้างโครงการแล้ว ขั้นตอนถัดไป กรุณาสร้างแบบฟอร์ม');
                window.location='myproject.php';</script>";
        }
    }
    ?>



    <script type="text/javascript">
        //  $('select[name="selectBox[]"]').on('change', function() {
        //             alert(this.value);
        //                 $('input[name="working_group[]"]').val(this.value);

        //         });



        var objective_replace = '<tr><td style ="width = 25%;"><input type="text" class ="form-control" name="objective[]" id="objective"></td><td><a class="remove" >-</td></tr>';
        var lecturer_replace = '<tr><td><input type="text" class ="form-control" name="lecturer[]" id="lecturer"></td><td><a class="remove" >-</td></tr>';
        var benefits_replace = '<tr> <td><input type="text" class ="form-control"  name="benefits[]" id="benefits"></td><td><a class="remove" >-</td></tr>';


        var working_group_replace = '<tr><td ><input type="text" class ="form-control" name="working_group[]" id="working_group"></td>;';
        var working_group_replace2 = '<td style="padding-left :15px;"><select id="selectBox" name="selectBox[]"  style="width :110px; height: 30px; ">';

        var working_group_replace4 = '<td><a class="remove" >-</td></tr>';

        var c_row4 = 0;
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

                // var working_group_replace3 = '';
                // var arrayLength = array.length;
                // for (var i in array) {
                //     console.log(array[i]);
                //     working_group_replace3 = working_group_replace3 + '<option value=' + array[i] + '>' + array[i] + '</option>'
                // }
                // console.log(working_group_replace3);

                $('tbody4').before(working_group_replace + working_group_replace4);


            });


            $(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
            });



        });
    </script>

    <script type="text/javascript">
        function GetDays() {
            var dropdt = new Date(document.getElementById("drop_date").value);
            var pickdt = new Date(document.getElementById("pick_date").value);
            return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
        }

        function cal() {
            if (document.getElementById("drop_date")) {
                document.getElementById("numdays2").value = GetDays();
            }
        }

    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</body>

</html>