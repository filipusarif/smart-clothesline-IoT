<?php 
    include "koneksi.php";

    $stat = $_GET['stat'];

    // Ambil data sebelumnya dari database
    $result = mysqli_query($conn, "SELECT * FROM tb_control LIMIT 1");
    $data = mysqli_fetch_assoc($result);

    if ($stat == 'Buka'){
        mysqli_query($conn, "UPDATE tb_control set jemur=1");
        
        // Insert data ke tabel riwayat
        $posisi = $data['posisi'];
        $posisiTutup = $data['posisiTutup'];
        $mode = $data['mode'];
        $cuaca = $data['cuaca'];
        $hujan = $data['hujan'];
        $cahaya = $data['cahaya'];
        $jemur = 1; // Karena sedang diubah ke Buka

        mysqli_query($conn, "INSERT INTO tb_riwayat (jemur, posisi, posisiTutup, mode, cuaca, hujan, cahaya) 
                            VALUES ('$jemur', '$posisi', '$posisiTutup', '$mode', '$cuaca', '$hujan', '$cahaya')");


        echo "Buka Jemuran";
    }else {
        mysqli_query($conn, "UPDATE tb_control set jemur=0");
         // Insert data ke tabel riwayat
        $posisi = $data['posisi'];
        $posisiTutup = $data['posisiTutup'];
        $mode = $data['mode'];
        $cuaca = $data['cuaca'];
        $hujan = $data['hujan'];
        $cahaya = $data['cahaya'];
        $jemur = 0; // Karena sedang diubah ke Tutup

        mysqli_query($conn, "INSERT INTO tb_riwayat (jemur, posisi, posisiTutup, mode, cuaca, hujan, cahaya) 
                            VALUES ('$jemur', '$posisi', '$posisiTutup', '$mode', '$cuaca', '$hujan', '$cahaya')");

        echo "Tutup Jemuran";
    }
?>