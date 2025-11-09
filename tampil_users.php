<?php
// Pastikan sudah menyertakan koneksi ke database
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="stylee.css"> <!-- CSS eksternal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-2">
    <div class="card">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Data Pengguna</strong>
        </div>
        <div class="card-body">
            <a class="btn btn-dark mb-2" href="?page=users&action=tambah">Tambah</a>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th width="80px">No.</th>
                        <th width="900px">Username</th>
                        <th width="900px">Role</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT * FROM users ORDER BY username ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['role']); ?></td>
                                <td align="center">
                                    <a class="btn btn-warning btn-sm" href="?page=users&action=update&id=<?php echo $row['id_users']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-danger btn-sm" href="?page=users&action=hapus&id=<?php echo $row['id_users']; ?>">
                                        <i class="fas fa-window-close"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="4" class="text-center">Tidak ada data pengguna.</td></tr>';
                    }
                    // Jangan lupa tutup koneksi database setelah selesai
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
