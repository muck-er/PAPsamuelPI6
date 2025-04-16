<?php
include "/src/php/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $sql = "UPDATE users SET token='$token' WHERE email='$email'";
        $conn->query($sql);

        $link = "http://localhost/src/php/reset_password.php?token=$token";
        echo "Clique no link para redefinir sua senha: <a href='$link'>$link</a>";
    } else {
        echo "Email não encontrado!";
    }
}

$conn->close();
?>
