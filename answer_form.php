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
</head>

<body>
  <div class="" id="nav"></div>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-3"></div>
      <div class="w3-container col-lg-6 center" style="background-color: white;">
        <h2 style=" padding:30px;">คำตอบ</h2>
        <div class="container">
          <?php
          $project_id = "29";

          include_once('connect.php');

          $sql4 = "SELECT form_name from question where project_id = $project_id";
          $result4 = mysqli_query($conn, $sql4);
          if ($result4->num_rows > 0) {
            while ($row = $result4->fetch_assoc()) {
              echo '<h2>'.$row['form_name'].'</h2>';
            }
          }
          ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <?php
                $countquestion = 0;

                $sql = "SELECT * from question where project_id = $project_id";
                $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $countquestion = $row['num_question'];
                    $question_explode = explode(",", $row['question']);
                    echo '<th>ชื่อผู้ใช้</th>';
                    for ($i = 0; $i < $countquestion; $i++) {
                      echo '<th>' . $question_explode[$i] . '</th>';
                    }
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

              if ($result2->num_rows > 0) {
                //ใช้เป็น index ตอนเก็บค่า
                $i = 0;
                //ใช้ดักจำนวนรอบของ continue
                $y = 0;
                $count_user = 0;
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
                $count_answer = 0;

                while ($row = $result3->fetch_assoc()) {
                  $answer[$j] = $row['answer'];
                  $j++;
                  $count_answer++;
                }
              }



              $append_answer = 0;

              for ($z = 0; $z < $count_user; $z++) {
                echo '<tr>';
                echo '<td>' . $username[$z] . '</td>';
                for ($x = 0; $x < (int) $countquestion; $x++) {
                  echo '<td>' . $answer[$append_answer] . '</td>';
                  $append_answer++;
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

</html>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Compiled and minified JavaScript -->

<script src="index.js"></script>