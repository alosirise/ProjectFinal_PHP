<?php ob_start();?>
<?php
session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="form.css">
</head>
<style>
    .parent {
        width: 100%;
        height: 400px;
        overflow: hidden;
        vertical-align: middle;
        transition: opacity .6s;
        display:table-cell;
        background: black;
        color: whitesmoke;
        font-size: 30px;

    }

    /* This will style any <img> element in .parent div */
    .parent img {
        width: 100%;
        height: auto;
     
    }
</style>
<style>
    .container {
        margin: 60px 0px 40px 0px;
        position: relative;
        width: 50%;
     
    }
    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
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
    $thai_date_return .= " " . (date("Y", $time) + 543);
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

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="w3-container col-lg-6 center">
            <h2 style=" padding :45px;">รายละเอียดโครงการ</h2>

            <div class="card">
                <div class="card-body" style="width: 100%; padding: 20px;">

                    <?php
                    include_once('connect.php');
                    $sql = "SELECT * FROM create_project WHERE project_id = '$_GET[project_id]'";
                    $result = $conn->query($sql);

                    $sql_mutiple_text = "SELECT * FROM mutiple_text WHERE project_id = '$_GET[project_id]'";
                    $result_mutiple_text = $conn->query($sql_mutiple_text);

                    if ($result->num_rows > 0) {


                        while ($row = $result->fetch_assoc()) {
                            $_SESSION['project_id'] = $row['project_id'];
                            echo '   <br>
                                      <h3 style="   padding: 35px 5px 0px 40px;">ชื่อโครงการ  : ' . $row["name_project"] . '</h2>
                                      ';

                                if ($row["image_project"] == NULL) {
                                    echo '<div class="container"> <div class="parent "><img id="profileDisplay"  class="image"  
                                     src="images/980.png"></div></div>';    
                               
                                } else {

                                    echo '<div class="container"> <div class="parent "><img id="profileDisplay"  class="image"  
                                    src="data:image;base64,' . $row["image_project"] . '"></div></div>';   
                                
                                
                                
                                }
                                echo '
                                   
                                     
                                      <h4 style=" padding: 25px 25px 25px 45px;">สถานที่ : ' . $row["location"] . ' </h4>
                                      <h4 style=" padding: 25px 25px 25px 45px;">ระยะเวลา : ' . $row["numdays"] . ' วัน</h4>
                                      
                                      <h4 style=" padding: 25px 25px 25px 45px;">เริ่มต้นวันที่ : ' . thai_date_fullmonth(strtotime($row["startDate"])) . ' </h4>
                                      
                                      <h4 style=" padding: 25px 25px 25px 45px;">สิ้นสุดวันที่ : ' . thai_date_fullmonth(strtotime($row["endDate"])) . ' </h4>
                                      <h4 style=" padding: 25px 25px 25px 45px;">ราคา : ' . $row["cost"] . ' บาท </h4>
                                      </div>
                                      </div>
                                  </div>
                              </div>
                              
                              

                              <div class="row">
                              <div class="col-lg-3"></div>
                              <div class="w3-container col-lg-6 center">
                                  <h2 style=" padding :45px;"></h2>
                  
                                  <div class="card">
                                      <div class="card-body" style="width: 100%; padding: 20px 70px 20px 70px;">
                                      
                              <h4 style=" padding :30px;">รายละเอียดโครงการ </h4>
                             <h6> &emsp;&emsp;'. $row["detail"] .'</h6>
                             <h2 style=" padding :20px;"></h2>

                                 
                              </div>
                              
                              </div>
                          </div>
                      </div>
                      <h2 style=" padding :45px;"></h2>


                    
                      ';
                        }
                    }
                    ?> <div class="card-footer text-center">
                        <?php echo "<a href=question_form.php?project_id=$_GET[project_id]><button type='button' class='btn btn-success' style='width:15%'>สมัคร</button></a> " ?>
                    </div>



                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                   
                    

                    <script src="index.js"> </script>

</body>

</html>
