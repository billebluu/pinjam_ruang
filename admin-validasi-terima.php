<?php
    require 'functions.php';
    $id = $_GET["id"];
   //query data mahasiswa berdasar id
    $data = "SELECT * FROM data_pengajuan WHERE id = $id";
    $user = query($data)[0];
    $data_pengajuan = query("SELECT * FROM data_pengajuan WHERE id=$id")[0];


    if(validasiTerima($id)){
        echo"
        <script>
            window.location.href = 'admin-data-pengajuan.php?id=$id';
        </script>";
    }else{
       
    }
?>