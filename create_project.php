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

    <?php

    session_start();

    include_once('connect.php');


       echo ' 
       <div class="row">
       <div class="col-lg-3"></div>
       <div class="w3-container col-lg-6 center" >
       <h2 style=" padding :45px;">สร้างโครงการ</h2>

       <div class="card" >
      <div class="card-body style="width: 18rem;">
       
        <div class="form-group">
          <label for="exampleFormControlInput1">ชื่อโครงการ</label>
          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>

        <div class="form-group">
        <label for="exampleFormControlInput1">หน่วยงานที่รับผิดชอบ</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
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
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">ระยะเวลาในการจัดการโครงการ</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">วิทยากร</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">สถานที่อบรม</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">ค่าลงทะเบียนอบรม</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>


        <div class="form-group">
        <label for="exampleFormControlInput1">งบประมาณค่าใช้จ่าย</label>
        </div>

        <div class="form-group">
        <label for="exampleFormControlInput1">คณะทำงาน</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>

        <input type="submit" name="submitter" value="Send" />

             
      </div></div>
      </div>
      </div>
    '
    ?>
     


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>
</body>

</html>