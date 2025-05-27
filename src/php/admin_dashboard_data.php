<?php
session_start();
header('Content-Type: application/json');

require_once 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado']);
    exit;
}

try {
    $res_users = $conn->query("SELECT COUNT(*) AS total FROM users");
    $total_users = $res_users->fetch_assoc()['total'];

    $res_obj = $conn->query("SELECT COUNT(*) AS total FROM objetivos_user");
    $total_objectives = $res_obj->fetch_assoc()['total'];

    $res_treinos = $conn->query("
    SELECT COUNT(*) AS total FROM (
        SELECT id FROM treinos_ganho_massa
        UNION ALL
        SELECT id FROM treinos_perda_peso
    ) AS todos_treinos
    ");
    $total_workouts = $res_treinos->fetch_assoc()['total'];

    $res_lista = $conn->query("SELECT id, nome, email, role FROM users ORDER BY id ASC");
    $users = [];

    while ($row = $res_lista->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode([
        'total_users' => (int) $total_users,
        'total_objectives' => (int) $total_objectives,
        'total_workouts' => (int) $total_workouts,
        'users' => $users
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erro ao carregar dados',
        'details' => $e->getMessage()
    ]);
}
?>