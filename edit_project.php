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

    <link rel="stylesheet" href="form.css">
</head>


<body>
    <div class="" id="nav"></div>

    <form action="" id="pdf" method="POST">

        <div class="row ">
            <div class="col-lg-3 "></div>
            <div class="w3-container col-lg-6 center">
                <h2 style=" padding :45px;">แก้ไขโครงการ</h2>

                <div class="card">
                    <div class="card-body" style="width:90%;">

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
          
                        <div>
                            <label for="exampleFormControlInput1">ชื่อโครงการ</label>  <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'name_project\')"></i>
                            <input type="text" class="form-control text" id=edit_name_project name="name_project"  readonly value="' . $row["name_project"] . '"></td>
                        </div>
                        <div>
                            <label for="exampleFormControlInput1">หน่วยงานที่รับผิดชอบ</label>  <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'respond\')"></i>
                            <input type="text" class="form-control text" id=edit_respond name="respondsible_department" readonly  value="' . $row["respondsible_department"] . '"></td>
                        </div>
                        <div><label for="exampleFormControlInput1">หลักการและเหตุผล</label>  <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'principle\')"></i>
                            <textarea class="form-control text" id=edit_principle name="principle" readonly rows="5" > ' . $row["principle"] . '</textarea>
                        </div><br>
                        
                       
                        <label >วัตถุประสงค์</label>   <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'objective\')"></i>
                        &nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-xs" id="addRow1" style="cursor: pointer;"> <i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>
                        <div style ="padding-left : 12px; padding-top: 6px;">     
                            <table>';

                                foreach ($result_mutiple_text as $value) {
                                    if ($value["objective"] != "") {
                                        echo        '            
                            <tr>
                            <td><input type="text" class ="form-control" name="objective[]" readonly id=edit_objective value="' . $value["objective"] . '"></td>
                            <td><a class="remove" >-</td>
                            </tr>';
                                    }
                                }

                                echo  '</table>
                            <tbody1></tbody><br>
                         
                        </div>
                        

                        <div>
                        <label for="exampleFormControlInput1">กลุ่มเป้าหมาย</label> <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'target_group\')"></i>
                            <input type="text" class="form-control text" readonly id=edit_target_group name="target_group"   value="' . $row["target_group"] . '"></td>
                        </div>
    
                        <label for="exampleFormControlInput1">ระยะเวลาในการจัดการโครงการ</label>   
                    <div style ="padding-left : 12px;"> 
                    <table>  
                    <tr>
                        <td style="padding-right : 30px;><div id="pickup_date"><p><label class="form">เริ่มวันที่ : </label><input type="date" class="form-control" id="pick_date" name="pickup_date" value="' . $row["startDate"] . '" onchange="cal()"</p></div></td>
                        <td ><div id="dropoff_date"><p><label class="form">สิ้นสุดวันที่ : </label><input type="date" class="form-control" id="drop_date" name="dropoff_date" value="' . $row["endDate"] . '" onchange="cal()"/></p></div></td>
                       
                        </tr><tr>
                        <td ><div id="numdays"><p><label class="form">รวมทั้งหมด (วัน) : </label><input type="text" class="form-control" id="numdays2" name="numdays" 
                        value="' . $row["numdays"] . '" readonly /></p></div><td>
                        </tr>
                    </table>  
                      
                    </div>
    


                        <label for="exampleFormControlInput1">วิทยากร</label> <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'lecturer\')"></i>
                        &nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-xs" id="addRow2" style="cursor: pointer;"> <i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>
                        <div style ="padding-left : 12px; padding-top: 6px;">   
                            <table>';

                                foreach ($result_mutiple_text as $value) {
                                    if ($value["lecturer"] != "") {
                                        echo        '      
                               
                                    <tr>
                                    <td><input type="text" class ="form-control" name="lecturer[]" readonly  id=edit_lecturer value="' . $value["lecturer"] . '"></td>
                                    <td><a class="remove" >-</td>
                                    </tr>';
                                    }
                                }


                                echo  '                 
                                
                            </table> <tbody2></tbody><br>
                          
                        </div>
                      
    
                        <div>
                            <label for="exampleFormControlInput1">สถานที่อบรม</label> <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'location\')"></i>
                            <input type="text" class="form-control text" readonly id=edit_location name="location"   value="' . $row["location"] . '"></td>
                        </div>
    
                        <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label>  <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'benefits\')"></i>
                        &nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-xs" id="addRow3" style="cursor: pointer;"> <i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>
                        <div style ="padding-left : 12px; padding-top: 6px;">   
                            <table> ';

                                foreach ($result_mutiple_text as $value) {
                                    if ($value["benefits"] != "") {
                                        echo        '                    
                                    <tr>
                                    <td><input type="text" class ="form-control"  readonly name="benefits[]" id=edit_benefits value="' . $value["benefits"] . '"></td>
                                    <td><a class="remove" >-</td>
                                    </tr>';
                                    }
                                }


                                echo  '            

                            </table><tbody3></tbody><br>   
                        
                        </div>
                     
                  
                        <div>
                            <label for="exampleFormControlInput1">ค่าลงทะเบียนอบรม (บาท)</label>  <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'cost\')"></i>
                            <input type="text" class="form-control text" id=edit_cost name="cost"  readonly  value="' . $row["cost"] . '"></td>
                        </div>
    
                        <div>
                            <label for="exampleFormControlInput1">งบประมาณค่าใช้จ่าย</label>
                            <div id="includedContent" name ="budget"></div>
                        </div>
    
                        <label for="exampleFormControlInput1">คณะทำงาน</label>  <i class="glyphicon glyphicon-edit" style="cursor: pointer;" onclick="edit(\'working_group\')"></i>
                        &nbsp;&nbsp;&nbsp;<a class="btn btn-info btn-xs" id="addRow4" style="cursor: pointer;"> <i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>
                        <div style ="padding-left : 12px; padding-top: 6px;">   
                            <table>';

                                foreach ($result_mutiple_text as $value) {
                                    if ($value["working_group"] != "") {
                                        echo '               
                                    <tr>
                                    <td><input type="text" class ="form-control" readonly name="working_group[]" id=edit_working_group value="' . $value["working_group"] . '"></td>
                                    <td><a class="remove" >-</td>
                                    </tr>';
                                    }
                                }

                                echo  '            
                            </table> <tbody4></tbody><br>
                            
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
                            <input type="submit" name="submit" class="btn btn-success " value="บันทึก">
                        </div>

    </form>
    <div id ="elementH"></div>
    <center><button onclick="toPDF();">Convert to pdf</button></center>
    <?php

    if (isset($_POST["submit"])) {

        $name_project = $_POST['name_project'];
        $respondsible_department = $_POST['respondsible_department'];
        $principle = $_POST['principle'];
        $target_group = $_POST['target_group'];
        $duration = $_POST['duration'];
        $location = $_POST['location'];
        $cost = $_POST['cost'];

        $pickup_date = $_POST['pickup_date'];
        $dropoff_date = $_POST['dropoff_date'];
        $numdays = $_POST['numdays'];


        $sql2 = "UPDATE `create_project` SET name_project = '" . $name_project . "', respondsible_department = '" . $respondsible_department . "'  
                    ,principle = '" . $principle . "',target_group = '" . $target_group . "',duration = '" . $duration . "',
                    location = '" . $location . "',cost = '" . $cost . "',startDate = '" . $pickup_date . "',
                    endDate = '" .  $dropoff_date . "',numdays = '" . $numdays . "'   WHERE project_id = '$_GET[project_id]'";
        $result = mysqli_query($conn, $sql2);


        $objective = $_POST['objective'];
        $lecturer = $_POST['lecturer'];
        $benefits = $_POST['benefits'];
        $working_group = $_POST['working_group'];

        $count = max(count($objective), count($lecturer), count($benefits), count($working_group));


        $sql5 = "DELETE FROM mutiple_text
                    WHERE project_id = '$_GET[project_id]'";
        $result5 = mysqli_query($conn, $sql5);


        $sql4 = "INSERT INTO mutiple_text (project_id ,objective,lecturer,benefits,working_group)   VALUES";
        for ($x = 0; $x < $count; $x++) {
            echo " round = ", $x;
            $sql4 .= "('" . $_GET['project_id'] . "','" . $_POST['objective'][$x] . "','" . $_POST['lecturer'][$x] . "','" . $_POST['benefits'][$x] . "','" . $_POST['working_group'][$x] . "'),";
        }

        $sql4  = rtrim($sql4, ",");
        $result4 = mysqli_query($conn, $sql4);


        $sql6 = "DELETE FROM budget_form
                WHERE project_id = '$_GET[project_id]'";
        $result6 = mysqli_query($conn, $sql6);

        // print_r($_POST['no']);
        // print_r($_POST['list']);
        // print_r($_POST['quantity']);
        // print_r($_POST['rate']);
        // print_r($_POST['cost1']);

        $count_table = max(count($_POST['no']), count($_POST['list']), count($_POST['quantity']), count($_POST['rate']), count($_POST['cost1']));
        $sql7 = "INSERT INTO budget_form (project_id,no,list,quantity,rate,cost)   VALUES";
        for ($x = 0; $x < $count_table; $x++) {
            echo " round = ", $x;
            $sql7 .= "('" . $_GET['project_id'] . "','" . $_POST['no'][$x] . "','" . $_POST['list'][$x] . "','" . $_POST['quantity'][$x] . "','" . $_POST['rate'][$x] . "','" . $_POST['cost1'][$x] . "'),";
        }

        $sql7  = rtrim($sql7, ",");
        $result7 = mysqli_query($conn, $sql7);


        if ($_SESSION['go'] == "go_project") {
            echo "<script>window.location='myproject.php';</script>";
        } else if ($_SESSION['go'] == "go_request") {
            echo "<script>window.location='request.php';</script>";
        }
    }
    ?>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

   <script src="jsPDF/dist/jspdf.customfonts.min.js"></script>

    <script src="index.js"> </script>
    <script>
        var objective_replace = '<tr><td style ="width = 25%;"><input type="text" class ="form-control" name="objective[]" id=edit_objective></td><td><a class="remove" >-</td></tr>';
        var lecturer_replace = '<tr><td><input type="text" class ="form-control" name="lecturer[]" id=edit_lecturer></td><td><a class="remove" >-</td></tr>';
        var benefits_replace = '<tr> <td><input type="text" class ="form-control"  name="benefits[]" id=edit_benefits></td><td><a class="remove" >-</td></tr>';
        var working_group_replace = '<tr><td><input type="text" class ="form-control" name="working_group[]" id=edit_working_group></td><td><a class="remove" >-</td></tr>';

        $(function() {
            $("#includedContent").load("table_edit.php");
        });

        function edit(type) {
            if ($('input[id=edit_' + type + '], textarea[id=edit_' + type + ']').is('[readonly]')) {

                $('input[id=edit_' + type + '], textarea[id=edit_' + type + ']').attr('readonly', false);
                // console.log("table id " +table_id);
            } else {

                $('input[id=edit_' + type + '], textarea[id=edit_' + type + ']').attr('readonly', true);
            }
        }
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


        function toPDF(){
            var doc = new jsPDF();
            var elementHTML = $('#pdf').html();
            var specialElementHandlers = {'#elementH' : function(element,renderer){
                    return true;    
                }
            };

            doc.fromHTML(elementHTML,15,15,{
                'width' : 170, 
                'elementHandlers' : specialElementHandlers
            });

            doc.save('sample-document.pdf');
        }



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



 
</body>

</html>