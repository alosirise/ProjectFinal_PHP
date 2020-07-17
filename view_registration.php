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
                <h2 style=" padding:30px;">ใบลงทะเบียน</h2>

                <div class="bewcard">
                    <table class="table table-bordered">
                        <thead>
                            <tr id="append">
                                <th scope="col">ลำดับ</th>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
                                <script>
                                    var num_column = localStorage.getItem("num_column");

                                    for (var i = 0; i < num_column; i++) {
                                        var column = localStorage.getItem("column[" + i + "]");
                                        if (column != "undefined") {
                                            var append = '<th scope="col">' + column + '</th>';
                                            $("#append").append(append);
                                        }
                                    }
                                </script>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <tr id="append2">

                                <?php
                                $project_id = $_GET['project_id'];
                                // $project_id = "235";

                                // var_dump($_COOKIE['value_column']);

                                $var_cookie = $_COOKIE['value_column'];
                                $var_cookie = explode(",", $var_cookie);
                                // var_dump($var_cookie);

                                include_once('connect.php');

                                $answer = array();

                                $count_row = 0;

                                //for นี้ใช้แค่เพื่อเก็บจำนวน row ไปเช็คในกรณีที่ ค่าเป็น 1 หรือเว้นว่าง
                                for ($i = 0; $i < count($var_cookie); $i++) {

                                    $sql = "SELECT answer from answer where project_id = $project_id and question = '" . $var_cookie[$i] . "'";
                                    // echo $sql;
                                    $result = mysqli_query($conn, $sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $count_row++;
                                        }
                                        break;
                                    }
                                }

                                for ($i = 0; $i < count($var_cookie); $i++) {

                                    $sql = "SELECT answer from answer where project_id = $project_id and question = '" . $var_cookie[$i] . "'";
                                    // echo $sql;
                                    $result = mysqli_query($conn, $sql);

                                    if ($result->num_rows > 0) {
                                        $j = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $answer[$i][$j] = $row['answer'];
                                            $j++;
                                        }
                                    } else {
                                        for ($j = 0; $j < $count_row; $j++) {
                                            $answer[$i][$j] = "";
                                        }
                                    }
                                }
                                // print_r($answer);

                                for ($i = 0; $i < $count_row; $i++) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . ($i + 1) . '</th>';
                                    for ($j = 0; $j < count($var_cookie); $j++) {
                                        echo '<td>' . $answer[$j][$i] . '</td>';
                                    }
                                    echo '</tr>';
                                }

                                ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </form>
</body>


<script>

</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Compiled and minified JavaScript -->

<script src="index.js"></script>

</html>