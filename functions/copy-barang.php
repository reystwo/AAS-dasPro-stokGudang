<?php
require_once "../stok.php";

copyBlock((int) $_POST['block_id']);
header("Location: ../index.php");
