<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password='$new_password', token=NULL WHERE token='$token'";
    if ($conn->query($sql) === TRUE) {
        echo "Senha redefinida com sucesso! <a href='login.html'>Faça login</a>";
    } else {
        echo "Erro ao redefinir senha!";
    }
}

$conn->close();
?>
