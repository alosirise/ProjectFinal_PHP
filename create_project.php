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
    <style>
        .text {
            width: 350px;
            font-size: 18px;
            margin: 10px;
            padding: 10px;
            height: 40px;
        }

        .container {
            width: 500px;
            margin: 100px auto;
        }

        input {
            width: 400px;
            font-size: 18px;
            margin: 10px;
            padding: 10px;
            height: 40px;
        }

        .remove {
            width: 30px;
            height: 30px;
            font-size: 20px;
            background-color: tomato;
            color: white;
            border: none;
            border-radius: 15px;
            margin: 5px;
        }

        #addRow4,#addRow3,#addRow2,#addRow1,
        #getValues1,#getValues2,#getValues3,#getValues4 {
            width: 130px;
            height: 40px;
            font-size: 16px;
            background-color: lightseagreen;
            color: white;
            border: none;
            margin: 20px;
        }

        button:hover {
            cursor: pointer;
        }

        tr:hover {
            cursor: move;
        }
    </style>
</head>

<body>

    <div class="" id="nav"></div>
    <form action="" method="POST">
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
          <input type="text" class="form-control" id="name_project" name ="name_project" placeholder="">
        </div>

        <div class="form-group">
        <label for="exampleFormControlInput1">หน่วยงานที่รับผิดชอบ</label>
        <input type="text" class="form-control"  id="respondsible_department" name ="respondsible_department" placeholder="">
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

        ?>
        <div class="card-footer text-center">
            <a href='arrange.php'> <input type="submit" name="submit" class="btn btn-success " value="Submit"></a>
        </div>
    </form>

    <?php
    if (isset($_POST["submit"])) {
        $user_id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $name_project = $_POST['name_project'];
        $respondsible_department = $_POST['respondsible_department'];

        $sql = "SELECT name_project FROM create_project WHERE name_project='$name_project'";
        $result1 = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result1) > 0) {
            echo '<script>alert("ชื่อของโปรเจคซ้ำกับที่มีอยู่แล้ว โปรดตั้งชื่ออื่น")</script>';
        } else {
            $sql2 = "INSERT INTO create_project (id,creator ,name_project,respondsible_department ) 
                VALUES ( '$user_id','$username','$name_project', '$respondsible_department')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                echo '<script>alert("Registration Done")</script>';
            }
        }
    }
    ?>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="w3-container col-lg-6 center">
            <h2 style=" padding :45px;">สร้างโครงการ</h2>
            <div class="card">
                <div class="card-body style= width: 18rem;">
                    <div>
                        <label for="exampleFormControlInput1">ชื่อโครงการ</label>
                        <input type="text" class="form-control text" id="name_project" name="name_project"></td>
                    </div>
                    <div>
                        <label for="exampleFormControlInput1">หน่วยงานที่รับผิดชอบ</label>
                        <input type="text" class="form-control text" id="respondsible_department" name="respondsible_department"></td>
                    </div>
                    <div>
                        <label for="exampleFormControlInput1">หลักการและเหตุผล</label>
                        <textarea class="form-control text" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    
                    <label for="exampleFormControlInput1">วัตถุประสงค์</label>
                    <div>         
                        <table>
                            <tbody1>
                                <tr>
                                    <td><input type="text" name="name"></td>
                                    <td><button class="remove">-</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button id="addRow1">+ Add</button>
                    <button id="getValues1">Get Values</button>

                    <div>
                        <label for="exampleFormControlInput1">กลุ่มเป้าหมาย</label>
                        <input type="text" class="form-control text" id="respondsible_department" name="respondsible_department"></td>
                    </div>

                    <div>
                        <label for="exampleFormControlInput1">ระยะเวลาในการจัดการโครงการ</label>
                        <input type="text" class="form-control text" id="respondsible_department" name="respondsible_department"></td>
                    </div>

                    <label for="exampleFormControlInput1">วิทยากร</label>
                    <div>
                        <table>
                            <tbody2>
                                <tr>
                                    <td><input type="text" name="name"></td>
                                    <td><button class="remove">-</button></td>
                                </tr>                 
                            </tbody>
                        </table>
                    </div>
                    <button id="addRow2">+ Add</button>
                    <button id="getValues2">Get Values</button>

                    <div>
                        <label for="exampleFormControlInput1">สถานที่อบรม</label>
                        <input type="text" class="form-control text" id="respondsible_department" name="respondsible_department"></td>
                    </div>

                    <label for="exampleFormControlInput1">ประโยชน์ที่จะได้รับ</label>
                    <div>
                        <table>
                            <tbody3>
                                <tr>
                                    <td><input type="text" name="name"></td>
                                    <td><button class="remove">-</button></td>
                                </tr>
                          
                            </tbody>
                        </table>
                    </div>
                    <button id="addRow3">+ Add</button>
                    <button id="getValues3">Get Values</button>

                    <div>
                        <label for="exampleFormControlInput1">ค่าลงทะเบียนอบรม</label>
                        <input type="text" class="form-control text" id="respondsible_department" name="respondsible_department"></td>
                    </div>

                    <div>
                        <label for="exampleFormControlInput1">งบประมาณค่าใช้จ่าย</label>

                    </div>

                    <label for="exampleFormControlInput1">คณะทำงาน</label>
                    <div>
                        <table>
                            <tbody4>
                                <tr>
                                    <td><input type="text" name="name"></td>
                                    <td><button class="remove">-</button></td>
                                </tr>
               
                            </tbody>
                        </table>
                    </div>
                    <button id="addRow4">+ Add</button>
                    <button id="getValues4">Get Values</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Compiled and minified JavaScript -->

    <script src="index.js"></script>


    <script>
        var html = '<tr><td><input type="text" name="name"></td><td><button class="remove">-</button></td></tr>';

        $(function() {
            $('tbody').sortable();

            $('#addRow1').click(function() {
                $('tbody1').append(html);
            });
            $('#addRow2').click(function() {
                $('tbody2').append(html);
            });
            $('#addRow3').click(function() {
                $('tbody3').append(html);
            });
            $('#addRow4').click(function() {
                $('tbody4').append(html);
            });


            $(document).on('click', '.remove', function() {
                $(this).parents('tr').remove();
            });

            $('#getValues').click(function() {
                var values = [];
                $('input[name="name"]').each(function(i, elem) {
                    values.push($(elem).val());
                });
                alert(values.join(', '));
            });
        });
    </script>
</body>

</html>