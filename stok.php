<?php
require_once "config/koneksi.php";

/* ================= BLOCK ================= */

function getBlocks() {
    global $conn;
    return $conn->query("SELECT * FROM blocks");
}

function searchBlockByBarang($keyword) {
    global $conn;

    try {
        $keyword = "%" . $keyword . "%";
        $stmt = $conn->prepare(
            "SELECT DISTINCT block_id FROM barang WHERE nama_barang LIKE ?"
        );
        $stmt->bind_param("s", $keyword);
        $stmt->execute();

        return $stmt->get_result();
    } catch (Exception $e) {
        return false;
    }
}


function updateNamaBlock($block_id, $nama_block) {
    global $conn;

    try {
        $stmt = $conn->prepare(
            "UPDATE blocks SET nama_block=? WHERE id=?"
        );
        $stmt->bind_param("si", $nama_block, $block_id);
        $stmt->execute();
    } catch (Exception $e) {
        return "Gagal mengubah nama block";
    }
}

function getTotalBarangBlock($block_id) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT SUM(jumlah) AS total FROM barang WHERE block_id=?"
    );
    $stmt->bind_param("i", $block_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['total'] ?? 0;
}

function getNamaBarangByBlock($block_id) {
    global $conn;

    $stmt = $conn->prepare(
        "SELECT nama_barang FROM barang WHERE block_id=?"
    );
    $stmt->bind_param("i", $block_id);
    $stmt->execute();

    return $stmt->get_result();
}


/* ================= BARANG ================= */

function getBarangByBlock($block_id) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT * FROM barang WHERE block_id=?"
    );
    $stmt->bind_param("i", $block_id);
    $stmt->execute();
    return $stmt->get_result();
}

function tambahBarang($nama, $jumlah, $block_id) {
    global $conn;

    try {
        $kapasitasMax = 25;
        $totalSaatIni = getTotalBarangBlock($block_id);

        if ($totalSaatIni + $jumlah > $kapasitasMax) {
            return "Kapasitas block tidak mencukupi";
        }

        $stmt = $conn->prepare(
            "INSERT INTO barang (nama_barang, jumlah, block_id)
             VALUES (?,?,?)"
        );
        $stmt->bind_param("sii", $nama, $jumlah, $block_id);
        $stmt->execute();

        return "Barang berhasil ditambahkan";
    } catch (Exception $e) {
        return "Error sistem";
    }
}

function editJumlahBarang($id, $jumlahBaru) {
    global $conn;

    try {
        $stmt = $conn->prepare(
            "UPDATE barang SET jumlah=? WHERE id=?"
        );
        $stmt->bind_param("ii", $jumlahBaru, $id);
        $stmt->execute();
    } catch (Exception $e) {
        return "Gagal update barang";
    }
}

function hapusBarang($id) {
    global $conn;

    try {
        $stmt = $conn->prepare(
            "DELETE FROM barang WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } catch (Exception $e) {
        return "Gagal hapus barang";
    }
}

/* ================= COPY & PASTE ================= */

function copyBlock($block_id) {
    global $conn;

    $stmt = $conn->prepare(
        "SELECT nama_barang, jumlah FROM barang WHERE block_id=?"
    );
    $stmt->bind_param("i", $block_id);
    $stmt->execute();

    $_SESSION['copied_block'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function pasteBlock($target_block_id) {
    global $conn;

    if (!isset($_SESSION['copied_block'])) {
        return "Tidak ada data yang dicopy";
    }

    try {
        $totalSaatIni = getTotalBarangBlock($target_block_id);
        $totalCopy = 0;

        foreach ($_SESSION['copied_block'] as $item) {
            $totalCopy += $item['jumlah'];
        }

        if ($totalSaatIni + $totalCopy > 25) {
            return "Kapasitas block tidak mencukupi";
        }

        foreach ($_SESSION['copied_block'] as $item) {
            $stmt = $conn->prepare(
                "INSERT INTO barang (nama_barang, jumlah, block_id)
                 VALUES (?,?,?)"
            );
            $stmt->bind_param(
                "sii",
                $item['nama_barang'],
                $item['jumlah'],
                $target_block_id
            );
            $stmt->execute();
        }

        return "Paste berhasil";
    } catch (Exception $e) {
        return "Gagal paste block";
    }
}

/* ================= RESET ================= */

function resetBlock($block_id) {
    global $conn;

    try {
        $stmt = $conn->prepare(
            "DELETE FROM barang WHERE block_id=?"
        );
        $stmt->bind_param("i", $block_id);
        $stmt->execute();
    } catch (Exception $e) {
        return "Gagal reset block";
    }
}
