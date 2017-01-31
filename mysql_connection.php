<?php

$DB_USER = 'root';
$DB_PASSWORD = 'MyPass2016';
$DB_HOST = 'localhost';
$DB_NAME = 'test';

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);


// prints message only if the connection has no error
  if(!$conn){

      die('connection error: ' . mysqli_connect_error());

    }

?>
