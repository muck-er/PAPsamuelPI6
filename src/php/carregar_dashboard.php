<?php
session_start();
include 'db.php';

if (!isset($_SESSION['utilizador_id'])) {
    http_response_code(401);
    exit("Não autenticado.");
}

$user_id = $_SESSION['utilizador_id'];

// Buscar planos de treino
$sqlTreinos = $conn->prepare("SELECT descricao FROM planos_treino WHERE user_id = ?");
$sqlTreinos->bind_param("i", $user_id);
$sqlTreinos->execute();
$resultTreinos = $sqlTreinos->get_result();
$treinos = [];
while ($row = $resultTreinos->fetch_assoc()) {
    $treinos[] = $row['descricao'];
}

// Buscar objetivos
$sqlObjetivos = $conn->prepare("SELECT id, descricao, concluido FROM objetivos WHERE user_id = ?");
$sqlObjetivos->bind_param("i", $user_id);
$sqlObjetivos->execute();
$resultObjetivos = $sqlObjetivos->get_result();
$objetivos = [];
while ($row = $resultObjetivos->fetch_assoc()) {
    $objetivos[] = [
        'id' => $row['id'],
        'descricao' => $row['descricao'],
        'concluido' => $row['concluido']
    ];
}

echo json_encode([
    'treinos' => $treinos,
    'objetivos' => $objetivos
]);
?>
