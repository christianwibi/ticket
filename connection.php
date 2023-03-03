<?php
$databaseHost = 'localhost';
$databaseName = 'db_detikcom';
$databaseUsername = 'root';
$databasePassword = '';
 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
if ($mysqli->connect_errno) {
    die("Koneksi ke database gagal!");
}


?>