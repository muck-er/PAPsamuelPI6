<?php
session_start();
include "db.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$user_id = intval($input['id'] ?? 0);

if ($user_id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'ID inválido']);
    exit;
}

$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Usuário não encontrado']);
    exit;
}

$user = $result->fetch_assoc();
if ($user['role'] === 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Não é permitido remover usuários admin']);
    exit;
}
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao remover usuário']);
}
?>