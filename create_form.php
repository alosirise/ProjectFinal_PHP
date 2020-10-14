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

<script>
var num_question = 0;
</script>
<?php
    $value_php = 0;

    $project_id = $_GET['project_id'];

    include_once('connect.php');
    $sqlselect = "SELECT * from question where project_id = $project_id";
    $resultselect = mysqli_query($conn, $sqlselect);


    $update_type = array();
    //กำหนดค่าเริ่มต้น
    $update_type[0] = "1";

    $update_numradio = array();
    //กำหนดค่าเริ่มต้น
    $update_numradio[0] = "null";

    $max_value_numradio = 0;


    if($resultselect->num_rows > 0){
        while ($row = $resultselect->fetch_assoc()) {
            echo '<div class="bewcard">
                        <input class="form-control" style="font-size:30px;" name="formname" type="text" value="'.$row['form_name'].'" placeholder="ชื่อแบบฟอร์ม">
                </div>';

            $count_will_appendquestion = $row['num_question'];
            $question_explode = explode (",",$row['question']);
            $type_explode = explode (",",$row['type']);
            $num_radio_explode = explode (",",$row['num_radio']);
            $text_radio_explode = explode (",",$row['text_radio']);

            //ใช้กำหนด index ตอนวาง num_radio
            $z = 0;
            //ใช้กำหนด index ตอนวาง text_radio
            $x = 0;
            //ใช้กำหนด index เพิ่มขึ้นเรื่อยๆของ addradio
            $c = 0;


            for($i =0;$i< $count_will_appendquestion;$i++){
                echo '<div class="bewcard question'.$i.'">
                <div id="selected'.$i.'">
                <div class="form-row">
                    <div class="col-7">';
                        if($question_explode[$i] == "null"){
                            echo '<input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ">';
                        }else{
                            echo '<input class="form-control" name="question[]" type="text" value="'.$question_explode[$i].'" placeholder="คำถามของคุณ">';
                        }
                    echo '</div>
                    <div class="col-5">
                        <select class="form-control" id="selectBox'.$i.'" onchange="selectClick(id)">';
                        if($type_explode[$i]==1){
                            echo '<option value="1" selected="selected">คำตอบสั้นๆ</option>
                            <option value="2">ย่อหน้า</option>
                            <option value="3">หลายตัวเลือก</option>
                            <option value="4">ช่องเครื่องหมาย</option>
                            </select>
                            </div>
                            </div>
                            <div style="margin-top:20px;">
                                <label>ข้อความคำตอบสั้นๆ</label>
                            </div>
                            </div>';
                            $update_type[$i] = "1";

                            //ใส่่ 0 ให้เพื่อมีค่าไว้จะได้ไม่ undefined index
                            $update_numradio[$i] = 0;
                        }else if($type_explode[$i]==2){
                            echo '<option value="1">คำตอบสั้นๆ</option>
                            <option value="2" selected="selected">ย่อหน้า</option>
                            <option value="3">หลายตัวเลือก</option>
                            <option value="4">ช่องเครื่องหมาย</option>
                            </select>
                            </div>
                            </div>
                            <div style="margin-top:20px;">
                                <label>ข้อความคำตอบสั้นๆ</label>
                            </div>
                            </div>';
                            $update_type[$i] = "2";

                            //ใส่่ 0 ให้เพื่อมีค่าไว้จะได้ไม่ undefined index
                            $update_numradio[$i] = 0;
                        }else if($type_explode[$i]==3){
                            echo '<option value="1">คำตอบสั้นๆ</option>
                            <option value="2">ย่อหน้า</option> 
                            <option value="3" selected="selected">หลายตัวเลือก</option>
                            <option value="4">ช่องเครื่องหมาย</option>
                            </select>
                            </div>
                            </div>
                            <div style="margin-top:20px; margin-left:5px">
                            <div class="form-row">';
                            if($text_radio_explode[$x] == "null"){
                                echo '<div><img src="images/radio-off-512.png" width="42" height="42"></div><div><input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก"></div>';
                            }else{
                                echo '<div><img src="images/radio-off-512.png" width="42" height="42"></div><div><input name="text_radio[]" class="form-control" type="text" value="'.$text_radio_explode[$x].'" placeholder="ตัวเลือก"></div>';
                            }
                            //ถ้าเข้า select 3-4 จะมี radio 1 อันเริ่มต้นเลยต้องให้ = 1
                            $update_numradio[$i] = 1;
                            $x++;
                            echo '</div>
                            <div id="addradio'.$i.'"">';
                                for($y=0; $y < (int)($num_radio_explode[$z]-1); $y++){
                                    echo '<div class="form-row radio'.$c.'">';
                                    
                                    if($text_radio_explode[$x] == "null"){
                                        echo '<div><img src="images/radio-off-512.png" width="42" height="42"></div><div><input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก"></div>';
                                    }else{
                                        echo '<div><img src="images/radio-off-512.png" width="42" height="42"></div><div><input name="text_radio[]" class="form-control" type="text" value="'.$text_radio_explode[$x].'" placeholder="ตัวเลือก"></div>';
                                    }
                                    echo '
                                        <div>
                                            <button type="button" class="btn-danger" onclick="delRadio('.$c.','.$i.')">ลบ</button>
                                        </div>
                                    </div>';
                                    $x++;

                                    //y+2 เพราะมีสร้างอันแรกไว้นอกลูปอยู่แล้ว และบวกอีก 1 เพราะค่าเริ่มต้นของ y เป็น 0 พอจะใช้นับเลยต้องบวกอีก 1
                                    $update_numradio[$i] = ($y+2);
                                    $c++;
                                }
                                $z++;
                                echo '</div>
                                        <button type="button" class="btn-primary" onclick="addRadio('.$i.',1)">เพิ่ม</button>
                                    </div>
                                </div>';
                            $update_type[$i] = "3";
                        }else if($type_explode[$i]==4){
                            echo '<option value="1">คำตอบสั้นๆ</option>
                            <option value="2">ย่อหน้า</option>
                            <option value="3">หลายตัวเลือก</option>
                            <option value="4" selected="selected">ช่องเครื่องหมาย</option>
                            </select>
                            </div>
                            </div>
                            <div style="margin-top:20px; margin-left:5px">
                            <div class="form-row">';
                            if($text_radio_explode[$x] == "null"){
                                echo '<div><img src="images/square_blank_check_empty-512.png" width="42" height="42"></div><div><input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก"></div>';
                            }else{
                                echo '<div><img src="images/square_blank_check_empty-512.png" width="42" height="42"></div><div><input name="text_radio[]" class="form-control" type="text" value="'.$text_radio_explode[$x].'" placeholder="ตัวเลือก"></div>';
                            }
                            //ถ้าเข้า select 3-4 จะมี radio 1 อันเริ่มต้นเลยต้องให้ = 1
                            $update_numradio[$i] = 1;
                            $x++;
                            echo '</div>
                            <div id="addradio'.$i.'"">';
                                for($y=0; $y < (int)($num_radio_explode[$z]-1); $y++){
                                    echo '<div class="form-row radio'.$c.'">';
                                    if($text_radio_explode[$x] == "null"){
                                        echo '<div><img src="images/square_blank_check_empty-512.png" width="42" height="42"></div><div><input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก"></div>';
                                    }else{
                                        echo '<div><img src="images/square_blank_check_empty-512.png" width="42" height="42"></div><div><input name="text_radio[]" class="form-control" type="text" value="'.$text_radio_explode[$x].'" placeholder="ตัวเลือก"></div>';
                                    }
                                    echo '<div>
                                            <button type="button" class="btn-danger" onclick="delRadio('.$c.','.$i.')">ลบ</button>
                                        </div>
                                    </div>';
                                    $x++;

                                    //y+2 เพราะมีสร้างอันแรกไว้นอกลูปอยู่แล้ว และบวกอีก 1 เพราะค่าเริ่มต้นของ y เป็น 0 พอจะใช้นับเลยต้องบวกอีก 1
                                    $update_numradio[$i] = ($y+2);
                                    $c++;
                                }
                                $z++;

                                echo '</div>
                                        <button type="button" class="btn-primary" onclick="addRadio('.$i.',2)">เพิ่ม</button>
                                    </div>
                                </div>';
                            $update_type[$i] = "4";   
                        }
                 
                echo '<hr style="width:100%;">
                <div style="margin-left:95%">
                    <button type="button" class="btn-danger" onclick="delQuestion('.$i.')">ลบ</button>
                </div>
                </div>';
            $value_php = $i;
            }

        //แก้บัคเรื่องหลังจากดึงข้อมูลมา function ทำงานผิดเพราะเวลากด add ชื่อตัวแปรเริ่ม 1 ใหม่ แต่ตอนวางมัน 3-4 ไปแล้ว
         echo '<div id="question">
            </div>';
        }
        //หาค่าที่มากที่สุดไปตั้งชื่อ index จะได้ไม่ซ้ำกัน
        $max_value_numradio = max($update_numradio);
    }else{
        echo '<div class="bewcard">
        <input class="form-control" style="font-size:30px;" name="formname" type="text" value="ฟอร์มไม่มีชื่อ" placeholder="ชื่อแบบฟอร์ม">
    </div>
    <div class="bewcard question0">
        <div id="selected0">
            <div class="form-row">
                <div class="col-7">
                    <input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ">
                </div>
                <div class="col-5">
                    <select class="form-control" id="selectBox0" onchange="selectClick(id)">
                        <option value="1" selected="selected">คำตอบสั้นๆ</option>
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
        <hr style="width:100%;">
        <div style="margin-left:95%">
            <button type="button" class="btn-danger" onclick="delQuestion(0)">ลบ</button>
        </div>
    </div>
    <div id="question">
    </div>';
    }

?>

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
        var type = [];
        //ให้อินเด็กแรกเป็นค่า 1 เพราะค่าเป็นเริ่มต้นของ selected
        type[0] = "1";
        console.log(type);

        var numradio = [];
        numradio[0] = "null";
        console.log(numradio);


        var value_php = <?php echo json_encode($value_php); ?>;
        console.log("value php = "+value_php);
        //ปรับค่า num_question ให้ตามค่าที่ดึงจาก DTB มาก่อนเพื่อตอนวางจะได้เรียงตาม index
        num_question = value_php;
        console.log("numquestion = "+num_question);


        var update_type = <?php echo json_encode($update_type); ?>;
        console.log("update_type = "+update_type);
        type = update_type;


        var update_numradio = <?php echo json_encode($update_numradio); ?>;
        console.log("update_numradio = "+update_numradio);
        numradio = update_numradio;


        var max_value_numradio = <?php echo json_encode($max_value_numradio); ?>;
        console.log("max_value_numradio = "+max_value_numradio);


        document.cookie = 'type=' + type;
        document.cookie = 'addquestion=' + num_question;
        document.cookie = 'numradio=' + numradio.toString();

        

        function addQuestion() {
            console.log("add queston click");

            //ให้ num_question ไปทำอินเด็กไว้ตอนสร้างเพื่อระบุตอนใช้ฟังก์ชัน delQuestion
            num_question+=1;

            //ให้เมื่อกดเพิ่มคำถาม selected ในอันนั้นๆจะเป็นค่าเริ่มต้นที่ 1
            type[num_question] = "1";
            console.log("type");
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
                '<hr style="width:100%">' +
                '<div style="margin-left:95%">' +
                '<button style="margin-right:4px" type="button" class="btn-danger" onclick="delQuestion(' + num_question + ')">ลบ</button>' +
                '</div>' +
                '</div>';
            $("#question").append(question);
            console.log("add question = " + num_question);

            numradio[num_question] = "null";
            console.log("numradio");
            console.log(numradio);
            document.cookie = 'numradio=' + numradio.toString();
            document.cookie = 'addquestion=' + num_question;
            console.log("numquestion = "+num_question);
        }


        function delQuestion(num_question) {
            console.log("del question click");
            console.log("del question = " + num_question);
            if (num_question == 0) {
                //if นี้ใช้หั่นคำถามแรก เพราะต้องเป็น 0,1
                type.splice(0, 1, "null");
                document.cookie = 'type=' + type;
                console.log(type);
            } else {
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
            //เป็นส่วนลบคำถามโดยลบ div
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
                '<div><img src="images/radio-off-512.png" width="42" height="42"></div>'+
                '<div>' +
                '<input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก">' +
                '</div>' +
                '</div>' +
                '<div id="addradio' + digitSelect + '"></div>' +
                //ใน parameter ใหมี 1 ไว้เพื่อเช็คตอนวาง icon
                '<button type="button" class="btn-primary" onclick="addRadio(' + digitSelect + ',1)">เพิ่ม</button>' +
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
                '<div><img src="images/square_blank_check_empty-512.png" width="42" height="42"></div>'+
                '<div>' +
                '<input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก">' +
                '</div>' +
                '</div>' +
                //ใน parameter ใหมี 2 ไว้เพื่อเช็คตอนวาง icon
                '<div id="addradio' + digitSelect + '"></div>' +
                '<button type="button" class="btn-primary" onclick="addRadio(' + digitSelect + ',2)">เพิ่ม</button>' +
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


        //ต้องเป็นค่ามากที่สุดเพราะ เดี๋ยวชื่อซ้ำกับอันที่ดึงมาจาก DTB
        var num_radio = max_value_numradio;

        function addRadio(digitSelect,checkIcon) {
            console.log("add radio click");
            console.log("digit " + digitSelect);
            console.log("icon " + checkIcon);
            console.log("num_radio = " + num_radio);
            num_radio += 1;

            var addradio1 = '<div class="form-row radio' + num_radio + '">' +
                '<div><img src="images/radio-off-512.png" width="42" height="42"></div>'+
                '<div>' +
                '<input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก">' +
                '</div>' +
                '<div>' +
                '<button type="button" class="btn-danger" onclick="delRadio(' + num_radio + ',' + digitSelect + ')">ลบ</button>' +
                '</div>' +
                '</div>';

            var addradio2 = '<div class="form-row radio' + num_radio + '">' +
                '<div><img src="images/square_blank_check_empty-512.png" width="42" height="42"></div>'+
                '<div>' +
                '<input name="text_radio[]" class="form-control" type="text" placeholder="ตัวเลือก">' +
                '</div>' +
                '<div>' +
                '<button type="button" class="btn-danger" onclick="delRadio(' + num_radio + ',' + digitSelect + ')">ลบ</button>' +
                '</div>' +
                '</div>';

            console.log("addradio" + num_radio);
            if(checkIcon == "1"){
                $("#addradio" + digitSelect).append(addradio1);
            }else if(checkIcon == "2"){
                $("#addradio" + digitSelect).append(addradio2);
            }

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

            $formname = $_POST['formname'];

            //addquestion คือจำนวนที่มีการสร้าง
            $addquestion = $_COOKIE['addquestion'];
<<<<<<< Updated upstream
            echo " all_question = " . $addquestion;
=======
            // echo " all_question = " . $addquestion;
>>>>>>> Stashed changes
    
    
            //count_question คือจำนวนคำถามที่มีอยู่จริงๆ
            $count_question = 0;
            if (empty($_POST['question'])) {
                $count_question = 0;
            } else {
                $count_question = count($_POST['question']);
            }
<<<<<<< Updated upstream
            echo " true_num_question = " . $count_question;
    
    
            var_dump($_COOKIE['type']);
=======
            // echo " true_num_question = " . $count_question;
    
    
            // var_dump($_COOKIE['type']);
>>>>>>> Stashed changes
            $type = $_COOKIE['type'];
            //ตัด comma ออกเพราะติดมาตอนใช้ cookie แล้วทำให้ค่ามันเป็น string
            $type = explode(",", $type);
    
    
<<<<<<< Updated upstream
            var_dump($_COOKIE['numradio']);
=======
            // var_dump($_COOKIE['numradio']);
>>>>>>> Stashed changes
            $numradio = $_COOKIE['numradio'];
            $numradio = explode(",", $numradio);
    
    
            $count_radio = 0;
            if (empty($_POST['text_radio'])) {
                $count_radio = 0;
            } else {
                $count_radio = count($_POST['text_radio']);
            }
<<<<<<< Updated upstream
            echo "num_radio = " . $count_radio;
=======
            // echo "num_radio = " . $count_radio;
>>>>>>> Stashed changes

            
            include_once('connect.php');
            $sql2 = "SELECT * from question where project_id = $project_id";
            $result2 = mysqli_query($conn, $sql2);


        if ($result2->num_rows > 0) {

            
            //ต้องกำหนดค่าก่อนตอนจะทำการ update ว่ามีการวาง(ดึงจาก dtb) ไปแล้วกี่อันจากนั้นต้องทำงานต่อให้ได้(เพิ่มทีหลัง)


            $sql1 = "UPDATE question SET form_name ='" . $formname . "' WHERE project_id='" . $project_id . "'";

            $sql2 = "UPDATE question SET num_question ='" . $count_question . "' WHERE project_id='" . $project_id . "'";

            $sql3 = "UPDATE question SET question ='";
            for ($i = 0; $i < $count_question; $i++) {
                if ($_POST['question'][$i] == "") {
                    $_POST['question'][$i] = "null";
                }
                $sql3 .= "" . $_POST['question'][$i] . ",";
            }
            $sql3 = rtrim($sql3, ",");
            $sql3 .= "' WHERE project_id='" . $project_id . "'";



            $sql4 = "UPDATE question SET type ='";
            for ($i = 0; $i <= $addquestion; $i++) {
                if ($type[$i] != "null") {
                    $sql4 .= "" . $type[$i] . ",";
                }
            }
            $sql4 = rtrim($sql4, ",");
            $sql4 .= "' WHERE project_id='" . $project_id . "'";



            $sql5 = "UPDATE question SET num_radio ='";
            for ($i = 0; $i <= $addquestion; $i++) {
<<<<<<< Updated upstream
                echo "round = ".$i;
=======
                // echo "round = ".$i;
>>>>>>> Stashed changes
                if ($numradio[$i] != "0" && $numradio[$i] != "null") {
                    $sql5 .= "" . $numradio[$i] . ",";
                }
            }
            $sql5 = rtrim($sql5, ",");
            $sql5 .= "' WHERE project_id='" . $project_id . "'";



            $sql6 = "UPDATE question SET text_radio ='";
            for ($i = 0; $i < $count_radio; $i++) {
                if ($_POST['text_radio'][$i] == "") {
                    $_POST['text_radio'][$i] = "null";
                }
                $sql6 .= "" . $_POST['text_radio'][$i] . ",";
            }
            $sql6 = rtrim($sql6, ",");
            $sql6 .= "' WHERE project_id='" . $project_id . "'";

<<<<<<< Updated upstream
            echo $sql1." | ";
            echo $sql2." | ";
            echo $sql3." | ";
            echo $sql4." | ";
            echo $sql5." | ";
            echo $sql6;
=======
            // echo $sql1." | ";
            // echo $sql2." | ";
            // echo $sql3." | ";
            // echo $sql4." | ";
            // echo $sql5." | ";
            // echo $sql6;
>>>>>>> Stashed changes


            $result1 = mysqli_query($conn, $sql1);
            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            $result4 = mysqli_query($conn, $sql4);
            $result5 = mysqli_query($conn, $sql5);
            $result6 = mysqli_query($conn, $sql6);

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

<<<<<<< Updated upstream
            echo $sql;
            $result = mysqli_query($conn, $sql);
        }
        if($_SESSION['go'] == "go_project" ){
        echo "<script>window.location='myproject.php';</script>";
=======
            // echo $sql;
            $result = mysqli_query($conn, $sql);
        }
        if($_SESSION['go'] == "go_project" ){
            echo "<script>window.location='myproject.php';</script>";
>>>>>>> Stashed changes
        
        }else if($_SESSION['go'] == "go_request" ){
            echo "<script>window.location='request.php';</script>";
        }

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