<?php
session_start();
include "db.php";

header('Content-Type: application/json');

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["status" => "error", "message" => "Utilizador não autenticado."]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $peso = floatval($_POST["peso"]);
    $altura = intval($_POST["altura"]);
    $idade = intval($_POST["idade"]);
    $contacto = trim($_POST["contacto"]);
    $objetivo = trim($_POST["objetivo"]);

    $stmt = $conn->prepare("UPDATE users SET nome = ?, peso = ?, altura = ?, idade = ?, contacto = ?, objetivo = ? WHERE id = ?");
    $stmt->bind_param("sdiissi", $nome, $peso, $altura, $idade, $contacto, $objetivo, $_SESSION["user_id"]);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Dados atualizados com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao guardar: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
