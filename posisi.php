<?php 
    include "koneksi.php";

    $pos = $_GET['pos'];
    mysqli_query($conn, "UPDATE tb_control set posisi='$pos'");
    echo $pos;
?>