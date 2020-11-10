<?php ob_start();?>
<?php 
   $conn = new mysqli('localhost','root','','basic');

   if($conn->connect_errno){
       die("Connection Filed". $conn->connect_error);
   }
   
?>