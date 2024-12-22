<?php 
    include "koneksi.php";

    $stat = $_GET['stat'];
    if ($stat == 'Buka'){
        mysqli_query($conn, "UPDATE tb_control set jemur=1");
        echo "Buka Jemuran";
    }else {
        mysqli_query($conn, "UPDATE tb_control set jemur=0");
        echo "Tutup Jemuran";
    }
?>