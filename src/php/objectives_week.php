<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Não autenticado']);
    exit;
}

require_once 'db.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id, descricao, concluido FROM objetivos WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$objetivos = [];
while ($row = $result->fetch_assoc()) {
    $objetivos[] = [
        'id' => (int)$row['id'],
        'descricao' => $row['descricao'],
        'concluido' => (bool)$row['concluido']
    ];
}

echo json_encode(['objetivos' => $objetivos]);
?>
