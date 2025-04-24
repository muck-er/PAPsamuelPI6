<?php
session_start();
include "src/php/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $idade = intval($_POST["idade"]);
    $peso = floatval($_POST["peso"]);
    $altura = floatval($_POST["altura"]);
    $contato = trim($_POST["contato"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (empty($nome) || empty($idade) || empty($peso) || empty($altura) || empty($contato) || empty($email) || empty($_POST["password"])) {
        echo json_encode(["status" => "error", "message" => "Por favor, preencha todos os campos."]);
        exit();
    }

    $sql = "INSERT INTO users (nome, idade, peso, altura, contato, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidddss", $nome, $idade, $peso, $altura, $contato, $email, $password);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Conta criada com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao registrar: " . $conn->error]);
    }

    $stmt->close();
}

$conn->close();
?>