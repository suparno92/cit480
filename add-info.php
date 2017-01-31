<?php

if(isset($_POST['add-info'])){

  include ('mysql_connection.php');
  session_start();
  $club_id = trim($_SESSION['club_id']);
  $eventdate = trim($_POST['eventdate']);
  $eventtime = trim($_POST['eventtime']);
  $room_no = trim($_POST['room_no']);
  $description = trim($_POST['description']);

   $stmt=$conn->prepare("INSERT INTO club_meetings (club_id,date,time,room_no,description) VALUES(?,?,?,?,?)");
   $stmt->bind_param('issss',$club_id,$eventdate,$eventtime,$room_no,$description);

        if($stmt->execute()){
          $stmt->close();
          $conn->close();
          header("Location: club_admin_page.php");
        }

  echo "<html><h1>"; echo $eventdate; echo "</h1></html>";

  echo "<html><h1>"; echo $eventtime; echo "</h1></html>";
}


?>
