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
                                <script>
                                    var cookie_value_column = [];
                                    var count_index = 0;
                                    for (var i = 0; i < num_column; i++) {

                                        var value_column = localStorage.getItem("value_column[" + i + "]");

                                        if (value_column != "undefined") {
                                            if (value_column == "1") {
                                                var append2 = '<td>test select 1</td>';
                                                $("#append2").append(append2);
                                            }
                                            cookie_value_column[count_index] = localStorage.getItem("value_column[" + i + "]");
                                            count_index++;

                                        }
                                    }
                                    document.cookie = 'value_column=' + cookie_value_column;
                                </script>
                                <?php
                                // $project_id = $_GET['project_id'];
                                $project_id = "235";

                                var_dump($_COOKIE['value_column']);

                                $test = $_COOKIE['value_column'];
                                $test = explode(",", $test);
                                var_dump($test);

                                // include_once('connect.php');

                                // $sql = "SELECT answer from answer where project_id = $project_id and question = $test[0]";
                                // echo $sql;
                                // $result = mysqli_query($conn, $sql);
                                // if ($result->num_rows > 0) {

                                // }

                                // if ($result->num_rows > 0) {
                                //     while ($row = $result->fetch_assoc()) {
                                //         echo '<td>' . $row['answer'] . '</td>';
                                //     }
                                // }

                                ?>
                                <!-- <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td> -->
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div style="background-color: white;">
                <button type="button" class="btn-primary" onclick="addColumn()">เพิ่ม</button>
            </div>
            <div class="w3-container col-lg-3">
            </div>
            <div class="w3-container">
                <button type="button" class="btn-primary" onclick="createRegist()">สร้าง</button>
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