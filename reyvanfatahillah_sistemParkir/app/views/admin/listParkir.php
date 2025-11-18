<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Daftar Parkiran</h2>
    <a href="index.php?page=admin"><- Kembali ke dashboard</a><br>
    <a href="index.php?page=parkiran&action=create">Tambah Parkiran</a><br>


    <!-- PARKIRAN MASUK -->
    <h3>🚗 Masuk Parkiran</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Tipe</th><th>Tarif</th><th>Jam Masuk</th><th>Aksi</th>
        </tr>

        <?php foreach ($masuk as $d): ?>
        <tr>
            <td><?= $d['id_parkir'] ?></td>
            <td><?= $d['tipe'] ?></td>
            <td><?= $d['tarif_parkir'] ?></td>
            <td><?= $d['jam_masuk'] ?></td>
            <td>
                <a href="index.php?page=parkiran&action=edit&id=<?= $d['id_parkir'] ?>">Edit</a>
                <a onclick="return confirm('Hapus?')" 
                href="index.php?page=parkiran&action=delete&id=<?= $d['id_parkir'] ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>


    <!-- PARKIRAN PROSES PEMBAYARAN -->
    <h3>💸 Proses Pembayaran</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Tipe</th><th>Tarif</th><th>Jam Masuk</th><th>Aksi</th>
        </tr>

        <?php foreach ($proses as $d): ?>
        <tr>
            <td><?= $d['id_parkir'] ?></td>
            <td><?= $d['tipe'] ?></td>
            <td><?= $d['tarif_parkir'] ?></td>
            <td><?= $d['jam_masuk'] ?></td>
            <td>
                <a href="index.php?page=parkiran&action=edit&id=<?= $d['id_parkir'] ?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>


    <!-- PARKIRAN KELUAR -->
    <h3>✅ Sudah Keluar</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Tipe</th><th>Tarif</th><th>Jam Masuk</th><th>Jam Keluar</th>
        </tr>

        <?php foreach ($keluar as $d): ?>
        <tr>
            <td><?= $d['id_parkir'] ?></td>
            <td><?= $d['tipe'] ?></td>
            <td><?= $d['tarif_parkir'] ?></td>
            <td><?= $d['jam_masuk'] ?></td>
            <td><?= $d['jam_keluar'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>