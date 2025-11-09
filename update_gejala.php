<?php 

// Menghubungkan ke database
include 'config.php';

// Mengambil id parameter
$id_gejala = $_GET['id'];

// Mengambil data gejala berdasarkan id
$sql = "SELECT * FROM gejala WHERE id_gejala = '$id_gejala'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "Gejala tidak ditemukan!";
    exit;
}

if (isset($_POST['update'])) {
    $nm_gejala = $_POST['nm_gejala'];

    // Proses update
    $sqlUpdate = "UPDATE gejala SET nm_gejala='$nm_gejala' WHERE id_gejala ='$id_gejala'";
    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location:?page=gejala");
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
    <title>Update Data Gejala</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container pt-2">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Update Data Gejala</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nm_gejala">Nama Gejala</label>
                    <input type="text" class="form-control" name="nm_gejala" value="<?php echo htmlspecialchars($row['nm_gejala']); ?>" maxlength="100" required>
                </div>
                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=gejala">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
