<?php
// Pastikan koneksi ke database sudah dimasukkan
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gejala</title>
    <link rel="stylesheet" href="style.css"> <!-- CSS eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-2">
    <div class="card">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Data Gejala</strong>
        </div>
        <div class="card-body">
            <a class="btn btn-dark mb-2" href="?page=gejala&action=tambah">Tambah</a>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th width="80px">No.</th>
                        <th width="500px">Gejala</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT * FROM gejala ORDER BY nm_gejala ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nm_gejala']); ?></td>
                                <td align="center">
                                    <a class="btn btn-warning btn-sm" href="?page=gejala&action=update&id=<?php echo $row['id_gejala']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-danger btn-sm" href="?page=gejala&action=hapus&id=<?php echo $row['id_gejala']; ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="3" class="text-center">Tidak ada data gejala.</td></tr>';
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
