<?php
require_once "../stok.php";

tambahBarang(
    $_POST['nama'],
    (int) $_POST['jumlah'],
    (int) $_POST['block_id']
);

header("Location: ../index.php");
