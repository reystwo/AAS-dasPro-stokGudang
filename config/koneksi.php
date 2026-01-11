<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli("localhost", "root", "", "stok_gudang");
    $conn->set_charset("utf8");
} catch (Exception $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
