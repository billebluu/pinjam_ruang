<?php
    require 'functions.php';

    $id = $_GET["id"];

    //tombol submit sudah ditekan atau belum
    if(hapusLaporan($id) > 0){
        echo "<script>
        window.location.href = 'admin-data-laporan-pinjam.php?id=$id';
        </script>";
    }
?>