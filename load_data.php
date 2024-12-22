<?php
include "koneksi.php";

$sql = mysqli_query($conn, "SELECT * FROM tb_control");
$data = mysqli_fetch_array($sql);
$response = [
    'jemur' => $data['jemur'],
    'posisi' => $data['posisi'],
    'mode' => $data['mode']
];

echo json_encode($response);
?>
