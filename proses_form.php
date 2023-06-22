<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
$id = $_GET["id"];
$data = "SELECT * FROM user WHERE id = $id";
$user = query($data)[0];

$data2 = query("SELECT * FROM data_ruangan");

$showSucces = true;
$showDanger = true;
$showSubmit;

if (isset($_POST["submit"])) {
  // Mendapatkan data dari form
  $tanggal = $_POST["tanggal"];
  $nama_ruang = $_POST["nama_ruang"];
  $waktu_awal = $_POST["waktu_awal"];
  $waktu_akhir = $_POST["waktu_akhir"];

  // Memeriksa apakah data jadwal ruangan sudah ada
  $query_check = "SELECT COUNT(*) FROM data_jadwal WHERE tanggal = '$tanggal' AND nama_ruang = '$nama_ruang' AND waktu_awal = '$waktu_awal' AND waktu_akhir = '$waktu_akhir'";
  $result_check = mysqli_query($conn, $query_check);
  $count = mysqli_fetch_row($result_check)[0];

  // Jika data pengajuan yang sama sudah ada, tampilkan pesan error
  if ($count > 0) {
    $showSubmit = 2; //tambahan
    $response = array(
      "showAlert" => true,
      "alertType" => "danger",
      "alertMessage" => "Ruang yang Anda pilih pada waktu tersebut sudah terisi. Silakan pilih ruangan lain!"
    );
  } else {
    $showSubmit = 0; // Inisialisasi.
  }
}
  ?>