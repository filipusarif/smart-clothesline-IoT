<?php 
include "koneksi.php";


$jemur = $_GET['jemur'];
$posisi = $_GET['posisi'];
$mode = $_GET['mode'];

mysqli_query($conn, "UPDATE tb_control set jemur='$jemur', posisi='$posisi', mode='$mode'");
?>