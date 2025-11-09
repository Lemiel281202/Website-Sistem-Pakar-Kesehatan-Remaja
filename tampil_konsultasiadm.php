<?php
// Pastikan koneksi ke database sudah dimasukkan
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hasil Konsultasi</title>
    <link rel="stylesheet" href="style.css"> <!-- CSS eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-2">
    <div class="card">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Data Hasil Konsultasi</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th width="80px">No.</th>
                        <th width="200px">Tanggal</th>
                        <th width="300px">Nama Pasien</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT * FROM konsultasi ORDER BY tanggal DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                <td><?php echo htmlspecialchars($row['nm_pasien']); ?></td>
                                <td align="center">
                                    <a class="btn btn-primary btn-sm" href="?page=konsultasiadm&action=detail&id=<?php echo $row['id_konsultasi']; ?>">
                                        <i class="fas fa-list"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="4" class="text-center">Tidak ada data konsultasi.</td></tr>';
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
