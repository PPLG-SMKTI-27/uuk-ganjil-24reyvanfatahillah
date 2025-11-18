<?php
require_once __DIR__ ."/../models/admin.php";
class adminController {
    private $model;
    public function __construct($pdo) {
        $this->model = new admin( $pdo );
    }
    public function tipeList() {
        $tipe = $this->model->getTipeKendaraan();
        include __DIR__ ."/../views/admin/listTipe.php";
    }
    public function tarifById() {
        $id = $_GET['id'];
        $edit = $this->model->getTipeById($id);
        include __DIR__ .'/../views/admin/editTarif.php';
    }
    public function editTarif(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipe = $_POST['tipe'];
            $tarif = $_POST['tarif'];
            $this->model->editTarif($tipe, $tarif);
        }
        header('Location: index.php?page=admin&action=tipe');
    }
}
?>