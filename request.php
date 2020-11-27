<?php ob_start(); ?>
<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "admin") {
  header('location: home.php');
  exit();
}
$_SESSION['go'] = 'go_request';
?>

<!doctype html>
<html lang="en">

<head>
  <title>Project</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" />
  <!-- Bootstrap navbar CSS-->
  <link rel="stylesheet" href="navbar.css">
  <script src="https://kit.fontawesome.com/f7ef8136ea.js" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>


  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


</head>
<script>
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
</script>
<style>
  #main {
    position: absolute;
    top: 50px;
    right: 25px;
    bottom: 25px;
    left: 24%;
 
  }

  td {
    text-align: center;
  }
</style>

<body>
  <div class="" id="nav"></div>

  <div id="main">
    <div class="w3-container col-lg-11 center ">


      <br>      <h2 style=" padding :20px;  padding-top :50px;">คำร้องขอสร้างโครงการ</h2>
      <!-- <center><select style=" height:35px; width: 20%">
          <option value="all">ทั้งหมด</option>
          <option value="request">คำร้องขอสร้างโครงการ</option>
          <option value="accept">รายการที่อนุมัติแล้ว</option>
          <option value="reject">รายการที่ส่งคืนแล้ว</option>
          <option value="finish">รายการที่เสร็จสิ้น</option>
        </select></center> -->

      <br>
      <ul class="nav nav-tabs" role="tablist" id="myTab">
        <li> <a href="#list1" class="active nav-link" role="tab" data-toggle="tab">
            <icon class="fa fa-home"></icon> คำร้องขอสร้างโครงการ
          </a>

        </li>
        <li><a href="#list2" class=" nav-link" role="tab" data-toggle="tab">
            <i class="fa fa-user"></i> รายการที่อนุมัติแล้ว
          </a>

        </li>
        <li><a href="#list3" class="nav-link" role="tab" data-toggle="tab">
            <i class="fa fa-user"></i> รายการที่ส่งคืนแล้ว
          </a>

        </li>
        <li><a href="#list4" class="nav-link" role="tab" data-toggle="tab">
            <i class="fa fa-user"></i> รายการที่เสร็จสิ้นแล้ว
          </a>

        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane fade active show " id="list1">
          <div id="request">
            <h2 style=" padding :35px;">คำร้องขอสร้างโครงการ</h2>

            <?php
            include_once('connect.php');
            $sql = "SELECT * FROM create_project WHERE status = 'กำลังดำเนินการ' ORDER BY last_change DESC ";
            $result = $conn->query($sql);
            $number = 0;

            if ($result->num_rows > 0) {

              echo '
            <table class="table " id=table >
              <thead>
                <tr class="w3-indigo">
                 <th style="width:4%">ที่</th>
                  <th style="width:26%">ชื่อโครงการ</th>
                  <th class="text-center" style="width:10%">ชื่อผู้ใช้</th>
                  <th class="text-center" data-orderable="false" style="width:15%" colspan="2" >ตรวจสอบโครงการ</th>
              
                  <th class="text-center" class="text-center" data-orderable="false" style="width:15%">ตรวจสอบแบบฟอร์ม</th>
                  <th class="text-center" class="text-center" data-orderable="false" style="width:15%">แบบประเมิน</th>
                  
                  <th class="text-center" class="text-center" data-orderable="false" style="width:10%">สถานะ</th>

              
                </tr>
              </thead> ';
              // output data of each row
              //   " . $row["username"] . "
              while ($row = $result->fetch_assoc()) {
                $number++;
                echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'>" . $row["name_project"] . "</td>  
            <td>" . $row["creator"] . "</td>  
            <td><a href=edit_project.php?project_id=" . $row['project_id'] . ">    <i class='fas fa-file-alt fa-lg'></i></a></td> 
            <td><a href=edit_detail_project.php?project_id=" . $row['project_id'] . "> <i class='fas fa-image  fa-lg' ></i></a></td>
            ", "
            <td><a href=create_form.php?project_id=" . $row['project_id'] . ">  <i class='fas fa-tasks fa-lg'></i></a></td> 
            <td><a href=evaluate_form.php?project_id=" . $row['project_id'] . "> <i class='fas fa-clipboard-check fa-lg'></i></a></td> 
       
            <td><select name='change' id='project_id' style=' height:30px; width: 100%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
                     onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
                     else{location.href= 'approve_project.php?project_id=" . $row['project_id'] . "&change='+this.value}\" 
                     >              
             <option value='อนุมัติ' ";
                if ($row["status"] == 'อนุมัติ') {
                  echo "selected='selected'";
                }
                echo ">อนุมัติ</option>
             <option value='ไม่อนุมัติ' ";
                if ($row["status"] == 'ไม่อนุมัติ') {
                  echo "selected='selected'";
                }
                echo ">ส่งคืน</option>

               <option value='กำลังดำเนินการ' ";
                if ($row["status"] == 'กำลังดำเนินการ') {
                  echo "selected='selected' ";
                }
                echo ">กำลังร้องขอ</option>

                <option value='เสร็จสิ้น' ";
                if ($row["status"] == 'เสร็จสิ้น') {
                  echo "selected='selected' ";
                }
                echo ">เสร็จสิ้น</option>
               </select>
           </td>  
            </tr>";
              }
              echo "</table>";
            } else {
              echo "<h3>-ยังไม่มีคำร้องขอในขณะนี้-</h3>";
            }
            ?>
          </div>
        </div>


        <div class="tab-pane fade " id="list2">
          <div id="accept">
            <h2 style=" padding :35px;">รายการที่อนุมัติแล้ว</h2>
            <?php
            $sql2 = "SELECT * FROM create_project WHERE status = 'อนุมัติ'  ORDER BY last_change DESC ";
            $result2 = $conn->query($sql2);
            $number = 0;
            if ($result2->num_rows > 0) {
              echo '
                 <table class="table " id=table2 >
                   <thead>
                     <tr class="w3-green">
                      <th style="width:1%">ที่</th>
                       <th style="width:29%">ชื่อโครงการ</th>
                       <th class="text-center" style="width:10%">ชื่อผู้ใช้</th>
                       <th class="text-center" data-orderable="false" style="width:10%" colspan="2">ตรวจสอบโครงการ</th>
                     
                       <th class="text-center" data-orderable="false" style="width:10%">ตรวจสอบแบบฟอร์ม</th>
                       <th class="text-center" data-orderable="false" style="width:10%">แบบประเมิน</th>
                       <th class="text-center" data-orderable="false" style="width:10%" colspan="2">คำตอบ / ใบลงทะเบียน</th>
                     
                       <th class="text-center" data-orderable="false" style="width:10%" >งบประมาณ</th>
                       <th class="text-center" data-orderable="false" style="width:10%">สถานะ</th>
                   
                     </tr>
                   </thead> ';
              // output data of each row
              //   " . $row["username"] . "
              while ($row2 = $result2->fetch_assoc()) {
                $number++;
                echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'>" . $row2["name_project"] . "</td>  
                 <td>" . $row2["creator"] . "</td>  
                 <td><a href=edit_project.php?project_id=" . $row2['project_id'] . ">    <i class='fas fa-file-alt fa-lg'></i></a></td> 
                 <td><a href=edit_detail_project.php?project_id=" . $row2['project_id'] . "> <i class='fas fa-image  fa-lg' ></i></a></td>
                 ", "
                 <td><a href=create_form.php?project_id=" . $row2['project_id'] . ">   <i class='fas fa-tasks fa-lg'></i></a></td>
                 <td><a href=evaluate_form.php?project_id=" . $row2['project_id'] . ">  <i class='fas fa-clipboard-check fa-lg'></i></a></td>  
                 <td><a href=answer_form.php?project_id=" . $row2['project_id'] . "> <i class='fa fa-book fa-lg' aria-hidden='true'></i></a></td>
                 <td><a href=create_registration.php?project_id=" . $row2['project_id'] . "> <i class='fa fa-id-card fa-lg' aria-hidden='true'></i></a></td>
                 <td><a href=confirm_budget.php?project_id=" . $row2['project_id'] . "> <i class='fas fa-hand-holding-usd fa-lg' aria-hidden='true'></i></a></td>

                 <td><select name='change' id='project_id' style=' height:30px; width: 100%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
                 onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
                 else{location.href= 'approve_project.php?project_id=" . $row2['project_id'] . "&change='+this.value}\" 
                 >              
                  <option value='อนุมัติ' ";
                if ($row2["status"] == 'อนุมัติ') {
                  echo "selected='selected'";
                }
                echo ">อนุมัติ</option>
                  <option value='ไม่อนุมัติ' ";
                if ($row2["status"] == 'ไม่อนุมัติ') {
                  echo "selected='selected'";
                }
                echo ">ส่งคืน</option>

                    <option value='กำลังดำเนินการ' ";
                if ($row2["status"] == 'กำลังดำเนินการ') {
                  echo "selected='selected' ";
                }
                echo ">กำลังร้องขอ</option>

                      <option value='เสร็จสิ้น' ";
                if ($row2["status"] == 'เสร็จสิ้น') {
                  echo "selected='selected' ";
                }
                echo ">เสร็จสิ้น</option>
                    </select>
       </td>  
                 
                 </tr>";
              }
              echo "</table>";
            } else {
              echo "<h3>-ยังไม่มีรายการที่อนุมัติ-</h3>";
            }
            ?>
          </div>
        </div>

        <div class="tab-pane fade " id="list3">
          <div id="reject">
            <h2 style=" padding :35px;">รายการที่ส่งคืนแล้ว</h2>
            <?php
            $sql3 = "SELECT * FROM create_project WHERE status = 'ไม่อนุมัติ' ORDER BY last_change DESC ";
            $result3 = $conn->query($sql3);
            $number = 0;

            if ($result3->num_rows > 0) {
              echo '
           <table class="table " id=table3 >
             <thead>
               <tr class="w3-red">
                <th style="width:4%">ที่</th>
                 <th style="width:26%">ชื่อโครงการ</th>
                 <th class="text-center" style="width:10%">ชื่อผู้ใช้</th>
                 <th class="text-center" data-orderable="false" style="width:15%" colspan="2" >ตรวจสอบโครงการ</th>
        
                 <th class="text-center" data-orderable="false" style="width:15%">ตรวจสอบแบบฟอร์ม</th>
                 <th class="text-center" data-orderable="false" style="width:15%">แบบประเมิน</th>
                 <th data-orderable="false" style="width:5%"></th>
                 <th class="text-center" data-orderable="false" style="width:15%">สถานะ</th>
           
             
               </tr>
             </thead> ';
              // output data of each row
              //   " . $row["username"] . "
              while ($row3 = $result3->fetch_assoc()) {
                $number++;
                echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'> " . $row3["name_project"] . "</td>  
           <td>" . $row3["creator"] . "</td>  
           <td><a href=edit_project.php?project_id=" . $row3['project_id'] . ">   <i class='fas fa-file-alt fa-lg'></i></a></td> 
           <td><a href=edit_detail_project.php?project_id=" . $row3['project_id'] . "> <i class='fas fa-image  fa-lg' ></i></a></td>
           ", "
           <td><a href=create_form.php?project_id=" . $row3['project_id'] . ">   <i class='fas fa-tasks fa-lg'></i></a></td> 
           <td><a href=evaluate_form.php?project_id=" . $row3['project_id'] . ">   <i class='fas fa-clipboard-check fa-lg'></i></a></td>  
            <td></td>
          
            <td><select name='change' id='project_id' style=' height:30px; width: 100%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
                     onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
                     else{location.href= 'approve_project.php?project_id=" . $row3['project_id'] . "&change='+this.value}\" 
                     >              
             <option value='อนุมัติ' ";
                if ($row3["status"] == 'อนุมัติ') {
                  echo "selected='selected'";
                }
                echo ">อนุมัติ</option>
             <option value='ไม่อนุมัติ' ";
                if ($row3["status"] == 'ไม่อนุมัติ') {
                  echo "selected='selected'";
                }
                echo ">ส่งคืน</option>

               <option value='กำลังดำเนินการ' ";
                if ($row3["status"] == 'กำลังดำเนินการ') {
                  echo "selected='selected' ";
                }
                echo ">กำลังร้องขอ</option>

                <option value='เสร็จสิ้น' ";
                if ($row3["status"] == 'เสร็จสิ้น') {
                  echo "selected='selected' ";
                }
                echo ">เสร็จสิ้น</option>
               </select>
           </td>  
           </tr>";
              }
              echo "</table>";
            } else {
              echo "<h3>-ยังไม่มีรายการที่ส่งคืน-</h3>";
            }
            ?>
          </div>
        </div>


        <div class="tab-pane fade " id="list4">
          <div id="finish">

            <h2 style=" padding :35px;">รายการที่เสร็จสิ้นแล้ว</h2>
            <?php
            $sql3 = "SELECT * FROM create_project WHERE status = 'เสร็จสิ้น'  ORDER BY last_change DESC ";
            $result3 = $conn->query($sql3);
            $number = 0;

            if ($result3->num_rows > 0) {
              echo '
           <table class="table " id=table3 >
             <thead>
               <tr class="w3-blue-gray">
                <th style="width:1%">ที่</th>
                 <th style="width:29%">ชื่อโครงการ</th>
                 <th class="text-center" style="width:11%">ชื่อผู้ใช้</th>
                 <th class="text-center" data-orderable="false" style="width:12%" colspan="2">ตรวจสอบโครงการ</th>
                 <th class="text-center" data-orderable="false" style="width:12%">ตรวจสอบแบบฟอร์ม</th>
                 <th class="text-center" data-orderable="false" style="width:11%">แบบประเมิน</th>
                 <th class="text-center" data-orderable="false" style="width:12%" colspan="2">คำตอบ / ใบลงทะเบียน</th>
                 <th class="text-center" data-orderable="false" style="width:12%">สถานะ</th>
           
             
               </tr>
             </thead> ';
              // output data of each row
              //   " . $row["username"] . "
              while ($row3 = $result3->fetch_assoc()) {
                $number++;
                echo "<tr><td>" . $number . ".</td><td style= 'text-align: left;'>" . $row3["name_project"] . "</td>  
           <td>" . $row3["creator"] . "</td>  
           <td><a href=edit_project.php?project_id=" . $row3['project_id'] . ">   <i class='fas fa-file-alt fa-lg'></i></a></td> 
           <td><a href=edit_detail_project.php?project_id=" . $row3['project_id'] . "> <i class='fas fa-image  fa-lg' ></i></a></td>
           ", "
           <td><a href=create_form.php?project_id=" . $row3['project_id'] . ">    <i class='fas fa-tasks fa-lg'></i></a></td> 
           <td><a href=evaluate_form.php?project_id=" . $row3['project_id'] . ">   <i class='fas fa-clipboard-check fa-lg'></i></a></td>  
           <td><a href=answer_form.php?project_id=" . $row3['project_id'] . "> <i class='fa fa-book fa-lg' aria-hidden='true'></i></a></td>
           <td><a href=create_registration.php?project_id=" . $row3['project_id'] . "> <i class='fa fa-id-card fa-lg' aria-hidden='true'></i></a></td>
          
            <td><select name='change' id='project_id' style=' height:30px; width: 100%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
                     onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
                     else{location.href= 'approve_project.php?project_id=" . $row3['project_id'] . "&change='+this.value}\" 
                     >              
             <option value='อนุมัติ' ";
                if ($row3["status"] == 'อนุมัติ') {
                  echo "selected='selected'";
                }
                echo ">อนุมัติ</option>
             <option value='ไม่อนุมัติ' ";
                if ($row3["status"] == 'ไม่อนุมัติ') {
                  echo "selected='selected'";
                }
                echo ">ส่งคืน</option>

               <option value='กำลังดำเนินการ' ";
                if ($row3["status"] == 'กำลังดำเนินการ') {
                  echo "selected='selected' ";
                }
                echo ">กำลังร้องขอ</option>

                <option value='เสร็จสิ้น' ";
                if ($row3["status"] == 'เสร็จสิ้น') {
                  echo "selected='selected' ";
                }
                echo ">เสร็จสิ้น</option>
               </select>
           </td>  
           </tr>";
              }
              echo "</table>";
            } else {
              echo "<h3>-ยังไม่มีรายการที่เสร็จสิ้น-</h3>";
            }
            ?>
          </div>
        </div>
      </div><br><br><br><br><br>




      <script>
        $(document).ready(function() {
         
          $('#table,#table2,#table3').DataTable({
            "pagingType": "full_numbers",
          });


        });
      </script>

      <script src="index.js"></script>
</body>

</html>