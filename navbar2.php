<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
    
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Bootstrap navbar CSS-->
  <link rel="stylesheet" href="navbar.css">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    
<ul class="nav nav-bar bg-light " >
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
    <?php if(isset($_SESSION['id']))  {?>
    <li class="nav-item ">
      <a href="#" class="nav-link"><?php echo $_SESSION['username'];?></a>
    </li>
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
      aria-expanded="false"></a>
    <div class="dropdown-menu">

      <a class="dropdown-item" href="profile.php">Profile</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="logout.php">Log out</a>
    </div>

    <?php }else{ ?>  
      <!-- <ul class="navbar-nav ml-auto"> -->
    <li class="nav-item">
      <a href="signin.php" class="nav-link">Sign in</a>
    </li>

    <li class="nav-item">
      <a href="register.php" class="nav-link">Register</a>
    </li>
      <!-- </ul> -->
    <?php } ?>


  </ul>

  

<div id="mySidenav" class="sidenav ">
  <a href="javascript:void(0)" class="closebtn"  onclick="closeNav()">&times;</a>
   
        <img class="center img-center" src="psu-logo.jpg" style="width:50%; ">
  
  <a href="home.php" style="font-size:19px;">หน้าหลัก</a>
  <?php
         if (empty($_SESSION['role']) || $_SESSION['role'] == "user" || $_SESSION['role'] == "staff" || $_SESSION['role'] == "admin"){
            echo '
            <a href="allproject.php" style="font-size:19px">รายชื่อโครงการทั้งหมด</a>
            <a href="procedure.php" style="font-size:19px">ขั้นตอนการสมัครฝึกอบรม</a>
            <a href="contact.php" style="font-size:19px">ช่องทางการติดต่อ</a> <hr>';
         }

         if(!empty($_SESSION['role']) && ($_SESSION['role'] == "staff" || $_SESSION['role'] == "admin")){
            echo ' 
            <a href="myproject.php" style="font-size:19px">จัดการโครงการ</a>
            ';
            }
            if(!empty($_SESSION['role']) && $_SESSION['role'] == "admin" ){
            echo '      
            <a href="request.php" style="font-size:19px">คำร้องขอการสมัคร</a>
            <a href="report.php" style="font-size:19px">Report โครงการ</a>
            <hr>
            <a href="manage_account.php" style="font-size:19px">จัดการบัญชี</a>';
            }
?>


</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

  <script src="index.js"></script>
</body>
</html> 




