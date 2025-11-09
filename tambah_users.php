<?php

if(isset($_POST['simpan'])){
    $username=$_POST['username'];
    $pass=md5($_POST['pass']);
    $role=$_POST['role'];

	//proses simpan
        $sql = "INSERT INTO users VALUES (Null,'$username','$pass','$role')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=users");
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data User</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card-header bg-dark text-white border-dark">
                        <strong>Tambah Data User</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" maxlength="20" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="pass" maxlength="255" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="Dokter">Dokter</option>
                                <option value="Admin">Admin</option>
                                <option value="Pasien">Pasien</option>
                            </select>
                        </div>
                        
                        <button class="btn btn-dark" type="submit" name="simpan">Simpan</button>
                        <a class="btn btn-danger" href="?page=users">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
