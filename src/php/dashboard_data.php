<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Não autenticado']);
    exit;
}

require_once 'db.php';

$acao = $_GET['acao'] ?? '';
$user_id = $_SESSION['user_id'];


$stmt = $conn->prepare("SELECT objetivo, nome FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    http_response_code(404);
    echo json_encode(['error' => 'Utilizador não encontrado']);
    exit;
}

$tabela = $user['objetivo'] === 'ganho_massa' ? 'treinos_ganho_massa' : 'treinos_perda_peso';


$mapa_dias = [
    'A' => 'Segunda-feira',
    'B' => 'Terça-feira',
    'C' => 'Quinta-feira',
    'D' => 'Sexta-feira',
];

$mapa_letras =
    [
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D',
        5 => 'E',
        6 => 'F',
        0 => 'G'
    ];

function obterTreinosSemanais($conn, $tabela, $mapa_dias)
{
    $dados = [];
    $result = $conn->query("SELECT treino, exercicios FROM $tabela");
    while ($row = $result->fetch_assoc()) {
        $dia = $mapa_dias[$row['treino']] ?? 'Outro dia';
        foreach (explode(', ', $row['exercicios']) as $ex) {
            $dados[] = [
                'treino' => $row['treino'],
                'dia' => $dia,
                'exercicio' => $ex,
                'duracao' => '3 séries'
            ];
        }
    }
    return $dados;
}


function obterTreinoDoDia($conn, $tabela, $mapa_letras)
{
    $diaSemana = date('w');
    $letra = $mapa_letras[$diaSemana] ?? null;
    if (!$letra)
        return [];

    $stmt = $conn->prepare("SELECT exercicios FROM $tabela WHERE treino = ?");
    $stmt->bind_param("s", $letra);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    if (!$result)
        return [];

    return array_map(function ($ex) use ($letra) {
        return [
            'treino' => $letra,
            'dia' => date('l'),
            'exercicio' => $ex,
            'duracao' => '3 séries'
        ];
    }, explode(', ', $result['exercicios']));
}

function obterObjetivosSemanais($conn, $user_id)
{
    $stmt = $conn->prepare("
        SELECT op.id, op.descricao, ou.concluido
        FROM objetivos_padrao op
        LEFT JOIN objetivos_user ou ON op.id = ou.id AND ou.user_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $objetivos = [];
    while ($row = $result->fetch_assoc()) {
        $objetivos[] = [
            'id' => (int) $row['id'],
            'descricao' => $row['descricao'],
            'concluido' => (bool) $row['concluido']
        ];
    }

    return $objetivos;
}


switch ($acao) {
    case 'treino_dia':
        echo json_encode([
            'nome' => $user['nome'],
            'objetivo' => $user['objetivo'],
            'treinos' => obterTreinoDoDia($conn, $tabela, $mapa_letras)
        ]);
        break;

    case 'treinos_semana':
        echo json_encode([
            'treinos' => obterTreinosSemanais($conn, $tabela, $mapa_dias)
        ]);
        break;

    case 'objetivos_semana':
        echo json_encode([
            'objetivos' => obterObjetivosSemanais($conn, $user_id)
        ]);
        break;


    default:
        http_response_code(400);
        echo json_encode(['error' => 'Ação inválida']);
}