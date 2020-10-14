<?php 
   $conn = new mysqli('localhost','root','','basic');
   mysqli_query($conn,"set character set utf8");
   if($conn->connect_errno){
       die("Connection Filed". $conn->connect_error);
   }
   
?>