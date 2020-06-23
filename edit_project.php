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
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 30px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 23px;
            width: 23px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(23px);
            -ms-transform: translateX(23px);
            transform: translateX(19px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="bew.css">
</head>

<body>
    <div class="" id="nav"></div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3"></div>

            <div class="w3-container col-lg-6 center" style="background-color: white;">
                <h2 style=" padding:30px;">จัดการแบบฟอร์ม</h2>
                <div class="bewcard">
                    <input class="form-control" style="font-size:30px;" name="formname" type="text" value="ฟอร์มไม่มีชื่อ">
                </div>

                <div class="bewcard question0">
                    <div id="selected0">
                        <div class="form-row">
                            <div class="col-7">
                                <input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ">
                            </div>
                            <div class="col-5">
                                <select class="form-control" id="selectBox0" onchange="selectClick(id)">
                                    <option value="1">คำตอบสั้นๆ</option>
                                    <option value="2">ย่อหน้า</option>
                                    <option value="3">หลายตัวเลือก</option>
                                    <option value="4">ช่องเครื่องหมาย</option>
                                </select>
                            </div>
                        </div>
                        <div style="margin-top:20px;">
                            <label>ข้อความคำตอบสั้นๆ</label>
                        </div>
                    </div>

                    <hr style="width:100%;text-align:left;margin-left:0">
                    <div style="margin-left:70%">
                        <button type="button" class="btn-primary" onclick="copyQuestion()">คัดลอก</button>

                        <button type="button" class="btn-danger" onclick="delQuestion(0)">ลบ</button>
                        <span>จำเป็น</span>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div id="question">
                </div>
            </div>
            <div style="background-color: white;">
                <button type="button" class="btn-primary" onclick="addQuestion()">เพิ่ม</button>
            </div>
            <div class="w3-container col-lg-3">
            </div>
            <div class="w3-container col-lg-2">
                <button type="submit" class="btn-primary" name="addQ">บันทึก</button>
            </div>
    </form>

    <script>
        var num_question = 0;
        var type = [];
        //ให้อินเด็กแรกเป็นค่า 1 เพราะค่าเป็นเริ่มต้นของ selected
        type[0] = "1";
        console.log(type);

        var numradio = [];
        numradio[0] = "null";
        console.log(numradio);

        document.cookie = 'type=' + type;
        document.cookie = 'addquestion=' + num_question;
        document.cookie = 'numradio=' + numradio.toString();

        function addQuestion() {
            console.log("add queston click");
            //ให้ num_question ไปทำอินเด็กไว้ตอนสร้างเพื่อระบุตอนใช้ฟังก์ชัน delQuestion
            num_question += 1;
            //ให้เมื่อกดเพิ่มคำถาม selected ในอันนั้นๆจะเป็นค่าเริ่มต้นที่ 1
            type[num_question] = "1";
            console.log(type);
            document.cookie = 'type=' + type;

            var question = '<div class="bewcard question' + num_question + '">' +
                '<div id="selected' + num_question + '">' +
                '<div class="form-row">' +
                '<div class="col-7">' +
                '<input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ">' +
                '</div>' +
                '<div class="col-5">' +
                '<select class="form-control" id="selectBox' + num_question + '" onchange="selectClick(id)">' +
                '<option value="1">คำตอบสั้นๆ</option>' +
                '<option value="2">ย่อหน้า</option>' +
                '<option value="3">หลายตัวเลือก</option>' +
                '<option value="4">ช่องเครื่องหมาย</option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div style="margin-top:20px;">' +
                '<label>ข้อความคำตอบสั้นๆ</label>' +
                '</div>' +
                '</div>' +

                '<hr style="width:100%;text-align:left;margin-left:0">' +
                '<div style="margin-left:70%">' +
                '<button style="margin-right:4px" type="button" class="btn-primary">คัดลอก</button>' +
                '<button style="margin-right:4px" type="button" class="btn-danger" onclick="delQuestion(' + num_question + ')">ลบ</button>' +
                '<span>จำเป็น</span>' +
                '<label class="switch">' +
                '<input type="checkbox">' +
                '<span class="slider round"></span>' +
                '</label>' +
                '</div>' +
                '</div>';
            $("#question").append(question);
            console.log("add question = " + num_question);

            numradio[num_question] = "null";
            console.log(numradio);
            document.cookie = 'numradio=' + numradio.toString();
            document.cookie = 'addquestion=' + num_question;
        }


        function delQuestion(num_question) {
            console.log("del question click");
            console.log("del question = " + num_question);
            if (num_question == 0) {
                //if นี้ใช้หั่นคำถามแรก เพราะต้องเป็น 0,1
                // type.splice(num_question,1);
                type.splice(0, 1, "null");
                document.cookie = 'type=' + type;
                console.log(type);
            } else {
                // type.splice(num_question,num_question);
                type.splice(num_question, 1, "null");
                document.cookie = 'type=' + type;
                console.log(type);
            }
            if (num_question == 0) {
                numradio.splice(0, 1, "null");
                document.cookie = 'numradio=' + numradio.toString();
                console.log(numradio);
            } else {
                numradio.splice(num_question, 1, "null");
                document.cookie = 'numradio=' + numradio.toString();
                console.log(numradio);
            }

            $("div").remove(".question" + num_question);



        }



        function selectClick(num_select) {

            console.log(num_select);
            console.log(typeof num_select);

            var selectBox = document.getElementById(num_select);
            console.log(selectBox);
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;

            //บอกค่าว่า select อันไหนไป
            console.log(selectedValue);
            var digitSelect = num_select.charAt(9);

            var select1 = '<div class="form-row">' +
                '<div class="col-7">' +
                '<div>' +
                '<input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ">' +
                '</div>' +
                '</div>' +
                '<div class="col-5">' +
                '<select class="form-control" id="' + num_select + '" onchange="selectClick(id)">' +
                '<option value="1" selected="selected">คำตอบสั้นๆ</option>' +
                '<option value="2">ย่อหน้า</option>' +
                '<option value="3">หลายตัวเลือก</option>' +
                '<option value="4">ช่องเครื่องหมาย</option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div style="margin-top:20px;">' +
                '<label>ข้อความคำตอบสั้นๆ</label>' +
                '</div>';
            var select2 = '<div class="form-row">' +
                '<div class="col-7">' +
                '<div>' +
                '<input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ">' +
                '</div>' +
                '</div>' +
                '<div class="col-5">' +
                '<select class="form-control" id="' + num_select + '" onchange="selectClick(id)">' +
                '<option value="1">คำตอบสั้นๆ</option>' +
                '<option value="2" selected="selected">ย่อหน้า</option>' +
                '<option value="3">หลายตัวเลือก</option>' +
                '<option value="4">ช่องเครื่องหมาย</option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div style="margin-top:20px;">' +
                '<label>ข้อความคำตอบแบบยาว</label>' +
                '</div>';
            var select3 = '<div class="form-row">' +
                '<div class="col-7">' +
                '<div>' +
                '<input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ">' +
                '</div>' +
                '</div>' +
                '<div class="col-5">' +
                '<select class="form-control" id="' + num_select + '" onchange="selectClick(id)">' +
                '<option value="1">คำตอบสั้นๆ</option>' +
                '<option value="2">ย่อหน้า</option>' +
                '<option value="3" selected="selected">หลายตัวเลือก</option>' +
                '<option value="4">ช่องเครื่องหมาย</option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div style="margin-top:20px; margin-left:5px">' +
                '<div class="form-row">' +
                '<div>' +
                '<input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก">' +
                '</div>' +
                '</div>' +
                '<div id="addradio' + digitSelect + '"></div>' +
                '<button type="button" class="btn-primary" onclick="addRadio(' + digitSelect + ')">เพิ่ม</button>' +
                '</div>';
            var select4 = '<div class="form-row">' +
                '<div class="col-7">' +
                '<div>' +
                '<input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ">' +
                '</div>' +
                '</div>' +
                '<div class="col-5">' +
                '<select class="form-control" id="' + num_select + '" onchange="selectClick(id)">' +
                '<option value="1">คำตอบสั้นๆ</option>' +
                '<option value="2">ย่อหน้า</option>' +
                '<option value="3">หลายตัวเลือก</option>' +
                '<option value="4" selected="selected">ช่องเครื่องหมาย</option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div style="margin-top:20px; margin-left:5px">' +
                '<div class="form-row">' +
                '<div>' +
                '<input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก">' +
                '</div>' +
                '</div>' +
                '<div id="addradio' + digitSelect + '"></div>' +
                '<button type="button" class="btn-primary" onclick="addRadio(' + digitSelect + ')">เพิ่ม</button>' +
                '</div>';

            console.log(num_select + " has select " + selectedValue + " | digit selectbox is " + digitSelect);

            if (selectedValue == "1") {
                console.log("select-1");
                $("#selected" + digitSelect).empty();
                $("#selected" + digitSelect).append(select1);
                numradio[digitSelect] = "null";
                console.log(numradio);
                document.cookie = 'numradio=' + numradio.toString();
            } else if (selectedValue == "2") {
                console.log("select-2");
                $("#selected" + digitSelect).empty();
                $("#selected" + digitSelect).append(select2);
                numradio[digitSelect] = "null";
                console.log(numradio);
                document.cookie = 'numradio=' + numradio.toString();
            } else if (selectedValue == "3") {
                console.log("select-3");
                $("#selected" + digitSelect).empty();
                $("#selected" + digitSelect).append(select3);
                numradio[digitSelect] = 1;
                console.log(numradio);
                document.cookie = 'numradio=' + numradio.toString();
            } else if (selectedValue == "4") {
                console.log("select-4");
                $("#selected" + digitSelect).empty();
                $("#selected" + digitSelect).append(select4);
                numradio[digitSelect] = 1;
                console.log(numradio);
                document.cookie = 'numradio=' + numradio.toString();
            }

            type[digitSelect] = selectedValue;
            console.log(type);
            document.cookie = 'type=' + type;
        }



        var num_radio = 0;

        function addRadio(digitSelect) {
            console.log("add radio click");
            console.log("digit " + digitSelect);

            num_radio += 1;
            var addradio = '<div class="form-row radio' + num_radio + '">' +
                '<div>' +
                '<input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก">' +
                '</div>' +
                '<div>' +
                '<button type="button" class="btn-danger" onclick="delRadio(' + num_radio + ',' + digitSelect + ')">ลบ</button>' +
                '</div>' +
                '</div>';

            console.log("addradio" + num_radio);
            $("#addradio" + digitSelect).append(addradio);
            var count_radio_each_question = $("#addradio" + digitSelect + " .form-row").length;
            console.log("Question" + digitSelect + " = " + count_radio_each_question + " radio");

            //ต้องบวก 1 เพราะมี radio อยู่ 1 อันเป็นค่าเริ่มต้น
            true_count_radio = count_radio_each_question + 1;
            numradio[digitSelect] = true_count_radio;
            console.log(numradio);
            document.cookie = 'numradio=' + numradio.toString();
        }

        function delRadio(num_radio, digitSelect) {
            console.log("num radio = " + num_radio);
            console.log("del radio click");
            // ลบแบบ class
            $("div").remove(".radio" + num_radio);
            var count_radio_each_question = $("#addradio" + digitSelect + " .form-row").length;
            console.log("Question" + digitSelect + " = " + count_radio_each_question + " radio");

            numradio[digitSelect]--;
            console.log(numradio);
            document.cookie = 'numradio=' + numradio.toString();
        }
    </script>


    <?php
    if (isset($_POST['addQ'])) {

        //addquestion คือจำนวนที่มีการสร้าง
        $addquestion = $_COOKIE['addquestion'];
        echo " all_question = " . $addquestion;


        $project_id = $_GET['project_id'];
        $formname = $_POST['formname'];


        //count_question คือจำนวนคำถามที่มีอยู่จริงๆ
        $count_question = 0;
        if (empty($_POST['question'])) {
            $count_question = 0;
        } else {
            $count_question = count($_POST['question']);
        }
        echo " true_num_question = " . $count_question;


        var_dump($_COOKIE['type']);
        $type = $_COOKIE['type'];
        //ตัด comma ออกเพราะติดมาตอนใช้ cookie แล้วทำให้ค่ามันเป็น string
        $type = explode(",", $type);


        var_dump($_COOKIE['numradio']);
        $numradio = $_COOKIE['numradio'];
        $numradio = explode(",", $numradio);


        $count_radio = 0;
        if (empty($_POST['text_radio'])) {
            $count_radio = 0;
        } else {
            $count_radio = count($_POST['text_radio']);
        }
        echo "num_radio = " . $count_radio;


        include_once('connect.php');
        $sql2 = "SELECT * from question where project_id = $project_id";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2->num_rows > 0) {
            $sql1 = "UPDATE question SET form_name ='" . $formname . "' WHERE project_id='".$project_id."'";

            $sql2 = "UPDATE question SET num_question ='" . $count_question . "' WHERE project_id='".$project_id."'";

            $sql3 = "UPDATE question SET question ='";
            for ($i = 0; $i < $count_question; $i++) {
                if ($_POST['question'][$i] == "") {
                    $_POST['question'][$i] = "null";
                }
                $sql3 .="".$_POST['question'][$i].",";
            }
            $sql3 = rtrim($sql3, ",");
            $sql3 .= "' WHERE project_id='".$project_id."'";

            $sql4 = "UPDATE question SET type ='";
            for ($i = 0; $i <= $addquestion; $i++) {
                if ($type[$i] != "null") {
                    $sql4 .= "" . $type[$i] . ",";
                }
            }
            $sql4 = rtrim($sql4, ",");
            $sql4 .= "' WHERE project_id='".$project_id."'";

            $sql5 = "UPDATE question SET num_radio ='";
            for ($i = 0; $i <= $addquestion; $i++) {
                if ($numradio[$i] != "null") {
                    $sql5 .= "" . $numradio[$i] . ",";
                }
            }
            $sql5 = rtrim($sql5, ",");
            $sql5 .= "' WHERE project_id='".$project_id."'";

            $sql6 = "UPDATE question SET text_radio ='";
            for ($i = 0; $i < $count_radio; $i++) {
                if ($_POST['text_radio'][$i] == "") {
                    $_POST['text_radio'][$i] = "null";
                }
                $sql6 .= "" . $_POST['text_radio'][$i] . ",";
            }
            $sql6 = rtrim($sql6, ",");
            $sql6 .= "' WHERE project_id='".$project_id."'";
            echo $sql6;

            $result1 = mysqli_query($conn, $sql1);
            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            $result4 = mysqli_query($conn, $sql4);
            $result5 = mysqli_query($conn, $sql5);
            $result6 = mysqli_query($conn, $sql6);

            // while ($row = $result2->fetch_assoc()) {
            //     echo "aaaaaaaaaaaaaaaaaaaaa = ";
            //     echo $row['id'];
            //     echo $row['project_id'];
            //     echo $row['form_name'];
            //     echo $row['num_question'];
            //     echo $row['question'];
            //     echo $row['type'];
            //     echo $row['num_radio'];
            //     echo $row['text_radio'];
            // }

        } else {
            $sql = "INSERT INTO question (project_id,form_name,num_question,question,type,num_radio,text_radio) VALUES ('$project_id','$formname','$count_question','";
            for ($i = 0; $i < $count_question; $i++) {
                if ($_POST['question'][$i] == "") {
                    $_POST['question'][$i] = "null";
                }
                $sql .= "" . $_POST['question'][$i] . ",";
            }
            $sql = rtrim($sql, ",");
            $sql .= "','";
            for ($i = 0; $i <= $addquestion; $i++) {
                if ($type[$i] != "null") {
                    $sql .= "" . $type[$i] . ",";
                }
            }
            $sql = rtrim($sql, ",");
            $sql .= "','";
            for ($i = 0; $i <= $addquestion; $i++) {
                if ($numradio[$i] != "null") {
                    $sql .= "" . $numradio[$i] . ",";
                }
            }
            $sql = rtrim($sql, ",");
            $sql .= "','";
            for ($i = 0; $i < $count_radio; $i++) {
                if ($_POST['text_radio'][$i] == "") {
                    $_POST['text_radio'][$i] = "null";
                }
                $sql .= "" . $_POST['text_radio'][$i] . ",";
            }
            $sql = rtrim($sql, ",");
            $sql .= "')";

            echo $sql;
            $result = mysqli_query($conn, $sql);
        }
        echo "<script>window.location='myproject.php';</script>";
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>
</body>

</html>