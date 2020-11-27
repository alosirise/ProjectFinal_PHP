<?php ob_start(); ?>
<?php
session_start();
include_once('connect.php');
include('auth.php');

if ($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin") {
  header('location: home.php');
  exit();
}


if ($_SESSION['role'] == "staff") {
  $sql_check_project = "SELECT * FROM create_project WHERE id = '" . $_SESSION['id'] . "' AND project_id = $_GET[project_id]";
  $result_check_project = $conn->query($sql_check_project);

  if (!($result_check_project->num_rows > 0)) {
      header('location: home.php');
      exit();
  } 
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
                ?>
                    <script>
                      var countColumn = "<?php echo $countquestion; ?>";
                    </script>
                <?php
                    $question_explode = explode(",", $row['question']);
                    echo '<th >ชื่อผู้ใช้</th>';
                    for ($i = 0; $i < $countquestion; $i++) {
                      echo '<th > ' . $question_explode[$i] . '</th>';
                    }
                    echo '<th ">สถานะ</th>';
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
              
              }






              for ($z = 0; $z < $count_user; $z++) {

                $sql5 = "SELECT * from profile where firstname_surname = '" . $username[$z] . "'";
                $result5 = mysqli_query($conn, $sql5);
                if ($result5->num_rows > 0) {
                  while ($row = $result5->fetch_assoc()) {
                    $profile_id = $row["profile_id"];
                  }
                }

                echo '<tr id="tr">';
                echo '<td><a href=profile.php?profile_id=' . $profile_id . '>' . $username[$z] . '</a></td>';
                for ($x = 0; $x < (int) $countquestion; $x++) {
                  echo '<td>' . $answer[$append_answer] . '</td>';
                  $append_answer++;
                }

                $status ="";
                $sql6 = "SELECT * from check_payment where firstname_surname = '" . $username[$z] . "'";
                $result6 = mysqli_query($conn, $sql6);
                if ($result6->num_rows > 0) {
                  while ($row = $result6->fetch_assoc()) {
                    $status = $row["status"];
                  }
                }

                echo " <td><select name='change' id='project_id' style=' height:30px; width: 100%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
               onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
               else{location.href='check_payment.php?username=".$username[$z]."&id=".$project_id."&change='+this.value}\" 
               >              

               
               <option value='รอยืนยันการชำระเงิน' ";
               if ( $status == 'รอยืนยันการชำระเงิน') {
                 echo "selected='selected' ";
               }
               echo ">รอยืนยันการชำระเงิน</option>

                <option value='ยกเลิกการสมัคร' ";
                if ( $status == 'ยกเลิกการสมัคร') {
                  echo "selected='selected'";
                }
                echo ">ยกเลิกการสมัคร</option>

             
                    <option value='ชำระเงินเรียบร้อย' ";
                if ( $status == 'ชำระเงินเรียบร้อย') {
                  echo "selected='selected' ";
                }
                echo ">ชำระเงินเรียบร้อย</option>
                  </select>
     </td>  ";



                echo '<td><a onClick=\'javascript: return confirm("ต้องการลบคำตอบ ใช่ หรือ ไม่?"); \'href=del_answer.php?project_id=' . $project_id . '><button type="button" class="btn btn-danger" onclick="delAnswer(' . "'" . $username[$z] . "'" . ')">ลบ</button></a></td>';
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
            columns: [':visible']
          }
        },
        // {
        //   extend: 'pdfHtml5',
        //   title: 'Report',
        //   text: 'PDF (landscape)',
        //   orientation: 'landscape',
        //   pageSize: 'A4',
        //   exportOptions: {
        //     columns: [':visible :not(:nth-last-child(-1n+2)) ']
        //   },
        //   customize: function(doc) {
        //     doc.defaultStyle = {
        //       font: 'THSarabun',
        //       fontSize: 15
        //     };
        //     doc.content[1].margin = [100, 0, 0, 0];
        //     doc.styles.tableHeader.fontSize = 15;
        //     countColumn = parseInt(countColumn) + 1; 
            
        //     //+1 เพราะ เพิ่มแถว ชื่อผู้ใช้


        //     var colCount = new Array();
        //     $('#table').find('tbody tr:first-child td').each(function() {
        //       if ($(this).attr('colspan')) {
        //         for (var i = 1; i <= $(this).attr('colspan'); $i++) {
        //           colCount.push('*');
        //         }
        //       } else {
        //         colCount.push('*');
        //       }
        //     });
        //     doc.content[1].table.widths = colCount;

        //     doc.styles.tableBodyOdd.alignment = 'center';
        //     doc.styles.tableBodyEven.alignment = 'center';

        //     console.log(doc);
        //   }
        // },
        // {
        //   "extend": 'pdf',
        //   "text": 'PDF (vertical)',
        //   "title": 'Report',
        //   "pageSize": 'A4',
        //   exportOptions: {
        //     columns: [':visible :not(:nth-last-child(-1n+2)) ']
        //   },
        //   "customize": function(doc) {
        //     doc.defaultStyle = {
        //       font: 'THSarabun',
        //       fontSize: 15
        //     };

        //     doc.content[1].margin = [50, 0, 0, 0];
        //     doc.styles.tableHeader.fontSize = 15;

        //     var colCount = new Array();
        //     $('#table').find('tbody tr:first-child td').each(function() {
        //       if ($(this).attr('colspan')) {
        //         for (var i = 1; i <= $(this).attr('colspan'); $i++) {
        //           colCount.push('*');
        //         }
        //       } else {
        //         colCount.push('*');
        //       }
        //     });
        //     doc.content[1].table.widths = colCount; // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ

        //     doc.styles.tableHeader.fontSize = 13;
        //     doc.styles.tableBodyOdd.alignment = 'center';
        //     doc.styles.tableBodyEven.alignment = 'center';

        

        //     console.log(doc);
        //   }
        // },
       {
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


<script src="index.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

</html>