<?php
require_once 'database.php';
require_once 'gudang.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new gudang($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->create()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambah gudang.";
    }
}
ob_start();
?>

<h1>Tambah gudang Baru</h1>

<form action="view-create.php" method="POST">
    <div class="mb-2">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-2">
        <label for="location" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="location" name="location" required>
    </div>
    <div class="mb-2">
        <label for="capacity" class="form-label">Kapasitas</label>
        <input type="text" class="form-control" id="capacity" name="capacity" required>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="tidak_aktif">Non-Aktif</option>
            </select>
            
        </div>
        <div class="col-md-4">
            <label for="opening_hour" class="form-label">Jam Buka</label>
            <input type="time" class="form-control" id="opening_hour" name="opening_hour" required>
        </div>
        <div class="col-md-4">
            <label for="closing_hour" class="form-label">Jam Tutup</label>
            <input type="time" class="form-control" id="closing_hour" name="closing_hour" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit</button>
    <br>
    <a href="index.php">Kembali ke Daftar gudang</a>

<?php
$content = ob_get_clean();
include 'view.php';
?>

