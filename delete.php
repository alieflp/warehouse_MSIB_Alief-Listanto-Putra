<?php
require_once 'database.php';
require_once 'gudang.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new gudang($db);

$gudang->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');
if ($gudang->delete()) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal mengubah status gudang.";
}
?>