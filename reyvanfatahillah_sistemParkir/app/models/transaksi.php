<?php

class Transaksi {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Menyimpan transaksi baru
    public function add($id_parkir, $id_petugas, $tarif) {
        $stmt = $this->pdo->prepare("
            INSERT INTO daftar_transaksi (id_parkir, id_petugas, tarif_parkir)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_parkir, $id_petugas, $tarif]);
    }

    // Ambil semua transaksi
    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT t.*, u.nama AS petugas
            FROM daftar_transaksi t
            JOIN parkiran p ON t.id_parkir = p.id_parkir
            JOIN users u ON t.id_petugas = u.id_user
            ORDER BY t.id_transaksi ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTotal() {
        $stmt = $this->pdo->query("
            SELECT SUM(tarif_parkir) as 'Total Tarif'
            FROM daftar_transaksi
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 
}
