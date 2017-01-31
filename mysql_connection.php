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

// New connection code using PDO object
// Original connection.php script found here:
//http://thisinterestsme.com/php-user-registration-form/

/**
 * This script connects to MySQL using the PDO object.
 * This can be included in web pages where a database connection is needed.
 * Customize these to match your MySQL database connection details.
 * This info should be available from within your hosting panel.
 */

//User account info below will need to be changed

//Our MySQL user account.
define('MYSQL_USER', 'root');

//Our MySQL password.
define('MYSQL_PASSWORD', 'MyPass2016');

//The server that MySQL is located on.
define('MYSQL_HOST', 'localhost');

//The name of our database.
define('MYSQL_DATABASE', 'test');

/**
 * PDO options / configuration details.
 * I'm going to set the error mode to "Exceptions".
 * I'm also going to turn off emulated prepared statements.
 */
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

/**
 * Connect to MySQL and instantiate the PDO object.
 */
$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    $pdoOptions //Options
);

//The PDO object can now be used to query MySQL.

?>
