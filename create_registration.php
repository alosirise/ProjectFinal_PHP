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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="bew.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" />
</head>

<body>
    <div class="" id="nav"></div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3"></div>
            <div class="w3-container col-lg-6 center" style="background-color: white;">
                <h2 style=" padding:30px;">สร้างใบลงทะเบียน</h2>

                <div class="bewcard">
                    <div>

                        <div class="form-row">
                            <label class="col-7" style="margin-left:20px; font-size:20px">
                                ชื่อหัวข้อ
                            </label>
                            <label class="col-4" style="margin-left:20px; font-size:20px">
                                ข้อมูล
                            </label>
                            <div class="col-7" style="margin-bottom:20px">
                                <input type="text" class="form-control" name="column[]">
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="value_column[]">
                                    <option value="1" selected="selected">เว้นว่าง</option>

                                    <?php
                                    // $project_id = $_GET['project_id'];
                                    $project_id = "235";
                                    include_once('connect.php');

                                    $count_question = 0;
                                    $question_explode = "";

                                    $sql = "SELECT * from question where project_id = $project_id";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {

                                            $count_question = $row['num_question'];
                                            $question_explode = explode(",", $row['question']);
                                        }
                                    }
                                    for ($i = 0; $i < $count_question; $i++) {
                                        echo '<option value="'. $question_explode[$i] .'">' . $question_explode[$i] . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-1" style="margin-top:2px">
                                <!-- <button type="button" class="btn-danger" onclick="delColumn()">ลบ</button> -->
                            </div>

                        </div>
                    </div>

                    <div id="append_col">
                    </div>
                </div>


            </div>
            <div style="background-color: white;">
                <button type="button" class="btn-primary" onclick="addColumn()">เพิ่ม</button>
            </div>
            <div class="w3-container col-lg-3">
            </div>
            <div class="w3-container">
                <button type="submit" class="btn-primary" name="">สร้าง</button>
            </div>
        </div>

    </form>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
<script>
    num_column = 1;
    function addColumn() {
        console.log("addColumn Click")
        var column = '<div class="form-row regist'+num_column+'">' +
            '<div class="col-7" style="margin-bottom:20px">' +
            '<input type="text" class="form-control" name="column[]">' +
            '</div>' +
            '<div class="col-4">' +
            '<select class="form-control">' +
            '<option value="1" selected="selected">เว้นว่าง</option>' +
            <?php
            for ($i = 0; $i < $count_question; $i++) {
                echo "'" . '<option value="'. $question_explode[$i] .'">' . $question_explode[$i] . '</option>' . "'+";
            }
            ?> '</select>' +
            '</div>' +
            '<div class="col-1" style="margin-top:2px">' +
            '<button type="button" class="btn-danger" onclick="delColumn('+num_column+')">ลบ</button>' +
            '</div>' +
            '</div>' +
            '</div>';
        $("#append_col").append(column);
        num_column++;
    }

    function delColumn(num_del) {
        console.log("delColumn Click")
        $("div").remove(".regist" + num_del);
    }
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Compiled and minified JavaScript -->

<script src="index.js"></script>

</html>