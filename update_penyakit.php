<?php 

// Menghubungkan ke database
include 'config.php';

// Mengambil id parameter
$id_penyakit = $_GET['id'];

// Mengambil data penyakit berdasarkan id
$sql = "SELECT * FROM penyakit WHERE id_penyakit = '$id_penyakit'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "Penyakit tidak ditemukan!";
    exit;
}

if (isset($_POST['update'])) {
    $nm_penyakit = $_POST['nm_penyakit'];
    $keterangan = $_POST['keterangan'];
    $solusi = $_POST['solusi'];

    // Proses update
    $sqlUpdate = "UPDATE penyakit SET nm_penyakit='$nm_penyakit', keterangan='$keterangan', solusi='$solusi' WHERE id_penyakit ='$id_penyakit'";
    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location:?page=penyakit");
        exit;
    } else {
        echo "Gagal memperbarui data: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Penyakit</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container pt-2">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Update Data Penyakit</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nm_penyakit">Nama Penyakit</label>
                    <input type="text" class="form-control" name="nm_penyakit" value="<?php echo htmlspecialchars($row['nm_penyakit']); ?>" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" name="keterangan" maxlength="200" required><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="solusi">Solusi</label>
                    <textarea class="form-control" name="solusi" maxlength="200" required><?php echo htmlspecialchars($row['solusi']); ?></textarea>
                </div>
                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=penyakit">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
