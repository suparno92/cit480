<?php
// Original Code Commented out
//---------------------------------------------------------------
/*
$DB_USER = 'root';
$DB_PASSWORD = 'MyPass2016';
$DB_HOST = 'localhost';
$DB_NAME = 'test';

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);


// prints message only if the connection has no error
  if(!$conn){

      die('connection error: ' . mysqli_connect_error());

    }
*/

//---------------------------------------------------------------
// I decided to go with a version from w3schools because it seems
// quite readable.
//---------------------------------------------------------------

// New connection code using PDO object

$servername = "localhost";
$username = "username";
$password = "password";

try {
    $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
  
