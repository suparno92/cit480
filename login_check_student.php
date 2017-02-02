<?php

  include('mysql_connection.php');

   #trims any blank spaces and get the username and password
   $username = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['username']);
   $password = trim($_POST['password']);

    #checks if the form value is null or empty
    if($username == '' || $password == ''){

      $conn = null;
      die("Error. One of the field is empty.");

    } else{
      $query = $conn->prepare('SELECT password,student_id FROM student WHERE username = :value');
      $query->bindParam(':value', $username, PDO::PARAM_STR);
      $query->execute();
      $query->setFetchMode(PDO::FETCH_ASSOC);


    //check if username exists.
    if($query->rowCount() == 1){

      $row = $query->fetch(PDO::FETCH_ASSOC);

      $getpass= $row['password'];
      $getstudentid = $row['student_id'];

      //1st generate a new hash using the given password and the salt (from the user database)
      //then checks the new hash with the hash stored in the database. If true, then password matches.
          if ($getpass == $password){
                  ob_start();
                  session_start();
                  $_SESSION['valid'] = true;
              //    $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $username;
                  $_SESSION['student_id'] = $getstudentid;
                  header("Location: index.php");
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
