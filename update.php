<?php
   require 'functions.php';

// ambil id dari URL
$id = $_GET["id"];

// buat prepared statement
$stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// ambil data user
$user = $result->fetch_assoc();

$stmt->close();

// tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek data ada yang diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "<script>
            alert('Ubah data sukses');
            </script>";
    } else {
        echo "<script>
            alert('Ubah data gagal');
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Barang</title>
</head>
<body>
    <h1>Ubah Data User</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $user["id"]; ?>">
        <table>
            <tr>
                <td>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?= $user["nama"]; ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= $user["email"]; ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?= $user["phone"]; ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nim_nip">NIM/NIP</label>
                    <input type="text" name="nim_nip" id="nim_nip" value="<?= $user["nim_nip"]; ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="gender">Jumlah</label>
                    <input type="text" name="gender" id="gender" value="<?= $user["gender"]; ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="statusUser">Jumlah</label>
                    <input type="text" name="statusUser" id="statusUser" value="<?= $user["statusUser"]; ?>" required>
                </td>
            </tr>
        </table>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>