<?php
require 'functions.php';
$id = $_GET["id"];

// Query data barang berdasarkan id
$data = query("SELECT sik FROM data_pengajuan WHERE id=$id");
$file = $data[0]['sik'];
$file2 = $file . ".pdf";

header("Content-Disposition: attachment; filename=" . urlencode($file2));

$fb = fopen($file2, "r");

// Mengirim file ke pengguna
while (!feof($fb)) {
   echo fread($fb, 8192);
}

fclose($fb);
exit();
?>