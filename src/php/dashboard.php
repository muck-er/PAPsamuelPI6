<?php
header('Content-Type: application/json');

// Reutiliza a conexão existente
require_once 'db.php';

try {
    // Pegar usuários
    $usersStmt = $pdo->query("SELECT id, nome FROM users");
    $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $usersMap = array_column($users, 'nome', 'id');

    // Pegar planos de treino
    $planosStmt = $pdo->query("SELECT user_id, objetivo, dia_treino FROM planos_treino");
    $planosRaw = $planosStmt->fetchAll(PDO::FETCH_ASSOC);

    // Preparar estrutura de resposta
    $planos = [];
    $objetivos = ['perda_peso' => 0, 'ganho_massa' => 0];
    $dias = [];

    foreach ($planosRaw as $plano) {
        $nome = $usersMap[$plano['user_id']] ?? 'Desconhecido';
        $planos[] = [
            'nome' => $nome,
            'objetivo' => $plano['objetivo'],
            'dia_treino' => $plano['dia_treino'],
        ];

        // Contar objetivos
        if (isset($objetivos[$plano['objetivo']])) {
            $objetivos[$plano['objetivo']]++;
        }

        // Contar dias
        $dia = strtolower($plano['dia_treino']);
        $dias[$dia] = ($dias[$dia] ?? 0) + 1;
    }

    echo json_encode([
        'planos' => $planos,
        'objetivos' => $objetivos,
        'dias' => $dias,
    ]);
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
    http_response_code(500);
}
