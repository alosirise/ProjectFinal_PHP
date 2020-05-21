<?php session_start();
?>

<!doctype html>
<html lang="en">

<head>

  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Bootstrap navbar CSS-->
  <link rel="stylesheet" href="navbar.css">

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

      <a class="dropdown-item" href="#">Profile</a>
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


  <!-- boostrap navbar -->
  <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"><div class="container"></div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
     
    </div>
  </div>
  </nav> -->



  <!-- SideNav slide-out button -->
  <a href="#" data-activates="slide-out" class="btn btn-primary p-3 button-collapse "><i class="fas fa-bars"></i></a>

  <!-- Sidebar navigation -->
  <div id="slide-out" class="side-nav fixed bg-img">
    <ul class="custom-scrollbar">
      <!-- Logo -->
      <li>
        <div class="logo-wrapper sn-ad-avatar-wrapper center">
          <div style="padding: 10px;"></div>
          <span>PSU</span></a>
        </div>
      </li>
      <!--/. Logo -->
      <!-- Side navigation links -->
      <li>
        <ul class="collapsible collapsible-accordion">
          <div style="padding: 20px;"></div>
          <li><a class="collapsible-header waves-effect arrow-r active">
              หน้าหลัก<i class="fas fa-angle-down rotate-icon"></i></a>
            <div class="collapsible-body">
            </div>
          </li>


          <?php
         if (empty($_SESSION['role']) || $_SESSION['role'] == "user" || $_SESSION['role'] == "staff" || $_SESSION['role'] == "admin")
         {
            echo '<li><a class="collapsible-header waves-effect arrow-r">
                      รายชื่อโครงการทั้งหมด<i class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li><a href="#" class="waves-effect">
                            <span class="sv-slim"> FB </span>
                            <span class="sv-normal">For bloggers</span></a>
                        </li>
                        <li><a href="#" class="waves-effect">
                            <span class="sv-slim"> FA </span>
                            <span class="sv-normal">For authors</span></a>
                        </li>
                      </ul>
                    </div>
                  </li>

                  <li><a class="collapsible-header waves-effect arrow-r">
                      ขั้นตอนสมัครฝึกอบรม<i class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                    </div>
                  </li>

                  <li><a class="collapsible-header waves-effect arrow-r">
                      ช่องทางการติดต่อ<i class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                      <ul>
                        <li>
                          <a href="#" class="waves-effect">
                            <span class="sv-slim"> F </span>
                            <span class="sv-normal">FAQ</span>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="waves-effect">
                            <span class="sv-slim"> W </span>
                            <span class="sv-normal">Write a message</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>';

         }
           
         if(!empty($_SESSION['role']) && ($_SESSION['role'] == "staff" || $_SESSION['role'] == "admin")){
          echo ' <li><a class="collapsible-header waves-effect arrow-r">
                จัดการโครงการ<i class="fas fa-angle-down rotate-icon"></i></a>
                  <div class="collapsible-body">
                  </div>
                </li>';
              }
     
          if(!empty($_SESSION['role']) && $_SESSION['role'] == "admin" ){
              echo '<li><a class="collapsible-header waves-effect arrow-r">
                    คำร้องขอการสมัคร<i class="fas fa-angle-down rotate-icon"></i></a>
                  <div class="collapsible-body">
                  </div>
                </li>
      
                <li><a class="collapsible-header waves-effect arrow-r"><i class="sv-slim-icon fas fa-eye"></i>
                    Report โครงการ</a>
                  <div class="collapsible-body">
                  </div>
                </li>';
                }
          
?>

        </ul>
      </li>
      <!--/. Side navigation links -->
    </ul>
    <div class="sidenav-bg rgba-blue-strong"></div>
  </div>
  <!--/. Sidebar navigation -->





  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
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