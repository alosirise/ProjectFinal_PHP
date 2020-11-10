<?php ob_start();?>
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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />
    <script src="https://kit.fontawesome.com/f7ef8136ea.js" crossorigin="anonymous"></script>
</head>
<style>
    
    table {
    table-layout: fixed;
    width: 100%;   
}
textarea{
   height: 100px;
   width: 98%;
   padding:1%;
   
}
th,td {
    word-wrap: break-word;
}

</style>
<body>
    <div class="" id="nav"></div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3"></div>

            <div class="w3-container col-lg-7 center" style="background-color: white;">
                <h2 style=" padding:30px;">แบบประเมิน</h2>
                <div class="container">
                    <?php

                    $value_php = 1;
                    $project_id = $_GET['project_id'];

                    include_once('connect.php');
                    $sqlselect = "SELECT * from evaluate_form where project_id = $project_id";
                    $resultselect = mysqli_query($conn, $sqlselect);
                    if ($resultselect->num_rows > 0) {
                        while ($row = $resultselect->fetch_assoc()) {

                            $count_will_appendquestion = $row['num_question'];
                            $question_explode = explode(",", $row['question']);

                            echo '<div class="bewcard">
                                    <input class="form-control" style="font-size:30px;" name="evaluate_name" type="text" value="' . $row['evaluate_name'] . '" placeholder="หัวข้อแบบประเมิน">
                                </div>';

                            echo '<table id="table" class="table  table-bordered">
                                <tr>
                                    <td width="75%" rowspan="2" align="center">
                                        <strong>หัวข้อการประเมิน</strong>
                                    </td>
                                    <!-- colspan คือตัวทำให้ ระดับความพึงพอใจบีบออก -->
                                    <td colspan="5" align="center"><strong>ระดับความพึงพอใจ</strong></td>
                                </tr>
                                <tr>
                                    <td width="5%" align="center"><strong>5</strong></td>
                                    <td width="5%" align="center"><strong>4</strong></td>
                                    <td width="5%" align="center"><strong>3</strong></td>
                                    <td width="5%" align="center"><strong>2</strong></td>
                                    <td width="5%" align="center"><strong>1</strong></td>
                                  
                                </tr>';

                            for ($i = 0; $i < $count_will_appendquestion; $i++) {
                                //ถ้าครั้งแรกไม่ต้องมีปุ่มลบ
                                if ($i == 0) {
                                    if ($question_explode[$i] == "null") {
                                        echo '<tr class="q' . ($i + 1) . '">
                                        <td height="30"><input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ"></td>
                                        <td height="30" align="center"><input type="radio" value="5" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="4" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="3" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="2" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="1" disabled /></td>
                                        </tr>';
                                    } else {
                                        echo '<tr class="q' . ($i + 1) . '">
                                        <td height="30"><input class="form-control" name="question[]" type="text" value="' . $question_explode[$i] . '" placeholder="คำถามของคุณ"></td>
                                        <td height="30" align="center"><input type="radio" value="5" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="4" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="3" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="2" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="1" disabled /></td>
                                        </tr>';
                                    }
                                } else {
                                    if ($question_explode[$i] == "null") {
                                        echo '<tr class="q' . ($i + 1) . '">
                                        <td height="30"><input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ"></td>
                                        <td height="30" align="center"><input type="radio" value="5" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="4" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="3" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="2" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="1" disabled /></td>
                                        <td height="30" align="center"><i id="' . ($i + 1) . '" class="fas fa-trash" style="cursor: pointer;" onclick="delQuestion(id)"></td>
                                        </tr>';
                                    } else {
                                        echo '<tr class="q' . ($i + 1) . '">
                                        <td height="30"><input class="form-control" name="question[]" type="text" value="' . $question_explode[$i] . '" placeholder="คำถามของคุณ"></td>
                                        <td height="30" align="center"><input type="radio" value="5" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="4" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="3" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="2" disabled /></td>
                                        <td height="30" align="center"><input type="radio" value="1" disabled /></td>
                                        <td height="30" align="center"><i id="' . ($i + 1) . '" class="fas fa-trash" style="cursor: pointer;" onclick="delQuestion(id)"></td>
                                        </tr>';
                                    }
                                }
                            }

                            echo ' <tr id="question">
                                </tr>
                                        
                                <tr>
                                    <td colspan="6">ข้อเสนอแนะ<br><br>
                                        <textarea rows="3" cols="130" disabled></textarea>
                                    </td>
                                </tr>
                            </table>';
                            $value_php = $count_will_appendquestion;
                        }
                    } else {
                        echo '<div class="bewcard">
                        <input class="form-control" style="font-size:30px;" name="evaluate_name" type="text" value="หัวข้อแบบประเมิน" placeholder="หัวข้อแบบประเมิน">
                    </div>';

                        echo '<table id="table" class="table  table-bordered ">
                    <tr>
                        <td width="75%" rowspan="2"  align="center">
                            <strong>หัวข้อการประเมิน</strong>
                        </td>
                        <!-- colspan คือตัวทำให้ ระดับความพึงพอใจบีบออก -->
                        <td colspan="5" align="center"><strong>ระดับความพึงพอใจ</strong></td>
                    </tr>
                    <tr>
                        <td width="5%" align="center"><strong>5</strong></td>
                        <td width="5%" align="center"><strong>4</strong></td>
                        <td width="5%" align="center"><strong>3</strong></td>
                        <td width="5%" align="center"><strong>2</strong></td>
                        <td width="5%" align="center"><strong>1</strong></td>
                    </tr>
                    <tr class="q1">
                        <td height="30"><input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ"></td>
                        <td height="30" align="center"><input type="radio" value="5" disabled /></td>
                        <td height="30" align="center"><input type="radio" value="4" disabled /></td>
                        <td height="30" align="center"><input type="radio" value="3" disabled /></td>
                        <td height="30" align="center"><input type="radio" value="2" disabled /></td>
                        <td height="30" align="center"><input type="radio" value="1" disabled /></td>
                    </tr>

                    <tr id="question">
                    </tr>

                    <tr>
                        <td colspan="6">ข้อเสนอแนะ<br><br>
                            <textarea rows="3" cols="130" disabled></textarea>
                        </td>
                    </tr>
                    </table>';
                    }


                    ?>


                    <div>
                        <button type="submit" class="btn-primary" name="addQ">บันทึก</button>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <button type="button" class="btn-primary" onclick="addQuestion()">เพิ่ม</button>
            </div>
        </div>
    </form>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src='vfs_fonts.js'></script>


<script>
    var value_php = <?php echo json_encode($value_php); ?>;

    //i คือเอาไว้เป็น id เพื่อ สร้างและลบคำถาม โดยมาจาก value_php =1
    var i = value_php;



    //num_question เอาไว้นับจำนวนคำถาม ต้องใช้แยกกับ i ไม่งั้นจะบัค หรือ จริงๆจะใช้ count(question[]) ก็ได้
    var num_question = 1;
    //ทำการให้ค่า cookie เลย เพื่อในกรณีที่ไม่ได้เปลี่ยนแปลงอะไรและกดบันทึกจะได้ไม่บัค
    document.cookie = 'num_eval_question=' + num_question;

    function addQuestion() {
        console.log("add click");
        i++;
        num_question++;
        var question = '<tr class="q' + i + '">' +
            '<td height="30"><input class="form-control" name="question[]" type="text" placeholder="คำถามของคุณ"></td>' +
            '<td height="30" align="center"><input type="radio" value="5" disabled/></td>' +
            '<td height="30" align="center"><input type="radio" value="4" disabled/></td>' +
            '<td height="30" align="center"><input type="radio" value="3" disabled/></td>' +
            '<td height="30" align="center"><input type="radio" value="2" disabled/></td>' +
            '<td height="30" align="center"><input type="radio" value="1" disabled/></td>' +
            '<td height="30" align="center"><i id="' + i + '" class="fas fa-trash" style="cursor: pointer;" onclick="delQuestion(id)"></td>' +
            '</tr>';
        //tr: last + .before คือใส่ก่อน tr สุดท้าย
        $("#table tr:last").before(question);

        document.cookie = 'num_eval_question=' + num_question;
    }

    function delQuestion(i) {
        console.log("del click");
        num_question--;
        $("tr").remove(".q" + i);

        document.cookie = 'num_eval_question=' + num_question;
    }
</script>

<?php
if (isset($_POST['addQ'])) {

    $evaluate_name = $_POST['evaluate_name'];
    $num_eval_question = $_COOKIE['num_eval_question'];

    include_once('connect.php');
    $sql = "SELECT * from evaluate_form where project_id = $project_id";
    $result = mysqli_query($conn, $sql);



    if ($result->num_rows > 0) {

        $sql3 = "UPDATE evaluate_form SET evaluate_name ='" . $evaluate_name . "' WHERE project_id='" . $project_id . "'";

        $sql4 = "UPDATE evaluate_form SET question ='";
        for ($i = 0; $i < count($_POST['question']); $i++) {
            if ($_POST['question'][$i] == null) {
                $sql4 .= "null,";
            } else {
                $sql4 .= "" . $_POST['question'][$i] . ",";
            }
        }
        $sql4 = rtrim($sql4, ",");
        $sql4 .= "' WHERE project_id='" . $project_id . "'";

        $sql5 = "UPDATE evaluate_form SET num_question ='" . count($_POST['question']) . "' WHERE project_id='" . $project_id . "'";

        $result3 = mysqli_query($conn, $sql3);
        $result4 = mysqli_query($conn, $sql4);
        $result5 = mysqli_query($conn, $sql5);




        
        if ($_SESSION['go'] == "go_project") {
            echo "<script>alert('บันทึกสำเร็จ');
            window.location='myproject.php';</script>";
        } else if ($_SESSION['go'] == "go_request") {
            echo "<script>alert('บันทึกสำเร็จ');
            window.location='request.php';</script>";
        }
    } else {
        $sql2 = "INSERT INTO evaluate_form (project_id,evaluate_name,num_question,question) VALUES ('$project_id','$evaluate_name','$num_eval_question','";

        for ($i = 0; $i < $num_eval_question; $i++) {
            if ($_POST['question'][$i] == null) {
                $sql2 .= "null,";
            } else {
                $sql2 .= "" . $_POST['question'][$i] . ",";
            }
        }
        $sql2 = rtrim($sql2, ",");
        $sql2 .= "')";
        // echo $sql2;
        $result2 = mysqli_query($conn, $sql2);




        if ($_SESSION['go'] == "go_project") {
            echo "<script>alert('สร้างแบบประเมินสำเร็จ');
            window.location='myproject.php';</script>";
        } else if ($_SESSION['go'] == "go_request") {
            echo "<script>alert('บันทึกสำเร็จ');
            window.location='request.php';</script>";
        }
    }
}
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Compiled and minified JavaScript -->

<script src="index.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

</html>