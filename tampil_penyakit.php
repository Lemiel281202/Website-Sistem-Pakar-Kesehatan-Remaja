<?php
// Pastikan koneksi ke database sudah dimasukkan
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyakit</title>
    <link rel="stylesheet" href="stylee.css"> <!-- CSS eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-2">
    <div class="card">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Data Penyakit</strong>
        </div>
        <div class="card-body">
            <a class="btn btn-dark mb-2" href="?page=penyakit&action=tambah">Tambah</a>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th width="80px">No.</th>
                        <th width="500px">Nama Penyakit</th>
                        <th width="300px">Keterangan</th>
                        <th width="300px">Solusi</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT * FROM penyakit ORDER BY nm_penyakit ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nm_penyakit']); ?></td>
                                <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                                <td><?php echo htmlspecialchars($row['solusi']); ?></td>
                                <td align="center">
                                    <a class="btn btn-warning btn-sm" href="?page=penyakit&action=update&id=<?php echo $row['id_penyakit']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-danger btn-sm" href="?page=penyakit&action=hapus&id=<?php echo $row['id_penyakit']; ?>">
                                        <i class="fas fa-window-close"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center">Tidak ada data penyakit.</td></tr>';
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- jQuery (diperlukan untuk Bootstrap 4) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle dengan Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
