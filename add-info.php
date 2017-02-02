<?php

if(isset($_POST['add-info'])){

  include ('mysql_connection.php');
  session_start();
  $club_id = trim($_SESSION['club_id']);
  $eventdate = trim($_POST['eventdate']);
  $eventtime = trim($_POST['eventtime']);
  $room_no = filter_var($_POST['room_no'], FILTER_SANITIZE_STRING);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

   $stmt=$conn->prepare("INSERT INTO club_meetings (club_id,date,time,room_no,description) VALUES(:v1,:v2,:v3,:v4,:v5)");
   $stmt->bindParam(':v1',$club_id,PDO::PARAM_INT);
   $stmt->bindParam(':v2',$eventdate);
   $stmt->bindParam(':v3',$eventtime);
   $stmt->bindParam(':v4',$room_no);
   $stmt->bindParam(':v5',$description);


        if($stmt->execute()){
          header("Location: club_admin_page.php");
        }

  echo "<html><h1>"; echo $eventdate; echo "</h1></html>";

  echo "<html><h1>"; echo $eventtime; echo "</h1></html>";
}


?>
