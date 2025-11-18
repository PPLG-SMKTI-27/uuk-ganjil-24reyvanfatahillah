<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Toko Kue Rejaki</title>
    <link rel="stylesheet" href="">
</head>
<body class="auth">
    <div class="auth-form">
        <h2>Masuk ke Akun</h2>
        <form method="POST" action="index.php?page=login">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" minlength="8" placeholder="Kata Sandi" required>
            <button type="submit" class="submit-primary">Masuk</button>
        </form>
    </div>
</body>
</html>