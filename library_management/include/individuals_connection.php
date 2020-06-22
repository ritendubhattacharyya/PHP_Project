<?php

$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "library_individuals";

$conn_individuals = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if(!$conn_individuals) {
    die("Connection Error: ".mysqli_connect_error);
}