<?php
 session_start();
 $servername = 'localhost';
 $username = 'root';
 $password = '';
 $dbname = 'kids_welfare';

 // Attempt MySQL server connection
 $conn = mysqli_connect($servername, $username, $password, $dbname);

 // Check connection
 if (!$conn) {
    die('Could not connect to MySQL server: ' . mysqli_connect_error());
  }
  
?>