<?php
    require 'functions.php';

    $id = $_GET["id"];

    //tombol submit sudah ditekan atau belum
    if(hapusRuang($id) > 0){
        echo "<script>
        window.location.href = 'admin-data-ruang.php?id=$id';
        </script>";
    }
?>