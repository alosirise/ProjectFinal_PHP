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
<<<<<<< Updated upstream
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" />
</head>

=======
   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />
</head>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
>>>>>>> Stashed changes
<body>
    <div class="" id="nav"></div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3"></div>
            <div class="w3-container col-lg-6 center" style="background-color: white;">
                <h2 style=" padding:30px;">ใบลงทะเบียน</h2>

                <div class="bewcard">
<<<<<<< Updated upstream
                    <table class="table table-bordered">
                        <thead>
                            <tr id="append">
                                <th scope="col">ลำดับ</th>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
=======
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr id="append">
                                <th scope="col">ลำดับ</th>
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                            <tr>
                            <tr id="append2">

                                <?php
                                // $project_id = $_GET['project_id'];
                                $project_id = "235";
=======
                            
                                <?php
                                $project_id = $_GET['project_id'];
                                // $project_id = "235";
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream


<script>

=======
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


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
        },
        {
          extend: 'pdfHtml5',
          title: 'คำตอบแบบฟอร์ม',
          text: 'PDF (landscape)',
          orientation: 'landscape',
          pageSize: 'A4',
          exportOptions: {
            columns: [1,2,3,4]
          },
          customize: function(doc) {
            doc.defaultStyle = {
              font: 'THSarabun',
              fontSize: 12
            };
            doc.content[1].table.widths = ['25%', '25%', '25%', '25%'];
            doc.styles.tableHeader.fontSize = 13;
            var rowCount = doc.content[1].table.body.length; // นับจำนวนแถวทั้งหมดในตาราง
            // วนลูปเพื่อกำหนดค่า
            for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
              doc.content[1].table.body[i][0].alignment = 'center';
              doc.content[1].table.body[i][1].alignment = 'center';
              doc.content[1].table.body[i][2].alignment = 'center';
              doc.content[1].table.body[i][3].alignment = 'center';
              // doc.content[1].table.body[i][4].alignment = 'center';
              // doc.content[1].table.body[i][5].alignment = 'left';
              // doc.content[1].table.body[i][6].alignment = 'left';
              // doc.content[1].table.body[i][7].alignment = 'left';
            };
            console.log(doc);
          }
        },
        {
          "extend": 'pdf',
          "text": 'PDF (vertical)',
          "title": 'คำตอบแบบฟอร์ม',
          "pageSize": 'A4', 
          exportOptions: {
            columns: [1,2,3,4]
          },
          "customize": function(doc) {
            doc.defaultStyle = {
              font: 'THSarabun',
              fontSize: 12
            };
            // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
            doc.content[1].table.widths = ['25%', '25%', '25%', '25%'];
            doc.styles.tableHeader.fontSize = 13;
            var rowCount = doc.content[1].table.body.length; // นับจำนวนแถวทั้งหมดในตาราง
            // วนลูปเพื่อกำหนดค่า
            for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
              doc.content[1].table.body[i][0].alignment = 'center';
              doc.content[1].table.body[i][1].alignment = 'center';
              doc.content[1].table.body[i][2].alignment = 'center';
              doc.content[1].table.body[i][3].alignment = 'center';
              // doc.content[1].table.body[i][4].alignment = 'center';
              // doc.content[1].table.body[i][5].alignment = 'left';
              // doc.content[1].table.body[i][6].alignment = 'left';
              // doc.content[1].table.body[i][7].alignment = 'left';

            };
            console.log(doc);
          }
        },
        {
          extend: 'print',
          title: "คำตอบแบบฟอร์ม",
          orientation: 'landscape',
          exportOptions: {
            columns: [0, 1, 2, 3]
            // columns: ':visible',
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
>>>>>>> Stashed changes
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Compiled and minified JavaScript -->

<script src="index.js"></script>
<<<<<<< Updated upstream
=======
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
>>>>>>> Stashed changes

</html>