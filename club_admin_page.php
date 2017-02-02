<!doctype html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">


   <script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>


   <script type="text/javascript">


        function delete_click(obj){

          var id = obj.id;
          //  alert("the id sis " + obj.id);
          var txt;
          var formData = {delete_id : id};
          var user_response = window.confirm("Are you sure you want to remove this? " + id );

          if (user_response == true) {

          /* returns a Window.alert box after adding to database*/
            $.ajax({
                 type: "post",
                 url: "club_admin_page.php",
                 data: formData,
                 success: function (response) {
                    if(!response.error) location.reload(true);
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                 }

               });
           }
        }


  </script>


<?php
   include('mysql_connection.php');
    session_start();


   if(isset($_SESSION['username']))
   {
       echo ' <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
              <link rel="stylesheet" href="css/club_admin_page.css">';
       echo"<title>"; echo $_SESSION['username']; echo"</title>";


   	if(isset($_POST['delete_id']))
         {

          $delete_id = preg_replace("/[^0-9]/", "", $_POST['delete_id']);
          $club_id = preg_replace("/[^0-9]/", "", $_SESSION['club_id']);

          $deletequery=$conn->prepare("DELETE FROM club_meetings WHERE meeting_id= :value1 and club_id= :value2");
          $deletequery->bindParam(':value1',  $delete_id, PDO::PARAM_INT);
          $deletequery->bindParam(':value2', $club_id, PDO::PARAM_INT);
          $deletequery->execute();

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


	    $listquery = $conn->prepare("SELECT meeting_id,date,time,room_no,description FROM club_meetings WHERE club_id= :value1");
            $listquery->bindParam(':value1', $_SESSION['club_id'], PDO::PARAM_INT);
            $listquery->execute();
            $listquery->setFetchMode(PDO::FETCH_ASSOC);

							 #Fetch one row of data at a time
		while ($row = $listquery->fetch(PDO::FETCH_ASSOC))
		 {
		  echo '<tr>';

                  echo '<td>';
		  echo $row['date'];

		  echo '</td>';

		  echo '<td>';

		  echo $row['time'];

		  echo '</td>';

		  echo '<td>';

		  echo $row['room_no'];

	          echo '</td>';

		  echo '<td>';

		  echo $row['description'];

		  echo '</td>';
                  echo '<td>';
                  echo '<div class="w3-container" id="'; echo $row['meeting_id']; echo '"><p><button onclick="edit_click(this)" class="w3-btn">edit</button></p></div>';

                  echo '</td><td>';
                  echo '<div class="w3-container"><p><button onclick="delete_click(this)" id="'; echo $row['meeting_id']; echo'" class="w3-btn">remove</button></p></div>';
                  echo '</td></tr>';

		  }
                echo '</table>';
                echo '</div>';

        # This one below is not PDO....I'll change it soon
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
