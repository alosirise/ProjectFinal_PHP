<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin") {
    header('location: home.php');
    exit();
}
//   if($_SESSION['role'] != id)

?>


<!doctype html>
<html lang="en">

<head>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 30px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

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
            height: 23px;
            width: 23px;
            left: 4px;
            bottom: 4px;
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
            -webkit-transform: translateX(23px);
            -ms-transform: translateX(23px);
            transform: translateX(19px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="bew.css">
</head>

<body>
    <div class="" id="nav"></div>

    <div class="row">
        <div class="col-3">a</div>
        <div class="w3-container col-lg-6 center" style="border: 1px solid #e0e0e0;">
            <h2 style=" padding :30px;">จัดการแบบฟอร์ม</h2>
            <div style="margin-bottom:30px;">
                <input style="font-size:30px;" class="form-control" type="text" value="ฟอร์มไม่มีชื่อ">
            </div>

            <div id="delquestion">
                <div style="background-color:white" id="selected">
                    <div class="form-row">
                        <div class="col-6" style="margin-right:50px">
                            <div>
                                <input class="form-control" type="text" placeholder="คำถามของคุณ">
                            </div>
                        </div>
                        <div class="col-5">
                            <select class="form-control" id="selectBox" onchange="selectClick()">
                                <option value="1">คำตอบสั้นๆ</option>
                                <option value="2">ย่อหน้า</option>
                                <option value="3">หลายตัวเลือก</option>
                                <option value="4">ช่องเครื่องหมาย</option>
                            </select>
                        </div>
                        <div style="margin-top:20px; margin-left:10px">
                            <label>ข้อความคำตอบสั้นๆ</label>
                        </div>
                    </div>
                </div>

                <hr style="width:100%;text-align:left;margin-left:0">
                <div style="margin-left:70%">
                    <button type="button" class="btn-primary">คัดลอก</button>
                    <button type="button" class="btn-danger" onclick="delQuestion()">ลบ</button>
                    <span>จำเป็น</span>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Compiled and minified JavaScript -->

        <script src="index.js"></script>
</body>

</html>