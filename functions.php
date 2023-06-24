<?php
    $conn = mysqli_connect("localhost", "root", "", "db_pinjamruang");

    function query($query)
    {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }


    //FUNCTION USER
    function ubahUser($data)
    {
        global $conn;

        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $phone = htmlspecialchars($data["phone"]);
        $nim_nip = htmlspecialchars($data["nim_nip"]);
        $gender = $data["gender"];
        $statusUser = $data["statusUser"];

        $query = "UPDATE user SET
        nama ='$nama',
        phone = '$phone',
        nim_nip = '$nim_nip',
        gender = '$gender',
        statusUser = '$statusUser'
        WHERE id=$id
        "; 

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapusUser($id)
    {
        global $conn;

        mysqli_query($conn, "DELETE FROM user WHERE id=$id");
        return mysqli_affected_rows($conn);
    }


    function inputUser($data){
        global $conn;

        $nama = $data["nama"];
        $statusUser = $data["statusUser"];
        $gender = $data["gender"];
        $phone = $data["phone"];
        $nim_nip = $data["nim_nip"];
        $email = stripslashes($data["email"]);
        $password = mysqli_real_escape_string($conn, $data["password"]);

        //cek email dah ada ato blm
        $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

        //tambahan
        if(mysqli_fetch_assoc($result)){
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('modalEmailIsUsed'));
                modal.show();
            });
            </script>";
            return false;
        }

        //encrypt password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //tambahkan user ke database
        mysqli_query($conn, "INSERT INTO user VALUES('','$email',
        '$password','$nama','$statusUser','$phone','$gender','$nim_nip')");
        
        return mysqli_affected_rows($conn);



    }

    function searchUser($keyword)
    {
        $query = "SELECT * FROM user WHERE
        nama LIKE '%$keyword%' OR
        statusUser LIKE '%$keyword%' OR
        gender LIKE '%$keyword%' OR
        phone LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        nim_nip LIKE '%$keyword%' 
        ";

        return query($query);
    }


    //FUNCTION RUANG
    function ubahRuang($data)
    {
        global $conn;

        $id = $data["id"];
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $kapasitas = htmlspecialchars($data["kapasitas"]);
        $fasilitas = htmlspecialchars($data["fasilitas"]);
        
        $query = "UPDATE data_ruangan SET
        nama_ruang ='$nama_ruang',
        kapasitas = '$kapasitas',
        fasilitas = '$fasilitas'
        WHERE id=$id
        "; 

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapusRuang($id)
    {
        global $conn;

        mysqli_query($conn, "DELETE FROM data_ruangan WHERE id=$id");
        return mysqli_affected_rows($conn);
    }


    function inputRuang($data){
        global $conn;

        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $kapasitas = htmlspecialchars($data["kapasitas"]);
        $fasilitas = htmlspecialchars($data["fasilitas"]);


        $query = "INSERT INTO data_ruangan VALUES ('','$nama_ruang','$kapasitas','$fasilitas')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function searchRuang($keyword)
    {
        $query = "SELECT * FROM data_ruangan WHERE
        nama_ruang LIKE '%$keyword%' OR
        kapasitas LIKE '%$keyword%' OR
        fasilitas LIKE '%$keyword%' 
        ";

        return query($query);
    }


    //FUNCTION PENGAJUAN
    function ubahPengajuan($data)
    {
        global $conn;

        $id = $data["id"];
        $nama_pengaju = htmlspecialchars($data["nama_pengaju"]);
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $waktu_awal = htmlspecialchars($data["waktu_awal"]);
        $status = htmlspecialchars($data["status"]);

        $berkasLama = $data["berkasLama"];

        //ada gambar yg diupload atau tidak
        if($_FILES['berkas']['error'] === 4){
            $berkas = $berkasLama;
        }else{
            $berkas = uploadBerkasPengajuan();
        }

        $query = "UPDATE data_pengajuan SET
        nama_pengaju ='$nama_pengaju',
        nama_ruang = '$nama_ruang',
        kegiatan = '$kegiatan',
        tanggal = '$tanggal',
        waktu_awal = '$waktu_awal',
        status = '$status',
        berkas = '$berkas'
        WHERE id=$id
        "; 

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapusPengajuan($id)
    {
        global $conn;

        mysqli_query($conn, "DELETE FROM data_pengajuan WHERE id=$id");
        return mysqli_affected_rows($conn);
    }


    function inputPengajuan($data, $id){
        global $conn;

        $nama_pengaju = htmlspecialchars($data["nama_pengaju"]);
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $email = htmlspecialchars($data["email"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $phone = htmlspecialchars($data["phone"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $nim_nip = htmlspecialchars($data["nim_nip"]);
        $waktu_awal = htmlspecialchars($data["waktu_awal"]);
        $waktu_akhir = htmlspecialchars($data["waktu_akhir"]);
        $status = "PENDING";

        $sik = upload2();
        if(!$sik){
            return false;
        }

        $query = "INSERT INTO data_pengajuan VALUES ('','$nama_pengaju','$nama_ruang','$email','$kegiatan','$phone','$tanggal','$nim_nip','$waktu_awal','$waktu_akhir','$status','','','','$sik')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function uploadKtmPengajuan(){
        $namaFile = $_FILES['ktm']['nama'];
        $ukuranFile = $_FILES['ktm']['size'];
        $error = $_FILES['ktm']['error'];
        $namaFile = $_FILES['ktm']['nama'];
        $tmpName = $_FILES['ktm']['tmp_name'];

        //gambar diupload atau tidak
        if($error === 4){
            echo "<script>
            alert('Silakan Pilih Berkas Terlebih Dahulu!');
            </script>";
            return false;
        }

        //gambar yang diupload vallid atau tidak
        $ekstensiberkasValid = ['jpeg'];
        $ekstensiBerkas = explode('.', $namaFile);
        $ekstensiBerkas = strtolower(end($ekstensiBerkas));

        if(!in_array($ekstensiBerkas, $ekstensiberkasValid)){
            echo "<script>
            alert('File Berkas Tidak Sesuai!');
            </script>";
            return false;
        }

        //cek ukuran file
        if($ukuranFile > 100000000){
            echo "<script>
            alert('Ukuran Berkas Terlalu Besar!');
            </script>";
            return false;
        }

        //gambar siap upload
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .=  $ekstensiBerkas; 

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
        return $namaFileBaru;
    }

    function uploadSikPengajuan(){
        $namaFile = $_FILES['sik']['nama'];
        $ukuranFile = $_FILES['sik']['size'];
        $error = $_FILES['sik']['error'];
        $namaFile = $_FILES['sik']['nama'];
        $tmpName = $_FILES['sik']['tmp_name'];

        //gambar diupload atau tidak
        if($error === 4){
            echo "<script>
            alert('Silakan Pilih Berkas Terlebih Dahulu!');
            </script>";
            return false;
        }

        //gambar yang diupload vallid atau tidak
        $ekstensiberkasValid = ['jpeg'];
        $ekstensiBerkas = explode('.', $namaFile);
        $ekstensiBerkas = strtolower(end($ekstensiBerkas));

        if(!in_array($ekstensiBerkas, $ekstensiberkasValid)){
            echo "<script>
            alert('File Berkas Tidak Sesuai!');
            </script>";
            return false;
        }

        //cek ukuran file
        if($ukuranFile > 100000000){
            echo "<script>
            alert('Ukuran Berkas Terlalu Besar!');
            </script>";
            return false;
        }

        //gambar siap upload
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .=  $ekstensiBerkas; 

        move_uploaded_file($tmpName, 'img2/' . $namaFileBaru);
        return $namaFileBaru;
    }

    function searchPengajuan($keyword)
    {
        $query = "SELECT * FROM data_pengajuan WHERE
        nama_pengaju LIKE '%$keyword%' OR
        nama_ruang LIKE '%$keyword%' OR
        kegiatan LIKE '%$keyword%' OR
        tanggal LIKE '%$keyword%' OR
        waktu_awal LIKE '%$keyword%' OR
        status LIKE '%$keyword%' 
        ";

        return query($query);
    }


    //FUNCTION LAPORAN
    function ubahLaporan($data)
    {
        global $conn;

        $id = $data["id"];
        $nama_pengaju = htmlspecialchars($data["nama_pengaju"]);
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $waktu_awal = htmlspecialchars($data["waktu_awal"]);

        $berkasLama = $data["berkasLama"];

        //ada gambar yg diupload atau tidak
        if($_FILES['berkas']['error'] === 4){
            $berkas = $berkasLama;
        }else{
            $berkas = uploadBerkasLaporan();
        }

        $query = "UPDATE data_laporan SET
        nama_pengaju ='$nama_pengaju',
        nama_ruang = '$nama_ruang',
        kegiatan = '$kegiatan',
        tanggal = '$tanggal',
        waktu_awal = '$waktu_awal',
        berkas = '$berkas'
        WHERE id=$id
        "; 

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapusLaporan($id)
    {
        global $conn;

        mysqli_query($conn, "DELETE FROM data_laporan WHERE id=$id");
        return mysqli_affected_rows($conn);
    }


    function inputLaporan($data){
        global $conn;

        $nama_pengaju = htmlspecialchars($data["nama_pengaju"]);
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $waktu_awal = htmlspecialchars($data["waktu_awal"]);
        $berkas = htmlspecialchars($data["berkas"]);


        $berkas = uploadBerkasLaporan();
        if(!$berkas){
            return false;
        }
        $query = "INSERT INTO data_laporan VALUES ('','$nama_pengaju','$nama_ruang','$kegiatan','$tanggal','$waktu_awal','$berkas')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function uploadBerkasLaporan(){
        $namaFile = $_FILES['berkas']['name'];
        $ukuranFile = $_FILES['berkas']['size'];
        $error = $_FILES['berkas']['error'];
        $namaFile = $_FILES['berkas']['name'];
        $tmpName = $_FILES['berkas']['tmp_name'];

        //gambar diupload atau tidak
        if($error === 4){
            echo "<script>
            alert('Silakan Pilih Berkas Terlebih Dahulu!');
            </script>";
            return false;
        }

        //gambar yang diupload vallid atau tidak
        $ekstensiberkasValid = ['pdf'];
        $ekstensiBerkas = explode('.', $namaFile);
        $ekstensiBerkas = strtolower(end($ekstensiBerkas));

        if(!in_array($ekstensiBerkas, $ekstensiberkasValid)){
            echo "<script>
            alert('File Berkas Tidak Sesuai!');
            </script>";
            return false;
        }

        //cek ukuran file
        if($ukuranFile > 100000000){
            echo "<script>
            alert('Ukuran Berkas Terlalu Besar!');
            </script>";
            return false;
        }

        //gambar siap upload
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .=  $ekstensiBerkas; 

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
        return $namaFileBaru;
    }

    function searchLaporan($keyword)
    {
        $query = "SELECT * FROM data_laporan WHERE
        nama_pengaju LIKE '%$keyword%' OR
        nama_ruang LIKE '%$keyword%' OR
        kegiatan LIKE '%$keyword%' OR
        tanggal LIKE '%$keyword%' OR
        waktu_awal LIKE '%$keyword%'
        ";

        return query($query);
    }


    //FUNCTION JADWAL
    function ubahJadwal($data)
    {
        global $conn;

        $id = $data["id"];
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $waktu_awal = htmlspecialchars($data["waktu_awal"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $penyelenggara = htmlspecialchars($data["penyelenggara"]);

        
        $query = "UPDATE data_jadwal SET
        nama_ruang ='$nama_ruang',
        tanggal ='$tanggal',
        waktu_awal ='$waktu_awal',
        kegiatan = '$kegiatan',
        penyelenggara = '$penyelenggara'
        WHERE id=$id
        "; 

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapusJadwal($id)
    {
        global $conn;

        mysqli_query($conn, "DELETE FROM data_jadwal WHERE id=$id");
        return mysqli_affected_rows($conn);
    }


    function inputJadwalRuang($data){
        global $conn;

        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $waktu_awal = htmlspecialchars($data["waktu_awal"]);
        $waktu_akhir = htmlspecialchars($data["waktu_akhir"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $penyelenggara = htmlspecialchars($data["penyelenggara"]);

        $query = "INSERT INTO data_jadwal VALUES ('','$nama_ruang','$kegiatan','$penyelenggara','$waktu_awal','$tanggal','$waktu_akhir')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function searchJadwal($keyword)
    {
        $query = "SELECT * FROM data_jadwal WHERE
        nama_ruang LIKE '%$keyword%' OR
        kegiatan LIKE '%$keyword%' OR
        tanggal LIKE '%$keyword%' OR
        penyelenggara LIKE '%$keyword%' 
        ";

        return query($query);
    }

    function cekKetersediaan($keyword1,$keyword2,$keyword3,$keyword4)
    {
        $query = "SELECT * FROM data_jadwal WHERE
        nama_ruang LIKE '%$keyword1%' AND
        tanggal LIKE '%$keyword2%' AND
        waktu_awal LIKE '%$keyword3%' AND
        waktu_akhir LIKE '%$keyword4%' 
        ";

        return query($query);
    }


    function searchJadwalUser($keyword1,$keyword2)
    {
        $query = "SELECT * FROM data_jadwal WHERE
        nama_ruang LIKE '%$keyword1%' AND
        tanggal LIKE '%$keyword2%' 
        ";

        return query($query);
    }


    //pengajuan user
    function inputPengajuanUser($data){
        global $conn;

        $nama_pengaju = htmlspecialchars($data["nama_pengaju"]);
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $waktu = htmlspecialchars($data["waktu"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $status = htmlspecialchars($data["status"]);
        $berkas = htmlspecialchars($data["berkas"]);


        $berkas = uploadBerkasPengajuan();
        if(!$berkas){
            return false;
        }
        $query = "INSERT INTO data_pengajuan VALUES ('', '$id', '$nama_pengaju','$nama_ruang','$email','$kegiatan','$phone','$tanggal','$nim_nip','$waktu_awal','$waktu_akhir','$status','','','','$sik')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function uploadBerkasPengajuanUser(){
        $namaFile = $_FILES['berkas']['name'];
        $ukuranFile = $_FILES['berkas']['size'];
        $error = $_FILES['berkas']['error'];
        $namaFile = $_FILES['berkas']['name'];
        $tmpName = $_FILES['berkas']['tmp_name'];

        //gambar diupload atau tidak
        if($error === 4){
            echo "<script>
            alert('Silakan Pilih Berkas Terlebih Dahulu!');
            </script>";
            return false;
        }

        //gambar yang diupload vallid atau tidak
        $ekstensiberkasValid = ['png'];
        $ekstensiBerkas = explode('.', $namaFile);
        $ekstensiBerkas = strtolower(end($ekstensiBerkas));

        if(!in_array($ekstensiBerkas, $ekstensiberkasValid)){
            echo "<script>
            alert('File Berkas Tidak Sesuai!');
            </script>";
            return false;
        }

        //cek ukuran file
        if($ukuranFile > 100000000){
            echo "<script>
            alert('Ukuran Berkas Terlalu Besar!');
            </script>";
            return false;
        }

        //gambar siap upload
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .=  $ekstensiBerkas; 

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
        return $namaFileBaru;
    }
    
    function tambah($data, $id)
    {
        global $conn;

        $nama_pengaju = htmlspecialchars($data["nama_pengaju"]);
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $email = htmlspecialchars($data["email"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $phone = htmlspecialchars($data["phone"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $nim_nip = htmlspecialchars($data["nim_nip"]);
        $waktu_awal = htmlspecialchars($data["waktu_awal"]);
        $waktu_akhir = htmlspecialchars($data["waktu_akhir"]);
        $gender = isset($data["gender"]) ? htmlspecialchars($data["gender"]) : ""; // Mengambil nilai gender dari elemen radio button atau checkbox
        $statusUser = isset($data["statusUser"]) ? htmlspecialchars($data["statusUser"]) : ""; // Mengambil nilai statusUser dari elemen radio button atau checkbox
        
        // Set status ajuan menjadi pending
        $status = "PENDING";

        $namaFile_KTM = $_FILES['ktm']['name'];
        $x = explode('.', $namaFile_KTM);
        $ekstensiFile_KTM = strtolower(end($x));
        $ukuranFile_KTM = $_FILES['ktm']['size'];
        $file_tmp_KTM = $_FILES['ktm']['tmp_name'];
    
        $namaFile_SIK = $_FILES['sik']['name'];
        $y = explode('.', $namaFile_SIK);
        $ekstensiFile_SIK = strtolower(end($y));
        $ukuranFile_SIK = $_FILES['sik']['size'];
        $file_tmp_SIK = $_FILES['sik']['tmp_name'];
    
        // Lokasi Penempatan file
        $dirUpload = "ktm/";
        $linkBerkas_KTM = $dirUpload . $namaFile_KTM;
    
        $dirUpload = "sik/";
        $linkBerkas_SIK = $dirUpload . $namaFile_SIK;
    
        // Menyimpan file
        $KTMterupload = move_uploaded_file($file_tmp_KTM, $linkBerkas_KTM);
        $SIKterupload = move_uploaded_file($file_tmp_SIK, $linkBerkas_SIK);
    
        if ($KTMterupload && $SIKterupload) {
            $query = "INSERT INTO data_pengajuan VALUES ('', '$id', '$nama_pengaju','$nama_ruang','$email','$kegiatan','$phone','$waktu_awal','$nim_nip','$tanggal','$waktu_akhir','$status','$gender','$statusUser','$namaFile_KTM','$ukuranFile_KTM','$ekstensiFile_KTM','$linkBerkas_KTM','$namaFile_SIK','$ukuranFile_SIK','$ekstensiFile_SIK','$linkBerkas_SIK')";
    
            mysqli_query($conn, $query);
    
            return mysqli_affected_rows($conn);
        } else {
            // Terjadi kesalahan dalam mengunggah salah satu atau kedua file
            return false;
        }
    }

    //tambah data pengajuan
    function tambah2($data, $id)
    {
        global $conn;

        $nama_pengaju = htmlspecialchars($data["nama_pengaju"]);
        $nama_ruang = htmlspecialchars($data["nama_ruang"]);
        $email = htmlspecialchars($data["email"]);
        $kegiatan = htmlspecialchars($data["kegiatan"]);
        $phone = htmlspecialchars($data["phone"]);
        $tanggal = htmlspecialchars($data["tanggal"]);
        $nim_nip = htmlspecialchars($data["nim_nip"]);
        $waktu_awal = htmlspecialchars($data["waktu_awal"]);
        $waktu_akhir = htmlspecialchars($data["waktu_akhir"]);
        $gender = isset($data["gender"]) ? htmlspecialchars($data["gender"]) : ""; // Mengambil nilai gender dari elemen radio button atau checkbox
        $statusUser = isset($data["statusUser"]) ? htmlspecialchars($data["statusUser"]) : ""; // Mengambil nilai statusUser dari elemen radio button atau checkbox
        // Set status ajuan menjadi pending
        $status = "PENDING";

        $namaFile_KTM = $_FILES['ktm']['name'];
        $x = explode('.', $namaFile_KTM);
        $ekstensiFile_KTM = strtolower(end($x));
        $ukuranFile_KTM = $_FILES['ktm']['size'];
        $file_tmp_KTM = $_FILES['ktm']['tmp_name'];
    
        $namaFile_SIK = $_FILES['sik']['name'];
        $y = explode('.', $namaFile_SIK);
        $ekstensiFile_SIK = strtolower(end($y));
        $ukuranFile_SIK = $_FILES['sik']['size'];
        $file_tmp_SIK = $_FILES['sik']['tmp_name'];
    
        // Lokasi Penempatan file
        $dirUpload = "ktm/";
        $linkBerkas_KTM = $dirUpload . $namaFile_KTM;
    
        $dirUpload = "sik/";
        $linkBerkas_SIK = $dirUpload . $namaFile_SIK;
    
        // Menyimpan file
        $KTMterupload = move_uploaded_file($file_tmp_KTM, $linkBerkas_KTM);
        $SIKterupload = move_uploaded_file($file_tmp_SIK, $linkBerkas_SIK);

        //
        if ($KTMterupload && $SIKterupload) {
            $query = "INSERT INTO data_pengajuan VALUES ('', '$id', '$nama_pengaju','$nama_ruang','$email','$kegiatan','$phone','$waktu_awal','$nim_nip','$tanggal','$waktu_akhir','$status','','','$namaFile_KTM','$ukuranFile_KTM','$ekstensiFile_KTM','$linkBerkas_KTM','$namaFile_SIK','$ukuranFile_SIK','$ekstensiFile_SIK','$linkBerkas_SIK')";

            mysqli_query($conn, $query);
    
            return mysqli_affected_rows($conn);
        } else {
            // Terjadi kesalahan dalam mengunggah salah satu atau kedua file
            return false;
        }
    }


    function upload(){
        $namaFile = $_FILES['ktm']['name'];
        $ukuranFile = $_FILES['ktm']['size'];
        $error = $_FILES['ktm']['error'];
        $namaFile = $_FILES['ktm']['name'];
        $tmpName = $_FILES['ktm']['tmp_name'];

        //gambar diupload atau tidak
        if($error === 4){
            echo "<script>
            alert('silakan pilih file terlebih dahulu!');
            </script>";
            return false;
        }

        //gambar yang diupload vallid atau tidak
        $ekstensigambarValid = ['pdf'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if(!in_array($ekstensiGambar, $ekstensigambarValid)){
            echo "<script>
            alert('file tidak sesuai!');
            </script>";
            return false;
        }

        //cek ukuran file
        if($ukuranFile > 1000000){
            echo "<script>
            alert('ukuran file terlalu besar!');
            </script>";
            return false;
        }

        //gambar siap upload
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .=  $ekstensiGambar; 

        move_uploaded_file($tmpName, 'file2/' . $namaFileBaru);
        return $namaFileBaru;
    }

    function upload2(){
        $namaFile = $_FILES['sik']['name'];
        $ukuranFile = $_FILES['sik']['size'];
        $error = $_FILES['sik']['error'];
        $namaFile = $_FILES['sik']['name'];
        $tmpName = $_FILES['sik']['tmp_name'];

        //gambar diupload atau tidak
        if($error === 4){
            echo "<script>
            alert('silakan pilih file terlebih dahulu!');
            </script>";
            return false;
        }

        //gambar yang diupload vallid atau tidak
        $ekstensigambarValid = ['pdf'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if(!in_array($ekstensiGambar, $ekstensigambarValid)){
            echo "<script>
            alert('file tidak sesuai!');
            </script>";
            return false;
        }

        //cek ukuran file
        if($ukuranFile > 1000000){
            echo "<script>
            alert('ukuran file terlalu besar!');
            </script>";
            return false;
        }

        //gambar siap upload
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .=  $ekstensiGambar; 

        move_uploaded_file($tmpName, 'file3/' . $namaFileBaru);
        return $namaFileBaru;
    }

    function ubah($data)
    {
        global $conn;

        $id = $data["id"];
        $kode = htmlspecialchars($data["kode"]);
        $nama = htmlspecialchars($data["nama"]);
        $brand = htmlspecialchars($data["brand"]);
        $jumlah = htmlspecialchars($data["jumlah"]);

        $gambarLama = $data["gambarLama"];

        //ada gambar yg diupload atau tidak
        if($_FILES['gambar']['error'] === 4){
            $gambar = $gambarLama;
        }else{
            $gambar = upload();
        }

        $query = "UPDATE barang SET
        code ='$kode',
        name = '$nama',
        brand = '$brand',
        quantity = '$jumlah',
        image = '$gambar'
        WHERE id=$id
        "; 

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapus($id)
    {
        global $conn;

        mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
        return mysqli_affected_rows($conn);
    }

    function search($keyword)
    {
        $query = "SELECT * FROM barang WHERE
        name LIKE '%$keyword%' OR
        brand LIKE '%$keyword%' OR
        code LIKE '%$keyword%' OR
        quantity LIKE '%$keyword%' 
        ";

        return query($query);
    }

    function getHari($date){
        $datetime = DateTime::createFromFormat('Y-m-d', $date);
         $day = $datetime->format('l');
        switch ($day) {
         case 'Sunday':
          $hari = 'Minggu';
          break;
         case 'Monday':
          $hari = 'Senin';
          break;
         case 'Tuesday':
          $hari = 'Selasa';
          break;
         case 'Wednesday':
          $hari = 'Rabu';
          break;
         case 'Thursday':
          $hari = 'Kamis';
          break;
         case 'Friday':
          $hari = 'Jum\'at';
          break;
         case 'Saturday':
          $hari = 'Sabtu';
          break;
         default:
          $hari = 'Tidak ada';
          break;
        }
        return $hari;
    }

    function getBulan($date){
        $datetime = DateTime::createFromFormat('Y-m-d', $date);
         $month = $datetime->format('m');
        switch ($month) {
         case '01':
          $bulan = 'Januari';
          break;
         case '02':
          $bulan = 'Februari';
          break;
         case '03':
          $bulan = 'Maret';
          break;
         case '04':
          $bulan = 'April';
          break;
         case '05':
          $bulan = 'Mei';
          break;
         case '06':
          $bulan = 'Juni';
          break;
         case '07':
          $bulan = 'Juli';
          break;
        case '08':
            $bulan = 'Agustus';
            break;
        case '09':
            $bulan = 'September';
            break;
        case '10':
            $bulan = 'Oktober';
            break;
        case '11':
            $bulan = 'November';
            break;
        case '12':
            $bulan = 'Desember';
            break;
         default:
          $bulan = 'Tidak ada';
          break;
        }
        return $bulan;
    }
    

    //validasi
    function validasiTerima($id) {
        global $conn;
        $data2 = "DITERIMA";
        // mysqli_query($conn, "INSERT INTO data_laporan (nama_pengaju, nama_ruang, email, kegiatan, phone, waktu, nim_nip, tgl_awal, tgl_akhir, status, gender, statusUser, ktm, sik) && INSERT INTO data_jadwal (nama_ruang, kegiatan, penyelenggara, waktu, tgl_awal, tgl_akhir)
        //     SELECT nama_pengaju, nama_ruang, email, kegiatan, phone, waktu, nim_nip, tgl_awal, tgl_akhir, status, gender, statusUser, ktm, sik FROM data_pengajuan WHERE id_ajuan = $id");
        // Memasukkan data pengajuan ke tabel data_laporan
        $query_laporan = "INSERT INTO data_laporan (nama_pengaju, nama_ruang, email, kegiatan, phone, tanggal, nim_nip, waktu_awal, waktu_akhir, status, gender, statusUser, ktm, sik)
            SELECT nama_pengaju, nama_ruang, email, kegiatan, phone, tanggal, nim_nip, waktu_awal, waktu_akhir, status, gender, statusUser, ktm, sik FROM data_pengajuan WHERE id_ajuan = $id";
        mysqli_query($conn, $query_laporan);

        // Memasukkan data pengajuan ke tabel data_jadwal dengan penyelenggara = nama_pengaju
        $query_jadwal = "INSERT INTO data_jadwal (nama_ruang, kegiatan, penyelenggara, tanggal, waktu_awal, waktu_akhir)
            SELECT nama_ruang, kegiatan, nama_pengaju, tanggal, waktu_awal, waktu_akhir FROM data_pengajuan WHERE id_ajuan = $id";
        mysqli_query($conn, $query_jadwal);

        $query =  "UPDATE data_pengajuan SET status = '$data2' WHERE id_ajuan=$id";
        // "INSERT INTO data_pengajuan VALUES
        // ('','','','','','','','','','',
        // '$data2','','','','')" ;
        // "UPDATE data_pengajuan SET
        // status = $data2 WHERE id=$id";
        mysqli_query($conn, $query);
    
        return mysqli_affected_rows($conn);
    }
    function validasiTolak($id) {
        global $conn;

        $data2 = "DITOLAK";
        // mysqli_query($conn, "INSERT INTO data_laporan (nama_pengaju, nama_ruang, email, kegiatan, phone, waktu, nim_nip, tgl_awal, tgl_akhir, status, gender, statusUser, ktm, sik) 
        //     SELECT nama_pengaju, nama_ruang, email, kegiatan, phone, waktu, nim_nip, tgl_awal, tgl_akhir, status, gender, statusUser, ktm, sik FROM data_pengajuan WHERE id = $id");
        $query =  "UPDATE data_pengajuan SET status = '$data2' WHERE id_ajuan=$id";
        // "INSERT INTO data_pengajuan VALUES
        // ('','','','','','','','','','',
        // '$data2','','','','')" ;
        // "UPDATE data_pengajuan SET
        // status = $data2 WHERE id=$id";
        mysqli_query($conn, $query);
    
        return mysqli_affected_rows($conn);
    }

?>