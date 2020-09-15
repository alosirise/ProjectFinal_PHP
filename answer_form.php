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


</head>

<body>
  <div class="" id="nav"></div>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-3"></div>
      <div class="w3-container col-lg-7 center" style="background-color: white;">
        <h2 style=" padding:30px;">คำตอบ</h2>
        <div class="container">
          <?php
          $project_id = $_GET['project_id'];

          include_once('connect.php');

          $sql4 = "SELECT form_name from question where project_id = $project_id";
          $result4 = mysqli_query($conn, $sql4);
          if ($result4->num_rows > 0) {
            while ($row = $result4->fetch_assoc()) {
              echo '<h2>' . $row['form_name'] . '</h2>';
            }
          }
          ?><br>
          <table class="table table-bordered" id="table">
            <thead>
              <tr class="w3-blue-gray">
                <?php
                $countquestion = 0;

                $sql = "SELECT * from question where project_id = $project_id";
                $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $countquestion = $row['num_question'];
                    $question_explode = explode(",", $row['question']);
                    echo '<th >ชื่อผู้ใช้</th>';
                    for ($i = 0; $i < $countquestion; $i++) {
                      echo '<th > ' . $question_explode[$i] . '</th>';
                    }
                    echo '<th ">ลบ</th>';
                  }
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql2 = "SELECT username from answer where project_id = $project_id";
              $result2 = mysqli_query($conn, $sql2);

              $username = array();
              $count_user = 0;
              if ($result2->num_rows > 0) {
                //ใช้เป็น index ตอนเก็บค่า
                $i = 0;
                //ใช้ดักจำนวนรอบของ continue
                $y = 0;

                while ($row = $result2->fetch_assoc()) {
                  $y++;
                  if ($y < (int) $countquestion) {
                    continue;
                  } else {
                    $username[$i] = $row['username'];
                    $i++;
                    $y = 0;
                    $count_user++;
                  }
                }
              }


              $sql3 = "SELECT answer from answer where project_id = $project_id";
              $result3 = mysqli_query($conn, $sql3);

              $answer = array();

              if ($result3->num_rows > 0) {
                //ใช้เป็น index ตอนเก็บค่า
                $j = 0;

                while ($row = $result3->fetch_assoc()) {
                  $answer[$j] = $row['answer'];
                  $j++;
                }
              }


              $append_answer = 0;
              if ($count_user == 0) {
                echo "ยังไม่การตอบกลับ";
              }

              for ($z = 0; $z < $count_user; $z++) {

                echo '<tr id="tr">';
                echo '<td>' . $username[$z] . '</td>';
                for ($x = 0; $x < (int) $countquestion; $x++) {
                  echo '<td>' . $answer[$append_answer] . '</td>';
                  $append_answer++;
                }
                echo '<td><a onClick=\'javascript: return confirm("ต้องการลบคำตอบ ใช่ หรือ ไม่?"); \'href=del_answer.php?project_id=' . $project_id . '><button type="button" class="btn-danger" onclick="delAnswer('."'".$username[$z]."'".')">ลบ</button></a></td>';
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

  function delAnswer(username) {
    console.log("del Answer click");
    document.cookie = 'username=' + username;

  }
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Compiled and minified JavaScript -->

<script src="index.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

</html>