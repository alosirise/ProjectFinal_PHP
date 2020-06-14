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
                    <div>         
                        <table>
                            <tbody1>
                                <tr>
                                    <td><input type="text" class ="form-control" name="objective" id="objective"></td>
                                    <td><button class="remove">-</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button id="addRow1">+ Add</button>
                  

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
                            <tbody2>
                                <tr>
                                    <td><input type="text" class ="form-control" name="lecturer" id="lecturer"></td>
                                    <td><button class="remove">-</button></td>
                                </tr>                 
                            </tbody>
                        </table>
                    </div>
                    <button id="addRow2">+ Add</button>
                  

                    <div>
                        <label for="exampleFormControlInput1">สถานที่อบรม</label>
                        <input type="text" class="form-control text" id="location" name="location"></td>
                    </div>

                    <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label>
                    <div>
                        <table>
                            <tbody3>
                                <tr>
                                    <td><input type="text" class ="form-control"  name="benefits" id="benefits"></td>
                                    <td><button class="remove">-</button></td>
                                </tr>
                          
                            </tbody>
                        </table>
                    </div>
                    <button id="addRow3">+ Add</button>
              
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
                            <tbody4>
                                <tr>
                                    <td><input type="text" class ="form-control" name="working_group" id="working_group"></td>
                                    <td><button class="remove">-</button></td>โโ
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

        ?>
        <div class="card-footer text-center">
            <input type="submit" name="submit" class="btn btn-success " value="Submit">
        </div>
    </form>

    <?php
    if (isset($_POST["submit"])) {
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
        $budget = $_POST['budget'];
        $working_group = $_POST['working_group'];


        $sql = "SELECT name_project FROM create_project WHERE name_project='$name_project'";
        $result1 = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result1) > 0) {
            echo '<script>alert("ชื่อของโปรเจคซ้ำกับที่มีอยู่แล้ว โปรดตั้งชื่ออื่น")</script>';
        } else if ($name_project == "") {
            echo '<script>alert("กรุณาตั้งชื่อโปรเจ็ค")</script>';
        } else {
            $sql2 = "INSERT INTO create_project (id,creator ,name_project,respondsible_department,principle,objective,target_group,duration,lecturer,location,benefits,cost,budget,working_group ) 
                VALUES ( '$user_id','$username','$name_project', '$respondsible_department','$principle','$objective','$target_group','$duration','$lecturer','$location','$benefits','$cost','$budget','$working_group')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                echo "<script>alert('ส่งคำร้องขอแล้ว โปรดรอการอนุมัติ');
                window.location='myproject.php';</script>";
            }
        }
    }

    ?>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <script src="index.js"></script>


    <script>
        var html = '<tr><td><input type="text" class ="form-control" name="name"></td><td><button class="remove">-</button></td></tr>';
        // var html = "echo ".'<tr><td><input type='."text".' name='."name".'></td><td><button class='."remove".'>-</button></td></tr>'." ";
        $(function() {
            $("#includedContent").load("table.php");
        });
        $(function() {
            $('tbody').sortable();

            $('#addRow1').click(function() {
                $('tbody1').append(html);
            });
            $('#addRow2').click(function() {
                $('tbody2').append(html);
            });
            $('#addRow3').click(function() {
                $('tbody3').append(html);
            });
            $('#addRow4').click(function() {
                $('tbody4').append(html);
            });


            $(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
            });

            $('#getValues').click(function() {
                var values = [];
                $('input[name="name"]').each(function(i, elem) {
                    values.push($(elem).val());
                });
                alert(values.join(', '));
            });
        });
    </script>
</body>

</html>