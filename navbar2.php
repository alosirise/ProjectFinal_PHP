<?php ob_start();?>
<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Bootstrap navbar CSS-->
  <link rel="stylesheet" href="navbar.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
<style>


@media only screen and (min-width : 320px) {
  .aa{
    display: inline;
  }
}

/* Extra Small Devices, Phones */ 
@media only screen and (min-width : 480px) {
  .aa{
    display: inline;
  }
}

/* labtop+ */
@media only screen and (min-width : 1025px) {
  .aa{
    display: none;
  }
}




</style>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">

      <a href="javascript:void(0)" onclick="openNav()"><span class="navbar-toggler-icon"></span></a>
    </button>
    <!--  <div class="collapse navbar-collapse" id="collapsibleNavId"> -->


    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    </ul>


    <form class="form-inline my-2 my-lg-0">
      <?php if (isset($_SESSION['id'])) { ?>
        <div class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?>&nbsp;&nbsp;&nbsp;</a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
            <a class="dropdown-item" href="profile.php">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Log out</a>
          </div>
        </div>
      <?php } else { ?>

        <div class="nav-item">
          <a href="signin.php" class="nav-link">Sign in</a>
        </div>

        <div class="nav-item">
          <a href="register.php" class="nav-link">Register</a>
        </div>

      <?php } ?>
    </form>
    </div>
  </nav>






  <div id="mySidenav" class="sidenav ">

    <div id="aa"  class="aa">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    </div>

    <img class="center img-center" src="psu-logo.jpg" style="width:45%; ">

    <a href="home.php" style="font-size:18px;">หน้าหลัก</a>
    <?php

    if (!isset($_SESSION['username'])) {
      echo '
            <a href="allproject.php" style="font-size:18px">รายชื่อโครงการทั้งหมด</a>
            <a href="procedure.php" style="font-size:18px">ขั้นตอนการสมัครฝึกอบรม</a>
            <a href="contact.php" style="font-size:18px">ช่องทางการติดต่อ</a> <hr>';
    } else {

      if (empty($_SESSION['role']) || $_SESSION['role'] == "user" || $_SESSION['role'] == "staff" || $_SESSION['role'] == "admin") {
        echo '
            <a href="allproject.php" style="font-size:18px">รายชื่อโครงการทั้งหมด</a>
            <a href="history.php" style="font-size:18px">ประวัติการเข้าร่วม</a> 
            <a href="procedure.php" style="font-size:18px">ขั้นตอนการสมัครฝึกอบรม</a>
            <a href="contact.php" style="font-size:18px">ช่องทางการติดต่อ</a> <hr>';
      }

      if (!empty($_SESSION['role']) && ($_SESSION['role'] == "staff" || $_SESSION['role'] == "admin")) {
        echo ' 
            <a href="myproject.php" style="font-size:18px">จัดการโครงการ</a>
            ';
      }
      if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin") {
        echo '      
            <a href="request.php" style="font-size:18px">คำร้องขอสร้างโครงการ</a>
            <a href="report.php" style="font-size:18px">Report โครงการ</a>
            <hr>
            <a href="manage_account.php" style="font-size:18px">จัดการบัญชี</a>';
      }
    }
    ?>

  </div>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="index.js"></script>
</body>

</html>