<?php
require_once __DIR__ ."/../models/parkiran.php";
class parkiranController {
    private $model;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->model = new Parkiran($pdo);
    }

    // List data
    public function index() {

        $masuk  = $this->model->getByStatus("masukParkir");
        $proses = $this->model->getByStatus("prosesPembayaran");
        $keluar = $this->model->getByStatus("keluarParkir");

        include __DIR__ . '/../views/admin/listParkir.php';
    }

    // Form tambah
    public function create() {
        // load tipe kendaraan
        $stmt = $this->pdo->query("SELECT * FROM tipe_kendaraan");
        $tipe = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ .'/../views/admin/create.php';
    }

    // Proses simpan
    public function store() {
        $this->model->store(
            $_POST['id_tipe'],
            $_POST['status']
        );
        header("Location: index.php?page=parkiran");
    }

    // Form edit
    public function edit() {
        $id = $_GET['id'];

        $parkir = $this->model->getById($id);

        // load tipe kendaraan
        $stmt = $this->pdo->query("SELECT * FROM tipe_kendaraan");
        $tipe = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ .'/../views/admin/edit.php';
    }

    // Update data
    public function update() {
        $this->model->update(
            $_POST['id_parkir'],
            $_POST['id_tipe'],
            $_POST['status']
        );
        header("Location: index.php?page=parkiran");
    }

    // Hapus data
    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);

        header("Location: index.php?page=parkiran");
    }
}
