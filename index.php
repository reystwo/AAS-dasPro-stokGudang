<?php
require_once "stok.php";
$keyword = $_GET['search'] ?? '';

if ($keyword != '') {
    $result = searchBlockByBarang($keyword);

    $blockIds = [];
    while ($row = $result->fetch_assoc()) {
        $blockIds[] = $row['block_id'];
    }

    if (count($blockIds) > 0) {
        $ids = implode(",", $blockIds);
        $blocks = $conn->query(
            "SELECT * FROM blocks WHERE id IN ($ids)"
        );
    } else {
        // Tidak ada barang ditemukan
        $blocks = [];
    }
} else {
    $blocks = getBlocks();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Stok HP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-4">Sistem Pengelolaan Stok HP</h3>

    <form method="get" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari nama barang..."
                       value="<?= $_GET['search'] ?? '' ?>">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Search</button>
                <a href="index.php" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <div class="row">
        <?php if (is_array($blocks)): ?>
            <p class="text-danger">Barang tidak ditemukan</p>
        <?php else: ?>
            <?php while ($block = $blocks->fetch_assoc()):

                $total = getTotalBarangBlock($block['id']);

                // ===== LOGIKA WARNA BLOCK =====
                if ($total == 0) {
                    $warna = "bg-secondary text-white";
                    $status = "Kosong";
                } elseif ($total >= 1 && $total <= 20) {
                    $warna = "bg-success text-white";
                    $status = "Aman";
                } elseif ($total >= 21 && $total <= 24) {
                    $warna = "bg-warning";
                    $status = "Hampir Penuh";
                } else {
                    $warna = "bg-danger text-white";
                    $status = "Penuh";
                }
            ?>

            <!-- CARD BLOCK -->
            <div class="col-md-3 mb-4">

                <!-- ALAMAT BLOCK -->
                <div class="fw-bold mb-1 text-<?= $warna_text ?>">
                    <?= $block['alamat_block'] ?>
                </div>

                <div class="card shadow <?= $warna ?>"
                     data-bs-toggle="modal"
                     data-bs-target="#modal<?= $block['id'] ?>"
                     style="cursor:pointer">

                    <div class="card-body">
                        <h5 class="text-center">
                            <?= $block['nama_block'] ?>
                        </h5>

                        <p class="text-center fw-bold">
                            <?= $total ?> / 25
                        </p>

                        <!-- NAMA BARANG DALAM BLOCK -->
                        <ul class="small">
                            <?php
                            $namaBarang = getNamaBarangByBlock($block['id']);
                            if ($namaBarang->num_rows == 0):
                            ?>
                                <li class="fst-italic">-</li>
                            <?php else:
                                while ($nb = $namaBarang->fetch_assoc()):
                            ?>
                                <li><?= $nb['nama_barang'] ?></li>
                            <?php endwhile; endif; ?>
                        </ul>

                        <span class="badge bg-dark d-block text-center"><?= $status ?></span>
                    </div>
                </div>
            </div>

            <!-- MODAL DETAIL -->
            <div class="modal fade" id="modal<?= $block['id'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <form method="post" action="functions/update-block.php" class="d-flex w-100 gap-2">
                                <input type="hidden" name="block_id" value="<?= $block['id'] ?>">

                                <input type="text"
                                       name="nama_block"
                                       value="<?= $block['nama_block'] ?>"
                                       class="form-control"
                                       required>

                                <button class="btn btn-success btn-sm">
                                    Simpan
                                </button>

                                <button type="button"
                                        class="btn-close ms-auto"
                                        data-bs-dismiss="modal"></button>
                            </form>
                        </div>

                        <div class="modal-body">

                            <!-- TAMBAH BARANG -->
                            <form method="post" action="functions/tambah-barang.php" class="mb-3">
                                <input type="hidden" name="block_id" value="<?= $block['id'] ?>">

                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </form>

                            <!-- LIST BARANG -->
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>

                                <?php
                                $barang = getBarangByBlock($block['id']);
                                while ($b = $barang->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $b['nama_barang'] ?></td>
                                    <td><?= $b['jumlah'] ?></td>
                                    <td>
                                        <form method="post" action="functions/edit-barang.php" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                            <input type="number" name="jumlah" value="<?= $b['jumlah'] ?>" style="width:70px">
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                        </form>

                                        <form method="post" action="functions/hapus-barang.php" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </table>

                            <div class="mb-3 d-flex gap-2">

                                <!-- COPY -->
                                <form method="post" action="functions/copy-barang.php">
                                    <input type="hidden" name="block_id" value="<?= $block['id'] ?>">
                                    <button class="btn btn-outline-primary btn-sm">
                                        Copy
                                    </button>
                                </form>

                                <!-- PASTE -->
                                <form method="post" action="functions/paste-barang.php">
                                    <input type="hidden" name="block_id" value="<?= $block['id'] ?>">
                                    <button class="btn btn-outline-success btn-sm">
                                        Paste
                                    </button>
                                </form>

                                <!-- RESET -->
                                <form method="post" action="functions/reset-barang.php"
                                      onsubmit="return confirm('Yakin reset semua isi block?')">
                                    <input type="hidden" name="block_id" value="<?= $block['id'] ?>">
                                    <button class="btn btn-outline-danger btn-sm">
                                        Reset
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
