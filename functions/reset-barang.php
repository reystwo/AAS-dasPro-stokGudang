<?php
require_once "../stok.php";

resetBlock((int) $_POST['block_id']);
header("Location: ../index.php");
