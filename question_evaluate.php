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

    textarea {
        height: 100px;
        width: 98%;
        padding: 1%;

    }

    th,
    td {
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

                    $project_id = 302;
                    // $project_id = $_GET['project_id'];


                    include_once('connect.php');

                    $sql2 = "SELECT * from answer_evaluate where username = '" . $_SESSION['username'] . "'  AND project_id = $project_id";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($result2->num_rows > 0) {
                        echo '<div class="bewcard">
                                    <div style="font-size:30px;">คุณได้ตอบแบบประเมินนี้แล้ว</div><br>
                            </div>';
                        echo '<div class="w3-container col-lg-2">
                            <button type="submit" class="btn-primary" name="back">กลับ</button>
                        </div>';
                    }else{

                        $sqlselect = "SELECT * from evaluate_form where project_id = $project_id";
                        $resultselect = mysqli_query($conn, $sqlselect);
                        if ($resultselect->num_rows > 0) {
                            while ($row = $resultselect->fetch_assoc()) {

                                $count_will_appendquestion = $row['num_question'];
                                $question_explode = explode(",", $row['question']);

                                echo '<div class="bewcard">
                                        <div style="font-size:30px;" name="evaluate_name">' . $row['evaluate_name'] . '</div>
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
                                    echo '<tr>
                                    <td height="30">' . ($i + 1) . '. ' . $question_explode[$i] . '</td>
                                    <td height="30" align="center"><input name="score' . $i . '" type="radio" value="5" ></td>
                                    <td height="30" align="center"><input name="score' . $i . '" type="radio" value="4" ></td>
                                    <td height="30" align="center"><input name="score' . $i . '" type="radio" value="3" ></td>
                                    <td height="30" align="center"><input name="score' . $i . '" type="radio" value="2" ></td>
                                    <td height="30" align="center"><input name="score' . $i . '" type="radio" value="1" ></td>
                                    </tr>';
                                }
                                echo '<tr>
                                        <td colspan="6">ข้อเสนอแนะ<br><br>
                                            <textarea rows="3" cols="130" name="suggestion" required></textarea>
                                        </td>
                                        </tr>
                                    </table>';
                            }
                        }
                        
                        echo '<div>
                            <button type="submit" class="btn-primary" name="sendAnswer">ส่งคำตอบ</button>
                        </div>';
                        
                    }
                    ?>

                </div>
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

<?php
if (isset($_POST['sendAnswer'])) {

    $username = $_SESSION['username'];
    $suggestion = $_POST['suggestion'];

    $sql = "INSERT INTO answer_evaluate (project_id,username,suggestion,answer) VALUES ('$project_id','$username','$suggestion','";

    for ($i = 0; $i < $count_will_appendquestion; $i++) {
        $sql .= "" . $_POST['score' . $i] . ",";
    }
    $sql = rtrim($sql, ",");
    $sql .= "')";

    // echo $sql.'<br>';
    $result = mysqli_query($conn, $sql);

    echo "<script type='text/javascript'>alert('ตอบแบบประเมินเรียบร้อย');</script>";
    echo "<script>window.location='history.php';</script>";
}

if (isset($_POST['back'])) {
    echo "<script>window.location='history.php';</script>";
}
?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Compiled and minified JavaScript -->

<script src="index.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

</html>