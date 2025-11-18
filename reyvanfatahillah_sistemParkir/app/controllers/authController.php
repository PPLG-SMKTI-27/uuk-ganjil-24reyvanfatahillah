<?php
require_once __DIR__ . "/../models/auth.php";
class authController {
    private $model;
    public function __construct($pdo) {
        $this->model = new auth($pdo);
    }
    public function auth() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->model->auth($email);
            if (!$user) {
                echo "<script>alert('Email tidak ditemukan!'); history.back();</script>";
                return;
            }
            if ($password !== $user["password"]) {
                echo "<script>alert('Password salah!'); history.back();</script>";
                return;
            }
            $_SESSION['user'] = $user;
            $role = $user['role'];
            switch($role) {
                case 'admin':
                    echo"<script>alert('Selamat datang admin, {$user['nama']}'); window.location='index.php?page=admin';</script>";
                    break;
                case 'petugas loket':
                    echo"<script>alert('Selamat datang petugas, {$user['nama']}'); window.location='index.php?page=petugas_loket';</script>";
                    break;
                default:
                    echo'<script>alert(Akun tidak dikenali!);</script>';
                    break;
                }
                return;
        } include __DIR__ . "/../views/index.php";
    } 
    public function logout() {
        $_SESSION = [];
        session_unset();
        session_destroy();
        echo "<script>alert('Anda telah logout.'); window.location='index.php?page=home';</script>";
        exit;
    }  
}
?>