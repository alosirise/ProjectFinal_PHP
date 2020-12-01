<?php ob_start();?>
<?php 


  // $conn =  ftp_connect('ftp.chochiang.com','clt2_as@chochiang.com','mmy91ezUZ','basic');


$conn = new mysqli('localhost','chinyhot','CX1f!1EwW2c6#g','chinyhot_as');



// $server = 'ftp.chochiang.com';
// $user = 'clt2_as@chochiang.com';
// $pass = 'mmy91ezUZ';

// $conn = ftp_connect($server) or die('Could not connect to FTP-server.');


// if($conn){
//   // login with username and password
//   $login_result = ftp_login($conn, $user, $pass ,'chinyhot_as');
//   echo 'Connected to FTP-server.';
// }






  // $conn = new mysqli('localhost','root','','basic');
  mysqli_query($conn,"set character set utf8");
  
  if($conn->connect_errno){
      die("Connection Filed". $conn->connect_error);
  }
   
?>