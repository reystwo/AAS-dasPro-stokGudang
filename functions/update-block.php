<?php
require_once "../stok.php";

updateNamaBlock(
    (int) $_POST['block_id'],
    $_POST['nama_block']
);

header("Location: ../index.php");
