<?php
require_once __DIR__ ."/../models/transaksi.php";
class TransaksiController {

    private $model;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->model = new Transaksi($pdo);
    }

    public function index() {
        $data = $this->model->getAll();
        $total = $this->model->getTotal();
        include __DIR__ ."/../views/admin/transaksi.php";
    }
}
