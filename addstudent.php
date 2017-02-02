<?php

  session_start();

 if(isset($_SESSION['username'])){

  include('mysql_connection.php');


   $student_id = $_SESSION['student_id'];
    // trims any blank spaces and get the username and password
   $clicked_id = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['name']);


   $addquery=$conn->prepare("INSERT INTO student_meetings (student_id,meeting_id) VALUES(:value1,:value2)");
   $addquery->bind_param(':value1',$student_id,PDO::PARAM_INT);
   $addquery->bind_param(':value2',$clicked_id,PDO::PARAM_INT);
   $addquery->execute();
   $addquery->close();

   echo "You have been added to the meeting.";


 } else{
     echo "Please LOGIN to add.";


 }

?>
