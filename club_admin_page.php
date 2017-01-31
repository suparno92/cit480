<!doctype html>
 <html>
 <head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<?php
   include('mysql_connection.php');
    session_start();


   if(isset($_SESSION['username']))
   {
       echo ' <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
              <link rel="stylesheet" href="club_admin_page.css">';
       echo"<title>"; echo $_SESSION['username']; echo"</title>";


  		   if(isset($_GET['delete_id']) && is_numeric($_GET['delete_id']))
    		 {

    			$delete_id = trim($_GET['delete_id']);
          $club_id = trim($_SESSION['club_id']);
    		  $sqlq="DELETE FROM club_meetings WHERE meeting_id='$delete_id' and club_id='$club_id'";



            if(mysqli_query($conn,$sqlq)){


            	header("Refresh:0; url=club_admin_page.php");

    				}

    		 }



  		echo '

  			<title>Login</title>

      		</head>

      			<!-- Main HTML -->
            <header id="topnav">
               <div id="topnav-inside">
                 <div id="topnav-left">

                 </div>
                 <div id="topnav-right">

                   <h2><a href="logout.php">Logout</a></h2>
                 </div>
               </div>
            </header>

      		<body>
          <meta charset="UTF-8">

      			<!-- Begin Page Content -->
            <div id="container-body">

      			<div id="container">



            <table>
              <tr>
                <th>Event Date</th>
                <th>Event Time</th>
                <th>Room no</th>
                <th width="50%">Event Description</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>';


            $tempid = trim($_SESSION['club_id']);

						$query2 = "SELECT meeting_id,date,time,room_no,description FROM club_meetings WHERE club_id='$tempid'";
						if ($result=mysqli_query($conn,$query2))
							 {
							 // Fetch one and one row
							 while ($row=mysqli_fetch_row($result))
								 {
									 echo '<tr>';

                   echo '<td>';
									 echo $row[1];

									 echo '</td>';

									 echo '<td>';

									 echo $row[2];

									 echo '</td>';

									 echo '<td>';

									 echo $row[3];

									 echo '</td>';

									 echo '<td>';

									 echo $row[4];

									 echo '</td>';
                   echo '<td>';
                    echo '<a href="club_admin_page.php?edit_id='; echo $row[0]; echo'"><center><li class="glyphicon glyphicon-pencil" id="icon" ></li></center>';

                    echo '</td>';
                    echo '<td><a href="club_admin_page.php?delete_id='; echo $row[0]; echo'"><center><li class="glyphicon glyphicon-trash" id="icon" ></li></center></a></td>';

									 echo '</tr>';

								 }
                       echo '</table>';
                       echo '</div>';
							 // Free result set
							 mysqli_free_result($result);
							}

          if(isset($_GET['edit_id']) && is_numeric($_GET['edit_id']))
           {
            $edit_id = trim($_GET['edit_id']);
            $club_id = trim($_SESSION['club_id']);

            $result = $conn->query("SELECT meeting_id,date,time,room_no,description FROM club_meetings WHERE meeting_id='$edit_id' and club_id='$club_id'");

                if($result->num_rows > 0){
                  $data = $result->fetch_assoc();
                  echo '
                  <div id="container2">
                    <form action="edit-info.php" method="post">
                      Event Date:<br>
                      <input type="date" name="eventdate" value="'; echo $data['date']; echo '">
                      <br><br>
                      Event Time:<br>
                      <input type="Time" name="eventtime" value="'; echo $data['time']; echo '">
                      <br><br>
                      Room no.:<br>
                      <input type="text" name="room_no" value="'; echo $data['room_no']; echo '">
                      <br><br>
                      Event Description:<br>
                      <textarea rows="5" cols="34" name="description" value="'; echo $data['description']; echo '"> </textarea>
                      <br><br>
                      <input type="hidden" name="edit_id" value="'; echo $edit_id; echo '">
                      <input type="submit" name="edit-info" value="Edit Info">
                    </form>
                  </div>
                  </body>
                  </html>';

                } else { header("Refresh:0; url=club_admin_page.php"); }



           } else{


				echo '



					<div id="container2">
            <form action="add-info.php" method="post">
              Event Date:<br>
              <input type="date" name="eventdate" >
              <br><br>
              Event Time:<br>
              <input type="Time" name="eventtime" >
              <br><br>
              Room no.:<br>
              <input type="text" name="room_no" >
              <br><br>
              Event Description:<br>
              <textarea rows="5" cols="34" name="description" > </textarea>
              <br><br>
              <input type="submit" name="add-info" value="Add Info">
            </form>



					</div>





		<!-- End Page Content -->

	</body>
	</html>';
  }
} else{ echo '<h1> Access Denied. Please Login.</h1> </head></html>';}
?>
