<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Daftar Transaksi Parkir</h2><br>
    <a href="index.php?page=admin"><- Kembali ke dashboard</a><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID Transaksi</th>
            <th>ID Parkir</th>
            <th>Petugas</th>
            <th>Tarif</th>
            <th>Jam Transaksi</th>
            <th>Total Pendapatan</th>
        </tr>

        <?php foreach ($data as $t): ?>
        <tr>
            <td><?= $t['id_transaksi'] ?></td>
            <td><?= $t['id_parkir'] ?></td>
            <td><?= $t['petugas'] ?></td>
            <td><?= $t['tarif_parkir'] ?></td>
            <td><?= $t['jam_transaksi'] ?></td>
        <?php endforeach; ?>
            <td><?= $total['Total Tarif'] ?></td>
        </tr>
    </table>

</body>
</html>