<?php 
include "koneksi.php";

$sql = mysqli_query($conn, "SELECT * FROM tb_control");
$data =mysqli_fetch_array($sql);
$posisiTutup = $data['posisiTutup'];
echo $posisiTutup;

?>