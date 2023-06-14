<?php
$nama_pengaju = $_POST['nama_pengaju'];
$nama_ruang = $_POST['nama_ruang'];
$gender = $_POST['gender'];
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];
$waktu = $_POST['waktu'];
$statusUser = $_POST['statusUser'];
$kegiatan = $_POST['kegiatan'];
$waktu = $_POST['waktu'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$namaFile1 = $_FILES['sik']['name'];
$namaFile2= $_FILES['ktm']['name'];
$x1 = explode('.', $namaFile1);
$x2 = explode('.', $namaFile2);

$ekstensiFile1 = strtolower(end($x1));
$ekstensiFile2 = strtolower(end($x2));

$ukuranFile1	= $_FILES['sik'];
$ukuranFile2	= $_FILES['ktm'];

$file_tmp1 = $_FILES['sik']['tmp_name1'];
$file_tmp2 = $_FILES['ktm']['tmp_name2'];


// Lokasi Penempatan file
$dirUpload1 = "file/";
$dirUpload2 = "file2/";

$linkBerkas1 = $dirUpload1.$namaFile1;
$linkBerkas2 = $dirUpload2.$namaFile2;


// Menyimpan file
$terupload1 = move_uploaded_file($file_tmp1, $linkBerkas1);
$terupload2 = move_uploaded_file($file_tmp2, $linkBerkas2);

$dataArr = array(
    'nama_pengaju' => $nama_pengaju, 
    'nama_ruang' => $nama_ruang,
    'gender' => $gender, 
    'tgl_awal' => $tgl_awal, 
    'tgl_akhir' => $tgl_akhir,
    'waktu' => $waktu, 
    'email' => $email, 
    'statusUser' => $statusUser, 
    'kegiatan' => $kegiatan, 
    'phone' => $phone, 
    'ktm' => $linkBerkas1, 
    'sik' => $linkBerkas2, 

);

if ($terupload1 && (insertData($dataArr) == 1)) {
    echo "Upload berhasil!";
    header("Location: user-home.php", true, 301);
    exit();
} else {
    echo "Upload Gagal!";
    header("Location: user-pinjam-ruang.php", true, 301);
    exit();
}

if ($terupload2 && (insertData($dataArr) == 1)) {
    echo "Upload berhasil!";
    header("Location: user-home.php", true, 301);
    exit();
} else {
    echo "Upload Gagal!";
    header("Location: user-pinjam-ruang  .php", true, 301);
    exit();
}

?>