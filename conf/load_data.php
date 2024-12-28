<?php
include "koneksi.php";

$sql = mysqli_query($conn, "SELECT * FROM tb_control");
$data = mysqli_fetch_array($sql);
$response = [
    'jemur' => $data['jemur'],
    'posisi' => $data['posisi'],
    'posisiTutup' => $data['posisiTutup'],
    'mode' => $data['mode'],
    'cuaca' => $data['cuaca'],
    'hujan' => $data['hujan'],
    'cahaya' => $data['cahaya'],
    
];

echo json_encode($response);
?>
