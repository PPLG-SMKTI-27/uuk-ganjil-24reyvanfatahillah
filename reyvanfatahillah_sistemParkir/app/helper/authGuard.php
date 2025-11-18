<?php
function redirectToRoleHome($role) {
    switch (strtolower($role)) {
        case 'admin':
            $target = 'index.php?page=admin';
            break;
        case 'petugas loket':
            $target = 'index.php?page=petugas_loket';
            break;
        default:
            $target = 'index.php?page=home';
            break;
    }
    echo "<script>window.location='$target';</script>";
    exit;
}
function checkLogin() {
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('Harap login terlebih dahulu.'); window.location='index.php?page=home';</script>";
        exit;
    }
}

function checkRole($allowedRoles = []) {
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('Silakan login terlebih dahulu.'); window.location='index.php?page=home';</script>";
        exit;
    }

    $userRole = strtolower($_SESSION['user']['role']);

    if (!in_array($userRole, $allowedRoles)) {
        echo "<script>alert('Anda tidak memiliki izin mengakses halaman ini.');</script>";
        redirectToRoleHome($userRole);
    }
}
?>
