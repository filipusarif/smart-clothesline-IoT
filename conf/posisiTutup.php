<?php 
    include "koneksi.php";

    $pos = $_GET['pos'];
    mysqli_query($conn, "UPDATE tb_control set posisiTutup='$pos'");
    echo $pos;
?>