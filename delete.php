<?php
    require 'functions.php';

    $id = $_GET["id"];

    //tombol submit sudah ditekan atau belum
    if(deleteData($id) > 0){
        echo "<script>
        alert('Hapus Data Sukses!');
        window.location.href = 'view.php';
        </script>";
    }else{
        echo "<script>
        alert('Hapus Data Gagal!');
        </script>";
    }
?>