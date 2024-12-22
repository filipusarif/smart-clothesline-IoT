<?php 
    include "koneksi.php";

    $mode = $_GET['mode'];
    if ($mode == 'Otomatis'){
        mysqli_query($conn, "UPDATE tb_control set mode=1");
        echo "Otomatis";
    }else {
        mysqli_query($conn, "UPDATE tb_control set mode=0");
        echo "Manual";
    }
?>