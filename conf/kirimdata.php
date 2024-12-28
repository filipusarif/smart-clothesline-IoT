<?php 
include "koneksi.php";


$jemur = $_GET['jemur'];
$posisi = $_GET['posisi'];
$posisiTutup = $_GET['posisiTutup'];
$mode = $_GET['mode'];
$cuaca = $_GET['cuaca'];
$hujan = $_GET['hujan'];
$cahaya = $_GET['cahaya'];



mysqli_query($conn, "UPDATE tb_control set jemur='$jemur', posisi='$posisi',posisiTutup='$posisiTutup', mode='$mode', cuaca='$cuaca', hujan='$hujan', cahaya='$cahaya'");
?>