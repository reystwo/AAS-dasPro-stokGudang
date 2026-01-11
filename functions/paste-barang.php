<?php
require_once "../stok.php";

pasteBlock((int) $_POST['block_id']);
header("Location: ../index.php");
