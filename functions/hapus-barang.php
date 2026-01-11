<?php
require_once "../stok.php";

hapusBarang((int) $_POST['id']);

header("Location: ../index.php");
