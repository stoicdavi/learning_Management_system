<?php
$host = 'localhost';
$dbname = 'school';
$username ='root';
$password = '1234218@Nanjila22';

$conn =  new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die('Database connection error: ' . $conn->connect_error);
}
