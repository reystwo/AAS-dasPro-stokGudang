<?php
require_once "../stok.php";

editJumlahBarang(
    (int) $_POST['id'],
    (int) $_POST['jumlah']
);

header("Location: ../index.php");
