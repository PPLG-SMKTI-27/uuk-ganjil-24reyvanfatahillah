<?php
class admin {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getTipeKendaraan() {
        $stmt = $this->pdo->query("
        SELECT * FROM tipe_kendaraan ORDER BY id_tipe ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTipeById($id) {
        $stmt = $this->pdo->prepare("
        SELECT * FROM tipe_kendaraan WHERE id_tipe = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function editTarif($tipe, $tarif) {
        $stmt = $this->pdo->prepare("
        SELECT id_tipe FROM tipe_kendaraan WHERE tipe = ?
        ");
        $stmt->execute([$tipe]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $data["id_tipe"];
        $sql = "UPDATE tipe_kendaraan SET tarif = ? WHERE id_tipe = ?";
        $this->pdo->prepare($sql)->execute([$tarif, $id]);
    }
}
?>