<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Edit Parkiran</h2>

    <form action="index.php?page=parkiran&action=update" method="POST">

        <input type="hidden" name="id_parkir" value="<?= $parkir['id_parkir'] ?>">

        <label>Tipe Kendaraan</label>
        <select name="id_tipe">
            <?php foreach ($tipe as $t): ?>
                <option value="<?= $t['id_tipe'] ?>"
                    <?= ($t['id_tipe'] == $parkir['id_tipe']) ? 'selected' : '' ?>>
                    <?= $t['tipe'] ?> (Tarif: <?= $t['tarif'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label>Status</label>
        <select name="status">
            <option value="prosesPembayaran"    <?= ($parkir['status'] == 'prosesPembayaran') ? 'selected' : '' ?>>Proses Pembayaran</option>
        </select>

        <button type="submit">Update</button>
    </form>

</body>
</html>