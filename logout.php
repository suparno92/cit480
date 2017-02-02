<?php
   session_start();
   include('mysql_connection.php');

   if(isset($_SESSION['username'])){

       session_unset();
       session_destroy();
       $conn = null;

       echo 'Logout successfull! page is redirecting, please wait...';
       header('Refresh: 1; URL = index.php');
 }
?>
