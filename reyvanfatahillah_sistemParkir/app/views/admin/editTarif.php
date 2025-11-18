<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Edit Tarif</h2>
    <form action="index.php?page=admin&action=saveEdit" method="post">
        <p>Tipe Kendaraan : <?= $edit['tipe']?></p>
        <input type="hidden" name="tipe" value="<?= $edit['tipe'] ?>" required>
        <label>Tarif Baru:</label><br>
        <input type="number" name="tarif" required><br>
        <button type="submit">Simpan</button><br><br>
    </form>
</body>
</html>