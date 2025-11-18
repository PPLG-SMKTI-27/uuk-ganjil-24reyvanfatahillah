<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Tambah Parkiran</h2>

    <form action="index.php?page=parkiran&action=store" method="POST">

        <label>Tipe Kendaraan</label>
        <select name="id_tipe" required>
            <?php foreach ($tipe as $t): ?>
                <option value="<?= $t['id_tipe'] ?>">
                    <?= $t['tipe'] ?> (Tarif: <?= $t['tarif'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label>Status</label>
        <select name="status">
            <option value="masukParkir">Masuk Parkir</option>
            <option value="prosesPembayaran">Proses Pembayaran</option>
        </select>

        <button type="submit">Simpan</button>

    </form>


</body>
</html>