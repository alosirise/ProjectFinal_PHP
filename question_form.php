<?php ob_start(); ?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <div class="" id="nav"></div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-4"></div>

            <div class="w3-container col-lg-5 center" style="background-color: white;">
                <!-- <h2 style=" padding:30px;">คำถาม</h2> -->


                <?php
                $project_id = $_GET['project_id'];
                // $project_id = "9";

                $count_question = 0;

                include_once('connect.php');


                $sql5 = "SELECT * from history where username = '" . $_SESSION['username'] . "'  AND project_id = $project_id";
                $result5 = mysqli_query($conn, $sql5);
                if ($result5->num_rows > 0) {
                    echo '<div class="bewcard">
                            <div style="font-size:30px;">คุณได้สมัครเข้าร่วมโครงการนี้แล้ว</div><br>
                            <div>หากต้องการแก้ไขคำตอบให้กดปุ่ม แก้ไขคำตอบ</div>
                        </div>';
                    echo '<div class="w3-container col-lg-3">
                        <button type="submit" class="btn btn-primary" name="changeAnswer">แก้ไขคำตอบ</button>
                    </div>';
                } else {

                    $sql = "SELECT * from question where project_id = $project_id";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            //ใช้ในการนับ data ของ num_radio เพราะใช้ i หรือ y ในลูปนับไม่ได้
                            $x = 0;
                            //ใช้ในการวางตัวเลือกของ radio, checkbox
                            $z = 0;

                            $type_question = array();

                            echo '<div class="bewcard">
                            <div style="font-size:30px;">' . $row['form_name'] . '</div>
                        </div>';

                            $count_will_appendquestion = $row['num_question'];
                            $question_explode = explode(",", $row['question']);
                            $type_explode = explode(",", $row['type']);
                            $num_radio_explode = explode(",", $row['num_radio']);
                            $text_radio_explode = explode(",", $row['text_radio']);

                            for ($i = 0; $i < $count_will_appendquestion; $i++) {
                                echo '<div class="bewcard question' . $i . '">
                                <div>
                                    <label style="margin-bottom:30px;">' . $question_explode[$i] . '</label>
                                </div>';
                                if ($type_explode[$i] == 1) {
                                    echo '<div>
                                        <input class="form-control" name="ans_question' . $i . '" type="text" placeholder="คำตอบของคุณ" required>
                                    </div>';
                                    $type_question[$i] = 1;
                                } else if ($type_explode[$i] == 2) {
                                    echo '<div>
                                    <textarea class="form-control" name="ans_question' . $i . '" type="text" placeholder="คำตอบของคุณ" required ></textarea>
                                </div>';
                                    $type_question[$i] = 2;
                                } else if ($type_explode[$i] == 3) {
                                    for ($y = 0; $y < $num_radio_explode[$x]; $y++, $z++) {
                                        echo '<input type="radio" name="ans_question' . $i . '" value="' . $text_radio_explode[$z] . '" required>
                                        <label>' . $text_radio_explode[$z] . '</label><br>';
                                    }
                                    $x++;
                                    $type_question[$i] = 3;
                                } else if ($type_explode[$i] == 4) {

                                    for ($y = 0; $y < $num_radio_explode[$x]; $y++, $z++) {
                                        echo '<input type="checkbox" id="ans_question-' . $y . '"  name="ans_question' . $i . '[]" value="' . $text_radio_explode[$z] . '" onclick="check()">
                                        <label>' . $text_radio_explode[$z] . '</label><br>';
                                    }

                                    $x++;
                                    $type_question[$i] = 4;
                                }
                                echo '</div>';
                                $count_question++;
                            }
                        }
                    }

                    echo '<div class="w3-container col-lg-2">
                    <button type="submit" class="btn btn-primary" name="sendAnswer">ส่งคำตอบ</button>
                </div>';
                }
                ?>
            </div>
    </form>
    <?php



    if (isset($_POST['sendAnswer'])) {
        // var_dump($type_question);
        // var_dump($_POST['ans_question3']);

        $sql6 = "SELECT * from profile where profile_id = '" . $_SESSION['id'] . "'";
        $result6 = mysqli_query($conn, $sql6);
        if ($result6->num_rows > 0) {
            while ($row = $result6->fetch_assoc()) {
                $firstname_surname = $row['firstname_surname'];
            }
        }
        //firstname คือใส่ชื่อ firstname คนตอบ เอามาจาก $sql6


        $count_checkbox_check = array();
        $username = $_SESSION['username'];

        for ($i = 0; $i < $count_question; $i++) {
            $sql1 = "INSERT INTO answer (project_id,username,question,answer) VALUES ('$project_id','$firstname_surname','$question_explode[$i]','";
            if (gettype($_POST['ans_question' . $i]) == "array") {
                $count_checkbox_check[$i] = count($_POST['ans_question' . $i]);
                for ($y = 0; $y < $count_checkbox_check[$i]; $y++) {
                    $sql1 .= "" . $_POST['ans_question' . $i][$y] . ",";
                }
                $sql1 = rtrim($sql1, ",");
                $sql1 .= "',";
            } else {
                $sql1 .= "" . $_POST['ans_question' . $i] . "',";
            }
            $sql1 = rtrim($sql1, ",");
            $sql1 .= ")";

            $result1 = mysqli_query($conn, $sql1);
            // echo $sql1.'<br>';
        }


        $sql4 = "SELECT name_project from create_project where project_id = $project_id";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4->num_rows > 0) {
            while ($row = $result4->fetch_assoc()) {

                $name_project = $row['name_project'];
            }
        }

        $sql3 = "INSERT INTO history (id,username,project_id,status,name_project) 
        VALUES ( '','$username','$project_id','ดำเนินการ','$name_project')";
        $result3 = mysqli_query($conn, $sql3);

        $sql7 = "INSERT INTO check_payment (id,project_id,status,firstname_surname) VALUES ( '','$project_id','รอยืนยันการชำระเงิน','$firstname_surname')";
        $result7 = mysqli_query($conn, $sql7);



        echo "<script type='text/javascript'>alert('สมัครเข้าร่วมโครงการสำเร็จ');</script>";
        echo "<script>window.location='allproject.php';</script>";
    }

    if (isset($_POST['changeAnswer'])) {
        echo "<script>window.location='edit_answer.php?project_id=$_GET[project_id]';</script>";
    }
    ?>

</body>
<script>
    $cbx_group = $("input:checkbox[id^='ans_question-']");

    $cbx_group.prop('required', true);

    function check() {
        if ($cbx_group.is(":checked")) {
            $cbx_group.prop('required', false);
        }else{
            $cbx_group.prop('required', true);
        }
    }
</script>

</html>


<script src="index.js"></script>