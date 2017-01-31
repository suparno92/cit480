<?php


include('mysql_connection.php');

if($_POST['name']){

  $idpass = $_POST['name'];

      echo '<div class="info"><div id="infotop"></div><div>';
      $query2 = "SELECT date,time,description,meeting_id FROM club_meetings WHERE club_id ='$idpass'";
      if ($result=mysqli_query($conn,$query2))
         {
         // Fetch one and one row
         echo '<table>';
         echo '<tr id="tabletop">';
         echo "<td>";
         echo "Date";
         echo "</td>";
         echo "<td>";
         echo "Time";
         echo "</td>";
         echo "<td>";
         echo "Event Description";
         echo "</td>";
         echo "<td>";
         echo "Add";
         echo "</td>";
         echo "</tr>";
         while ($row=mysqli_fetch_row($result))
           {

           echo "<tr>";
           echo "<td>";
           echo $row[0];
           echo "</td>";
           echo "<td>";
           echo $row[1];
           echo "</td>";
           echo "<td>";
           echo $row[2];
           echo "</td>";
           echo "<td>";
           echo '<div class="w3-container" id="'; echo $row[3]; echo '"><p><button onclick="reply_click(this)" class="w3-btn">ADD</button></p></div>';
           echo "</td>";
           echo "</tr>";


          }
          echo "</table>";
          echo '</div></div>';
          mysqli_free_result($result);
      }
      mysqli_close($conn);

      }

      function getcontents2($idpass) {
      include('mysql_connection.php');


      $query2 = "SELECT date,time,description,meeting_id FROM club_meetings WHERE club_id ='$idpass'";
      if ($result=mysqli_query($conn,$query2))
         {
         // Fetch one and one row
         echo '<table>';
         echo '<tr id="tabletop">';
         echo "<td>";
         echo "Date";
         echo "</td>";
         echo "<td>";
         echo "Time";
         echo "</td>";
         echo "<td>";
         echo "Event Description";
         echo "</td>";
         echo "</tr>";
         while ($row=mysqli_fetch_row($result))
           {

           echo "<tr>";
           echo "<td>";
           echo $row[0];
           echo "</td>";
           echo "<td>";
           echo $row[1];
           echo "</td>";
           echo "<td>";
           echo $row[2];
           echo "</td>";
           echo "</tr>";


          }
          echo "</table>";
          mysqli_free_result($result);
      }
      mysqli_close($conn);











}




?>
