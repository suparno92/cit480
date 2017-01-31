<?php

  include('mysql_connection.php');

    // trims any blank spaces and get the username and password
   $username = trim($_POST['username']);
   $password = trim($_POST['password']);

  // Checks if the form value is null or empty
    if($username == '' || $password == ''){

      mysqli_close($conn);
      die("Error. One of the field is empty.");

    } else{

    $query = "SELECT pass,club_id FROM user WHERE name='$username'";
    $response = mysqli_query($conn,$query);


    //check if username exists.
    if(mysqli_num_rows($response) == 1){

      $row = mysqli_fetch_assoc($response);

      $getpass= $row['pass'];
      $getclubid = $row['club_id'];

      //1st generate a new hash using the given password and the salt (from the user database)
      //then checks the new hash with the hash stored in the database. If true, then password matches.
          if ($getpass == $password){
                  ob_start();
                  session_start();
                  $_SESSION['valid'] = true;
              //    $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $username;
                  $_SESSION['club_id'] = $getclubid;
                  header("Location: club_admin_page.php");
                  exit();

          // table query for the admin's club
          //  $query = "SELECT * FROM club_meetings WHERE club_id='$getclubid'";




          }else{
            echo "
            <html>
            <h1> Login Failed. Wrong password. </h1>
            </html>
            ";
          }



    }
    //if not user is found
      else {
        echo "
        <html>
        <h1> No Record found. </h1>
        </html>
        ";
      }
    }



?>
