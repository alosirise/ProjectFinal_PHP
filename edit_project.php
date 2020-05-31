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
</head>

<body>
    <div class="" id="nav"></div>
    <form action="" method="POST">
    <?php

    session_start();
    include_once('connect.php');
    $sql = "SELECT * FROM create_project WHERE project_id = '" . $_SESSION['project_id']. "' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo ' 
       <div class="row">
       <div class="col-lg-3"></div>
       <div class="w3-container col-lg-6 center" >
       <h2 style=" padding :45px;">แก้ไขโครงการ</h2>

       <div class="card" >
      <div class="card-body style="width: 18rem;">
       
        <div class="form-group">
          <label for="exampleFormControlInput1">ชื่อโครงการ</label>
          <input type="text" class="form-control" id="name_project" name ="name_project" placeholder="" value="' . $row["name_project"] . '">
        </div>

        <div class="form-group">
        <label for="exampleFormControlInput1">หน่วยงานที่รับผิดชอบ</label>
        <input type="text" class="form-control" id="respondsible_department" name ="respondsible_department" placeholder="" value="' . $row["respondsible_department"] . '">
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">หลักการและเหตุผล</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">วัตถุประสงค์</label>
        <input type="text" name ="name1" class="form-control" id="exampleFormControlInput1" placeholder=""><button class="button">+</button>
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">กลุ่มเป้าหมาย</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">ระยะเวลาในการจัดการโครงการ</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">วิทยากร</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">สถานที่อบรม</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">ค่าลงทะเบียนอบรม</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">งบประมาณค่าใช้จ่าย</label>
        </div>

        <div class="form-group">
        <label for="exampleFormControlInput1">คณะทำงาน</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>

      </div></div>
      </div>
      </div>
    ';
        }
    }
    ?>
     <div class="card-footer text-center">
     <a href='arrange.php'> <input type="submit" name="submit" class="btn btn-success " value="Submit"></a>
     </div>
     </form>
     <?php
        if(isset($_POST["submit"])){
       
            $name_project =$_POST['name_project'];
            $respondsible_department = $_POST['respondsible_department'];
            $sql2 = "UPDATE `create_project` SET name_project = '".$name_project."', respondsible_department = '".$respondsible_department."'  WHERE project_id = '".$_SESSION['project_id']."'";
            $result = mysqli_query($conn , $sql2);

        }
        ?>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>
</body>

</html>