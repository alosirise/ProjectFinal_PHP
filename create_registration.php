<?php ob_start();?>
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
                                <input type="text" class="form-control" name="column[0]">
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="value_column[0]">
                                    <option value="1" selected="selected">เว้นว่าง</option>

                                    <?php
                                    $project_id = $_GET['project_id'];
                                    // $project_id = "235";
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
                                        echo '<option value="' . $question_explode[$i] . '">' . $question_explode[$i] . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                         

                        </div>
                    </div>

                    <div id="append_col">
                    </div>
                </div>


            </div>
            <div style="padding: 30px 0px 0px 0px;">
                <button type="button" class="btn btn-primary" onclick="addColumn()">เพิ่ม</button>
            </div>
            <div class="w3-container col-lg-3">
            </div>
            <div class="w3-container">
                <button type="button" class="btn btn-success" onclick="createRegist()">สร้าง</button>
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
        var column = '<div class="form-row regist' + num_column + '">' +
            '<div class="col-7" style="margin-bottom:20px">' +
            '<input type="text" class="form-control" name="column[' + num_column + ']">' +
            '</div>' +
            '<div class="col-4">' +
            '<select class="form-control" name="value_column[' + num_column + ']">' +
            '<option value="1" selected="selected">เว้นว่าง</option>' +
            <?php
            for ($i = 0; $i < $count_question; $i++) {
                echo "'" . '<option value="' . $question_explode[$i] . '">' . $question_explode[$i] . '</option>' . "'+";
            }
            ?> '</select>' +
            '</div>' +
            '<div class="col-1" style="margin-top:2px">' +
            '<button type="button" class="btn btn-danger btn-sm" onclick="delColumn(' + num_column + ')">ลบ</button>' +
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

    function createRegist() {
        console.log("createRegist")

        localStorage.clear();
        localStorage.setItem("num_column", num_column);

        for (var i = 0; i < num_column; i++) {
            localStorage.setItem("column[" + i + "]", $("input[name='column[" + i + "]']").val());

            //ข้างล่างไว้ check console เฉยๆ
            var testval1 = localStorage.getItem("column[" + i + "]");
            console.log(i + " = " + testval1);

        }
        var check = [];
        for (var i = 0; i < num_column; i++) {
            localStorage.setItem("value_column[" + i + "]", $("select[name='value_column[" + i + "]']").val());

            //ข้างล่างไว้ check console เฉยๆ
            var testval2 = localStorage.getItem("value_column[" + i + "]");
            console.log(i + " = " + testval2);

            //เก็บค่าเข้าตัวแปร check เพื่อไปใช้ในตอน check อีกที
            check[i] = testval2;
        }


        var num_column_2 = localStorage.getItem("num_column");

        var cookie_value_column = [];
        var count_index = 0;
        for (var i = 0; i < num_column_2; i++) {

            var value_column = localStorage.getItem("value_column[" + i + "]");

            if (value_column != "undefined") {
                if (value_column == "1") {
                    var append2 = '<td>test select 1</td>';
                    // $("#append2").append(append2);
                }
                cookie_value_column[count_index] = localStorage.getItem("value_column[" + i + "]");
                count_index++;

            }
        }
        //เช็คกรณีที่มีแต่ 1 ใน value ข้างหลัง
        var check_result = false;
        for (var i = 0; i < num_column; i++) {
            if (!(check[i] == 1 || check[i] == "undefined")) {
                check_result = true; break;
            }
        }
        if(check_result == true){
            document.cookie = 'value_column=' + cookie_value_column;
            <?php
            echo "window.location='view_registration.php?project_id=$project_id';"
            ?>
        }else{
            alert("ต้องมีข้อมูลอย่างน้อย 1 ช่อง");
        }
        
    }
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Compiled and minified JavaScript -->

<script src="index.js"></script>

</html>