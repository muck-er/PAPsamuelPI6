<?php
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "error" => "ID inválido."]);
    exit();
}

$userId = intval($data['id']);

$stmt = $conn->prepare("UPDATE users SET role = 'admin' WHERE id = ?");
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    $deleteStmt = $conn->prepare("DELETE FROM objetivos_user WHERE user_id = ?");
    $deleteStmt->bind_param("i", $userId);
    $deleteStmt->execute();
    $deleteStmt->close();

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Erro ao atualizar utilizador."]);
}

$stmt->close();
$conn->close();
?>