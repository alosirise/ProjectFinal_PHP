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
    <div class="" id="nav"></div>
    <div id="main">
        <div class="w3-container col-lg-11 center">
            <h2 style=" padding :30px; ">Report</h2>
            <?php
            include_once('connect.php');
            $sql = "SELECT * FROM create_project WHERE status ='อนุมัติ'";
            $result = $conn->query($sql);
            $number = 0;
            if ($result->num_rows > 0) {
                echo '
            <table class="table table-responsive table-bordered" id=table  >
              <thead>
                <tr class="w3-blue-gray">
                <th  style="width:1%">ลำดับ</th>
                  <th style="width:1%" >ชื่อโครงการ</th>     
                  <th style="width:1%" >test1</th>
                  <th style="width:1%" >test2</th> 
                  <th style="width:1%" >test3</th>      
                  <th  style="width:1%">test4</th>      
                  <th style="width:1%" >test5</th>      
                  <th  style="width:1%">test6</th>      
                
                </tr>
              </thead><tbody> ';

                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $number++;
                    echo "<tr><td> " . $number . ".</td><td>" . $row["name_project"] . "</td>        <td>" . $row["id"] . "</td><td> test</td><td>" . $row["name_project"] . "</td><td>" . $row["name_project"] . "</td><td>" . $row["name_project"] . "</td><td>" . $row["name_project"] . "</td>
             
           
            </tr>";
                }
                echo '</tbody><tfoot> <tr class="w3-blue-gray">
                  <th class="topic1">ที่</th>
                  <th class="topic2">ชื่อโครงการ</th>     
                  <th class="topic3">test1</th>
                  <th class="topic4">test2</th> 
                  <th class="topic5">test3</th>      
                  <th class="topic6">test4</th>      
                  <th class="topic7">test5</th>      
                  <th class="topic8">test6</th>      
               
                </tr></tfoot>';
                echo "</table>";
            } else {
                echo "0 results";
            }
            ?>

            ซ่อนคอลัมน์ :<br>

            <table>

                <tr>
                    <th>
                        <a>ที่</a>
                        <label class="toggle-vis switch" data-column="0">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label><br>

                    </th>

                    <th> <a>ชื่อโครงการ</a>
                        <label class="toggle-vis switch" data-column="1">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label><br></th>


                    <th> <a> test1</a>
                        <label class="toggle-vis switch" data-column="2">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label><br></th>

                    <th> <a>test2</a>
                        <label class="toggle-vis switch" data-column="3">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label><br></th>

                </tr>


                <tr>

                    <th>
                        <a>test3</a>
                        <label class="toggle-vis switch" data-column="4">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label><br></th>



                    <th>
                        <a>test4</a>
                        <label class="toggle-vis switch" data-column="5">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label><br>


                    </th>


                    <th>
                        <a>test5</a>
                        <label class="toggle-vis switch" data-column="6">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label><br></th>

                    <th> <a>test6</a>
                        <label class="toggle-vis switch" data-column="7">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label><br></th>
                </tr>
            </table>

        </div>
    </div>
    </div>
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
        $(document).ready(function() {

            $('.topic1').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" style="width:30px;" placeholder="' + title + '" />');
            });

            $('.topic3 ,.topic4').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" style="width:50px;" placeholder="ค้นหา : ' + title + '" />');
            });

            $('.topic2,.topic5 ,.topic6,.topic7 ,.topic8').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" style="width:190px;" placeholder="ค้นหา : ' + title + '" />');
            });

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
                "scrollX": "1140px",
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
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'report',
                        text: 'PDF (landscape)',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },
                        customize: function(doc) {
                            doc.defaultStyle = {
                                font: 'THSarabun',
                                fontSize: 12
                            };
                            doc.content[1].table.widths = ['5%', '20%', '5%', '5%', '15%', '15%', '20%', '15%'];
                            doc.styles.tableHeader.fontSize = 13;
                            var rowCount = doc.content[1].table.body.length; // นับจำนวนแถวทั้งหมดในตาราง
                            // วนลูปเพื่อกำหนดค่า
                            for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
                                doc.content[1].table.body[i][0].alignment = 'center';
                                doc.content[1].table.body[i][1].alignment = 'left';
                                doc.content[1].table.body[i][2].alignment = 'center';
                                doc.content[1].table.body[i][3].alignment = 'center';
                                doc.content[1].table.body[i][4].alignment = 'center';
                                doc.content[1].table.body[i][5].alignment = 'left';
                                doc.content[1].table.body[i][6].alignment = 'left';
                                doc.content[1].table.body[i][7].alignment = 'left';
                            };
                            console.log(doc);
                        }
                    },
                    {
                        "extend": 'pdf',
                        "text": 'PDF (vertical)',
                        "title": 'Report',
                        "pageSize": 'A4',
                        "customize": function(doc) {
                            doc.defaultStyle = {
                                font: 'THSarabun',
                                fontSize: 12
                            };
                            // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
                            doc.content[1].table.widths = ['5%', '20%', '5%', '5%', '15%', '15%', '20%', '15%'];
                            doc.styles.tableHeader.fontSize = 13;
                            var rowCount = doc.content[1].table.body.length; // นับจำนวนแถวทั้งหมดในตาราง
                            // วนลูปเพื่อกำหนดค่า
                            for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
                                doc.content[1].table.body[i][0].alignment = 'center';
                                doc.content[1].table.body[i][1].alignment = 'left';
                                doc.content[1].table.body[i][2].alignment = 'center';
                                doc.content[1].table.body[i][3].alignment = 'center';
                                doc.content[1].table.body[i][4].alignment = 'center';
                                doc.content[1].table.body[i][5].alignment = 'left';
                                doc.content[1].table.body[i][6].alignment = 'left';
                                doc.content[1].table.body[i][7].alignment = 'left';

                            };
                            console.log(doc);
                        }
                    },
                    {
                        extend: 'print',
                        title: "demo title",
                        orientation: 'landscape',
                        exportOptions: {
                            columns: ':visible',
                        },
                        customize: function(win) {
                            var last = null;
                            var current = null;
                            var bod = [];

                            var css = '@page { size: landscape; }',
                                head = win.document.head || win.document.getElementsByTagName('head')[0],
                                style = win.document.createElement('style');

                            style.type = 'text/css';
                            style.media = 'print';

                            if (style.styleSheet) {
                                style.styleSheet.cssText = css;
                            } else {
                                style.appendChild(win.document.createTextNode(css));
                            }

                            head.appendChild(style);
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
</body>

</html>