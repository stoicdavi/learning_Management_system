<?php
$host = 'localhost';
$dbname = 'school';
$username ='root';
$password = 'your database password';

$conn =  new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die('Database connection error: ' . $conn->connect_error);
}