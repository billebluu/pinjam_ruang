<?php
    require 'functions.php';
    $id = $_GET["id"];
   //query data mahasiswa berdasar id
    $data = "SELECT * FROM admin WHERE id = $id";
    $user = query($data)[0];
    $data_pengajuan = query("SELECT * FROM data_pengajuan WHERE id_ajuan=$id")[0];
    
    if(validasiTolak($id)){
        echo"
        <script>
        window.location.href = 'admin-data-pengajuan.php?id=$id';
        </script>";
    }else{
       
    }
?>