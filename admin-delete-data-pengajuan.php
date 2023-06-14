<?php
    require 'functions.php';

    $id = $_GET["id"];

    //tombol submit sudah ditekan atau belum
    if(hapusPengajuan($id) > 0){
        echo "<script>
        window.location.href = 'admin-data-pengajuan.php?id=$id';
        </script>";
    }
?>