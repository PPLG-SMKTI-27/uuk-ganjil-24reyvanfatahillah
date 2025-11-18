<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Dashboard Petugas Loket</h2><br>
    <a href="index.php?page=petugas_loket"><- Kembali ke dashboard</a>

    <h3>🔸 Kendaraan Menunggu Pembayaran</h3>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID Parkir</th>
            <th>Tipe</th>
            <th>Tarif</th>
            <th>Jam Masuk</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($prosesPembayaran as $p): ?>
        <tr>
            <td><?= $p['id_parkir'] ?></td>
            <td><?= $p['tipe'] ?></td>
            <td><?= $p['tarif_parkir'] ?></td>
            <td><?= $p['jam_masuk'] ?></td>

            <td>
                <a href="index.php?page=petugas_loket&action=konfirmasi&id=<?= $p['id_parkir'] ?>&id_tipe=<?= $p['id_tipe'] ?>"
                    onclick="return confirm('Konfirmasi pembayaran kendaraan ini?')">
                    Konfirmasi Pembayaran
                </a>

            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>