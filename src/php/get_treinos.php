<?php
require 'db.php';

header('Content-Type: application/json');

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

$sql = "
    SELECT t.treino_tipo, t.exercicio_ordem, t.exercicio
    FROM treinos_dedicados td
    JOIN objetivos_treinos ot ON td.objetivo_treino_id = ot.id
    JOIN treinos t ON ot.treino_id = t.id
    WHERE td.user_id = ?
    ORDER BY t.treino_tipo, t.exercicio_ordem
";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $treinos = [];
    while ($row = $result->fetch_assoc()) {
        $treinos[] = $row;
    }

    echo json_encode($treinos);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erro ao obter treinos: " . $e->getMessage()]);
}
?>
