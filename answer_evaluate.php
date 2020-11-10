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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script> 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>   -->

</head>
<!-- <script>
    $(document).ready(function() {
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        console.log(activeTab);
        if (activeTab) {
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });
</script> -->
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
                <h2 style=" padding:30px;">คำตอบแบบประเมิน</h2>
                <div class="container">
                    <?php

                    $value_php = 1;
                    // $project_id = 302;
                    $project_id = $_GET['project_id'];

                    include_once('connect.php');
                    $sqlanswer = "SELECT * from answer_evaluate where project_id = $project_id";
                    $resultanswer = mysqli_query($conn, $sqlanswer);

                    //นับคำถาม
                    $num_question;

                    $sql = "SELECT * from evaluate_form where project_id = $project_id";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $evaluate_name = $row['evaluate_name'];
                            $num_question = $row['num_question'];
                            $question_explode = explode(",", $row['question']);
                        }
                    }
                    // var_dump($question_explode);

                    $score = array();
                    $username = array();
                    $count = 0;
                    if ($resultanswer->num_rows > 0) {
                        while ($row = $resultanswer->fetch_assoc()) {
                            $username[$count] = $row['username'];
                            $count++;

                            $answer_explode = explode(",", $row['answer']);
                            $score = array_merge($score, $answer_explode);
                        }
                    }
                    // var_dump($score);
                    //var_dump($username);


                    echo '<ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li> <a href="#list1" class="active nav-link" role="tab" data-toggle="tab">
                                <icon class="fas fa-chart-area"></icon> ข้อมูลกราฟ
                            </a>
                        </li>
                        <li> <a href="#list2" class="nav-link" role="tab" data-toggle="tab">
                                <icon class="fas fa-table"></icon> ข้อมูลตาราง
                            </a>
                        </li>
                      
                    </ul>
                    <br><br>
                    <div class="tab-content">
                        <div class="tab-pane fade active show " id="list1">
                            <div id="columnchart_material" style="width: 1000px; height: 500px;"></div>
                        </div>
                        <div class="tab-pane fade" id="list2">
                            <div>';
                    echo '<table class="table table-bordered" id="table">
                            <thead>
                                <tr class="w3-blue-gray">
                                    <th >ชื่อผู้ใช้</th>';
                    for ($i = 0; $i < $num_question; $i++) {
                        echo '<th>' . $question_explode[$i] . '</th>';
                    }
                    echo '</tr>
                            </thead>
                            <tbody>';

                    //ให้ k ไหลไปเรื่อยๆเพื่อวางคำตอบ eval
                    $k = 0;
                    for ($i = 0; $i < count($username); $i++) {
                        echo '<tr>';
                        echo '<td>' . $username[$i] . '</td>';
                        for ($j = 0; $j < $num_question; $j++, $k++) {
                            echo '<td>' . $score[$k] . '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>
                            </table>
                            </div>
                        </div>
                    </div>';


                    ?>

                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                            var php_question = <?php echo json_encode($question_explode); ?>;
                            var php_num_question = <?php echo json_encode($num_question); ?>;
                            var php_answer = <?php echo json_encode($score); ?>;
                            var php_evaluate_name = <?php echo json_encode($evaluate_name); ?>;

                            // console.log(php_answer);

                            var graph = [];

                            var zero_index = [];
                            var one_index = [];
                            var two_index = [];
                            var three_index = [];
                            var four_index = [];


                            //ให้ค่านี้นับเพิ่มเรื่อยๆ
                            var count_away = 0
                            for (var i = 0; i < php_num_question; i++) {


                                for (var j = 0; j < php_num_question; j++, count_away++) {

                                    switch (php_answer[count_away]) {
                                        case "5":
                                            if (zero_index[j] != undefined && zero_index[j] >= 1) {
                                                zero_index[j]++;
                                            } else {
                                                zero_index[j] = 1;
                                            }
                                            break;
                                        case "4":
                                            if (one_index[j] != undefined && one_index[j] >= 1) {
                                                one_index[j]++;
                                            } else {
                                                one_index[j] = 1;
                                            }

                                            break;
                                        case "3":
                                            if (two_index[j] != undefined && two_index[j] >= 1) {
                                                two_index[j]++;
                                            } else {
                                                two_index[j] = 1;
                                            }

                                            break;
                                        case "2":
                                            if (three_index[j] != undefined && three_index[j] >= 1) {
                                                three_index[j]++;
                                            } else {
                                                three_index[j] = 1;
                                            }
                                            break;
                                        case "1":
                                            if (four_index[j] != undefined && four_index[j] >= 1) {
                                                four_index[j]++;
                                            } else {
                                                four_index[j] = 1;
                                            }
                                            break;

                                    }

                                    // console.log("i = " + j + " there are " + zero_index[j], one_index[j], two_index[j], three_index[j], four_index[j]);

                                    //เอาเฉพาะค่ารอบหลังสุด 3 รอบ
                                    if (i == (php_num_question - 1)) {
                                        if (zero_index[j] == undefined) {
                                            zero_index[j] = 0;
                                        }
                                        if (one_index[j] == undefined) {
                                            one_index[j] = 0;
                                        }
                                        if (two_index[j] == undefined) {
                                            two_index[j] = 0;
                                        }
                                        if (three_index[j] == undefined) {
                                            three_index[j] = 0;
                                        }
                                        if (four_index[j] == undefined) {
                                            four_index[j] = 0;
                                        }
                                        graph[j] = [php_question[j], zero_index[j], one_index[j], two_index[j], three_index[j], four_index[j]];
                                        // console.log(graph);
                                    }

                                }

                            }

                            var append_graph = [
                                ['หัวข้อการประเมิน', '5', '4', '3', '2', '1']
                            ];
                            for (var k = 0; k < php_num_question; k++) {
                                append_graph.push(graph[k]);
                            }
                            console.log(append_graph);
                            var data = google.visualization.arrayToDataTable(
                                append_graph
                            );

                            var options = {
                                chart: {
                                    title: php_evaluate_name,
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>

                </div>
            </div>
        </div>
    </form>
</body>




<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

<script src='vfs_fonts.js'></script>




<script>
    $(document).ready(function() {

        // DataTable
        pdfMake.fonts = {
            THSarabun: {
                normal: 'THSarabun.ttf',
                bold: 'THSarabun-Bold.ttf',
                italics: 'THSarabun-Italic.ttf',
                bolditalics: 'THSarabun-BoldItalic.ttf'
            }
        }

        var table = $('#table').DataTable({

            "autoWidth": false,
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],

            "pagingType": "full_numbers",
            dom: 'B<"top"f>rt<"bottom"lpi><"clear">',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column'

                }
            ]
        });


        $('label.toggle-vis').on('change', function(e) {
            e.preventDefault();
            var column = table.column($(this).attr('data-column'));
            $('#container').css('display', 'block');
            table.columns.adjust().draw();
            column.visible(!column.visible());
        });



    });
</script>

<script src="index.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

</html>