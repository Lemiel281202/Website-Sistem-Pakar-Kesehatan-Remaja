<?php

$idusers=$_GET['id'];

$sql = "DELETE FROM users WHERE id_users='$idusers'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=users");
}
$conn->close();
?>