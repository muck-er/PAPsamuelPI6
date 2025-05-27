<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Não autenticado']);
    exit;
}

$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput, true);


if (!is_array($data) || !isset($data['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados inválidos']);
    exit;
}

$id = (int) $data['id'];
$concluido = isset($data['concluido']) ? (int) $data['concluido'] : 0;
$user_id = (int) $_SESSION['user_id'];

require_once 'db.php';

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Falha na conexão com o banco de dados']);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO objetivos_user (id, user_id, concluido)
    VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE concluido = VALUES(concluido)
");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro na preparação da query']);
    exit;
}

$stmt->bind_param("iii", $id, $user_id, $concluido);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao executar a query']);
}

$stmt->close();
$conn->close();