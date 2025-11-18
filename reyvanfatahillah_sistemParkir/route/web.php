<?php
if (session_start() === PHP_SESSION_NONE) {
    session_start();
}

$path = dirname(__DIR__);

//Database
require_once $path ."/app/config/pdo.php";

//Helpet
require_once $path ."/app/helper/authGuard.php";

//Controller
require_once $path ."/app/controllers/authController.php";
require_once $path ."/app/controllers/adminController.php";
require_once $path ."/app/controllers/ParkiranController.php";
require_once $path ."/app/controllers/TransaksiController.php";
require_once $path ."/app/controllers/petugasController.php";

$AuthC = new authController($pdo);
$Admin = new adminController($pdo);
$Parkir = new parkiranController($pdo);
$Transaksi = new transaksiController($pdo);
$Petugas = new petugasController($pdo);

//Route
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : null;
switch ($page) {
    case 'home':
        if (isset($_SESSION['user'])) {
            redirectToRoleHome($_SESSION['user']['role']);
        } else {
            require $path .'/app/views/index.php';
        }
        break;

    case 'login':
        if (!isset($_SESSION['user'])) {
            $AuthC->auth();
        } else {
            redirectToRoleHome($_SESSION['user']['role']);
        }
        break;

    case 'logout':
        $AuthC->logout();
        break;

    case 'admin':
        checkRole(['admin']);
        if ($action === 'tipe') {
            $Admin->tipeList();
        } elseif ($action === 'edit') {
            $Admin->tarifById();
        } elseif ($action === 'saveEdit') {
            $Admin->editTarif();
        } else {
            require $path .'/app/views/admin/dashboard.php';
        }
        break;

    case 'parkiran':
        checkRole(['admin']);
        if ($action == 'create') {
            $Parkir->create();
        } elseif ($action == 'store') {
            $Parkir->store();
        } elseif ($action == 'edit') {
            $Parkir->edit();
        } elseif ($action == 'update') {
            $Parkir->update();
        } elseif ($action == 'delete') {
            $Parkir->delete();
        } else {
            $Parkir->index();
        }
        break;

    case 'transaksi':
        checkRole(['admin']);
        $Transaksi->index();
        break;
    

    case 'petugas_loket':
        checkRole(['petugas loket']);
        if ($action === 'parkiran') {
            $Petugas->index(); 
        } elseif ($action === 'konfirmasi') {
            $Petugas->konfirmasi();
        } else {
            require $path .'/app/views/petugas_loket/dashboard.php';
        }
        break;
        
}
?>