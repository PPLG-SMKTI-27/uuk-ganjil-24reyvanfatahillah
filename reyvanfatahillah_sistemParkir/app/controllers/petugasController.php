<?php
require_once __DIR__ ."/../models/parkiran.php";
require_once __DIR__ ."/../models/transaksi.php";
class petugasController {

    private $pdo;
    private $modelparkir;
    private $modeltransaksi;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->modelparkir = new Parkiran($pdo);
    }

    // Dashboard petugas
    public function index() {

        // Ambil kendaraan yg butuh pembayaran
        $prosesPembayaran = $this->modelparkir->getProsesPembayaran();

        include __DIR__ ."/../views/petugas_loket/listProsesParkir.php";
    }

    // Konfirmasi pembayaran oleh petugas
    public function konfirmasi() {
        $id_petugas = $_SESSION['user']['id_user'];

        $id_parkir = $_GET['id'];
        $id_tipe   = $_GET['id_tipe'];

        // Jalankan konfirmasi pembayaran
        $this->modelparkir->konfirmasiPembayaran($id_parkir, $id_tipe, $id_petugas);

        header("Location: index.php?page=petugas_loket&action=parkiran");
    }
}
