<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id']) || !isset($data['nome']) || !isset($data['email'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados inválidos ou incompletos']);
    exit;
}

$id = intval($data['id']);
$nome = trim($data['nome']);
$email = trim($data['email']);

if (empty($nome) || empty($email)) {
    http_response_code(400);
    echo json_encode(['error' => 'Nome e email são obrigatórios']);
    exit;
}

require_once 'db.php';

$stmt = $conn->prepare("UPDATE users SET nome = ?, email = ? WHERE id = ?");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro na preparação da query']);
    exit;
}
$stmt->bind_param("ssi", $nome, $email, $id);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao atualizar usuário']);
}
$stmt->close();
$conn->close();
?>