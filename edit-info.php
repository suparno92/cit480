<?php

if(isset($_POST['edit-info'])){
  include ('mysql_connection.php');
  session_start();
  $club_id = trim($_SESSION['club_id']);
  $eventdate = trim($_POST['eventdate']);
  $edit_id = trim($_POST['edit_id']);
  $eventtime = trim($_POST['eventtime']);
  $room_no = trim($_POST['room_no']);
  $description = trim($_POST['description']);

/*  $stmt="INSERT INTO club_meetings (club_id,date,time,room_no,description) VALUES('$club_id','$eventdate','$eventtime','$room_no','$description')";*/
 $query = "UPDATE club_meetings SET date = '$eventdate',
                                                time = '$eventime',
                                                room_no = '$room_no',
                                                description = '$description'
                                            WHERE club_id = '$club_id' AND meeting_id = '$edit_id' ";

      if($conn->query($query) === TRUE ){
      
        $conn->close();
        header("Location: club_admin_page.php");
      }

}


?>
