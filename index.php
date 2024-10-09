<?php
require_once 'database.php';
require_once 'gudang.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new gudang($db);
$stmt = $gudang->read();
$num = $stmt->rowCount();

$title = "Daftar gudang";

ob_start();
?>

<h1>List gudang</h1>

<?php
if ($num > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead class='table-dark'><tr><th>ID</th><th>Name</th><th>Location</th><th>Capacity</th><th>Status</th><th>Opening Hour</th><th>Closing Hour</th><th>Action</th></tr></thead>";
    echo "<tbody>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$location}</td>";
        echo "<td>{$capacity}</td>";
        echo "<td>{$status}</td>";
        echo "<td>{$opening_hour}</td>";
        echo "<td>{$closing_hour}</td>";
        echo "<td>";
        echo "<a href='view-edit.php?id=" . $id . "' class='btn btn-primary me-2'>Edit</a>";
        echo "<a href='delete.php?id=" . $id . "' class='btn btn-danger'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<div class='alert alert-danger'>Tidak ada data gudang.</div>";
}
$content = ob_get_clean();
include 'view.php';
?>