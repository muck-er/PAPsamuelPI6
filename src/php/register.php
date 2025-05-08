<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Campos em falta."]);
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        echo json_encode(["status" => "success", "message" => "Conta criada com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro: " . $conn->error]);
    }

    $stmt->close();
    $conn->close();
}
?>