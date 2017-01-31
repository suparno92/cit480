<?php

  session_start();

 if(isset($_SESSION['username'])){

  include('mysql_connection.php');


   $student_id = $_SESSION['student_id'];
    // trims any blank spaces and get the username and password
   $clicked_id = trim($_POST['name']);


   $addquery=$conn->prepare("INSERT INTO student_meetings (student_id,meeting_id) VALUES(?,?)");
   $addquery->bind_param('ii',$student_id,$clicked_id);
   $addquery->execute();
   $addquery->close();

   echo "You have been added to the meeting.";


 } else{
     echo "Please LOGIN to add.";


 }

?>
