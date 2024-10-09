<?php
require_once 'database.php';
require_once 'gudang.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new gudang($db);

$gudang->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->update()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate gudang.";
    }
} else {
    $stmt = $gudang->show($gudang->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $gudang->name = $data['name'];
    $gudang->location = $data['location'];
    $gudang->capacity = $data['capacity'];
    $gudang->status = $data['status'];
    $gudang->opening_hour = $data['opening_hour'];
    $gudang->closing_hour = $data['closing_hour'];
}
ob_start();

?>
<h1>Edit gudang</h1>

<form action="view-edit.php?id=<?php echo $gudang->id; ?>" method="POST">
    <div class="mb-2">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $gudang->name; ?>" required>
    </div>
    <div class="mb-2">
        <label for="location" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="location" name="location" value="<?php echo $gudang->location; ?>" required>
    </div>
    <div class="mb-2">
        <label for="capacity" class="form-label">Kapasitas</label>
        <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo $gudang->capacity; ?>" required>
    </div>
    
    <div class="row mb-2">
        <div class="col-md-4">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="aktif" <?php echo ($gudang->status == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                <option value="tidak_aktif" <?php echo ($gudang->status == 'Non-Aktif') ? 'selected' : ''; ?>>Non-Aktif</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="opening_hour" class="form-label">Jam Buka</label>
            <input type="time" class="form-control" id="opening_hour" name="opening_hour" value="<?php echo $gudang->opening_hour; ?>" required>
        </div>
        <div class="col-md-4">
            <label for="closing_hour" class="form-label">Jam Tutup</label>
            <input type="time" class="form-control" id="closing_hour" name="closing_hour" value="<?php echo $gudang->closing_hour; ?>" required>
        </div>
    </div>

    <input type="submit" class="btn btn-warning w-100" value="Update gudang">
</form>

<br>
<a href="index.php">Kembali ke Daftar gudang</a>

<?php

$content = ob_get_clean();
include 'view.php';

?>