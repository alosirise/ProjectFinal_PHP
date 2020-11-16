<?php ob_start(); ?>
<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "admin") {
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
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />


</head>
<style>
    #main {
        position: absolute;
        top: 50px;
        right: 25px;
        bottom: 25px;
        left: 24%;
    }

    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 17px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
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
        height: 13px;
        width: 13px;
        left: 2px;
        bottom: 2px;
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
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(13px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<body>

    <?php

    $dayTH = ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'];
    $monthTH = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
    $monthTH_brev = [null, 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];

    function thai_date_short($time)
    {   // 19  ธ.ค. 2556a
        global $dayTH, $monthTH_brev;
        $thai_date_return = date("j", $time);
        $thai_date_return .= " " . $monthTH_brev[date("n", $time)];
        // $thai_date_return .= " " . (date("Y", $time) + 543);                   *****hide year
        return $thai_date_return;
    }
    function thai_date_fullmonth($time)
    {   // 19 ธันวาคม 2556
        global $dayTH, $monthTH;
        $thai_date_return = date("j", $time);
        $thai_date_return .= " " . $monthTH[date("n", $time)];
        $thai_date_return .= " " . (date("Y", $time) + 543);
        return $thai_date_return;
    }
    function thai_date_short_number($time)
    {   // 19-12-56
        global $dayTH, $monthTH;
        $thai_date_return = date("d", $time);
        $thai_date_return .= "-" . date("m", $time);
        $thai_date_return .= "-" . substr((date("Y", $time) + 543), -2);
        return $thai_date_return;
    }
    ?>


    <div class="" id="nav"></div>
    <div id="main">
        <div class="w3-container col-lg-11 center">
            <h2 style=" padding :30px; ">สรุปรายงาน</h2>
            <?php
            include_once('connect.php');
            $sql = "SELECT * FROM create_project WHERE status ='อนุมัติ' OR status ='เสร็จสิ้น' ORDER BY last_change DESC ";
            $result = $conn->query($sql);
            $number = 0;
            if ($result->num_rows > 0) {
                echo '
            <table class="table table-responsive table-bordered" id=table  >
              <thead>
                <tr class="w3-blue-gray">
                <th  style="width:1%">ลำดับ</th>
                  <th style="width:2%" >ปีงบประมาณ</th>     
                  <th style="width:9%" >ชื่อโครงการ</th>
                  <th style="width:5%" >หัวหน้าโครงการ</th> 
                  <th style="width:5%" >ผู้ร่วมโครงการ</th>      
                  <th  style="width:5%">ระยะเวลา</th>      
                  <th style="width:4%" >แหล่งเงิน</th>      
                  <th  style="width:5%">ประมาณการค่าใช้จ่าย (บาท)</th>      
                  <th  style="width:5%">สรุปรวมค่าใช้จ่ายและเงินคงเหลือ (บาท)</th>      
                  <th  style="width:5%">ค่าตอบแทน</th>    
                  <th  style="width:5%">ค่าใช้สอย,ค่าวัสดุ</th>    
                  <th  style="width:5%">ค่าเช่าห้อง</th>    
                  <th  style="width:5%">ค่าใช้จ่ายอื่นๆ</th>
                  <th  style="width:5%">เงินคงเหลือ</th>      

                  <th  style="width:5%">ค่าบริการวิชาการ 15 %</th>      
                  <th  style="width:5%">จัดสรร 15 % มหาลัย 1.5</th>      
                  <th  style="width:5%">จัดสรร 15 % วข 2.5</th>      
                  <th  style="width:5%">จัดสรร 15 % คณะ 11</th>      
                  <th  style="width:5%">ค่าธรรมเนียม 5% จาก 11% ที่คณะได้</th>      
                  <th  style="width:5%">คืนค่าธรรมเนียม 6% จาก 11% ให้ผู้รับงาน</th>      
                  <th  style="width:4%">สถานะ</th>      
                </tr>
              </thead><tbody> ';

                $project_id_create; //id in database
                $project_id_multiple; //id in database

                //   thai_date_fullmonth(strtotime($row["startDate"])) .ถึง . thai_date_fullmonth(strtotime($row["endDate"]))

                while ($row = $result->fetch_assoc()) {
                    $number++;
                    $project_id_create = $row["project_id"];

                    $sql2 = "SELECT * FROM mutiple_text WHERE project_id = $project_id_create";
                    $result2 = $conn->query($sql2);
               
                    echo "<tr><td> " . $number . ".</td><td>" . $row["budget_year"] . "</td>        <td>" . $row["name_project"] . "</td><td>" . $row["project_leader"] . "</td>
                    <td>";

                    
                    while ($row2 = $result2->fetch_assoc()) {
                        echo $row2["working_group"] .'<br>';
                    }


                    echo  "</td><td>" . thai_date_short(strtotime($row["startDate"])) . ' - ' . thai_date_short(strtotime($row["endDate"])) . "</td><td>" . $row["respondsible_department"] . "</td>
                    <td>" . number_format($row["sum_result_budget"],2) .  "</td><td>" . number_format($row["summary_budget"],2) .  "</td>
                    

                    <td>" . number_format($row["sum_topic1"],2) .  "</td>
                    <td>" . number_format($row["sum_topic2"],2) .  "</td>
                    <td>" . number_format($row["sum_topic3"],2) .  "</td>
                    <td>" . number_format($row["sum_topic4"],2) .  "</td>";

                    $x = (float)$row["summary_budget"];
                    $y = (float)$row["sum_result_budget"];
                    $ans =$y-$x;

                    echo"
                    <td>".number_format($ans,2)."</td>

                    <td>" . number_format($row["operation_fee"],2).  "</td>
                    <td>" . number_format((1.5 * $row["operation_fee"])/15,2) .  "</td>
                    <td>" . number_format((2.5 * $row["operation_fee"])/15,2) .  "</td>
                    <td>" . number_format((11 * $row["operation_fee"])/15,2) .  "</td>";
                   
                   $stored_11 = (11 * $row["operation_fee"])/15;

                    echo "
                    <td>" . number_format((5 * $stored_11)/11,2) .  "</td>
                    <td>" . number_format((6 * $stored_11)/11,2) .  "</td>";


                    if($row["status"] == 'อนุมัติ'){
                        echo "<td>ดำเนินการ</td>";
                    }else{
                        echo "<td>ปิดโครงการ</td>";
                    }
                    
                    echo "</tr>";
                }

                
                echo "</table>";
            } else {
                echo "<h3>-ยังไม่มีรายการ-</h3>";
            }
            ?>

            

        </div>
    </div>
    </div>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
 
    <script src='vfs_fonts.js'></script>

    <script>
        $(document).ready(function() {

            pdfMake.fonts = {
                THSarabun: {
                    normal: 'THSarabun.ttf',
                    bold: 'THSarabun-Bold.ttf',
                    italics: 'THSarabun-Italic.ttf',
                    bolditalics: 'THSarabun-BoldItalic.ttf'
                }
            }
            var table = $('#table').DataTable({

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
                "pageLength": 10,
                "scrollX": 3200,
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
                    }
                ]
            });

        });
    </script>
    <script src="index.js"></script>
</body>

</html>