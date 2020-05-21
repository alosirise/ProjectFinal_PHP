<?php session_start();
?>

<!DOCTYPE html>
<html>
<head>
    
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Bootstrap navbar CSS-->
  <link rel="stylesheet" href="navbar.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  /* background-image: url("bg2.jpg"); */
  background-color: #f1f1f1;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  /* color: #f1f1f1; */
  color :  #064579;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

</head>
<body>
    
<ul class="nav nav-bar topnav-right bg-light">

    <?php if(isset($_SESSION['id']))  {?>
    <li class="nav-item">
      <a href="#" class="nav-link"><?php echo $_SESSION['username'];?></a>
    </li>
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
      aria-expanded="false"></a>
    <div class="dropdown-menu">

      <a class="dropdown-item" href="">Profile</a>
      <a class="dropdown-item" href="#">sssss</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="logout.php">Log out</a>
    </div>

    <?php }else{ ?>
    <li class="nav-item">
      <a href="signin.php" class="nav-link">Sign in</a>
    </li>

    <li class="nav-item">
      <a href="register.php" class="nav-link">Register</a>
    </li>
    <?php } ?>
  </ul>




<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
   
        <img class="center" src="psu-logo.jpg" style="width:50%">
  
  <a href="#" style="font-size:19px">หน้าหลัก</a>
  <?php
         if (empty($_SESSION['role']) || $_SESSION['role'] == "user" || $_SESSION['role'] == "staff" || $_SESSION['role'] == "admin"){
            echo '
            <a href="#" style="font-size:19px">รายชื่อโครงการทั้งหมด</a>
            <a href="#" style="font-size:19px">ขั้นตอนการสมัครฝึกอบรม</a>
            <a href="#" style="font-size:19px">ช่องทางการติดต่อ</a> <hr>';
         }

         if(!empty($_SESSION['role']) && ($_SESSION['role'] == "staff" || $_SESSION['role'] == "admin")){
            echo ' 
            <a href="#" style="font-size:19px">จัดการโครงการ</a>
            ';
            }
            if(!empty($_SESSION['role']) && $_SESSION['role'] == "admin" ){
            echo '      
            <a href="#" style="font-size:19px">คำร้องขอการสมัคร</a>
            <a href="#" style="font-size:19px">Report โครงการ</a>
            <a href="#" style="font-size:19px">จัดการบัญชี</a>';
            }
?>


</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
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




