<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, nome, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["nome"] = $user["nome"];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Senha incorreta!');window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Email não encontrado!');window.location.href='login.html';</script>";
    }
    $stmt->close();
}
$conn->close();
?>