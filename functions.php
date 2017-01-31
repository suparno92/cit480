<?php

  function getcomputer() {

  include('mysql_connection.php');

    $query2 = "SELECT club_id,club_name FROM club";
    if ($result=mysqli_query($conn,$query2))
       {
       // Fetch one and one row
       while ($row=mysqli_fetch_row($result))
         {
         echo "<tr>";
         echo "<td id='$row[0]'>";
         echo $row[1];
         echo "</td>";
         echo "</tr>";

        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);

  }




 ?>
