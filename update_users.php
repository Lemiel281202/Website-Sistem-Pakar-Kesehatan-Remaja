<?php 

// Menghubungkan ke database
include 'config.php';

// Mengambil id parameter
$idusers = $_GET['id'];

// Mengambil data user berdasarkan id
$sql = "SELECT * FROM users WHERE id_users = '$idusers'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "User tidak ditemukan!";
    exit;
}

if (isset($_POST['update'])) {
    $role = $_POST['role'];

    // Proses update data user
    $sqlUpdate = "UPDATE users SET role='$role' WHERE id_users='$idusers'";
    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location:?page=users");
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
    <title>Update Data Users</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container pt-2">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Update Data Users</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="********" readonly>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role">
                        <option value="">Pilih Role</option>
                        <option value="Dokter" <?php if ($row['role'] == 'Dokter') echo 'selected'; ?>>Dokter</option>
                        <option value="Admin" <?php if ($row['role'] == 'Admin') echo 'selected'; ?>>Admin</option>
                        <option value="Pasien" <?php if ($row['role'] == 'Pasien') echo 'selected'; ?>>Pasien</option>
                    </select>
                </div>
                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=users">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
