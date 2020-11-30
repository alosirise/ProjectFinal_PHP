<?php ob_start();?>
<?php 
  $conn = ftp_connect('ftp.chochiang.com','clt2_as@chochiang.com','mmy91ezUZ','basic');
//   $conn = new mysqli('localhost','root','','basic');
  mysqli_query($conn,"set character set utf8");
//   if($conn->connect_errno){
//       die("Connection Filed". $conn->connect_error);
//   }
   
?>