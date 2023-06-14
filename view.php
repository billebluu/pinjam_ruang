<?php
    require 'functions.php';
    $user = query('SELECT * FROM user');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
</head>
<body>
    <h1>List User</h1>
    <a href="tambah.php">Tambah Data</a><br><br>
    <form action="" method="post">
    
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <td>ID.</td>
            <td>Nama</td>
            <td>Email</td>
            <td>Password</td>
            <td>Phone</td>
            <td>NIM/NIP</td>
            <td>Gender</td>
            <td>Status</td>
            <td>Aksi</td>

        </tr>
        <tr>
            <?php $i = 1;?>
            <?php foreach ($user as $row): ?>                
                <td><?= $row["id"]; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["password"]; ?></td>
                <td><?= $row["phone"]; ?></td>
                <td><?= $row["nim_nip"]; ?></td>
                <td><?= $row["gender"]; ?></td>
                <td><?= $row["statusUser"]; ?></td>
                <td>
                    <a href="update.php?id=<?= $row["id"]; ?>">Ubah</a>
                    <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah data akan dihapus?');">Hapus</a>
                </td>
        </tr>
            <?php $i++; ?>
            <?php endforeach; ?>  
    </table>
</body>