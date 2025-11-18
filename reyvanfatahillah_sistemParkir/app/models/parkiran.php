<?php

class Parkiran {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT p.*, t.tipe, t.tarif AS tarif_tipe
            FROM parkiran p
            JOIN tipe_kendaraan t ON p.id_tipe = t.id_tipe
            ORDER BY p.id_parkir ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByStatus($status) {
        $stmt = $this->pdo->prepare("
            SELECT p.*, t.tipe 
            FROM parkiran p
            JOIN tipe_kendaraan t ON p.id_tipe = t.id_tipe
            WHERE p.status = ?
            ORDER BY p.id_parkir ASC
        ");
        $stmt->execute([$status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM parkiran WHERE id_parkir = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Simpan: tarif diambil otomatis dari tipe_kendaraan
    public function store($id_tipe, $status) {

        // Ambil tarif dari tabel tipe_kendaraan
        $tarif = $this->getTarifByTipe($id_tipe);

        $stmt = $this->pdo->prepare("
            INSERT INTO parkiran (id_tipe, tarif_parkir, status)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_tipe, $tarif, $status]);
    }

    // Update
    public function update($id, $id_tipe, $status) {

    // Ambil tarif (kalau tipe diganti)
        $tarif = $this->getTarifByTipe($id_tipe);

        // Jika status keluar, update jam_keluar
        if ($status == "keluarParkir") {

            $stmt = $this->pdo->prepare("
                UPDATE parkiran
                SET id_tipe = ?, tarif_parkir = ?, status = ?, jam_keluar = CURRENT_TIMESTAMP
                WHERE id_parkir = ?
            ");

            return $stmt->execute([$id_tipe, $tarif, $status, $id]);
        }

        // Jika bukan keluar, jangan sentuh jam_keluar
        else {
            $stmt = $this->pdo->prepare("
                UPDATE parkiran
                SET id_tipe = ?, tarif_parkir = ?, status = ?
                WHERE id_parkir = ?
            ");

            return $stmt->execute([$id_tipe, $tarif, $status, $id]);
        }
    }


    // Hapus
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM parkiran WHERE id_parkir = ?");
        return $stmt->execute([$id]);
    }

    // Ambil tarif dari tabel tipe_kendaraan
    private function getTarifByTipe($id_tipe) {
        $stmt = $this->pdo->prepare("SELECT tarif FROM tipe_kendaraan WHERE id_tipe = ?");
        $stmt->execute([$id_tipe]);
        return $stmt->fetchColumn();
    }
    public function getProsesPembayaran() {
        $stmt = $this->pdo->query("
            SELECT p.*, t.tipe
            FROM parkiran p
            JOIN tipe_kendaraan t ON p.id_tipe = t.id_tipe
            WHERE p.status = 'prosesPembayaran'
            ORDER BY p.id_parkir ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function konfirmasiPembayaran($id_parkir, $id_tipe, $id_petugas) {

        // Ambil tarif kendaraan
        $tarif = $this->getTarifByTipe($id_tipe);

        // 1. UPDATE PARKIRAN
        $stmt = $this->pdo->prepare("
            UPDATE parkiran
            SET status = 'keluarParkir',
                jam_keluar = CURRENT_TIMESTAMP,
                tarif_parkir = ?
            WHERE id_parkir = ?
        ");
        $stmt->execute([$tarif, $id_parkir]);

        // 2. MASUKKAN TRANSAKSI
        $stmt2 = $this->pdo->prepare("
            INSERT INTO daftar_transaksi (id_parkir, id_petugas, tarif_parkir, jam_transaksi)
            VALUES (?, ?, ?, now())
        ");
        $stmt2->execute([$id_parkir, $id_petugas, $tarif]);

        return true;
    }
}
