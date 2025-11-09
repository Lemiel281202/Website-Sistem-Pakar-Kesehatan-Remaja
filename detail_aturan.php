<?php 

// Menghubungkan ke database
include 'config.php';

// Mengambil id parameter
$id_aturan = $_GET['id'] ?? '';

// Pastikan ID aturan tidak kosong
if (empty($id_aturan)) {
    echo "ID Aturan tidak valid!";
    exit;
}

// Ambil data aturan berdasarkan ID
$sql = "SELECT ba.id_aturan, ba.id_penyakit, p.nm_penyakit, p.keterangan
        FROM basis_aturan ba
        INNER JOIN penyakit p ON ba.id_penyakit = p.id_penyakit
        WHERE ba.id_aturan = '$id_aturan'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Basis Aturan</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container pt-2">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Halaman Basis Aturan</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="">Nama Penyakit</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['nm_penyakit']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['keterangan']); ?>" readonly>
                </div>

                <!-- Tabel Gejala -->
                <label for="">Gejala-Gejala Penyakit</label>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th width="40px">No.</th>
                            <th width="700px" class="text-start">Nama Gejala</th> <!-- Teks rata kiri -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT g.nm_gejala
                                FROM detail_basis_aturan dba
                                INNER JOIN gejala g ON dba.id_gejala = g.id_gejala
                                WHERE dba.id_aturan = '$id_aturan'";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($data = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$no}</td>
                                        <td class='text-start'>" . htmlspecialchars($data['nm_gejala']) . "</td>
                                      </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='2' class='text-center'>Tidak ada gejala</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>

                <a class="btn btn-danger" href="?page=aturan">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
