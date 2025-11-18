<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Daftar Tipe Kendaraan</h2><br>
    <a href="index.php?page=admin"><- Kembali ke dashboard</a><br>
    <table border="1">
        <tr>
            <th>ID Tipe</th>
            <th>Tipe Kendaraan</th>
            <th>Tarif</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($tipe as $t):?>
        <tr>
            <td><?= $t['id_tipe'] ?></td>
            <td><?= $t['tipe'] ?></td>
            <td><?= $t['tarif'] ?></td>
            <td>
                <a href="index.php?page=admin&action=edit&id=<?= $t['id_tipe'] ?>">Edit Tarif</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>