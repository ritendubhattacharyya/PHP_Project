<?php 

$DB_SERVER = "localhost";
$DB_USER = "root";
$DB_PWD = "";
$DB_NAME = "library_user";

$conn = mysqli_connect($DB_SERVER, $DB_USER, $DB_PWD, $DB_NAME);
if(!$conn) {
    die("Connection Error: ".mysqli_connect_error);
}