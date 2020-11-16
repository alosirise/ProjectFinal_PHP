<?php ob_start();?>
<?php
session_start();
include('auth.php');
if ($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin") {
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
    <link rel="stylesheet" href="bew.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />

</head>

<body>
    <div class="" id="nav"></div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-3"></div>
            <div class="w3-container col-lg-6 center" style="background-color: white;">
                <h2 style=" padding:30px;">ใบลงทะเบียน</h2>

                <div class="bewcard">
                    <table class="table table-bordered" id=table>
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
                                            ?>
                                             <script>
                                            var countColumn = "<?php echo $count_row; ?>";
                                          </script>
                                          <?php
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
          console.log("asdasd");
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
          title: 'Report',
          text: 'PDF (landscape)',
          orientation: 'landscape',
          pageSize: 'A4',
          exportOptions: {
            columns: [':visible']
          },
          customize: function(doc) {
            doc.defaultStyle = {
              font: 'THSarabun',
              fontSize: 15
            };
            doc.content[1].margin = [ 50, 0, 0, 0 ];
            doc.styles.tableHeader.fontSize = 15;
            countColumn = parseInt(countColumn) + 1; //+1 เพราะ เพิ่มแถว ชื่อผู้ใช้

            // doc.content[1].table.widths = ['25%', '25%', '25%'];
            doc.content[1].table.widths = 
            Array(doc.content[1].table.body[0].length + 1).join('*').split('');

            // var colCount = new Array();
           
            // $('#table').find('tbody tr:first-child td').each(function(){
            //     if($(this).attr('colspan')){
            //         for(var i=1;i<=$(this).attr('colspan');$i++){
            //             colCount.push('*');
            //         }
            //     }else{ colCount.push('*'); }
            // });
            // doc.content[1].table.widths = colCount;

            doc.styles.tableBodyOdd.alignment = 'center'; 
            doc.styles.tableBodyEven.alignment = 'center'; 

            // var rowCount = doc.content[1].table.body.length; // นับจำนวนแถวทั้งหมดในตาราง
            // วนลูปเพื่อกำหนดค่า
        
            // var x = 0;
            // for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
            //     for (var z = 0; z < countColumn; z++) {
            //       console.log("row : " + i + ", col : " + z);
            //       doc.content[1].table.body[i][z].alignment = 'center';
            //     }

            //     x++;
            //     console.log("all : " + countColumn); //เนื่องจาก x=0 ดังนั้น coutcolumn ต้อง-1
                
            // };
            console.log(doc);
          }
        },
        {
          "extend": 'pdf',
          "text": 'PDF (vertical)',
          "title": 'Report',
          "pageSize": 'A4',
          exportOptions: {
            columns: [':visible']
          },
          "customize": function(doc) {
            doc.defaultStyle = {
              font: 'THSarabun',
              fontSize: 15
            };

            doc.content[1].margin = [ 50, 0, 0, 0];
            doc.styles.tableHeader.fontSize = 15;
            doc.content[1].table.widths = 
            Array(doc.content[1].table.body[0].length + 1).join('*').split('');

            // var colCount = new Array();
            // $('#table').find('tbody tr:first-child td').each(function(){
            //     if($(this).attr('colspan')){
            //         for(var i=1;i<=$(this).attr('colspan');$i++){
            //             colCount.push('*');
            //         }
            //     }else{ colCount.push('*'); }
            // });
            // doc.content[1].table.widths = colCount; // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ


            doc.styles.tableHeader.fontSize = 13;
            doc.styles.tableBodyOdd.alignment = 'center'; 
            doc.styles.tableBodyEven.alignment = 'center'; 

            // var rowCount = doc.content[1].table.body.length; // นับจำนวนแถวทั้งหมดในตาราง
            // // วนลูปเพื่อกำหนดค่า
            // var x = 0;
            // for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
            //     for (var z = 0; z < countColumn; z++) {
            //       console.log("row : " + i + ", col : " + z);
            //       doc.content[1].table.body[i][z].alignment = 'center';
            //     }

            //     x++;
            //     console.log("all : " + countColumn); //เนื่องจาก x=0 ดังนั้น coutcolumn ต้อง-1
          
            // };

            console.log(doc);
          }
        },
        {
          extend: 'print',
          title: "Report",
          orientation: 'landscape',
          exportOptions: {
            columns: [':visible']
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