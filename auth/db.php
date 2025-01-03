<?php
session_start();

$host = "mysql.db.mdbgo.com";
$user = "kepo_iotuser";
$password = "Control123_";
$database = "kepo_dbcontrol";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
