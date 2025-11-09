<?php
session_start();
require "config.php";

if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $pass = md5($_POST["pass"]);

    $sql = "SELECT * FROM users WHERE username='$username' AND pass='$pass'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        
        $_SESSION['username'] = $row["username"];
        $_SESSION['role'] = $row["role"];
        $_SESSION['status'] = "y";
    
        header("Location: index.php"); // Redirect to a dashboard or home page
    } else {
        header("Location:?msg=n");
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <link rel="stylesheet" href="style_login.css"> <!-- Link to the external CSS file -->
</head>
<body>

<?php 
if(isset($_GET['msg'])){
    if($_GET['msg'] == "n"){
    ?>
    <div class="alert alert-danger" align="center">
        <strong>Login Gagal</strong>
    </div>
    <?php
    }       
}
?>

<div class="login-container">
    <h3>Log in</h3>

    <form method="POST">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" required>
        </div>
        
        <button type="submit" name="submit">Login</button>
    </form>
</div>

</body>
</html>